<?php
// +----------------------------------------------------------------------
// | MEAdmin [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2020 http://www.meetes.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 扯文艺的猿 <meetes@163.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 系统菜单验证器
// +----------------------------------------------------------------------

namespace app\admin\validate;

use think\Validate;

class Menu extends Validate
{
    // 定义验证规则
    protected $rule = [
        'title|菜单名称'        => 'require|length:4,20|unique:admin_menu',
        'module|模块名称'       => 'require',
        'controller|控制器名'   => 'require',
        'sort|排序'             => 'require|number|max:5',
        'pid|父节点'            => 'require|number'
    ];

}