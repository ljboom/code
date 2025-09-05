<?php

namespace app\api\validate;

use think\Validate;

class Service extends Validate
{

    /**
     * 验证规则
     */
    protected $rule = [
        'name' => 'require|min:2|max:6',
        'number' => 'require',
        'opening_bank' => 'require',
        'bank_card' => 'require',
        'phone' => 'require|regex:^1\d{10}$',
        'valid_date' => 'require',
        'education' => 'require',
        'profession' => 'require',
        'dutuies' => 'require',
        'postal_code' => 'require',
        'e_mail' => 'email',
        'people' => 'number',
        'code' => 'require|max:6',
        
    ];

    /**
     * 提示消息
     */
    protected $message = [
      'name.require' => '姓名不能为空',
      'name.min' => '姓名长度最少2位', 
      'name.max' => '姓名最长6位', 
      'number.require' => '身份证不能为空',
      'opening_bank.require' => '开户行不能为空',
      'bank_card.require' => '银行卡号不能为空',
      'phone.require' => '手机号不合法',
      'e_mail.email' => '必须是邮箱格式',
      'people.number' => '必须是数字',
     'code.require' => '验证码不能为空',
    'code.max' => '验证码最大长度6',
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
        'bankdetails' => ['name','number','opening_bank','bank_card','phone'],
        'updateBank' => ['name','number','opening_bank','bank_card','phone'],
        'certification' => ['name','phone','number','valid_date','education','profession','dutuies','site','postal_code','e_mail','people','code'],
        'certificationUpdate' => ['name','phone','number','valid_date','education','profession','dutuies','site','postal_code','e_mail','people'],
    ];

}
