<?php

namespace app\agent\controller;


use app\api\model\UsersModel;
use app\api\model\YuebaojiluModel;
use app\api\model\YuebaoModel;

class YuebaoController extends CommonController
{
    public function index()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            // 总记录数
            $where = [];
            $where[] = ['user_team.uid', '=', $this->userid];
            if (isset($param['username']) && $param['username']) {
                $where[] = ['users.username', 'like', '%' . $param['username'] . '%'];
            }
            if (isset($param['state']) && intval($param['state']) > 0) {
                if($param['state'] == 2 ){
                    $where[] = ['y.is_back', 'in', array(0,1)];
                }else{
                    $where[] = ['y.is_back', '=', $param['state']];
                }
            }
            if (isset($param['datetime_range']) && $param['datetime_range']) {
                $dateTime = explode(' - ', $param['datetime_range']);
                $where[] = array('y.start_time', '>=', $dateTime[0]);
                $where[] = array('y.start_time', '<=', $dateTime[1]);
            }
            /*
            else {
                $where[] = array('y.start_time', '>=', date('Y-m-d') . ' 00:00:00');
                $where[] = array('y.start_time', '<=', date('Y-m-d') . ' 23:59:59');
            }
            */
            $YuebaoModel = new YuebaoModel();
            $YuebaojiluModel = new YuebaojiluModel();
            $UsersModel = new UsersModel();
            //$count = $YuebaojiluModel
            $count = model('api/Yuebaojilu')
                ->alias('y')
                ->join('users', 'users.id = y.uid')
                ->join('user_team', 'y.uid = user_team.team')
                ->where($where)
                ->count('y.id');
            // 每页记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15;
            // 当前页
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1;
            // 偏移量
            $limitOffset = ($param['page'] - 1) * $param['limit'];
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'id';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'asc';
            //查询符合条件的数据
            //$data = $YuebaojiluModel->alias('y')
            $data = model('api/Yuebaojilu')->alias('y')
                ->join('users', 'users.id = y.uid')
                ->join('user_team', 'y.uid = user_team.team')
                ->where($where)
                ->field('y.*')
                ->order($param['sortField'], $param['sortType'])
                ->limit($limitOffset, $param['limit'])
                ->select()
                ->toArray();
            foreach ($data as $key => $value) {
                $user = $UsersModel->where('id', $value['uid'])->find();
                if ($user) {
                    $value['username'] = $user['username'];
                } else {
                    $value['username'] = '';
                }
                $yuebao_item = $YuebaoModel->where('id', $value['pid'])->find();
                if ($yuebao_item) {
                    $value['title'] = $yuebao_item['title'];
                } else {
                    $value['title'] = '';
                }
                $value['starttime'] = date('Y-m-d', $value['starttime']);
                $value['endtime']   = date('Y-m-d', $value['endtime']);
                $value['is_back']   = ($value['is_back']==0) ? '未赎回' : '已赎回';
                
                $data[$key] = $value;
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
