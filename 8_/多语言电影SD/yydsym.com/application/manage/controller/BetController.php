<?php

namespace app\manage\controller;

use app\manage\controller\Common;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class BetController extends CommonController
{
    /**
     * 空操作处理
     */
    public function _empty()
    {
        return $this->lists();
    }

    public function taskTplAdd()
    {
        return view('', [

        ]);
    }

    public function taskModelEdit()
    {
        if (request()->isAjax()) return model('TaskTpl')->edit();

        $id = input('get.id/d');
        $data = model('TaskTpl')->where('id', $id)->find();
        $data['end_time'] = ($data['end_time']) ? date('Y-m-d', $data['end_time']) : '';
        $data['finish_condition'] = json_decode($data['finish_condition'], true);
        $data['examine_demo'] = json_decode($data['examine_demo'], true);

        $data['task_step'] = json_decode($data['task_step'], true);
        $taskClass = model('TaskClass')->select()->toArray();
        $userLevel = model('UserGrade')->select()->toArray();

        return view('', [
            'data' => $data,
            'taskClass' => $taskClass,
            'userLevel' => $userLevel
        ]);
    }

    public function taskModelDel()
    {
        return model('TaskTpl')->del();
    }

    public function taskModelAdd()
    {
        if (request()->isAjax()) return model('TaskTpl')->add();

        $taskClass = model('TaskClass')->select()->toArray();
        $userLevel = model('UserGrade')->select()->toArray();

        return view('', [
            'taskClass' => $taskClass,
            'userLevel' => $userLevel
        ]);
    }

    public function taskModelList()
    {
        if (request()->isAjax()) {
            $param = input('param.');

            //查询条件初始化
            $where = array();
            // 模板名
            if (isset($param['name']) && $param['name']) {
                $where[] = array(['name', '=', $param['name']]);
            }

            // 标题
            if (isset($param['title']) && $param['title']) {
                $where[] = array('title', 'like', '%' . $param['title'] . '%');
            }


            $count = model('TaskTpl')->join('ly_task_class', 'ly_task_tpl.task_class=ly_task_class.id')->where($where)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 10; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'add_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('TaskTpl')->field('ly_task_tpl.*,ly_task_class.group_name')->join('ly_task_class', 'ly_task_tpl.task_class=ly_task_class.id')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();


            $t = time();
            $end_time = mktime(0, 0, 0, date("m", $t), date("d", $t), date("Y", $t));

            foreach ($data as $key => &$value) {

                $value['statusStr'] = config('custom.taskStatus')[$value['status']];
                if ($value['end_time'] < $end_time) {
                    $value['revoke'] = 1;
                } else {
                    $value['revoke'] = 0;
                }
                $value['task_type_str'] = config('custom.taskType')[$value['task_type']];
                $value['speed'] = $value['receive_number'] . '/' . $value['total_number'];
                if ($value['task_pump']) {
                    $value['speed_total_price'] = $value['total_price'] . '+' . $value['task_pump'];
                } else {
                    $value['speed_total_price'] = $value['total_price'];
                }
                if ($value['username']) {
                    $value['username'] = $value['username'];
                } else {
                    $value['username'] = '管理员';
                }
                $value['format_end_time'] = ($value['end_time']) ? date('Y-m-d', $value['end_time']) : '';
                $value['format_add_time'] = ($value['add_time']) ? date('Y-m-d H:i:s', $value['add_time']) : '';
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
     * 用户资金流水
     */
    public function financial()
    {
        if (request()->isAjax()) {
            $param = input('post.');

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
            //交易类型
            if (isset($param['trade_type']) && $param['trade_type']) {
                $where[] = array('trade_type', '=', $param['trade_type']);
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

            $count = model('TradeDetails')->where($where)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'trade_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('TradeDetails')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();
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
     * 商户资金流水
     */
    public function mfinancial()
    {
        if (request()->isAjax()) {
            $param = input('post.');

            //查询条件组装
            $where = array();
            $where[] = array('types', '=', 2);

            if (isset($param['isUser'])) {
                $where[] = array('types', '=', $param['isUser']);
                $pageParam['isUser'] = $param['isUser'];
            }
            //搜索类型
            if (isset($param['search_type']) && $param['search_type'] && isset($param['search_content']) && $param['search_content']) {
                switch ($param['search_type']) {
                    case 'remarks':
                        $where[] = array('remarks', 'like', '%' . trim($param['search_content']) . '%');
                        break;
                    default:
                        $where[] = array($param['search_type'], '=', trim($param['search_content']));
                        break;
                }
            }
            //交易类型
            if (isset($param['trade_type']) && $param['trade_type']) {
                $where[] = array('trade_type', '=', $param['trade_type']);
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

            $count = model('TradeDetails')->where($where)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'trade_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('TradeDetails')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();
            //部分元素重新赋值
            $tradeType = config('custom.transactionType');//交易类型
            $orderColor = config('manage.color');
            $adminColor = config('manage.adminColor');
            foreach ($data as $key => &$value) {
                $value['trade_time'] = date('Y-m-d H:i:s', $tradeType[$value['trade_time']]);
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

        return view('financial');
    }

    /**
     * 流水详情
     */
    public function financial_dateils()
    {
        $data = model('TradeDetails')->financialDateils();

        $this->assign('info', $data);

        return $this->fetch();
    }

    /**
     * 交易列表
     * @return [type] [description]
     */
    public function buytrans()
    {
        $data = model('UserTransaction')->transAction($bitype = 1);//买币
        return view('trans_action', [
            'data' => $data
        ]);
    }

    public function selltrans()
    {
        $data = model('UserTransaction')->transAction($bitype = 2);//卖币
        return view('trans_action', [
            'data' => $data
        ]);
    }

    //交易详情
    public function transdateils()
    {

        $data = model('UserTransaction')->transdateils();//卖币

        $this->assign('orderInfo', $data);

        return $this->fetch();
    }

    //交易订单操作
    public function operationtrans()
    {
        return model('UserTransaction')->operationtrans();
    }

    /**
     * 回调
     */
    public function callBack()
    {
        $id = input('post.id/d');
        $order = model('Order')->where('id', $id)->findOrEmpty();
        if (!$order) return '订单不存在';

        $callBackData = array(
            'uid' => $order['uid'],
            'merchantId' => model('Merchant')->where('id', $order['mid'])->value('merchantid'),
            'timestamp' => $order['timestamp'],
            'signatureMethod' => 'HmacSHA256',
            'signatureVersion' => 1,
            'orderId' => $order['orderid'],
            'status' => 3,
            'jOrderId' => $order['jorderid'],
            'notifyUrl' => base64_decode($order['notifyurl']),
            'orderType' => $order['ordertype'],
            'amount' => $order['oamount'],
            'currency' => $order['currency'],
            'actualAmount' => $order['oactualamount'],
            'fee' => $order['feeamount'],
            'payWay' => $order['payway'],
            'payTime' => $order['paytimes'],
            'jExtra' => base64_decode($order['jextra']),
            'mkey' => $order['mkey'],
        );
        model('api/Order')->Callback($callBackData);

        return 1;
    }

    /**
     * 添加项目
     * @return [type] [description]
     */
    public function taskAdd()
    {
        if (request()->isAjax()) return model('Task')->add();

        $taskClass = model('TaskClass')->select()->toArray();
        $userLevel = model('UserGrade')->select()->toArray();

        return view('', [
            'taskClass' => $taskClass,
            'userLevel' => $userLevel
        ]);
    }

    public function batchTaskYoutube()
    {
        if (request()->isAjax()) {
            $get_url = input('get_url');
            if (!$get_url) return '填写 YouTube 列表地址';
            $grade = input('grade/d');
            $task_class = 11;//YouTube
            $levelInfo = model('UserGrade')->where('grade', $grade)->find()->toArray();
            if (!$levelInfo) return '等级选择错误';
            $result = shell_exec('python /usr/local/bin/youtube-dl -j --flat-playlist "' . $get_url . '" | jq -r ".id" | sed "s_^_https://youtu.be/_" 2>&1');
            if ($result == 'NULL') return '采集失败';
            $result = explode("\n", $result);
            $list = [];
            foreach ($result as $val) {
                $val = trim($val);
                if ($val == '') continue;
                if (substr($val, 0, 4) != 'http') continue;
                $list[] = $val;
            }
            $i = 0;
            foreach ($list as $url) {
                if ($i == 100) continue;
                $this->batchAddTask($url, $task_class, $levelInfo);
                $i++;
            }
            return '本次采集入库：' . $i . '条';
        }
        //$userLevel = model('UserGrade')->select()->toArray();
        return view('', [
            'level_list' => model('UserGrade')->column('name', 'grade')
        ]);
    }

    private function batchAddTask($url, $task_class, $levelInfo)
    {
        $param = [];
        $param['title'] = '1';
        $param['task_type'] = 1;
        $param['task_level'] = $levelInfo['grade'];
        $param['task_class'] = $task_class;
        $param['content'] = '1';
        $param['reward_price'] = $levelInfo['commission'];
        $param['total_price'] = mt_rand(10000, 50000);
        $param['total_number'] = mt_rand(10000, 50000);
        $param['receive_number'] = mt_rand(1000, 5000);
        $param['link_info'] = $url;
        $param['end_time'] = time() + mt_rand(60, 150) * 86400;
        $param['finish_condition'] = '';
        $param['lang'] = config('app_lang');
        $param['examine_demo'] = '["\/upload\/image\/202201191940480267592892.jpg"]';
        $param['task_step'] = '[{"img":"\/upload\/image\/202201111033456264763743.png","describe":""}]';
        $param['add_time'] = time() - mt_rand(20, 150) * 86400;
        $param['status'] = 3;
        $param['remarks'] = '';
        $param['person_time'] = 1;
        $param['uid'] = 0;
        $param['username'] = '1' . mt_rand(50, 99) . '3745' . mt_rand(1483, 9789);
        $param['task_pump'] = 0;
        $param['surplus_number'] = $param['total_number'] - $param['receive_number'];
        $param['pump'] = 0;
        $param['order_number'] = 'B' . trading_number();
        $param['trade_number'] = 'L' . trading_number();
        $param['complete_time'] = 0;
        $param['requirement'] = '';
        $param['sp_icon'] = $param['cover_img'];
        return model('Task')->insert($param);
    }

    /**
     * 编辑项目
     * @return [type] [description]
     */
    public function taskEdit()
    {
        if (request()->isAjax()) return model('Task')->edit();

        $id = input('get.id/d');
        $data = model('Task')->where('id', $id)->find();
        $sp_icon = $data['sp_icon'];
        $tplid = input('get.tplid/d');
        if ($tplid) {
            $data = model('TaskTpl')->where('id', $tplid)->find();
            unset($data['id']);
        }


        $data['end_time'] = ($data['end_time']) ? date('Y-m-d', $data['end_time']) : '';
        $data['finish_condition'] = json_decode($data['finish_condition'], true);
        $data['examine_demo'] = json_decode($data['examine_demo'], true);

        $data['task_step'] = json_decode($data['task_step'], true);
        $data['sp_icon'] = $sp_icon;
        $taskClass = model('TaskClass')->select()->toArray();
        $userLevel = model('UserGrade')->select()->toArray();

        return view('', [
            'data' => $data,
            'taskClass' => $taskClass,
            'userLevel' => $userLevel,
            'tplid' => $tplid
        ]);
    }

    /**
     * 删除项目
     * @return [type] [description]
     */
    public function taskDel()
    {
        return model('Task')->del();
    }

    public function projectRecommend()
    {
        if (!request()->isAjax()) return '非法提交';
        $param = input('post.');//获取参数
        if (!$param) return '提交失败';
        //更新
        $updateRes = model('Project')->where('id', $param['id'])->setField('recommend', $param['val']);
        if (!$updateRes) return '修改失败';
        //添加操作日志
        $actionStr = $param['val'] == 2 ? '非' : '';
        $title = model('Project')->where('id', $param['id'])->value('title');
        model('Actionlog')->actionLog(session('manage_username'), '将项目' . $title . '设为' . $actionStr . '推荐', 1);

        return 1;
    }

    /**
     * 项目类型
     * @return [type] [description]
     */
    public function taskclass()
    {
        if (request()->isAjax()) {
            $param = input('post.');

            $count = model('TaskClass')->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'id';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('TaskClass')->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();
            foreach ($data as $key => &$value) {
                $value['stateStr'] = ($value['state'] == 1) ? '开启' : '关闭';
            }

            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }

        return view('task_class');
    }

    /**
     * 添加类型
     * @return [type] [description]
     */
    public function TaskClassAdd()
    {
        if (request()->isAjax()) return model('TaskClass')->TaskClassAdd();

        return view();
    }

    /**
     * 编辑类型
     * @return [type] [description]
     */
    public function TaskClassEdit()
    {
        if (request()->isAjax()) return model('TaskClass')->TaskClassEdit();

        $id = input('get.id/d');
        $data = model('TaskClass')->where('id', $id)->find();

        return view('', [
            'data' => $data
        ]);
    }

    /**
     * 删除类型
     * @return [type] [description]
     */
    public function TaskClassDel()
    {
        return model('TaskClass')->TaskClassDel();
    }

    /**
     * 返还方式
     * @return [type] [description]
     */
    public function returnType()
    {
        if (request()->isAjax()) {
            $param = input('post.');

            $count = model('RepaymentMethod')->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'id';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('RepaymentMethod')->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();
            foreach ($data as $key => &$value) {
                $value['stateStr'] = ($value['state'] == 1) ? '开启' : '关闭';
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
     * 添加方式
     * @return [type] [description]
     */
    public function returnTypeAdd()
    {
        if (request()->isAjax()) return model('RepaymentMethod')->projectTypeAdd();

        return view();
    }

    /**
     * 编辑类型
     * @return [type] [description]
     */
    public function returnTypeEdit()
    {
        if (request()->isAjax()) return model('RepaymentMethod')->projectTypeEdit();

        $id = input('get.id/d');
        $data = model('RepaymentMethod')->where('id', $id)->find();

        return view('', [
            'data' => $data
        ]);
    }

    /**
     * 删除方式
     * @return [type] [description]
     */
    public function returnTypeDel()
    {
        return model('RepaymentMethod')->projectTypeDel();
    }

    /**
     * 投资记录
     * @return [type] [description]
     */
    public function investList()
    {
        if (request()->isAjax()) {
            $param = input('post.');
            //查询条件组装
            $where = array();

            // 用户名
            if (isset($param['username']) && $param['username']) {
                $where[] = array('users.username', 'like', '%' . $param['username'] . '%');
            }
            // 项目
            if (isset($param['project']) && $param['project']) {
                $where[] = array('pid', 'like', '%' . $param['username'] . '%');
            }
            // 推荐
            if (isset($param['state']) && $param['state']) {
                $where[] = array('state', '=', $param['state']);
            }
            // 时间
            if (isset($param['date_range']) && $param['date_range']) {
                $dateTime = explode(' - ', $param['date_range']);
                $where[] = array('ly_order.add_time', '>=', strtotime($dateTime[0]));
                $where[] = array('ly_order.add_time', '<=', strtotime($dateTime[1]));
            }
            // else{
            // 	$todayStart = mktime(0,0,0,date('m'),date('d'),date('Y'));
            // 	$where[] = array('ly_order.add_time','>=',$todayStart);
            // 	$todayEnd = mktime(23,59,59,date('m'),date('d'),date('Y'));
            // 	$where[] = array('ly_order.add_time','<=',$todayEnd);
            // }

            $count = model('Order')->join('project', 'ly_order.pid=project.id')->join('users', 'ly_order.uid=users.id')->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'add_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('Order')
                ->field('ly_order.*,project.title,users.username,phone')
                ->join('project', 'ly_order.pid=project.id')
                ->join('users', 'ly_order.uid=users.id')
                ->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();
            foreach ($data as $key => &$value) {
                switch ($value['state']) {
                    case '1':
                        $value['stateStr'] = '完成';
                        break;
                    case '2':
                        $value['stateStr'] = '取消';
                        break;
                    default:
                        $value['stateStr'] = '进行中';
                        break;
                }
                $value['yieldRate'] = $value['daily_income'] . ' % + ' . $value['rebate'] . ' %';
                $value['bearing_day'] = date('Y-m-d H:i:s', $value['bearing_day']);
                $value['due_day'] = date('Y-m-d H:i:s', $value['due_day']);
                $value['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
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
     * 记录详情
     * @return [type] [description]
     */
    public function investDetails()
    {

    }

    /**
     * 查看合同
     * @return [type] [description]
     */
    public function investPact()
    {
        if (request()->isAjax()) return model('Order')->investPact();

        $id = input('get.id/d');
        $data = model('Order')->where('id', $id)->find()->toArray();

        return view('', [
            'data' => $data
        ]);
    }

    /**
     * 任务列表
     * @return [type] [description]
     */
    public function taskList()
    {
        if (request()->isAjax()) {
            $param = input('param.');

            //查询条件初始化
            $where = array();
            // 标题
            if (isset($param['username']) && $param['username']) {
                $where[] = array(['username', '=', $param['username']]);
            }
            if (isset($param['id']) && $param['id']) {
                $where[] = array(['ly_task.id', '=', $param['id']]);
            }
            if (isset($param['link_info']) && $param['link_info']) {
                $where[] = array(['ly_task.link_info', '=', $param['link_info']]);
            }

            // 标题
            if (isset($param['title']) && $param['title']) {
                $where[] = array('title', 'like', '%' . $param['title'] . '%');
            }

            // 状态
            if (isset($param['status']) && $param['status']) {
                $where[] = array(['status', '=', $param['status']]);
            }

            // 类型
            if (isset($param['task_type']) && $param['task_type']) {
                $where[] = array('task_type', '=', $param['task_type']);
            }
            //任务等级
            if (isset($param['task_level']) && $param['task_level']) {
                $where[] = array('task_level', '=', $param['task_level']);
            }
            // 分类
            if (isset($param['task_class']) && $param['task_class']) {
                $where[] = array('task_class', '=', $param['task_class']);
            }
            // 时间
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = ['add_time', 'between time', [$dateTime[0], $dateTime[1]]];
            } else {
                /*$todayStart = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 30 * 86400;
                $todayEnd = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
                $where[] = ['add_time', 'between time', [$todayStart, $todayEnd]];*/
            }
            //var_dump($where);exit;

            $count = model('Task')->join('ly_task_class', 'ly_task.task_class=ly_task_class.id')->where($where)->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 10; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'ly_task.id';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('Task')->field('ly_task.*,ly_task_class.group_name')->join('ly_task_class', 'ly_task.task_class=ly_task_class.id')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();


            $t = time();
            $end_time = mktime(0, 0, 0, date("m", $t), date("d", $t), date("Y", $t));

            foreach ($data as $key => &$value) {

                $value['statusStr'] = config('custom.taskStatus')[$value['status']];
                if ($value['end_time'] < $end_time) {
                    $value['revoke'] = 1;
                } else {
                    $value['revoke'] = 0;
                }
                $value['task_type_str'] = config('custom.taskType')[$value['task_type']];
                $value['speed'] = $value['receive_number'] . '/' . $value['total_number'];
                if ($value['task_pump']) {
                    $value['speed_total_price'] = $value['total_price'] . '+' . $value['task_pump'];
                } else {
                    $value['speed_total_price'] = $value['total_price'];
                }
                if ($value['username']) {
                    $value['username'] = $value['username'];
                } else {
                    $value['username'] = '管理员';
                }
                $value['format_end_time'] = ($value['end_time']) ? date('Y-m-d', $value['end_time']) : '';
                $value['format_add_time'] = ($value['add_time']) ? date('Y-m-d H:i:s', $value['add_time']) : '';
            }

            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }

        $taskClass = model('TaskClass')->select()->toArray();
        $gradeClass= model('UserGrade')->select()->toArray();
        return view('', [
            'taskClass' => $taskClass,
            'gradeClass' => $gradeClass,
        ]);
    }

    /**
     * 任务审核
     * @return [type] [description]
     */
    public function taskAudit()
    {
        if (request()->isAjax()) return model('Task')->audit();

        $id = input('get.id/d');

        $data = model('Task')->where('id', $id)->find();
        //$data['end_time']         = ($data['end_time']) ? date('Y-m-d', $data['end_time']) : '';
        //$data['finish_condition'] = json_decode($data['finish_condition'], true);
        //$data['task_step']        	= json_decode($data['task_step'], true);

        if ($data['examine_demo']) {
            $data['examine_demo'] = json_decode($data['examine_demo'], true);
        } else {
            $data['examine_demo'] = array();
        }

        $t = time();
        $end_time = mktime(0, 0, 0, date("m", $t), date("d", $t), date("Y", $t));
        $data['revoke'] = 0;//撤销
        if ($data['end_time'] < $end_time) {
            $data['revoke'] = 1;
        }

        $data['statusStr'] = config('custom.taskStatus')[$data['status']];
        //$taskClass                = model('TaskClass')->select()->toArray();

        return view('', [
            'data' => $data,
            //'taskClass' => $taskClass
        ]);
    }

    /**
     * 任务记录
     * @return [type] [description]
     */
    public function userTaskList()
    {
        if (request()->isAjax()) {

            $param = input('param.');

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

            $count = model('UserTask')->join('ly_task', 'ly_task.id=ly_user_task.task_id')->where($where)->count(); // 总记录数


            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 10; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'trial_time';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'desc';

            //查询符合条件的数据
            $data = model('UserTask')->field('ly_task.title,ly_user_task.*')->join('ly_task', 'ly_task.id=ly_user_task.task_id')->where($where)->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();

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

    /**
     * 任务记录审核
     * @return [type] [description]
     */
    public function userTaskAudit()
    {
        if (request()->isAjax()) return model('Task')->userTaskAudit();
        $id = input('get.id/d');
        $data = model('UserTask')->field('ly_task.content,ly_task.examine_demo,ly_task.title,ly_task.username,ly_task.link_info,ly_user_task.status as o_status,ly_user_task.id,ly_user_task.add_time as o_add_time,ly_user_task.username as o_username,ly_user_task.examine_demo as o_examine_demo,ly_user_task.trial_time,ly_user_task.id as order_id,ly_user_task.uid as o_uid,ly_user_task.username as o_username,ly_user_task.trial_remarks,ly_user_task.handle_remarks,ly_user_task.complete_time as o_complete_time,ly_user_task.handle_time')->join('ly_task', 'ly_task.id=ly_user_task.task_id')->where(array(['ly_user_task.id', '=', $id]))->find();
        if ($data['examine_demo']) {
            $data['examine_demo'] = json_decode($data['examine_demo'], true);
        } else {
            $data['examine_demo'] = array();
        }
        if ($data['o_examine_demo']) {
            if (strstr($data['o_examine_demo'], '[')) {
                $data['o_examine_demo'] = json_decode($data['o_examine_demo'], true);
            } else {
                $data['o_examine_demo'] = array($data['o_examine_demo']);
            }
        } else {
            $data['o_examine_demo'] = array();
        }
        $data['statusStr'] = config('custom.cntaskOrderStatus')[$data['o_status']];
        return view('', [
            'data' => $data,
        ]);
    }

    /**
     * 订单编辑
     * @return [type] [description]
     */
    public function userTaskEdit()
    {
        if (request()->isAjax()) return model('Task')->edit();

        $id = input('get.id/d');

        $data = model('UserTask')->field('ly_task.*,ly_user_task.status as o_status,ly_user_task.add_time as o_add_time,ly_user_task.username as o_username,ly_user_task.examine_demo as o_examine_demo,ly_user_task.trial_time,ly_user_task.id as order_id,ly_user_task.uid as o_uid,ly_user_task.username as o_username,ly_user_task.trial_remarks,ly_user_task.handle_remarks,ly_user_task.complete_time as o_complete_time,ly_user_task.handle_time')->join('ly_task', 'ly_task.id=ly_user_task.task_id')->where(array(['ly_user_task.id', '=', $id]))->find();
        $data['end_time'] = ($data['end_time']) ? date('Y-m-d', $data['end_time']) : '';
        $data['finish_condition'] = json_decode($data['finish_condition'], true);

        if ($data['task_step']) {
            $data['task_step'] = json_decode($data['task_step'], true);
        } else {
            $data['task_step'] = array();
        }

        if ($data['examine_demo']) {
            $data['examine_demo'] = json_decode($data['examine_demo'], true);
        } else {
            $data['examine_demo'] = array();
        }

        if ($data['o_examine_demo']) {
            if (strstr($data['o_examine_demo'], '[')) {
                $data['o_examine_demo'] = json_decode($data['o_examine_demo'], true);
            } else {
                $data['o_examine_demo'] = array($data['o_examine_demo']);
            }
        } else {
            $data['o_examine_demo'] = array();
        }


        $taskClass = model('TaskClass')->select()->toArray();
        $userLevel = model('UserGrade')->select()->toArray();

        return view('', [
            'data' => $data,
            'taskClass' => $taskClass,
            'userLevel' => $userLevel
        ]);
    }

}
