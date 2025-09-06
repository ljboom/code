<?php

namespace app\create\controller;

use think\Controller;
use think\Db;

class IndexController extends Controller
{

    public function initialize()
    {
        header('Access-Control-Allow-Origin:*');
    }

    /**
     * 自动审核
     * @return [type] [description]
     */
    public function autoAudit()
    {
        $isAutoAudit = model('Setting')->where('id', '>', 0)->value('auto_audit');
        if ($isAutoAudit == 2 || !$isAutoAudit || is_null($isAutoAudit)) return 0;

        $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $yesterday = $today - 86400;

        //$taskList = model('UserTask')->field('ly_user_task.id,ly_user_task.examine_demo,task_id')->join('task','ly_user_task.task_id=task.id')->where([['ly_user_task.status','=',2],['task.uid','=',0]])->whereTime('trial_time', '>=', $yesterday)->select()->toArray();

        $taskList = model('UserTask')
            ->field('id,examine_demo,task_id')
            ->where([['status', '=', 2], ['trial_remarks', '<>', '云管家']])
            ->whereTime('trial_time', '>=', $yesterday)
            ->limit(50)
            ->select()
            ->toArray();
        /*$taskList = model('UserTask')
            ->field('ly_user_task.id,ly_user_task.examine_demo,task_id')
            ->join('task', 'ly_user_task.task_id=task.id')
            ->where([
                ['ly_user_task.status', '=', 2],
                ['ly_user_task.trial_remarks', '<>', '云管家'],
            ])
            ->whereTime('trial_time', '>=', $yesterday)
            ->limit(50)
            ->select()
            ->toArray();*/
        if (!$taskList) return 0;

        $i = 0;
        foreach ($taskList as $key => $value) {
            $i++;
            $status = ($value['examine_demo']) ? 3 : 4;
            // 修改任务订单状态
            $res = model('UserTask')->where('id', $value['id'])->update([
                'status' => $status,
                'handle_time' => time(),
                'complete_time' => time()
            ]);

            if ($status == 4) {
                model('Task')
                    ->where('id', $value['task_id'])
                    ->dec('receive_number')
                    ->inc('surplus_number')
                    ->update();
                continue;
            }
            // 订单信息
            $taskInfo = model('UserTask')
                ->field([
                    'ly_user_task.status',
                    'ly_user_task.uid',
                    'ly_user_task.task_id',
                    'task.order_number',
                    'ly_user_task.task_reward_price as reward_price',
                    'task.total_number',
                ])
                ->join('task', 'task.id=ly_user_task.task_id')
                ->where([
                    ['ly_user_task.id', '=', $value['id']]
                ])
                ->find();
            // 单价为零则跳出本次循环
            if ($taskInfo['reward_price'] <= 0) continue;
            // 获取用户信息
            $userInfo = model('Users')
                ->field('ly_users.id,ly_users.vip_level,username,sid,user_total.balance')
                ->join('user_total', 'ly_users.id=user_total.uid')
                ->where('ly_users.id', $taskInfo['uid'])
                ->find();
            if (!$userInfo) {
                model('UserTask')->where('id', $value['id'])->update(['status' => 2, 'complete_time' => 0]);
                continue;
            }
            
            // 加余额
            $incUserBalance = model('UserTotal')->where('uid', $userInfo['id'])->inc('balance', $taskInfo['reward_price'])->inc('total_balance', $taskInfo['reward_price'])->update();
            if (!$incUserBalance) {
                model('UserTask')->where('id', $value['id'])->update(['status' => 2, 'complete_time' => 0]);
                continue;
            }
            // 流水
            $financialArray = [];
            $financialArray['uid'] = $userInfo['id'];
            $financialArray['sid'] = $userInfo['sid'];
            $financialArray['username'] = $userInfo['username'];
            $financialArray['order_number'] = $taskInfo['order_number'];
            $financialArray['trade_number'] = 'L' . trading_number();
            $financialArray['trade_type'] = 6;
            $financialArray['trade_before_balance'] = $userInfo['balance'];
            $financialArray['trade_amount'] = $taskInfo['reward_price'];
            $financialArray['account_balance'] = $userInfo['balance'] + $taskInfo['reward_price'];
            $financialArray['remarks'] = '完成任务';
            $financialArray['types'] = 1;    // 用户1，商户2

            model('common/TradeDetails')->tradeDetails($financialArray);
            

            
            //已经完成的 和 总的任务数 一样 更新任务 完成

            $finishNumber = model('UserTask')->where(array(['task_id', '=', $taskInfo['task_id']], ['status', '=', 3]))->count();
            if ($finishNumber == $taskInfo['total_number']) {
                model('Task')->where(array(['id', '=', $taskInfo['task_id']], ['status', '=', 3]))->update(['status' => 4, 'complete_time' => time()]);
            }

            //上级返点
            if ($userInfo['sid'] && $userInfo['vip_level'] > 1) {
                $rebatearr = array(
                    'num' => 1,
                    'uid' => $userInfo['id'],
                    'sid' => $userInfo['sid'],
                    'order_number' => $taskInfo['order_number'],
                    'commission' => $taskInfo['reward_price'],
                );

                model('manage/Task')->setrebate($rebatearr, $userInfo['vip_level']);
            }

            //更新每日完成任务次数
            $UserDailydata = array(
                'uid' => $userInfo['id'],
                'username' => $userInfo['username'],
                'field' => 'w_t_o_n',//完成
                'value' => 1,
            );

            model('common/UserDaily')->updateReportfield($UserDailydata);
            
            //自动购买收益宝产品
            if($userInfo['vip_level'] > 1) $this->shouyibao($userInfo['id'], $taskInfo['reward_price']);

        }

        return PHP_EOL . count($taskList) . '====' . $i . PHP_EOL;
    }
    
