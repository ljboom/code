<?php

namespace app\manage\model;

use think\Exception;
use think\Model;
use Pay\Tikpay;
use think\Db;

class UserWithdrawalsModel extends Model
{
    //表名
    protected $table = 'ly_user_withdrawals';

    /**
     * 提现记录
     */
    public function withdrawalsList()
    {
        $param = input('get.');
        //查询条件组装
        $where = array();
        //分页参数组装
        $pageParam = array();
        // 状态搜索
        if (isset($param['isUser']) && $param['isUser'] == 1) $pageParam['isUser'] = $param['isUser'];
        //搜索类型
        if (isset($param['search_t']) && $param['search_t'] && isset($param['search_c']) && $param['search_c']) {
            switch ($param['search_t']) {
                case 'username':
                    $userId = model('Users')->where('username', $param['search_c'])->value('id');
                    $where[] = array('ly_user_withdrawals.uid', '=', $userId);
                    break;
                case 'order_number':
                    $where[] = array('order_number', '=', $param['search_c']);
                    break;
                case 'card_name':
                    $where[] = array('card_name', '=', $param['search_c']);
                    break;
                case 'card_number':
                    $where[] = array('card_number', '=', $param['search_c']);
                    break;
            }
            $pageParam['search_t'] = $param['search_t'];
            $pageParam['search_c'] = $param['search_c'];
        }

        //状态搜索
        if (isset($param['state']) && $param['state']) {
            $where[] = array('ly_user_withdrawals.state', '=', $param['state']);
            $pageParam['state'] = $param['state'];
        }
        // 时间
        if (isset($param['datetime_range']) && $param['datetime_range']) {
            $dateTime = explode(' - ', $param['datetime_range']);
            $where[] = array('ly_user_withdrawals.time', '>=', strtotime($dateTime[0]));
            $where[] = array('ly_user_withdrawals.time', '<=', strtotime($dateTime[1]));
            $pageParam['datetime_range'] = $param['datetime_range'];
        } else {
            $todayStart = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $where[] = array('ly_user_withdrawals.time', '>=', $todayStart);
            $todayEnd = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
            $where[] = array('ly_user_withdrawals.time', '<=', $todayEnd);
        }

        //查询符合条件的数据
        $resultData = $this->field('ly_user_withdrawals.*,manage.username as aname,users.username,danger,bank.bank_name')->join('users', 'ly_user_withdrawals.uid = users.id')->join('manage', 'ly_user_withdrawals.aid = manage.id', 'left')->join('bank', 'ly_user_withdrawals.bank_id = bank.id', 'left')->where($where)->order('time', 'desc')->paginate(16, false, ['query' => $pageParam]);
        //数据集转数组
        $withdrawalsList = $resultData->toArray()['data'];
        //部分元素重新赋值
        $stateColor = config('manage.color');
        $pageTotal['countPrice'] = 0;
        $pageTotal['countFee'] = 0;
        foreach ($withdrawalsList as $key => &$value) {
            $value['stateColor'] = $stateColor[$value['state']];
            //分页统计
            $pageTotal['countPrice'] += $value['price'];
            $pageTotal['countFee'] += $value['fee'];
        }

        // 权限查询
        $powerWhere = 'uid = ' . session('manage_userid') . ' AND (cid = 3 OR role_id = 245)';
        $power = model('ManageUserRole')->getUserPower($powerWhere);

        return array(
            'data' => $withdrawalsList,
            'pageTotal' => $pageTotal,
            'page' => $resultData->render(),//分页
            'where' => $pageParam,
            'withdrawalsState' => config('custom.withdrawalsState'),
            'power' => $power,
        );
    }

    /**
     * 风控审核view
     */
    public function controlAuditView()
    {
        $param = input('get.');

        $data = $this->where('id', $param['id'])->find();

        return array(
            'data' => $data
        );
    }

