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
// |新购申购
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Qxingushengou as QxingushengouModel;
use app\index\model\Qchicang as QchicangModel;
use app\common\controller\Indexbase;
use think\facade\Session;
use think\Db;

class Qxingushengou extends Indexbase
{
    
    
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QxingushengouModel;
    }
        
    /**
     * 新购申购列表
     */
    public function sel(){
        $page = empty(input('post.page'))? 1 : input('post.page');
        // $quser_id=  empty(Session::get(bianliang(1))) ? input('post.quser_id') : Session::get(bianliang(1));
        $quser_id=   Session::get(bianliang(1));
        // $quser_id=  3;
        
        $res = $this->modelClass->where('quser_id',$quser_id)->field('id,qstocks_new_id,shengou_money,shengou_num,zhongqian_num,yirenji_money,status,reg_time,zhongqian_renji_money')
            ->order('id desc')->where('is_send',0)->page($page, 20)->select()->toArray();
        $time = time();   
        foreach($res as $k => $v){
            $qstockservices = Db::name('qstocks_new')->where('id',$v['qstocks_new_id'])->field('symbol_name,symbol,draw_date,roll_date')->find();
            $res[$k]['symbol']  = $qstockservices['symbol'];
            $res[$k]['symbol_name']  = $qstockservices['symbol_name'];
            $res[$k]['yukoukuan'] = date("m/d" ,strtotime($qstockservices['draw_date'])+3600*24).'~'.date("m/d" ,strtotime($qstockservices['draw_date'])+3600*24*3);
            $res[$k]['roll_date'] = $qstockservices['roll_date'];
            $res[$k]['draw_date'] = $qstockservices['draw_date'];
            if($v['status'] == 0){ $res[$k]['status_name'] = 'Chưa giải quyết';}
             elseif($v['status'] == 1){ 
                 $res[$k]['status_name'] = 'Trúng xổ số'; 
                 if($time >(strtotime($qstockservices['draw_date']) + 3600*24) && (strtotime($qstockservices['draw_date']) + 3600*24*5) > $time){
                     $res[$k]['status_name'] = 'Để được đăng ký'; 
                 }
             }
             elseif($v['status'] == 2){ $res[$k]['status_name'] = 'Không trúng số'; }
             elseif($v['status'] == 3){ $res[$k]['status_name'] = 'Đã đăng ký thành công'; }
             elseif($v['status'] == 4){ $res[$k]['status_name'] = 'Đăng ký không thành công'; }
             elseif($v['status'] == 5){ $res[$k]['status_name'] = 'Đã hủy'; }
            $res[$k]['reg_time'] = date("Y-m-d H:i",$v['reg_time']);
        }
        // dump($res);
        if(!empty($res)){
            $data = code_msg(1);
            $data['data'] = $res;
        }else{
            $data = code_msg(2);
        }
        return json_encode($data);
        
    }
    
        
    /**
     * 新购申购添加
     */
    public function add(){
        $QchicangModel = new QchicangModel;
        $chk_time = $QchicangModel->checkTime();
        if ( !$chk_time ) {
            return json_encode(code_msg(43));
        }
        
        $data = input('post.');
        $data['quser_id']=   Session::get(bianliang(1));
        $type = DB::name('quser')->where('id' ,$data['quser_id'])->value('type');
        if($type == 2){
            return json_encode(code_msg(35));
        }
        $res = $this->modelClass->createManager($data);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    } 
    
    /**
     * 新股申购取消
     */
    public function edit(){
        
        $data   = input('post.');
        $data['quser_id']=   Session::get(bianliang(1));
        $xingu = $this->modelClass->where('id',$data['id'])->where('quser_id',$data['quser_id'])->find();
        
        if(!empty($xingu['status'])){
            return json_encode(code_msg(33));
        }
        $count =$this->modelClass->where('qstocks_new_id',$xingu['qstocks_new_id'])->where('quser_id',$xingu['quser_id'])->count();
        if($count > 1){
            return json_encode(code_msg(40));
        }
        $res = $this->modelClass->where('id',$data['id'])->update(['status'=>5]);
        if($res){
            $data = code_msg(1);
        }else{
            $data = code_msg(2);
        }
       return json_encode($data);
        
    } 
}