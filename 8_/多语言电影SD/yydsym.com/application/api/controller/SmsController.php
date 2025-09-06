<?php

namespace app\api\controller;

use think\Controller;
use think\Cache;

//use app\common\model\SmsModel as Sms;

class SmsController extends Controller
{
    //初始化方法
    protected function initialize()
    {
        parent::initialize();
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authKey, sessionId");
    }

    //国家区号
    public function smsCode()
    {
        $lang = (input('post.lang')) ? input('post.lang') : 'id';    // 语言类型
        return json(['id' => '51', 'name' => '']);
        if ($lang == 'en') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }
        if ($lang == 'yd') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }
        if ($lang == 'ft') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }
        if ($lang == 'cn') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }
        if ($lang == 'id') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }
        if ($lang == 'vi') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }
        if ($lang == 'ja') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }
        if ($lang == 'es') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }
        if ($lang == 'th') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }

        if ($lang == 'ma') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }

        if ($lang == 'pt') {
            $data = array(
                array('id' => '55', 'name' => ''),
            );
            return json($data);
        }

    }

    /**
     * 发送短信验证码（POST形式）
     * @return [type] [description]
     */
    public function sendSMSCode()
    {
        $data = model('Sms')->sendSMSCode();
        return json($data);
    }


}
