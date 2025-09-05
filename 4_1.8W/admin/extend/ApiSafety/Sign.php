<?php
namespace ApiSafety;

/**
 * 签名生成校验类
 */
class Sign
{
    // 使用HMAC生成信息摘要时所使用的密钥
    private static $key = '';

    /**
     * 构造函数
     * @param string $key       [商户密匙]
     */
    public function __construct($key = "")
    {
        if (empty($key)) {
            throw new ExceptionApi("Missing Config -- [key]");
        }
        self::$key = $key;
    }


    /**
     * 获取生成签名
     * @param  array  $data [签名数据]
     * @return [string] [签名字符串]
     */
    public static function getSign($data = array())
    {
        if (isset($data['signature'])) unset($data['signature']);
        // 第一步：设所有发送或者接收到的数据为集合M，将集合M内非空参数值的参数按照参数名ASCII码从小到大排序（字典序），使用URL键值对的格式
        foreach ($data as $key => $value) {
            if (empty($data[$key])) {
                unset($data[$key]);
            }
        }
        ksort($data);

        $signUrlM = urldecode(http_build_query($data));

        // 第二步：在stringA最后拼接上key得到stringSignTemp字符串，并对stringSignTemp进行MD5运算，再将得到的字符串所有字符转换为大写，得到sign值signValue。
        $stringSignTemp = $signUrlM . "&key=" . self::$key;
        $stringSignTemp = md5($stringSignTemp);
        $signValue = strtoupper($stringSignTemp);

        return $signValue;
    }

}
