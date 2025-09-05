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
// | 新股申购model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\Db;
use think\facade\Session;

class Qxingushengou extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qxingushengou';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    
    /**
     * 创建新股申购
     * @param type $data
     * @return boolean
     */
    public function createManager($data)
    {
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        $quser_id =  $data['quser_id'] ;
        $qstocks_new_id =  $data['qstocks_new_id'];
        $can_purchased =  $data['can_purchased'];
        
        // $quser_id =  3;
        // $qstocks_new_id = 233;
        // $can_purchased = 1;
        
        
        $shengou = $this->where(['quser_id'=>$quser_id ,'qstocks_new_id'=>$qstocks_new_id])->find();
        if($shengou['id'] > 0 && $shengou['status'] != 5){
            return code_msg(16);// 判断是否已经申购
        }
        // dump($shengou);exit;
        $qstocks_new = Db::name('qstocks_new')->where('id',$qstocks_new_id)->find();
        if(if_date($qstocks_new['subscription_period'])['code'] != 200){
            return code_msg(17);// 判断是否在申购时间
        }
        
        $if_date = if_date($qstocks_new['subscription_period']);
        if($if_date['code'] == 201){
            return $if_date;//判断是否在申购时间内
        }
        if($qstocks_new['can_purchased'] < $can_purchased){
            // return code_msg(18);//判断是否超出申购数量
        }
        $time = time();
        $datas = array(
            'number' => date("YmdHis",$time).random(),
            'quser_id' => $quser_id, // 用户id
            'qstocks_new_id' => $qstocks_new_id, // 新股id
            'shengou_money' => $qstocks_new['underwriting_price'], // 申购价  承销价
            'shengou_num' => $can_purchased*1000,// 可申购张数
            'zhongqian_num' => 0,// 中签数量
            'shengou_renji_money' => $can_purchased*1000*$qstocks_new['underwriting_price']+admin_config(1),//申购需认缴
            'zhongqian_renji_money' => 0,
            'yirenji_money' => 0,
            'yirenji_money_num' => 0,
            'reg_time' => time(),
            'status' => 0,
            
            );
        $id               = $this->insert($datas);
        if ($id) {
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }
    // 编辑
    public function editManager($data){
         if (empty($data) || !isset($data['id']) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
         $status = $this->allowField(true)->isUpdate(true)->save($data);
        if($status !== false){
            return code_msg(1);
        }else{
            return code_msg(2);
        }
    }
    
 
}