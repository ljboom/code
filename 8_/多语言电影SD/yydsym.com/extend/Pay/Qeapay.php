<?php

namespace Pay;

use think\Db;
use think\facade\Env;

class Qeapay extends PayBase
{
    const PAY_URL = 'https://payment.qeapay.com/pay/web';
    const PAYOUT_URL = 'https://payment.qeapay.com/pay/transfer';

    public static function instance()
    {
        return new self();
    }

    public function getConfig($param)
    {
        return config('pay.qeapay.' . $param);
    }

    public function get_mch_id()
    {
        return $this->getConfig('mch_id');
    }

    public function get_secret()
    {
        return $this->getConfig('secret');
    }

    public function get_payout_secret()
    {
        return $this->getConfig('payout_secret');
    }

    //发起代收订单
    public function createPay(array $op_data): array
    {
        $data = [
            'goods_name' => 'payer',
            'mch_order_no' => $op_data['sn'],
            'trade_amount' => $op_data['amount'],
            'notify_url' => url('/api/callback/pay', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
                'type' => input('get.type/d', 0)
            ], true, true),
            'page_url' => url('/', '', true, true),
        ];
        $data['version'] = '1.0';
        $data['pay_type'] = $this->getConfig('pay_type');
        $data['order_date'] = date('Y-m-d H:i:s');
        $data['mch_id'] = $this->get_mch_id();
        $data['sign'] = $this->_make_sign($data);
        $data['sign_type'] = 'MD5';
        $res = $this->_post(self::PAY_URL, $data);
        $res = json_decode($res, true);
        if (!empty($res['respCode']) && $res['respCode'] == 'SUCCESS') {
            return ['respCode' => 'SUCCESS', 'payInfo' => $res['payInfo']];
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
        if (empty($data['sign'])) {
            exit();
        }
        $sign_old = $data['sign'];
        unset($data['sign']);
        unset($data['signType']);
        $sign = $this->_make_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['tradeResult'] == 1 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['mchOrderNo'],
            'amount' => $data['amount'],
            'data' => $data
        ];
    }

    public function payCallbackSuccess()
    {
        echo 'success';
    }

    public function payCallbackFail()
    {
        echo 'error';
    }

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        $data = [
            'mch_id' => $this->get_mch_id(),
            'mch_transferId' => $oinfo['id'],
            'transfer_amount' => $oinfo['num'],
            'apply_date' => date('Y-m-d H:i:s'),
            'bank_code' => 'PIXPAY',
            'document_type' => 'CPF',
            'receive_name' => $blank_info['username'],
            'back_url' => url('/api/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
        ];
        //巴西参数
        if (strlen($blank_info['wallet_document_id']) == 36
            && strpos($blank_info['wallet_document_id'], '-') > 0) {
            $data['document_type'] = 'EVP';
        }
        if (strpos($blank_info['wallet_document_id'], '@') > 0) {
            $data['document_type'] = 'EMAIL';
        }
        if ($blank_info['wallet_document_id'] == $blank_info['mobile']) {
            $data['document_type'] = 'PHONE';
        }
        if (substr($blank_info['wallet_document_id'], 0, 3) == '+55') {
            $data['document_type'] = 'PHONE';
            $blank_info['wallet_document_id'] = str_replace('+', '', $blank_info['wallet_document_id']);
            $blank_info['mobile'] = str_replace('+', '', $blank_info['mobile']);
        }
        if ($data['document_type'] == 'PHONE' && strlen($blank_info['wallet_document_id']) != 11) {
            $blank_info['wallet_document_id'] = '55' . $blank_info['wallet_document_id'];
        }
        $data['receive_account'] = $blank_info['wallet_document_id'];
        $data['document_id'] = $blank_info['wallet_document_id'];
        $data['receiver_telephone'] = $blank_info['mobile'];
        $data['account_type'] = '2';

        $data['sign'] = $this->_make_payout_sign($data);
        $data['sign_type'] = 'MD5';
        $res = $this->_post(self::PAYOUT_URL, $data);
        $res = json_decode($res, true);
        if (!empty($res['respCode']) && $res['respCode'] == 'SUCCESS') {
            return true;
        }
        $logFile = Env::get('ROOT_PATH') . 'runtime/qeapay_create_payout.txt';
        //file_put_contents($logFile, date('Y-m-d H:i:s') . ' ' . json_encode($data) . "\n", FILE_APPEND);
        //file_put_contents($logFile, 'ERROR:  ' . json_encode($res), FILE_APPEND);
        $this->_payout_msg = !empty($res['errorMsg']) ? $res['errorMsg'] : '';
        return false;
    }

    public function parsePayoutCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        parse_str($put, $data);
        if (empty($data['sign'])) {
            exit('error sign');
        }
        if ($data['tradeResult'] == 4) exit();
        $sign_old = $data['sign'];
        unset($data['sign']);
        unset($data['signType']);
        $sign = $this->_make_payout_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['tradeResult'] == 1 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['merTransferId'],
            'amount' => $data['transferAmount'],
            'msg' => $data['tradeResult'] == 1 ? 'Successful transfer' : 'FAIL',
            'data' => $data
        ];
    }

    public function parsePayoutCallbackFail()
    {
        echo "error";
    }

    public function parsePayoutCallbackSuccess()
    {
        echo "success";
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
            $str .= $key . '=' . $value . '&';
        }
        return strtolower(md5($str . 'key=' . $this->get_secret()));
    }


    public function check_payout_sign(array $data): bool
    {
        $sign = $data['sign'];
        unset($data['sign']);
        unset($data['signType']);
        $s = $this->_make_payout_sign($data);
        return $s == $sign;
    }

    private function _make_payout_sign(array $data)
    {
        ksort($data);
        $str = '';
        foreach ($data as $key => $value) {
            $str .= $key . '=' . $value . '&';
        }
        return strtolower(md5($str . 'key=' . $this->get_payout_secret()));
    }
}