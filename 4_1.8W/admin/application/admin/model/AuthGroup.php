<?php
// +----------------------------------------------------------------------
// | MEAdmin [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2020 http://www.meetes.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 扯文艺的猿 <meetes@163.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 系统角色模型类
// +----------------------------------------------------------------------

namespace app\admin\model;

use think\Model;
use util\Tree;

class AuthGroup extends Model
{

    /**
     * 将数据集格式化成列表结构
     * @param  array   $filed   要查询的字段
     * @param  int     $pid     父级id
     * @return array 列表结构(二维数组)
     */
    public static function getTreeToList($filed = [],$pid=0)
    {
        if (ADMIN_GID != 1) {
            $pid = ADMIN_GID;
        }

        // 需要查询的字段
        $filedArr = ['id', 'pid', 'name'];
        $where[] = ['status','=','1'];
        if (isset($filed)) {
            $filedArr = array_merge($filedArr, $filed);
        }
        Tree::config(['title'=>'name']);
        $list = self::where($where)->column($filedArr);
        $lists = Tree::toList($list, $pid);

        return $lists;
    }

    /**
     * 获取所有子角色id
     * @param  string   $pid 父级id
     * @param  int      $type 需要返回的类型，1数组.2字符串
     * @return array|string 全部的子集id
     */
    public static function getTreeGetChildsId($pid = '',$type=1)
    {
        $filedArr = ['id', 'pid', 'name'];
        $list = self::column($filedArr);
        $ids = Tree::getChildsId($list,$pid);
        if($type==2){
            $ids = implode(",",$ids);
        }
        return $ids;
    }


    /**
     * 验证角色组
     * 验证是不是当前用户可以操作的角色组
     * 1. 验证是不是超管组
     * 2. 参数不能为空
     * 3. 全部转换成数组的形式，后面进行比较
     * 4. 把需要比较的组和自己拥有的组权限进行比较
     * 5. 比较出交集（如果没有交集，那么是根本不能操作的）
     * 6. 比较出差集（把交集得出的值和原本需要比较的值进行比较。如果值已经被改变过那么就无法成功）
     * @param  string|array   $setGroupId 需要操作的用户
     * @return boolean
     */
    public static function verifyAuthGroup($setGroupId=null)
    {
        // 非超级管理需要验证可选择角色
        if (ADMIN_GID != 1) {
            if ( empty($setGroupId) ) {
                return false;   // 参数不能为空
            }
            if(!is_array($setGroupId)){
                $setGroupId = explode(',',$setGroupId);
            }
            $groupId = self::getTreeGetChildsId(ADMIN_GID);
            $ids = array_intersect($groupId,$setGroupId);
            if(!$ids){
                return false;   // 权限不足，当中没有相匹配的交集
            }
            if( array_diff($setGroupId, $ids) ){
                return false;   // 权限不足，与传进来的值比较不匹配
            }
        }
        return true;
    }

}
