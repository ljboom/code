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
// | 持仓model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\Db;
use think\facade\Session;
use app\index\model\Quser as QuserModel;
use app\index\model\QmoneyJournal as QmoneyJournalModel;
use app\index\model\QstockservicesData as QstockservicesDataModel;

class Qchicang extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qchicang';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
    // 排单中  修改取消状台
    public function quxiao($data){
        $QmoneyJournalModel =  new QmoneyJournalModel;
        $array = $this->where(['id'=>$data['id'],'quser_id'=>$data['quser_id']])->find();
        if($array['status'] != 10){
            return code_msg(34);
        }
        $this->startTrans();
        $res = $this->where('id',$data['id'])->update(['status'=>5]);
       // echo $res;
        $res = $res && Db::name('quser')->where('id',$array['quser_id'])->setInc('money',$array['mairu_total_money']+$array['mairu_shouxu']);
        // echo $res;
        $QmoneyJournal = array(
            'quser_id'=>$array['quser_id'],
            'table_id'=>$array['id'],
            'money'=>$array['mairu_total_money']+$array['mairu_shouxu'],
            'type'=>7,
            );
        $res = $res && $QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);
       // echo $res;
        if($res){
            $this->commit();
            return code_msg(1);// 成功
        }
        $this->rollback();
        return code_msg(2);
    }
    
    /**
     * 可交易时间判断,时间先写死,日期后续后台设置
     * @return boolean
     */
    public function checkTime(){
        //return true;
        $now_date = date("Y-m-d");
        $is_jiaoyi = true;
        
        $no_date = '2022-01-01|2022-01-27|2022-01-28|2022-01-31|2022-02-01|2022-02-02|2022-02-03|2022-02-04|2022-02-28|2022-04-04|2022-04-05|2022-05-02|2022-06-03|2022-09-09|2022-10-10';
        $no_dates = @explode('|', $no_date);
        if (is_array($no_dates)) {
            foreach($no_dates as $k => $v){
                if ( $v == $now_date ) {
                    $is_jiaoyi = false;
                }
            }
        }
        if ( $is_jiaoyi == false ) {
            return false;
        }
        
        $week = date("w"); //0=天,
        if ( $week == 0 || $week == 6 || $week == 7 ) {
            return false;
        }
        $time = time();
        $start_time = strtotime(date("Y-m-d 09:30:00"));
        $end_time = strtotime(date("Y-m-d 11:30:00"));
        
        $start_time1 = strtotime(date("Y-m-d 13:00:00"));
        $end_time1 = strtotime(date("Y-m-d 15:00:00"));
        
        if ( ($time >= $start_time && $time < $end_time) || ($time >= $start_time1 && $time < $end_time1)) {
            return true;
        }
        return false;
    }
    
    
    /*
    * 判断股票的涨跌停数据
    */
    function getSTOCKUPDW($buy,$obpin){
        if ( empty($buy) ){
            return false;
        }
        $obup1= $obpin*1.1;
        $obdw1= $obpin*0.9;
        $STOCKUP = 0;
        $STOCKDW = 0;

	    if ($obup1<10 && $obdw1<10){
    		$STOCKUP = ((floor((floor($obup1*100)*100)))/100)/100;
    		$STOCKDW = ((floor((ceil($obdw1*100)*100)))/100)/100;

		} elseif ($obup1>10 && $obdw1<10){
    		$STOCKUP = ((floor(((floor($obup1/0.05)*0.05)*100)*100))/100)/100;
    		$STOCKDW = ((floor((ceil($obdw1*100)*100)))/100)/100;

		}else if ($obup1>=10 && $obdw1>=10 && $obup1<=50 && $obdw1<50){
    		$STOCKUP = ((floor(((floor($obup1/0.05)*0.05)*100)*100))/100)/100;
    		$STOCKDW = ((floor(((ceil($obdw1/0.05)*0.05)*100)*100))/100)/100;

		}else if ($obup1>=50 && $obdw1>=50 && $obup1<100 && $obdw1<100)		{
    		$STOCKUP = ((floor(((floor($obup1/0.1)*0.1)*100)*100))/100)/100;
    		$STOCKDW = ((floor(((ceil($obdw1/0.1)*0.1)*100)*100))/100)/100;

		}else if ($obup1>=50 && $obdw1<50 )		{
    		$STOCKUP = ((floor(((floor($obup1/0.1)*0.1)*100)*100))/100)/100;
    		$STOCKDW =(floor((ceil($obdw1/0.05)*0.05)*100))/100;

		}else if ($obup1>=100 && $obdw1>=100 && $obup1<1000 && $obdw1<1000)		{
    		$STOCKUP = ((floor(((floor($obup1/0.5)*0.5)*100)*100))/100)/100;
    		$STOCKDW = ((floor(((ceil($obdw1/0.5)*0.5)*100)*100))/100)/100;

		}else if ($obup1>=100 && $obdw1<100)		{
    		$STOCKUP = ((floor(((floor($obup1/0.5)*0.5)*100)*100))/100)/100;
    		$STOCKDW = ((floor(((ceil($obdw1/0.1)*0.1)*100)*100))/100)/100;
		}else if ($obup1>=1000 && $obdw1<=1000)		{
    		$STOCKUP = ((floor(((floor($obup1/5)*5)*100)*100))/100)/100;
    		$STOCKDW = ((floor(((ceil($obdw1/5)*5)*100)*100))/100)/100;

		}else if ($obup1>=1000 && $obdw1>=1000)		{
    		$STOCKUP = ((floor(((floor($obup1/5)*5)*100)*100))/100)/100;
    		$STOCKDW = ((floor(((ceil($obdw1/5)*5)*100)*100))/100)/100;
		}
		if ($buy > $STOCKDW && $buy < $STOCKUP )  {
		    return true;
		}
		return false;
    }
    
    /**
     * 持仓查询
     */
    public function sel(){
        $res = $this->modelClass
            // ->field('number,money,reg_time,type')
            ->order('id desc')
            ->select()->toArray();
        if(!empty($res)){
            $data = code_msg(1);
            $data['data'] = $res;
        }else{
            $data = code_msg(2);
        }
        return json_encode($data);
        
    }
    
    /**
     * 创建持仓
     * @param type $data
     * @return boolean
     */
    public function createManager($data)
    {
        $QuserModel = new QuserModel;
        $QmoneyJournalModel =  new QmoneyJournalModel;
        $QstockservicesDataModel =  new QstockservicesDataModel;
        // dump($data);
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }     
        $quser = Db::name('quser')->where('tel',$data['tel'])->find();
        // dump($quser);
        if(empty($quser)){
            return code_msg(5);// 没有数据
        }
        
        if($data['mairu_num'] && intval($data['mairu_num']) <= 0){
            return ['code'=>201,'msg'=>"Tối thiểu 1"];
        }
        
        
        if($data['mairu_count'] && intval($data['mairu_count']) <= 0){
            return ['code'=>201,'msg'=>"Tối thiểu 1"];
        }
        
        $where = array();
        $where[] = array('symbol',"=",$data['symbol']);
        $where[] = array('is_show',"=",1);
        $qstockservices = Db::name('qstockservices_data')->where($where)->field('qstockservices_id,regularMarketPrice,regularMarketPreviousClose')->find();
        // dump($qstockservices);
        if(empty($qstockservices)){
            return code_msg(3);// 没有数据
        }
        if($qstockservices['regularMarketPrice'] == 0 ) {
            return code_msg(32);// 这只股票不支持购买
        }
        // if(empty($data['mairu_status']) && $data['mairu_money'] <= 0 ){
        //     return code_msg(22);;
        // }
        // if(empty($data['mairu_status']) && $data['mairu_money'] <= 0 ){
        //     return code_msg(23);;
        // }
        // if(empty($data['mairu_status']) && $data['mairu_shouxu'] <= 0 ){
        //     return code_msg(24);
        // }
        // dump($data);exit;
        $array = [];
        
        $array['number'] = date("YmdHis",time()).random();
        $array['quser_id'] = $quser['id']; //用户id
        $array['qstockservices_id'] = $qstockservices['qstockservices_id']; //股票id
        $array['mairu_type'] = $data['mairu_type']; //买入方向 1 买张 2买跌
        $array['mairu_status'] = empty($data['mairu_status']) ? 1 :$data['mairu_status']; //买入方式 1市价 2限价
        $array['status'] = $array['mairu_status'] == 2 ? 10 : 1; //订单状态 1持仓中 2平仓中 3已平仓 10排单中
        $array['ganggang_beilv'] = empty($data['ganggang_beilv']) ? 0 :$data['ganggang_beilv'];  //杠杠倍率
        $array['mairu_count'] = empty($data['mairu_count']) ? 0 : $data['mairu_count'] ;  //买入张数
        $array['mairu_num'] = empty($data['mairu_count']) ? $data['mairu_num'] : $data['mairu_count']*1000 ; //买入股数
        $array['mairu_ori'] = $array['mairu_num'];//原始股数
        $array['mairu_money'] = $data['mairu_status'] == 1 ? $qstockservices['regularMarketPrice'] : $data['mairu_money']; //买入金额（单价）
        
        if($data['mairu_status'] == 2 && $data['mairu_type'] == 1 && $qstockservices['regularMarketPrice'] > $data['mairu_money']){//限价买涨
            return code_msg(44);// 限價價格不能低於市價
        }
        if($data['mairu_status'] == 2 && $data['mairu_type'] == 2 && $data['mairu_money'] > $qstockservices['regularMarketPrice']){//限价买跌
            return code_msg(45);// 限價價格不能高於市價
        }
        
        if(empty($array['mairu_money'])){
            return code_msg(22);// 買入價格不能小於等於0
        }
        $array['mairu_total_money'] = empty($data['mairu_total_money']) ? $array['mairu_num'] * $qstockservices['regularMarketPrice'] : $data['mairu_total_money']; //买入总金额（买入本金）
        if(empty($array['mairu_total_money'])){
            return code_msg(22);// 買入價格不能小於等於0
        }
        
        /**
        if(abs($QstockservicesData['regularMarketChangePercent']) >= 10){
            $array['status'] = 10;
        }
         * 
         */
        //(昨收 * 0.9002 ) >=   能买的价格   <=  (昨收 * 1.0998 )
        //var_dump($array['mairu_money'],$qstockservices['regularMarketPreviousClose']);
        //$min_money = round($qstockservices['regularMarketPreviousClose'] * 0.9002,2);
        //$max_monty = round($qstockservices['regularMarketPreviousClose'] * 1.0988,2);
        
        //var_dump($array['mairu_money'],$min_money,$max_monty);
        /*
        if( $array['mairu_money'] < $min_money  ){
            $array['status'] = 10;
        }
        if( $array['mairu_money'] > $max_monty  ){
            $array['status'] = 10;
        }*/
        //使用新公式运算
        $stock_updw = $this->getSTOCKUPDW($array['mairu_money'],$qstockservices['regularMarketPreviousClose']);
        if( $stock_updw == false  ){
            $array['status'] = 10;
        }
        //var_dump($array['status']);
        
        $array['mairu_time'] = empty($data['mairu_time']) ? time() : strtotime($data['mairu_time']);//买入时间
        
        $config_feiyong = $this->config_feiyong();
        //买入手续费
        if(empty($data['mairu_shouxu'])){
            $array['mairu_shouxu'] = ($array['mairu_total_money']*$config_feiyong['shouxu_bili']) >= $config_feiyong['shouxu_feiyong'] ? ($array['mairu_total_money']*$config_feiyong['shouxu_bili']) : $config_feiyong['shouxu_feiyong']; 
        }else{
            $array['mairu_shouxu'] = $data['mairu_shouxu'];
        }
        // dump($array['mairu_total_money']);
        // dump($config_feiyong['shouxu_bili']);
        // dump( $config_feiyong['shouxu_feiyong']);
        // dump($data);
        // dump($quser['mairu_shouxu']);
        // exit;
        if($quser['money'] < $array['mairu_total_money']){
            return code_msg(13);// 余额不足
        }
        //插入數據
        //var_dump($array);
        $id               = $this->insertGetId($array);
        if ($id) {
            // 
            if($array['mairu_status'] == 1 || $array['status'] == 10){
                $total_moeny = $array['mairu_total_money'] + $array['mairu_shouxu'];
                Db::name('quser')->where('id',$array['quser_id'])->setDec('money',$total_moeny);
                $QmoneyJournal = array(
                    'quser_id'=>$array['quser_id'],
                    'table_id'=>$id,
                    'money'=>$total_moeny,
                    'type'=>5,
                    );
                $QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);
                // dump($array['quser_id']);
                // dump($total_moeny);
                // exit;
            }
           
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }
    
    // 平仓
    public function  pingcangManager($data){
        
       
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        } 
        $chicang = $this->where('id',$data['id'])->find()->toArray();
        if (empty($chicang)) {
            return code_msg(3);// 没有数据
        }
       // file_put_contents(dirname(__FILE__).'/log.txt',serialize($chicang)."\r\n",FILE_APPEND);
        //file_put_contents(dirname(__FILE__).'/log.txt',"0\r\n",FILE_APPEND);
        if($chicang['status'] != 2){
            return code_msg(3); // 狀態不對
        }
        //file_put_contents(dirname(__FILE__).'/log.txt',"00\r\n",FILE_APPEND);
        if($data['num'] > $chicang['mairu_num']){
            return code_msg(38);// 超出現有股數數量
        }
        //file_put_contents(dirname(__FILE__).'/log.txt',"000\r\n",FILE_APPEND);
        if($data['num'] < $chicang['mairu_num']){
            unset($chicang['id']);
            $chicang['mairu_num'] = $data['num'];
            $new_id = $this->insertGetId($chicang);
            $this->where('id',$data['id'])->setDec('mairu_num', $data['num']);
            $chicang['id'] = $new_id;
        }
        $time = time();
        $QmoneyJournalModel =  new QmoneyJournalModel;
        $config_feiyong = $this->config_feiyong();
        $qstockservices_data = Db::name('qstockservices_data')->where('qstockservices_id',$chicang['qstockservices_id'])->field('is_show,qstockservices_id,regularMarketPrice')->find();
        if  ( $qstockservices_data['is_show']  != 1 || $qstockservices_data['regularMarketPrice'] == 0 ) {
            return code_msg(32);// 这只股票不支持购买
        }
        
        
        //如果是現價賣出則判斷是否已經到了價格
        if($chicang['limit_maichu_money'] && floatval($chicang['limit_maichu_money']) > 0 && (($chicang['mairu_type'] == 1 && $qstockservices_data['regularMarketPrice'] < $chicang['limit_maichu_money']) || ($data['mairu_type'] == 2 && $chicang['limit_maichu_money'] < $qstockservices_data['regularMarketPrice']))){
            
            return code_msg(45);
        }
        
        //更改卖出价格
        if($chicang['limit_maichu_money'] && floatval($chicang['limit_maichu_money']) > 0){
            
            $qstockservices_data['regularMarketPrice'] = $chicang['limit_maichu_money'];
        }
        
        if($qstockservices_data['regularMarketPrice'] <= 0){
            return code_msg(45);
        }
        //接口数据不及时处理
        if($qstockservices_data['regularMarketPrice'] == $chicang['mairu_money'] && date('H:i') < '09:05'){

            return code_msg(45);
        }
        
        $chicang_id = $chicang['id'];
        $array = array(
            //'id'=>$chicang['id'],
            'maichu_money' => $qstockservices_data['regularMarketPrice'],//单价
            'maichu_total_money' => !empty($data['ganggang_money'])? $data['ganggang_money'] : $qstockservices_data['regularMarketPrice']*$chicang['mairu_num'],//卖出总金额
            // 'maichu_total_money' =>$qstockservices_data['regularMarketPrice']*$chicang['mairu_num'],//卖出总金额
            'maichu_time' => $time,
            'maichu_type' => $data['maichu_type'],
            'status' => 3,
            );
        //卖出手续费
        $array['maichu_shouxu'] = ($array['maichu_total_money']*$config_feiyong['shouxu_bili']) >= $config_feiyong['shouxu_feiyong'] 
            ? ($array['maichu_total_money']*$config_feiyong['shouxu_bili']) 
            : $config_feiyong['shouxu_feiyong']; 
        //认交税
        $array['renjiao_money'] = $array['maichu_total_money']*$config_feiyong['renjiaoshui'];
        // 杠杆倍率 收取留仓费
        if($chicang['ganggang_beilv'] == 0 || $config_feiyong['liucang_zuidi'] == 0){
            $array['liucang_money'] = 0;
        }else{
            $array['liucang_day'] = intval(($time-$chicang['mairu_time'])/86400);
            $liucang_bili_moeny = $array['maichu_total_money']*$config_feiyong['liucang_bili'];
            $array['liucang_money'] =  $liucang_bili_moeny >= $config_feiyong['liucang_zuidi'] 
                ?  $liucang_bili_moeny * $array['liucang_day'] 
                : $config_feiyong['liucang_zuidi'] * $array['liucang_day'] ;
        }
        //卖出总的手续费
        $array['maichu_total_shouxu'] = intval($array['maichu_shouxu']) + intval($array['renjiao_money']) + intval($array['liucang_money']);
        
      
        
        //损益
        $array['sunyi'] = $chicang['mairu_type'] == 1 
            ? ($array['maichu_money'] - $chicang['mairu_money'])*$chicang['mairu_num']   //买涨
            : ($chicang['mairu_money']-$array['maichu_money']) *$chicang['mairu_num'];  //买跌
        //杠杆倍率
        if ($chicang['ganggang_beilv'] > 0 ) {
            $array['sunyi'] = $chicang['ganggang_beilv']*$array['sunyi'];
        }
        //结算金额
        $array['jiesuan_money']  = ($chicang['mairu_money'] * $chicang['mairu_num']) + $array['sunyi'] - $array['maichu_total_shouxu'];
        // dump($array);
        // exit;
        $log = json_encode(array(
            'id'=>$chicang_id,
            'update'=>$array,
            'chicang'=>$chicang,
        ));
        $array['log'] = $log;
       // file_put_contents(dirname(__FILE__).'/log.txt',"0\r\n",FILE_APPEND);
        $this->startTrans();
        //$res               = $this->isUpdate()->save($array);
        $res = $this->where("id",$chicang_id)->update($array);
        
        if ( $res ) {
            // $total_moeny = $array['maichu_total_money'] - $array['maichu_total_shouxu'];
            $total_moeny = $array['jiesuan_money'];
           // file_put_contents(dirname(__FILE__).'/log.txt',"2\r\n",FILE_APPEND);
            Db::name('quser')->where('id',$chicang['quser_id'])->setInc('money',$total_moeny);
            $QmoneyJournal = array(
                'quser_id'=>$chicang['quser_id'],
                'table_id'=>$chicang_id,
                'money'=>$total_moeny,
                'log'=>$log,
                'type'=>6,
            );
           // file_put_contents(dirname(__FILE__).'/log.txt',"3\r\n",FILE_APPEND);
            $QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);
            // dump($array['quser_id']);
            // dump($total_moeny);
            // exit;
            $this->commit();
            return code_msg(1);// 成功
        } else {
           // file_put_contents(dirname(__FILE__).'/log.txt',"1\r\n",FILE_APPEND);
            $this->rollback();
            $err_array = array(
                "status"=>50,
                "log"=>$log,
            );
            $this->where("id",$chicang_id)->update($err_array);
        }
        
        return code_msg(2);// 失败
        
    }
    
    
    public function config_feiyong(){
        $config = Db::name('config')->where('id',15)->find();
        $config ['shouxu_bili'] = $config['shouxu_bili']*0.01;
        $config ['renjiaoshui'] = $config['renjiaoshui']*0.01;
        $config ['gangan_bili'] = $config['gangan_bili']*0.01;
        $config ['liucang_bili'] = $config['liucang_bili'];
        return $config;
    }

}