    /****
     * 收益宝自动购买
     */
    public function shouyibao($uid, $prices)
    {
        //查询用户信息
        $getUserTotal = Db::table('ly_user_total')->where(array('uid' => $uid))->find();
        $getUsers     = Db::table('ly_users')->field('id,sid,username')->where('id', $uid)->find();
        if(!$getUsers)     return PHP_EOL . "未查询到用户ID：$uid 的个人信息，自动购入失败" . PHP_EOL;
        if(!$getUserTotal) return PHP_EOL . "未查询到用户ID：$uid 的账户信息，自动购入失败" . PHP_EOL;
        //查询可用收益宝产品
        $shouyibao = Db::table('ly_yuebao_list')
            ->where('stat', 1)//开启中
            ->where('is_deposit', 1)//可自动购买
            ->select();
        if($shouyibao)
        {
            foreach($shouyibao as $key => $val)
            {
                //查询批次信息
                $batch = date('Ymd', time());
                $nowtime = time();
                $is_batch_cmd = 0;
                $in_batch_array = $up_batch_array = array();
                $batch_array = Db::table('ly_yuebao_batch')->where('uid', $uid)->where('pid', $val['id'])->where('is_back', 0)->find();
                if($batch_array)
                {
                    if($nowtime <= $batch_array['endtime'] - 86400)//结束前一天截止购买
                    {
                        $batch = $batch_array['batch'];
                        //更新数据
                        $up_batch_array = array(
                            'money'    => $batch_array['money'] + $prices,
                            'bid'      => $batch_array['id']
                        );
                        $is_batch_cmd = 1;
                    }else{
                        $is_batch_cmd = 2;
                    }
                }else{
                    $is_batch_cmd = 2;
                }
                //定义新增数组
                $in_batch_array = array(
                    'uid'       => $uid,
                    'pid'       => $val['id'],
                    'batch'     => $batch,
                    'buytime'   => time(),
                    'starttime' => time(),
                    'endtime'   => time() + ($val['time'] * 86400),
                    'money'     => $prices,
                    'lilv'      => $val['lilv'],
                    'income'    => 0,
                    'is_back'   => 0,
                    'days'      => 0
                );
                $is_insert = 1;
                //查询当前用户同产品收益宝购买次数
                $buy_num = intval(DB::table('ly_yuebao_pay')->where('yuebaoid', $val['id'])->where('uid', $uid)->where('days', $batch)->count('id'));
                //自动下单购买
                $buy_array = array();
                if($buy_num <= $val['buy_num'] || $val['buy_num'] == 0)
                {
                    if($prices >= $val['min_money'])
                    {
                        $insertData = array(
                            'uid'            => $uid,
                            'yuebaoid'       => $val['id'],
                            'lilv'           => $val['lilv'],
                            'money'          => $prices,
                            'daynum'         => $val['time'],
                            'start_time'     => date('Y-m-d H:i:s', time()),
                            'end_time'       => date('Y-m-d H:i:s', time() + ($val['time'] * 86400)),
                            'days'           => $batch,
                            'status'         => 1,
                        );
                        Db::startTrans();
                        $yuebaoPayStatus = Db::table('ly_yuebao_pay')->insert($insertData);
                        if ($yuebaoPayStatus !== 1) {
                            Db::rollback();
                            return json(array('errorCode' => 201, 'errorMsg' => 'network error'));
                        }
                        $payid = Db::table('ly_yuebao_pay')->getLastInsID();//获取购买id
                        //执行批次新增或更新操作
                        if($is_batch_cmd == 2){
                            Db::table('ly_yuebao_batch')->insert($in_batch_array);
                        }else if($is_batch_cmd == 1){
                            Db::table('ly_yuebao_batch')->where('id', $up_batch_array['bid'])->update(array(
                                'money' => $up_batch_array['money']
                            ));
                        }
                            
                        //更新购买明细中的批次号码
                        Db::table('ly_yuebao_pay')->where('id', $payid)->update(array('days' => $batch));
                        
                        //购买成功扣减余额
                        $balance = $getUserTotal['balance'] - $prices;
                        $userTotalStatus = Db::table('ly_user_total')->where(array('id' => $getUserTotal['id']))->update(array('balance' => $balance));
                        if ($userTotalStatus !== 1) {
                            Db::rollback();
                            return PHP_EOL . " 用户ID：$uid 余额扣减失败，无法自动购入" . PHP_EOL;
                        }
                        //更新
                        $financialArray = [];
                        $financialArray['uid'] = $getUsers['id'];
                        $financialArray['sid'] = $getUsers['sid'];
                        $financialArray['username'] = $getUsers['username'];
                        $financialArray['order_number'] = 'Y' . trading_number();
                        $financialArray['trade_number'] = 'L' . trading_number();
                        $financialArray['trade_type'] = 16;
                        $financialArray['trade_before_balance'] = $getUserTotal['balance'];
                        $financialArray['trade_amount'] = $prices;
                        $financialArray['account_balance'] = $balance;
                        $financialArray['remarks'] = '系统自动购买收益宝产品 ID'.$val['id'].' 购买时间：'. date('Y-m-d H:i:s', time());
                        $financialArray['types'] = 1;    // 用户1，商户2
                        model('common/TradeDetails')->tradeDetails($financialArray);
                        Db::commit();
                        return PHP_EOL . " 用户ID：$uid 购买收益宝产品ID：$val[id] 入账本金：$prices,自动购入成功！" . PHP_EOL;
                    }
                }
            }
        }
    }
    
