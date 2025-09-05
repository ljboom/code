<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Ems;
use app\common\library\Sms;
use Exception;
use fast\Random;
use think\Validate;
use think\Request;
use think\Db;
use app\common\model\Realname;
/**
 * 会员接口
 */
class User extends Api
{
    protected $noNeedLogin = ['login', 'mobilelogin', 'register', 'resetpwd', 'changeemail', 'changemobile', 'third'];
    protected $noNeedRight = '*';

    public function _initialize()
    {
        parent::_initialize();
    }
    
    public function subRealname(){
        $data = Realname::where('user_id',$this->auth->id)->order('id','DESC')->find();
        if($data && in_array($data['status'],[0,1])){
			$this->error(__('实名认证待审核或已审核通过'));
        }
        $paramData = Request::instance()->only('true_name,id_card,id_card_img_1,id_card_img_2');
        foreach ($paramData as $k=>$v){
            if(empty($v)){
			    $this->error(__('实名认证信息填写不完整'));
            }
        }
        $paramData['user_id'] = $this->auth->id;
        $data = Realname::create($paramData);
        
        $this->success(__('successful'), $data);
    }

    
    public function getRealname(){
        $data = Realname::where('user_id',$this->auth->id)->order('id','DESC')->find();
        $this->success(__('successful'), $data);
    }

    /**
     * 会员中心
     */
    public function index()
    {
        $this->success('', ['welcome' => $this->auth->nickname]);
    }

    /**
     * 会员登录
     *
     * @param string $account  账号
     * @param string $password 密码
     */
    public function login(Request $request)
    {
		/* \var_dump($_GET);	
		exit(); */
        $account = $this->request->param('account');
		
        $password = $this->request->param('password');
        if (!$account || !$password) {
            $this->error(__('Invalid parameters'));
        }
		//判断用户是否已被冻结
		$rs_user=Db::name('user')->where('username',$account)->find();
		$rs_user_info=Db::name('user_info')->where('user_id',$rs_user['id'])->find();
		if(is_null($rs_user_info)){
			$this->error(__('用户信息不存在'));
		}

		if($rs_user_info['login_data']=="0"){
			$content=preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", "", strip_tags($rs_user_info['dongjie_content']));
			
			//$this->error($content,array('dongjie'=>true));
			exit(json_encode(array('code'=>-1,'msg'=>$content)));
		}
		
		
        $ret = $this->auth->login($account, $password);
        if ($ret) {
            $data = ['userinfo' => $this->auth->getUserinfo()];
            $this->success(__('Logged in successful'), $data);
        } else {
            $this->error($this->auth->getError());
        }
    }

    /**
     * 手机验证码登录
     *
     * @param string $mobile  手机号
     * @param string $captcha 验证码
     */
    public function mobilelogin()
    {
        $mobile = $this->request->request('mobile');
        $captcha = $this->request->request('captcha');
        if (!$mobile || !$captcha) {
            $this->error(__('Invalid parameters'));
        }
        if (!Validate::regex($mobile, "^1\d{10}$")) {
            $this->error(__('Mobile is incorrect'));
        }
        if (!Sms::check($mobile, $captcha, 'mobilelogin')) {
            $this->error(__('Captcha is incorrect'));
        }
        $user = \app\common\model\User::getByMobile($mobile);
        if ($user) {
            if ($user->status != 'normal') {
                $this->error(__('Account is locked'));
            }
            //如果已经有账号则直接登录
            $ret = $this->auth->direct($user->id);
        } else {
            $ret = $this->auth->register($mobile, Random::alnum(), '', $mobile, []);
        }
        if ($ret) {
            Sms::flush($mobile, 'mobilelogin');
            $data = ['userinfo' => $this->auth->getUserinfo()];
            $this->success(__('Logged in successful'), $data);
        } else {
            $this->error($this->auth->getError());
        }
    }

