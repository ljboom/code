<?php

namespace app\common\model;

use think\Model;

/**
 * 令牌
 */
class Token extends Model
{

    // 表名,不含前缀
    protected $name = 'tokens';
    protected $autoWriteTimestamp = 'int';
    protected $createTime = 'createtime';
    //过期时间
    public $keeptime = 2592000;
    
    // 追加属性
    protected $append = [
    ];
    /*
     * $token string 令牌
     * $user_id string 用户ID
     * 设置密钥
     * @return mixed|false
    */
    public function set($token, $user_id){
        $token = $this->getEncryptedToken($token);
        $this->insert(['token' => $token, 'user_id' => $user_id, 'createtime' => time()]);
       
    }
    /*
     * $token string 密钥
     * 获取密钥
     * @return mixed|false
    */
    public function get($token){
        $data = $this->where('token', $this->getEncryptedToken($token))->find();
        if ($data) {
            $expiretime = $data['createtime'] + $this->keeptime;
            if ($expiretime > time()) {
                //返回未加密的token给客户端使用
                $data['token'] = $token;
                return $data;
            } else {
                $this->deleteToken($token);
            }
        }
        return [];
    }
    /*
     * $token string 密钥
     * $user_id string 用户ID
     * 验证密钥
     * @return mixed|false
    */
    public function check($token, $user_id){
        $data = $this->get($token);
        return $data && $data['user_id'] == $user_id ? true : false;
    }
    /**
     * 删除Token
     * @param   string $token
     * @return  boolean
     */
    public function deleteToken($token)
    {
        $this->where('token', $this->getEncryptedToken($token))->delete();
        return true;
    }

    /**
     * 删除指定用户的所有Token
     * @param   int $user_id
     * @return  boolean
     */
    public function clear($user_id)
    {
        $this->where('user_id', $user_id)->delete();
        return true;
    }
    /**
     * 获取加密后的Token
     * @param string $token Token标识
     * @return string
     */
    protected function getEncryptedToken($token)
    {
        $config = config('token');
        return hash_hmac($config['hashalgo'], $token, $config['key']);
    }
}
