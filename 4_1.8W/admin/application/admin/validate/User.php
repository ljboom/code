<?php
// +----------------------------------------------------------------------
// | MEAdmin [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2020 http://www.meetes.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 扯文艺的猿 <meetes@163.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 后台用户验证其
// +----------------------------------------------------------------------

namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    // 定义验证规则
    protected $rule = [
        'username|用户名'   => 'require|alphaNum|unique:admin_user',
        'nickname|昵称'     => 'require|unique:admin_user',
        'group_id|角色'         => 'require',
        'email|邮箱'        => 'require|email|unique:admin_user',
        'password|密码'     => 'require|length:6,20',
        'repassword|重复密码'=>  'require|confirm:password',
        'mobile|手机号'     => 'regex:^1\d{10}|unique:admin_user',
    ];

    // 定义验证提示
    protected $message = [
        'username.require'  => '请输入用户名',
        'email.require'     => '邮箱不能为空',
        'email.email'       => '邮箱格式不正确',
        'email.unique'      => '该邮箱已存在',
        'password.require'  => '密码不能为空',
        'password.length'   => '密码长度6-20位',
        'repassword.require'=> '重复密码不能为空',
        'repassword.confirm'=> '输入密码不一致',
        'mobile.regex'      => '手机号不正确',
    ];

    // 定义验证场景
    protected $scene = [
        // 登录
        'login'         =>  ['username', 'password'],
        // 安全设置
        'password'      =>  ['password','repassword'],
        // 添加用户
        'add'           =>  ['username', 'nickname', 'email', 'password', 'group_id'],
        // 修改用户
        'edit'          =>  ['nickname', 'email', 'group_id'],
        // 密码验证
        'password'      =>  ['password'],
    ];

    // login 验证场景定义
    public function sceneLogin()
    {
        return $this->only(['username', 'password'])
            ->remove('username', 'unique');
    }    


}
