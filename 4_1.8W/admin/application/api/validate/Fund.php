<?php

namespace app\api\validate;

use think\Validate;

class Fund extends Validate
{

    /**
     * 验证规则
     */
    protected $rule = [
        'code' => 'require|max:6',
        'code' => ['require', 'min'=>6, 'max'=>6],
        
       
    ];

    /**
     * 提示消息
     */
    protected $message = [
        'code.require' => '基金代码不能为空',
        'code.max' => '基金代码长度为6位',
        'code.min' => '基金代码长度为6位'
        
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
        'details' => ['code']
    ];

}
