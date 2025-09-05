<?php
// +----------------------------------------------------------------------
// | MEAdmin [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2020 http://www.meetes.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 扯文艺的猿 <meetes@163.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 系统权限模型类
// +----------------------------------------------------------------------

namespace app\admin\model;

use think\Model;
use util\Tree;

class AuthRule extends Model
{

    /**
     * 将数据集格式化成列表结构
     * @param  array   $filed 要查询的字段
     * @return array 列表结构(二维数组)
     */
    public static function getTreeToList($filed=[])
    {
        // 需要查询的字段
        $filedArr = ['id', 'pid', 'title'];
        if( isset($filed) ){
            $filedArr = array_merge($filedArr,$filed);
        }
        $list = self::order(['sort asc', 'id asc'])->column($filedArr);
        $lists = Tree::toList($list);

        return $lists;
    }



    
}
