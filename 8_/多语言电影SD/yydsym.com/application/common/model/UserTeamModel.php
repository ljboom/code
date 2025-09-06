<?php
namespace app\common\model;

use think\Model;

class UserTeamModel extends Model{
	//表名
	protected $table = 'ly_user_team';


	/**
	 * 获取在线人数
	 * @param  string $uid [description]
	 * @return [type]      [description]
	 */
	public function getTeamUsers($uid=''){
		if ($uid) {
			$array = model('UserTeam')->where('uid', $uid)->column('team');
		} else {
			$array = model('Users')->column('id');
		}
		
		$online = 0;
		$userList = model('Users')->column('id');
		foreach ($array as $key => $value) {			
			if (cache('C_token_'.$value)) $online++;
		}

		return $online;
	}


}