<?php

namespace app\common\model;

use think\Model;

class KefuModel extends Model{
	protected $connection = 'db_kefu';
	protected $table = 'lc3_user';
	
	public function AutoLogin($userInfo=[]){
        return true;
        if(!$userInfo){
            return false;
        }
        $username = $userInfo['username'];
        $kefu_user_sync = config('custom.kefu_user_sync');
        $user = $this->where('username',$username)->find();
        if(!$user && $kefu_user_sync){
            $kefuUser = $this->adduser($userInfo);
            if(!$kefuUser){
                return -2;
            }
        }
        $nidhash = $this->generateRandID(16);
        $sid = session_id();
        //$jakdb->update("user", ["session" => session_id(), "idhash" => $nidhash, "logins[+]" => 1, "available" => 1, "forgot" => 0, "lastactivity" => time()], ["AND" => ["username" => $name, "password" => $passcrypt]]);
        $sid =  session_id();
        $update = [
            'idhash' => $nidhash,
            'session' => $sid,
            'available' => 1,
            'forgot' => 0,
            'lastactivity' => time()
        ];
        $r = $this->where('username',$username)->update($update);
        if($r){
            $_SESSION['jak_lcp_username'] = $username;
    	    $_SESSION['jak_lcp_idhash'] = $nidhash;
            return true;
        }
        return false;
    }
    
    private function adduser($userInfo){
        //  array('id' => '1','departments' => '0','available' => '1','busy' => '0','hours_array' => NULL,'phonenumber' => NULL,'whatsappnumber' => NULL,'pusho_tok' => NULL,'pusho_key' => NULL,'username' => 'admin','password' => '0b0f8c86c0e5404a17b83ef92d2acdcc262154f2d87b53be957ec2485b76eb36','idhash' => '64cca6e2fc02ccf8e960d49b7f2629be','session' => 'js1tqdd3ug26jrngbicck3255d','email' => '241604@qq.com','name' => 'test','picture' => '/standard.jpg','language' => NULL,'invitationmsg' => NULL,'time' => '2020-12-11 09:30:09','lastactivity' => '1607681422','hits' => '0','logins' => '3','responses' => '1','files' => '1','useronlinelist' => '1','operatorchat' => '1','operatorchatpublic' => '1','operatorlist' => '0','transferc' => '1','chat_latency' => '3000','push_notifications' => '1','sound' => '1','ringing' => '3','alwaysnot' => '0','emailnot' => '0','access' => '1','permissions' => NULL,'forgot' => '0')
        $username = $userInfo['username'];
        $password = $userInfo['password'];
        $data = [ 
			"departments" => 0,
			"password" => hash_hmac('sha256', $password, 'something_strong_goes_in_here'),
			"username" => $username,
			"name" => $username,
			"email" => '',
			"responses" => 1,
			"files" => 1,
			"operatorchat" => 1,
			"operatorchatpublic" => 1,
			"operatorlist" => 0,
			"transferc" => 1,
			"chat_latency" =>3000,
			"useronlinelist" => 1,
			"sound" => 1,
			"ringing" => 3,
			"language" => NULL,
			"invitationmsg" => NULL,
			"permissions" => NULL,
			"access" => 1,
			"time" => date('Y-m-d H:i:s'),
		];
		return $this->insertGetId($data);
    }
    
    private function generateRandID($length=16) {
	   $randstr = "";
	   for($i=0; $i<$length; $i++){
	      $randnum = mt_rand(0,61);
	      if($randnum < 10){
	         $randstr .= chr($randnum+48);
	      }else if($randnum < 36){
	         $randstr .= chr($randnum+55);
	      }else{
	         $randstr .= chr($randnum+61);
	      }
	   }
	   return md5($randstr);
	}
}