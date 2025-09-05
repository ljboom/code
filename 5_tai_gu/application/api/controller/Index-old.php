<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
use think\Request;


/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['getKefu','setQuankaijiang','daojishi','uploadImage','addRecharge','action_huigou','yuebao_jiesuan','guoqi_lingquan','listenRecharge','listenCashout','listenLingQuan'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     *
     */
	//获取首页信息
    public function index(Request $request)
    {
		
		$gonggao_show_num=Db::name('config')->where('name','gonggao_show_num')->field('value')->find();
		$gonggao_show_num=$gonggao_show_num['value'];
		
		$rs_gonggao=Db::name('gonggao')->where('show_switch',1)->order('weigh')->limit($gonggao_show_num)->select();
		
		$rs_kefu=Db::name('config')->where('name','kefu_url')->field('value')->find();
		$rs_kefu=$rs_kefu['value'];
		
		$rs_tongzhi=Db::name('config')->where('name','topmarquee')->field('value')->find();
		$rs_tongzhi=$rs_tongzhi['value'];
		
		$rs_yuebao=Db::name('config')->where('name','yuebao')->field('value')->find();
		$rs_yuebao=$rs_yuebao['value'];
		
		$result=array(
			'gonggao'=>$rs_gonggao,
			'kefu'=>$rs_kefu,
			'tongzhi'=>$rs_tongzhi,
			'yuebao'=>$rs_yuebao,
		);
		
        $this->success('请求成功',$result);
    }
	
	//获取优惠券列表
	public function getQuanList(Request $request)
	{
		$now=time();
		$rs_category=Db::name('category')->where('type','quan')->order('weigh desc')->select();
		//$rs_meiyuanhuilv=Db::name('config')->where('name','meiyuan_huilv')->field('value')->find();
		$result=array();
		$map_all=array(
				'show_switch'=>1,
				'starttime'=>['<',$now],
				'endtime'=>['>',$now],
			);
		$result[0]['name']='所有分类';
		$rs_all=Db::name('quan')->where($map_all)->field('id,category_id,name,price,image,percent')->order('weigh desc')->select();
		foreach($rs_all as $i=>$j){
				$rs_all[$i]['image']=input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME').$j['image'];
				
				//$num=(floatval($j['price'])*$j['percent'])/100*floatval($rs_meiyuanhuilv['value']); 
				//$rs_all[$i]['meiyuan']=round($num,2); 
				$rs_all[$i]['meiyuan']=sprintf("%01.2f", floatval($j['price']*$j['percent']/100));
			}
			
		$result[0]['foods']=$rs_all;
			
		foreach($rs_category as $k=>$v){
			$result[$k+1]['name']=$v['name'];
			$category_id=$v['id'];
			
			$map=array(
				'category_id'=>$category_id,
				'show_switch'=>1,
				'starttime'=>['<',$now],
				'endtime'=>['>',$now],
			);
			
			$rs_quan=Db::name('quan')->where($map)->field('id,category_id,name,price,image,percent')->order('weigh desc')->select();
			foreach($rs_quan as $i=>$j){
				$rs_quan[$i]['image']=input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME').$j['image'];
				
				//$num=(floatval($j['price'])*$j['percent'])/100*floatval($rs_meiyuanhuilv['value']); 
				$rs_quan[$i]['meiyuan']=sprintf("%01.2f", floatval($j['price']*$j['percent']/100));
				//$rs_all[$i]['meiyuan']=floatval($j['price'])*$j['percent'];
			}
			$result[$k+1]['foods']=$rs_quan;
		}
		
		$this->success('请求成功',$result);
		
	}
	
	//获取优惠券详情
	public function getQuanDetail(Request $request){
		$id=intval($request->param('id'));
		$rs_quan=Db::name('quan')->where('id',$id)->find();
		if(empty($rs_quan)){
			$this->error('请求失败，优惠券不存在');
		}else{
			$banner_arr=explode(',',$rs_quan['banner_images']);
			$content_arr=explode(',',$rs_quan['content_images']);
			
			$banner=array();
			$content=array();
			
			foreach($banner_arr as $i=>$j){
				$banner[$i]=input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME').$j;	
			}
			foreach($content_arr as $i=>$j){
				$content[$i]=input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME').$j;	
			}
			$rs_quan['banner']=$banner;
			$rs_quan['content']=$content;
			
			$this->success('请求成功',$rs_quan);
		}
	}
	
	//设置优惠券开奖
	public function setQuankaijiang(){
		$config=Db::name('config')->where('name','daojishi_switch')->field('name,value')->find();
		if($config['value']==1){	//判断倒计时开关
			$today_date=date('Y-m-d',time());
			$today_date_timestamp=strtotime($today_date);
			
			$count=Db::name('quan_kaijiang')->where('quan_date',$today_date_timestamp)->count();
			
			if($count==0){  //判断今天的券开奖时间是否已经设置过了
				$rs_kaijiang_settings=Db::name('config')->where('name','in',['quan_starttime','quan_endtime','ready_minutes','duration_minutes'])->field('name,value')->select();
				$kaijiang_settings=array();
				//var_dump($rs_kaijiang_settings);
				foreach($rs_kaijiang_settings as $k=>$v){
					$kaijiang_settings[$v['name']]=$v['value'];
				}
				
				
				$today_start_time =  strtotime($kaijiang_settings['quan_starttime']);
				
			    $today_end_time = strtotime($kaijiang_settings['quan_endtime']);
			
			    $ready_minutes=intval($kaijiang_settings['ready_minutes']);
			    
			    $duration_minutes=intval($kaijiang_settings['duration_minutes']);
			    
			    $meiqi_fenzhong=$ready_minutes+$duration_minutes;
			    
			    $meiqi_fenzhong_miaoshu=$meiqi_fenzhong*60;
			    
			    $index=0;
			    $data=array();
			    for($i=$today_date_timestamp;$i<$today_end_time;$i+=$meiqi_fenzhong_miaoshu){
			        $index++;
				      
			        $data[]=array(
			           'quan_date'=> $today_date_timestamp,
			           'quan_qishu'=>date('Ymd').sprintf("%04d",$index),
			           'start_time'=>$i,
			           'end_time'=>$i+$meiqi_fenzhong_miaoshu,
			           'open_time'=>$i+$ready_minutes*60,
			            
			        );
			        
			        
			    }
			    Db::name('quan_kaijiang')->insertAll($data);
			    exit('今天的数据添加成功');
			}else{
			    exit('今天的数据已经存在');
			}
		}
	        
	        
	        
	        
	        
	}
	
	//倒计时
	public function daojishi(Request $request){
		$now=time();
		$row=Db::name('quan_kaijiang')->where(['start_time'=>['<=',$now],'end_time'=>['>',$now]])->find();

		if(is_null($row)){
			$config=Db::name('config')->where('name','daojishi_switch')->field('name,value')->find();
			if($config['value']==1){	//判断倒计时开关
				$this->error('当前在不在抢券时间');
			}else{
				$rs_kaijiang_settings=Db::name('config')->where('name','in',['quan_starttime','quan_endtime','ready_minutes','duration_minutes'])->field('name,value')->select();
				$kaijiang_settings=array();
				//var_dump($rs_kaijiang_settings);
				foreach($rs_kaijiang_settings as $k=>$v){
					$kaijiang_settings[$v['name']]=$v['value'];
				}
				
				
				$today_start_time =  strtotime($kaijiang_settings['quan_starttime']);
				
				$today_end_time = strtotime($kaijiang_settings['quan_endtime']);
				
				
				$this->success('请求成功',array(
						'qishu'=>'自由抢券',
						'start_time'=>$today_start_time,
						'end_time'=>$today_end_time,
						'open_time'=>$today_start_time,
						'daojishi_switch'=>$config['value'],
					));
			}
			

		}else{
			$config=Db::name('config')->where('name','daojishi_switch')->field('name,value')->find();

			$this->success('请求成功',array(
					'qishu'=>$row['quan_qishu'],
					'start_time'=>intval($row['start_time']),
					'end_time'=>intval($row['end_time']),
					'open_time'=>intval($row['open_time']),
					'daojishi_switch'=>$config['value'],
				));
		}
	}
	
	//领取优惠券
	public function qiangquan(Request $request){
		$user_id=$request->param('userid');
		$quan_id=$request->param('id');
		if(is_null($user_id)||$user_id==''){    //如果用户未登录
			$this->error('请先登录');
		}
		//exit();
		//判断当前在不在开奖时间
		$now=time();
		$config=Db::name('config')->where('name','daojishi_switch')->field('name,value')->find();
		if($config['value']==1){
			$row=Db::name('quan_kaijiang')->where(['start_time'=>['<=',$now],'end_time'=>['>',$now]])->find();
			
			if(is_null($row)){
				$this->error('当前在不在抢券时间');
			}
		}
		
		
		//判断当前用户的余额，能不能领该优惠券
		
		$user = Db::name('user')->where('id',$user_id)->find();
		$user_money=floatval($user['money']);

		$quan = Db::name('quan')->where('id',$quan_id)->find();
		
		$product_price=floatval($quan['price']);
		if($user_money<$product_price){
			$this->error('您的余额不足，不能领取该券');
		}
		
		//判断当前用户，在不在允许领取的范围之内
		$quan_user_ids=$quan['user_ids'];
		$quan_user_ids_arr=explode(",",$quan_user_ids);
		

		if (!in_array($user_id, $quan_user_ids_arr)){    //如果用户不在禁止领取的用户范围里
			//判断是否已经领过该券
			$row=Db::name('lingquan')->where(['quan_id'=>$quan_id,'user_id'=>$user_id,'shenhe_status'=>0])->find();
			if(!is_null($row)){
				$this->error('您的抢券等待审核中...');
				
			}
			
			//判断这个券是否还有库存
			$row=Db::name('quan')->where('id',$quan_id)->find();
						
			if(is_null($row)){

				$this->error('ID错误，该优惠券不存在');
			}
			if($row['quan_num']<1){
				$this->error('该优惠券已被领完');
			}
			
			
			//减券的库存
			Db::name('quan')->where('id', $quan_id)->setDec('quan_num');
			//领取成功，写入优惠券日志
   
			$data=array(
				'user_id'=>$user_id,
				'num'=>1,
				'quan_id'=>$quan_id,
				'quan_name'=>$row['name'],
				'createtime'=>time(),
				'shenhe_status'=>0,
			);
			Db::name('lingquan')->insert($data);
			
			//用户的余额减去券的价值
			//Db::name('user')->where('id',$user_id)->setDec('money',$product_price);			
			
			$this->success('请求成功',array('msg'=>'抢优惠券成功，等待审核'));
		  
		}else{      //如果不在指定的用户范围里
		
			//领取失败，写入优惠券日志
			$data=array(
				'user_id'=>$user_id,
				'num'=>1,
				'quan_id'=>$quan_id,
				'quan_name'=>$quan['name'],
				'createtime'=>time(),
				'shenhe_status'=>3,
			);
			Db::name('lingquan')->insert($data);
			
			$this->error('哎呀，没有抢到，下次再试试手气');
		}
	}
	
	//获取系统银行卡
	public function getSystemBank(Request $request){
		$rs_bank=Db::name('config')->where('name','in',['rechage_name','bank_card','bank_type'])->field('name,value')->select();
		$bank=array();
		foreach($rs_bank as $k=>$v){
			$bank[$v['name']]=$v['value'];
		}
		$this->success('请求成功',$bank);
	}
	
	//上传图片
	public function uploadImage(Request $request){
		// 获取表单上传文件 例如上传了001.jpg
		    $file = request()->file('file');
		    // 移动到框架应用根目录/public/uploads/ 目录下
		    $info = $file->validate(['size'=>10240000,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
		    if($info){
		        // 成功上传后 获取上传信息
		        // 输出 jpg
		        //echo $info->getExtension();
		        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
		        //echo $info->getSaveName();
		        // 输出 42a79759f284b767dfcb2a0197904287.jpg
		        //echo $info->getFilename();
				$this->success('上传成功',array('url'=>$info->getSaveName())); 
		    }else{
		        // 上传失败获取错误信息
				$this->error($file->getError()); 
		    }
	}
	
	//添加充值记录
	public function addRecharge(Request $request){
		
		$money=intval($request->param('money'));
		$image=trim($request->param('image'));
		$user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		if($money<=0){
			$this->error('充值金额错误');
		}
		if($image==''){
			$this->error('请上传转账记录截图');
			if(!file_exists('uploads/'.$image)){
				$this->error('请转账记录截图不存在');
			}
		}
		
		$data=array(
			'user_id'=>$user_id,
			'money'=>$money,
			'image'=>'/uploads/'.$image,
			'createtime'=>time(),
			'status'=>0,
		);
		$rs=Db::name('chongzhi')->insert($data);
		if($rs>0){
			$this->success('请求成功',array('msg'=>'提交成功，请等待审核'));
		}else{
			$this->error('提交失败');
		}
	}
	
	//提现页面获取用户余额、银行卡
	public function withdrawal(Request $request){
		//用户的余额
		$user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		/* if(\is_null($user_info)){
			$this->error('用户信息不存在');
		} */
		
		
		$result=array(
			'money'=>$user['money'],
			'user_info'=>$user_info,
		);
		$this->success('请求成功',$result);
	}
	
	//提交提现申请
	public function submitWithdrawal(Request $request){
		$money=$request->param('money');
		$pass=$request->param('pass');
		
		$user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if(\is_null($user_info)){
			$this->error('用户信息不存在');
		}
		
		if($user_info['pay_password']!=$pass){
			$this->error('资金密码不正确');
		}
		
		if($user_info['bank_card']==''){
			$this->error('未绑银行卡');
		}
		
		if($money>$user['money']){
			$this->error('资金余额不足提现');
		}
		
		$data=array(
			'user_id'=>$user_id,
			'shiming_name'=>$user_info['shiming_name'],
			'bank_name'=>$user_info['bank_name'],
			'bank_card'=>$user_info['bank_card'],
			'money'=>$money,
			'status'=>0,
			'createtime'=>time(),
		);
		
		$rs=Db::name('tixian')->insert($data);
		if($rs>0){
		    //用户余额减少
		    Db::name('user')->where('id',$user_id)->setDec('money',$money);
			$this->success('请求成功',array('msg'=>'提现申请提交成功，请等待审核'));
		}else{
			$this->error('提现申请失败');
		}
	}
	
	//检测用户银行卡支付密码等信息是否已设置
	public function checkUserInfoExist(Request $request){
		$user_id=$request->param('user_id');
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if(!is_null($user_info)){
		    if($user_info['bank_card']==""||is_null($user_info['bank_card'])){
		        $this->success('请求成功',array('code'=>1));
		    }else{
		        $this->success('请求成功',array('code'=>0,'msg'=>'您的银行卡信息已设置，如需修改请联系客服'));
		    }
		    
			
		}else{
			$this->success('请求成功',array('code'=>1));
		}
	}
	
	
	//设置用户银行卡支付密码等信息
	public function setUserInfo(Request $request){
		$user_id=intval($request->param('user_id'));
		$bank_name=trim($request->param('bank_name'));
		$phone=trim($request->param('phone'));
		$bank_card=trim($request->param('bank_card'));
		$pay_password=trim($request->param('pay_password'));
		$shiming_name=trim($request->param('shiming_name'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		
		if(!is_null($user_info)){
			$is_update=true;
		}else{
		    $is_update=false;
		}
		
		if($bank_name==""){
			$this->error('请填写银行名称');
		}
		if($bank_card==""){
			$this->error('请填写银行卡号');
		}
		if($phone==""){
			$this->error('请输入绑定手机号');
		}
		if($pay_password==""){
			$this->error('请填写要设置的资金密码');
		}
		if($shiming_name==""){
			$this->error('请填写持卡人姓名');
		}
		$data=array(
			'user_id'=>$user_id,
			'bank_name'=>$bank_name,
			'bank_card'=>$bank_card,
			'phone'=>$phone,
			'pay_password'=>$pay_password,
			'shiming_name'=>$shiming_name,
			'updatetime'=>time(),
		);
		if($is_update){
		    $data=array(
    		
    			'bank_name'=>$bank_name,
    			'bank_card'=>$bank_card,
    			'phone'=>$phone,
    			'pay_password'=>$pay_password,
    			'shiming_name'=>$shiming_name,
    			'updatetime'=>time(),
    		);
		    $rs=Db::name('user_info')->where('user_id',$user_id)->update($data);
		}else{
		    $data=array(
    			'user_id'=>$user_id,
    			'bank_name'=>$bank_name,
    			'bank_card'=>$bank_card,
    			'phone'=>$phone,
    			'pay_password'=>$pay_password,
    			'shiming_name'=>$shiming_name,
    			'updatetime'=>time(),
    		);
		    $rs=Db::name('user_info')->insert($data);
		}
		
		if($rs>0){
			$this->success('请求成功',array('msg'=>'银行卡设置成功'));
		}else{
			$this->error('银行卡设置失败');
		}
	}
	
	//重置资金密码
	public function setPayPassword(Request $request){
		$user_id=intval($request->param('user_id'));
		$old_pay_password=trim($request->param('old_pay_password'));
		$new_pay_password=trim($request->param('new_pay_password'));
		$re_pay_password=trim($request->param('re_pay_password'));

		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if(is_null($user_info)){
			$this->error('用户信息不存在');
		}
		if($old_pay_password==""){
			$this->error('原密码为空');
		}
		if($new_pay_password==""){
			$this->error('新密码为空');
		}
		if($old_pay_password!=$user_info['pay_password']){
			$this->error('原密码不正确');
		}
		if($new_pay_password!=$re_pay_password){
			$this->error('新密码和确认密码不一致');
		}

		$data=array(
			'pay_password'=>$new_pay_password,
			'updatetime'=>time(),
		);
		$rs=Db::name('user_info')->where('user_id',$user_id)->update($data);
		if($rs>0){
			$this->success('请求成功',array('msg'=>'资金密码修改成功'));
		}else{
			$this->error('资金密码修改失败');
		}
	}
	
	//用户获取我的优惠券
	public function getMyCoupon(Request $request){
		$status=intval($request->param('status'));
		$user_id=intval($request->param('user_id'));
		$page=trim($request->param('page'));
		
		$where=array(
			'user_id'=>$user_id,
			'shenhe_status'=>1,
		);
		if($status>0){
			if($status==2){
				$where['huigou_status']=2;
			}else{
				$where['huigou_status']=['<>',2];
			}
		}
		
		$rs=Db::name('lingquan')->where($where)->alias('a')->join('quan b','a.quan_id=b.id')->field('a.id,a.quan_id,a.num,a.quan_name,a.huigou_status,b.percent,b.endtime')->paginate(10,false,['page'=>$page])->each(function($item, $key){
			$item['endtime'] =date('Y-m-d',$item['endtime']);
			
			return $item;
		});
        //$rs['sql'] =Db::getlastSql();
		$this->success('请求成功',$rs);	
	}
	
	//前台发起回购
	public function huigou(Request $request){	
		$lingquan_id=intval($request->param('lingquan_id'));
		$user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$where=array(
			'id'=>$lingquan_id,
			'user_id'=>$user_id,
			'shenhe_status'=>1,
			//'huigou_status'=>0,
		);
		
		$rs_lingquan=Db::name('lingquan')->where($where)->find();
		if(\is_null($rs_lingquan)){
			$this->error('领取优惠券ID错误,优惠券不存在');
		}else{
			if($rs_lingquan['huigou_status']==1){
				$this->error('该券正在回购审核中');
			}
			if($rs_lingquan['huigou_status']==2){
				$this->error('该券已被回购');
			}
			
			$rs=Db::name('lingquan')->where($where)->update(['huigou_status'=>1]);
			if($rs>0){
				$this->success('请求成功',array('msg'=>'出售申请成功'));
			}else{
				$this->error('出售申请失败');
			}
		}	
	}
	
	//后台通过回购
	public function action_huigou(Request $request){
		$id=intval($request->param('id'));
		$user_id=intval($request->param('user_id'));
		$quan_id=intval($request->param('quan_id'));		
		
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$quan = Db::name('quan')->where('id',$quan_id)->find();
		if(\is_null($quan)){
			$this->error('相关优惠券不存在');
		}
		
		//更改该条领取状态为已审核
		$rs=Db::name('lingquan')->where('id',$id)->update(['huigou_status'=>2]);
		if($rs>0){
			//修改用户money为券的价值加折扣率
			$price=$quan['price'];
			$percent=$quan['percent'];
			$price+=$price*($percent/100);
			Db::name('user')->where('id',$user_id)->setInc('money',$price);
			//写入资金流水
			$liushui_data=array(
				'use_id'=>$user_id,
				'user_name'=>$user['username'],
				'neirong'=>$user['username'].'于'.date('Y-m-d H:i:s',time()).'回购'.$price,
				'money'=>$price,
				'status'=>3,
				'createtime'=>time(),
			);
			Db::name('liushui')->insert($liushui_data);
			$this->success('回购审核成功');
		}else{
			$this->success('回购审核失败');
		}
		
	}
	
	public function getUserInfo(Request $request){
		$user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		$user['avatar']=input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME').$user['avatar'];
		$this->success('请求成功',$user);
	}
	
	public function getLiuShui(Request $request){
		$user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		$type=intval($request->param('type'));	//请求类型,0充值明细，1提现明细
		$page=intval($request->param('page'));
		switch($type){
			case 0:
				$rs=Db::name('chongzhi')->where('user_id',$user_id)->field('id,money,createtime,status,beizhu')->order('createtime desc')->paginate(10,false,['page'=>$page])->each(function($item, $key){
					$item['createtime'] =date('Y-m-d',$item['createtime']);
					
					return $item;
				});
			break;
			case 1:
				$rs=Db::name('tixian')->where('user_id',$user_id)->field('id,money,createtime,status,beizhu')->order('createtime desc')->paginate(10,false,['page'=>$page])->each(function($item, $key){
					$item['createtime'] =date('Y-m-d',$item['createtime']);
					
					return $item;
				});
			break;
			default:
				$this->error('请求类型错误');
			break;
		}
		$this->success('请求成功',$rs);
	}
	
	//仅获取客服链接
	public function getKefu(Request $request){
		$rs_kefu=Db::name('config')->where('name','kefu_url')->field('value')->find();
		$rs_kefu=$rs_kefu['value'];
		$result=array(
			'kefu'=>$rs_kefu,
		);
		
		$this->success('请求成功',$result);
	}
	
	//余额宝结算
	public function yuebao_jiesuan(Request $request){
		$config=Db::name('config')->where('name','yuebao')->field('name,value')->find();
		$rililv=floatval($config['value']);	//获取日利率
		$today_date=date('Y-m-d',time());
		$today_date_timestamp=strtotime($today_date);
		
		$count=Db::name('yuebao')->where('createtime',$today_date_timestamp)->count();
		
		if($count==0){  //判断今天的余额宝利息是否已经结算过了
			$rs_user=Db::name('user_info')->where(['yuebao_money'=>['>','0']])->select();	//查询余额大于0的用户
			//print_r($rs_user);
			foreach($rs_user as $k=>$v){
				$money=floatval($v['yuebao_money']);
				if(($money*$rililv/100)>0.01){	//利息至少有1分钱
					$money=($money*$rililv)/100;
					Db::name('user_info')->where('user_id',$v['user_id'])->setInc('yuebao_money',$money);
					$data=array(
						'user_id'=>$v['user_id'],
						'money'=>$money,
						'createtime'=>$today_date_timestamp,
					);
					Db::name('yuebao')->insert($data);
					
				}
			}
			$this->success('今天的余额宝利息结算成功');
		}else{
			$this->error('今天的余额宝利息已经结算');
		}	
	}
	
	//用户获取余额宝总收益
	public function user_yuebao_sum(Request $request){
		$user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$money_sum=Db::name('yuebao')->where('user_id',$user_id)->sum('money');
		
		$this->success('请求成功',array('sum'=>$money_sum));
	}
	
	//用户获取余额宝历史收益
	public function getShouyi(Request $request){
		$user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		
		if(\is_null($user)){
			$this->error('用户不存在');
		}

		$page=intval($request->param('page'));
		
		$rs=Db::name('yuebao')->where('user_id',$user_id)->field('id,money,createtime')->order('createtime desc')->paginate(10,false,['page'=>$page])->each(function($item, $key){
			$item['createtime'] =date('Y-m-d',$item['createtime']);
			
			return $item;
		});

		$this->success('请求成功',$rs);
	}
	
	//用户抢券不审核就过期
	public function guoqi_lingquan(Request $request){
		$config=Db::name('config')->where('name','quan_overtime')->field('name,value')->find();
		$quan_overtime=intval($config['value']);	//获取日利率
		$quan_overtime_second=$quan_overtime*60;
		$overtime=time()-$quan_overtime_second;		
		Db::startTrans();
		try {
			$where=array(
				'createtime'=>['<',$overtime],
				'shenhe_status'=>0,
			);
		    $result = Db::name('lingquan')->where($where)->update(['shenhe_status'=>2]);
		    Db::commit();
		} catch (ValidateException $e) {
		    Db::rollback();
		    $this->error($e->getMessage());
		} catch (PDOException $e) {
		    Db::rollback();
		    $this->error($e->getMessage());
		} catch (Exception $e) {
		    Db::rollback();
		    $this->error($e->getMessage());
		}
		$this->success('执行成功',$result);
	}
	
	//余额转入余额宝
    public function money_to_yuebao(Request $request){
        $user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if(\is_null($user_info)){
			$this->error('用户尚未绑定银行卡和支付密码');
		}
		
		$money=floatval($request->param('money'));
		
		if($money>floatval($user['money'])){
		    $this->error('转入余额宝的金额，不能大于账户余额');
		}
		Db::startTrans();
		$rs_1=Db::name('user')->where('id',$user_id)->setDec('money',$money);
		if($rs_1>0){
		    $rs_2=Db::name('user_info')->where('user_id',$user_id)->setInc('yuebao_money',$money);
		    if($rs_2>0){
		        Db::commit();
		        $this->success('请求成功',array('msg'=>'转入余额宝成功'));
		    }else{
		        Db::rollback();
		        $this->error('转入余额宝失败');
		    }
		}else{
		    Db::rollback();
		    $this->error('转入余额宝失败');
		}
		
    }
	
	//余额宝转入余额
    public function yuebao_to_money(Request $request){
        $user_id=intval($request->param('user_id'));
		if($user_id<=0){
			$this->error('用户ID错误');
		}
		$user=Db::name('user')->where('id',$user_id)->find();
		
		if(\is_null($user)){
			$this->error('用户不存在');
		}
		
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if(\is_null($user_info)){
			$this->error('用户尚未绑定银行卡和支付密码');
		}
		
		$money=floatval($request->param('money'));
		
		if($money>floatval($user_info['yuebao_money'])){
		    $this->error('转入余额的金额，不能大于余额宝余额');
		}
		Db::startTrans();
		$rs_1=Db::name('user')->where('id',$user_id)->setInc('money',$money);
		if($rs_1>0){
		    $rs_2=Db::name('user_info')->where('user_id',$user_id)->setDec('yuebao_money',$money);
		    if($rs_2>0){
		        Db::commit();
		        $this->success('请求成功',array('msg'=>'转入余额成功'));
		    }else{
		        Db::rollback();
		        $this->error('转入余额失败');
		    }
		}else{
		    Db::rollback();
		    $this->error('转入余额失败');
		}
    }
    
	
	public function listenRecharge(Request $request){
		$count=Db::name('chongzhi')->where('status',0)->count();
		if($count>0){
			$this->success('有新的充值');
		}else{
			$this->error('没有新的充值');
		}
		
	}
	
	public function listenCashout(Request $request){
		$count=Db::name('tixian')->where('status',0)->count();
		if($count>0){
			$this->success('有新的提现');
		}else{
			$this->error('没有新的提现');
		}
	}
	
	public function listenLingQuan(Request $request){
		$count=Db::name('lingquan')->where('shenhe_status',0)->count();
		if($count>0){
			$this->success('有新的领券');
		}else{
			$this->error('没有新的领券');
		}
	}
}
