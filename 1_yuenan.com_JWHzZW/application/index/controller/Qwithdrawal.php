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
// | 前台提前表
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Qwithdrawal as QwithdrawalModel;
use app\common\controller\Indexbase;
use think\facade\Session;


class Qwithdrawal extends Indexbase
{
    
    
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QwithdrawalModel;
    }
        
    /**
     * 提现查询
     */
    public function sel(){
        $quser_id=  Session::get(bianliang(1));
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
     *提现值添加
     */
    public function add(){
        $data = input('post.');
        $res['money'] = $data['money'];
        $res['qcard_id'] = $data['qcard_id'];
        $res['quser_id']=  Session::get(bianliang(1));
        if(empty($res['qcard_id']) || empty($res['money']) ){
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