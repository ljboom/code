<?php
namespace ApiSafety;

use ApiSafety\ExceptionApi;
use ApiSafety\Sign;
use ApiSafety\StrEncryption;
use ApiSafety\Jwt;
use ApiSafety\Rsa;


/**
 * 接口安全基础类（工厂模式）
 */
class SafetyFactory
{

    /**
     * 工厂
     * @param string $transport 对象名
     * @param string $key 密钥
     * @param string $public_key        [商户公钥]
     * @param string $private_key       [商户私钥]
     */
    public static function factory($transport,$key = "",$public_key = "",$private_key = "")
    {

        switch ($transport) {
            case 'Sign':
                return new Sign($key);
                break;
            case 'StrEncryption':
                return new StrEncryption($key);
                break;
            case 'Jwt':
                return new Jwt($key);
                break;
            case 'Rsa':
                return new Rsa($public_key, $private_key);
                break;
        }
    }
}
