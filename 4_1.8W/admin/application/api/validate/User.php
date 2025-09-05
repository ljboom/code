<?php

namespace app\api\validate;

use think\Validate;

class User extends Validate
{

    /**
     * 验证规则
     */
    protected $rule = [
        'mobile' => 'require|regex:^1\d{10}$',
        'password' => ['require', 'min'=>6, 'max'=>16],
        'code' => 'require|max:6',
        'pay_password' => ['require', 'min'=>6, 'max'=>6],
       
    ];

    /**
     * 提示消息
     */
    protected $message = [
        'mobile.regex' => '手机号码必须填写',
        'password.require' => '密码必须填写',
        'password.min' => '密码长度最小6位',
        'password.max' => '密码长度最大16位',
        'confirm_password.require' => '确认密码未填写',
        'code.require' => '验证码不能为空',
        'code.max' => '验证码最大长度6',
        'pay_password.require' => '交易密码不能为空',
        'pay_password.min' => '交易密码长度最小为6位',
        'pay_password.max' => '交易密码长度最大为6位',
        
    ];

    /**
     * 字段描述
     */
    protected $field = [
        
    ];

    /**
     * 验证场景
     */
    protected $scene = [
        'login' => ['mobile', 'password'],
        'register' => ['mobile','code'],
        'authcode' => ['mobile'],
        'changepwd' => ['password'],
        'find_pwd' => ['mobile','password','code'],
        'changepay_pwd' => ['pay_password']
    ];

}
