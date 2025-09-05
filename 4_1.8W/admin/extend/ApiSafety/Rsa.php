<?php
namespace ApiSafety;

/**
 * 签名生成校验类
 */

class Rsa
{
    private static $public_key  = '';   // 公钥
    private static $private_key = '';   // 私钥

    /**
     * 构造函数
     * @param string $public_key        [商户公钥]
     * @param string $private_key       [商户私钥]
     */
    public function __construct($public_key = "",$private_key = "")
    {
        if (empty($public_key)) {
            throw new ExceptionApi("Missing Config -- [public_key]");
        }
        if (empty($private_key)) {
            throw new ExceptionApi("Missing Config -- [private_key]");
        }
        self::$public_key  = $public_key;
        self::$private_key = $private_key;
    }

    //$private_key = file_get_contents('private_key.pem');
    //$public_key = file_get_contents('rsa_public_key.pem');

    /**
     * RSA私钥加密
     * @param string $data 要加密的字符串
     * @return string $encrypted 返回加密后的字符串
     * @author mosishu
     */
    public static function privateEncrypt($data)
    {
        $encrypted = '';
        $pi_key =  openssl_pkey_get_private(self::$private_key); //这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
        //最大允许加密长度为117，得分段加密
        $plainData = str_split($data, 100); //生成密钥位数 1024 bit key
        foreach ($plainData as $chunk) {
            $partialEncrypted = '';
            $encryptionOk = openssl_private_encrypt($chunk, $partialEncrypted, $pi_key); //私钥加密
            if ($encryptionOk === false) {
                return false;
            }
            $encrypted .= $partialEncrypted;
        }

        $encrypted = base64_encode($encrypted); //加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的
        return $encrypted;
    }



    /**
     * RSA公钥解密(私钥加密的内容通过公钥可以解密出来)
     * @param string $data 私钥加密后的字符串
     * @return string $decrypted 返回解密后的字符串
     * @author mosishu
     */
    public static function publicDecrypt($data)
    {
        $decrypted = '';
        $pu_key = openssl_pkey_get_public(self::$public_key); //这个函数可用来判断公钥是否是可用的
        $plainData = str_split(base64_decode($data), 128); //生成密钥位数 1024 bit key
        foreach ($plainData as $chunk) {
            $str = '';
            $decryptionOk = openssl_public_decrypt($chunk, $str, $pu_key); //公钥解密
            if ($decryptionOk === false) {
                return false;
            }
            $decrypted .= $str;
        }
        return $decrypted;
    }



    //RSA公钥加密
    public static function publicEncrypt($data)
    {
        $encrypted = '';
        $pu_key = openssl_pkey_get_public(self::$public_key);
        $plainData = str_split($data, 100);
        foreach ($plainData as $chunk) {
            $partialEncrypted = '';
            $encryptionOk = openssl_public_encrypt($chunk, $partialEncrypted, $pu_key); //公钥加密
            if ($encryptionOk === false) {
                return false;
            }
            $encrypted .= $partialEncrypted;
        }
        $encrypted = base64_encode($encrypted);
        return $encrypted;
    }



    //RSA私钥解密
    public static function privateDecrypt($data)
    {
        $decrypted = '';
        $pi_key = openssl_pkey_get_private(self::$private_key);
        $plainData = str_split(base64_decode($data), 128);
        foreach ($plainData as $chunk) {
            $str = '';
            $decryptionOk = openssl_private_decrypt($chunk, $str, $pi_key); //私钥解密
            if ($decryptionOk === false) {
                return false;
            }
            $decrypted .= $str;
        }
        return $decrypted;
    }
}


/* 



//=============================================================
//
$private_key = '-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBALpcI/jRCR8KRkxt
AiNCLLMFRwcrTfrsM9Nnp/ocBnBcWtc6I9VeDAqDGbAeBuVTZbUSIgD5o8GQRnoG
VOWGRk8YZiogoRVwAHSFtmdp3zi/yz0rukx494CxA+n6EGvr1pABwqw3Q/X7afZ0
N9iI2gUekTkshB9IBDZ+64cWxK1jAgMBAAECgYAwt11/8cUcpCb0W5qvdOESe1Ky
ARQFgDGcFgDHVQQp4zqsALrVUBx9sv/IFlFfKYnw56iT8K5qLzj9NSKETbGbEL7t
GlSrDgeqyoBC/AP7WQ9hVZRh7GXomSt7Aw6YmkpfG7vcCk+FX1hp4CvVG3qE+fiJ
1mwm84042Yj1/zNyoQJBAPMpDcIDL+5nQunF10a5Sw65q3+2HdtqEoQIUQooodti
uoXmgRz5fcIyexn1gBVg4P7WkDd04jih/xtGoby6s3UCQQDEM0fdPtbxB/AB+7fS
O8ElhZvg42AI2CEk+OetecFxp9+sWZJa2a+l+T3mKHILHkg36fEd2n/yz3jbdVM1
b/p3AkEAwPXYNBjhZXfOUsMsFbSfCn1uyfcUdHUVYm9TGBOsdfM//1gvJ3YZRQ1Y
QP5f+RcbFT/hzBBWIQj074k6ehFSrQJBAIeAmytUEQKaZsoX3NaXakfNxOBGaLby
/cEZHniS1GT4eeQAYLHaEhNg1b01Rb4kBeCH83yYwTEi1OdMWlFXqvUCQCk6+5p8
EVUSuzKr4kUJEpDQqazT4SWbQIjEZNBREXaffndjHACl55zvMJC15HzXVQ6Yo3+k
2NYff+L6VJCR5xM=
-----END PRIVATE KEY-----';

//公钥
$public_key = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6XCP40QkfCkZMbQIjQiyzBUcH
K0367DPTZ6f6HAZwXFrXOiPVXgwKgxmwHgblU2W1EiIA+aPBkEZ6BlTlhkZPGGYq
IKEVcAB0hbZnad84v8s9K7pMePeAsQPp+hBr69aQAcKsN0P1+2n2dDfYiNoFHpE5
LIQfSAQ2fuuHFsStYwIDAQAB
-----END PUBLIC KEY-----';


$rsa = new rsa($public_key, $private_key);
var_dump($rsa->privateEncrypt('1ee1e1'));
var_dump($rsa->publicDecrypt('j9FA4XX23tOl0nY+RD8W4HNzBhl43k+2n3kOoGzc9RO5viI46h+xd50XLR7XTgnhfpA1NJNQLeNEKXNbuI26IyvIpO/rgQj65/wDCQecuMkd/CRgq6GPdlBsoqZG3IOl1agTD3OhUufik4Rhj+gpCPmo8zOdJ4tLTrdWpvfy1a8='));


var_dump($rsa->publicEncrypt('1ee1e1'));
var_dump($rsa->privateDecrypt('mRsS5tMj+O0rpgvWluXSvMuEnOprsUVXNIQSuYV2mvnI67arNkCxozaGfvNQUmOdXNaBCQVtDjfeXEqa4gxn3ZcU7iARqoyioahPy/3iL1b9WEdt1gHif3KcsKl+NgeFXOIGPdubpW4i/J8WYA62uHVBnsWvrr75OIqYzkWdjpM='));
exit;


 */