<?php

namespace app\manage\controller;

use app\manage\controller\Common;

use app\api\model\YuebaoModel;
use app\api\model\YuebaojiluModel;
use app\api\model\UsersModel;

class YuebaoController extends CommonController
{
    /**
     * 空操作处理
     */
    public function _empty()
    {
        return $this->lists();
    }

    /**
     * 活动列表
     */
    public function lists()
    {
        if (request()->isAjax()) {
            $param = input('param.');

            $count = model('YuebaoList')->count(); // 总记录数
            $param['limit'] = (isset($param['limit']) and $param['limit']) ? $param['limit'] : 15; // 每页记录数
            $param['page'] = (isset($param['page']) and $param['page']) ? $param['page'] : 1; // 当前页
            $limitOffset = ($param['page'] - 1) * $param['limit']; // 偏移量
            $param['sortField'] = (isset($param['sortField']) && $param['sortField']) ? $param['sortField'] : 'id';
            $param['sortType'] = (isset($param['sortType']) && $param['sortType']) ? $param['sortType'] : 'asc';

            //查询符合条件的数据
            $data = model('YuebaoList')->order($param['sortField'], $param['sortType'])->limit($limitOffset, $param['limit'])->select()->toArray();


            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data
            ]);
        }

        return view();
    }

    public function jilulist()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $where = [];
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
                $where[] = array('y.starttime', '>=', strtotime($dateTime[0]));
                $where[] = array('y.endtime', '<=', strtotime($dateTime[1]));
            } 
            /*
            else {
                $where[] = array('y.starttime', '>=', strtotime(date('Y-m-d') . ' 00:00:00'));
                $where[] = array('y.endtime', '<=', strtotime(date('Y-m-d') . ' 23:59:59'));
            }
            */
            // 总记录数
            $YuebaoModel = new YuebaoModel();
            $YuebaojiluModel = new YuebaojiluModel();
            $UsersModel = new UsersModel();

            //$count = $YuebaojiluModel
            $count = model('api/Yuebaojilu')
                ->alias('y')
                ->join('users', 'users.id = y.uid')
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
                ->order('y.' . $param['sortField'], $param['sortType'])
                ->field('y.*')
                ->where($where)
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
                //
                $value['starttime'] = date('Y-m-d', $value['starttime']);
                $value['endtime']   = date('Y-m-d', $value['endtime']);
                $value['is_back']   = ($value['is_back']==0) ? '未赎回' : '已赎回';

                $data[$key] = $value;
            }

            return json([
                'code' => 0,
                'msg' => '',
                'count' => $count,
                'data' => $data,
                'where' => $where
            ]);
        }

        return view();
    }

    /**
     * 添加活动
     */
    public function add()
    {
        if (request()->isAjax()) {
            return model('YuebaoList')->YuebaoListAdd();
        }
        return $this->fetch();
    }

    /**
     * 活动开关
     */
    public function yuebaoOnoff()
    {
        return model('YuebaoList')->onOff();
    }

    /**
     * 活动删除
     */
    public function delete()
    {
        return model('YuebaoList')->yuebaoDel();
    }

    /**
     * 编辑活动
     */
    public function edit()
    {
        $data = model('YuebaoList')->yuebaoEditView();

        $this->assign('data', $data['data']);

        return $this->fetch();
    }
}