<?php
namespace ApiSafety;

/**
 * 字符串的加解密类
 * 有简单的加密/解密
 * 有复杂的加密/解密
 */
class StrEncryption {

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
	 * 加密方法 
	 * @param string $data 要加密的字符串
	 * @param string $key  加密密钥
	 * @param int $expire  过期时间 单位 秒
	 * @return string
	 */
	public static function system_encrypt($data, $key = '', $expire = 0){
	    $key  = md5(empty($key) ? self::$key : $key); //   c4ca4238a0b923820dcc509a6f75849b 
	    $data = base64_encode($data);//MTIzNDU2
	    $x    = 0;
	    $len  = strlen($data);
	    $l    = strlen($key);
	    $char = '';
	    for ($i = 0; $i < $len; $i++) {
	        if ($x == $l) $x = 0;
	        $char .= substr($key, $x, 1);
	        $x++;
	    }
	 
	    $str = sprintf('%010d', $expire ? $expire + time():0);
	    for ($i = 0; $i < $len; $i++) {
	        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256); //  MDAwMDAwMDAwMLCIrNuCdohq
	    }
	 
	    return str_replace(['+','/'],['-','_'],base64_encode($str)); 
	}
	 
	/**
	 * 解密方法
	 * @param  string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
	 * @param  string $key  加密密钥
	 * @return string
	 */
	public static function system_decrypt($data, $key = ''){
	    $key    = md5(empty($key) ? self::$key : $key); 
	    $data   = str_replace(['-','_'],['+','/'],$data);
	    $mod4   = strlen($data) % 4;        
	    if ($mod4) {
	       $data .= substr('====', $mod4);
	    }
	    $data   = base64_decode($data);
	 
	    $expire = substr($data,0,10);
	    $data   = substr($data,10);
	 
	    if($expire > 0 && $expire < time()) {
	        return '';
	    }
	    $x      = 0;
	    $len    = strlen($data);
	    $l      = strlen($key);
	    $char   = $str = '';
	    for ($i = 0; $i < $len; $i++) {
	        if ($x == $l) $x = 0;
	        $char .= substr($key, $x, 1);
	        $x++;
	    }
	    for ($i = 0; $i < $len; $i++) {
	        if (ord(substr($data, $i, 1))<ord(substr($char, $i, 1))) {
	            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
	        }else{
	            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
	        }
	    }
	    return base64_decode($str);
	}




	/**
	 * 简单对称加密算法之加密
	 * @param String $string 需要加密的字串
	 * @param String $skey 加密EKY
	 * @return String
	 */
	public static function encode_v1($string = '', $skey = 'mutephp') {
	    $strArr = str_split(base64_encode($string));
	    $strCount = count($strArr);
	    foreach (str_split($skey) as $key => $value){
	        $key < $strCount && $strArr[$key].=$value;
	    }
	    return str_replace(['=', '+', '/'], ['O0O0O', 'o000o', 'oo00o'], join('', $strArr));
	}
	 
	/**
	 * 简单对称加密算法之解密
	 * @param String $string 需要解密的字串
	 * @param String $skey 解密KEY
	 * @return String
	 */
	public static function decode_v1($string = '', $skey = 'mutephp'){
	    $strArr = str_split(str_replace(['O0O0O', 'o000o', 'oo00o'], ['=', '+', '/'], $string), 2);
	    $strCount = count($strArr);
	    foreach (str_split($skey) as $key => $value){
	        $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
	    }
	    return base64_decode(join('', $strArr));

	}



}


/* 
//简单的
$Encryption =new StrEncryption();
echo $Encryption->encode_v1('123456');
echo "<br>";
echo $Encryption->decode_v1('MmTuItzeNpDhUp2');
echo "<br>";


//复杂的
echo $Encryption->system_encrypt('000000');
echo "<br>";
echo $Encryption->system_decrypt('MDAwMDAwMDAwMIWmc6ywdnau');
echo "<br>";


 */