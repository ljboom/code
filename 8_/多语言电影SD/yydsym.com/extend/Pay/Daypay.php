<?php

namespace Pay;

use think\Db;

class Daypay extends PayBase
{
    const PAY_URL = 'https://www.daypaybd.com/openApi/pay/createOrder';
    const PAYOUT_URL = 'https://www.daypaybd.com/openApi/payout/createOrder';
    const PAY_BANK_LIST = [
        'PIX' => 'PIX'
    ];

    public static function instance()
    {
        return new self();
    }

    public function getConfig($param)
    {
        $type = input('get.type/d', 0);
        if ($type == 0) {
            return config('pay.daypay.' . $param);
        }
        return config('pay.daypay.type.t' . $type . '.' . $param);
    }

    public function get_mch_id()
    {
        return $this->getConfig('mch_id');
    }

    public function get_secret()
    {
        return $this->getConfig('secret');
    }

    //发起代收订单
    public function createPay(array $op_data): array
    {
        $oUser = Db::name('users')->where('id', $op_data['uid'])->find();
        $userName = preg_replace("/\\d+/", '', $oUser['username']);
        $data = [
            'merchant' => $this->get_mch_id(),
            'orderId' => $op_data['sn'],
            'amount' => "".$op_data['amount'],
            'customName' => $this->randUsername(),
            'customEmail' => $oUser['phone'] . '@' . request()->rootDomain(),
            'customMobile' => $oUser['phone'],
            'notifyUrl' => url('/api/callback/pay', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
                'type' => input('get.type/d', 0)
            ], true, true),
            'callbackUrl' => url('/', '', true, true),
        ];
        $data['sign'] = $this->_make_sign($data);
        $res = $this->_post(self::PAY_URL, $data, 'json');
        $res = json_decode($res, true);
        if (!empty($res['code']) && $res['code'] == 200) {
            return ['respCode' => 'SUCCESS', 'payInfo' => $res['data']['url']];
        }
        return ['respCode' => 'ERROR', 'payInfo' => '', 'resData' => $res, 'postData' => $data];
    }

    /**
     * 验证代收回调
     * @param string $type
     * @return array ['status'=>'SUCCESS',oid=>'订单号',amount=>'金额','data'=>'原始数据 array']
     */
    public function parsePayCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        $data = json_decode($put, true);
        if (empty($data)) $data = $_POST;
        if (empty($data)) $data = $_GET;
        if (empty($data['sign'])) {
            exit();
        }
        $sign_old = $data['sign'];
        unset($data['sign']);
        $sign = $this->_make_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['status'] == 'PAY_SUCCESS' ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['orderId'],
            'amount' => $data['amount'],
            'data' => $data
        ];
    }

    public function payCallbackSuccess()
    {
        echo 'ok';
    }

    public function payCallbackFail()
    {
        echo 'SUCCESS';
    }

    public $_payout_msg = '';

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        $data = [
            'merchant' => $this->get_mch_id(),
            'orderId' => $oinfo['id'],
            'amount' => "".$oinfo['num'],
            'bankAccount' => $blank_info['wallet_document_id'],
            'documentId' => $blank_info['wallet_document_id'],
            'customName' => $blank_info['username'],
            'customMobile' => $blank_info['mobile'],
            'customEmail' => $blank_info['mobile'] . '@' . request()->rootDomain(),
            'documentType' => 'CPF',
            'notifyUrl' => url('/index/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
            'accountDigit' => "1",
        ];
        //巴西参数
        if (strlen($blank_info['wallet_document_id']) == 36
            && strpos($blank_info['wallet_document_id'], '-') > 0) {
            $data['documentType'] = 'EVP';
        }
        if (strpos($blank_info['wallet_document_id'], '@') > 0) {
            $data['documentType'] = 'EMAIL';
        }
        if ($blank_info['wallet_document_id'] == $blank_info['mobile']) {
            //$data['documentType'] = 'PHONE';
        }
        if (substr($blank_info['wallet_document_id'], 0, 3) == '+55') {
            $data['documentType'] = 'PHONE';
            //$blank_info['wallet_document_id'] = str_replace('+', '', $blank_info['wallet_document_id']);
        }
        if (substr($blank_info['wallet_document_id'], 2, 1) == '9') {
            $data['documentType'] = 'PHONE';
            $blank_info['wallet_document_id'] = '+55' . $blank_info['wallet_document_id'];
        }
        if ($data['documentType'] == 'PHONE' && strlen($blank_info['wallet_document_id']) == 11) {
            $blank_info['wallet_document_id'] = '+55' . $blank_info['wallet_document_id'];
        }
        $data['bankAccount'] = $blank_info['wallet_document_id'];
        $data['documentId'] = $blank_info['wallet_document_id'];

        $data['sign'] = $this->_make_payout_sign($data);
        $res = $this->_post(self::PAYOUT_URL, $data, 'json');
        $res = json_decode($res, true);
        if (!empty($res['code']) && $res['code'] == '200') {
            return true;
        }
        $this->_payout_msg = !empty($res['errorMessages']) ? $res['errorMessages'] : '';
        return false;
    }

    //["status"=>"SUCCESS","oid"=>"订单号","amount"=>"支付金额"]
    public function parsePayoutCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        $data = json_decode($put, true);
        if (empty($data)) $data = $_POST;
        if (empty($data)) $data = $_GET;
        if (empty($data['sign'])) {
            exit();
        }
        $sign_old = $data['sign'];
        unset($data['sign']);
        $sign = $this->_make_payout_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['status'] == 'PAY_SUCCESS' ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['orderId'],
            'amount' => $data['amount'],
            'msg' => $data['status'] == 'SUCCESS' ? 'Successful transfer' : 'FAIL',
            'data' => $data
        ];
    }

    public function parsePayoutCallbackFail()
    {
        echo "ERROR";
    }

    public function parsePayoutCallbackSuccess()
    {
        echo "ok";
    }


    /**
     * 创建签名
     * @param $data array  数据包
     * @return string
     */
    private function _make_sign(array $data)
    {
        ksort($data);
        $str = '';
        foreach ($data as $key => $value) {
            if (strlen($value) > 0) $str .= $key . '=' . $value . '&';
        }
        return strtolower(md5($str . 'key=' . $this->get_secret()));
    }

    private function _make_payout_sign(array $data)
    {
        ksort($data);
        $str = '';
        foreach ($data as $key => $value) {
            $value = trim($value);
            if (strlen($value) > 0) $str .= $key . '=' . $value . '&';
        }
        return strtolower(md5($str . 'key=' . $this->get_secret()));
    }
}