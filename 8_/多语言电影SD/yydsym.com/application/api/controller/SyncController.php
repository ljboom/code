<?php

namespace app\api\controller;

use think\Controller;
use think\Db;

class SyncController extends Controller
{
    public function task()
    {
        if (!$this->request->isPost()) {
            exit();
        }
        //最后的ID
        $password = $this->request->post('password/s', '');
        if ($password != 'marin99@sync') {
            return json([
                'code' => 0,
                'msg' => '密码错误'
            ]);
        }
        $id = $this->request->post('id/d', 0);
        $limit = $this->request->post('limit/d', 500);
        $list = Db::name('task')->where('id', '>', $id)
            ->limit($limit)->order('id asc')->select();
        header("Content-type:application/json");
        return json([
            'code' => 1,
            'msg' => 'success',
            'list' => $list,
            'limit' => $limit
        ]);
    }
}