    /**
     * 风控审核
     */
    public function controlAudit()
    {
        $param = input('post.');
        if (!$param) return '提交失败';

        $controlAuditTime = cache('CA_controlAuditTime' . session('manage_userid')) ? cache('CA_controlAuditTime' . session('manage_userid')) : time() - 2;
        if (time() - $controlAuditTime < 2) {
            return ' 2 秒内不能重复提交';
        }
        cache('CA_controlAuditTime' . session('manage_userid'), time(), 10);

        $orderNumber = $param['order_number'];
        unset($param['order_number']);

        //获取订单信息
        $where[] = array('order_number', '=', $orderNumber);
        $where[] = array('state', '=', 3);
        
        $orderInfo = $this->where($where)->find();
        if (!$orderInfo) return '订单不存在';
        $orderInfo = $orderInfo->toArray();
        // 更新订单
        $res = $this->where('order_number', $orderNumber)->update($param);
        if (!$res) return '操作失败1';

        switch ($param['examine']) {
            case 2:
                //更新用户余额提现金额+手续费
                $orderInfojj = $orderInfo['price'] + $orderInfo['fee'];
                //构造备注信息
                $remarksTemp = '订单 ' . $orderInfo['order_number'] . ' 取款失败，退回资金：' . $orderInfojj;
                $remarks = (isset($param['remarks']) && $param['remarks'] && $param['remarks'] !== $orderInfo['remarks']) ? $param['remarks'] : $remarksTemp;
                //更新订单
                $orderUpdateArray = array(
                    'aid' => session('manage_userid'),
                    'state' => 2,
                    'set_time' => time(),
                    'remarks' => $remarks
                );
                $res2 = $this->where('id', $orderInfo['id'])->update($orderUpdateArray);
                if (!$res2) {
                    $this->where('id', $orderInfo['id'])->update($orderInfo);
                    return '操作失败2';
                }

                //获取用户余额
                $balance = model('UserTotal')
                    ->field('balance')
                    ->where('uid', $orderInfo['uid'])
                    ->find();

                //更新用户余额
                $res3 = model('UserTotal')->where('uid', $orderInfo['uid'])->inc('balance', $orderInfojj)->update();
                if (!$res3) {
                    $this->where('id', $orderInfo['id'])->update($orderInfo);
                    return '操作失败3';
                }

                $res4 = model('TradeDetails')->where('order_number', $orderInfo['order_number'])->update(array('state' => 2, 'remarks' => '审核未通过，资金已退回 [' . $orderInfojj . ']'));
                if (!$res4) {
                    $this->where('order_number', $orderNumber)->update($orderInfo);
                    model('UserTotal')->where('uid', $orderInfo['uid'])->dec('balance', $orderInfo['price'])->update();
                    return '操作失败4';
                }
                $tradeDetailsArray = array(
                    'uid' => $orderInfo['uid'],
                    'order_number' => $orderInfo['order_number'],
                    'trade_type' => 13,
                    'trade_before_balance' => $balance['balance'],
                    'trade_amount' => $orderInfo['price'],
                    'account_balance' => $balance['balance'] + $orderInfo['price'],
                    //'account_frozen_balance' => $balance['frozen_balance'] - $orderInfo['price'],
                    'remarks' => $remarks,
                    //'types'                  =>	2,
                    'isadmin' => 1,
                    //'isdaily'                => 2
                );
                $res4 = model('common/TradeDetails')->tradeDetails($tradeDetailsArray);
                if (!$res4) {
                    $this->where('id', $orderInfo['id'])->update($orderInfo);
                    model('UserTotal')->where('uid', $orderInfo['uid'])->dec('balance', $orderInfo['price'])->update();
                    return '操作失败4';
                }

                //添加操作日志
                model('Actionlog')->actionLog(session('manage_username'), '审核订单号为' . $orderInfo['order_number'] . '的提现订单。处理状态：审核未通过', 1);
                break;

            case 1:
                //添加操作日志
                model('Actionlog')->actionLog(session('manage_username'), '审核订单号为' . $orderNumber . '的提现订单。处理状态：审核通过', 1);
                break;
        }

        return 1;
    }

    /**
     * 财务处理
     */
     
