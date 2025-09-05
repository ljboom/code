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
// | 提现管理model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\Db;
use think\facade\Session;

class Qwithdrawal extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qwithdrawal';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
    
    /**
     * 提现查询
     */
    public function sel(){
        $quser_id=  Session::get(bianliang(1));
        // $quser_id= 3;
        $res = $this->modelClass->where('quser_id',$quser_id)->field('number,money,reg_time,type')->select()->toArray();
        foreach($res as $k => $v){
            if($v['type'] == 0 ){ $res[$k]['type'] = '审核中';  }
            if($v['type'] == 1 ){ $res[$k]['type'] = '通過'; }
            if($v['type'] == 2 ){ $res[$k]['type'] = '拒絕';}
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
     * 创建提现
     * @param type $data
     * @return boolean
     */
    public function createManager($data)
    {
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        $quser_id =  $data['quser_id'];
        $quser = Db::name('quser')->where('id',$quser_id)->field('id,code_quserid,money')->find();
        if(empty($quser)){
            $this->error(code_msg(5));
        }else{
            $data['quser_id'] = $quser_id;
            $data['superior_quser_id'] = $quser['code_quserid'];
            if($quser['money'] < $data['money']){
                return code_msg(13);// 余额不足提现
            }
        }
        $time = time();
        $data['number'] = date("YmdHis",$time).random();
        $data['reg_time'] = $time;
        
        // dump($data);exit;
        $id               = $this->allowField(true)->save($data);
        if ($id) {
            Db::name('quser')->where('id',$quser_id)->setDec('money',$data['money']);
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }
    

}