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
// | 前台用户管理model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\facade\Session;
use think\Db;

class Quser extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'quser';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }


    /**
     * 查詢用戶
     * @param type $data
     * @return boolean
     */
     
    public function selManager($data){
        
        $id =  $data['id']   ;
        if (empty($id)) {
            return code_msg(3);// 没有数据
        }
        $info = $this->where('id', $id)->find();
        unset($info['password']);
        unset($info['t_password']);
        if (empty($info)) {
            return code_msg(5);//用戶不存在
        }
        $data = code_msg(1);
        $data['data'] = $info;
        $data['data']['reg_date'] = date("Y-m-d H:i:s",$data['data']['reg_time']);
        return $data;
    }
    
    /**
     * 创建用戶
     * @param type $data
     * @return boolean
     */
    public function createManager($data)
    {
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        $admin = Db::name('admin')->where('code_str', $data['code_str'])->where('status',1)->find();
        if (empty($admin)) {
            return code_msg(11);//邀请码不正确
        }
        $code_str = $this->code_str($data['code_str']);
        $tel = $this->where('tel', $data['tel'])->value('id');
        if($tel){            return code_msg(4);        }//驗證是否存在手機號碼
        if(!empty($data['name_id'])){
            $name_id = $this->where('name_id', $data['name_id'])->value('name_id');
            if(!empty($name_id)){ return code_msg(14);  }//驗證是否存在身份证號碼
        }
        if(empty($data['name_id']) || empty($data['username'])){
            $data['status'] = 0;
        }else{
            $data['status'] = 4;
        }
        $password     = encrypt_password($data['password'] ,bianliang(2)); //对密码进行处理
        $t_password     = empty($data['t_password']) ? '' : encrypt_password($data['t_password'] ,bianliang(2)) ; //对密码进行处理
        $data['password'] = $password;
        $data['t_password'] = $t_password;
        $data['code_str'] = $code_str['code_str'];//自己的邀请码
        $data['code_quserid'] = $code_str['code_quserid'];//邀請人id
        $data['reg_time'] = time();//自己的邀请码
        //   dump($data);exit;
        // $id               = $this->allowField(true)->save($data);
        $id               = $this->allowField(true)->insertGetId($data);
                            // dump($id);exit;
        if ($id) {
            $this->quser_admin($admin ,$id);
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }
    public function quser_admin($admin ,$id){
        $time = time();
        if($admin['roleid'] == 1){
                Db::name('quser_admin')->insert(['quser_id'=>$id, 'admin_id' => $admin['id'] ,'add_time'=>$time]);//管理員
        }elseif($admin['roleid'] == 2){
                Db::name('quser_admin')->insert(['quser_id'=>$id, 'admin_id' => $admin['id'] ,'add_time'=>$time]);//經理
                Db::name('quser_admin')->insert(['quser_id'=>$id, 'admin_id' => $admin['bid'] ,'add_time'=>$time]);//管理員
        }elseif($admin['roleid'] == 3){
                Db::name('quser_admin')->insert(['quser_id'=>$id, 'admin_id' => $admin['id'] ,'add_time'=>$time]);//業務員
                Db::name('quser_admin')->insert(['quser_id'=>$id, 'admin_id' => $admin['bid'] ,'add_time'=>$time]);//經理
                $bid = Db::name('admin')->where('id',$admin['bid'])->find();//經理數據
                // dump($bid);
                Db::name('quser_admin')->insert(['quser_id'=>$id, 'admin_id' => $bid['bid'],'add_time'=>$time]);//管理員
        }
    }
    /**
     * 编辑用户
     * @param [type] $data [修改数据]
     * @return boolean
     */
    public function editManager($data)
    {
        if (empty($data) || !isset($data['id']) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        
        $info = $this->where('id', $data['id'])->find();
        if (empty($info)) {
            return code_msg(5);//用戶不存在
        }
        
        //密码为空，表示不修改密码
        if (!empty($data['password'])) { 
            
            if (!empty($data['old_password'])) { 
                $old_password = encrypt_password($data['old_password'] ,bianliang(2));
                $id = $this->where(['id'=>$data['id'],'password'=>$old_password])->value('id');
                if(empty($id)){
                    return code_msg(6);//密碼不正確
                }
            }
            
            $password     = encrypt_password($data['password'] ,bianliang(2)); //对密码进行处理
            $data['password'] = $password;
        }else{
            unset($data['password']);
        }
        
        //二級密码为空，表示不修改t_密码
        if ( !empty($data['t_password'])) {
            if (!empty($data['old_password'])) { 
                $old_password = encrypt_password($data['old_password'] ,bianliang(2));
                $id = $this->where(['id'=>$data['id'],'t_password'=>$old_password])->value('id');
                if(empty($id)){
                    return code_msg(6);//密碼不正確
                }
            }
            
            $password     = encrypt_password($data['t_password'] ,bianliang(2)); //对密码进行处理
            $data['t_password'] = $password;
        }else{
            unset($data['t_password']);
        }
        
        if(!empty($data['code_str']) && $data['code_str'] != $info['code_str']){
            $code_str = $this->where('code_str', $data['code_str'])->value('code_str');
            if(!empty($code_str)){
                return code_msg(12);//邀请码重复
            }
        }
        // 身份证是否重复
        if(!empty($data['name_id']) && $data['name_id'] != $info['name_id']){
            $name_id = $this->where('name_id', $data['name_id'])->value('name_id');
            if(!empty($tel)){
                return code_msg(14);//身份证已存在
            }
        }
        // 手机号是否重复
        if(!empty($data['tel']) && $data['tel'] != $info['tel']){
            $tel = $this->where('tel', $data['tel'])->value('tel');
            if(!empty($tel)){
                return code_msg(4);//电话号码已存在
            }
        }
        if(in_array($data['status'],[0,4]) ){
            if(!empty($data['name_id'])  && !empty($data['username'])  ){
                if($data['name_id'] != $info['name_id'] || empty($data['username']) != $info['username'] ){
                    $data['status'] = 4;
                }
            }
        }
        // dump($data);exit;
        $status = $this->allowField(true)->isUpdate(true)->save($data);
        if($status !== false){
            return code_msg(1);
        }else{
            return code_msg(2);
        }
    
    }
    
    public function code_str($code){
        $arr = [];
        if(!empty($code)){
          $arr['code_quserid'] = $this->where('code_str',$code)->value('id');
        }else{
            $arr['code_quserid'] = '';
        }
        $arr['code_str'] = random();
        $id = $this->where('code_str',$arr['code_str'])->value('id');
        if($id > 0){
            $this->code_str($code);
        }
        return $arr;
        
    }

}
