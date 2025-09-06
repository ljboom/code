<?php

namespace app\api\controller;

use Pay\Tikpay;
use think\Controller;
use think\Db;
use think\Exception;
use think\facade\Env;

class CallbackController extends Controller
{
    public function tikpay_recharge()
    {
        $gateway = 'tikpay';
        $type = 0;
        $gateway = ucfirst($gateway);
        $log_file = Env::get('ROOT_PATH') . 'runtime/callback_pay_' . $gateway . '.log';
        $log_file_final = Env::get('ROOT_PATH') . 'runtime/callback_pay_' . $gateway . '_final.log';
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': ' . file_get_contents('php://input') . "\n", FILE_APPEND);
        $payObj = new Tikpay();
        $payout = $payObj->parsePayCallback($type);
        file_put_contents($log_file, '  ret:' . json_encode($payout, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);
        //处理回调逻辑
        $res = $this->checkCallbackOrder($payout, $log_file, $log_file_final);
        if ($res) {
            $payObj->payCallbackSuccess();
        } else {
            $payObj->payCallbackFail();
        }
        exit;
    }
    
    //统一代收回掉  通道 ， 渠道
    public function pay($gateway = '', $type = '')
    {
        if ($gateway == '') exit();
        $gateway = ucfirst($gateway);
        $log_file = APP_PATH . 'callback_pay_' . $gateway . '.log';
        $log_file_final = APP_PATH . 'callback_pay_' . $gateway . '_final.log';
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': ' . file_get_contents('php://input') . "\n", FILE_APPEND);
        if (!empty($_POST)) file_put_contents($log_file, date('Y-m-d H:i:s') . ': ' . json_encode($_POST) . "\n", FILE_APPEND);
        $className = "\\app\\index\\pay\\" . $gateway;
        $payObj = new $className();
        $payout = $payObj->parsePayCallback($type);
        file_put_contents($log_file, '  ret:' . json_encode($payout, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);
        //处理回调逻辑
        $res = $this->checkCallbackOrder($payout, $log_file, $log_file_final);
        if ($res) {
            $payObj->payCallbackSuccess();
        } else {
            $payObj->payCallbackFail();
        }
        exit;
    }
    //收款成功 回掉公共逻辑
    //$data = ['status'=>'SUCCESS',oid=>'订单号',amount=>'金额','data'=>'原始数据 array']
    // , $log_file="xxxx.log"
    // ,$log_file_final='xxx.log'
    /**
     * 收款成功 回掉公共逻辑
     * @param $data array
     * @param $log_file string
     * @param $log_file_final string
     * @return bool
     * */
    private function checkCallbackOrder($data, $log_file, $log_file_final)
    {
        file_put_contents($log_file, 'DATA ======' . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);
        if (!isset($data['status']) || !isset($data['oid']) ||
            !isset($data['amount']) || !isset($data['data'])) {
            //数据包格式不对
            file_put_contents($log_file, 'ERROR ' . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);
            return false;
        }
        $oinfo = Db::name('user_recharge')->where('order_number', $data['oid'])->find();
        if (!$oinfo) {
            file_put_contents($log_file, $data['oid'] . ' ======订单不存在!' . "\n", FILE_APPEND);
            return false;
        }
        if ($oinfo['state'] == 1) {
            return true;
        }
        if ($data['status'] != 'SUCCESS') {
            file_put_contents($log_file, $data['oid'] . ' ======ERROR' . "\n", FILE_APPEND);
            return false;
        }
        $user = Db::name('users')->where('id', $oinfo['uid'])->find();
        if (!$user) {
            file_put_contents($log_file, $data['oid'] . ' ======用户已被删除!' . "\n", FILE_APPEND);
            return false;
        }

        $balanceBefore = model('UserTotal')
            ->field('balance,total_balance,username')
            ->join('users', 'ly_user_total.uid=users.id', 'left')->where('ly_user_total.uid', '=', $oinfo['uid'])->findOrEmpty();

        Db::startTrans();
        try {
            model('UserTotal')
                ->where('uid', $oinfo['uid'])
                ->inc('balance', $data['amount'])
                ->inc('total_balance', $data['amount'])
                ->update();
            Db::name('user_recharge')
                ->where('id', $oinfo['id'])
                ->update([
                    'money' => $data['amount'],
                    'daozhang_money' => $data['amount'],
                    'state' => 1,
                    'dispose_time' => time()
                ]);

            //生成流水
            $tradeNumber = 'L' . trading_number();
            $tradeDetails = array(
                'uid' => $oinfo['uid'],
                'order_number' => $data['oid'],
                'trade_number' => $tradeNumber,
                'trade_type' => 1,
                'trade_before_balance' => $balanceBefore['balance'],
                'trade_amount' => $data['amount'],
                'account_balance' => $balanceBefore['balance'] + $data['amount'],
                'account_total_balance' => $balanceBefore['total_balance'] + $data['amount'],
                'remarks' => 'tikpay',
                'types' => 1,
            );
            model('common/TradeDetails')->tradeDetails($tradeDetails);
            //充值返点
            //hiton_promote
            model('api/UserRecharge')->recharge_setrebate([
                'num' => 1,
                'uid' => $user['id'],
                'sid' => $user['sid'],
                'order_number' => $tradeNumber,
                'commission' => $data['amount'],
            ]);
            Db::commit();
            file_put_contents($log_file, $data['oid'] . ' ======SUCCESS!' . "\n", FILE_APPEND);
            return true;
        } catch (Exception $e) {
            Db::rollback();
            file_put_contents($log_file, $data['oid'] . ' ======数据库插入失败!' . "\n", FILE_APPEND);
            file_put_contents($log_file_final, date('Y-m-d H:i:s') . ': ' . json_encode($data) . "\n", FILE_APPEND);
            file_put_contents($log_file_final, date('Y-m-d H:i:s') . ': ' . $e->getTraceAsString() . "\n", FILE_APPEND);
            return false;
        }
    }

