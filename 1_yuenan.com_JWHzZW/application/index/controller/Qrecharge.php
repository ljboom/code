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
// | 前台充值
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Qrecharge as QrechargeModel;
use app\common\controller\Indexbase;
use think\facade\Session;


class Qrecharge extends Indexbase
{
    
    
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QrechargeModel;
    }
    
    /**
     * 充值查询
     */
    public function sel(){
        $quser_id=  Session::get(bianliang(1));
        // $quser_id= 3;
        $res = $this->modelClass->where('quser_id',$quser_id)->field('number,money,reg_time,type')->order('id desc')->select()->toArray();
        foreach($res as $k => $v){
            if($v['type'] == 0 ){ $res[$k]['type'] = 'Đang xem xét';  }
            if($v['type'] == 1 ){ $res[$k]['type'] = 'Đi qua'; }
            if($v['type'] == 2 ){ $res[$k]['type'] = 'Từ chối';}
            $res[$k]['reg_time'] = date("Y-m-d H:i",$v['reg_time']);
        }
        if(!empty($res)){
            $data = code_msg(1);
            $data['data'] = $res;
        }else{
            $data = code_msg(2);
        }
        return json_encode($data);
        
    }
    
    
    /**
     * 充值添加
     */
    public function add(){
        $data = input('post.');
        // $res['tel'] = $data['tel'];
        // $res['tel'] = empty(Session::get(bianliang(3))) ? $data['tel'] : Session::get(bianliang(3)) ;
        $res['tel'] =  Session::get(bianliang(3)) ;
        $res['money'] = $data['money'];
        $res['qpassageway_id'] = $data['qpassageway_id'];
        if(empty($res['tel']) ||empty($res['money']) ||empty($res['qpassageway_id']) ){
            return json_encode(code_msg(3));
        }
        $res['type'] = 0;
        $res = $this->modelClass->createManager($res);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    } 
}