    /**
     * 余额宝结算
     */

    public function yuebao()
    {
        $data = Db::table('ly_yuebao_pay')
            ->where('status', 1)
            ->where('end_time', '<=', date('Y-m-d H:i:s'))
            ->select();
        echo date('Y-m-d H:i:s'), " [begin] count:", count($data), " data:", json_encode($data), PHP_EOL;
        if ($data) {
            Db::startTrans();
            foreach ($data as $v) {
                $userInfo = model('Users')->field('ly_users.id,ly_users.vip_level,username,sid,user_total.balance')->join('user_total', 'ly_users.id=user_total.uid')->where('ly_users.id', $v['uid'])->find();
                //修改状态
                Db::table('ly_yuebao_pay')->where('id', $v['id'])->update(['status' => 2]);
                $money = $v['money'] * $v['lilv'] * $v['daynum'] + $v['money'];
                $getUserTotal = Db::table('ly_user_total')->where(array('uid' => $v['uid']))->find();
                $balance = $getUserTotal['balance'] + $money;
                $userTotalStatus = Db::table('ly_user_total')->where(array('id' => $getUserTotal['id']))->update(array('balance' => $balance));

                // 流水
                // 获取用户信息
                $financialArray['uid'] = $userInfo['id'];
                $financialArray['sid'] = $userInfo['sid'];
                $financialArray['username'] = $userInfo['username'];
                $financialArray['order_number'] = $v['id'];
                $financialArray['trade_number'] = 'L' . trading_number();
                $financialArray['trade_type'] = 16;
                $financialArray['trade_before_balance'] = $userInfo['balance'];
                $financialArray['trade_amount'] = $money;
                $financialArray['account_balance'] = $userInfo['balance'] + $money;
                $financialArray['remarks'] = '余额宝';
                $financialArray['types'] = 1;    // 用户1，商户2
                model('common/TradeDetails')->tradeDetails($financialArray);
            }
            Db::commit();
            echo date('Y-m-d H:i:s'), " [success] count:", count($data), " data:", json_encode($data), PHP_EOL;
            return 'success';
        }
        return 'none';
    }