    public function txshenhe()
    {
        $param = input('post.');
        if (!$param) return '提交失败';
        $orderNumber = $param['order_number'];
        unset($param['order_number']);
        unset($param['state']);
        unset($param['id']);
        $param['examine'] = 1;
        /*
        //获取订单信息
        $where[] = array('order_number', '=', $orderNumber);
        //$where[] = array('state','=',3);
        $where[] = array('state', '>=', 3);
        $where[] = array('state', '<=', 5);
        $orderInfo = $this->where($where)->find();
        if (!$orderInfo) return '订单不存在';
        $orderInfo = $orderInfo->toArray();
        
        $orderNumber = $param['order_number'];
        unset($param['order_number']);
        */
        //获取订单信息
        $where[] = array('order_number', '=', $orderNumber);
        $where[] = array('state', '=', 3);
        
        $orderInfo = $this->where($where)->find();
        if (!$orderInfo) return '订单不存在';
        $orderInfo = $orderInfo->toArray();
        
        $param['remarks'] = '尊敬的用户您好！您的编号为' . $orderInfo['order_number'] . ' 的提现处理成功，金额￥' . $orderInfo['price'] . '元 服务费：￥0.0000元，处理时间：' . date('Y-m-d H:i:s');
        // 更新订单
        $res = $this->where('order_number', $orderNumber)->update($param);
        if (!$res) return '操作失败1';
        //添加操作日志
        model('Actionlog')->actionLog(session('manage_username'), '审核订单号为' . $orderNumber . '的提现订单。处理状态：审核通过', 1);
        return 1;
        /*
        if(isset($param['state']) && $param['state'] == 1){
            
            $remarks = '尊敬的用户您好！您的编号为' . $orderInfo['order_number'] . ' 的提现处理成功，金额￥' . $orderInfo['price'] . '元 服务费：￥0.0000元，处理时间：' . date('Y-m-d H:i:s');
            //更新订单
            $orderUpdateArray = array(
                'aid' => session('manage_userid'),
                'state' => $param['state'],
                'examine' => 1,
                'set_time' => time(),
                'remarks' => $remarks
            );
            $res = $this->where('id', $orderInfo['id'])->update($orderUpdateArray);
            if (!$res) return '操作失败1';
            //更新流水
            $res2 = model('TradeDetails')->where('order_number', $orderNumber)->update(array('state' => 1));
            if (!$res2) return '操作失败3';
            // 获取余额
            $balance = model('UserTotal')->field('balance')->where('uid', $orderInfo['uid'])->find();
            $tradeDetailsArray = array(
                'uid' => $orderInfo['uid'],
                'trade_type' => 2,
                'trade_before_balance' => $balance['balance'],
                'trade_amount' => $orderInfo['price'],
                'account_balance' => $balance['balance'],
                //'account_frozen_balance' => $balance['frozen_balance'] - $orderInfo['price'],
                'remarks' => $remarks,
                //'types'                  =>	2,
                'isadmin' => 1,
            );
            $res3 = model('common/TradeDetails')->tradeDetails($tradeDetailsArray);
            if (!$res3) {
                $this->where('id', $orderInfo['id'])->update($orderInfo);
                //model('UserTotal')->where('uid', $orderInfo['uid'])->setInc('frozen_balance', $orderInfo['price']);
                return '操作失败3';
            }

            //添加操作日志
            model('Actionlog')->actionLog(session('manage_username'), '处理订单号为' . $orderInfo['order_number'] . '的提现订单。处理状态：已支付', 1);

            return $orderNumber.'审核成功！';
        }
        */
    }
    
