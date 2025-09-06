<?php

namespace app\api\controller;

use think\Controller;
use think\Db;

class YuebaoController extends Controller
{
    //初始化方法
    protected function initialize()
    {
        parent::initialize();
        header('Access-Control-Allow-Origin:*');
        //header('Access-Control-Allow-Credentials: true');
        //header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authKey, sessionId");
    }


    /**  获取活动列表  **/
    public function getYuebaoList()
    {
        $data = model('Yuebao')->getYuebaoList();
        return json($data);
    }


    /**  获取用户活动记录列表  **/
    public function getUserYuebaoList()
    {
        $data = model('Yuebao')->getUserYuebaoList();
        return json($data);
    }

    /*购买活动
     * userid   用户ID
     * money    金额
     * yuebaoid   产品IP
    */
    public function payYuebao()
    {
        if ($this->request->isPost()) {
            $postData = $this->request->post();
            $checkYuebao = Db::table('ly_yuebao_list')->where(array('id' => $postData['yuebaoid']))->find();
            if ($checkYuebao === NULL) {
                return json(array('errorCode' => 201, 'errorMsg' => 'no product'));
            }
            //余额宝开关
            if ($checkYuebao['stat'] === 2) {
                return json(array('errorCode' => 201, 'errorMsg' => 'quota está cheia'));//名额已满
            }
            //检查购买次数
            $uid           = $postData['userid'];
            $yuebaoid      = $postData['yuebaoid'];
            $count_paynum  = Db::table('ly_yuebao_pay')->where('uid', $uid)->where('yuebaoid', $yuebaoid)->count('id');
            if($count_paynum && $count_paynum > $checkYuebao['buy_num']){
                if($checkYuebao['buy_num'] != 0) return json(array('errorCode' => 201, 'errorMsg' => 'Excede as compras disponíveis'));//超出购买次数
            }
            
            $postData['money'] = floatval($postData['money']);
            if ($postData['money'] < $checkYuebao['min_money']) {
                return json(array('errorCode' => 201, 'errorMsg' => 'min ' . $checkYuebao['min_money']));
            }
            // var_dump($checkYuebao['stat']);
            // die;

            $getUserTotal = Db::table('ly_user_total')->where(array('uid' => $postData['userid']))->find();
            if ($getUserTotal === NULL || $getUserTotal['balance'] < $postData['money']) {
                return json(array('errorCode' => 201, 'errorMsg' => 'Desculpe, seu crédito está acabando.'));//用户余额不足
            }

            $insertData = array(
                'uid' => $postData['userid'],
                'yuebaoid' => $postData['yuebaoid'],
                'lilv' => $checkYuebao['lilv'],
                'money' => $postData['money'],
                'daynum' => $checkYuebao['time'],
                'start_time' => date('Y-m-d H:i:s', time()),
                'end_time' => date('Y-m-d H:i:s', time() + ($checkYuebao['time'] * 86400)),
                'status' => 1,
            );
            Db::startTrans();
            $yuebaoPayStatus = Db::table('ly_yuebao_pay')->insert($insertData);
            if ($yuebaoPayStatus !== 1) {
                Db::rollback();
                return json(array('errorCode' => 201, 'errorMsg' => 'network error'));
            }

            //增加购买批次
            $payid = Db::table('ly_yuebao_pay')->getLastInsID();//获取购买id
            
            //查询批次
            $batch = date('Ymd',time());
            $b_array = Db::table('ly_yuebao_batch')->where('uid', $uid)->where('pid', $yuebaoid)->where('is_back', 0)->find();
            if($b_array['batch']){
                $nowtime = time();
                if($nowtime <= $b_array['endtime']){//当前时间
                    $batch = $b_array['batch'];
                    //更新数据
                    $up_batch_array = array(
                        'money'    => $b_array['money'] + $postData['money']
                    );
                    $bid = $b_array['id'];
                    Db::table('ly_yuebao_batch')->where('id', $bid)->update($up_batch_array);
                }else{
                    $in_batch_array = array(
                        'uid'       => $uid,
                        'pid'       => $yuebaoid,
                        'batch'     => $batch,
                        'buytime'   => time(),
                        'starttime' => time(),
                        'endtime'   => time() + ($checkYuebao['time'] * 86400),
                        'money'     => $postData['money'],
                        'lilv'      => $checkYuebao['lilv'],
                        'income'    => 0,
                        'is_back'   => 0,
                        'days'      => 0
                    );
                    Db::table('ly_yuebao_batch')->insert($in_batch_array);
                }
            }else{
                $in_batch_array = array(
                    'uid'       => $uid,
                    'pid'       => $yuebaoid,
                    'batch'     => $batch,
                    'buytime'   => time(),
                    'starttime' => time(),
                    'endtime'   => time() + ($checkYuebao['time'] * 86400),
                    'money'     => $postData['money'],
                    'lilv'      => $checkYuebao['lilv'],
                    'income'    => 0,
                    'is_back'   => 0,
                    'days'      => 0
                );
                Db::table('ly_yuebao_batch')->insert($in_batch_array);
            }
            Db::table('ly_yuebao_pay')->where('id', $payid)->update(array('days' => $batch));
            //购买成功扣减余额
            $balance = $getUserTotal['balance'] - $postData['money'];
            $userTotalStatus = Db::table('ly_user_total')->where(array('id' => $getUserTotal['id']))->update(array('balance' => $balance));
            if ($userTotalStatus !== 1) {
                Db::rollback();
                return json(array('errorCode' => 201, 'errorMsg' => 'network error 2'));
            }
            Db::commit();
            return json(array('errorCode' => 200, 'errorMsg' => '', 'successMsg' => 'sucesso'));//sucesso购买成功
        }
    }

