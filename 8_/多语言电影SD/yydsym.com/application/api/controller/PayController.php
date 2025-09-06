<?php

namespace app\api\controller;

use Pay\Tikpay;
use think\Controller;
use think\Exception;

class PayController extends Controller
{

    /** 充值————生成充值订单信息 **/
    /*public function tikpay()
    {
        //uid=105&typeid=117&bid=3658&scanType=PIX&price=100
        $insertArray = [
            'uid' => input('uid/d', 0),
            'order_number' => trading_number(),
            'type' => input('typeid/d', 0),
            'money' => input('price/d', 0),
            'postscript' => input('scanType/s', ''),
            'add_time' => time()
        ];
        $res = model('UserRecharge')->allowField(true)->save($insertArray);
        if (!$res) exit();
        $op_data = [
            'uid' => $insertArray['uid'],
            'sn' => $insertArray['order_number'],
            'amount' => $insertArray['money']
        ];
        $pay = new Tikpay();
        $resData = $pay->createPay($op_data);
        if ($resData['respCode'] != 'SUCCESS') {
            echo '<h4 style="text-align: center">ERROR</h4>' . "\n";
            echo '<div style="display: none">' . json_encode($resData) . '</div>';
            exit;
        }
        header('Location:' . $resData['payInfo']);
    }*/

    private function _getOrder($pay_type = '')
    {
        $insertArray = [
            'uid' => input('uid/d', 0),
            'order_number' => trading_number(),
            'type' => input('typeid/d', 0),
            'money' => input('price/d', 0),
            'pay_name' => $pay_type,
            'postscript' => input('scanType/s', ''),
            'add_time' => time()
        ];
        $res = model('UserRecharge')->allowField(true)->save($insertArray);
        if (!$res) exit();
        //汇率转换
        $exchange = model('RechangeType')->where('id', $insertArray['type'])->value('exchange');
        if(!$exchange) $exchange = 1;
        return [
            'uid' => $insertArray['uid'],
            'sn' => $insertArray['order_number'],
            'amount' => $insertArray['money'] / $exchange,
        ];
    }

    public function _empty($name)
    {
        try {
            $className = "\\Pay\\" . $name;
            if (!class_exists($className)) {
                exit('no pay type');
            }
            $pay = new $className();
            $op_data = $this->_getOrder($name);
            //汇率转换
            
            //
            $bid  = input('get.bid/d', 0);
            if($bid == 10 ){
                $op_data['busi_code'] = '101202';
            }
            if($bid == 12){
                $op_data['busi_code'] = '101204';
            }
            //
            $resData = $pay->createPay($op_data);
            if ($resData['respCode'] != 'SUCCESS') {
                echo '<h4 style="text-align: center">ERROR</h4>' . "\n";
                echo '<div style="display: none">' . json_encode($resData) . '</div>';
                exit;
            }
            if($name=='Trc20pay'){
                $this->assign('resData',$resData);
                return $this->fetch('trc20pay');
            }
            header('Location:' . $resData['payInfo']);
        } catch (Exception $e) {
            exit();
        }
    }
}