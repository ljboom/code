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
// | 通道管理model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\facade\Session;

class Qpassageway extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'Qpassageway';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }


    /**
     * 查詢通道
     * @param type $data
     * @return boolean
     */
    public function selManager($data){
        
        $info = $this->where('id', $data['id'])->order('id desc')->find()->toArray();
        if (empty($info)) {
            return code_msg(3);//沒有數據
        }
        $data = code_msg(1);
        // foreach($info as $k => $v){
        //     $info[$k]['reg_date'] = $this->getLastLoginTimeAttr($v['reg_time']);
        // }
        $data['data'] = $info;
        return $data;
    }
    
    
    /**
     * 创建通道
     * @param type $data
     * @return boolean
     */
    public function createManager($data)
    {
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        $data['reg_time'] = time();//創建時間
        $id               = $this->allowField(true)->save($data);
        if ($id) {
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }


    /**
     * 刪除通道
     * @param type $data
     * @return boolean
     */
    public function delManager($data){
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        $res = $this->where(['id'=>$data['id']])->delete();
        if($res){
            return code_msg(1);// 成功
        }
        return code_msg(8);// 失败
    }
    
    /**
     * 编辑
     * @param [type] $data [修改数据]
     * @return boolean
     */
    public function editManager($data)
    {
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
