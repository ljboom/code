<?php
// +----------------------------------------------------------------------
// | 应用公共文件
// +----------------------------------------------------------------------
use think\Db;

/**
 * 操作成功/失败返回的接口格式  原型方法 json_encode($array,JSON_UNESCAPED_UNICODE) 
 * @access protected
 * @param  bool      $status 状态 true为success/false为error
 * @param  mixed     $msg 提示信息
 * @param  array     $data 返回的数据
 * @param  integer   $code 状态码
 * @param  string    $url 跳转的URL地址
 * @return 返回json字符串
 */
function apiRule($status = false, $msg = "", $data = null, $code = 0, $url = "")
{
    $result = [
        'status' => $status ? 'success' : 'error',
        'msg'  => $msg,
        'data' => $data,
        'code' => $status ? 200 : (int)$code,
        'url'  => $url,
    ];

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit();
}

/**
 * 生成盐值
 * @return string 盐值
 */
function createSalt(){
    $salt = "sjwbeq1_KUGBVY";  //定义一个salt值
    $b = $salt . rand(1000,99999);  //把随机数和salt连接
    return substr(md5($b), 0, 10);;  //执行MD5散列   
}

    /**
     * 获取密码加密后的字符串
     * @param string $password 密码
     * @param string $salt     密码盐
     * @return string
     */
     function getEncryptPassword($password, $salt = '')
    {
        return md5(md5($password) . $salt);
    }

/*
 * 检查图片是不是bases64编码的
 */
function is_image_base64($base64) {
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)){
        return true;
    }else{
        return false;
    }
}
function check_pic($dir,$type_img){
    $new_files = $dir.date("YmdHis"). '-' . rand(0,9999999) . "{$type_img}";
    if(!file_exists($new_files))
        return $new_files;
    else
        return check_pic($dir,$type_img);  
}

/**
 * 获取系统信息
 * @return 返回array数组
 */
function getSystemInfo()
{
    $user_agent = request()->header('user-agent');
    
    if (false !== stripos($user_agent, 'win')) {
        $user_os = 'Windows';
    } elseif (false !== stripos($user_agent, 'mac')) {
        $user_os = 'MAC';
    } elseif (false !== stripos($user_agent, 'linux')) {
        $user_os = 'Linux';
    } elseif (false !== stripos($user_agent, 'unix')) {
        $user_os = 'Unix';
    } elseif (false !== stripos($user_agent, 'bsd')) {
        $user_os = 'BSD';
    } elseif (false !== stripos($user_agent, 'iPad') || false !== stripos($user_agent, 'iPhone')) {
        $user_os = 'IOS';
    } elseif (false !== stripos($user_agent, 'android')) {
        $user_os = 'Android';
    } else {
        $user_os = 'Other';
    }

    if (false !== stripos($user_agent, 'MSIE')) {
        $user_browser = 'MSIE';
    } elseif (false !== stripos($user_agent, 'Firefox')) {
        $user_browser = 'Firefox';
    } elseif (false !== stripos($user_agent, 'Chrome')) {
        $user_browser = 'Chrome';
    } elseif (false !== stripos($user_agent, 'Safari')) {
        $user_browser = 'Safari';
    } elseif (false !== stripos($user_agent, 'Opera')) {
        $user_browser = 'Opera';
    } else {
        $user_browser = 'Other';
    }
    $user_ip         = request()->ip();


    $info = [
        //服务器系统
        'server_os'           => PHP_OS,
        //服务器ip
        'server_ip'           => GetHostByName($_SERVER['SERVER_NAME']),
        //服务器环境
        'server_web'           => $_SERVER['SERVER_SOFTWARE'],
        //php版本
        'php_version'         => PHP_VERSION,
        //运行内存限制
        'memory_limit'        => ini_get('memory_limit'),
        //最大文件上传限制
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        //单次上传数量限制
        'max_file_uploads'    => ini_get('max_file_uploads'),
        //最大post限制
        'post_max_size'       => ini_get('post_max_size'),
        //ThinkPHP版本
        'think_version'       => app()->version(),
        //运行模式
        'php_sapi_name'       => PHP_SAPI,
        //磁盘剩余空间
        'disk_free'           => round((disk_free_space(".") / (1024 * 1024)), 2) . 'M',
        //mysql版本
        'db_version'          => Db::query('select VERSION() as db_version')[0]['db_version'],
        //php时区
        'timezone'            => date_default_timezone_get(),
        //当前时间
        'date_time'           => date('Y-m-d H:i:s'),
        //用户IP
        'user_ip'             => $user_ip,
        //用户系统
        'user_os'             => $user_os,
        //用户浏览器
        'user_browser'        => $user_browser,

    ];
    return $info;
}


if (!function_exists('random_string')) {
    /**
     * 随机字符串生成
     * @param number $length 长度
     * @param string $type 类型
     * @param number $convert 转换大小写
     * @return string
     */
    function random_string($length = 6, $type = 'all', $convert = 0)
    {
        $config = array(
            'number' => '1234567890',
            'letter' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'string' => 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
            'all'    => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        );

        if (!isset($config[$type])) $type = 'all';
        $string = $config[$type];

        $code = '';
        $strlen = strlen($string) - 1;
        for ($i = 0; $i < $length; $i++) {
            $code .= $string{
            mt_rand(0, $strlen)};
        }
        if (!empty($convert)) {
            $code = ($convert > 0) ? strtoupper($code) : strtolower($code);
        }
        return $code;
    }
}

if (!function_exists('check_cors_request')) {
    /**
     * 跨域检测
     */
    function check_cors_request()
    {
        if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN']) {
            $info = parse_url($_SERVER['HTTP_ORIGIN']);
            $domainArr = explode(',', config('cors_request_domain'));
            $domainArr[] = request()->host(true);
            if (in_array("*", $domainArr) || in_array($_SERVER['HTTP_ORIGIN'], $domainArr) || (isset($info['host']) && in_array($info['host'], $domainArr))) {
                header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
            } else {
                header('HTTP/1.1 403 Forbidden');
                exit;
            }
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');

            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
                }
                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
                }
                exit;
            }
        }
    }
}
if (!function_exists('capital_to_underline')) {
    /*
     *  将大写字母转小写且在前加_ 
     *  @return string
    */
    function capital_to_underline($str){
            $temp_array = array();
            for($i=0;$i<strlen($str);$i++){
                $ascii_code = ord($str[$i]);
                if($ascii_code >= 65 && $ascii_code <= 90){
                    if($i == 0){
                        $temp_array[] = chr($ascii_code + 32);
                    }else{
                        $temp_array[] = '_'.chr($ascii_code + 32);
                    }
                }else{
                    $temp_array[] = $str[$i];
                }
            }
            return implode('',$temp_array);
    }
}
if(!function_exists('get_fund_list')){
    /*
     *  获取基金数据 
     * $code string 基金代码
     * $path string 接口地址
    */
    function get_fund_list($code, $path){
        $aliyun_api_config = config('aliyun_api');
        $host = $aliyun_api_config['host'];
        //阿里接口AppCode
        $appcode = $aliyun_api_config['app_code']; 
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "fundcode=". $code;
        $bodys = "";
        $url = $host . $path . "?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        if (strpos("$".$host, "https://") == 1)
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
         $data = curl_exec($curl);
        return json_decode($data,true); 
    }
}
