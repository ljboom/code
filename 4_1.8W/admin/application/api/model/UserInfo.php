<?php

namespace app\api\model;

use think\Model;

/**
 * 用户信息中心
 */
class UserInfo extends Model
{

    // 表名,不含前缀
    protected $name = 'userinfo';
    // 追加属性
    protected $append = [
    ];
    //创建时间
    protected $createTime = 'createtime';
    protected $updateTime = false;

}