    public function piliangchuli()
    {
        $param = input('post.');
        if (!$param) return '提交失败';
        $orderNumber = $param['order_number'];
        unset($param['order_number']);

        //获取订单信息
        $where[] = array('order_number', '=', $orderNumber);
        //$where[] = array('state','=',3);
        $where[] = array('state', '>=', 3);
        $where[] = array('state', '<=', 5);
        $orderInfo = $this->where($where)->find();
        if (!$orderInfo) return '订单不存在';
        
        $orderInfo = $orderInfo->toArray();
        switch ($param['state']) {
            case 1://已支付
                //构造备注信息
                $remarks = (isset($param['remarks']) && $param['remarks'] && $param['remarks'] !== $orderInfo['remarks']) ? $param['remarks'] : '尊敬的用户您好！您的编号为' . $orderInfo['order_number'] . ' 的提现处理成功，金额￥' . $orderInfo['price'] . '元 服务费：￥0.0000元，处理时间：' . date('Y-m-d H:i:s');
                //更新订单
                $orderUpdateArray = array(
                    'aid' => session('manage_userid'),
                    'state' => $param['state'],
                    'set_time' => time(),
                    'remarks' => $remarks,
                    'is_pay' => 1,
                    'pay_type' => '人工打款'
                );
                $res = $this->where('id', $orderInfo['id'])->update($orderUpdateArray);
                if (!$res) return '操作失败1';
                //更新流水
                $res2 = model('TradeDetails')->where('order_number', $orderNumber)->update(array('state' => 1));
                if (!$res2) return '操作失败3';
                // 获取余额
                $balance = model('UserTotal')->field('balance')->where('uid', $orderInfo['uid'])->find();
                // 扣除金额
                /*$res2 = model('UserTotal')->where('uid', $orderInfo['uid'])->setDec('frozen_balance', $orderInfo['price']);
                if (!$res2) {
                    $this->where('id',$orderInfo['id'])->update($orderInfo);
                    return '操作失败2';
                }*/
                // 流水
                $tradeDetailsArray = array(
                    'uid' => $orderInfo['uid'],
                    'trade_type' => 2,
                    'trade_before_balance' => $balance['balance'],
                    'trade_amount' => $orderInfo['price'],
                    'account_balance' => $balance['balance'],
                    //'account_frozen_balance' => $balance['frozen_balance'] - $orderInfo['price'],
                    'remarks' => $remarks,
                    //'types'                  =>	2,
                    'isadmin' => 1,
                );
                $res3 = model('common/TradeDetails')->tradeDetails($tradeDetailsArray);
                if (!$res3) {
                    $this->where('id', $orderInfo['id'])->update($orderInfo);
                    //model('UserTotal')->where('uid', $orderInfo['uid'])->setInc('frozen_balance', $orderInfo['price']);
                    return '操作失败3';
                }

                //添加操作日志
                model('Actionlog')->actionLog(session('manage_username'), '处理订单号为' . $orderInfo['order_number'] . '的提现订单。处理状态：已支付', 1);

                return 1;

                break;
        }

    }
    
