<?php

namespace app\index\controller;

use think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        /*
        $now_days = rand(0,6);//6;//date('w', time());
        $now_hour = rand(0,23);//date('H', time());
        echo "<br />now:".date('Y-m-d H:i:s', time());
        echo "<br />周：".$now_days;
        echo "<br />时：".$now_hour;
        echo "<br />";
        if($now_days < 1 || $now_days >= 6){
            echo  json_encode(['code' => 0, 'code_dec' => 'not monday to friday']);
        }
        if ($now_hour < 11 || $now_hour >= 19) {
            echo json_encode(['code' => 0, 'code_dec' => 'Time in [11:00-19:00]']);
        }
        */
        /*
        $data = model('Sms')->sendSMSCode();
        return json($data);
        */
        
        /*
        
		$data['appkey']          = 'IySizqS5';//$setting['sms_user'];
		$data['secretkey']       = '3dWJYIQ6';//$setting['sms_pwd'];
		$data['phone']           = '13012344321';//'85246882385';//$dest.$phone;
		$data['source_address']  = 'minka8.com';
		$url                     = 'http://api.wftqm.com/api/sms/mtsend';
		$data['content']         = '您的验证码是'.$code.'，在30分钟内有效。如非本人操作请忽略本短信。';
        $data = model('Sms')->http_request($url, $data);
        return $data;
        
        */
        /*
        $code = rand(100000,999999);
        //$to = '85246732139';
        $to = '85264378805';
        //$message = 'Su código de verificación es '.$code.' y es válido por 30 minutos. Ignore este mensaje si no lo está haciendo usted mismo.';
        $message = "Your verification code is $code and is valid for 30 minutes. If you didn't do it yourself, please ignore this message.";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.wftqm.com/api/sms/mtsend",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query([
                'appkey' => 'IySizqS5',
                'secretkey' => '3dWJYIQ6',
                'phone' => $to,
                'source_address' => 'EVERYMAN',
                'content' => urlencode($message),
            ]),

        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $ret = json_decode($response, true);
        
        var_dump($ret);
        */
        
    }
    
    public function paypage()
    {
        echo '<h1>支付成功！<a herf="/">返回首页</a><h1>';
    }
    
    

}
