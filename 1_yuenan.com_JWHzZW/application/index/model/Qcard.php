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
// | 用戶銀行卡管理model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\facade\Session;

class Qcard extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qcard';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }


    /**
     * 查詢用戶銀行卡
     * @param type $data
     * @return boolean
     */
     
    public function selManager($data){
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
            // $data['quser_id'] = Session::get(bianliang(1));
        }
        $info = $this->where('quser_id', $data['quser_id'])->where('status',1)
            ->field('id,card_name,card_id,card_type,card_branch,branch_number,reg_time')
            ->order('id desc')->select()->toArray();
        if (empty($info)) {
            return code_msg(3);//沒有數據
        }
        $data = code_msg(1);
        foreach($info as $k => $v){
            $info[$k]['reg_date'] = $this->getLastLoginTimeAttr($v['reg_time']);
        }
        $data['data'] = $info;
        return $data;
    }
    
    /**
     * 创建用戶銀行卡
     * @param type $data
     * @return boolean
     */
    public function createManager($data)
    {
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        // $data['quser_id'] = empty( Session::get(bianliang(1)) ) ? $data['quser_id'] : Session::get(bianliang(1));
        $id = $this->where(['quser_id'=>$data['quser_id'] ,'card_id'=>$data['card_id'],'status'=>1])->value('id');
        if($id > 0){
            return code_msg(7);//銀行卡已存在
        }
        $data['reg_time'] = time();//創建時間
        $id               = $this->allowField(true)->save($data);
        if ($id) {
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }

    /**
     * 刪除用戶銀行卡
     * @param type $data
     * @return boolean
     */
    public function delManager($data){
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        $quser_id=  $data['quser_id'];
        $res = $this->where(['id'=>$data['id'],'quser_id'=>$quser_id])->update(['status'=>2]);
        if($res){
            return code_msg(1);// 成功
        }
        return code_msg(8);// 失败
    }


}
