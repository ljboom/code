<?php

namespace Pay;

use think\Db;

class Speedlyppay extends PayBase
{
    const PAY_URL = 'https://pay.speedlyp.com/pay/recharge/order';
    const PAYOUT_URL = 'https://pay.speedlyp.com/api/withdrawal/order/add';

    public static function instance()
    {
        return new self();
    }

    public function get_mch_id()
    {
        return config('pay.speedlyppay.mch_id');
    }

    public function get_secret()
    {
        return config('pay.speedlyppay.secret');

    }

    //发起代收订单
    public function createPay(array $op_data): array
    {
        $data = [
            'merchantId' => $this->get_mch_id(),
            'payType' => config('pay.speedlyppay.pay_type'),
            'orderId' => $op_data['sn'],
            'amount' => $op_data['amount'],
            'notifyUrl' => url('/api/callback/pay', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
                'type' => input('get.type/d', 0)
            ], true, true),
            'redirectURL' => url('/', '', true, true),
        ];
        $data['sign'] = $this->_make_sign($data);
        $res = $this->_post(self::PAY_URL, $data, 'json');
        $res = json_decode($res, true);
        if (isset($res['status']) && $res['status'] == 0) {
            return ['respCode' => 'SUCCESS', 'payInfo' => $res['data']['payUrl']];
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
        if (empty($data['sign'])) {
            exit();
        }
        $sign_old = $data['sign'];
        unset($data['sign']);
        $sign = md5('merchantId=' . $this->get_mch_id() .
            '&amount=' . $data['amount'] .
            '&orderId=' . $data['orderId'] .
            '&orderStatus=' . $data['orderStatus'] .
            '&key=' . $this->get_secret());
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['orderStatus'] == 1 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['orderId'],
            'amount' => $data['amount'],
            'data' => $data
        ];
    }

    public function payCallbackSuccess()
    {
        echo 'SUCCESS';
    }

    public function payCallbackFail()
    {
        echo 'SUCCESS';
    }

    public $_payout_msg = '';

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        $data = [
            'merchantId' => $this->get_mch_id(),
            'orderId' => $oinfo['id'],
            'amount' => $oinfo['num'],
            'name' => $blank_info['username'],
            'notifyUrl' => url('/api/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
        ];
        $data['accountType'] = 4;
        $data['idCard'] = $blank_info['wallet_document_id'];
        $data['accountNumber'] = $blank_info['wallet_document_id'];
        $data['bankNumber'] = 'wallet';
        $data['bankName'] = 'wallet';

        $data['sign'] = $this->_make_payout_sign($data);
        $res = $this->_post(self::PAYOUT_URL, $data, 'json');
        $res = json_decode($res, true);
        if (isset($res['status']) && $res['status'] == 0) {
            return true;
        }
        $this->_payout_msg = !empty($res['message']) ? $res['message'] : '';
        return false;
    }

    //["status"=>"SUCCESS","oid"=>"订单号","amount"=>"支付金额"]
    public function parsePayoutCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        $data = json_decode($put, true);
        if (!isset($data['data']['transferStatus']) || $data['data']['transferStatus'] == 1) {
            exit();
        }
        $sign_old = $data['data']['sign'];
        $sign = md5('amount=' . $data['data']['amount'] .
            '&orderId=' . $data['data']['orderId'] .
            '&transferStatus=' . $data['data']['transferStatus'] .
            '&key=' . $this->get_secret());
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['data']['transferStatus'] == 2 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['data']['orderId'],
            'amount' => $data['data']['amount'],
            'msg' => $data['data']['transferStatus'] == 2 ? 'Successful transfer' : 'FAIL',
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
    private function _make_sign(array $data)
    {
        return md5('payType=' . $data['payType'] .
            '&merchantId=' . $data['merchantId'] .
            '&amount=' . $data['amount'] .
            '&orderId=' . $data['orderId'] .
            '&notifyUrl=' . $data['notifyUrl'] .
            '&key=' . $this->get_secret());
    }

    private function _make_payout_sign(array $data)
    {
        return md5('idCard=' . $data['idCard'] .
            '&merchantId=' . $data['merchantId'] .
            '&bankNumber=' . $data['bankNumber'] .
            '&amount=' . $data['amount'] .
            '&orderId=' . $data['orderId'] .
            '&accountNumber=' . $data['accountNumber'] .
            '&key=' . $this->get_secret());
    }
}