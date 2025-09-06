<?php
namespace app\agent\controller;

use think\Controller;

class LoginController extends Controller{

	public function initialize(){
    	header('Access-Control-Allow-Origin:*');    	
	}
	
	public function index(){
		//是否是isAjax提交		
		if ($this->request->isAjax()) {
			$username = input('post.user/s');
			$password = input('post.pass/s');
			$verifyCode = input('post.code/d');
			//if (session('code') != $verifyCode) return 'code';
			//获取用户信息
			$userinfo = model('Users')->where(array(['username','=',$username],['state','=',1]))->find();
// 			if ($$userinfo == 1) {
				
// 			}else{
				
// 			}
// 			var_dump($userinfo);
// 			die;

			//用户名不存在
			if(!$userinfo){
				 return 'nouser';
			}
			cookie('username',base64_encode($userinfo['username']),86400*7);
			//检查密码
			if(auth_code($userinfo['password'],'DECODE') != $password){
				 return 'pwd';
			}

			//用户所在地
			$address = model('Loginlog')->GetIpLookup();
			if (!$address) {
				$address = '';
			}

			//获取用户端
			$logintype =  model('Loginlog')->getBrowserType();
			if ($logintype == 2) {
				$type = '代理登入手机网页版';
			}else{
				$type = '代理登入PC网页版';
			}

			// 添加登陆日志
			$loginlog = array(
				'uid'			=> $userinfo['id'],
				'username'		=> $userinfo['username'],
				'os'			=> get_os(),
				'browser'		=> get_broswer(),
				'ip'			=> request()->ip(),
				'time'			=> time(),
				'address'		=> $address,
				'type'			=> $type
			); 
			$is_insert_user_loginlog = model('Loginlog')->insert($loginlog);
			//更新用户登录状态
			$is_user_update = model('Users')->where('id',$userinfo['id'])->data(array('last_ip'=>request()->ip(),'last_login'=>time(),'login_error'=>0))->setInc('login_number',1);
			session('agent',$loginlog);
			
   			return 1;
		}
		return view('');
	}
	
	public function code(){
		ob_clean();
		$image = imagecreatetruecolor(100, 34);  
		$bgcolor = imagecolorallocate($image, 255, 255, 255);  
		imagefill($image, 0, 0, $bgcolor);  
	  
		$captch_code = '';  
		for($i=0;$i<4;$i++) { 
		 
			$fontsize = 6;  
			$fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120),rand(0, 120));  
	  
			$data = '0123456789';  
			$fontcontent = substr($data, rand(0, strlen($data)-1), 1);
			$captch_code .= $fontcontent;  
	  
			$x = ($i*100/4) + rand(5, 10);  
			$y = rand(5, 10);  
	  
			imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);  
		}
		session('code',$captch_code);  
	  
		//增加点干扰元素  
		for($i=0; $i<200;$i++) {  
			$pointcolor = imagecolorallocate($image, rand(50,200), rand(50,200), rand(50,200));  
			imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);  
		}  
	  
		//增加线干扰元素  
		for($i=0;$i<3;$i++) {  
			$linecolor = imagecolorallocate($image, rand(80,220), rand(80,220), rand(80, 220));  
			imageline($image, rand(1,99), rand(1,29), rand(1,99), rand(1,29), $linecolor);  
		}  
	  
	  
		header('content-type:image/png');  
		imagepng($image);  
	  
		imagedestroy($image);  
	}
	
	
}
