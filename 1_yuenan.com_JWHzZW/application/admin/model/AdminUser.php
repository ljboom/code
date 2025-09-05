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
// | 后台用户管理
// +----------------------------------------------------------------------
namespace app\admin\model;

use think\Model;

class AdminUser extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'admin';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    /**
     * 创建管理员
     * @param type $data
     * @return boolean
     */
    public function createManager($data)
    {
        if (empty($data)) {
            $this->error = '没有数据！';
            return false;
        }
        if (empty($data['roleid'])) {
            $this->error = '请选择角色！';
            return false;
        }
        $passwordinfo     = encrypt_password($data['password']); //对密码进行处理
        $data['password'] = $passwordinfo['password'];
        $data['encrypt']  = $passwordinfo['encrypt'];
        $data['del']  = 1;
        $code_str_id = $this->where('code_str',$data['code_str'])->value('id');
        if($code_str_id){
            $this->error = '邀請碼已存在！';
            return false;
        }
        /**
        $bid_admin = $this->where('username',$data['bid_username'])->find();
        if(!empty($bid_admin)){
            if($bid_admin['roleid'] == 3){
                $this->error = '上級不能是業務員！';
                return false;
            }
            if($bid_admin['roleid'] != $data['roleid']-1){
                $this->error = '角色不合理！';
                return false;
            }
            $data['bid'] = $bid_admin['id'];
        }else{
            if(!empty($data['bid_username'])){
                $this->error = '上級賬號不存在！';
                return false;
            }else{
                $this->error = '請填寫上級賬號！';
                return false;
            }
            $data['bid'] = 0;
        }  
        **/
        
        
        
        
        $id               = $this->allowField(true)->save($data);
        if ($id) {
            return $id;
        }
        $this->error = '入库失败！';
        return false;
    }
    
    public function code_str($code){
        $id = $this->where('code_str',$code)->value('id');
        if($id > 0){
            $new_code = random();
            $new_id = $this->where('code_str',$new_code)->value('id');
            if($new_id > 0){
                $this->code_str($new_code);
            }else{
                return $new_code;
            }
            
        }else{
            return $code;
        }
        
    }
    /**
     * 编辑管理员
     * @param [type] $data [修改数据]
     * @return boolean
     */
    public function editManager($data)
    {
        if (empty($data) || !isset($data['id']) || !is_array($data)) {
            $this->error = '没有修改的数据！';
            return false;
        }
        $info = $this->where('id', $data['id'])->find();
        if (empty($info)) {
            $this->error = '该管理员不存在！';
            return false;
        }
        //密码为空，表示不修改密码
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
            unset($data['encrypt']);
        } else {
            $passwordinfo     = encrypt_password($data['password']); //对密码进行处理
            $data['encrypt']  = $passwordinfo['encrypt'];
            $data['password'] = $passwordinfo['password'];
        }
        $status = $this->allowField(true)->isUpdate(true)->save($data);
        return $status !== false ? true : false;
    }

    /**
     * 获取用户信息
     * @param type $identifier 用户名或者用户ID
     * @return boolean|array
     */
    /*public function getUserInfo($identifier, $password = null)
{
if (empty($identifier)) {
return false;
}
$map = array();
//判断是uid还是用户名
if (is_int($identifier)) {
$map['id'] = $identifier;
} else {
$map['username'] = $identifier;
}
$userInfo = $this->where($map)->find();
if (empty($userInfo)) {
return false;
}
//密码验证
if (!empty($password) && encrypt_password($password, $userInfo['encrypt']) != $userInfo['password']) {
return false;
}
return $userInfo;
}*/
}
