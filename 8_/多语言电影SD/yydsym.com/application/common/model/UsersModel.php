<?php
namespace app\common\model;

use think\Model;

class UsersModel extends Model{
	
	protected $table = 'ly_users';
	
	/**
	 * 团队报表
	 */
	public function teamStatistic($id = 0){
		$param = input('get.');
		//$param['sid'] = 15;
		//查询条件组装
		$where = array();
		//分页参数组装
		$pageUrl = '';
		$param['isUser'] = (isset($param['isUser'])) ? $param['isUser'] : 1;
		//用户名搜索
		$sid = 0;
		if(isset($param['username']) && $param['username']){
			$where[] = array('username','=',trim($param['username']));
			$pageUrl .= '&username='.$param['username'];
		}else{
			//查看下级
			if(isset($param['sid']) && $param['sid']){
				$idOne = $this->where('id',$param['sid'])->value('sid');
				$idtwo = $this->where('id',$idOne)->value('id');
				$param['id'] = $idtwo;
				$pageUrl .= '&sid='.$param['sid'];
			}
			//查看上级
			if(isset($param['id']) && $param['id']){
				$where[] = array('sid','=',$param['id']);
				$sid = $param['id'];
				$pageUrl .= '&id='.$param['id'];
			}else{
				$where[] = array('sid','=',$sid);
			}
		}
		// 时间
		if(isset($param['date_range']) && $param['date_range']){
			$dateTime  = explode(' - ', $param['date_range']);
			$startDate = strtotime($dateTime[0]);
			$endDate   = strtotime($dateTime[1]);
			$pageUrl   .= '&date_range='.$param['date_range'];
		}else{
			$startDate           = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$endDate             = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$param['date_range'] = date('Y-m-d', $startDate).' - '.date('Y-m-d', $endDate);
		}
		// 过滤
		$filter = (isset($param['filter']) && $param['filter'] == 'on') ? true : false;
		//var_dump($where);
		//查询符合条件的数据
		if ($id) {
		   foreach($where as $k => $v) {
		       if ($v[0] == 'sid') {
		           $where[$k][2] = $id;
		       }
		   }
		}
		$userList = $this->field('id,sid,username,state')
		->where($where)
		//->where('sid', 15)
		->select()->toArray();
		//$userList = $this->field('id,sid,username,state')->where('sid',$param['sid'])->select()->toArray();
		 //print_r($userList);die;
		//         $newUser = model('Users')->alias('u')
// 			->join('user_team','u.id=user_team.team')->where('user_team.uid','=',$touserid)
// 			->field('u.id,username as title,sid as field');
		//用户团队数据计算
		$data = model('UserDaily')->teamStatistic($userList,$startDate,$endDate,$sid,$filter);
		$total['totalAll'] = $data['totalAll'];
	   
		unset($data['totalAll']);
		//var_dump($data);
		//分页
		$pageNum = isset($param['page']) && $param['page'] ? $param['page'] : 1 ;
		$pageInfo = model('ArrPage')->page($data, 10, $pageNum, $pageUrl);
		//var_dump($pageInfo);
		$page = $pageInfo['links'];
		$source = $pageInfo['source'];

		// 分页小计
		$sumField = ['recharge','withdrawal','task','rebate','regment','other','buymembers','spread','pump','revoke','commission'];
		foreach ($sumField as $key => &$value) {
			$total['totalPage'][$value] = 0;
			foreach ($source as $k => $v) {
				$total['totalPage'][$value] += $v[$value];
			}
		}
		//var_dump($source);
		return array(
			'data'  =>	$source,
			'total' =>	$total,
			'page'  =>	$page,//分页
			'where' =>	$param,
		);
	}
	/**
	 * 用户编辑提交
	 */
	public function useredit(){
		$param = input('post.');//获取参数
		if(!$param) return '提交失败';
		//参数过滤
		// $array = $param;
		$array = array_filter($param);
		//提取用户ID
		$uid = $array['id'];
		unset($array['id']);
		//获取用户信息（用于操作日志）
		$userInfo = $this->where('id','=',$uid)->find();
		// 用户状态
		if (isset($array['state']) && $array['state']) {
			switch ($array['state']) {
				// 冻结
				case 3:
					if (cache('C_token_'.$uid)) cache('C_token_'.$uid, NULL);
					break;
				// 踢下线
				case 4:
					if (cache('C_token_'.$uid)) cache('C_token_'.$uid, NULL);
					unset($array['state']);
					break;
			}
		}
		//修改vip等级
		
		
		if($userInfo['vip_level'] != $array['vip_level']){

			if($array['vip_level']>1){
				$start_time = strtotime(date("Y-m-d",time()));//当天的时间错
				$UserVip		=	model('UserVip')->where(array(['uid','=',$userInfo['id']],['state','=',1],['etime','>=',$start_time]))->find();
				$GradeInfo			=	model('UserGrade')->where('grade', $array['vip_level'])->find();
				if($UserVip){
					$vipdate = array(
						'en_name'	=>	$GradeInfo['en_name'],
						'name'		=>	$GradeInfo['name'],
						'grade'		=>	$array['vip_level'],
						'stime'		=>	$start_time,
						'etime'		=>	$start_time	+	356 * 24 * 3600,
					);
					model('UserVip')->where(array(['id','=',$UserVip['id']]))->update($vipdate);
				}else{
					$newData	= [
						'username'	=> $userInfo['username'],
						'uid'		=> $userInfo['id'],
						'state'		=> 1,
						'name'		=> $GradeInfo['name'],
						'en_name'	=> $GradeInfo['en_name'],
						'grade'		=> $array['vip_level'],
						'stime'		=> $start_time,
						'etime'		=> $start_time + 365 * 24 * 3600,
					];
					model('UserVip')->insertGetId($newData);
				}
			}
		}

		// 账户密码加密
		if (isset($array['password']) && $array['password']) $array['password'] = auth_code($array['password'],'ENCODE');
		// 安全密码加密
		if (isset($array['fund_password']) && $array['fund_password']) $array['fund_password'] = auth_code($array['fund_password'],'ENCODE');
		// 信用分
		//$credit = 0;
		//if (isset($array['credit']) && $array['credit']) {
			//$credit = $array['credit'];
			//unset($array['credit']);
		//}
		// 数据更新
		$res2 = $this->where('id', $uid)->update($array);
		
		//解绑支付宝
		if($param['alipay']==''){
			$alipayarray	=	array(
				'alipay'		=>	'',
				'alipay_name'	=>	'',
			);
			$this->where('id', $uid)->update($alipayarray);
		}
		//解除实名认证
		if($param['realname']==''){
			$alipayarray	=	array(
				'realname'		=>	'',
			);
			$this->where('id', $uid)->update($alipayarray);
		}
		//日志内容
		$logContent = '编辑用户名为'.$userInfo['username'].'的用户，';
		foreach ($array as $key => $value) {
			if (!isset($userInfo[$key]) || $userInfo[$key] == $value) continue;
			switch ($key) {
				case 'vip_level':
					$grade1 = model('UserGrade')->field('grade,name')->where('id','>',0)->select()->toArray();
					foreach ($grade1 as $key => $value) {
						$grade2[$value['grade']] = $value['name'];
					}
					$logContent .= '用户VIP等级由'.$grade2[$userInfo['vip_level']].'调整为'.$grade2[$array['vip_level']].'，';
					break;
				case 'state':
					$logContent .= '用户状态由'.config('custom.userState')[$userInfo['state']].'调整为'.config('custom.userState')[$array['state']].'，';
					break;
				case 'grade':
					$logContent .= '会员积分等级由'.$userInfo['grade'].'修改为'.$array['grade'].'，';
					// $logContent .= '会员积分由'.$userInfo['experience'].'修改为'.$array['experience'].'，';
					break;
				case 'password':
					$logContent .= '登录密码由'.auth_code($userInfo['password'],'DECODE').'修改为'.auth_code($array['password'],'DECODE').'，';
					break;
				case 'fund_password':
					$logContent .= '取款密码由'.auth_code($userInfo['fund_password'],'DECODE').'修改为'.auth_code($array['fund_password'],'DECODE').'，';
					break;
				case 'rebate':
					$logContent .= '返点由'.$userInfo['rebate'].'修改为'.$array['rebate'].'，';
					break;
				case 'credit':
					$logContent .= '信用分由'.$userInfo['credit'].'调整为'.$array['credit'].'，';
					break;
				case 'alipay':
					$logContent .= '支付宝账号由'.$userInfo['alipay'].'调整为'.$array['alipay'].'，';
					break;
				case 'alipay_name':
					$logContent .= '支付宝名称由'.$userInfo['alipay_name'].'调整为'.$array['alipay_name'].'，';
					break;
				case 'realname':
					$logContent .= '实名认证由'.$userInfo['realname'].'调整为'.$array['realname'].'，';
					break;
				case 's_hb':
					$logContent .= '私发状态由'.($userInfo['s_hb'] == 1 ? '允许' : '不允许').'调整为'.($array['s_hb'] == 1 ? '允许' : '不允许').'，';
					break;
				case 'is_auto_f':
					$logContent .= '自动添加好友由'.($userInfo['is_auto_f'] == 1 ? '允许' : '不允许').'调整为'.($array['is_auto_f'] == 1 ? '允许' : '不允许').'，';
					break;
				case 'withdrawals_state':
					$logContent .= '提现状态由'.($userInfo['withdrawals_state'] == 1 ? '开启' : '关闭').'调整为'.($array['withdrawals_state'] == 1 ? '开启' : '关闭').'，';
					break;
			}
		}
		//添加操作日志
		//model('Actionlog')->actionLog(session('manage_username'),$logContent,1);

		return 1;
	}
	/**
	 * 用户编辑视图
	 */
	public function editView(){
		$uid = input('get.id');//获取参数
		$data = $this->where('id','=',$uid)->find();//获取用户信息
		//获取该用户所有上级
		$getUserSupArray = $this->getUserUp($data['sid'],'id,sid,username');
		$userSup = '';
		foreach ($getUserSupArray as $key => $value) {
			$userSup .= $value['username'].' > ';
		}
		$data['userSup'] = rtrim($userSup,' > ');
		//用户总金额信息
		$data['userTotal'] = model('UserTotal')->field('id',true)->where('uid','=',$uid)->find();
		//最近一次充值
		$lastRecharge = model('UserRecharge')->field('add_time')->where('uid','=',$uid)->order('add_time','desc')->limit(1)->find();
		$data['LastRecharge'] = $lastRecharge['add_time'] ? date('Y-m-d H:i:s',$lastRecharge['add_time']) : '';
		//用户银行
 		$data['bankInfo'] = model('UserBank')->where('uid',$uid)->order('id','desc')->limit(1)->find();
		//用户银行
		$data['userVip'] = model('UserGrade')->select()->toArray();

		//权限查询
		$powerWhere = [
			['uid','=',session('manage_userid')],
			['cid','=',2],
		];
		$power = model('ManageUserRole')->getUserPower($powerWhere);
		return array(
			'userInfo'			=>	$data,
			'power'				=>	$data,
			'userState'			=>	config('custom.userState'),//账号状态
		);
	}
	
	/**
	 * 获取用户所有的上级信息
	 * @param  integer $id   要获取的直属上级的用户ID
	 * @param  string $field 需要获取的字段
	 * @param  bool   $getid 是否只返回含有用户ID的一维数组
	 * @param  array  $array
	 * @return array         包含所有上级用户的二维数组
	 */
	public function getUserUp($id,$field='*',$getid=false,$array=array()){
		$userInfo = $this->field($field)->where('id','=',$id)->find();
		if($getid){
			$array[] = $userInfo['id'];
		}else{
			$array[] = $userInfo;
		}
		if(isset($userInfo['sid']) && $userInfo['sid']){
			$array = $this->getUserUp($userInfo['sid'],$field,$getid,$array);
		}
		return $array;
	}



}