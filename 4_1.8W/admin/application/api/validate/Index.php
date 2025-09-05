<?php

namespace app\api\validate;

use think\Validate;

class Index extends Validate
{

    /**
     * 验证规则
     */
    protected $rule = [
        'username' => 'require',
        'phone' => 'require|regex:^1\d{10}$',
    ];

    /**
     * 提示消息
     */
    protected $message = [
        'username.require' => '用户名必须填写',
        'phone.require' => '手机号必须填写',
        'phone.regex' => '手机号格式不正确',
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
        'add' => ['username', 'phone'],
    ];

}
