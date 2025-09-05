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
// | 用户股票基金
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\QuserQstockservices as QuserQstockservicesModel;
use app\common\controller\Indexbase;
use think\facade\Session;

class Quserqstockservices extends Indexbase
{

    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QuserQstockservicesModel;
    }
    
    public function sel(){
        $arr = input('post.');
        $arr['quser_id'] =   Session::get(bianliang(1)) ;
        $res = $this->modelClass->selManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
        
    }
    public function sel_gupiao(){
        $arr = input('post.');
        $arr['quser_id'] =   Session::get(bianliang(1)) ;
        $res = $this->modelClass->sel_gupiao($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
        
    }
    
    public function add(){
        $arr = input('post.');
        $arr['quser_id'] =   Session::get(bianliang(1)) ;
        $res = $this->modelClass->addManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
        
    }
    
    public function del(){
        $arr = input('post.');
        $arr['quser_id'] =   Session::get(bianliang(1)) ;
        $res = $this->modelClass->delManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
        
    }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}