    public function financialAudit()
    {
        $param = input('post.');
        if (!$param) return '提交失败';

        $controlAuditTime = cache('CA_financialAuditTime' . session('manage_userid')) ? cache('CA_financialAuditTime' . session('manage_userid')) : time() - 2;
        if (time() - $controlAuditTime < 2) {
            return ' 2 秒内不能重复提交';
        }
        cache('CA_financialAuditTime' . session('manage_userid'), time(), 10);

        $orderNumber = $param['order_number'];
        unset($param['order_number']);

        //获取订单信息
        $where[] = array('order_number', '=', $orderNumber);
        //$where[] = array('state','=',3);
        $where[] = array('state', '>=', 3);
        $where[] = array('state', '<=', 5);
        $orderInfo = $this->where($where)->find();
        if (!$orderInfo) return '订单不存在';
        $orderInfo = $orderInfo->toArray();

        switch ($param['state']) {
            case 1://已支付
                //构造备注信息
                $remarks = (isset($param['remarks']) && $param['remarks'] && $param['remarks'] !== $orderInfo['remarks']) ? $param['remarks'] : '尊敬的用户您好！您的编号为' . $orderInfo['order_number'] . ' 的提现处理成功，金额￥' . $orderInfo['price'] . '元 服务费：￥0.0000元，处理时间：' . date('Y-m-d H:i:s');
                //更新订单
                $orderUpdateArray = array(
                    'aid' => session('manage_userid'),
                    'state' => $param['state'],
                    'set_time' => time(),
                    'remarks' => $remarks
                );
                $res = $this->where('id', $orderInfo['id'])->update($orderUpdateArray);
                if (!$res) return '操作失败1';
                //更新流水
                $res2 = model('TradeDetails')->where('order_number', $orderNumber)->update(array('state' => 1));
                if (!$res2) return '操作失败3';
                // 获取余额
                $balance = model('UserTotal')->field('balance')->where('uid', $orderInfo['uid'])->find();
                // 扣除金额
                /*$res2 = model('UserTotal')->where('uid', $orderInfo['uid'])->setDec('frozen_balance', $orderInfo['price']);
                if (!$res2) {
                    $this->where('id',$orderInfo['id'])->update($orderInfo);
                    return '操作失败2';
                }*/
                // 流水
                $tradeDetailsArray = array(
                    'uid' => $orderInfo['uid'],
                    'trade_type' => 2,
                    'trade_before_balance' => $balance['balance'],
                    'trade_amount' => $orderInfo['price'],
                    'account_balance' => $balance['balance'],
                    //'account_frozen_balance' => $balance['frozen_balance'] - $orderInfo['price'],
                    'remarks' => $remarks,
                    //'types'                  =>	2,
                    'isadmin' => 1,
                );
                $res3 = model('common/TradeDetails')->tradeDetails($tradeDetailsArray);
                if (!$res3) {
                    $this->where('id', $orderInfo['id'])->update($orderInfo);
                    //model('UserTotal')->where('uid', $orderInfo['uid'])->setInc('frozen_balance', $orderInfo['price']);
                    return '操作失败3';
                }

                //添加操作日志
                model('Actionlog')->actionLog(session('manage_username'), '处理订单号为' . $orderInfo['order_number'] . '的提现订单。处理状态：已支付', 1);

                return 1;

                break;

            case 2://拒绝支付
                $orderInfojj = $orderInfo['price'] + $orderInfo['fee'];
                //构造备注信息
                $remarks = (isset($param['remarks']) && $param['remarks'] && $param['remarks'] !== $orderInfo['remarks']) ? $param['remarks'] : '订单 ' . $orderInfo['order_number'] . ' 取款失败，退回资金：' . $orderInfojj;

                //更新订单
                $orderUpdateArray = array(
                    'aid' => session('manage_userid'),
                    'state' => $param['state'],
                    'set_time' => time(),
                    'remarks' => $remarks
                );
                $res = $this->where('order_number', $orderNumber)->update($orderUpdateArray);
                if (!$res) return '操作失败1';
                //更新流水
                $res1 = model('TradeDetails')->where('order_number', $orderInfo['order_number'])->update(array('state' => 2, 'remarks' => '提现失败，资金已退回'));
                if (!$res1) return '操作失败2';
                //获取用户余额
                $balance = model('UserTotal')->field('balance')->where('uid', $orderInfo['uid'])->find();
                //更新用户余额
                $res2 = model('UserTotal')
                    ->where('uid', $orderInfo['uid'])
                    ->inc('balance', $orderInfojj)
                    ->update();
                if (!$res2) {
                    $this->where('id', $orderInfo['id'])->update($orderInfo);
                    return '操作失败2';
                }

                $tradeDetailsArray = array(
                    'uid' => $orderInfo['uid'],
                    'order_number' => $orderInfo['order_number'],
                    'trade_type' => 13,
                    'trade_before_balance' => $balance['balance'],
                    'trade_amount' => $orderInfo['price'],
                    'account_balance' => $balance['balance'] + $orderInfojj,
                    //'account_frozen_balance' => $balance['frozen_balance'] - $orderInfo['price'],
                    'remarks' => $remarks,
                    //'types'                  =>	2,
                    'isadmin' => 1,
                    //'isdaily'                => 2
                );
                $res3 = model('common/TradeDetails')->tradeDetails($tradeDetailsArray);
                if (!$res3) {
                    $this->where('id', $orderInfo['id'])->update($orderInfo);
                    $res2 = model('UserTotal')->where('uid', $orderInfo['uid'])->dec('balance', $orderInfo['price'])->update();
                    return '操作失败3';
                }

                //添加操作日志
                model('Actionlog')->actionLog(session('manage_username'), '处理订单号为' . $orderInfo['order_number'] . '的提现订单。处理状态：拒绝支付', 1);

                return 1;
                break;
            default:
                return '无须修改';
                break;
        }
    }

