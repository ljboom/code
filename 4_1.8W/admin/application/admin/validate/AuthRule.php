<?php
// +----------------------------------------------------------------------
// | MEAdmin [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2020 http://www.meetes.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 扯文艺的猿 <meetes@163.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 后台权限验证器
// +----------------------------------------------------------------------

namespace app\admin\validate;

use think\Validate;

class AuthRule extends Validate
{
    // 定义验证规则
    protected $rule = [
        'name|权限节点'         => 'require|min:2|unique:auth_rule',
        'title|权限节点中文名称' => 'require|length:2,20|unique:auth_rule',
        'sort|排序'             => 'require|number|max:5',
        'pid|父节点'            => 'require|number',
        'type|权限类型'         => 'require|number',
    ];

}