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
// | 前台用户管理
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Quser as QuserModel;
use app\common\controller\Indexbase;
use app\index\model\DamowOrderModel;
use app\index\model\QmoneyJournal;
use think\facade\Session;
use think\Db;

class Quser extends Indexbase
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QuserModel;
    }
    
    public function money_journal(){
        $post = input('post.');
        // $post['quser_id']=  empty(Session::get(bianliang(1))) ? input('post.quser_id') : Session::get(bianliang(1));
        $post['quser_id']=    Session::get(bianliang(1));
        $page = empty($post['page']) ? 1 : $post['page'];
        // $post['quser_id'] = 3;
        $_list = Db::name('qmoney_journal')->where('quser_id' ,$post['quser_id'])
            ->where('type','<>',8)
            ->page($page ,20)
            ->order('id desc')->select();

        if(empty($_list)){
            return json_encode(code_msg(3));
        }
        $array = [];
        foreach($_list as $k => $v){
            if($v['type'] == 3 || $v['type'] == 4){
                $qxingushengou = Db::name('qxingushengou')->where('id',$v['table_id'])->field('number,qstocks_new_id')->find();
                $qstocks_new = Db::name('qstocks_new')->where('id',$qxingushengou['qstocks_new_id'])->field('symbol_name,symbol')->find();
                $array[$k] = array(
                    'id' => $v['id'],
                    'number' => $qxingushengou['number'],
                    'type' => $v['type'] == 3 ? '-' : '+',
                    'money' => $v['money'],
                    'content' => $v['type'] == 3 ? 'Đăng ký chia sẻ mới' : 'Đăng ký chia sẻ mới không thành công',
                    'symbol_name' => $qstocks_new['symbol_name'] .' ' .$qstocks_new['symbol'],
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                    );
            }
            
            if($v['type'] == 5 || $v['type'] == 6 || $v['type'] == 7){
                $chicang = Db::name('qchicang')->where('id',$v['table_id'])->field('number,qstockservices_id')->find();
                $qstockservices = Db::name('qstockservices')->where('id',$chicang['qstockservices_id'])->field('symbolName,symbol')->find();
                $array[$k] = array(
                    'id' => $v['id'],
                    'number' => $chicang['number'],
                    'type' => $v['type'] == 5 ? '-' : '+',
                    'money' => $v['money'],
                    'content' => $v['type'] == 5 ? 'Mua cổ phiếu' : 'Bán cổ phiếu',
                    'symbol_name' => $qstockservices['symbolName'] .' ' .$qstockservices['symbol'],
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                    );
                if($v['type'] == 7){
                    $array[$k]['content'] = 'Hủy mua cổ phiếu';
                }
            }

            if($v['type'] == 8 || $v['type'] == 9 || $v['type'] == 10){
                $qxingushengou = Db::name('damow_order')->where('id',$v['table_id'])->find();
                $array[$k] = array(
                    'id' => $v['id'],
                    'number' => $qxingushengou['order_number'],
                    'type' => $v['type'] == 9 ? '-' : '+',
                    'money' => $v['money'],
                    'content' => $v['type'] == 9 ? 'Đầu tư' : ($v['type'] == 10 ?'Mua lại đầu tư':'Thu được lợi nhuận'),
                    'symbol_name' => $qxingushengou['product_name'],
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                );
            }
        }
        // dump($array);
        $data = code_msg(1);
        $data['data'] = array_values($array);
        return json_encode($data);
        
    }
    
    /**
     * 理財數據
     */
    public function income_info(){
        
        $post = input('post.');
        // $post['quser_id']=  empty(Session::get(bianliang(1))) ? input('post.quser_id') : Session::get(bianliang(1));
        $post['quser_id']=   Session::get(bianliang(1));
        //理財的總金額
        $info = DamowOrderModel::field('sum(money+money*day_rate/100*fanxian_number) as total')->where('user_id',$post['quser_id'])->where('status',0)->find();
        
        $data['total'] = number_format($info['total'],2);
        
        $end_time = strtotime(date('Ymd'));
        $start_time = $end_time - 3600*24;
        
        $data['yesday'] = number_format(QmoneyJournal::where('quser_id',$post['quser_id'])->where('type',8)->where('add_time','>=',$start_time)->where('add_time','<',$end_time)->sum('money'),2);
        $data['tday'] = number_format(QmoneyJournal::where('quser_id',$post['quser_id'])->where('type',8)->where('add_time','>=',$end_time)->sum('money'),2);
        
        $data['total_inc'] = number_format(QmoneyJournal::where('quser_id',$post['quser_id'])->where('type',8)->sum('money'),2);
        
        $rdata = code_msg(1);
        $rdata['data'] = $data;
        return json_encode($rdata);
    }
    
    /**
     * 理財資金明細
     */
    public function income_list(){
        $post = input('post.');
        $type = empty($post['type']) ? 8 : $post['type'];
        $page = empty($post['page']) ? 1 : $post['page'];
        // $post['quser_id']=  empty(Session::get(bianliang(1))) ? input('post.quser_id') : Session::get(bianliang(1));
        $post['quser_id']=  Session::get(bianliang(1));
        
        $type = $type == 8 ? [8] : [9,10];
        
        // $post['quser_id'] = 3;
        $_list = Db::name('qmoney_journal')->where('quser_id' ,$post['quser_id'])
            ->where('type','in',$type)
            ->page($page ,20)
            ->order('id desc')->select();

        if(empty($_list)){
            return json_encode(code_msg(3));
        }
        $array = [];
        foreach($_list as $k => $v){
            
            if($v['type'] == 8 || $v['type'] == 9 || $v['type'] == 10){
                $qxingushengou = Db::name('damow_order')->where('id',$v['table_id'])->find();
                $array[$k] = array(
                    'id' => $v['id'],
                    'number' => $qxingushengou['order_number'],
                    'type' => $v['type'] == 9 ? '-' : '+',
                    'money' => $v['money'],
                    'content' => $v['type'] == 9 ? 'Đầu tư' : ($v['type'] == 10 ?'Mua lại đầu tư':'Thu được lợi nhuận'),
                    'symbol_name' => $qxingushengou['product_name'],
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                );
            }
        }
        // dump($array);
        $data = code_msg(1);
        $data['data'] = array_values($array);
        return json_encode($data);
        
    }
    
    
    
    // 判断后台是否存在
    public function quser_session(){
        $quser_id = Session::get(bianliang(1));
        if(empty($quser_id)){
            return json_encode(code_msg(10000));
        }else{
            return json_encode(code_msg(1));
        }
    }
    // 判断是否有二级密码或者二级密码是否正确
    public function if_tpwd(){
        $arr = input('post.');
        $quser_id = Session::get(bianliang(1));
        if(empty($arr)){
            $res = $this->modelClass->where('id',$quser_id)->value('t_password');
        }else{
            $t_password = encrypt_password($arr['t_password'] ,bianliang(2));
            $res = $this->modelClass->where(['id'=>$quser_id ,'t_password'=>$t_password])->value('id');
            $show = $this->modelClass->where('id',$quser_id)->value('t_password');
            if(empty($show)){
                return json_encode(code_msg(999));
            }
        }
        
        if(!empty($res)){
            return json_encode(code_msg(1));
        }else{
            return json_encode(code_msg(2));
        }
        
    }
    
    // 判断是否实名认证
    public function if_username(){
        $quser_id = Session::get(bianliang(1));
        $res = $this->modelClass->where('id',$quser_id)->value('status');
        $data = code_msg(1);
        $data['data'] = $res;
        return json_encode($data);
    }
    
    
    // 查詢
    public function sel(){
        $arr = input('get.');
        $arr['id'] = Session::get(bianliang(1));
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
        $arr = input('post.');
        $arr['id'] = Session::get(bianliang(1));
        $res = $this->modelClass->editManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }
    
    
    
    
    
}