    /* 余额宝金额
     * userid   用户ID
    */
    public function showMoney()
    {
        if ($this->request->isPost()) {
            $userid = $this->request->post('userid');
            $moneySum = Db::table('ly_yuebao_pay')->where(array('uid' => $userid, 'status' => 1))->sum('money');
            return json(array('errorCode' => 200, 'data' => $moneySum));
        }
    }
    
    
    /**
     * 提前赎回
    */
    
    public function redemption()
    {
        if ($this->request->isPost()) {
            $id = $this->request->post('id');
            
            $batch                = Db::table('ly_yuebao_batch')->where('id', $id)->find();
            if(!$batch)             return json(array('errorCode' => 201, 'data' => 'lote de itens não existe'));
            
            $getUsers             = Db::table('ly_users')->field('id,sid,username')->where('id', $batch['uid'])->find();
            if(!$getUsers)          return json(array('errorCode' => 201, 'data' => 'Usuário não existe'));
            
            $getUserTotal         = Db::table('ly_user_total')->where('uid',  $batch['uid'])->find();
            if(!$getUserTotal)      return json(array('errorCode' => 201, 'data' => 'A conta de usuário não existe'));
            
            $list                 = Db::table('ly_yuebao_list')->where('id', $batch['pid'])->find();
            if(!$list)               return json(array('errorCode' => 201, 'data' => 'item não existe'));
            
            if($batch['is_back']) return json(array('errorCode' => 201, 'data' => 'O projeto foi resgatado, não envie novamente'));
            
            //是否满足追回最低天数
            if($batch['days'] >= $list['min_time']){
                //本金+利润
                $allmoney = $batch['money'] + $batch['income'];
                //增加余额
                $balance = $getUserTotal['balance'] + $allmoney;
                $userTotalStatus = Db::table('ly_user_total')->where(array('id' => $getUserTotal['id']))->update(array('balance' => $balance));
                if ($userTotalStatus !== 1) {
                    return json(array('errorCode' => 201, 'data' => 'Falha na alteração do saldo da conta'));
                }
                //增加流水
                $financialArray = [];
                $financialArray['uid'] = $getUsers['id'];
                $financialArray['sid'] = $getUsers['sid'];
                $financialArray['username'] = $getUsers['username'];
                $financialArray['order_number'] = 'Y' . trading_number();
                $financialArray['trade_number'] = 'L' . trading_number();
                $financialArray['trade_type'] = 16;
                $financialArray['trade_before_balance'] = $getUserTotal['balance'];
                $financialArray['trade_amount'] = $allmoney;
                $financialArray['account_balance'] = $balance;
                $financialArray['remarks'] = '收益宝赎回 收益宝产品 ID'.$batch['pid'];
                $financialArray['types'] = 1;    // 用户1，商户2
    
                model('common/TradeDetails')->tradeDetails($financialArray);
                //修改批次状态为已追回
                Db::table('ly_yuebao_batch')->where('id', $id)->update(array('is_back'=>1));
                //修改购买明细状态
                Db::table('ly_yuebao_pay')
                    ->where('uid',$batch['uid'])
                    ->where('yuebaoid', $batch['pid'])
                    ->where('days', $batch['batch'])
                    ->update(array('status' => 2));
                    
                return json(array('errorCode' => 200, 'errorMsg' => '', 'successMsg' => 'sucesso'));
                //
            }else{
                return json(array('errorCode' => 201, 'data' => 'Temporariamente irresgatável'));
            }

            
        }
    }
}
