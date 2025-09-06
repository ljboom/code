<?php

namespace Pay;

use think\Db;
use think\facade\Env;

class Guaranapay extends PayBase
{
    const PAY_URL = 'https://gateway.guaranapay.com/pg/dk/order/create';
    const PAYOUT_URL = 'https://gateway.guaranapay.com/pg/dk/payout/create';

    public static function instance()
    {
        return new self();
    }

    public function getConfig($param)
    {
        return config('pay.guaranapay.' . $param);
    }

    public function get_mch_id()
    {
        return $this->getConfig('mch_id');
    }

    public function get_secret()
    {
        return $this->getConfig('secret');
    }

    public function get_secret_key16()
    {
        return substr($this->get_secret(), 0, 16);
    }

    //发起代收订单
    public function createPay(array $op_data): array
    {
        $oUser = Db::name('users')->where('id', $op_data['uid'])->find();
        $userName = preg_replace("/\\d+/", '', $oUser['username']);
        if (!$userName) $userName = $this->randUsername();
        $data = [
            'version' => '1.1',
            'amount' => $op_data['amount'],
            'appId' => $this->get_mch_id(),
            'country' => $this->getConfig('country'),
            'currency' => $this->getConfig('currency'),
            'extInfo' => [
                'paymentTypes' => 'credit,debit,ewallet,upi'
            ],
            'merTransNo' => $op_data['sn'],
            'notifyUrl' => url('/api/callback/pay', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
                'type' => input('get.type/d', 0)
            ], true, true),
            'returnUrl' => url('/', '', true, true),
            'userId' => $op_data['uid'],
        ];
        $data['sign'] = $this->_make_sign($data);
        $res = $this->_post(self::PAY_URL, $data, 'json');
        $res = json_decode($res, true);
        $log_file = Env::get('ROOT_PATH') . 'runtime/Guaranapay_recharge.log';
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': POST ' . json_encode($data) . "\n", FILE_APPEND);
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': RESULT ' . json_encode($res) . "\n", FILE_APPEND);

        if (isset($res['code']) && $res['code'] == 200) {
            return ['respCode' => 'SUCCESS', 'payInfo' => $res['data']['url']
            ];
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
        parse_str($put, $data);
        if (!isset($data['sign'])) exit();
        $sign = $this->_make_sign($data);
        if ($sign != $data['sign']) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        $data['transStatus'] = strtolower($data['transStatus']);
        if (!in_array($data['transStatus'], ['success', 'failure'])) {
            return ['status' => 'FAIL', 'msg' => '状态错误', 'data' => $data];
        }
        return [
            'status' => ($data['transStatus'] == 'success' ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['merTransNo'],
            'amount' => $data['processAmount'],
            'data' => $data,
            'msg' => !empty($data['transNo']) ? $data['transNo'] : '',
        ];
    }

    public function payCallbackSuccess()
    {
        echo 'success';
    }

    public function payCallbackFail()
    {
        echo 'fail';
    }

    public $_payout_msg = '';

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        $data = [
            'amount' => $oinfo['num'],
            'appId' => $this->getConfig('payout_mch_id'),
            'currency' => $this->getConfig('currency'),
            'merTransNo' => $oinfo['id'],
            'notifyUrl' => url('/api/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
            'pmId' => 'CPF',
            'extInfo' => [
                'accountNumber' => $blank_info['wallet_document_id'],
                'accountHolderName' => $blank_info['username'],
                'document' => $blank_info['wallet_document_id']
            ],
        ];
        if (strlen($blank_info['wallet_document_id']) == 36
            && strpos($blank_info['wallet_document_id'], '-') > 0) {
            $data['pmId'] = 'EVP';
        }
        if (strpos($blank_info['wallet_document_id'], '@') > 0) {
            $data['pmId'] = 'EMAIL';
        }
        if ($blank_info['wallet_document_id'] == $blank_info['mobile']) {
            $data['pmId'] = 'PHONE';
        }
        if (substr($blank_info['wallet_document_id'], 0, 3) == '+55') {
            $data['pmId'] = 'PHONE';
        }
        if ($data['pmId'] == 'PHONE'
            && substr($blank_info['wallet_document_id'], 0, 3) != '+55') {
            $data['extInfo']['accountNumber'] = '+55' . $blank_info['wallet_document_id'];
            $data['extInfo']['document'] = '+55' . $blank_info['wallet_document_id'];
        }
        $data['sign'] = $this->_make_payout_sign($data);
        $res = $this->_post(self::PAYOUT_URL, $data, 'json');
        $res = json_decode($res, true);

        $log_file = Env::get('ROOT_PATH') . 'runtime/Guaranapay_payout.log';
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': POST ' . json_encode($data) . "\n", FILE_APPEND);
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': RESULT ' . json_encode($res) . "\n", FILE_APPEND);

        if (isset($res['code']) && $res['code'] == 200) {
            return true;
        }
        $this->_payout_msg = !empty($res['data']['message']) ? $res['data']['message'] : json_encode($res);
        return false;
    }

    //["status"=>"SUCCESS","oid"=>"订单号","amount"=>"支付金额"]
    public function parsePayoutCallback($type = ''): array
    {
        $put = file_get_contents('php://input');
        parse_str($put, $data);
        if (empty($data)) $data = $_POST;
        if (empty($data['sign'])) {
            exit();
        }
        $sign_old = $data['sign'];
        $sign = $this->_make_payout_sign($data);
        if ($sign_old != $sign) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        $data['tradeStatus'] = strtolower($data['tradeStatus']);
        if (!in_array($data['tradeStatus'], ['success', 'failure'])) {
            return ['status' => 'FAIL', 'msg' => '状态错误', 'data' => $data];
        }
        return [
            'status' => ($data['tradeStatus'] == 'success' ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['merTransNo'],
            'amount' => $data['amount'],
            'msg' => !empty($data['tradeNo']) ? $data['tradeNo'] : '',
            'data' => $data
        ];
    }

    public function parsePayoutCallbackFail()
    {
        echo 'fail';
    }

    public function parsePayoutCallbackSuccess()
    {
        echo 'success';
    }

    //数据签名
    public function _make_sign($data)
    {
        return GuaranapaySign::create($this->get_secret(), $data);
    }

    public function _make_payout_sign($data)
    {
        return GuaranapaySign::create($this->getConfig('payout_secret'), $data);
    }
}

