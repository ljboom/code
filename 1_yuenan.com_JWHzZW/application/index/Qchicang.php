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

class Qchicang extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qchicang';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
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
    public function add($data)
    {
        if (empty($data) || !is_array($data)) {
            // return code_msg(3);// 没有数据
        }     
        $quser = Db::name('quser')->where('tel',$data['$tel'])->field('id,code_quserid,money')->find();
        if(empty($quser)){
            // $this->error(code_msg(5));
        }
        
        $regularMarketPrice = Db::name('qstockservices_data')->where('qstockservices_id',$data['qstockservices_id'])->field('regularMarketPrice')->find();
        if(empty($regularMarketPrice)){
            // $this->error(code_msg(3));
        }
        $array = [];
        
        $array['number'] = date("YmdHis",$time).random();
        $array['quser_id'] = $quser['id']; //用户id
        $array['qstockservices_id'] = $data['qstockservices_id']; //股票id
        $array['mairu_type'] = $data['mairu_type']; //买入方向 1 买张 2买跌
        $array['mairu_status'] = empty($data['mairu_status']) ? 1 :$data['mairu_status']; //买入方式 1市价 2限价
        $array['ganggang_beilv'] = $data['ganggang_beilv']; //杠杠倍率
        $array['mairu_count'] = $data['mairu_count']; //买入张数
        $array['mairu_num'] = $data['mairu_count']*1000; //买入股数
        $array['mairu_total_money'] = $data['mairu_total_money']*1000; //买入总金额（买入本金）
        $array['mairu_shouxu'] = empty($data['mairu_shouxu']) ? 1 :$data['mairu_shouxu']; //买入手续费
        $array['mairu_time'] = time();
        $this->shouxufei(1);
        
        
        $id               = $this->allowField(true)->save($data);
        if ($id) {
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }
    
    
    
    public function shouxufei($data){
        $config = Db::name('config')->where('id',15)->select();
        dump($config);
        exit;
    }

}