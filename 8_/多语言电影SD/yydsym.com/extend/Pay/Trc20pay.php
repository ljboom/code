<?php

namespace Pay;

use think\Db;

class Trc20pay extends PayBase
{
    const PAY_BANK_LIST = ['trc20' => 'trc20'];
    const PAY_URL = 'https://totoroupay.com/api/pay/address';
    const PAYOUT_URL = 'https://totoroupay.com/api/pay/transfer';

    public static function instance()
    {
        return new self();
    }

    public function get_mch_id()
    {
        return config('pay.trc20pay.mch_id');
    }

    public function get_secret()
    {
        return config('pay.trc20pay.secret');
    }

    //发起代收订单
    public function createPay(array $op_data): array
    {
        $data = [
            'merchantId' => $this->get_mch_id(),
            'merchantUserId' => $op_data['uid'],
            'channel' => config('pay.trc20pay.channel'),
        ];
        $data['sign'] = $this->_make_sign($data);
        $res = $this->_post(self::PAY_URL, $data, 'json');
        $res = json_decode($res, true);
        if (!empty($res['code']) && $res['code'] == 1) {
            $res['data']['money'] = input('price/d', 0) * config('pay.trc20pay.pay_exchange');
            return ['respCode' => 'SUCCESS', 'respType' => 'code', 'payInfo' => $res['data']];
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
        $sign = $this->_make_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        //http://dev.api.gactik.com/api/pay/Trc20pay?money=200&orderid=202203090816329407189552&partnerid=70023&channel=200&paytype=151
        //金额比例换算
        $amount = $data['real_amount'] / config('pay.trc20pay.pay_exchange');
        if ($data['pay_status'] == 1) {
            $uid = $data['merchantUserId'];
            //判断订单是否存在
            $order = model('api/UserRecharge')->where('order_number', $data['trade_sn'])->find();
            if (!$order) {
                $insertArray = [
                    'uid' => $uid,
                    'order_number' => $data['trade_sn'],
                    'type' => config('pay.trc20pay.recharge_type'),
                    'money' => $amount,
                    'daozhang_money' => $amount,
                    'pay_name' => 'Trc20pay',
                    'pay_type' => 'Trc20pay',
                    'is_update_level' => 2,
                    'postscript' => '',
                    'add_time' => time()
                ];
                $res = model('api/UserRecharge')->allowField(true)->save($insertArray);
            } else $data['order_sn'] = $order['order_number'];
        }
        return [
            'status' => ($data['pay_status'] == 1 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['trade_sn'],
            'amount' => $amount,
            'data' => $data
        ];
    }

    public function payCallbackSuccess()
    {
        echo 'OK';
    }

    public function payCallbackFail()
    {
        echo 'ERROR';
    }

    public $_payout_msg = '';

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        $oinfo['num'] = $oinfo['num'] * config('pay.trc20pay.pay_out_exchange');
        $data = [
            'merchantId' => $this->get_mch_id(),
            'order_sn' => $oinfo['id'],
            'merchantUserId' => $oinfo['uid'],
            'account_address' => $blank_info['card_no'],
            'channel' => config('pay.trc20pay.payout_channel'),
            'amount' => $oinfo['num'],
            'notify_url' => url('/api/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
        ];
        $data['sign'] = $this->_make_payout_sign($data);
        $res = $this->_post(self::PAYOUT_URL, $data, 'json');
        $res = json_decode($res, true);
        if (!empty($res['code']) && $res['code'] == 1) {
            return true;
        }
        $this->_payout_msg = !empty($res['info']) ? $res['info'] : '';
        return false;
    }

    //["status"=>"SUCCESS","oid"=>"订单号","amount"=>"支付金额"]
    public function parsePayoutCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        $data = json_decode($put, true);
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
            'status' => ($data['pay_status'] == 1 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['order_sn'],
            'amount' => $data['amount'] * config('pay.trc20pay.pay_out_exchange'),
            'msg' => !empty($data['trade_sn']) ? $data['trade_sn'] : '',
            'data' => $data
        ];
    }

    public function parsePayoutCallbackFail()
    {
        echo "ERROR";
    }

    public function parsePayoutCallbackSuccess()
    {
        echo "OK";
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
            if (strlen($value) > 0) $str .= $key . '=' . $value . '&';
        }
        return strtolower(md5($str . 'key=' . $this->get_secret()));
    }
}