    /**
     * 云管家
     */
    public function new_housekeeper()
    {
        $day = strtotime('today');
        //找出所有开通管家的人
        $user = Db::table('ly_users')
            ->where('is_housekeeper', 1)
            ->where('housekeeper_time', '>=', time())
            ->select();
        $gradeList = Db::table('ly_user_grade')->column('commission,number', 'grade');
        //print_r($gradeList);exit;
        //print_r($user);
        $uids = [];
        foreach ($user as $val) {
            if ($val['housekeeper_uptime'] > $day) continue;
            if (!isset($gradeList[$val['vip_level']])) {
                echo '[error] 用户：' . $val['id'] . '==等级异常==' . $val['vip_level'] . PHP_EOL;
                continue;
            }
            $grade = $gradeList[$val['vip_level']];
            $com = round($grade['commission'] * $grade['number'], 2);
            if ($com < 1) {
                echo '[error] 用户：' . $val['id'] . '==等级或者佣金数据错误' . $val['vip_level'] . PHP_EOL;
                continue;
            }
            $sn = 'G' . date('YmdHis') . mt_rand(100, 999);
            $userTotal = model('UserTotal')->where('uid', $val['id'])->find();
            //给用户加钱
            $incUserBalance = model('UserTotal')
                ->where('uid', $val['id'])
                ->inc('balance', $com)
                ->inc('total_balance', $com)
                ->update();
            if (!$incUserBalance) {
                echo "[error] 加钱失败 UID:" . $val['id'] . '=====' . $com, PHP_EOL;
                Db::rollback();
                continue;
            }
            Db::table('ly_users')->where('id', $val['id'])->update([
                'housekeeper_uptime' => time(),
            ]);
            echo "[success] 加钱成功 UID:" . $val['id'] . '===级别:' . $val['vip_level'] . '==' . $com, PHP_EOL;
            //更新每日完成任务次数
            $UserDailydata = array(
                'uid' => $val['id'],
                'username' => $val['username'],
                'field' => 'w_t_o_n',
                'value' => $grade['number'],
            );
            model('common/UserDaily')->updateReportfield($UserDailydata);
            echo "[success] 任务次数更新成功 UID:" . $val['id'] . '=====' . $com, PHP_EOL;
            // 流水
            $financialArray = [];
            $financialArray['uid'] = $val['id'];
            $financialArray['sid'] = $val['sid'];
            $financialArray['username'] = $val['username'];
            $financialArray['order_number'] = $sn;
            $financialArray['trade_number'] = 'L' . trading_number();
            $financialArray['trade_type'] = 6;
            $financialArray['trade_before_balance'] = $userTotal['balance'];
            $financialArray['trade_amount'] = $com;
            $financialArray['account_balance'] = $userTotal['balance'] + $com;
            $financialArray['remarks'] = '完成任务=云管家';
            $financialArray['types'] = 1;
            model('common/TradeDetails')->tradeDetails($financialArray);
            echo "[success] 流水更新成功 UID:" . $val['id'] . '=====' . $com, PHP_EOL;
            //上级返点
            if ($val['sid']) {
                $rebatearr = array(
                    'num' => 1,
                    'uid' => $val['id'],
                    'sid' => $val['sid'],
                    'order_number' => $sn,
                    'commission' => $com,
                );
                model('manage/Task')->setrebate($rebatearr, $val['vip_level']);
            }
            $uids[] = $val['uid'];
        }

        echo json_encode($uids) . PHP_EOL;
    }

    //每日检测所有VIP提现是否翻倍
    public function checkVipWithDouble()
    {
        $userList = Db::table('ly_users')->field('id,vip_level')
            ->where('vip_level', '>', 1)
            ->select();
        $settingDataa = model('Setting')->where('id', 1)->find();
        //$settingDataa['min_txcs']
        foreach ($userList as $v) {
            $userwithdrawals = model('UserWithdrawals')
                ->where('uid', $v['id'])
                ->where('vip_level', $v['vip_level'])
                ->where('state', 'in', [1, 3, 6])
                ->count();
            if ($userwithdrawals >= $settingDataa['min_txcs']) {
                Db::table('ly_users')->where('id', $v['id'])->update([
                    'is_double' => 1
                ]);
            }
        }
    }

