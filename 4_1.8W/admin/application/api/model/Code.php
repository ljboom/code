<?php

namespace app\api\model;

use think\Model;
use app\common\library\Auth;

/**
 * 验证码
 */
class Code extends Model
{

    // 表名,不含前缀
    protected $name = 'code';
    protected $autoWriteTimestamp = 'int';
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    
    //过期时间
    public $expiration_time = 300;
    const STATUS_UNUSED = 1; //未使用
    const STATUS_USED = 2;//已使用
    
    
    // 追加属性
    protected $append = [];
    //校验验证码
    public static function check($mobile, $code){
        $result = self::where(['mobile' => $mobile, 'code' => $code, 'status'=>self::STATUS_UNUSED])->order('createtime','desc')->find();
        //验证码不存在
        if(is_null($result)) return false;
        //创建时间 + 过期时间
        $expiration_time = $result->createtime + (new self)->expiration_time;
        $time = time();
        //如果当前时间小于
        if($time <= $expiration_time){
            $result->save(['status' => self::STATUS_USED]);
            return true;
        }
        return false;
    }
}