class GuaranapaySign
{

    const SIGN = 'sign';
    const KEY = 'key';
    const EXT = 'extInfo';

    public static function create($appSecret, $map)
    {
        $signStr = self::createSignStr($appSecret, $map);
        return hash('sha256', $signStr);
    }

    public static function createSignStr($appSecret, $map)
    {
        $signStr = self::joinMap($map);
        $signStr .= '&' . self::KEY . '=' . $appSecret;
        return $signStr;
    }

    private static function prepareMap($map)
    {
        if (!is_array($map)) {
            return array();
        }
        if (array_key_exists(self::SIGN, $map)) {
            unset($map[self::SIGN]);
        }
        ksort($map);
        reset($map);
        return $map;
    }

    private static function joinMap($map)
    {
        if (!is_array($map)) return '';
        $map = self::prepareMap($map);
        $pair = array();
        foreach ($map as $key => $value) {
            if (self::isIgnoredItem($key, $value)) continue;
            $tmp = $key . '=';
            if (0 === strcmp(self::EXT, $key)) {
                $tmp .= self::joinMap($value);
            } else {
                $tmp .= $value;
            }
            $pair[] = $tmp;
        }
        if (empty($pair)) return '';
        return join('&', $pair);
    }

    private static function isIgnoredItem($key, $value)
    {
        if (empty($key) || empty($value)) return true;
        if (0 === strcmp(self::SIGN, $key)) return true;
        if (0 === strcmp(self::EXT, $key)) return false;
        if (is_string($value)) return false;
        if (is_numeric($value)) return false;
        if (is_bool($value)) return false;
        return true;
    }
}