    /**
     * 注册会员
     *
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $email    邮箱
     * @param string $mobile   手机号
     * @param string $code   验证码
     */
    public function register()
    {
        $username = $this->request->param('account');
        $password = $this->request->param('password');
		$yaoqingma=$this->request->param('yaoqingma/s');
        //$email = $this->request->request('email');
        //$mobile = $this->request->request('mobile');
        //$code = $this->request->request('code');
        if (!$username || !$password) {
            $this->error(__('Invalid parameters'));
        }
        if(!ctype_alnum($username)||!preg_match("/^[_0-9a-zA-Z]{3,20}$/i",$username)){
            	$this->error(__('用户名必须是3~12位，字母和数字的组合'));
            
        }
        
		
		if(is_null($yaoqingma) && $yaoqingma!=''){
			$this->error(__('邀请码必填'));
		}	
        
		$rs_yaoqingma=Db::name('yaoqingma')->where('code',$yaoqingma)->find();
		if(is_null($rs_yaoqingma)){	
			$this->error(__('邀请码错误'));	
		}
		if($rs_yaoqingma['status']=='1'){
			$this->error(__('邀请码已被使用'));	
		}
		if($rs_yaoqingma['available_num'] == $rs_yaoqingma['use_num']){
		    $this->error(__('邀请码使用次数已达上限'));	
		}
        $ret = $this->auth->register($username, $password);
		
        if ($ret) {
			/* Db::startTrans();
			try{
			    $user_info_data=array(
			        'user_id'=>$this->auth->id,
			    	'parent_id'=>$rs_yaoqingma['daili_id'],
			        'paypassword'=>'123456',
			        'createtime'=>time(),
			    );
			    Db::name('user_info')->insert($user_info_data);
			    
			    Db::name('yaoqingma')->where('code',$yaoqingma)->update(['usetime'=>time(),'status'=>1]);
			    // 提交事务
			    Db::commit();
				$data = ['userinfo' => $this->auth->getUserinfo()];
				$this->success(__('Sign up successful'), $data);
			} catch (\Exception $e) {
			    // 回滚事务
			    Db::rollback();
				//$this->error($e->getMessage());
				$this->error('操作失败');
			} */
			
			$user_info_data=array(
			    'user_id'=>$this->auth->id,
				'parent_id'=>$rs_yaoqingma['daili_id'],
			    'paypassword'=>'123456',
			    'createtime'=>time(),
			);
			Db::name('user_info')->insert($user_info_data);
			
		    Db::name('yaoqingma')->where('code',$yaoqingma)->setInc('use_num');
		    if($rs_yaoqingma['available_num']-$rs_yaoqingma['use_num'] == 1){
			    Db::name('yaoqingma')->where('code',$yaoqingma)->update(['usetime'=>time(),'status'=>1]);
		    }
			// 提交事务
			//Db::commit();
			$data = ['userinfo' => $this->auth->getUserinfo()];
			$this->success(__('Sign up successful'), $data);
        } else {
            $this->error($this->auth->getError());
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        $this->auth->logout();
        $this->success(__('Logout successful'));
    }

    /**
     * 修改会员个人信息
     *
     * @param string $avatar   头像地址
     * @param string $username 用户名
     * @param string $nickname 昵称
     * @param string $bio      个人简介
     */
    public function profile()
    {
        $user = $this->auth->getUser();
        $username = $this->request->request('username');
        $nickname = $this->request->request('nickname');
        $bio = $this->request->request('bio');
        $avatar = $this->request->request('avatar', '', 'trim,strip_tags,htmlspecialchars');
        if ($username) {
            $exists = \app\common\model\User::where('username', $username)->where('id', '<>', $this->auth->id)->find();
            if ($exists) {
                $this->error(__('Username already exists'));
            }
            $user->username = $username;
        }
        if ($nickname) {
            $exists = \app\common\model\User::where('nickname', $nickname)->where('id', '<>', $this->auth->id)->find();
            if ($exists) {
                $this->error(__('Nickname already exists'));
            }
            $user->nickname = $nickname;
        }
        $user->bio = $bio;
        $user->avatar = $avatar;
        $user->save();
        $this->success();
    }

    /**
     * 修改邮箱
     *
     * @param string $email   邮箱
     * @param string $captcha 验证码
     */
    public function changeemail()
    {
        $user = $this->auth->getUser();
        $email = $this->request->post('email');
        $captcha = $this->request->request('captcha');
        if (!$email || !$captcha) {
            $this->error(__('Invalid parameters'));
        }
        if (!Validate::is($email, "email")) {
            $this->error(__('Email is incorrect'));
        }
        if (\app\common\model\User::where('email', $email)->where('id', '<>', $user->id)->find()) {
            $this->error(__('Email already exists'));
        }
        $result = Ems::check($email, $captcha, 'changeemail');
        if (!$result) {
            $this->error(__('Captcha is incorrect'));
        }
        $verification = $user->verification;
        $verification->email = 1;
        $user->verification = $verification;
        $user->email = $email;
        $user->save();

        Ems::flush($email, 'changeemail');
        $this->success();
    }

    /**
     * 修改手机号
     *
     * @param string $mobile   手机号
     * @param string $captcha 验证码
     */
    public function changemobile()
    {
        $user = $this->auth->getUser();
        $mobile = $this->request->request('mobile');
        $captcha = $this->request->request('captcha');
        if (!$mobile || !$captcha) {
            $this->error(__('Invalid parameters'));
        }
        if (!Validate::regex($mobile, "^1\d{10}$")) {
            $this->error(__('Mobile is incorrect'));
        }
        if (\app\common\model\User::where('mobile', $mobile)->where('id', '<>', $user->id)->find()) {
            $this->error(__('Mobile already exists'));
        }
        $result = Sms::check($mobile, $captcha, 'changemobile');
        if (!$result) {
            $this->error(__('Captcha is incorrect'));
        }
        $verification = $user->verification;
        $verification->mobile = 1;
        $user->verification = $verification;
        $user->mobile = $mobile;
        $user->save();

        Sms::flush($mobile, 'changemobile');
        $this->success();
    }

    /**
     * 第三方登录
     *
     * @param string $platform 平台名称
     * @param string $code     Code码
     */
    public function third()
    {
        $url = url('user/index');
        $platform = $this->request->request("platform");
        $code = $this->request->request("code");
        $config = get_addon_config('third');
        if (!$config || !isset($config[$platform])) {
            $this->error(__('Invalid parameters'));
        }
        $app = new \addons\third\library\Application($config);
        //通过code换access_token和绑定会员
        $result = $app->{$platform}->getUserInfo(['code' => $code]);
        if ($result) {
            $loginret = \addons\third\library\Service::connect($platform, $result);
            if ($loginret) {
                $data = [
                    'userinfo'  => $this->auth->getUserinfo(),
                    'thirdinfo' => $result
                ];
                $this->success(__('Logged in successful'), $data);
            }
        }
        $this->error(__('Operation failed'), $url);
    }

    /**
     * 重置密码
     *
     * @param string $mobile      手机号
     * @param string $newpassword 新密码
     * @param string $captcha     验证码
     */
    public function resetpwd()
    {
        $type = $this->request->request("type");
        $mobile = $this->request->request("mobile");
        $email = $this->request->request("email");
        $newpassword = $this->request->request("newpassword");
        $captcha = $this->request->request("captcha");
        if (!$newpassword || !$captcha) {
            $this->error(__('Invalid parameters'));
        }
        if ($type == 'mobile') {
            if (!Validate::regex($mobile, "^1\d{10}$")) {
                $this->error(__('Mobile is incorrect'));
            }
            $user = \app\common\model\User::getByMobile($mobile);
            if (!$user) {
                $this->error(__('User not found'));
            }
            $ret = Sms::check($mobile, $captcha, 'resetpwd');
            if (!$ret) {
                $this->error(__('Captcha is incorrect'));
            }
            Sms::flush($mobile, 'resetpwd');
        } else {
            if (!Validate::is($email, "email")) {
                $this->error(__('Email is incorrect'));
            }
            $user = \app\common\model\User::getByEmail($email);
            if (!$user) {
                $this->error(__('User not found'));
            }
            $ret = Ems::check($email, $captcha, 'resetpwd');
            if (!$ret) {
                $this->error(__('Captcha is incorrect'));
            }
            Ems::flush($email, 'resetpwd');
        }
        //模拟一次登录
        $this->auth->direct($user->id);
        $ret = $this->auth->changepwd($newpassword, '', true);
        if ($ret) {
            $this->success(__('Reset password successful'));
        } else {
            $this->error($this->auth->getError());
        }
    }
}
