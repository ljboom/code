<?php

namespace app\agent\controller;

use think\Controller;

class IndexController extends CommonController
{
    public $ids = array();
    
    public function index()
    {
        error_reporting(0);
        $do = model('api/UserTeam');
        $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

        //开始时间
        //$startDate = (isset($param['startdate']) && $param['startdate']) ? strtotime($param['startdate']) : $today - 86400 * 7;
        $startDate = 0;
        //结束时间
        $endDate = (isset($param['enddate']) && $param['enddate']) ? strtotime($param['enddate'] . ' 23:59:59') : $today + 86400;
        /**
         * 团队报表
         */
        // 团队余额
        $data['teamBalance'] = round($do->alias('ut')->join('user_total', 'ut.team=user_total.uid')->where('ut.uid', '=', $this->userid)->sum('balance'), 2);
        $param['trade_number'] = 'L' . trading_number();
        // 团队收益
        $teamProfit = $do->alias('ut')->field(['SUM(`commission`)' => 'commission', 'SUM(`rebate`)' => 'rebate'])->join('user_daily', 'ut.team=user_daily.uid')->where('ut.uid', '=', $this->userid)->whereTime('date', 'between', [$startDate, $endDate])->find();
        $data['teamProfit'] = round($teamProfit['commission'] + $teamProfit['rebate'], 3);
        // 团队总充值
        $data['teamRecharge'] = round($do->alias('ut')->join('user_recharge', 'ut.team=user_recharge.uid')->where('ut.uid', '=', $this->userid)->where('user_recharge.state', '=', 1)->sum('money'), 2);
        // 团队总提现
        $data['teamWithdrawal'] = round($do->alias('ut')->join('user_withdrawals', 'ut.team=user_withdrawals.uid')->where('ut.uid', '=', $this->userid)->where('user_withdrawals.state', 'in', [1, 6])->sum('price'), 2);
        if($this->userid==32) $data['teamWithdrawal'] =  $data['teamWithdrawal'] + 20000;
        $param['trade_number'] = 'L' . trading_number();
        // 直推人数
        $data['directlyUnder'] = model('Users')->where('sid', $this->userid)->count();
        // 今日首冲
        $data['rechargeAll'] = $do->alias('ut')
            ->field('user_recharge.uid')
            ->join('user_recharge', 'ut.team=user_recharge.uid')
            ->where([['ut.uid', '=', $this->userid], ['state', '=', 1]])
            ->whereTime('add_time', 'between', [$startDate, $endDate])
            ->group('user_recharge.uid')
            ->count();
        $data['firstRechargeToday'] = $do->alias('ut')
            ->field('user_recharge.uid')
            ->join('user_recharge', 'ut.team=user_recharge.uid')
            ->where([['ut.uid', '=', $this->userid], ['state', '=', 1]])
            ->whereTime('add_time', 'between', [strtotime('today'), time()])
            ->group('user_recharge.uid')
            ->count();
        //团队总人数
        $data['teamNumber'] = $do->where('uid', $this->userid)->count();
        // 新增人数
        $data['newReg'] = $do->alias('ut')
            ->join('users', 'ut.team=users.id')
            ->where('ut.uid', '=', $this->userid)
            ->whereTime('reg_time', 'between', [strtotime('today'), time()])
            ->count();

        $data['team1']['teamRechargeCount'] = 1;//充值金额(QWE)
        $data['team1']['teamRechargeNumber'] = 11;//充值人数(个)
        $data['team1']['teamSpreadSum'] = 111;    //充值返佣(QWE)

        $data['team2']['teamRechargeCount'] = 2;
        $data['team2']['teamRechargeNumber'] = 22;
        $data['team2']['teamSpreadSum'] = 222;

        $data['team3']['teamRechargeCount'] = 3;
        $data['team3']['teamRechargeNumber'] = 33;
        $data['team3']['teamSpreadSum'] = 333;


        //print_r($data);
        return view('', [
            'data' => $data,
        ]);
    }

