<?php

namespace app\api\controller;
use app\admin\model\Category;

use app\common\controller\Api;
use think\Db;
use think\Request;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;
use think\Cache;
use app\common\model\Realname;
/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['index','curlfunS','getKefu','getZhishu','getZhishuAll','getZhishuDetail','getZhishuKline','getXingu','getGupiaoList','getGupiaoDetail','getGupiaoKline','jiaoyizhidu
		','newsDetail','getNews','Search','Guoyefei','getSystemBank','uploadImage','guanyuwomen'];
    protected $noNeedRight = ['*'];
// 	public $api_url = "http://www.ming666.top";


	public function curlfunS($url) {
		$ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, $url);

	    curl_setopt($ch, CURLOPT_POST, 1);

	    //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    //curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Referer: https://finance.sina.com.cn/nmetal/'));
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // https请求 不验证证书和hosts

	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

	    curl_setopt($ch, CURLOPT_HEADER, false);

	    //curl_setopt($ch, CURLOPT_USERAGENT, $agent);

	    $response = curl_exec($ch);
	    curl_close($ch);
	    return $response;

	}

	public function index(Request $request){
		$today_date=date("Y-m-d",strtotime("-1 day"));
		$rs=Db::name('xingu')->where('jiezhidate','=',$today_date)->select();
// 		var_dump($rs);
		$this->success('请求成功');
	}

	//获取客服链接和网站名称
	public function getKefu(Request $request){
		$rs_kefu=Db::name('config')->where('name','kefu_url')->field('value')->find();
		$rs_kefu=$rs_kefu['value'];
		$rs_name=Db::name('config')->where('name','name')->field('value')->find();
		$rs_name=$rs_name['value'];
		$result=array(
			'kefu'=>$rs_kefu,
			'webname'=>$rs_name,
		);

		$this->success('请求成功',$result);
	}
	public function getZhishu(Request $request){
		$rs_zhishu=Db::name('zhishu')->where('show_switch',1)->order('weigh desc')->limit(3)->select();

		$this->success('请求成功',$rs_zhishu);
	}
	public function getZhishuAll(Request $request){
		$rs_zhishu=Db::name('zhishu')->where('show_switch',1)->order('weigh desc')->select();

		$this->success('请求成功',$rs_zhishu);
	}

	public function getZhishuDetail(Request $request){
		$id=$request->param('id/d');
		$rs_zhishu=Db::name('zhishu')->where(['id'=>$id,'show_switch'=>1])->order('weigh desc')->find();
		if(\is_null($rs_zhishu)){
			$this->error('ID錯誤');
		}else{
			$this->success('请求成功',$rs_zhishu);
		}
	}

	public function getZhishuKline(Request $request)
	{

		$pro_id = $request->param('id/d');
		$interval = $request->param('interval');

		$pro = Db::name('zhishu')->where('id', $pro_id)->find();

		if (!is_null($pro)) {
            $pro_code = $pro['zimudaima'];
			$pro_code = strtoupper($pro_code);
			$now = time() . rand(100, 999);
			$pro_code = urlencode($pro['zimudaima']);
			$mkt = 10;
			if ($interval == "d") {
				$url = "https://tw.quote.finance.yahoo.net/quote/q?type=ta&perd={$interval}&mkt={$mkt}&sym={$pro_code}&v=1&callback=jQuery1113027458943139111947_1653625529920&_=1653625529921";
			} else {
				$url = "https://tw.quote.finance.yahoo.net/quote/q?type=ta&perd={$interval}m&mkt={$mkt}&sym={$pro_code}&v=1&callback=jQuery1113027458943139111947_1653625529920&_=1653625529921";
			}
			$getdata = file_get_contents($url);
			$getdata = ltrim($getdata, "jQuery1113027458943139111947_1653625529920(");
			$html = rtrim($getdata, ");");
			if (strlen($html) < 2) {
				return false;
			}
			$_data_arr = json_decode($html, 1);
			$_data_arr = $_data_arr['ta'];
			$result = array(
				'categories' => array(),
				'series' => array(array(
					'name' => $pro['name'],
					'data' => array(),
				)),
			);
			foreach ($_data_arr as $k => $v) {
				$result['categories'][$k] = $v['t'];
				$result['series'][0]['data'][$k] = array(floatval($v['o']),
					floatval($v['c']), floatval($v['l']),
					floatval($v['h']),
				);
			}
    				
			$this->success('请求成功', $result);
		}


	}

	//下订单
	public function addOrder(Request $request){
		if(!iskaipan()){
			$this->error('當前不在開盤時間');
		}
		$check_real_name = Db::name('realname')->where('user_id',$this->auth->id)->where('status','1')->find();
		if(!$check_real_name)$this->error('請先實名認證');
		
		$fangxiang=$request->param('fangxiang/s');
		$user_id=$request->param('user_id/d');
		$pro_id=$request->param('pro_id/d');
		$buy_type=$request->param('buytype/d');
		//判断是市价买入还是限价挂单;buy_type:0市价，1限价
		if($buy_type==0){	//市价买入
			$pro=Db::name('zhishu')->where('id',$pro_id)->find();
			$price=$pro['price'];
			$status=1;
		}else{	//限价挂单
			$pro=Db::name('zhishu')->where('id',$pro_id)->find();
			$price=$request->param('price/f');
			$pro['price']=floatval($pro['price']);
			if($fangxiang=='duo'){	//如果是多单
				if($price<$pro['price']){	//如果是低价挂多单，状态为挂单
					$status=4;
				}else{	//如果下单价格高于或等于当前价格，立即成交
					$price=$pro['price'];
					$status=1;
				}
			}else{	//如果是空单
				if($price>$pro['price']){	//如果是高价挂空单，状态为挂单
					$status=4;
				}else{	//如果下单价格低于或等于当前价格，立即成交
					$price=$pro['price'];
					$status=1;
				}
			}


		}
		$shuliang=$request->param('shuliang/d');
		$benjin=$price*$shuliang;
		//判断用户约够不够下单
		$user=Db::name('user')->where('id',$user_id)->find();
		if($user['money']<$benjin){
			$this->error('您的餘額不足，請充值');
		}
		$shizhi=$benjin;
		$buytime=time();
		Db::startTrans();
		try{
			$fangxiang_data=$fangxiang=='duo'?1:0;
			//计算手续费
			$shouxufeilv=floatval($this->site['shouxufeilv'])/100;
			$shouxufei=$benjin*$shouxufeilv;
			$shouxufei=$shouxufei>=20?$shouxufei:20;
			$shouxufei=-1*$shouxufei;
			//看是否已有同向的持仓，有则合并更新订单，无则新增订单。
			$rs_chicang=Db::name('zhishuchicang')->where(['pro_id'=>$pro_id,'user_id'=>$user_id,'status'=>1,'fangxiang_data'=>$fangxiang_data])->find();
			//if(is_null($rs_chicang)){
				$rs1=Db::name('zhishuchicang')->insert([
					'order_sn'=>getMillisecond(),
					'fangxiang_data'=>$fangxiang_data,
					'user_id'=>$user_id,
					'pro_id'=>$pro_id,
					'price'=>$price,
					'shuliang'=>$shuliang,
					'benjin'=>$benjin,
					'sxf_gyf'=>$shouxufei,
					'shizhi'=>$shizhi,
					'status'=>$status,
					'buytime'=>$buytime,
					'buy_type'=>$buy_type,
				]);
			/* }else{
				$new_price=($rs_chicang['price']*$rs_chicang['shuliang']+$price*$shuliang)/($rs_chicang['shuliang']+$shuliang);
				$rs1=Db::name('zhishuchicang')->where('id',$rs_chicang['id'])->update([
					'price'=>$new_price,
					'shuliang'=>$shuliang+$rs_chicang['shuliang'],
					'benjin'=>$rs_chicang['benjin']+$benjin,
					'shizhi'=>$rs_chicang['shizhi']+$shizhi,
				]);
			} */


			if($rs1>0){
				 $rs2=Db::name('user')->where('id',$user_id)->setDec('money',$benjin);
				 if($rs2>0){
				     Db::name('user_money_log')->insert([
					    'user_id'=>$user_id,
					    'money' => $benjin,
					    'memo' => '下單成功',
					    'createtime' => time(),
					]);
					// 提交事务
					Db::commit();
					$this->success('请求成功',array('msg'=>'下單成功'));
				 }else{
					Db::rollback();
					$this->error('下單失敗1');
				 }
			}else{
				Db::rollback();
				$this->error('下單失敗2');
			}


		}catch (PDOException $e) {
			Db::rollback();
			$this->error($e->getMessage());
		} catch (Exception $e) {
			Db::rollback();
			$this->error($e->getMessage());
		}

	}

	public function getGupiaoList(Request $request){
	    $classify_id = $request->param('classify_id');
	    
	    $map = [];
	    if(!empty($classify_id)){
	        $map['id'] = ['=',$classify_id];
	    }else{
	        $result=array(
			'shangshi'=>[],
			'shanggui'=>[],
		    );
		    $this->success('请求成功',$result);
	    }
	    
		$cagetory_shangshi=Db::name('category')->where(['pid'=>1,'status'=>'normal'])->where($map)->field('id')->select();
		$arr_shangshi=array();
		foreach($cagetory_shangshi as $v){
			$arr_shangshi[]=$v['id'];
		}
		$rs_shangshi=Db::name('product')->where(['show_switch'=>1,'category_id'=>['in',$arr_shangshi]])->order('weigh desc')->select();

		$cagetory_shanggui=Db::name('category')->where(['pid'=>2,'status'=>'normal'])->field('id')->where($map)->select();
		$arr_shanggui=array();
		foreach($cagetory_shanggui as $v){
			$arr_shanggui[]=$v['id'];
		}
		$rs_shanggui=Db::name('product')->where(['show_switch'=>1,'category_id'=>['in',$arr_shanggui]])->order('weigh desc')->select();

		$result=array(
			'shangshi'=>$rs_shangshi,
			'shanggui'=>$rs_shanggui,
		);

		$this->success('请求成功',$result);
	}

	public function getXingu(Request $request){
		$rs=Db::name('xingu')->order('status ASC')->select();
		foreach($rs as $k=>$v){
			$rs[$k]['baifenbi']=$v['yishengou']/$v['zongshengou']*100;
			$rs[$k]['baifenshu']=intval($rs[$k]['baifenbi']);
			$rs[$k]['baifenbi']=sprintf("%.2f",$rs[$k]['baifenbi']).'%';
			$rs[$k]['chajia']=sprintf("%.2f",($v['shijia']-$v['chengxiaojia']));
			$rs[$k]['yijiacha']=($v['shijia']-$v['chengxiaojia'])/$v['chengxiaojia']*100;
			if((int)$v['shijia'] > 0){
		    	$rs[$k]['yijiacha']=sprintf("%.2f",$rs[$k]['yijiacha']).'%';
			    $rs[$k]['yijiacha_val']=round(sprintf("%.2f",$rs[$k]['yijiacha']),2);
			}else{
			    $rs[$k]['yijiacha']= '0.00%';
			    $rs[$k]['yijiacha_val']= 0.00;
			}
		}
		$this->success('请求成功',$rs);
	}

	public function getZixuan(Request $request){
		$user_id=$this->auth->id;
		$rs=Db::name('zixuan')->where('user_id',$user_id)->order('updatetime desc,id desc')->select();
		foreach($rs as $k=>$v){
			$rs[$k]['product']=Db::name('product')->where('id',$v['pro_id'])->find();
		}
		$this->success('请求成功',$rs);
	}

	public function getXinguDetail(Request $request){
		$id=$request->param('id');
		$rs=Db::name('xingu')->where('id',$id)->find();
		$rs['baifenbi']=$rs['yishengou']/$rs['zongshengou']*100;
		$rs['baifenshu']=intval($rs['baifenbi']);
		$rs['baifenbi']=sprintf("%.2f",$rs['baifenbi']).'%';
		$rs['chajia']=sprintf("%.2f",($rs['shijia']-$rs['chengxiaojia']));
		$rs['yijiacha']=($rs['shijia']-$rs['chengxiaojia'])/$rs['chengxiaojia']*100;
        if((int)$rs['shijia'] > 0){
		    $rs['yijiacha']=sprintf("%.2f",$rs['yijiacha']).'%';
			   $rs['yijiacha_val']=round(sprintf("%.2f",$rs['yijiacha']),2);
		}else{
		    $rs['yijiacha']= '0.00%';
		    $rs['yijiacha_val']= 0.00;
		}
		

		$this->success('请求成功',$rs);
	}

	public function shengouXingu(Request $request){
		$id=$request->param('id');
		$shuliang=$request->param('shuliang/d');
		$user_id=$this->auth->id;


		$check_real_name = Db::name('realname')->where('user_id',$this->auth->id)->where('status','1')->find();
		if(!$check_real_name)$this->error('請先實名認證');

		$rs_xingu=Db::name('xingu')->where('id',$id)->find();
		$today_date=date('Y-m-d',time());
		if($rs_xingu['status']=='2'){
			$this->error('已停止申購');
		}
		if($today_date>$rs_xingu['jiezhidate'] || $today_date<$rs_xingu['kaifangdate']){
			$this->error('不在申購期間');
		}
		if(($rs_xingu['zongshengou']-$rs_xingu['yishengou'])<$shuliang){
			$this->error('申購的數量大於剩餘發行數');
		}
        $shuliang = $shuliang*1000;
		$money=$shuliang*$rs_xingu['chengxiaojia'];
		
		$user=Db::name('user')->where('id',$user_id)->find();
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if($money>$user['money']){
			$this->error('您的餘額不足以申購');
		}
		$rs_xingushengou=Db::name('xingushengou')->where(['user_id'=>$user_id,'pro_id'=>$id])->find();
		Db::startTrans();
		try{
			if(is_null($rs_xingushengou)){
				$rs1=Db::name('xingushengou')->insert([
					'order_sn'=>getMillisecond(),
					'user_parent_id'=>$user_info['parent_id'],
					'user_id'=>$user_id,
					'pro_id'=>$rs_xingu['id'],
					'price'=>$rs_xingu['chengxiaojia'],
					'shengoushuliang'=>$shuliang/1000,
					'xurenjiao'=>$money,
					'yingrenjiao'=>$money,
					'yirenjiao'=>$money,
					'renjiaocishu'=>1,
					'createtime'=>time(),
				]);
			}else{
				$rs1=Db::name('xingushengou')->where('id',$rs_xingushengou['id'])->setInc('shengoushuliang',$shuliang);
				Db::name('xingushengou')->where('id',$rs_xingushengou['id'])->setInc('xurenjiao',$money);
				Db::name('xingushengou')->where('id',$rs_xingushengou['id'])->setInc('yingrenjiao',$money);
				Db::name('xingushengou')->where('id',$rs_xingushengou['id'])->setInc('yirenjiao',$money);
				Db::name('xingushengou')->where('id',$rs_xingushengou['id'])->setInc('renjiaocishu');
			}
			if($rs1){
				$rs2=Db::name('user')->where('id',$user_id)->setDec('money',$money);
				Db::name('user_money_log')->insert([
					    'user_id'=>$user_id,
					    'money' => $money,
					    'memo' => '申購新股',
					    'createtime' => time(),
					]);
			}
			if($rs1 && $rs2){
				Db::name('xingu')->where('id',$id)->setInc('yishengou',($shuliang/1000));
				Db::commit();
				$this->success('请求成功',array('msg'=>'申購成功'));
			}else{
				$this->error('申購失敗');
			}

		}catch (PDOException $e) {
			Db::rollback();
			$this->error($e->getMessage());
		} catch (Exception $e) {
			Db::rollback();
			$this->error($e->getMessage());
		}
	}

	public function getGupiaoDetail(Request $request){
		$id=$request->param('id/d');
		$rs_gupiao=Db::name('product')->where(['id'=>$id,'show_switch'=>1])->find();
		if(is_null($rs_gupiao)){
			$this->error('ID錯誤');
		}else{
		    $rs_gupiao['price'] = round($rs_gupiao['price'],2);
		    $rs_gupiao['fwfv'] = config('site.gupiao_fwf')/100;
			$this->success('请求成功',$rs_gupiao);
		}
	}
	public function getSonCate(){
		$list = Category::where(['pid'=>$this->request->get('cate_id')])->select();
		$this->success("",$list);
	}
	
	public function getGupiaoKline(Request $request){
        
        function format_ErrorJson($data,$quotes_key=false)
        {
            $con = str_replace('\'', '"', $data);//替换单引号为双引号
            $con = str_replace(array('\\"'), array('<|YH|>'), $con);//替换
            $con = preg_replace('/(\w+):[ {]?((?<YinHao>"?).*?\k<YinHao>[,}]?)/is', '"$1": $2', $con);//若键名没有双引号则添加
            if ($quotes_key) {
                $con = preg_replace('/("\w+"): ?([^"\s]+)([,}])[\s]?/is', '$1: "$2"$3', $con);//给键值添加双引号
            }
            $con = str_replace(array('<|YH|>'), array('\\"'), $con);//还原替换
            return $con;
        }
        
        function get_between($begin,$str,$is_qian=false) {
 
            $str = strstr ( $str ,  $begin, $is_qian);
            return $str;
         
        }

		$pro_id=$request->param('id/d');
		$interval=$request->param('interval');

		$pro=Db::name('product')->where('id',$pro_id)->find();

		if(!is_null($pro)){
			$pro_code=$pro['shuzidaima'];
			$pro_code=strtoupper($pro_code);
			$now=time().rand(100,999);

			$pro_code = urlencode($pro['shuzidaima']);
			$mkt = 10;
			$call_back = "jQuery1113015848741396700183_{$now}";
			if ($interval == "d") {
				$url = "https://tw.quote.finance.yahoo.net/quote/q?type=ta&perd={$interval}&mkt={$mkt}&sym={$pro_code}&v=1&callback=$call_back&_={$now}";
			} else {
				$url = "https://tw.quote.finance.yahoo.net/quote/q?type=ta&perd={$interval}m&mkt={$mkt}&sym={$pro_code}&v=1&callback=$call_back&_={$now}";
			}
			$getdata = file_get_contents($url);
// 			echo $getdata;die;
			$getdata = ltrim($getdata, "$call_back(");
			$getdata = str_replace("$call_back(","",$getdata);
			$getdata = str_replace(");","",$getdata);
			$getdata = trim($getdata);
			if (strlen($getdata) < 2) {
				return false;
			}
// 			$html = iconv('gbk',  'utf8',  $html);
// 			$html = stripslashes(html_entity_decode($html)); 
// 			$html= trim($html,chr(239).chr(187).chr(191));
// 			$jsonArr = str_replace("'",  '"',  $html);
// 			var_dump($getdata);die;
            //$info是传递过来的json字符串
            $getdata = preg_replace('/,s*([]}])/m', '$1', $getdata);
            $getdata = str_replace("'",  '"',  $getdata);
            $jsonString = strstr($getdata, '"ta":');
            $jsonString = ltrim($jsonString, '"ta":');
            if($interval == "d"){
                $jsonString = strstr($jsonString,',"ex":',true);
            }else{
                $jsonString = rtrim($jsonString, '}');
            }
            // $jsonString = ltrim($jsonString, '"ta":');
            // echo $jsonString;die;
            $_data_arr = json_decode($jsonString,true);
            if(empty($_data_arr)){
                return;
            }
			$result = array(
				'categories' => array(),
				'series' => array(array(
					'name' => $pro['name'],
					'data' => array(),
				)),
			);

			foreach ($_data_arr as $k => $v) {
			    if(is_array($v)){
			        if(empty($v['t'])){
			            $v['t'] = $v['TradeDay'];
			        }
    				$result['categories'][$k]= $v['t'];
    				$result['series'][0]['data'][$k] = array(floatval($v['o']),
    					floatval($v['c']), floatval($v['l']),
    					floatval($v['h']),
    
    				);
			    }
			}
			
			$this->success('请求成功', $result);

		}

	}

	public function isZixuan(Request $request){
		$pro_id=$request->param('id/d');
		$user_id=$this->auth->id;
		$zixuan=Db::name('zixuan')->where(['user_id'=>$user_id,'pro_id'=>$pro_id])->find();
		if(!is_null($zixuan)){
			$msg='yes';
		}else{
			$msg='no';
		}
		$this->success('请求成功',['msg'=>$msg]);
	}

	public function addZixuan(Request $request){
		$check_real_name = Db::name('realname')->where('user_id',$this->auth->id)->where('status','1')->find();
		if(!$check_real_name)$this->error('請先實名認證');
		
		$pro_id=$request->param('id/d');
		$user_id=$this->auth->id;
		$zixuan=Db::name('zixuan')->where(['user_id'=>$user_id,'pro_id'=>$pro_id])->find();
		if(is_null($zixuan)){
			$rs=Db::name('zixuan')->insert(['user_id'=>$user_id,'pro_id'=>$pro_id,'updatetime'=>time()]);
			$action='addsuccess';
			$msg='自選股添加成功';
		}else{
			$rs=Db::name('zixuan')->where(['id'=>$zixuan['id']])->delete();
			$action='cancelsuccess';
			$msg='取消自選股';
		}
		if($rs>0){
			$this->success('请求成功',['msg'=>$msg,'action'=>$action]);
		}else{

		}
	}

	public function buyGupiao(Request $request){
		if(!iskaipan()){
			$this->error('當前不在開盤時間');
		}

		$check_real_name = Db::name('realname')->where('user_id',$this->auth->id)->where('status','1')->find();
		if(!$check_real_name)$this->error('請先實名認證');
		
		$pro_id=$request->param('pro_id/d');
		$user_id=$this->auth->id;
		$fangxiang=$request->param('fangxiang/s');
		$buy_type=$request->param('buytype/d');
		//判断是市价买入还是限价挂单;buy_type:0市价，1限价

		if($buy_type==0){	//市价买入
			$pro=Db::name('product')->where('id',$pro_id)->find();
			$price=$pro['price'];
			$status=1;
		}else{	//限价挂单
			$pro=Db::name('product')->where('id',$pro_id)->find();
			$price=$request->param('price/f');
			$pro['price']=floatval($pro['price']);
			if($fangxiang=='duo'){	//如果是多单
				if($price<$pro['price']){	//如果是低价挂多单，状态为挂单
					$status=4;
				}else{	//如果下单价格高于或等于当前价格，立即成交
					$price=$pro['price'];
					$status=1;
				}
			}else{	//如果是空单
				if($price>$pro['price']){	//如果是高价挂空单，状态为挂单
					$status=4;
				}else{	//如果下单价格低于或等于当前价格，立即成交
					$price=$pro['price'];
					$status=1;
				}
			}


		}
		$shuliang=$request->param('shuliang/d');
		$shuliang = $shuliang*1000;
		$benjin=$price*$shuliang;
		
		
		$sxf = $benjin*config('site.gupiao_fwf')/100;
		$count_price = round($benjin+$sxf,2);
		//判断用户约够不够下单
		$user=Db::name('user')->where('id',$user_id)->find();
		if($user['money']<$count_price){
			$this->error('您的餘額不足'.$count_price.'，請充值');
		}
		$shizhi=$benjin;
		$buytime=time();
		Db::startTrans();
		try{
			$fangxiang_data=$fangxiang=='duo'?1:0;
			//计算手续费
			$shouxufeilv=floatval($this->site['shouxufeilv'])/100;
			$shouxufei=$benjin*$shouxufeilv;
			$shouxufei=$shouxufei>=20?$shouxufei:20;
			$shouxufei=-1*$shouxufei;
			//看是否已有同向的持仓，有则合并更新订单，无则新增订单。
			$rs_chicang=Db::name('chicang')->where(['pro_id'=>$pro_id,'user_id'=>$user_id,'status'=>1,'fangxiang_data'=>$fangxiang_data])->find();
			//if(is_null($rs_chicang)){
				$rs1=Db::name('chicang')->insert([
					'order_sn'=>getMillisecond(),
					'fangxiang_data'=>$fangxiang_data,
					'user_id'=>$user_id,
					'pro_id'=>$pro_id,
					'price'=>$price,
					'shuliang'=>$shuliang,
					'benjin'=>$benjin,
					'sxf_gyf'=>$shouxufei,
					'shizhi'=>$shizhi,
					'status'=>$status,
					'buytime'=>$buytime,
					'buy_type'=>$buy_type,
				]);
			/* }else{
				$new_price=($rs_chicang['price']*$rs_chicang['shuliang']+$price*$shuliang)/($rs_chicang['shuliang']+$shuliang);
				$rs1=Db::name('chicang')->where('id',$rs_chicang['id'])->update([
					'price'=>$new_price,
					'shuliang'=>$shuliang+$rs_chicang['shuliang'],
					'benjin'=>$rs_chicang['benjin']+$benjin,
					'shizhi'=>$rs_chicang['shizhi']+$shizhi,
				]);
			} */


			if($rs1>0){
				 $rs2=Db::name('user')->where('id',$user_id)->setDec('money',$benjin);
				 if($rs2>0){
				    Db::name('user_money_log')->insert([
					    'user_id'=>$user_id,
					    'money' => $benjin,
					    'memo' => '股票買入',
					    'createtime' => time(),
					]);
				    $rs3=Db::name('user')->where('id',$user_id)->setDec('money',$sxf);
				    Db::name('user_money_log')->insert([
					    'user_id'=>$user_id,
					    'money' => $sxf,
					    'memo' => '購買股票手續費',
					    'createtime' => time(),
					]);
					// 提交事务
					Db::commit();
					$this->success('请求成功',array('msg'=>'下單成功'));
				 }else{
					Db::rollback();
					$this->error('下單失敗1');
				 }
			}else{
				Db::rollback();
				$this->error('下單失敗2');
			}


		}catch (PDOException $e) {
			Db::rollback();
			$this->error($e->getMessage());
		} catch (Exception $e) {
			Db::rollback();
			$this->error($e->getMessage());
		}
	}

	//提现页面获取用户余额、银行卡
	public function withdrawal(Request $request){
		//用户的余额
		$user_id=$this->auth->id;
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
		$user_bankcard=Db::name('user_bankcard')->where('user_id',$user_id)->find();

		$result=array(
			'money'=>$user['money'],
			'user_info'=>$user_info,
			'user_bankcard'=>$user_bankcard,
		);
		$this->success('请求成功',$result);
	}

	//重置资金密码
	public function setPayPassword(Request $request){
		$user_id=$this->auth->id;
		$old_pay_password=trim($request->param('old_pay_password'));
		$new_pay_password=trim($request->param('new_pay_password'));
		$re_pay_password=trim($request->param('re_pay_password'));


		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if(is_null($user_info)){
			$this->error('用戶信息不存在');
		}
		if($old_pay_password==""){
			$this->error('原密碼為空');
		}
		if($new_pay_password==""){
			$this->error('新密碼為空');
		}
		if($old_pay_password!=$user_info['paypassword']){
			$this->error('原密碼不正確');
		}
		if($new_pay_password!=$re_pay_password){
			$this->error('新密碼和確認密碼不一致');
		}

		$data=array(
			'paypassword'=>$new_pay_password,
		);
		$rs=Db::name('user_info')->where('user_id',$user_id)->update($data);
		if($rs>0){
			$this->success('请求成功',array('msg'=>'資金密碼修改成功'));
		}else{
			$this->error('資金密碼修改失敗');
		}
	}
	
	
	//重置登录密码
	public function setLoginPassword(Request $request){
		$user_id=$this->auth->id;
		$old_pay_password=trim($request->param('old_pay_password'));
		$new_pay_password=trim($request->param('new_pay_password'));
		$re_pay_password=trim($request->param('re_pay_password'));


		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if(is_null($user_info)){
			$this->error('用戶信息不存在');
		}
		if($old_pay_password==""){
			$this->error('原密碼為空');
		}
		if($new_pay_password==""){
			$this->error('新密碼為空');
		}
		if($new_pay_password!=$re_pay_password){
			$this->error('新密碼和確認密碼不一致');
		}
        $newpassword = $new_pay_password;
		$ret = $this->auth->changepwd($newpassword, $old_pay_password);
		if($ret){
			$this->success('请求成功',array('msg'=>'密碼修改成功'));
		}else{
			$this->error('密碼修改失敗');
		}
	}

	public function jiaoyizhidu(){
		$rs=Db::name('config')->where('name','jiaoyizhidu')->find();
		$this->success('请求成功',$rs);
	}

	public function guanyuwomen(){
		$rs=Db::name('config')->where('name','guanyuwomen')->find();
		$this->success('请求成功',$rs);
	}

	public function getNews(){
		$rs=Db::name('news')->field('id,title,updatetime,image')->order('updatetime desc,id desc')->limit(20)->select();
		foreach($rs as $k=>$v){
			$rs[$k]['image']=input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME').$v['image'];
		}
		$this->success('请求成功',$rs);
	}

	public function newsDetail(Request $request){
		$id=$request->param('id/d');
		$rs=Db::name('news')->where('id',$id)->find();
		if(is_null($rs)){
			$this->error('ID错误');
		}
		//$rs['content']=str_replace('src="','src="'.input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME'),$rs['content']);
		$this->success('请求成功',$rs);
	}

	public function Search(Request $request){
		$code=trim($request->param('code/s'));
		$rs=Db::name('product')->where('shuzidaima',$code)->find();
		if(!is_null($rs)){
			$this->success('请求成功',['code'=>1,'result'=>$rs]);
		}else{
			$this->success('请求成功',['code'=>0,'msg'=>'未搜索到結果']);
		}
	}

	public function GetPankou(Request $request){
		$id=trim($request->param('id/d'));
		$rs=Db::name('pankou')->where('product_id',$id)->find();
		if(!is_null($rs)){
			$this->success('请求成功',$rs);
		}else{
			$this->error('ID錯誤');
		}
	}

	//添加计划任务访问，日终处理半夜5点
	public function Guoyefei(Request $request){
		$today=date("Y-m-d");
		$rs=Db::name('guoyefei_log')->where('action_date','=',$today)->find();
		$guoyefeilv=floatval($this->site['guoyefeilv'])/100;
		if(is_null($rs)){
			$gupiao=Db::name('chicang')->where('status',1)->select();
			if(!empty($gupiao)){
				foreach($gupiao as $k=>$v){
					$gyf=$v['benjin']*$guoyefeilv;
					Db::startTrans();
					try{
						$rs1=Db::name('chicang')->where('id',$v['id'])->setDec('sxf_gyf',$gyf);
						if($rs1>0){
							$rs2=Db::name('goyefei')->insert([
								'user_id'=>$v['user_id'],
								'type_id'=>1,
								'order_id'=>$v['id'],
								'money'=>$gyf,
								'createtime'=>time(),
							]);
						}
						if($rs1 && $rs2){
							Db::commit();
						}else{
							Db::rollback();
						}

					}catch (PDOException $e) {
						Db::rollback();
						$this->error($e->getMessage());
					} catch (Exception $e) {
						Db::rollback();
						$this->error($e->getMessage());
					}

				}
			}

			$zhishu=Db::name('zhishuchicang')->where('status',1)->select();
			if(!empty($zhishu)){
				foreach($zhishu as $k=>$v){
					$gyf=$v['benjin']*$guoyefeilv;
					Db::startTrans();
					try{
						$rs1=Db::name('zhishuchicang')->where('id',$v['id'])->setDec('sxf_gyf',$gyf);
						if($rs1>0){
							$rs2=Db::name('goyefei')->insert([
								'user_id'=>$v['user_id'],
								'type_id'=>0,
								'order_id'=>$v['id'],
								'money'=>$gyf,
								'createtime'=>time(),
							]);
						}
						if($rs1 && $rs2){
							Db::commit();
						}else{
							Db::rollback();
						}

					}catch (PDOException $e) {
						Db::rollback();
						$this->error($e->getMessage());
					} catch (Exception $e) {
						Db::rollback();
						$this->error($e->getMessage());
					}

				}
			}
			Db::name('guoyefei_log')->insert([
				'action_date'=>$today,
				'updatetime'=>time(),
			]);
			Db::name('zhishuchicang')->where('status',4)->delete();
			Db::name('chicang')->where('status',4)->delete();

			$today_date=date("Y-m-d",strtotime("-1 day"));
			$rs_xingu=Db::name('xingu')->where('jiezhidate','=',$today_date)->select();
			foreach($rs_xingu as $v){
				$xingu_id=$v['id'];
				//返还申购未中签的资金
				$rs_shengou=Db::name('xingushengou')->where('pro_id',$xingu_id)->select();
				foreach($rs_shengou as $k_shengou => $v_shengou){
					$fanhuan_money=($v_shengou['shengoushuliang']-$v_shengou['zhongqianshu'])*$v_shengou['price'];
					Db::name('user')->where('id',$v_shengou['user_id'])->setInc('money',$fanhuan_money);
					
				    Db::name('user_money_log')->insert([
					    'user_id'=>$v_shengou['user_id'],
					    'money' => $fanhuan_money,
					    'memo' => '返還申購未中簽的資金',
					    'createtime' => time(),
					]);
				}
			}

			Db::name('xingu')->where('jiezhidate','=',$today_date)->update(['status'=>2]);	//截止申购
			Db::name('xingu')->where('kaifangdate','=',$today_date)->update(['status'=>1]);	//开始申购
			$rs_xingu=Db::name('xingu')->where('chouqiandate','=',$today_date)->select();	//抽签，中签的申购订单，状态变为已中签
			foreach($rs_xingu as $v){
				$xingu_id=$v['id'];
				//返还申购未中签的资金
				$rs_shengou=Db::name('xingushengou')->where('pro_id',$xingu_id)->select();
				foreach($rs_shengou as $k_shengou => $v_shengou){
					if($v_shengou['zhongqianshu']>0){
						Db::name('xingushengou')->where('id',$v_shengou['id'])->update(['status'=>1]);
					}else{
						Db::name('xingushengou')->where('id',$v_shengou['id'])->update(['status'=>2]);
					}
				}
			}

			//到发券日期的新股，上市到产品列表里去，申购中签的新股变为持仓
			$ipo=Db::name('xingu')->where('faquan_date','=',$today_date)->select();
			foreach($ipo as $k=>$v){
				$parent_category=$v['shichanglist'];
				$category=Db::name('category')->where('pid',$parent_category)->orderRaw('rand()')->find();
				$data=array(
					'category_id'=>$category['id'],
					'name'=>$v['name'],
					'zimudaima'=>$v['zimudaima'],
					'shuzidaima'=>$v['shuzidaima'],
					'price'=>$v['chengxiaojia'],
					'show_switch'=>1,
				);
				$pro_id=Db::name('product')->insert($data);

				$chicang_data=array();
				$rs_shengou=Db::name('xingushengou')->where(['pro_id'=>$v['id'],'status'=>1])->select();
				$shouxufeilv=floatval($this->site['shouxufeilv'])/100;

				foreach($rs_shengou as $k=>$v){
					$benjin=$v['price']*$v['zhongqianshu']=
					$shouxufei=$benjin*$shouxufeilv;
					$shouxufei=$shouxufei>=20?$shouxufei:20;
					$shouxufei=-1*$shouxufei;

					$data=array(
						'order_sn'=>getMillisecond(),
						'fangxiang_data'=>1,
						'user_id'=>$v['	user_id'],
						'pro_id'=>$pro_id,
						'price'=>$v['price'],
						'shuliang'=>$v['zhongqianshu'],
						'benjin'=>$benjin,
						'sxf_gyf'=>$shouxufei,
						'shizhi'=>$benjin,
						'status'=>1,
						'buy_type'=>1,
						'buytime'=>time(),
					);
					$chicang_data[$k]=$data;
				}

				Db::name('chicang')->insertAll($chicang_data);
			}


			$this->success('今天处理完成');
		}else{
			$this->error('今天已处理过了');
		}
	}

	public function getLiuShui(Request $request){
		$user_id=$this->auth->id;
		$type=intval($request->param('type'));	//请求类型,0充值明细，1提现明细,2过夜费明细
		$page=intval($request->param('page'));
		switch($type){
			case 1:
				$rs=Db::name('chongzhi')->where('user_id',$user_id)->field('id,money,createtime,status')->order('createtime desc')->paginate(10,false,['page'=>$page])->each(function($item, $key){
					$item['createtime'] =date('Y-m-d',$item['createtime']);

					return $item;
				});
			break;
			case 2:
				$rs=Db::name('tixian')->where('user_id',$user_id)->field('id,money,createtime,status')->order('createtime desc')->paginate(10,false,['page'=>$page])->each(function($item, $key){
					$item['createtime'] =date('Y-m-d',$item['createtime']);

					return $item;
				});
			break;
			case 0:
				$rs=Db::name('goyefei')->where('user_id',$user_id)->order('createtime desc')->paginate(10,false,['page'=>$page])->each(function($item, $key){
					$item['createtime'] =date('Y-m-d',$item['createtime']);
					if($item['type_id']==0){
						$item['order']=Db::name('zhishuchicang')->where('id',$item['order_id'])->find();
						$item['product']=Db::name('zhishu')->where('id',$item['order']['pro_id'])->find();
					}else{
						$item['order']=Db::name('chicang')->where('id',$item['order_id'])->find();
						$item['product']=Db::name('product')->where('id',$item['order']['pro_id'])->find();
					}

					return $item;
				});
			break;
			case 3:
			    $rs = Db::name('user_money_log')->where('user_id',$user_id)->order('createtime desc')->paginate(10,false,['page'=>$page])->each(function($item, $key){
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

	public function getJiaoyi(Request $request){
		$user_id=$this->auth->id;
		$type=intval($request->param('type'));	//请求类型,0充值明细，1提现明细,2过夜费明细
		$page=intval($request->param('page'));
		switch($type){
			case 0:

				$rs=Db::name('xingushengou')->where('user_id',$user_id)->order('createtime desc')->select();
				$status_arr=['0'=>'申購中','1'=>'已中籤','2'=>'未中籤'];
				foreach($rs as $k=>$v){
                    $rs[$k]['shengoushuliang'] = $rs[$k]['shengoushuliang']/1000;
                    $rs[$k]['zhongqianshu'] = $rs[$k]['zhongqianshu']/1000;
					$rs[$k]['createtime'] =date('Y-m-d',$v['createtime']);
					$rs[$k]['product'] =Db::name('xingu')->where('id',$v['pro_id'])->find();
					$rs[$k]['status'] =$status_arr[$v['status']];
				}

			break;
			case 1:
				$rs=Db::name('chicang')->where(['user_id'=>$user_id,'status'=>1])->order('buytime desc')->select();
				foreach($rs as $k=>$v){
					$rs[$k]['product'] =Db::name('product')->where('id',$v['pro_id'])->find();
					$rs[$k]['yisun']=($v['yingkui']+$v['sxf_gyf'])/$v['benjin']*100;
					$rs[$k]['yisun']=sprintf("%.2f",$rs[$k]['yisun']).'%';
					$rs[$k]['yingkui']=$v['yingkui']+$v['sxf_gyf'];
					$rs[$k]['type']=1;
					$rs[$k]['shizhi'] = round($rs[$k]['shizhi'],2);
				}
				$rs2=Db::name('zhishuchicang')->where(['user_id'=>$user_id,'status'=>1])->order('buytime desc')->select();
				foreach($rs2 as $k=>$v){
					$rs2[$k]['product'] =Db::name('zhishu')->where('id',$v['pro_id'])->find();
					$rs2[$k]['yisun']=($v['yingkui']+$v['sxf_gyf'])/$v['benjin']*100;
					$rs2[$k]['yisun']=sprintf("%.2f",$rs[$k]['yisun']).'%';
					$rs2[$k]['yingkui']=$v['yingkui']+$v['sxf_gyf'];
					$rs2[$k]['type']=0;
					$rs[$k]['shizhi'] = round($rs[$k]['shizhi'],2);
				}
				$rs=array_merge($rs,$rs2);
			break;
			case 2:
				$rs=Db::name('chicang')->where(['user_id'=>$user_id,'status'=>2])->order('buytime desc')->select();
				foreach($rs as $k=>$v){
					$rs[$k]['product'] =Db::name('product')->where('id',$v['pro_id'])->find();
					$rs[$k]['yisun']=($v['yingkui']+$v['sxf_gyf'])/$v['benjin']*100;
					$rs[$k]['yisun']=sprintf("%.2f",$rs[$k]['yisun']).'%';
					$rs[$k]['yingkui']=$v['yingkui']+$v['sxf_gyf'];
					$rs[$k]['type']=1;
				}
				$rs2=Db::name('zhishuchicang')->where(['user_id'=>$user_id,'status'=>2])->order('buytime desc')->select();
				foreach($rs2 as $k=>$v){
					$rs2[$k]['product'] =Db::name('zhishu')->where('id',$v['pro_id'])->find();
					$rs2[$k]['yisun']=($v['yingkui']+$v['sxf_gyf'])/$v['benjin']*100;
					$rs2[$k]['yisun']=sprintf("%.2f",$rs[$k]['yisun']).'%';
					$rs2[$k]['yingkui']=$v['yingkui']+$v['sxf_gyf'];
					$rs2[$k]['type']=0;
				}
				$rs=array_merge($rs,$rs2);
			break;
			default:
				$this->error('请求类型错误');
			break;
		}
		$this->success('请求成功',$rs);
	}

	public function getOrderDetail(Request $request){
		$id=$request->param('id/d');
		$type=$request->param('type/d');
		$user_id=$this->auth->id;
		$status_arr=array('1'=>'持仓中','2'=>'已平仓','3'=>'平仓中','4'=>'挂单中','5'=>'已撤单');
		if($type==1){
			$rs=Db::name('chicang')->where(['user_id'=>$user_id,'id'=>$id])->find();
			$rs['product']=Db::name('product')->where('id',$rs['pro_id'])->find();
		}else{
			$rs=Db::name('zhishuchicang')->where(['user_id'=>$user_id,'id'=>$id])->find();
			$rs['product']=Db::name('zhishu')->where('id',$rs['pro_id'])->find();
		}
		$rs['status_str']=$status_arr[$rs['status']];
		$this->success('请求成功',$rs);
	}

	//平仓
	public function PingCang(Request $request){
		/* if(!iskaipan()){
			$this->error('當前不在交易時間');
			
		} */
		$id=$request->param('id/d');
		$type=$request->param('type/d');
		$user_id=$this->auth->id;
		//计算手续费
		$shouxufeilv=floatval($this->site['shouxufeilv'])/100;
		if($type==0){	//指数平仓
			$order=Db::name('zhishuchicang')->where(['user_id'=>$user_id,'id'=>$id])->find();
			Db::startTrans();
			try{
				$shouxufei=$order['benjin']*$shouxufeilv;
				$shouxufei=$shouxufei>=20?$shouxufei:20;
				$pingcangjine=$order['benjin']+$order['yingkui']+$order['sxf_gyf']-$shouxufei;	//结算的总金额

				$pro=Db::name('zhishu')->where(['id'=>$order['pro_id']])->find();

				$rs1=Db::name('zhishuchicang')->where(['user_id'=>$user_id,'id'=>$id])->update([
					'status'=>2,
					'selltime'=>time(),
					'selldata'=>1,
					'sellprice'=>$pro['price'],
					'sellmoney'=>$pro['price']*$order['shuliang'],
				]);

				if($rs1){
					$rs2=Db::name('user')->where('id',$user_id)->setInc('money',$pingcangjine);
					Db::name('user_money_log')->insert([
					    'user_id'=>$user_id,
					    'money' => $pingcangjine,
					    'memo' => '指數平倉成功',
					    'createtime' => time(),
					]);
					if($rs2){
						Db::commit();
						$this->success('平倉成功',['msg'=>'平倉成功']);
					}else{
						Db::rollback();
						$this->error('平倉失敗');
					}
				}

			}catch (PDOException $e) {
				Db::rollback();
				$this->error($e->getMessage());
			} catch (Exception $e) {
				Db::rollback();
				$this->error($e->getMessage());
			}

		}else{	//股票平仓
			$order=Db::name('chicang')->where(['user_id'=>$user_id,'id'=>$id])->find();
			Db::startTrans();
			try{
				$shouxufei=$order['benjin']*$shouxufeilv;
				$shouxufei=$shouxufei>=20?$shouxufei:20;
				$pingcangjine=$order['benjin']+$order['yingkui']+$order['sxf_gyf']-$shouxufei;	//结算的总金额

				$pro=Db::name('product')->where(['id'=>$order['pro_id']])->find();

				$rs1=Db::name('chicang')->where(['user_id'=>$user_id,'id'=>$id])->update([
					'status'=>2,
					'selltime'=>time(),
					'selldata'=>1,
					'sellprice'=>$pro['price'],
					'sellmoney'=>$pro['price']*$order['shuliang'],
				]);

				if($rs1){
					$rs2=Db::name('user')->where('id',$user_id)->setInc('money',$pingcangjine);
					Db::name('user_money_log')->insert([
					    'user_id'=>$user_id,
					    'money' => $pingcangjine,
					    'memo' => '股票平倉成功',
					    'createtime' => time(),
					]);
					if($rs2){
						Db::commit();
						$this->success('平倉成功',['msg'=>'平倉成功']);
					}else{
						Db::rollback();
						$this->error('平倉失敗');
					}
				}

			}catch (PDOException $e) {
				Db::rollback();
				$this->error($e->getMessage());
			} catch (Exception $e) {
				Db::rollback();
				$this->error($e->getMessage());
			}
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
			$this->error('用戶ID錯誤');
		}
		if($money<=0){
			$this->error('充值金額錯誤');
		}
		if($image==''){
			$this->error('請上傳轉賬記錄截圖');
			if(!file_exists('uploads/'.$image)){
				$this->error('請轉賬記錄截圖不存在');
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
			$this->success('请求成功',array('msg'=>'提交成功，請等待審核'));
		}else{
			$this->error('提交失敗');
		}
	}

	//检测用户银行卡支付密码等信息是否已设置
	public function checkUserInfoExist(Request $request){
		$user_id=$this->auth->id;
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		if(!is_null($user_info)){
			$rs_bank=Db::name('user_bankcard')->where('user_id',$user_id)->find();
			if(is_null($rs_bank)){
				$this->success('请求成功',array('code'=>1));
			}else{
				$this->success('请求成功',array('code'=>0,'msg'=>'您的金融卡信息已設置，如需修改請聯繫客服'));
			}
		}else{
			$this->success('请求成功',array('code'=>1));
		}
	}

	//设置用户银行卡支付密码等信息
	public function setUserInfo(Request $request){
		$user_id=$this->auth->id;
		$bank_name=trim($request->param('bank_name'));
		$bank_card=trim($request->param('bank_card'));
		$bank_address=trim($request->param('bank_address'));
		$bank_code=trim($request->param('bank_code'));
		$shiming_name=trim($request->param('shiming_name'));

		$user_bankcard=Db::name('user_bankcard')->where('user_id',$user_id)->find();

		if(!is_null($user_bankcard)){
			$is_update=true;
		}else{
		    $is_update=false;
		}

		if($bank_name==""){
			$this->error('請填寫銀行名稱');
		}
		if($bank_card==""){
			$this->error('請填寫銀行卡號');
		}
		if($bank_card==""){
			$this->error('請輸入開戶行地址');
		}

		if($shiming_name==""){
			$this->error('请填写持卡人姓名');
		}

		if($is_update){
		    $rs1=Db::name('user_info')->where('user_id',$user_id)->update([
				'real_name'=>$shiming_name,
			]);
			$rs2=Db::name('user_bankcard')->where('user_id',$user_id)->update([
				'bank_num'=>$bank_card,
				'bank_name'=>$bank_name,
				'bank_address'=>$bank_address,
				'bank_code'=>$bank_code,
				'updatetime'=>time(),
			]);
		}else{
		    $rs1=Db::name('user_info')->where('user_id',$user_id)->update([
		    	'real_name'=>$shiming_name,
		    ]);
		    $rs2=Db::name('user_bankcard')->insert([
				'user_id'=>$user_id,
		    	'bank_num'=>$bank_card,
		    	'bank_name'=>$bank_name,
		    	'bank_address'=>$bank_address,
		    	'bank_code'=>$bank_code,
		    	'updatetime'=>time(),
		    ]);
		}

		if($rs2){
			$this->success('请求成功',array('msg'=>'银行卡设置成功'));
		}else{
			$this->error('银行卡设置失败');
		}
	}

	public function getUserInfo(Request $request){
		$user_id=$this->auth->id;

		$user=Db::name('user')->where('id',$user_id)->find();

		if(\is_null($user)){
			$this->error('用户不存在');
		}
		$user['avatar']=input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME').$user['avatar'];
		$shizhi1=Db::name('chicang')->where(['user_id'=>$user_id,'status'=>1])->sum('benjin');
		$shizhi2=Db::name('zhishuchicang')->where(['user_id'=>$user_id,'status'=>1])->sum('benjin');
		$shizhi3=Db::name('xingushengou')->where(['user_id'=>$user_id,'status'=>0])->sum('yirenjiao');
        $user['money'] = round($user['money'],2);
		$user['shizhi']=$shizhi1+$shizhi2+$shizhi3;
		$user['total']=$user['money']+$user['shizhi'];
		$user['shizhi'] = round($user['shizhi'],2);
		$user['total'] = round($user['total'],2);
		
		// 获取真实姓名
		$user['true_name'] = Realname::where('user_id',$this->auth->id)->where('status',1)->order('id','DESC')->value('true_name');
		
		$this->success('请求成功',$user);
	}

	//提交提现申请
	public function submitWithdrawal(Request $request){
		$money=$request->param('money');
		$pass=$request->param('pass');

		$user_id=$this->auth->id;
		$user=Db::name('user')->where('id',$user_id)->find();
		$user_info=Db::name('user_info')->where('user_id',$user_id)->find();
		$user_bankcard=Db::name('user_bankcard')->where('user_id',$user_id)->find();
		if(\is_null($user_info)){
			$this->error('用户信息不存在');
		}

		if($user_info['paypassword']!=$pass){
			$this->error('资金密码不正确');
		}

		if(is_null($user_bankcard)){
			$this->error('未绑银行卡');
		}

		if($money>$user['money']){
			$this->error('资金余额不足提现');
		}

		$data=array(
			'order_sn'=>getMillisecond(),
			'user_id'=>$user_id,
			'shiming_name'=>$user_info['real_name'],
			'bank_name'=>$user_bankcard['bank_name'],
			'bank_card'=>$user_bankcard['bank_num'],
			'bank_address'=>$user_bankcard['bank_address'],
			'bank_code'=>$user_bankcard['bank_code'],
			'money'=>$money,
			'status'=>0,
			'createtime'=>time(),
		);

		$rs=Db::name('tixian')->insert($data);
		if($rs>0){
		    //用户余额减少
		  //  Db::name('user')->where('id',$user_id)->setDec('money',$money);
		  //  Db::name('user_money_log')->insert([
				// 	    'user_id'=>$user_id,
				// 	    'money' => $money,
				// 	    'memo' => '提領支出',
				// 	    'createtime' => time(),
				// 	]);
			$this->success('请求成功',array('msg'=>'提領成功，请等待审核'));
		}else{
			$this->error('提现申请失败');
		}
	}
	
	
	public function get_discount_gupiao(){
        $config = config('site.a_discount_time');
        // 判断当前是否在抢购时间内
        $Now_time=date('H:i'); // 当前时间
        $start_time = date('H:i',strtotime($config['start_time']));; // 开始时间
        $end_time = date('H:i',strtotime($config['end_time']));; // 结束时间
        if($Now_time<$start_time  || $Now_time >$end_time){
            $data = [];
        }else{
	        $data['pro_list'] = Db::name('product')->where(['show_switch'=>1])->whereNotNull('discount')->select();
        }
	    $order_list =  Db::name('zjsg')->where('user_id', $this->auth->id)->order('id','DESC')->select();
	    $order_list_new = [];
	    foreach ($order_list as $v){
	        $v['product'] = Db::name('product')->where('id',$v['pro_id'])->find();
	        $order_list_new[] = $v;
	    }
	    $data['order_list'] = $order_list_new;
		$this->success('请求成功',$data);
	}
	
	
	public function add_discount_gupiao(Request $request){
	    
        $config = config('site.a_discount_time');
        // 判断当前是否在抢购时间内
        $Now_time=date('H:i'); // 当前时间
        $start_time = date('H:i',strtotime($config['start_time']));; // 开始时间
        $end_time = date('H:i',strtotime($config['end_time']));; // 结束时间
        if($Now_time<$start_time  || $Now_time >$end_time){
            $this->error('未在购买时间');
        }else{
	        $pro_id = $request->param('pro_id');
	        $num = $request->param('num');
	        $cp = Db::name('product')->where(['show_switch'=>1])->where('id',$pro_id)->find();;
	        $price = $cp['discount'];
	        $turnover = $num*1000;
	        $price = $price*$turnover;
	        $user=Db::name('user')->where('id',$this->auth->id)->find();
    		if($user['money']<$price){
    			$this->error('您的餘額不足，請充值');
    		}
            $rs2=Db::name('user')->where('id',$this->auth->id)->setDec('money',$price);
            
					Db::name('user_money_log')->insert([
					    'user_id'=>$this->auth->id,
					    'money' => $price,
					    'memo' => '申購折價',
					    'createtime' => time(),
					]);
	        Db::name('zjsg')->insert([
	            'user_id' => $this->auth->id,
	            'pro_id' => $pro_id,
	            'price' => $price,
	            'turnover' => $turnover,
	            'num' => $num,
	        ]);
        }
	    
		$this->success('购买成功',[]);
	}
}
