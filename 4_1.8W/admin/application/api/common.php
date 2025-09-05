<?php
// /**
//  * 生成盐值
//  * @return string 盐值
//  */
// function createSalt(){
//     $salt = "sjwbeq1_KUGBVY";  //定义一个salt值
//     $b = $salt . rand(1000,99999);  //把随机数和salt连接
//     return substr(md5($b), 0, 10);;  //执行MD5散列   
// }
/**
 * 生成令牌
 * @return string 盐值
 */
function createToken($user_id = '') {
    $str = md5(uniqid(md5(microtime(true)), true));
    $str = sha1($str.$user_id);
    return $str;
}
/**
 * 获取全球唯一标识
 * @return string
*/
function uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
/*
 *  将 _ 后面的字母转换成大写的 
 *  @return string
*/
function underline_to_capital($value){
     $studly = ucwords(str_replace(array('-', '_'), ' ', $value));
     return str_replace(' ','',lcfirst($studly));
}