    /**
     * 出款
     */
    public function withdrawalsPayment()
    {
        if (!request()->isAjax()) return '非法提交';

        $param = input('post.');
        if (!$param) return '提交失败';

        // 获取出款状态
        // $cashStatus = model('Setting')->where('id','>',0)->value('cash_status');
        // if($cashStatus != 1) return '未开启出款功能';

        // 时间段
        $startTime = mktime(8, 0, 0, date('m'), date('d'), date('Y'));
        $endTime = mktime(18, 0, 0, date('m'), date('d'), date('Y'));
        //if(time()<$startTime || time()>$endTime) return '当前不在处理时间段';

        // 获取出款单信息
        $drawInfo = $this->where('id', $param['id'])->find();
        if (!$drawInfo) return '订单不存在';
        //汇率转换
        $exchange = model('RechangeType')->where('code', $drawInfo['bank_source'])->value('exchange');
        if(!$exchange) $exchange = 1;
        $drawInfo['price'] = $drawInfo['price'] / $exchange;
        
        try {
            $type = input('post.type');
            if ($drawInfo['is_pay'] != 0) return '已经在 ' . $drawInfo['pay_type'] . ' 渠道出款，不能再次出款';
            if (!$drawInfo['user_bank_id']) return '出款信息错误，驳回后重新提交';
            $user_bank = Db::name('user_bank')->where('id', $drawInfo['user_bank_id'])->find();
            if (!$user_bank) return '银行卡信息错误，驳回后让用户修改银行卡后，在提交';
            $className = "\\Pay\\" . $type;
            $payObj = new $className();
            $payout = $payObj->create_payout([
                'num' => $drawInfo['price'],
                'id' => $drawInfo['order_number'],
                'uid' => $drawInfo['uid'],
                'type' => 'pix',
            ], [
                'wallet_document_id' => trim($drawInfo['card_number']),
                'cardnum' => trim($drawInfo['card_number']),
                'username' => trim($drawInfo['card_name']),
                'mobile' => trim($drawInfo['card_mobile']),
                'email' => $drawInfo['card_email'],
                'card_no' => trim($user_bank['card_no']),
                'bank_code' => $user_bank['bank_code'],
                'bank_name' => $user_bank['bank_name'],
                'bank_clabe' => $user_bank['bank_clabe'],
                'bank_branch_name' => $user_bank['bank_branch_name'],
            ]);
            if (!$payout) {
                return '三方系统付款失败! Msg: ' . (!empty($payObj->_payout_msg) ? $payObj->_payout_msg : '');
            }
            $this->where('id', $param['id'])->update(array(
                'is_pay' => 1,
                'pay_type' => $type,
                'pay_msg' => '',
            ));
            return $type . ' 提交成功';
            
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
        

        $bankItem = model('Bank')->where('id', $drawInfo['bank_id'])->find();
        if (!$bankItem) return "未知的取款银行";
        $startTime = strtotime(date('Y-m-d') . ' ' . $bankItem['q_start_time']);
        $endTime = strtotime(date('Y-m-d') . ' ' . $bankItem['q_end_time']);
        if (time() < $startTime || time() > $endTime) {
            return '当前不在处理时间段';
        }

        // 获取出款配置
        $drawConfig = model('DrawConfig')->where('state', 1)->find();
        if (!$drawConfig) return '无可用出款账户';

        // 获取所有充值渠道
        $rechargeArr = model('RechangeType')->field('id,submitUrl')->order('id', 'asc')->select()->toArray();

        if (!$rechargeArr) return '取款银行不可用 - 1';
        // 匹配渠道
        foreach ($rechargeArr as $key => $value) {
            if (preg_match('/' . $drawConfig['file_name'] . '/', $value['submitUrl'])) {
                $rechargeId = $value['id'];
                break;
            }
        }
        if (!isset($rechargeId)) return '取款银行不可用 - 2';
        // 获取银行名称
        $bankName = model('Bank')->where('id', $drawInfo['bank_id'])->value('bank_name');
        if (!$bankName) return '取款银行不可用 - 3';
        // 获取渠道对应的银行代码
        $bankCode = model('Bank')->where(['bank_name' => $bankName, 'pay_type' => $rechargeId])->value('bank_code');
        if (!$bankCode) return '取款银行不可用 - 4';

        // 构造提交数据
        switch ($drawConfig['id']) {
            case '999':
                $dataArray = [
                    'uid' => $drawInfo['uid'],
                    'order' => $drawInfo['order_number'],
                    'amount' => $drawInfo['price'],
                    'account_Name' => $drawInfo['card_name'],
                    'account_Number' => $drawInfo['card_number'],
                    'bank_Code' => $bankName,
                ];
                break;

            default:
                $dataArray = [
                    'uid' => $drawInfo['uid'],
                    'order' => $drawInfo['order_number'],
                    'amount' => $drawInfo['price'],
                    'account_Name' => $drawInfo['card_name'],
                    'account_Number' => $drawInfo['card_number'],
                    'bank_Code' => $bankCode,
                ];
                break;
        }

        // 出款
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $drawConfig['submit_url']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataArray));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if (!$result) return '已提交';