    public function tikpay_payout()
    {
        $gateway = 'tikpay';
        $gateway = ucfirst($gateway);
        $log_file = Env::get('ROOT_PATH') . 'runtime/callback_payout_' . $gateway . '.log';
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': ' . file_get_contents('php://input') . "\n", FILE_APPEND);
        $payObj = new Tikpay();
        $result = $payObj->parsePayoutCallback();
        $res = $this->checkPayoutOrder($result, $log_file);
        if ($res) {
            $payObj->parsePayoutCallbackSuccess();
        } else {
            $payObj->parsePayoutCallbackFail();
        }
        exit;
    }
    //出款回掉公共逻辑==错误的情况
    //$data['status'=>'SUCCESS','oid'=>'','amount'=>'','msg'=>''] ,$log_file='xxx.log'
    private function checkPayoutOrder($data, $log_file)
    {
        file_put_contents($log_file, 'DATA ======' . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);
        if (!isset($data['status']) || !isset($data['oid']) ||
            !isset($data['amount']) || !isset($data['data']) || !isset($data['msg'])) {
            //数据包格式不对
            file_put_contents($log_file, '======DATA ERROR' . "\n", FILE_APPEND);
            return false;
        }
        //失败了  处理订单逻辑
        $oinfo = Db::name('user_withdrawals')->where('order_number', $data['oid'])->find();
        if (!$oinfo) {
            file_put_contents($log_file, $data['oid'] . ' ======提现订单不存在!' . "\n", FILE_APPEND);
            return false;
        }
        if ($oinfo['state'] != 3) {
        //if($oinfo['state'] == 1 || $oinfo['state'] == 2){//已经支付过的订单无法重复处理
            file_put_contents($log_file, $data['oid'] . ' ======订单状态不对!' . "\n", FILE_APPEND);
            return true;
        }
        if ($data['status'] == 'SUCCESS') {
            //更新提现订单
            model('manage/UserWithdrawals')
                ->where('order_number', $data['oid'])
                ->update([
                    'state' => 1,
                    'set_time' => time(),
                    'pay_msg' => $data['msg']
                ]);
            model('manage/UserWithdrawals')->paymentSuccess(['order_number' => $data['oid']]);
            file_put_contents($log_file, $data['oid'] . ' ======' . $data['status'] . "\n", FILE_APPEND);
            return true;
        } else {
            //出款失败
            model('manage/UserWithdrawals')->where('order_number', $data['oid'])->update([
                'state' => 5,
                'is_pay' => 2,
                'set_time' => time(),
                'pay_msg' => $data['msg'],
            ]);
            $orderInfo = $oinfo;
            //更新流水
            model('manage/TradeDetails')
                ->where('order_number', $orderInfo['order_number'])
                ->update(array('state' => 2, 'remarks' => '提现失败，资金已退回'));
            //获取用户余额
            $balance = model('manage/UserTotal')->field('balance')
                ->where('uid', $orderInfo['uid'])->find();
            //更新用户余额
            $odd_money = $orderInfo['price'] + $orderInfo['fee'];
            model('manage/UserTotal')
                ->where('uid', $orderInfo['uid'])
                ->inc('balance', $odd_money)
                ->update();
            $remarks = (isset($param['remarks']) && $param['remarks'] && $param['remarks'] !== $orderInfo['remarks']) ? $param['remarks'] : '订单 ' . $orderInfo['order_number'] . ' 取款失败，退回资金：' . $odd_money;
            $tradeDetailsArray = array(
                'uid' => $orderInfo['uid'],
                'order_number' => $orderInfo['order_number'],
                'trade_type' => 13,
                'trade_before_balance' => $balance['balance'],
                'trade_amount' => $odd_money,
                'account_balance' => $balance['balance'] + $odd_money,
                'remarks' => $remarks,
                'isadmin' => 1,
            );
            model('common/TradeDetails')->tradeDetails($tradeDetailsArray);
            //添加操作日志
            model('manage/Actionlog')->actionLog('system', '处理订单号为' . $orderInfo['order_number'] . '的提现订单。处理状态：拒绝支付', 1);

        }
        file_put_contents($log_file, $data['oid'] . ' ======' . $data['status'] . "\n", FILE_APPEND);
        return false;
    }

    /*
    //统一代收回掉  通道 ， 渠道
    public function pay($gateway = '', $type = '')
    {
        if ($gateway == '') exit('no gateway');
        $gateway = ucfirst($gateway);
        $log_file = Env::get('ROOT_PATH') . 'runtime/callback_pay_' . $gateway . '.log';
        $log_file_final = Env::get('ROOT_PATH') . 'runtime/callback_pay_' . $gateway . '_final.log';
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': ' . file_get_contents('php://input') . "\n", FILE_APPEND);
        $className = "\\Pay\\" . $gateway;
        $payObj = new $className();
        file_put_contents($log_file, 'start callback' . "\n", FILE_APPEND);
        $payout = $payObj->parsePayCallback($type);
        file_put_contents($log_file, '  ret:' . json_encode($payout, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);
        //处理回调逻辑
        $res = $this->checkCallbackOrder($payout, $log_file, $log_file_final);
        if ($res) {
            $payObj->payCallbackSuccess();
        } else {
            $payObj->payCallbackFail();
        }
        exit;
    }
    */
    //统一代付回掉  通道，渠道
    public function payout($gateway = '', $type = '')
    {
        if ($gateway == '') exit('');
        $gateway = ucfirst($gateway);
        $log_file = Env::get('ROOT_PATH') . 'runtime/callback_payout_' . $gateway . '.log';
        $log_file_final = Env::get('ROOT_PATH') . 'runtime/callback_payout_' . $gateway . '_final.log';
        file_put_contents($log_file, date('Y-m-d H:i:s') . ': ' . file_get_contents('php://input') . "\n", FILE_APPEND);
        $className = "\\Pay\\" . $gateway;
        $payObj = new $className();
        $result = $payObj->parsePayoutCallback();
        $res = $this->checkPayoutOrder($result, $log_file);
        if ($res) {
            $payObj->parsePayoutCallbackSuccess();
        } else {
            $payObj->parsePayoutCallbackFail();
        }
        exit;
    }

}