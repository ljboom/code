<?php
// +----------------------------------------------------------------------
// | Yzncms [ 御宅男工作室 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://yzncms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 御宅男 <530765310@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 用戶銀行卡管理
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Qcard as QcardModel;
use app\common\controller\Indexbase;
use think\facade\Session;

class Qcard extends Indexbase
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QcardModel;
    }
    
    // 查詢
    public function sel(){
        $arr = input('post.');
        $arr['quser_id'] = Session::get(bianliang(1));
        $res = $this->modelClass->selManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }
    
    //添加
    public function add()
    {
        $arr = input('post.');
        $arr['quser_id'] = Session::get(bianliang(1));
        $res = $this->modelClass->createManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }

    //编辑
    public function edit()
    {
        // $arr = input('post.');
        // $res = $this->modelClass->editManager($arr);
        // if($res['code'] == 200){
        //     return json_encode($res);
        // }else{
        //     return json_encode($res);
        // }
    }
    
    //刪除
    public function del()
    {
        $arr = input('post.');
        $arr['quser_id'] =  Session::get(bianliang(1));
        $res = $this->modelClass->delManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }
    
    
    
    
    
}