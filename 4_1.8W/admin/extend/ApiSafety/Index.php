<?php
namespace ApiSafety;

/**
 * 模拟操作
 */
class Index
{
    // ============================== 这一部分是接口的 ====================================

    private $key;
    private $appid;
    private $appsecret;

    protected function _initialize()
    {
        parent::_initialize();
        $config = Config('sign_config');
        $this->key = $config['key'];
        $this->appid = $config['appid'];
        $this->appsecret = $config['appsecret'];
    }

    /**
     * 1、获取token access_token
     * @param appid 第三方应用唯一凭证
     * @param appsecret 第三方应用唯一凭证密钥，即appsecret
     * @return [type] [description]
     */
    public function accessToken()
    {
        $data = $this->request->param();

        if (!isset($data['appid']) || empty($data['appid'])) {
            return zy_json_echo(false, '参数缺失', null, 10001);
        }
        /* if( !isset( $data [ 'appsecret' ] ) || empty( $data [ 'appsecret' ] )  ){
            return zy_json_echo( false, '参数缺失' , null , 10002 );
        } */
        if ($data['appid'] != $this->appid) {
            return zy_json_echo(false, '凭证不匹配', null, 10003);
        }
        $accessToken = base64_encode(cmf_password($this->appid . $this->appsecret));

        return zy_json_echo(true, '成功！', $accessToken, 200);
    }

    /**
     * 2、获取jwt token
     * @param sub 面向的用户
     * @param jti 该Token唯一标识
     * @return [type] [description]
     */
    public function getToken()
    {
        $data = $this->request->param();
        if (!isset($data['sub']) || empty($data['sub'])) {
            return zy_json_echo(false, '参数缺失', null, 10005);
        }
        if (!isset($data['jti']) || empty($data['jti'])) {
            return zy_json_echo(false, '参数缺失', null, 10006);
        }

        // 校验jti
        if (base64_decode($data['jti']) != cmf_password($this->appid . $this->appsecret)) {
            return zy_json_echo(false, '凭证不匹配', null, 10003);
        }

        $data['exp'] = strtotime(date('Y-m-d 24:0:0', time())); //time()+7200
        //获取票据
        $JwtObj = SafetyFactory::factory('Jwt', $this->key);
        $jsapi_ticket = $JwtObj->getToken($data);

        return zy_json_echo(true, '成功！', $jsapi_ticket, 200);
    }



    // ================================ 这一部分是函数的 ==================================

    /**
     * 校验数据可用性
     * @param array $data 数据
     * @return bool|array
     */
    private function decodeData($data = [])
    {
        if (empty($data)) return false;   //参数不能为空

        $apiSafety = new \ApiSafety\SafetyFactory();

        $config = Config('sign_config');
        $KEY = $config['key'];
        $APPID = $config['appid'];
        $APPSECRET = $config['appsecret'];

        // 1.校验临时票据是否过期
        if (isset($data['jsapi_ticket'])) {
            $jsapi_ticket = $data['jsapi_ticket'];
            if (empty($jsapi_ticket)) return false;

            $JwtObj = $apiSafety::factory('Jwt', $KEY);
            $JwtResult = $JwtObj->verifyToken($jsapi_ticket);
            if ($JwtResult == false) {
                return false;
                // return ['code'=>-4,'message'=>'凭证错误!'];
            }
        }

        // 2.校验 account_token 是否正确
        if (isset($jsapi_ticket['jti'])) {
            $accessToken = $jsapi_ticket['jti'];
            if (empty($accessToken)) return false;

            // $accessToken = '###5d3b53bdbd9b5e1ff0e79f0d4d766430';
            if (cmf_compare_password(base64_decode($accessToken), $APPID . $APPSECRET) == false) {
                return false;
                // return ['code'=>-5,'message'=>'密钥不匹配!'];
            }
        }

        // 3.校验签名是否过期
        if (isset($data['signature']) && isset($data['timestamp']) && isset($data['appid'])) {
            $signature = $data['signature'];
            if (empty($signature)) return false;

            $SignObj = $apiSafety::factory('Sign', $KEY);
            $SignResult = $SignObj->getSign($data);

            if ($SignResult != $signature) {
                return false;
            }

            if ($data['timestamp'] + 60 < time() || $data['appid'] != $APPID) {
                return false;
            }

            // 过滤参数
            unset($data['appid'], $data['timestamp'], $data['signature'], $data['jsapi_ticket'], $data['noncestr']);
            return true;
        }
        return false;
    }


    /**
     * 加密数据返回接口
     * @param array $data 数据
     * @return bool
     */
    private function encodeData($data = [])
    {
        if (empty($data)) return false;   //参数不能为空

        $apiSafety = new \ApiSafety\SafetyFactory();

        $config = Config('sign_config');
        $KEY = $config['key'];
        $APPID = $config['appid'];
        $APPSECRET = $config['appsecret'];

        // 1.生成 account_token 账号凭证
        $accessToken = base64_encode(cmf_password($APPID . $APPSECRET));
        // 2.利用 账号凭证 生成临时票据
        $tokenArr = [
            'iss' => 'lingfu',
            'exp' => strtotime(date('Y-m-d 24:0:0', time())), //time()+7200
            'jti' => $accessToken,
        ];
        $JwtObj = $apiSafety::factory('Jwt', $KEY);
        $data['jsapi_ticket'] = $JwtObj->getToken($tokenArr);

        // 3.利用临时票据，生成签名
        $data['appid']      = $APPID;
        $data['noncestr']   = cmf_random_string(10);
        $data['timestamp']  = time();
        $SignObj = $apiSafety::factory('Sign', $KEY);
        $data['signature']  = $SignObj->getSign($data);

        // 4.返回数据
        return $data;
    }
    


}



/**
 * 转换成json输入
 */
function zy_json_echo()
{
}

/**
 * 加密
 */
function cmf_password()
{
}

/**
 * 新密码与老密码是否匹配
 */
function cmf_compare_password()
{
}

/**
 * 生成随机数
 */
function cmf_random_string(){

}