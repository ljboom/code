<?php

namespace app\manage\controller;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use app\manage\controller\Common;

class UserController extends CommonController
{
    /**
     * 空操作处理
     */
    public function _empty()
    {
        return $this->UserList();
    }

    /**
     * 用户列表
     */
    public function userList()
    {
        if (request()->isAjax()) {
            //获取参数
            $param = input('post.');
            //查询条件组装
            $where = [];

            //用户名
            if (isset($param['username']) && $param['username']) {
                $where[] = ['ly_users.username', 'like', '%' . $param['username'] . '%'];
            }
            //用户名
            if (isset($param['uid']) && $param['uid']) {
                $where[] = ['ly_users.uid', '=', $param['uid']];
            }
            if (isset($param['ip']) && $param['ip']) {
                $where[] = ['ly_users.zcip', '=', $param['ip']];
            }
            if (isset($param['last_ip']) && $param['last_ip']) {
                $where[] = ['ly_users.last_ip', '=', $param['last_ip']];
            }
            if (isset($param['is_double']) && $param['is_double']) {
                $where[] = ['ly_users.is_double', '=', $param['is_double']];
            }

            if (isset($param['user_type']) && $param['user_type']) {
                $where[] = ['ly_users.user_type', '=', $param['user_type']];
            }
            if (isset($param['vip_level']) && $param['vip_level']) {
                $where[] = ['ly_users.vip_level', '=', $param['vip_level']];
            }

            //邀请码 推荐人
            if (isset($param['idcode']) && $param['idcode']) {
                $where[] = ['ly_users.recommend', '=', $param['idcode']];
            }

            //用户名
            if (isset($param['balance1']) && $param['balance1']) {
                $where[] = ['user_total.balance', '>=', $param['balance1']];
            }
            //用户名
            if (isset($param['balance2']) && $param['balance2']) {
                $where[] = ['user_total.balance', '<=', $param['balance2']];
            }
            //用户名
            if (isset($param['state']) && $param['state']) {
                $where[] = ['ly_users.state', '=', $param['state']];
            }
            //用户名
            if (isset($param['is_automatic']) && $param['is_automatic']) {
                $where[] = ['ly_users.is_automatic', '=', $param['is_automatic']];
            }
            // 时间
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = ['reg_time', '>=', strtotime($dateTime[0])];
                $where[] = ['reg_time', '<=', strtotime($dateTime[1])];
            }

            $count = model('Users')
                ->join('user_total', 'ly_users.id = user_total.uid')
                //->join('user_team', 'ly_users.id = team.uid')
                ->where($where)
                ->count();// 总记录数
            //$count1              = model('UserVip')->where($where)->count(); // 总记录数
            $count1 = model('Users')
                ->join('user_total', 'ly_users.id = user_total.uid')
                ->join('user_vip', 'ly_users.id = user_vip.uid')
                //->join('user_team', 'ly_users.id = team.uid')
                ->where($where)
                ->count();
            //$data1 = model('UserVip')->where($where)->find();
            //$data1 = model('UserVip')->where($where)->select()->toArray();
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'reg_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('Users')
                ->field(['ly_users.*', 'user_total.balance', 'user_total.total_balance'])
                ->join('user_total', 'ly_users.id = user_total.uid')
                //->join('user_team', 'ly_users.id = user_team.team'),'user_team.uid as team_id'
                ->where($where)
                ->order($param['sortField'], $param['sortType'])
                ->limit($limitOffset, $param['limit'])
                ->select()
                ->toArray();

            //$data1 = model('Users')->field(['ly_users.*','user_vip.name','user_total.balance','user_total.total_balance'])->join('user_total','ly_users.id = user_total.uid')->join('user_vip','ly_users.id = user_vip.uid')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();

            $userState = config('custom.userState');//账号状态
            foreach ($data as $key => &$value) {
                $value['reg_time'] = date('Y-m-d H:i:s', $value['reg_time']);
                $value['stateStr'] = $userState[$value['state']];
                $value['isOnline'] = (cache('C_token_' . $value['id'])) ? '在线' : '离线';
            }
            
            
            foreach($data as $k => &$v){
                //查找代理线
                //$v['reg_time'] = date('Y-m-d H:i:s', $v['reg_time']);
                $teams = model('Users')
                    ->field('ly_users.id,ly_users.username')
                    ->join('ly_user_team', 'ly_users.id = ly_user_team.uid')
                    ->where('user_type', 1)
                    ->where('ly_user_team.team', $v['id'])
                    ->find();
                if($teams){
                    $v['team_id']          = $teams['id'];
                    $v['team_username']    = $teams['username'];
                }
                //总充值
                $v['chongzhi'] = model('UserRecharge')
                    ->where('uid',$v['id'])
                    ->where('state', 1)
                    ->sum('money');
                //总提现
                $v['tixian'] = model('UserWithdrawals')
                    ->where('uid', $v['id'])
                    ->where('state', 'in', [1,3])
                    ->sum('price');
                    
                //收益宝余额
                $v['shouyibao'] = 0.00;
                $syb = model('YuebaoBatch')
                    ->where('uid', $v['id'])
                    ->where('is_back', 0)
                    ->select();
                if($syb) foreach ($syb as $sk => $sv){
                    $v['shouyibao'] = round($v['shouyibao'] + $sv['money'] + $sv['income'], 2);
                }
            }
            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                //'count1' => $count1,
                'data' => $data,
                //'data1'  => $data1
            ]);
        }

        return view('', [
            'level_list' => model('UserGrade')->column('name', 'grade')
        ]);
    }

    /**
     * 添加账号
     */
    public function add()
    {
        if (request()->isAjax()) {
            return model('Users')->add();
        }

        return view('', [

        ]);
    }

    /**
     * 用户编辑
     */
    public function edit()
    {
        if (request()->isAjax()) {
            return model('Users')->edit();
        }

        $data = model('Users')->editView();

        $this->assign('userInfo', $data['userInfo']);
        //权限
        $this->assign('power', $data['power']);
        //账号状态
        $this->assign('userState', $data['userState']);

        return $this->fetch();
    }

    /**
     * 风险账号
     */
    public function isAdmin()
    {
        return model('Users')->isAdmin();
    }

    /**
     * 风险账号
     */
    public function risk()
    {
        return model('Users')->risk();
    }

    /**
     * 工资
     */
    public function wages()
    {
        return model('Users')->wages();
    }

    /**
     * 亏损工资
     */
    public function loss()
    {
        return model('Users')->loss();
    }

    /**
     * 分红
     */
    public function bonus()
    {
        return model('Users')->bonus();
    }

    /**
     * 锁定账号
     */
    public function lockAccount()
    {
        return model('Users')->lockAccount();
    }

    /**
     * 锁定账号
     */
    public function lockAccountt()
    {
        return model('Users')->lockAccountt();
    }

    /**
     * 锁定
     */
    public function locking()
    {
        if (request()->isAjax()) {
            return model('Users')->locking();
        }
        $data = model('Users')->lockView();
        //参数
        $this->assign('param', $data['param']);
        //获取用户安全问题
        $this->assign('questionAndaAnswer', $data['questionAndaAnswer']);

        return $this->fetch();
    }

    /**
     * 删除操作
     */
    public function del()
    {
        return model('Users')->del();
    }

    /**
     * 资金操作
     */
    public function capital()
    {
        if (request()->isAjax()) {
            return model('UserTotal')->capital();
        }
        $data = model('UserTotal')->capitalView();

        $this->assign('id', $data['id']);
        $this->assign('balance', $data['balance']);
        //交易类型
        $this->assign('transactionType', config('custom.transactionType'));

        return $this->fetch();
    }

    /**
     * 用户工资
     */
    public function set_wages()
    {
        if (request()->isAjax()) {
            return model('WagePlan')->setWages();
        }
        $data = model('WagePlan')->setWagesView();

        $this->assign('uid', $data['uid']);
        $this->assign('userWagePlan', $data['userWagePlan']);

        return $this->fetch();
    }

    /**
     * 用户分红
     */
    public function set_bonus()
    {
        if (request()->isAjax()) {
            return model('BonusPlan')->setBonus();
        }
        $data = model('BonusPlan')->setBonusView();

        $this->assign('uid', $data['uid']);
        $this->assign('userBonusPlan', $data['userBonusPlan']);

        return $this->fetch();
    }

    /**
     * 代理迁移
     */
    public function team_move()
    {
        if (request()->isAjax()) {
            return model('Users')->teamMove();
        }
        $data = model('TeammoveLog')->teamMoveView();

        $this->assign('teammoveLog', $data['teammoveLog']);
        $this->assign('page', $data['page']);

        return $this->fetch();
    }

    /**
     * 用户银行
     */
    public function bank()
    {
        if (request()->isAjax()) {
            $param = input('post.');//获取参数
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
            $data = model('UserBank')->field('ly_user_bank.*,users.username')->join('users', 'ly_user_bank.uid = users.id')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();
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

    /**
     * 关系树
     */
    public function relation()
    {
        if (request()->isAjax()) {
            $param = input('param.');

            $newUser = model('Users')
                ->alias('u')
                ->field('u.id,username as title,u.sid as field,u.vip_level,u.reg_time');
            $topUid = 0;
            $where = [];
            if (isset($param['username']) && $param['username']) {
                $topUid = model('Users')->where('username', $param['username'])->value('id');
                if (!$topUid) return json(['code' => 0, 'data' => [], 'msg' => '查无此人']);
                $dataIds = [];
                model('UserTeam')->getRealAllSonIds($topUid, $dataIds);
                if (!$dataIds) return json(['code' => 0, 'data' => [], 'msg' => $param['username'] . '没有下属会员']);
                $newUser->where('u.id', 'in', $dataIds);
            }
            $array = $newUser->select()->toArray();
            if (!$array) return json(['code' => 0, 'data' => [], 'msg' => '查无此人']);

            $res = [];
            $tree = [];
            $one = [];

            //整理数组
            foreach ($array as $key => $value) {
                //$value['title'] .= '(VIP' . ($value['vip_level'] - 1) . ')';
                $value['title'] .= '&nbsp;&nbsp;(VIP' . ($value['vip_level'] - 1) . ')';
                //unset($value['vip_level']);
                $res[$value['id']] = $value;
                $res[$value['id']]['children'] = [];
                $res[$value['id']]['ids'] = [];
                $res[$value['id']]['vip'] = [];
            }
            unset($array);

            //查询子孙
            foreach ($res as $key => $value) {
                if ($value['field'] != 0) {
                    $res[$value['field']]['children'][] = &$res[$key];
                    $res[$value['field']]['ids'][] = &$res[$key]['id'];
                    if($res[$key]['vip_level'] > 1){
                        $res[$value['field']]['vip'][] = &$res[$key]['vip_level'];
                    }
                }
            }

            //去除杂质
            $num = $vip_num = 0;
            foreach ($res as $key => $value) {
                if (!isset($value['title'])) {
                    unset($res[$key]);
                    continue;
                }
                //$tree[$key]['num'] = arr_foreach($value['ids']);
                $num = count($value['ids']);
                $vip_num = count($value['vip']);
                
                if ($value['field'] == $topUid) {
                    $tree[$key] = $value;
                    $tree[$key]['title'] = $tree[$key]['title'] . ' 团队人数：'.$num.'人';
                    $tree[$key]['title'] = $tree[$key]['title'] . ' 直推vip人数：'.$vip_num.'人';
                    $tree[$key]['title'] = $tree[$key]['title'] . ' 注册时间：'.date('Y-m-d H:i:s', $value['reg_time']);
                }
                /*
                else{
                    $tree[$key]['title'] = $tree[$key]['title'] . ' 团队人数：'.$num.'人';
                    $tree[$key]['title'] = $tree[$key]['title'] . ' 直推vip人数：'.$vip_num.'人';
                    $tree[$key]['title'] = $tree[$key]['title'] . ' 注册时间：'.date('Y-m-d H:i:s', $value['reg_time']);
                }
                */

            }
            unset($res);

            return json(['code' => 1, 'data' => $tree, 'msg' => 'ok']);
        }

        return view();
    }
    /**
     * 开户规则
     */
    public function openRule()
    {

        $data = model('UserReg')->openRule();

        $this->assign('openRule', $data['openRule']);
        $this->assign('page', $data['page']);
        $this->assign('power', $data['power']);

        return $this->fetch();
    }

    /**
     * 开户规则添加
     */
    public function ruleAdd()
    {
        if (request()->isAjax()) {
            return model('UserReg')->ruleAdd();
        }

        $data = model('UserReg')->ruleAddView();

        $this->assign('uid', $data);

        return $this->fetch();
    }

    /**
     * 开户规则编辑
     */
    public function ruleEdit()
    {
        if (request()->isAjax()) {
            return model('UserReg')->ruleEdit();
        }

        $data = model('UserReg')->ruleEditView();

        $this->assign('rule', $data);

        return $this->fetch('user/rule_add');
    }

    /**
     * 注册链接
     * @return [type] [description]
     */
    public function userLink()
    {

        $data = model('UserLink')->linkList();

        return view('', [
            'where' => $data['where'],
            'linkList' => $data['linkList'],
            'page' => $data['page'],
            'power' => $data['power'],
        ]);
    }

    public function qrcodeList()
    {
        $data = model('Qrcode')->qrcodeList();

        return view('', [
            'where' => $data['where'],
            'qrcodeList' => $data['qrcodeList'],
            'page' => $data['page'],
            'power' => $data['power'],
        ]);
    }

    /**
     * 是否启用
     * @return [type] [description]
     */
    public function qrcodeEnable()
    {
        return model('Qrcode')->setFieldValue();
    }

    /**
     * 私信
     */
    public function secret()
    {
        if (request()->isAjax()) return model('Message')->secret();

        $param = input('get.');

        return view('', [
            'uid' => $param['id'],
        ]);
    }

    /**
     * 抢单会员
     * @return [type] [description]
     */
    public function robOrderUser()
    {
        $data = model('Order')->robOrderUser();

        return view('', [
            'data' => $data,
        ]);
    }

    /**
     * 人工存提
     * @return [type] [description]
     */
    public function artificialAction()
    {
        if (request()->isAjax()) return model('Users')->artificialAction();

        return view();
    }

    /**
     * 获取EXCEL数据
     * @return [type] [description]
     */
    public function getExcelData()
    {
        $file = $_FILES;
        
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file['file']['tmp_name']); // 载入excel文件
        if (!$spreadsheet) {
            return json([
                'code' => 0,
                'exp' => '文件不存在！',
            ]);
        }

        $sheet = $spreadsheet->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数
        $data = [];

        //行号从1开始
        for ($row = 1; $row <= $highestRow; $row++) {
            //列数是以A列开始
            for ($column = 'A'; $column <= $highestColumm; $column++) {

                $data[$row][$column] = $sheet->getCell($column . $row)->getValue();

            }
        }

        //字段判断
        if (!in_array('用户名', $data[1]) || !in_array('金额', $data[1]) || !in_array('说明', $data[1])) {
            return json([
                'code' => 0,
                'exp' => '请在文件内首行指明用户名、金额、说明等字段',
            ]);
        }

        session('artificialBatchData', $data);

        return json([
            'code' => 1,
            'exp' => '导入成功！',
        ]);
    }

    /**
     * 人工存提批量处理
     * @return [type] [description]
     */
    public function artificialBatch()
    {
        if (request()->isAjax()) {
            return model('Users')->artificialBatch();
        }

        return view();
    }

    /**
     * 用户等级
     */
    public function userLevel()
    {
        if (request()->isAjax()) {
            //获取参数
            $param = input('post.');
            //查询条件组装
            $where = [];

            //用户名
            if (isset($param['username']) && $param['username']) {
                $where[] = ['username', 'like', '%' . $param['username'] . '%'];
            }
            // 时间
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = array('reg_time', '>=', strtotime($dateTime[0]));
                $where[] = array('reg_time', '<=', strtotime($dateTime[1]));
            }

            $count = model('UserGrade')->where($where)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'id';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'asc';

            //查询符合条件的数据
            $data = model('UserGrade')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();

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
     * 用户等级添加
     */
    public function userLevelAdd()
    {
        if (request()->isAjax()) return model('UserGrade')->userLevelAdd();

        return view();
    }

    /**
     * 用户等级编辑
     */
    public function userLevelEdit()
    {
        if (request()->isAjax()) return model('UserGrade')->userLevelEdit();

        $param = input('param.');

        $data = model('UserGrade')->where('id', $param['id'])->find();

        return view('', [
            'data' => $data
        ]);
    }

    /**
     * 用户银行
     */
    public function userVip()
    {
        if (request()->isAjax()) {
            $param = input('post.');//获取参数
            //查询条件组装
            $where = array();
            //用户名搜索
            if (isset($param['username']) && $param['username']) {
                $where[] = array('username', '=', $param['username']);
            }


            if (isset($param['stime']) && $param['stime']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = array('stime', '>=', strtotime($dateTime[0]));
                $where[] = array('etime', '<=', strtotime($dateTime[1]));
            }

            $count = model('UserVip')->where($where)->count(); // 总记录数

            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'id';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('UserVip')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();
            $adminColor = config('manage.adminColor');
            //部分元素重新赋值
            foreach ($data as $key => &$value) {
                $value['statusColor'] = $adminColor[$value['state']];
                $value['stime'] = date('Y-m-d', $value['stime']);
                $value['etime'] = date('Y-m-d', $value['etime']);
                switch ($value['state']) {
                    case '2':
                        $value['state'] = '锁定';
                        break;
                    case '3':
                        $value['state'] = '过期';
                        break;
                    default:
                        $value['state'] = '正常';
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

    /**
     * 用户信用评估
     * @return [type] [description]
     */
    public function creditAssess()
    {
        return model('UserCredit')->assess();
    }
}