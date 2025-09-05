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
// |持仓
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Qchicang as QchicangModel;
use app\index\model\QstockservicesData as QstockservicesDataModel;
use app\common\controller\Indexbase;
use think\facade\Session;
use think\Db;

class Qchicang extends Indexbase
{
    
    
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QchicangModel;
    }
    
    public function edit(){
        $data   = input('post.');
        $res = $this->modelClass->quxiao($data);
        return json_encode($res);
    }
        
    /**
     * 持仓列表
     */
    public function sel(){
        $status = empty(input('post.status'))? 1 : input('post.status');
        // $status =4;
        if($status == 4){
            $where = ['status'=>[3,5]];
        }else{
            $where = ['status'=>[1,2,10,50]];
        }
        
        $page = empty(input('post.page'))? 1 : input('post.page');
        $q_id = input('post.quser_id');
        // $quser_id=  empty(Session::get(bianliang(1))) ? input('post.quser_id') : Session::get(bianliang(1));
        $quser_id= Session::get(bianliang(1));
        // $quser_id=  3;
        
        $res = $this->modelClass->where('quser_id',$quser_id)
            ->where($where)
            ->order('id desc')
            ->page($page, 20)->select()->toArray();
            //print_r($res);
        //這裡要先更新數據
        $qstockservices_arr = [];
        $info = array();
        foreach($res as $k => $v){
            if(isset($qstockservices_arr[$v['qstockservices_id']])){
                $info[$v['id']] = $qstockservices_arr[$v['qstockservices_id']];
                continue;
            }
            
            $info[$v['id']] = $qstockservices_arr[$v['qstockservices_id']] = Db::name('qstockservices')->where('id',$v['qstockservices_id'])->field('id,systexId,symbolName,symbol')->find();
            
        }
        //print_r($info);
        $QstockservicesDataModel = new QstockservicesDataModel();
        $info = $QstockservicesDataModel->get_list($info);
        
        //print_r($info);
        //數據更新完成
// dump($res);exit;
        foreach($res as $k => $v){
            $qstockservices_data = $info[$v['id']];
            //print_r($qstockservices_data);
            if ( $v['status'] == 3  ) {  //已經固定的股票不要用最新價格
                $qstockservices_data['regularMarketPrice'] = $v['maichu_money'];
            }
            /*if  (  $qstockservices_data['regularMarketPrice'] == 0 ) {
                //print_r($qstockservices_data);
                continue;
            }*/
// dump($qstockservices);exit;
            $res[$k]['symbol']  = $qstockservices_data['symbol'];
            $res[$k]['sectorName']  = $qstockservices_data['symbolName'];
            $res[$k]['mairu_money']  = $v['mairu_money'];//买入价格（成本）
            
            $res[$k]['mairu_num']  = $v['mairu_num'];//持有股数
            
            //$res[$k]['mairu_count']  = $v['mairu_ori'] / 1000;
            
            $res[$k]['mairu_type_name'] = $v['mairu_type'] == 1 ? 'Giá thị' : 'Giá giới';
            $res[$k]['mairu_status_name'] = $v['mairu_status'] == 1 ? 'Mua lên' : 'Mua xuống';
            
            
            if($qstockservices_data['regularMarketPrice'] > 0){
            
            $res[$k]['regularMarketPrice']  = $qstockservices_data['regularMarketPrice'];//最新价格(市值)
             
             $res[$k]['sunyi'] = $v['mairu_type'] == 1 ? ($qstockservices_data['regularMarketPrice'] - $v['mairu_money']) * $v['mairu_num'] : ($v['mairu_money'] - $qstockservices_data['regularMarketPrice']  ) * $v['mairu_num'];
            
            // 杠杆倍数大于零
            if ($v['ganggang_beilv'] > 0 ) {
                $res[$k]['shizhi'] = $qstockservices_data['regularMarketPrice'] * $v['mairu_num'] * $v['ganggang_beilv'];//市值
                $res[$k]['sunyi'] = $res[$k]['sunyi'] * $v['ganggang_beilv'];
                $res[$k]['sunyibi'] = $res[$k]['sunyi']/($v['mairu_money']*$v['mairu_num']* $v['ganggang_beilv']);
            } else {
                $res[$k]['shizhi'] = $qstockservices_data['regularMarketPrice'] * $v['mairu_num'];//市值
                $res[$k]['sunyibi'] = $res[$k]['sunyi'] ? $res[$k]['sunyi']/($v['mairu_money']*$v['mairu_num']) : 0;
            }
            $res[$k]['shizhi'] = number_format($res[$k]['shizhi'],0);
            $res[$k]['sunyibi'] = round($res[$k]['sunyibi'] * 100,2).'%';
             
            }else{
                $res[$k]['regularMarketPrice'] = '--';
                $res[$k]['sunyibi'] = '--';
                $res[$k]['sunyi'] = '--';
            }
            
            
            $res[$k]['reg_time'] = date("Y-m-d H:i",$v['reg_time']);
            if($v['status'] == 10){ 
                $res[$k]['status_name'] = 'Hàng chờ';
                $res[$k]['sunyi'] = 0;
                $res[$k]['sunyibi'] = 0;
            }
            elseif($v['status'] == 1){ $res[$k]['status_name'] = 'Mở vị'; }
            elseif($v['status'] == 2){ $res[$k]['status_name'] = 'Đóng vị'; }
            elseif($v['status'] == 3){ $res[$k]['status_name'] = 'Đóng cửa'; }
            elseif($v['status'] == 5){ $res[$k]['status_name'] = 'Đã hủy'; }
            elseif($v['status'] == 50){ $res[$k]['status_name'] = 'Khác thường'; }
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
    
    // 个股明细
    public function mingxi(){
        $id = input('post.id');
        $q_id = input('post.quser_id');
        // $quser_id=  empty(Session::get(bianliang(1))) ? $q_id : Session::get(bianliang(1));
        $quser_id=  Session::get(bianliang(1));
        
        // $id= 3;$quser_id = 3;
        $res = $this->modelClass->where('id',$id)->where('quser_id',$quser_id)->find();

        if(!empty($res)){
            $qstockservices = Db::name('qstockservices')->where('id',$res['qstockservices_id'])->field('symbolName,symbol')->find();
            $qstockservices_data = Db::name('qstockservices_data')->where('qstockservices_id',$res['qstockservices_id'])->field('regularMarketPrice')->find();
            $res['symbol']  = $qstockservices['symbol'];
            $res['sectorName']  = $qstockservices['symbolName'];
            if ($res['ganggang_beilv'] > 0 ) {
                $res['shizhi'] = $qstockservices_data['regularMarketPrice'] * $res['mairu_num'] * $res['ganggang_beilv'];//市值
            } else {
                $res['shizhi'] = $qstockservices_data['regularMarketPrice'] * $res['mairu_num'];//市值
            }
            $res['mairu_time'] = date("Y-m-d H:i",$res['mairu_time']);
            $res['mairu_status_name'] = $res['mairu_status'] == 1 ? 'Giá thị' : 'Giá giới';
            $res['mairu_type_name'] = $res['mairu_type'] == 1 ? 'Mua lên' : 'Mua xuống';
            if($res['status'] == 10){ $res['status_name'] = 'Hàng chờ';}
            elseif($res['status'] == 1){ $res['status_name'] = 'Mở vị'; }
            elseif($res['status'] == 2){ $res['status_name'] = 'Đóng vị'; }
            elseif($res['status'] == 3){ $res['status_name'] = 'Đóng cửa'; }
                    // dump($res);
            $data = code_msg(1);
            $data['data'] = $res;
        }else{
            $data = code_msg(2);
        }
        return json_encode($data);
        
        
    }
    
    function  cccc(){
        
    }
        
    /**
     * 申购添加
     */
    public function add(){
        
        $chk_time = $this->modelClass->checkTime();
        if ( !$chk_time ) {
            return json_encode(code_msg(41));
        }
        $data = input('post.');
        // $data['tel'] = empty(Session::get(bianliang(3))) ? $data['tel'] : Session::get(bianliang(3)) ;
        $data['tel'] = Session::get(bianliang(3)) ;
        $type = DB::name('quser')->where('tel' ,$data['tel'])->value('type');
        if($type == 2){
            return json_encode(code_msg(35));
        }
        // dump($data);
        // exit;
        $res = $this->modelClass->createManager($data);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    } 
    
    // 个人持仓中股票变平仓中
    public function pingchangzhong(){
        
        $chk_time = $this->modelClass->checkTime();
        if ( !$chk_time ) {
            return json_encode(code_msg(42));
        }
        $data = input('post.');
        
        $limit_price = isset($data['price']) && $data['price'] ? floatval($data['price']) : 0;
        
        // $data['quser_id']=  empty(Session::get(bianliang(1))) ? $data['quser_id'] : Session::get(bianliang(1));
        $data['quser_id']=  Session::get(bianliang(1));
        // $data = [
        //     'id' => 95,
        //     'quser_id' => 21,
        //     'num' => 10000,
        //     ];
        $type = DB::name('quser')->where('id' ,$data['quser_id'])->value('type');
        if($type == 2){
            return json_encode(code_msg(35)); //禁止交易,請聯係客服
        }
        
        $chicang = Db::name('qchicang')->where('id', $data['id'])->where('status' ,1)->where('quser_id', $data['quser_id'])->find();
        
        

        if(empty($chicang)){
            return json_encode(code_msg(3));//没有数据
        }
        if($data['num'] > $chicang['mairu_num']){
            return json_encode(code_msg(38));// 超出現有股數數量
        }
        
        if($limit_price){
           //獲取當前價格
            $qstockservices_data = Db::name('qstockservices_data')->where('qstockservices_id',$chicang['qstockservices_id'])->field('is_show,qstockservices_id,regularMarketPrice')->find();
            
            if($qstockservices_data['regularMarketPrice'] > $limit_price && $chicang['mairu_type'] == 1){
                
                return json_encode(['code'=>'201','msg'=>'Vui lòng đặt giá giới hạn lớn hơn hoặc bằng giá hiện tại！']);//没有数据
            }
            
            if($qstockservices_data['regularMarketPrice'] < $limit_price && $chicang['mairu_type'] == 2){
                
                return json_encode(['code'=>'201','msg'=>'Vui lòng đặt giá giới hạn nhỏ hơn hoặc bằng giá hiện tại！']);//没有数据
            }
        }
        
        
        
        
        
        if($data['num'] == $chicang['mairu_num']){
            $res = $this->modelClass->where('id', $data['id'])->update(['status' => 2,'limit_maichu_money'=>$limit_price]);
        }
        if($data['num'] < $chicang['mairu_num']){
            unset($chicang['id']);
            $chicang['mairu_num'] = $data['num'];
            $chicang['limit_maichu_money'] = $limit_price;
            $chicang['status'] = 2;
            $new_id = $this->modelClass->insertGetId($chicang);
            $this->modelClass->where('id',$data['id'])->setDec('mairu_num', $data['num']);
        }
        
        return json_encode(code_msg(1));
        
    }
    
    
    /**
     * 取消平仓
     */
    public function cancelpingchang(){
        
        $data = input('post.');
        
        $chicang = Db::name('qchicang')->where('id', $data['id'])->where('status' ,2)->where('quser_id', $data['quser_id'])->find();
        
        if(empty($chicang)){
            return json_encode(code_msg(3));//没有数据
        }
        
        $res = $this->modelClass->where('id', $data['id'])->update(['status' => 1,'limit_maichu_money'=>0]);
        
        if($res){
            return json_encode(code_msg(1));
        }
        
        return json_encode(code_msg(2));
    }
}