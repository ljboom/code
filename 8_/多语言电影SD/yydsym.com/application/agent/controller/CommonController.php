<?php
namespace app\agent\controller;

use think\Controller;

class CommonController extends Controller{
	
	protected $USER = NULL;
	protected $userid = NULL;
	
    public function initialize(){
    	header('Access-Control-Allow-Origin:*');
		ini_set ('session.cookie_lifetime',86400);
		ini_set ('session.gc_maxlifetime',86400);
		//判断是否登陆
		$is_agent_login = session('agent');
		
		if(empty($is_agent_login) || !isset($is_agent_login['uid'])) {
			if (request()->isAjax()) {
				return '未登录！';
			} else {
				return $this->success('未登录！', '/agent/login');
			}
		}
		
		$this->userid = $is_agent_login['uid'];
		
		$this->USER = model('Users')->where('id',$this->userid)->find();
		$this->assign('USER',$this->USER);
		if(!$this->USER){
			if (request()->isAjax()) {
				return '未登录！';
			} else {
				return $this->success('未登录！', '/agent/login');
			}
		}
	}
}
