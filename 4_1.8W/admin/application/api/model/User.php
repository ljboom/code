<?php

namespace app\api\model;

use think\Model;
use app\common\library\Auth;

/**
 * 用户中心
 */
class User extends Model
{

    // 表名,不含前缀
    protected $name = 'users';
    // 追加属性
    protected $append = [
    ];
    //创建时间
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    
    const STATUS_NORMAL = 1;//正常状态
    const STATUS_FROZEN = 2;//冻结状态
    const STATUS_FORBIDDEN = 3;//禁用状态
    
    //通过手机号获取用户
    public static function getByMobile($mobile){
        return self::get(['mobile' => $mobile]);
    }
    
    public function userinfo(){
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }
}