        $resultArray = json_decode($result, true);
        switch ($drawConfig['id']) {
            case 1:
            case 2:
                if (!$resultArray['error_Msg'] && $resultArray['bank_Status'] == 'I') {
                    $this->paymentSuccess(['order_number' => $drawInfo['order_number']]);

                    $ajaxStr = 1;
                } else {
                    $ajaxStr = $resultArray['error_Msg'] . ' - ' . $resultArray['bank_Status'];
                }
                break;

            default:
                if ($result == 1 || $result == 'Y') {
                    $this->paymentSuccess(['order_number' => $drawInfo['order_number']]);

                    $ajaxStr = 1;
                } else {
                    $ajaxStr = $result;
                }
                break;
        }

        return $ajaxStr;
    }

    /**
     * 出款成功
     */
    public function paymentSuccess($param = [], $aid = 0)
    {
        if (!$aid && session('manage_userid')) $aid = session('manage_userid');
        //更新提现订单
        $this->where('order_number', $param['order_number'])->update(array('state' => 6, 'aid' => $aid));
        //获取提现订单信息
        $orderInfo = $this->field('uid,price')->where('order_number', $param['order_number'])->find();
        /*
         'uid'		=>	$tradeDetailsData['uid'],
			'username'	=>	$tradeDetailsData['username'],
			'type'		=>	$tradeDetailsData['trade_type'],
			'user_type'	=>	$tradeDetailsData['user_type'],
			'price'		=>	$tradeDetailsData['trade_amount'],
			'isadmin'	=>	$tradeDetailsData['isadmin'],
			'isdaily'	=>	$tradeDetailsData['isdaily'],
         * */
        $userInfo = model('Users')->where('id',$orderInfo['uid'])->find();
        //更新每日报表
        $reportFormArray = array(
            'uid' => $orderInfo['uid'],
            'username' => isset($userInfo['username']) ? $userInfo['username'] : '',
            'type' => 2,
            'user_type' => isset($userInfo['user_type']) ? $userInfo['user_type'] : 2,
            'price' => $orderInfo['price'],
            'isadmin' => 1,
            'isdaily' => 0,
        );
        model('UserDaily')->updateReportForm($reportFormArray);

        //更新流水
        model('TradeDetails')->where('order_number', $param['order_number'])->update(array('state' => 1));
    }
}
