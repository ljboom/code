<?php
namespace app\common\library;

use app\common\model\Token as TokenModel;
use app\api\model\User;

//令牌类
class Token{
    private static $token;
    
    public static function init(){
        if (is_null(self::$token)) {
            self::$token = new TokenModel();
        }
        return static::$token;
    }
    /*
     * $token string 令牌
     * $user_id string 用户ID
     * 设置密钥
     * @return mixed|false
    */
    public static function set($token, $user_id){
        return self::init()->set($token, $user_id);
    }
    /*
     * $token string 密钥
     * 获取密钥
     * @return mixed|false
    */
    public static function get($token){
        return self::init()->get($token);
    }
    /*
     * $token string 密钥
     * $user_id string 用户ID
     * 验证密钥
     * @return mixed|false
    */
    public static function check($token, $user_id){
        return self::init()->get($token);
    }
    /**
     * 删除Token
     * @param   string $token
     * @return  boolean
     */
    public static function delete($token)
    {
        return self::init()->deleteToken($token);
    }

    /**
     * 删除指定用户的所有Token
     * @param   int $user_id
     * @return  boolean
     */
    public function clear($user_id)
    {
        return self::init()->clear($user_id);
    }
}