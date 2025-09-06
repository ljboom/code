<?php

namespace Pay;

use think\Db;
use think\facade\Env;

class Sexypay extends PayBase
{
    const PAY_URL = 'http://brasil.yunbao2019.cn/seapay.php?a=payBx';
    const PAYOUT_URL = 'http://brasil.yunbao2019.cn/seapay.php?a=orderBx';
    const BANK_URL = 'http://brasil.yunbao2019.cn/seapay.php?a=bank';

    public static function instance()
    {
        return new self();
    }

    public function getConfig($param)
    {
        $type = input('get.type/d', 0);
        if ($type == 0) {
            return config('pay.sexypay.' . $param);
        }
        return config('pay.sexypay.type.t' . $type . '.' . $param);
    }

    public function get_mch_id()
    {
        return $this->getConfig('mch_id');
    }

    public function get_secret()
    {
        return $this->getConfig('secret');
    }

    public function getBankList()
    {
        $res = $this->_post(self::BANK_URL, [], 'json', [
            'Authorization: ' . $this->_make_sign([]),
            'AppId: ' . $this->get_mch_id()
        ]);
        $res = json_decode($res, true);
        foreach ($res['msg']['bank'] as $v) {
            echo $v['bankCode'], '|', $v['bankName'], "\n";
        }
    }

    //发起代收订单
    public function createPay(array $op_data): array
    {
        $oUser = Db::name('users')->where('id', $op_data['uid'])->find();
        $userName = preg_replace("/\\d+/", '', $oUser['username']);
        if (!$userName) $userName = $this->randUsername();
        $data = [
            'orderNo' => $op_data['sn'],
            'monto' => $op_data['amount'],
            'phone' => $oUser['phone'],
            'notifyUrl' => url('/api/callback/pay', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
                'type' => input('get.type/d', 0)
            ], true, true),
        ];
        $res = $this->_post(self::PAY_URL, $data, 'json', [
            'Authorization: ' . $this->_make_sign($data),
            'AppId: ' . $this->get_mch_id()
        ]);
        $res = json_decode($res, true);
        if (isset($res['code']) && $res['code'] == 200) {
            return ['respCode' => 'SUCCESS', 'payInfo' => $res['msg']['barcode_url']];
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
        $authorization = $_SERVER["HTTP_AUTHORIZATION"];
        $firstMd5 = md5($put);
        $authorizations = md5($firstMd5 . $this->get_secret());
        if ($authorizations != $authorization) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data["status"] == 1 || $data["status"] == 3) ? 'SUCCESS' : 'ERROR',
            'oid' => $data['orderNo'],
            'amount' => $data['monto'],
            'data' => $data
        ];
    }

    public function payCallbackSuccess()
    {
        echo '{"code": 200}';
    }

    public function payCallbackFail()
    {
        echo 'error';
    }

    public $_payout_msg = '';

    public function create_payout(array $oinfo, array $blank_info): bool
    {
        $data = [
            'name' => $blank_info['username'],
            'orderNo' => $oinfo['id'],
            'monto' => floatval($oinfo['num']),
            'bankNum' => $blank_info['wallet_document_id'],
            'bankIFSC' => '100',
            'bankType' => 'CPF',
            'notifyUrl' => url('/api/callback/payout', [
                'gateway' => (new \ReflectionClass(__CLASS__))->getShortName(),
            ], true, true),
        ];
        //巴西参数
        if (strlen($blank_info['wallet_document_id']) == 36
            && strpos($blank_info['wallet_document_id'], '-') > 0) {
            $data['bankType'] = 'EVP';
        }
        if (strpos($blank_info['wallet_document_id'], '@') > 0) {
            $data['bankType'] = 'EMAIL';
        }
        if ($blank_info['wallet_document_id'] == $blank_info['mobile']) {
            //$data['bankType'] = 'PHONE';
        }
        if (substr($blank_info['wallet_document_id'], 0, 3) == '+55') {
            $data['bankType'] = 'PHONE';
            //$blank_info['wallet_document_id'] = str_replace('+', '', $blank_info['wallet_document_id']);
        }
        if (substr($blank_info['wallet_document_id'], 2, 1) == '9') {
            $data['bankType'] = 'PHONE';
            $blank_info['wallet_document_id'] = '+55' . $blank_info['wallet_document_id'];
        }
        if ($data['bankType'] == 'PHONE' && strlen($blank_info['wallet_document_id']) == 11) {
            $blank_info['wallet_document_id'] = '+55' . $blank_info['wallet_document_id'];
        }
        $data['bankNum'] = $blank_info['wallet_document_id'];
        $res = $this->_post(self::PAYOUT_URL, $data, 'json', [
            'Authorization:' . $this->_make_payout_sign($data),
            'AppId:' . $this->get_mch_id()
        ]);

        $log_file = Env::get('ROOT_PATH') . 'runtime/Sexypay_payout.log';
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': POST ' . json_encode($data) . "\n", FILE_APPEND);
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': RESULT ' . $res . "\n", FILE_APPEND);

        $res = json_decode($res, true);
        if (isset($res['code']) && $res['code'] == 200) {
            return true;
        }
        $this->_payout_msg = (is_array($res) ? json_encode($res, JSON_UNESCAPED_UNICODE) : $res) . '====' . json_encode($data);
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
        $authorization = $_SERVER["HTTP_AUTHORIZATION"];
        $firstMd5 = md5($put);
        $authorizations = md5($firstMd5 . $this->get_secret());
        if ($authorizations != $authorization) {
            return ['status' => 'FAIL', 'msg' => '签名错误', 'data' => $data];
        }
        return [
            'status' => ($data['status'] == 1 ? 'SUCCESS' : 'FAIL'),
            'oid' => $data['orderNo'],
            'amount' => $data['monto'],
            'msg' => !empty($data['Success']) ? $data['Success'] : '',
            'data' => $data
        ];
    }

    public function parsePayoutCallbackFail()
    {
        echo "error";
    }

    public function parsePayoutCallbackSuccess()
    {
        echo '{"code": 200}';
    }


    /**
     * 创建签名
     * @param $data array  数据包
     * @return string
     */
    private function _make_sign(array $data)
    {
        $firstMd5 = md5(json_encode($data));
        return md5($firstMd5 . $this->get_secret());
    }

    private function _make_payout_sign(array $data)
    {
        $firstMd5 = md5(json_encode($data));
        return md5($firstMd5 . $this->get_secret());
    }
}