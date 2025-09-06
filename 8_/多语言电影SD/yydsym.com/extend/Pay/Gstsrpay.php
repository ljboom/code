<?php

namespace Pay;

use think\Db;

class Gstsrpay extends PayBase
{
    const PAY_URL = 'https://cresh.gstsr.com/ty/orderPay';
    const PAYOUT_URL = 'https://sevsy.gstsr.com/withdraw/singleOrder';
    const PAY_BANK_LIST = [
        'MXNSTP' => 'STP',
        'MXNHSBC' => 'HSBC',
        'MXNAZTECA' => 'AZTECA',
        'MXNBANAMEX' => 'BANAMEX',
        'MXNBANORTE' => 'BANORTE',
        'MXNBANREGIO' => 'BANREGIO',
        'MXNBANCOPPEL' => 'BANCOPPEL',
        'MXNSANTANDER' => 'SANTANDER',
        'MXNSCOTIABANK' => 'SCOTIABANK',
        'MXNBBVABANCOMER' => 'BBVABANCOMER '
    ];

    public static function instance()
    {
        return new self();
    }

    public function getConfig($param)
    {
        if ($param == 'busi_code') {
            $type = input('get.type/d', 0);
            if ($type > 0) {
                return config('pay.gstsrpay.t' . $type . '.' . $param);
            }
        }
        return config('pay.gstsrpay.' . $param);
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
        $data = [
            'mer_no' => $this->get_mch_id(),
            'ccy_no' => $this->getConfig('ccy_no'),
            'busi_code' => $this->getConfig('busi_code'),
            'timeout_express' => '5h',
            'goods' => $op_data['sn'],
            'mer_order_no' => $op_data['sn'],
            'pname' => 'order recharge',
            'pemail' => '8888888@gmail.com',
            'phone' => '5512341234',
            'order_amount' => sprintf("%.2f", $op_data['amount']),
            'notifyUrl' => url('/api/callback/pay', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
                'type' => input('get.type/d', 0)
            ], true, true),
            'pageUrl' => url('/', '', true, true)
        ];
        $data['sign'] = $this->_make_sign($data);
        $res = $this->_post(self::PAY_URL, $data, 'json');
        $res = json_decode($res, true);
        if (isset($res['status']) && $res['status'] == 'SUCCESS') {
            return ['respCode' => 'SUCCESS', 'payInfo' => $res['order_data']];
        }
        return [
            'respCode' => 'ERROR',
            'payInfo' => '',
            'resData' => $res,
            'postData' => $data
        ];
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
        if (!isset($data['sign'])) {
            exit();
        }
        $sign_old = $data['sign'];
        unset($data['sign']);
        $sign = $this->_check_callback_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['status'] == 'SUCCESS' ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['mer_order_no'],
            'amount' => $data['order_amount'],
            'data' => $data,
            'msg' => !empty($data['mer_order_no']) ? $data['mer_order_no'] : '',
        ];
    }

    public function payCallbackSuccess()
    {
        echo 'SUCCESS';
    }

    public function payCallbackFail()
    {
        echo 'ERROR';
    }

    public $_payout_msg = '';

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        $data = [
            'mer_no' => $this->get_mch_id(),
            'mer_order_no' => $oinfo['id'],
            'order_amount' => sprintf("%.2f", $oinfo['num']),
            'acc_name' => $blank_info['username'],
            'acc_no' => str_replace(" ", "", $blank_info['cardnum']),
            'ccy_no' => $this->getConfig('ccy_no'),
            'bank_code' => $blank_info['bank_code'],
            'mobile_no' => str_replace(" ", "", $blank_info['mobile']),
            'summary' => 'shop',
            'notifyUrl' => url('/api/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
        ];
        $data['sign'] = $this->_make_payout_sign($data);
        $res2 = $this->_post(self::PAYOUT_URL, $data, 'json');
        $res = json_decode($res2, true);
        if (isset($res['status']) && $res['status'] == 'SUCCESS') {
            return true;
        }
        $this->_payout_msg = $res2 . json_encode($data);
        return false;
    }

    //["status"=>"SUCCESS","oid"=>"订单号","amount"=>"支付金额"]
    public function parsePayoutCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        $data = json_decode($put, true);
        if (empty($data)) $data = $_POST;
        if (!isset($data['sign'])) exit();
        if ($data['status'] == 'UNKNOW') exit();
        $sign_old = $data['sign'];
        unset($data['sign']);
        $sign = $this->_check_callback_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['status'] == 'SUCCESS' ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['mer_order_no'],
            'amount' => $data['order_amount'],
            'msg' => !empty($data['order_no']) ? $data['order_no'] : '',
            'data' => $data
        ];
    }

    public function parsePayoutCallbackFail()
    {
        echo "ERROR";
    }

    public function parsePayoutCallbackSuccess()
    {
        echo "SUCCESS";
    }

    /**
     * 创建签名
     * @param $data array  数据包
     * @return string
     */
    private function _make_sign(array $data): string
    {
        return $this->encrypt($data);
    }

    private function _check_callback_sign(array $data): string
    {
        ksort($data);
        $str = '';
        foreach ($data as $key => $value) {
            if (strlen($value) > 0) $str .= $key . '=' . $value . '&';
        }
        return strtolower(md5($str . 'key=' . $this->get_secret()));
    }

    private function _make_payout_sign(array $data): string
    {
        return $this->encrypt($data);
    }

    //通知验签 $data:通知数据
    private function decrypt($data)
    {
        ksort($data);
        $toSign = '';
        foreach ($data as $key => $value) {
            if (strcmp($key, 'sign') != 0 && $value != '') {
                $toSign .= $key . '=' . $value . '&';
            }
        }
        $str = rtrim($toSign, '&');
        $encrypted = '';
        $pem = chunk_split($this->getConfig('main_public'), 64, "\n");
        $pem = "-----BEGIN PUBLIC KEY-----\n" . $pem . "-----END PUBLIC KEY-----\n";
        $publickey = openssl_pkey_get_public($pem);
        $base64 = str_replace(array('-', '_'), array('+', '/'), $data['sign']);
        $crypto = '';
        foreach (str_split(base64_decode($base64), 128) as $chunk) {
            openssl_public_decrypt($chunk, $decrypted, $publickey);
            $crypto .= $decrypted;
        }
        return $str == $crypto;
    }

    //加密
    private function encrypt($data)
    {
        ksort($data);
        $str = '';
        foreach ($data as $k => $v) {
            if (!empty($v)) {
                $str .= $k . '=' . $v . '&';
            }
        }
        $str = rtrim($str, '&');
        $pem = chunk_split($this->getConfig('private'), 64, "\n");
        $pem = "-----BEGIN PRIVATE KEY-----\n" . $pem . "-----END PRIVATE KEY-----\n";
        $private_key = openssl_pkey_get_private($pem);
        $crypto = '';
        foreach (str_split($str, 117) as $chunk) {
            openssl_private_encrypt($chunk, $encryptData, $private_key);
            $crypto .= $encryptData;
        }
        $encrypted = base64_encode($crypto);
        $encrypted = str_replace(array('+', '/', '='), array('-', '_', ''), $encrypted);
        return $encrypted;
    }
}