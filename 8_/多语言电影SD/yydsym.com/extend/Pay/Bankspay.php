<?php

namespace Pay;

use think\Db;
use think\facade\Env;

class Bankspay extends PayBase
{
    const PAY_BANK_LIST = [
        'BCP' => 'BCP',
        'BBVA' => 'BBVA',
        'Banco de Comercio' => 'Banco de Comercio',
        'Banco de Crédito del Perú' => 'Banco de Crédito del Perú',
        'Banco Interamericano de Finanzas (BanBif)' => 'Banco Interamericano de Finanzas (BanBif)',
        'Banco Pichincha' => 'Banco Pichincha',
        'Citibank Perú' => 'Citibank Perú',
        'Interbank' => 'Interbank',
        'MiBanco' => 'MiBanco',
        'Scotiabank Perú' => 'Scotiabank Perú',
        'Banco GNB Perú' => 'Banco GNB Perú',
        'Banco Falabella' => 'Banco Falabella',
        'Banco Ripley' => 'Banco Ripley',
        'Banco Santander Perú' => 'Banco Santander Perú',
        'Alfin Banco' => 'Alfin Banco',
        'Bank of China' => 'Bank of China',
        'ICBC PERU BANK' => 'ICBC PERU BANK'
    ];
    const PAY_URL = 'https://api.bankspay.com:1234/api/v2/topup';
    const PAYOUT_URL = 'https://api.bankspay.com:1234/api/v2/withdraw';

    public static function instance()
    {
        return new self();
    }

    public function getConfig($param)
    {
        $type = input('get.type/d', 0);
        if ($type == 0) {
            return config('pay.bankspay.' . $param);
        }
        return config('pay.bankspay.type.t' . $type . '.' . $param);
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
            'partnerid' => $this->get_mch_id(),
            'paytype' => $this->getConfig('pay_type'),
            'amount' => "" . number_format($op_data['amount'], 2, '.', ''),
            'orderid' => $op_data['sn'],
            'notifyurl' => url('/api/callback/pay', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
                'type' => input('get.type/d', 0)
            ], true, true)
        ];
        $data['sign'] = $this->_make_sign($data);
        $res = $this->_post(self::PAY_URL, $data, 'json');
        $res = json_decode($res, true);
        if (isset($res['status']) && $res['status'] == 200) {
            return ['respCode' => 'SUCCESS', 'payInfo' => $res['url']];
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
        $sign = $this->_make_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['status'] == 1 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['orderid'],
            'amount' => $data['amount'],
            'data' => $data
        ];
    }

    public function payCallbackSuccess()
    {
        echo '{"code":200,"msg":"ok"}';
    }

    public function payCallbackFail()
    {
        echo 'ERROR';
    }

    public $_payout_msg = '';

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        if (!$blank_info['bank_clabe']) {
            $this->_payout_msg = '请驳回， 让会员输入CCI，再次提交';
            return false;
        }
        $data = [
            'partnerid' => $this->get_mch_id(),
            'orderid' => $oinfo['id'],
            'accountname' => $blank_info['username'],
            'cardnumber' => $blank_info['cardnum'],
            'bankname' => $blank_info['bank_code'],
            'amount' => "" . floatval($oinfo['num']),
            'remark' => $blank_info['bank_clabe'],
            'paytype' => $this->getConfig('pay_type'),
            'notifyurl' => url('/api/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
        ];
        $data['sign'] = $this->_make_payout_sign($data);

        $logFile = Env::get('ROOT_PATH') . 'runtime/bankspay_create_payout.txt';
        file_put_contents($logFile, date('Y-m-d H:i:s') . ' ' . json_encode($data) . "\n", FILE_APPEND);

        $res = $this->_post(self::PAYOUT_URL, $data, 'json');
        $res = json_decode($res, true);
        if (isset($res['status']) && $res['status'] == 1) {
            return true;
        }
        $this->_payout_msg = !empty($res['msg']) ? $res['msg'] : '';
        return false;
    }

    //["status"=>"SUCCESS","oid"=>"订单号","amount"=>"支付金额"]
    public function parsePayoutCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        $data = json_decode($put, true);
        if (empty($data)) $data = $_POST;
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
            'status' => ($data['status'] == 1 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['orderid'],
            'amount' => $data['amount'],
            'msg' => !empty($data['partnerorder']) ? $data['partnerorder'] : $data['msg'],
            'data' => $data
        ];
    }

    public function parsePayoutCallbackFail()
    {
        echo "ERROR";
    }

    public function parsePayoutCallbackSuccess()
    {
        echo '{"code":200,"msg":"ok"}';
    }


    /**
     * 创建签名
     * @param $data array  数据包
     * @return string
     */
    private function _make_sign(array $data)
    {
        $a = "" . ($data['amount']);
        return strtolower(md5($this->get_secret() . $this->get_mch_id() . $a));
    }

    private function _make_payout_sign(array $data)
    {
        $a = "" . ($data['amount']);
        return strtolower(md5($this->get_secret() . $this->get_mch_id() . $a));
    }
}