    //重写用户流水
    public function reset_user_daily()
    {
        $now = strtotime('today') - 86400;
        for ($i = 1; $i < 5; $i++) {
            $today = $now - 86400 * $i;
            $dataList = Db::name('user_daily')
                ->where('withdrawal', '>', 0)
                ->where('date', $today)
                ->field('id,uid')->select();
            echo 'UID: ' . json_encode($dataList), PHP_EOL;
            foreach ($dataList as $val) {
                $with = Db::name('user_withdrawals')
                    ->where('uid', $val['uid'])
                    ->where('time', 'between', [$today, $today + 86400])
                    ->where('state', 6)
                    ->sum('price');
                Db::name('user_daily')
                    ->where('id', $val['id'])
                    ->update([
                        'withdrawal' => $with
                    ]);
            }
        }
        echo 'success', PHP_EOL;
    }
    
    //自动更新信用积分
    //当日领取完成的任务 加分
    //当日领取的任务未完成 减分
    //当日发展直推会员  加分
    //当日未发展直推会员 减分
    public function auto_renwu_xinyong()
    {
        $today    = time();
        $gotime   = strtotime(date('Y-m-d', $today));
        $endtime  = strtotime(date('Y-m-d 23:59:59', $today));
        //读取任务加减分参数
        $setting = Db::table('ly_setting')->field('first_win_push,overdue_ded')->where('id', 1)->find();
        //查询所有任务
        $alltask = Db::table('ly_user_task')->whereTime('add_time', 'between', [$gotime, $endtime])->select();
        if($alltask) foreach ($alltask as $task){
            //查询用户信用分
            $user = Db::table('ly_users')->where('id', $task['uid'])->value('credit');
            if($user){
                if($user < 100){
                    if($task['complete_time'] <= $endtime){
                        $user = $user + $setting['first_win_push'];
                        if($user > 100) $user = 100;
                        Db::table('ly_users')->where('id',$task['uid'])->update(['credit' => $user]);
                        echo 'success uid:'.$task['uid'].',新增信用分：'.$setting['first_win_push'], PHP_EOL;
                    }else{
                        $user = $user - $setting['overdue_ded'];
                        if($user <= 0) $user = 0;
                        Db::table('ly_users')->where('id',$task['uid'])->update(['credit' => $user]);
                        echo 'success uid:'.$task['uid'].',新增信用分：'.$setting['overdue_ded'], PHP_EOL;
                    }
                }
            }
        }
    }
    
    public function auto_user_yaoqing()
    {
        $today    = time();
        $gotime   = strtotime(date('Y-m-d', $today));
        $endtime  = strtotime(date('Y-m-d 23:59:59', $today));
        //读取任务加减分参数
        $setting = Db::table('ly_setting')->field('add_xinyong,del_xinyong')->where('id', 1)->find();
        //查询当日注册的所有用户,并自动给上级加分
        
        $sid = [];
        $alluser = Db::table('ly_users')
            ->field('id,sid,credit')
            ->where('user_type', 2)
            ->whereTime('reg_time', 'between', [$gotime, $endtime])
            ->where('vip_level','>',1)
            ->select();
        if($alluser) foreach($alluser as $user){
            $cmd = Db::table('ly_users')->field('id,sid,credit')->where('id', $user['sid'])->find();
            if($cmd){
                $cmd['credit'] = $cmd['credit'] + $setting['add_xinyong'];
                if($cmd['credit'] > 100) $cmd['credit'] = 100;
                Db::table('ly_users')->where('id',$cmd['id'])->update(['credit' => $cmd['credit']]);
                echo '<br />success uid:'.$cmd['id'].',新增信用分：'.$setting['add_xinyong'], PHP_EOL;
                $sid[] = $user['sid'];
            }
        }

        //批量更新其他用户信用积分
        $nouser = Db::table('ly_users')
            ->field('id,sid,credit')
            ->where('user_type', 2)
            ->whereTime('reg_time', 'not between', [$gotime, $endtime])
            ->select();
        if($nouser) foreach($nouser as $id){

            if(!in_array($id['id'], $sid)){
                $id['credit'] = $id['credit'] - $setting['del_xinyong'];
                if($id['credit'] <= 0) $id['credit'] = 0;
                Db::table('ly_users')->where('id',$id['id'])->update(['credit' => $id['credit']]);
                echo '<br />success uid:'.$id['id'].',减少信用分：'.$setting['del_xinyong'], PHP_EOL;
            }
            
        }

    }
}