    public function userlist()
    {
        if (request()->isAjax()) {
            //获取参数
            $param = input('post.');
            //查询条件组装
            $where = [];
            //查询符合条件的数据

            $count = model('Users')
                ->field('id,sid,username,state')
                ->where('sid', $this->userid)
                ->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $touserid = isset($param['touserid']) ? intval($param['touserid']) : $this->userid;
            $userList = model('Users')
                ->field('id,sid,username,state')
                ->where('sid', $touserid)
                ->limit($limitOffset, $param['limit'])
                ->select()
                ->toArray();
            $data = model('manage/UserDaily')->teamStatistic($userList, 0, 9999999999, $touserid);
            unset($data['totalAll']);

            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }
        return view('', [
            'level_list' => model('UserGrade')->column('name', 'grade')
        ]);
    }

    /**
     * 用户列表
     */
    public function userListc()
    {
        if (request()->isAjax()) {
            //获取参数
            $param = input('post.');
            //查询条件组装
            $where = [];
            //查询符合条件的数据
            $touserid = isset($param['touserid']) ? intval($param['touserid']) : $this->userid;
            //$count              = model('Users')->field('id,uid,sid,username,state')->where('sid', $this->userid)->count(); // 总记录数
            //$count              = model('Users')->where('sid', $this->userid)->count();
            $count = model('Users')
                ->join('user_total', 'ly_users.id = user_total.uid')
                ->join('user_team', 'ly_users.id = user_team.team')
                ->where('user_team.uid', '=', $touserid)
                //->where('sid', $this->userid)
                ->count();// 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量


            $userList = model('Users')->field('id,uid,sid,username,state')->where('sid', $touserid)->limit($limitOffset, $param['limit'])->select()->toArray();
            //$data = model('manage/UserDaily')->teamStatistic($userList,0,9999999999,$touserid);
            //$data1 = model('Users')->where('sid',$touserid)->limit($limitOffset, $param['limit'])->select()->toArray();
            $query = model('Users')
                ->field(['ly_users.*', 'user_total.balance', 'user_total.total_balance'])
                ->join('user_total', 'ly_users.id = user_total.uid')
                ->join('user_team', 'ly_users.id = user_team.team')
                ->where('user_team.uid', '=', $touserid);
            //var_dump($param);exit;
            if (isset($param['username'])) {
                $query->where('ly_users.username', 'like', '%' . $param['username'] . '%');
            }
            if (isset($param['ip']) && $param['ip']) {
                $query->where('ly_users.last_ip', $param['ip']);
            }
            if (isset($param['uid']) && intval($param['uid'] > 0)) {
                $query->where('ly_users.uid', $param['uid']);
            }
            if (isset($param['state']) && intval($param['state']) > 0) {
                $query->where('ly_users.state', $param['state']);
            }
            //用户名
            if (isset($param['is_automatic']) && $param['is_automatic']) {
                $query->where('ly_users.is_automatic', $param['is_automatic']);
            }
            // 时间
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $query->where('ly_users.reg_time', '>=', strtotime($dateTime[0]));
                $query->where('ly_users.reg_time', '<=', strtotime($dateTime[1]));
            }
            if (isset($param['vip_level']) && $param['vip_level']) {
                $query->where('ly_users.vip_level', '=', $param['vip_level']);
            }

            //->where('sid',$touserid)
            $data = $query->limit($limitOffset, $param['limit'])
                ->select()->toArray();

            $userState = config('custom.userState');//账号状态
            foreach ($data as $key => &$value) {
                $value['reg_time'] = date('Y-m-d H:i:s', $value['reg_time']);
                $value['stateStr'] = $userState[$value['state']];
                $value['isOnline'] = (cache('C_token_' . $value['id'])) ? '在线' : '离线';
            }
            unset($data['totalAll']);
            foreach ($data as $key => &$val){
                //收益宝余额
                $val['shouyibao'] = 0.00;
                $syb = model('YuebaoBatch')
                    ->where('uid', $val['id'])
                    ->where('is_back', 0)
                    ->select();
                if($syb) foreach ($syb as $sk => $sv){
                    $val['shouyibao'] = round($val['shouyibao'] + $sv['money'] + $sv['income'], 2);
                }
            }
            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data,
                //'data'  => $data1

            ]);
        }
        return view('', [
            'level_list' => model('manage/UserGrade')->column('name', 'grade')
        ]);
    }

    /**
     * 关系树
     */
    public function relation()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $touserid = isset($param['touserid']) ? intval($param['touserid']) : $this->userid;
            $newUser = model('Users')->alias('u')
                ->join('ly_user_team', 'u.id=ly_user_team.team')
                ->field('u.id,u.username,u.username as title,u.`sid` as `field`,u.vip_level,u.reg_time');
            $topUid = $touserid;
            $where = [];
            if (isset($param['username']) && $param['username']) {
                $topUid = model('Users')->where('username', $param['username'])->value('id');
                if (!$topUid) return json(['code' => 0, 'data' => [], 'msg' => '查无此人']);
                //$team_id = model('manage/UserTeam')->where('team', $topUid)->value('uid');
                //if ($team_id != $touserid) return json(['code' => 0, 'data' => [], 'msg' => '不是本团队成员']);
                $dataIds = [];
                model('manage/UserTeam')->getRealAllSonIds($topUid, $dataIds);
                if (!$dataIds) return json(['code' => 0, 'data' => [], 'msg' => $param['username'] . '没有下属会员']);
                $newUser->where('u.id', 'in', $dataIds);
            } else {
                $where[] = ['ly_user_team.uid', '=', $touserid];
            }
            $array = $newUser->where($where)->select()->toArray();

            if (!$array) return json(['code' => 0, 'data' => [], 'msg' => '查无此人']);

            $res = [];
            $tree = [];

            //整理数组
            foreach ($array as $key => $value) {
                //$value['reg_time'] = 
                $value['title'] .= '&nbsp;&nbsp;(VIP' . ($value['vip_level'] - 1) . ')&nbsp;&nbsp;注册时间：'. date('Y-m-d H:i:s', time());
                $res[$value['id']] = $value;
                $res[$value['id']]['children'] = [];
            }
            unset($array);

            //查询子孙
            foreach ($res as $key => $value) {
                if ($value['field'] != 0) {
                    $res[$value['field']]['children'][] = &$res[$key];
                }
            }

            //去除杂质
            foreach ($res as $key => $value) {
                if (!isset($value['title'])) {
                    unset($res[$key]);
                    continue;
                }
                if ($value['field'] == $topUid) {
                    $tree[] = $value;
                }
            }
            unset($res);

            return json(['code' => 1, 'data' => $tree, 'msg' => 'ok']);
        }

        return view();
    }

    /**
     * 团队报表
     */
    public function team_statistic()
    {
        $param = input('get.');
        //var_dump($param);exit;
        $touserid = isset($param['touserid']) ? intval($param['touserid']) : $this->userid;
        //var_dump($touserid);exit;
        $data = (isset($param['isUser']) && $param['isUser'] == 1) ? model('Merchant')
            ->where('sid', $touserid)
// 		->where('isUser',1)
            ->teamStatistic() : model('Users')->teamStatistic($touserid);
        //var_dump($touserid);
        //   die;
        //team_statistic?date_range=2022-01-09 - 2022-01-09&isUser=1&sid=80
        $this->assign('data', $data['data']);
        $this->assign('total', $data['total']);
        $this->assign('page', $data['page']);
        $this->assign('where', $data['where']);

        return $this->fetch();
    }

    /**
     * 用户资金流水
     */
    public function financial()
    {
        if (request()->isAjax()) {
            $param = input('post.');
            $do = model('api/UserTeam');

            //查询条件组装
            $where = array();
            $where[] = array('types', '=', 1);


            if (isset($param['isUser'])) {
                $where[] = array('types', '=', $param['isUser']);
                $pageParam['isUser'] = $param['isUser'];
            }
            //搜索类型
            if (isset($param['search_type']) && $param['search_type'] && isset($param['search_content']) && $param['search_content']) {
                switch ($param['search_type']) {
                    case 'remarks':
                        $where[] = array('remarks', 'like', '%' . $param['search_content'] . '%');
                        break;
                    default:
                        $where[] = array($param['search_type'], '=', $param['search_content']);
                        break;
                }
            }
            //var_dump($where);
            //交易类型
            //if(isset($param['trade_type']) && $param['trade_type']){
            if (isset($param['trade_type']) && intval($param['trade_type']) > 0) {
                $where[] = array('ly_trade_details.trade_type', '=', $param['trade_type']);
            }

            //交易金额
            if (isset($param['price1']) && $param['price1']) {
                $where[] = array('trade_amount', '>=', $param['price1']);
            }
            //交易金额
            if (isset($param['price2']) && $param['price2']) {
                $where[] = array('trade_amount', '<=', $param['price2']);
            }
            //时间
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = array('trade_time', '>=', strtotime($dateTime[0]));
                $where[] = array('trade_time', '<=', strtotime($dateTime[1]));
            } else {
                $todayStart = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $where[] = array('trade_time', '>=', $todayStart);
                $todayEnd = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
                $where[] = array('trade_time', '<=', $todayEnd);
            }

            //$count              = model('TradeDetails')->where($where)->count(); // 总记录数
            $touserid = isset($param['touserid']) ? intval($param['touserid']) : $this->userid;

            //$count = model('TradeDetails')->count();
            $count = model('TradeDetails')->where('sid', $touserid)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'trade_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //var_dump($where);exit;
            //查询符合条件的数据->where('sid', $this->userid)
            $data = $do->alias('ut')
                ->join('ly_trade_details', 'ut.team=ly_trade_details.uid')
                ->where('ut.uid', $touserid)
                ->where($where)
                ->order($param['sortField'], $param['sortType'])
                ->limit($limitOffset, $param['limit'])
                ->select()
                ->toArray();
            //$data = model('TradeDetails')->where('sid', $touserid)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();
            // 团队余额ly_trade_details
            //round($do->alias('ut')->join('trade_details','ut.team=trade_details.uid')->where('ut.uid','=',$this->userid)->sum('balance'),2);
            //部分元素重新赋值
            $tradeType = config('custom.transactionType');//交易类型
            $orderColor = config('manage.color');
            $adminColor = config('manage.adminColor');
            foreach ($data as $key => &$value) {
                $value['trade_time'] = date('Y-m-d H:i:s', $value['trade_time']);
                $value['tradeType'] = $tradeType[$value['trade_type']];
                $value['tradeTypeColor'] = $adminColor[$value['trade_type']];
                $value['statusStr'] = config('custom.tradedetailsStatus')[$value['state']];
                $value['statusColor'] = $orderColor[$value['state']];
                $value['front_type_str'] = config('custom.front_type')[$value['front_type']];
                $value['payway_str'] = config('custom.payway')[$value['payway']];
            }

            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }

        return view();
    }

    /**
     * 用户编辑
     */
    public function useredit()
    {
        if (request()->isAjax()) {
            return model('Users')->useredit();
        }

        $data = model('Users')->editView();

        $this->assign('userInfo', $data['userInfo']);
        //权限
        $this->assign('power', $data['power']);
        //账号状态
        $this->assign('userState', $data['userState']);

        return $this->fetch();
    }

    public function _empty($name)
    {
        //echo $name;
        //return view($name);
    }

    public function recharge_record()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $touserid = isset($param['touserid']) ? intval($param['touserid']) : $this->userid;
            //查询条件组装
            $where = array();
            $where[] = ['user_team.uid', '=', $touserid];
            $where[] = array('ly_user_recharge.type', '<>', 0);
            //用户名搜索
            if (isset($param['user_type']) && $param['user_type']) {
                $where[] = array('users.user_type', '=', $param['user_type']);
            }
            if (isset($param['username']) && $param['username']) {
                $uid = model('Users')->where('username', $param['username'])->value('id');
                $where[] = array('ly_user_recharge.uid', '=', $uid);
            }
            //订单号搜索
            if (isset($param['order_number']) && $param['order_number']) {
                $where[] = array('order_number', '=', $param['order_number']);
            }
            //状态搜索
            if (isset($param['state']) && $param['state']) {
                $where[] = array('ly_user_recharge.state', '=', $param['state']);
            }
            // 时间
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = array('add_time', '>=', strtotime($dateTime[0]));
                $where[] = array('add_time', '<=', strtotime($dateTime[1]));
            } else {
                $todayStart = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $where[] = array('add_time', '>=', $todayStart);
                $todayEnd = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
                $where[] = array('add_time', '<=', $todayEnd);
            }
            $count = model('UserRecharge')
                ->join('users', 'ly_user_recharge.uid = users.id')
                ->join('user_team', 'users.id = user_team.team')
                ->join('rechange_type', 'ly_user_recharge.type=rechange_type.id', 'left')
                ->where($where)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'ly_user_recharge.add_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('UserRecharge')
                ->field('ly_user_recharge.*,users.username,rechange_type.name')
                ->join('users', 'ly_user_recharge.uid = users.id')
                ->join('user_team', 'users.id = user_team.team')
                ->join('rechange_type', 'ly_user_recharge.type=rechange_type.id', 'left')
                ->where($where)
                ->order($param['sortField'], $param['sortType'])
                ->limit($limitOffset, $param['limit'])
                ->select()
                ->toArray();
            foreach ($data as $key => &$value) {
                switch ($value['state']) {
                    case '1':
                        $value['statusStr'] = '成功';
                        break;
                    case '2':
                        $value['statusStr'] = '失败';
                        break;
                    default:
                        $value['statusStr'] = '处理中';
                        break;
                }
                $value['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                $value['dispose_time'] = date('Y-m-d H:i:s', $value['dispose_time']);
                if ($value['daozhang_money'] <= 0) {
                    $value['daozhang_money'] = $value['money'];
                }
            }
            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }
        return $this->fetch();
    }

    /**
     * 资金操作
     */
    public function capital()
    {
        $this->error('无权限');
        if (request()->isAjax()) {
            return model('manage/UserTotal')->capital();
        }
        $data = model('manage/UserTotal')->capitalView();

        $this->assign('id', $data['id']);
        $this->assign('balance', $data['balance']);
        //交易类型
        $this->assign('transactionType', config('custom.transactionType'));

        return $this->fetch();
    }
    
    
    /**
     * 提现记录
     */
    public function present_record()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            //查询条件组装
            $uid = $this->userid;
            $where = array();
            if (isset($param['user_type']) && $param['user_type']) {
                $where[] = array('users.user_type', '=', $param['user_type']);
            }
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
                        $where[] = array('ly_user_withdrawals.order_number', '=', $param['search_c']);
                        break;
                    case 'card_name':
                        $where[] = array('ly_user_withdrawals.card_name', '=', $param['search_c']);
                        break;
                    case 'card_number':
                        $where[] = array('ly_user_withdrawals.card_number', '=', $param['search_c']);
                        break;
                }
            }

            //状态搜索
            if (isset($param['state']) && $param['state']) {
                $where[] = array('ly_user_withdrawals.state', '=', $param['state']);
            }
            // 时间
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = array('ly_user_withdrawals.time', '>=', strtotime($dateTime[0]));
                $where[] = array('ly_user_withdrawals.time', '<=', strtotime($dateTime[1]));
            } else {
                $todayStart = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $where[] = array('ly_user_withdrawals.time', '>=', $todayStart);
                $todayEnd = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
                $where[] = array('ly_user_withdrawals.time', '<=', $todayEnd);
            }

            $count = model('UserWithdrawals')->join('users', 'ly_user_withdrawals.uid = users.id')->join('manage', 'ly_user_withdrawals.aid = manage.id', 'left')->join('bank', 'ly_user_withdrawals.bank_id = bank.id', 'left')->where($where)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('UserWithdrawals')
                ->field('ly_user_withdrawals.*,manage.username as aname,users.username,danger,bank.bank_name')
                ->join('users', 'ly_user_withdrawals.uid = users.id')
                ->join('manage', 'ly_user_withdrawals.aid = manage.id', 'left')
                ->join('bank', 'ly_user_withdrawals.bank_id = bank.id', 'left')
                ->join('user_team', 'users.id = user_team.team','left')
                ->where('user_team.uid', '=', $uid)
                ->where($where)
                ->order($param['sortField'], $param['sortType'])
                ->limit($limitOffset, $param['limit'])
                ->select()->toArray();
            foreach ($data as $key => &$value) {
                switch ($value['state']) {
                    case '1':
                        $value['statusStr'] = '成功';
                        break;
                    case '2':
                        $value['statusStr'] = '失败';
                        break;
                    case '5':
                        $value['statusStr'] = '出款失败';
                        break;
                    case '6':
                        $value['statusStr'] = '出款成功';
                        break;
                    default:
                        $value['statusStr'] = '处理中';
                        break;
                }
                $value['time'] = date('Y-m-d H:i:s', $value['time']);
                $value['set_time'] = date('Y-m-d H:i:s', $value['set_time']);
                $value['bank_name'] = '';
                if ($value['user_bank_id']) {
                    $value['bank_name'] = model('UserBank')->where('id', $value['user_bank_id'])->value('bank_name');
                }
            }

            //权限查询
            // if ($count) $data['power'] = model('ManageUserRole')->getUserPower(['uid'=>session('manage_userid')]);

            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }


        return view();
    }
    
    
    
    
    public function bank()
    {
        if (request()->isAjax()) {
            $param = input('post.');//获取参数
            $uid = $this->userid;
            //查询条件组装
            $where = array();
            //用户名搜索
            if (isset($param['username']) && $param['username']) {
                $where[] = array('users.username', '=', $param['username']);
            }
            //账户名搜索
            if (isset($param['name']) && $param['name']) {
                $where[] = array('name', '=', $param['name']);
            }
            //账号搜索
            if (isset($param['card_no']) && $param['card_no']) {
                $where[] = array('card_no', '=', $param['card_no']);
            }
            //绑定时间搜索
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = array('ly_user_bank.add_time', '>=', strtotime($dateTime[0]));
                $where[] = array('ly_user_bank.add_time', '<=', strtotime($dateTime[1]));
            }

            $count = model('UserBank')->join('users', 'ly_user_bank.uid = users.id')->where($where)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'ly_user_bank.id';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('UserBank')
                ->field('ly_user_bank.*,users.username')
                ->join('users', 'ly_user_bank.uid = users.id','left')
                ->join('user_team', 'user_team.team = users.id','left')
                ->where('user_team.uid', $uid)
                ->where($where)
                ->order($param['sortField'], $param['sortType'])
                ->limit($limitOffset, $param['limit'])
                ->select()
                ->toArray();
            $adminColor = config('manage.adminColor');
            //部分元素重新赋值
            foreach ($data as $key => &$value) {
                $value['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                $value['statusColor'] = $adminColor[$value['status']];
                switch ($value['status']) {
                    case '2':
                        $value['status'] = '锁定';
                        break;
                    case '3':
                        $value['status'] = '删除';
                        break;
                    default:
                        $value['status'] = '正常';
                        break;
                }
            }

            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }
        return view();
    }
    
    public function userTaskList()
    {
        if (request()->isAjax()) {

            $param = input('param.');
            $uid = $this->userid;
            //查询条件初始化
            $where = array();

            // 用户名
            if (isset($param['username']) && $param['username']) {
                $where[] = array(['ly_user_task.username', '=', $param['username']]);
            }

            // 状态
            if (isset($param['status']) && $param['status']) {
                $where[] = array(['ly_user_task.status', '=', $param['status']]);
            }

            // 时间
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = ['ly_user_task.add_time', 'between time', [$dateTime[0], $dateTime[1]]];
            } else {
                $todayStart = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $todayEnd = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
                $where[] = ['ly_user_task.add_time', 'between time', [$todayStart, $todayEnd]];
            }

            $count = model('UserTask')
                ->join('ly_task', 'ly_task.id=ly_user_task.task_id','left')
                ->join('ly_user_team', 'ly_user_team.team=ly_user_task.uid','left')
                ->where('ly_user_team.uid', $uid)
                ->where($where)
                ->count(); // 总记录数


            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 10; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'trial_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('UserTask')
                ->field('ly_task.title,ly_user_task.*')
                ->join('ly_task', 'ly_task.id=ly_user_task.task_id','left')
                ->join('ly_user_team', 'ly_user_team.team=ly_user_task.uid','left')
                ->where('ly_user_team.uid', $uid)
                ->where($where)
                ->order($param['sortField'], $param['sortType'])
                ->limit($limitOffset, $param['limit'])
                ->select()
                ->toArray();
                

            foreach ($data as $key => &$value) {
                $value['statusStr'] = config('custom.cntaskOrderStatus')[$value['status']];
                $value['add_time'] = ($value['add_time']) ? date('Y-m-d H:i:s', $value['add_time']) : '';//接单时间
                $value['o_id'] = $value['id'];//接单时间
            }

            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }
        
        return view('');
    }
}
