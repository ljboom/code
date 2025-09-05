<?php
namespace app\push\controller;
use think\worker\Server;
use Workerman\Lib\Timer;
use think\Db;
use think\Request;
class Worker extends Server
{	
	protected $socket = 'websocket://147.92.41.57:2346';
	    protected $nowtime;
	    protected $minute;
	    protected $user_win;
	    protected $user_loss;
	    public function __construct(){
			parent::__construct();
	
			$this->nowtime = time();
			$minute = date('Y-m-d H:i',$this->nowtime).':00';
			$this->minute = strtotime($minute);
	
			//指定客户赢利或亏损：
			//array()里面写客户编号，如客户id为1027则写为  array(1027)
			//如多个客户，则以英文逗号分开，如 array(1027,2018,3765)
			//注意一定是英文逗号，中文逗号会报错
			$this->user_win = array();//指定客户赢利
			$this->user_loss = array();//指定客户亏损
			
			//K线数据库
			$this->klinedata = db('klinedata');
	
	
		}
	
    protected $socket = 'websocket://202.95.1.4:2346';
	public static $i=0;
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        //$connection->send('我收到你的信息了+'.print_r($data,1));
		
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {

    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {
		//采集数据
		Timer::add(5, function()use($worker)
		{
			$this->getdate();
			//Db::close();
		});
		
		//结算订单
		Timer::add(2, function()use($worker)	
		{
			$this->order();
			//Db::close();
		});
    }
	
	/**
	 * 获取K线。缓存起来
	 * @author lukui  2017-08-13
	 * @return [type] [description]
	 */
	public function cachekline()
	{
		
		$pro =Db::name('productinfo')->field('pid')->where('isdelete',0)->select();
		$kline = cache('cache_kline');
		foreach ($pro as $k => $v) {
			
			$res[$v['pid']][1] = $this->getkdata($v['pid'],60,1,1);
			if(!$res[$v['pid']][1]) $res[$v['pid']][1] = $kline[$v['pid']][1] ;
			$res[$v['pid']][5] = $this->getkdata($v['pid'],60,5,1);
			if(!$res[$v['pid']][5]) $res[$v['pid']][5] = $kline[$v['pid']][5] ;
			$res[$v['pid']][15] = $this->getkdata($v['pid'],60,15,1);
			if(!$res[$v['pid']][15]) $res[$v['pid']][15] = $kline[$v['pid']][15] ;
			$res[$v['pid']][30] = $this->getkdata($v['pid'],60,30,1);
			if(!$res[$v['pid']][30]) $res[$v['pid']][30] = $kline[$v['pid']][30] ;
			$res[$v['pid']][60] = $this->getkdata($v['pid'],60,60,1);
			if(!$res[$v['pid']][60]) $res[$v['pid']][60] = $kline[$v['pid']][60] ;
			$res[$v['pid']]['d'] = $this->getkdata($v['pid'],60,'d',1);
			if(!$res[$v['pid']]['d']) $res[$v['pid']]['d'] = $kline[$v['pid']]['d'] ;
		}
	
		
	
		cache('cache_kline',$res);
	
	}
	
	public function getkline(){
	
		$kline = cache('cache_kline');
		$pid = input('pid');
		$interval = input('interval');
	
		if(!$interval || !$pid){
			return false;
		}
	
		$info = json_decode($kline[$pid][$interval],1);
	
		return exit(json_encode($info));;
		
	}
	
	public function allotfee($uid,$fee,$is_win,$order_id,$ploss)
	{
		$userinfo =Db::name('userinfo');
		$allot =Db::name('allot');
		$nowtime = time();
	
		$user = Db::name('userinfo')->field('uid,oid')->where('uid',$uid)->find();
		$myoids = myupoid($user['oid']);
	
		
	
		if(!$myoids){
			return;
		}
		
		//红利
		$_fee = 0;
		//佣金
		$_feerebate = 0;
		//手续费
		$web_poundage = getconf('web_poundage');
		//分配金额
		if($is_win == 1){
			$pay_fee = $ploss;
		}elseif($is_win == 2){
			$pay_fee = $fee;
		}else{
			//20170801 edit
			return;
		}
		
		
		foreach ($myoids as $k => $v) {
	
			if($user['oid'] == $v['uid']){	//直接推荐者拿自己设置的比例
	
				
				$_fee = round($pay_fee * ($v["rebate"]/100),2);
				$_feerebate = round($fee*$web_poundage/100 * ($v["feerebate"]/100),2);
				echo $_feerebate;
	
			}else{		//他上级比例=本级-下级比例
				
				$_my_rebate = ($v["rebate"] - $myoids[$k-1]["rebate"]);
				
				if($_my_rebate < 0) $_my_rebate = 0;
				$_fee = round($pay_fee * ( $_my_rebate /100),2);
				
				$_my_feerebate = ($v["feerebate"]  - $myoids[$k-1]["feerebate"] );
				if($_my_feerebate < 0) $_my_feerebate = 0;
				$_feerebate = round($fee*$web_poundage/100 * ( $_my_feerebate /100),2);
	
				
			}
			
			
			//红利
			if($is_win == 1){	//客户盈利代理亏损
				if($_fee != 0){
					$ids_fee = 	Db::name('userinfo')->where('uid',$v['uid'])->setDec('usermoney', $_fee);
				}else{
					$ids_fee = null;
				}
	
				$type = 2;
				$_fee = $_fee*-1;
			}elseif($is_win == 2){	//客户亏损代理盈利
				if($_fee != 0){
					$ids_fee = 	Db::name('userinfo')->where('uid',$v['uid'])->setInc('usermoney', $_fee);
				}else{
					$ids_fee = null;
				}
				
				$type = 1;
			}elseif($is_win == 3){	//无效订单不做操作
				$ids_fee = null;
			}
	
			if($ids_fee){
				//余额
				$nowmoney = Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
				set_price_log($v['uid'],$type,$_fee,'对冲','下线客户平仓对冲',$order_id,$nowmoney);
				
			}
	
			//手续费
			if($_feerebate != 0){
				$ids_feerebate = Db::name('userinfo')->where('uid',$v['uid'])->setInc('usermoney', $_feerebate);
			}else{
				$ids_feerebate = null;
			}
	
			if($ids_feerebate){
				//余额
				$nowmoney = Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
				set_price_log($v['uid'],1,$_feerebate,'客户手续费','下线客户下单手续费',$order_id,$nowmoney);
				
			}
	
			
			
	
			
	
		}
		
		/*
	
		foreach ($myoids as $k => $v) {
			//分红利
			if($_fee <= 0){
				continue;
			}
	
			if($v['rebate'] <= 0 || $v['rebate'] > 100){
				continue;
			}
	
			//分给我的钱
			$my_fee = round($_fee*(100-$v['rebate'])/100,2);
	
			if($my_fee <= 0.01){
				continue;
			}
			
			
			if($is_win == 1){	//客户盈利代理亏损
				$ids = Db::name('userinfo')->where('uid',$v['uid'])->setDec('usermoney', $my_fee);
				$type = 2;
				$my_fee = $my_fee*-1;
			}elseif($is_win == 2){	//客户亏损代理盈利
	
				$ids = Db::name('userinfo')->where('uid',$v['uid'])->setInc('usermoney', $my_fee);
				$type = 1;
			}elseif($is_win == 3){	//无效订单不做操作
				$ids = null;
			}
			//余额
			$nowmoney = Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
	
			if($ids){
				$_data['is_win'] = $is_win;
				$_data['time'] = $nowtime;
				$_data['uid'] = $v['uid'];
				$_data['order_id'] = $order_id;
				$_data['my_fee'] = $my_fee;
				$_data['nowmoney'] = $nowmoney;
				$_data['type'] = 1;
				$allot->insert($_data);
	
				set_price_log($v['uid'],$type,$my_fee,'对冲','下线客户平仓对冲',$order_id,$nowmoney);
			}
			
			$_fee = round($_fee*$v['rebate']/100,2);
	
			
		}
	
		//分佣金
		foreach ($myoids as $k => $v) {
	
			
			if($yj_fee <= 0){
				continue;
			}
	
			if($v['feerebate'] <= 0 || $v['feerebate'] > 100){
				continue;
			}
	
			//分给我的钱
			$my_fee = round($yj_fee*(100-$v['feerebate'])/100,2);
	
			if($my_fee <= 0.01){
				continue;
			}
	
			//余额
			$nowmoney = Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
			if($is_win == 1 || $is_win == 2){	//有效订单
				$ids = Db::name('userinfo')->where('uid',$v['uid'])->setInc('usermoney', $my_fee);
				$type = 1;
			}else{
				$ids = null;
			}
			if($ids){
				$_data['is_win'] = $is_win;
				$_data['time'] = $nowtime;
				$_data['uid'] = $v['uid'];
				$_data['order_id'] = $order_id;
				$_data['my_fee'] = $my_fee;
				$_data['nowmoney'] = $nowmoney;
				$_data['type'] = 2;
				$allot->insert($_data);
	
				set_price_log($v['uid'],$type,$my_fee,'客户手续费','下线客户下单手续费',$order_id,$nowmoney);
			}
			
			$yj_fee = round($yj_fee*$v['feerebate']/100,2);
	
	
		}
		*/
	
	}
	
	/**
	 * 分配订单
	 * @return [type] [description]
	 */
	public function allotorder()
	{
		//查找以平仓未分配的订单  isshow字段
		$map['isshow'] = 0;
		$map['ostaus'] = 1;
		$list =Db::name('order')->where($map)->limit(0,10)->select();
	
		if(!$list){
			return 1;
		}
	
		foreach ($list as $k => $v) {
			//分配金额
			$this->allotfee($v['uid'],$v['fee'],$v['is_win'],$v['oid'],$v['ploss']);
			//更改订单状态
			Db::name('order')->where('oid',$v['oid'])->update(array('isshow'=>1));
	
		}
		//dump($list);
	}
	
	public function getprodata()
	{
		
	
		$pid = input('param.pid');
	
		$pro = GetProData($pid);
		
	
		if(!$pro){
			//echo 'data error!';
			exit;
		}
	
		$topdata = array(
						'topdata'=>$pro['UpdateTime'],
						'now'=>$pro['Price'],
						'open'=>$pro['Open'],
						'lowest'=>$pro['Low'],
						'highest'=>$pro['High'],
						'close'=>$pro['Close']
	
					);
	
		exit(json_encode($topdata));
	
	}
	
	/**
		 * 获取K线数据
		 * @author lukui  2017-07-01
		 * @return [type] [description]
		 */
		public function getkdata($pid=null,$num=null,$interval=null,$isres=null)
		{
			
			$pid = empty($pid)?input('param.pid'):$pid;
			$num = empty($num)?input('param.num'):$num;
			$num = empty($num)?30:$num;
			$pro = GetProData($pid);
			$all_data = array();
	
			if(!$pro){
				//echo 'data error!';
				exit;
			}
			$interval = empty($interval)?input('param.interval'):$interval;
			$interval = input('param.interval') ? input('param.interval') : 1;
			$nowtime = time().rand(100,999);
	
			//比特币
	        if($pro['procode'] == "btc" || $pro['procode'] == "ltc" ||$pro['procode']=="eth" ||$pro['procode']=="etc" ||$pro['procode']=="ltc" ||$pro['procode']=="eos" ||$pro['procode']=="doge" ||$pro['procode']=="usdt"){
	
	            switch ($interval) {
	                case '1':
	                    $datalen = "1min";
	                    break;
	                case '5':
	                    $datalen = "5min";
	                    break;
	                case '15':					$datalen = "15min";					break;
	                case '30':					$datalen = "30min";					break;
	                case '60':					$datalen = "1hour";					break;
	                case 'd':					$datalen = "1day";					break;
	                default:
	                    exit;
	                    break;
	            }
	            //////////////////star
	            if($pro['procode'] == "btc"){
	                $geturl = "http://api.bitkk.com/data/v1/kline?market=btc_usdt&type=".$datalen."&size=".$num;
	            }elseif($pro['procode'] == "ltc"){
	                $geturl = "http://api.bitkk.com/data/v1/kline?market=ltc_usdt&type=".$datalen."&size=".$num."&contract_type=this_week";
	            }elseif($pro['procode']=='eth'){
	                $geturl = "http://api.bitkk.com/data/v1/kline?market=eth_usdt&type=".$datalen."&size=".$num;
	            }elseif($pro['procode']=='etc'){
	                $geturl = "http://api.bitkk.com/data/v1/kline?market=etc_usdt&type=".$datalen."&size=".$num;
	            }elseif($pro['procode']=='etc'){
	                $geturl = "http://api.bitkk.com/data/v1/kline?market=ltc_usdt&type=".$datalen."&size=".$num;
	            }elseif($pro['procode']=='eos'){
	                $geturl = "http://api.bitkk.com/data/v1/kline?market=eos_usdt&type=".$datalen."&size=".$num;
	            }elseif($pro['procode']=='doge'){
	                $geturl = "http://api.bitkk.com/data/v1/kline?market=doge_usdt&type=".$datalen."&size=".$num;
	            }elseif($pro['procode']=='usdt'){
	                $geturl = "http://api.bitkk.com/data/v1/kline?market=usdt_qc&type=".$datalen."&size=".$num;
	            }
	            $html = file_get_contents($geturl);
	
	            $html = substr($html,25,-22);
	
	            $_data_arr = explode('],[',$html);
	            //var_dump($_data_arr);
	//exit;
	            foreach ($_data_arr as $k => $v) {
	                $_son_arr = explode(',', $v);
	                $res_arr[] = array($_son_arr[0]/1000,$_son_arr[1],$_son_arr[4],$_son_arr[3],$_son_arr[2]);
	            }
	            ////////////////end
	
	            /*************黄金白银K线数据开始*****************/
	
	        }elseif(in_array($pro['procode'],array('llg','lls'))){
				if($interval == 'd') $interval = 1440;
				$geturl = "https://hq.91pme.com/query/kline?callback=jQuery183014447531082730047_".$nowtime."&code=".$pro['procode']."&level=".$interval."&maxrecords=".$num."&_=".$nowtime;
	
				$html = $this->curlfun($geturl);
				$str_1 = explode('[{',$html);
				if(!isset($str_1[1])){
					return;
				}
				$str_2 = substr($str_1[1],0,-4);
				$str_3 = explode('},{',$str_2);
				
				krsort($str_3);
	
				foreach ($str_3 as $k => $v) {
					
					$_son_arr = explode(',', $v);
					
					$res_arr[] = array(
									substr($_son_arr[11],7,-3),
									substr($_son_arr[10],7,-1),
									substr($_son_arr[0],8,-1),
									substr($_son_arr[3],7,-1),
									substr($_son_arr[4],6,-1),
									
								);
	
					
				}
	
				
	
	
			}elseif($pro['cid']==7){
	                $year = date('Y_n_j',time());
					if($interval == 'd'){
	
						$geturl='https://stock2.finance.sina.com.cn/futures/api/jsonp.php/var%20_'.$pro['procode'].$year.'=/GlobalFuturesService.getGlobalFuturesDailyKLine?symbol='.$pro['procode'].'&_='.$year.'&source=web';
						        'https://quotes.sina.cn/cn/api/jsonp_v2.php/var%20_sh6033932021_08_14=/CN_MarketDataService.getKLineData?symbol=sh603393&_=2021_08_14&source=web';
					}else{
						$geturl='https://gu.sina.cn/ft/api/jsonp.php/var%20_'.$pro['procode'].'_'.$interval.'_'.$nowtime.'=/GlobalService.getMink?symbol='.$pro['procode'].'&type='.$interval;
					}
	
				$html = $this->curlfun($geturl);
				
	
	
					$_arr = explode('[',$html);
					if(!isset($_arr[1])){
						return;
					}
					$_str = substr($_arr[1],1,-3);
					$_data_arr = explode('},{',$_str);
					
				
	
				$_count = count($_data_arr);
				$_data_arr = array_slice($_data_arr,$_count-$num,$_count);
				
				
				
				
				
				
	
				foreach ($_data_arr as $k => $v) {
					
					$_son_arr = explode(',', $v);
					
	
	                 if($interval == 'd'){
	
							$res_arr[] = array(
											strtotime(substr($_son_arr[0],8,-1)),
											substr($_son_arr[1],8,-1),
											substr($_son_arr[4],9,-1),
											substr($_son_arr[2],8,-1),
											substr($_son_arr[3],7,-1),
											
										);
	                        }else{
							$res_arr[] = array(
											strtotime(substr($_son_arr[0],5,-1)),
											substr($_son_arr[1],5,-1),
											substr($_son_arr[4],5,-1),
											substr($_son_arr[2],5,-1),
											substr($_son_arr[3],5,-1),
											
										);
	                        }
				}		    
			}elseif($pro['procode']=='sh603393'){
				switch ($interval) {
					case '1':
						$datalen = 1440;
						break;
					case '5':
						$datalen = 1440;
						break;
					case '15':
						$datalen = 480;
						break;
					case '30':
						$datalen = 240;
						break;
					case '60':
						$datalen = 120;
						break;
					case 'd':
						
						break;
					
					default:
						//echo 'data error!';
						exit;
						break;
				}
	
				$year = date('Y_n_j',time());
	
					if($interval == 'd'){
	
						$geturl = "https://quotes.sina.cn/cn/api/jsonp_v2.php/var%20_".$pro['procode']."$year=/CN_MarketDataService.getKLineData?symbol=".$pro['procode']."&_=$year";
					}else{
						$geturl = "https://quotes.sina.cn/cn/api/jsonp_v2.php/var%20_".$pro['procode']."_".$interval."_$nowtime=/CN_MarketDataService.getKLineData?symbol=".$pro['procode']."&scale=".$interval."&datalen=".$datalen;
						  /*$geturl='https://quotes.sina.cn/cn/api/jsonp_v2.php/var%20_sh603393_15_1628916256811=/CN_MarketDataService.getKLineData?symbol=sh603393&scale=15&ma=no&datalen=1440';*/
					}
				
	
	
				$html = $this->curlfun($geturl);
				
	
				if($interval == 'd'){
					$_arr = explode('("',$html);
					if(!isset($_arr[1])){
						return;
					}
					$_str = substr($_arr[1],1,-4);
					$_data_arr = explode(',|',$_str);
					
				}else{
					$_arr = explode('[',$html);
					if(!isset($_arr[1])){
						return;
					}
					$_str = substr($_arr[1],1,-3);
					$_data_arr = explode('},{',$_str);
					
				}
	
				$_count = count($_data_arr);
				$_data_arr = array_slice($_data_arr,$_count-$num,$_count);
				
				
				
				
				
				
	
				foreach ($_data_arr as $k => $v) {
					
					$_son_arr = explode(',', $v);
					
					if($interval == 'd'){
						$res_arr[] = array(
											substr($_son_arr[0],5),
											$_son_arr[1],
											$_son_arr[4],
											$_son_arr[2],
											$_son_arr[3],
											
										);
					}else{
	
							$res_arr[] = array(
											strtotime(substr($_son_arr[0],7,-1)),
											substr($_son_arr[1],8,-1),
											substr($_son_arr[4],9,-1),
											substr($_son_arr[2],8,-1),
											substr($_son_arr[3],7,-1),
											
										);
						
						
					}
	
					
				}		    
			}else{
	
				switch ($interval) {
					case '1':
						$datalen = 1440;
						break;
					case '5':
						$datalen = 1440;
						break;
					case '15':
						$datalen = 480;
						break;
					case '30':
						$datalen = 240;
						break;
					case '60':
						$datalen = 120;
						break;
					case 'd':
						
						break;
					
					default:
						//echo 'data error!';
						exit;
						break;
				}
				
				$year = date('Y_n_j',time());
				if(in_array($pro['procode'],array(13,12,116,176,15,22114,32816,74,75))){
					if($interval == 1) $interval =1;
					if($interval == 5) $interval =2;
					if($interval == 15) $interval =3;
					if($interval == 30) $interval =4;
					if($interval == 60) $interval =5;
					if($interval == 'd') $interval =6;
					
					$geturl = 'https://m.sojex.net/api.do?rtp=CandleStick&type='.$interval.'&qid='.$pro['procode'];
					
					
					
				}else{
					if($interval == 'd'){
	
						$geturl = "http://vip.stock.finance.sina.com.cn/forex/api/jsonp.php/var%20_".$pro['procode']."$year=/NewForexService.getDayKLine?symbol=".$pro['procode']."&_=$year";
					}else{
						$geturl = "http://vip.stock.finance.sina.com.cn/forex/api/jsonp.php/var%20_".$pro['procode']."_".$interval."_$nowtime=/NewForexService.getMinKline?symbol=".$pro['procode']."&scale=".$interval."&datalen=".$datalen;
					}
				}
	
	
				
				$html = $this->curlfun($geturl);
				
	
				if($interval == 'd'){
					$_arr = explode('("',$html);
					if(!isset($_arr[1])){
						return;
					}
					$_str = substr($_arr[1],1,-4);
					$_data_arr = explode(',|',$_str);
					
				}else{
					$_arr = explode('[',$html);
					if(!isset($_arr[1])){
						return;
					}
					$_str = substr($_arr[1],1,-3);
					$_data_arr = explode('},{',$_str);
					
				}
	
				$_count = count($_data_arr);
				$_data_arr = array_slice($_data_arr,$_count-$num,$_count);
				
				
				
				
				
				
	
				foreach ($_data_arr as $k => $v) {
					
					$_son_arr = explode(',', $v);
					
					if($interval == 'd'){
						$res_arr[] = array(
											substr($_son_arr[0],5),
											$_son_arr[1],
											$_son_arr[4],
											$_son_arr[2],
											$_son_arr[3],
											
										);
					}else{
						if(in_array($pro['procode'],array(13,12,116,176,15,22114,32816,74,75))){
							if($interval == 6){
								$_ktime = substr($_son_arr[7],5,-1).' 00:00:00';
							}else{
								$_ktime = '2017-'.substr($_son_arr[7],5,-1);
							}
	
							$res_arr[] = array(
											strtotime($_ktime),
											substr($_son_arr[3],5,-1),
											substr($_son_arr[3],5,-1),
											substr($_son_arr[2],5,-1),
											substr($_son_arr[0],5,-1),
											
										);
							
						}else{
							$res_arr[] = array(
											strtotime(substr($_son_arr[0],5,-1)),
											substr($_son_arr[1],5,-1),
											substr($_son_arr[4],5,-1),
											substr($_son_arr[2],5,-1),
											substr($_son_arr[3],5,-1),
											
										);
						}
						
					}
	
					
				}
	
				
	
				//dump($res_arr);
	
				//$res_arr[$num] = array(date('H:i:s',$pro['UpdateTime']),$pro['Price'],$pro['Open'],$pro['Close'],$pro['Low']);
				
				
				
	
	
			}
			
	
			
			if($pro['Price'] < $res_arr[$num-1][1]){
				$_state = 'down';
			}else{
				$_state = 'up';
			}
			
			
			$all_data['topdata'] = array(
											'topdata'=>$pro['UpdateTime'],
											'now'=>$pro['Price'],
											'open'=>$pro['Open'],
											'lowest'=>$pro['Low'],
											'highest'=>$pro['High'],
											'close'=>$pro['Close'],
											'state'=>$_state
	
										);
			
			$all_data['items'] = $res_arr;
			if($isres){
				return (json_encode($all_data));
			}else{
				exit(json_encode($all_data));
			}
			
	
		}
	
	/**
	 * 订单类型
	 * @param  [type] $orders [description]
	 * @return [type]         [description]
	 */
	public function order_type($orders,$pro,$risk,$data_info)
	{



		$pid = $pro['pid'];
		$thispro = array();		//买此产品的用户
		

		//此产品购买人数
		$price_num = 0;
		//买涨金额，计算过盈亏比例以后的
		$up_price = 0;
		//买跌金额，计算过盈亏比例以后的
		$down_price = 0;
		//买入最低价
		$min_buyprice = 0;
		//买入最高价
		$max_buyprice = 0;
		//下单最大金额
		$max_fee = 0;
		//指定客户亏损
		$to_win = explode('|',$risk['to_win']);
		$is_to_win = array();
		//指定客户亏损
		$to_loss = explode('|',$risk['to_loss']);
		$is_to_loss = array();

		$i = 0;

		foreach ($orders as $k => $v) {

			if($v['pid'] == $pid ){
				//没炒过最小风控值直接退出price
				if ($v['fee'] < $risk['min_price']) {
					//return $pro['Price'];
				}
				$i++;

				//单控 赢利  
				if($v['kong_type'] == 1){
					$dankong_ying = $v;
				}

				//单控 亏损  
				if($v['kong_type'] == 2){
					$dankong_kui = $v;
				}
				
				//是否存在指定盈利
				if(in_array($v['uid'], $to_win)){
					$is_to_win = $v;
					
				}
				//是否存在指定亏损
				if(in_array($v['uid'], $to_loss)){
					$is_to_loss = $v;
					
				}

				//总下单人数
				$price_num++;
				//买涨买跌累加
				if($v['ostyle'] == 0){
					$up_price += $v['fee']*$v['endloss']/100;
				}else{
					$down_price += $v['fee']*$v['endloss']/100;
				}
				//统计最大买入价与最大下单价
				if($i == 1){
					$min_buyprice = $v['buyprice'];
					$max_buyprice = $v['buyprice'];
					$max_fee = $v['fee'];
				}else{
					if($min_buyprice > $v['buyprice']){
						$min_buyprice = $v['buyprice'];
						
					}
					if($max_buyprice < $v['buyprice']){
						$max_buyprice = $v['buyprice'];
					}
					if($max_fee < $v['fee']){
						$max_fee = $v['fee'];
					}
				}
			}

		}


		
		// dump('$pid:'.$pid);
		// dump('$price_num:'.$price_num);
		// dump('$up_price:'.$up_price);
		// dump('$down_price:'.$down_price);
		// dump('$min_buyprice:'.$min_buyprice);
		// dump('$max_buyprice:'.$max_buyprice);
		// dump('$max_fee:'.$max_fee);

		//根据现在的价格算出风控点
		$FloatLength = getFloatLength((float)$pro['Price']);
		$jishu_rand = pow(10,$FloatLength);
		$beishu_rand = rand(1,10);

		$data_rands = $data_info->where('pid',$pro['pid'])->value('rands');
		$data_randsLength = getFloatLength($data_rands);
		if($data_randsLength > 0){
			$_j_rand = pow(10,$data_randsLength)*$data_rands;
			$_s_rand = rand(1,$_j_rand)/pow(10,$data_randsLength);
		}else{
			$_s_rand = 0;
		}
		

		$do_rand = $_s_rand;

		//是否存在指定盈利
		$is_do_price = 0; 	//是否已经操作了价格

		//先考虑单控
		if(!empty($dankong_ying) && $is_do_price == 0){ 		//单控 1赢利
			if($dankong_ying['ostyle'] == 0 && $pro['Price'] < $dankong_ying['buyprice']){
				$pro['Price'] = $v['buyprice'] + $do_rand;
			}elseif($dankong_ying['ostyle'] == 1 && $pro['Price'] > $dankong_ying['buyprice']){
				$pro['Price'] = $v['buyprice'] - $do_rand;
			}
			$is_do_price = 1;
		}

		if(!empty($dankong_kui) && $is_do_price == 0){ 		//单控 2亏损
			if($dankong_kui['ostyle'] == 0  && $pro['Price'] > $dankong_kui['buyprice']){
				$pro['Price'] = $v['buyprice'] - $do_rand;
			}elseif($dankong_kui['ostyle'] == 1 && $pro['Price'] < $dankong_kui['buyprice']){
				$pro['Price'] = $v['buyprice'] + $do_rand;
			}
			$is_do_price = 1;
			$is_do_price = 1;
		}

		//指定客户赢利
		if(!empty($is_to_win) && $is_do_price == 0){
			
			if($is_to_win['ostyle'] == 0 && $pro['Price'] < $is_to_win['buyprice']){
				$pro['Price'] = $v['buyprice'] + $do_rand;
			}elseif($is_to_win['ostyle'] == 1 && $pro['Price'] > $is_to_win['buyprice']){
				$pro['Price'] = $v['buyprice'] - $do_rand;
			}
			$is_do_price = 1;
			//echo 1;
			
		}
		//是否存在指定亏损
		if(!empty($is_to_loss) && $is_do_price == 0){

			
			if($is_to_loss['ostyle'] == 0  && $pro['Price'] > $is_to_loss['buyprice']){
				$pro['Price'] = $v['buyprice'] - $do_rand;
			}elseif($is_to_loss['ostyle'] == 1 && $pro['Price'] < $is_to_loss['buyprice']){
				$pro['Price'] = $v['buyprice'] + $do_rand;
			}
			$is_do_price = 1;
			//echo 2;
		}
		//没有任何下单记录
		if($up_price == 0 && $down_price == 0 && $is_do_price == 0){
			$is_do_price = 1;
			//return $pro['Price'];
		}
		
		//只有一个人下单，或者所有人下单买的方向相同
		if(( ($up_price == 0 && $down_price != 0) || ($up_price != 0 && $down_price == 0) )  && $is_do_price == 0 ){

			//风控参数
			$chance = $risk["chance"];
			$chance_1 = explode('|',$chance);
			$chance_1 = array_filter($chance_1);
			//循环风控参数
			if(count($chance_1) >= 1){
				foreach ($chance_1 as $key => $value) {
					//切割风控参数
					$arr_1 = explode(":",$value);
					$arr_2 = explode("-",$arr_1[0]);
					//比较最大买入价格
					if($max_fee >= $arr_2[0] && $max_fee < $arr_2[1]){
						//得出风控百分比
						$chance_num = $arr_1[1];
						$_rand = rand(1,100);
						
					}
					
				}
			}

			


			//买涨
			if(isset($_rand) && $up_price != 0){

				if($_rand > $chance_num){	//客损
					$pro['Price'] = $max_buyprice-$do_rand;
					$is_do_price = 1;
					//echo 3;
				}else{		//客赢
					$pro['Price'] = $min_buyprice+$do_rand;
					$is_do_price = 1;
					//echo 4;
				}
				
			}
			if(isset($_rand) && $down_price != 0){

				if($_rand > $chance_num){	//客损
					$pro['Price'] = $min_buyprice+$do_rand;
					$is_do_price = 1;
					//echo 5;
				}else{		//客赢
					$pro['Price'] = $max_buyprice-$do_rand;
					$is_do_price = 1;
					//echo 6;
				}
				
			}

			

		}

		//多个人下单，并且所有人下单买的方向不相同
		if($up_price != 0 && $down_price != 0  && $is_do_price == 0){
			//买涨大于买跌的
			if ($up_price > $down_price) {
				$pro['Price'] = $min_buyprice-$do_rand;
				$is_do_price = 1;
				//echo 7;
				
			}
			//买涨小于买跌的
			if ($up_price < $down_price) {
				$pro['Price'] = $max_buyprice+$do_rand;
				$is_do_price = 1;
				//echo 8;
			}
			
			
		}

		
		db('productdata')->where('pid',$pro['pid'])->update($pro);
		
		if($pro['Price'] < $pro['Low']){
			$pro['Price'] = $pro['Low'];
		}
		if($pro['Price'] > $pro['High']){
			$pro['Price'] = $pro['High'];
		}
		return $pro['Price'];
		

	}
		
	/**
	 * 写入平仓日志
	 * @author lukui  2017-07-01
	 * @param  [type] $v        [description]
	 * @param  [type] $addprice [description]
	 */
	public function set_order_log($v,$addprice)
	{
		$o_log['uid'] = $v['uid'];
	   	$o_log['oid'] = $v['oid'];
	   	$o_log['addprice'] = $addprice;
	   	$o_log['addpoint'] = 0;
	   	$o_log['time'] = time();
	   	$o_log['user_money'] =Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
	   	Db::name('order_log')->insert($o_log);
	
	   	//资金日志
	   	set_price_log($v['uid'],1,$addprice,'结单','订单到期获利结算',$v['oid'],$o_log['user_money']);
	}
	
	//curl获取数据
	public function curlfun($url, $params = array(), $method = 'GET')
	{
		
		$header = array();
		$opts = array(CURLOPT_TIMEOUT => 10, CURLOPT_RETURNTRANSFER => 1, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => false, CURLOPT_HTTPHEADER => $header);
	
		/* 根据请求类型设置特定参数 */
		switch (strtoupper($method)) {
			case 'GET' :
				$opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
				$opts[CURLOPT_URL] = substr($opts[CURLOPT_URL],0,-1);
				
				break;
			case 'POST' :
				//判断是否传输文件
				$params = http_build_query($params);
				$opts[CURLOPT_URL] = $url;
				$opts[CURLOPT_POST] = 1;
				$opts[CURLOPT_POSTFIELDS] = $params;
				break;
			default :
				
		}
	
		/* 初始化并执行curl请求 */
		$ch = curl_init();
		curl_setopt_array($ch, $opts);
		$data = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		
		if($error){
			$data = null;
		}
		
		return $data;
	
	}
	
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
	
	
	public function fengkong($price,$pro)
	{
		
		$point_low = $pro['point_low'];
		$point_top = $pro['point_top'];
		
		$FloatLength = getFloatLength($point_top);
		$jishu_rand = pow(10,$FloatLength);
		$point_low = $point_low * $jishu_rand;
		$point_top = $point_top * $jishu_rand;
		$rand = rand($point_low,$point_top)/$jishu_rand;
		
		$_new_rand = rand(0,10);
		if($_new_rand % 2 == 0){
			$price = $price + $rand;
		}else{
			$price = $price - $rand;
		}
		return $price;
	}
		
	public function getdate()
	{
		
	
		//产品列表
		$pro =Db::name('productinfo')->where('isdelete',0)->select();
	
		if(!isset($pro)) return false;
	
		$nowtime = time();
		$_rand = rand(1,900)/100000;
		$thisdatas = array();
		
		
		foreach ($pro as $k => $v) {
			//验证休市
			$isopen = ChickIsOpen($v['pid']);
			
			if(!$isopen){
				continue;
			}
	
	        if($v['procode'] == "btc" || $v['procode'] == "ltc" || $v['procode']=="eth" || $v['procode']=="etc" || $v['procode']=="ltc" || $v['procode']=="eos" || $v['procode']=="doge" || $v['procode']=="usdt"){
	
	            $minute = date('i',$nowtime);
	            if($minute >= 0 && $minute < 15){ $minute = 0;}
	            elseif($minute >= 15 && $minute < 30){ $minute = 15;}
	            elseif($minute >= 30 && $minute < 45){ $minute = 30;}
	            elseif($minute >= 45 && $minute < 60){ $minute = 45;}
	            $new_date = strtotime(date('Y-m-d H',$nowtime).':'.$minute.':00');
	
	            if($v['procode'] == 'btc'){
	                $url = 'http://api.bitkk.com/data/v1/ticker?market=btc_usdt';
	            }elseif($v['procode'] == 'ltc'){
	                $url = 'http://api.bitkk.com/data/v1/ticker?market=ltc_usdt';
	            }elseif($v['procode'] == 'eth'){
	                $url = 'http://api.bitkk.com/data/v1/ticker?market=eth_usdt';
	            }elseif($v['procode'] == 'etc'){
	                $url = 'http://api.bitkk.com/data/v1/ticker?market=etc_usdt';
	            }elseif($v['procode'] == 'ltc'){
	                $url = 'http://api.bitkk.com/data/v1/ticker?market=ltc_usdt';
	            }elseif($v['procode'] == 'eos'){
	                $url = 'http://api.bitkk.com/data/v1/ticker?market=eos_usdt';
	            }elseif($v['procode'] == 'doge'){
	                $url = 'http://api.bitkk.com/data/v1/ticker?market=doge_usdt';
	            }elseif($v['procode'] == 'usdt'){
	                $url = 'http://api.bitkk.com/data/v1/ticker?market=usdt_qc';
	            }
	            $getdata = $this->curlfun($url);
	            $res = json_decode($getdata,1);
	            $data_arr=$res['ticker'];
	            if(!is_array($data_arr)) continue;
	            $thisdata['Price'] = $this->fengkong($data_arr['sell'],$v);;
	            $thisdata['Open'] = $data_arr['buy'];
	            $thisdata['Close'] = $data_arr['last'];
	            $thisdata['High'] = $data_arr['high'];
	            $thisdata['Low'] = $data_arr['low'];
	            $thisdata['Diff'] = 0;
	            $thisdata['DiffRate'] = 0;
	            $thisdata['Name'] = $v['ptitle'];
	
	
	        }elseif(in_array($v['procode'],array(12,13,116,176,15,22114,32816,74,75))){  	//口袋贵金属
				/*$url = 'https://m.sojex.net/api.do?rtp=GetQuotesDetail&id='.$v['procode'];
				//$html = file_get_contents($url); 
				$html = $this->curlfunS($url);
				
		   		$res = json_decode($html,1);
		   
		   		$res = $res['data']['quotes'];

		   		$thisdata['Price'] = $this->fengkong($res['buy'],$v);
				$thisdata['Open'] = $res['open'];
				$thisdata['Close'] = $res['sell'];
				$thisdata['High'] = $res['top'];
				$thisdata['Low'] = $res['low'];
				$thisdata['Diff'] = 0;
				$thisdata['DiffRate'] = 0;*/
				
				switch($v['procode']){
                	case 12:	//黄金
                		$procode_str="hf_XAU";
                		break;
                	case 13:	//白银
                		$procode_str="hf_XAG";
                		break;
                	case 116:	//原油
                		$procode_str="hf_OIL";
                		break;
                // 	case 176:
                // 		$procode_str="";
                // 		break;
                // 	case 15:
                // 		$procode_str="";
                // 		break;
                // 	case 22114:
                // 		$procode_str="";
                // 		break;
                	case 32816:	//铜
                		$procode_str="nf_CU0";
                		break;
                	case 74:	//铂金
                		$procode_str="hf_XPT";
                		break;
                	case 75:	//钯金
                		$procode_str="hf_XPD";
                		break;								
                	default:
                		$procode_str="hf_XAG";
                }
                
                $url = "https://hq.sinajs.cn/rn=".time()."&list=$procode_str";
                $getdata = $this->curlfunS($url);
                
                // 8开盘价
                // 7昨结算
                // 5最低价
                // 4最高价
                // 0当前价
                // 2买一价
                // 3卖一价
                
                $data_arr = explode(',',$getdata);
                //var_dump($data_arr);
                if(!is_array($data_arr)) continue;
                if($procode_str=="nf_CU0"){     //如果是铜
                	// 3最高价
                	// 4最低价
                	// 8当前价
                	// 10昨结算
                	// 2开盘价
                   $thisdata['Price'] = $this->fengkong($data_arr[8],$v);
                   $thisdata['Open'] = $data_arr[2];
                   $thisdata['Close'] = $data_arr[10];
                   $thisdata['High'] = $data_arr[3];
                   $thisdata['Low'] = $data_arr[4];
                   $thisdata['Diff'] = 0;
                   $thisdata['DiffRate'] = 0;
                }else{
                    $cur_price=explode("=",$data_arr[0]);
                    $cur_price=trim($cur_price[1],'"');
                    $cur_price=floatval($cur_price);
                    $thisdata['Price'] = $this->fengkong($cur_price,$v);
                    $thisdata['Open'] = $data_arr[8];
                    $thisdata['Close'] = $data_arr[7];
                    $thisdata['High'] = $data_arr[4];
                    $thisdata['Low'] = $data_arr[5];
                    $thisdata['Diff'] = 0;
                    $thisdata['DiffRate'] = 0;
                }
                
                
	
			}elseif(in_array($v['procode'],array('llg','lls'))){ 
				$url = "https://www.91pme.com/marketdata/gethq?code=".$v['procode'];
				$html = $this->curlfun($url);
				$arr = json_decode($html,1);
				if(!isset($arr[0])) continue;
				$data_arr = $arr[0];
	
				$thisdata['Price'] = $this->fengkong($data_arr['buy'],$v);;
				$thisdata['Open'] = $data_arr['open'];
				$thisdata['Close'] = $data_arr['lastclose'];
				$thisdata['High'] = $data_arr['high'];
				$thisdata['Low'] = $data_arr['low'];
				$thisdata['Diff'] = 0;
				$thisdata['DiffRate'] = 0;
				
				
			}elseif($v['cid']==7){
			    				
	
			    if($v['procode']=='HSI'){
				$url = "http://hq.sinajs.cn/rn=".$nowtime."list=hk".$v['procode'];
				$getdata = $this->curlfun($url);
				$data_arr = explode(',',$getdata);
	
	            //$number = $data_arr[0];
	            //$result = substr($number,strripos($number,'=')+2);
				if(!is_array($data_arr) || count($data_arr) != 19) continue;
				$thisdata['Price'] = $this->fengkong($data_arr[6],$v);  //当前价格
				$thisdata['Open'] = $data_arr[2];  //开盘价
				$thisdata['Close'] = $data_arr[3];  //封盘价
				$thisdata['High'] = $data_arr[4];  //最高
				$thisdata['Low'] = $data_arr[5];   //最低
				$thisdata['Diff'] = 0;  //振幅
				$thisdata['DiffRate'] = 0;  //波幅			        
			    }else{
				$url = "http://hq.sinajs.cn/rn=".$nowtime."list=hf_".$v['procode'];
				$getdata = $this->curlfun($url);
				$data_arr = explode(',',$getdata);
	            $number = $data_arr[0];
	            $result = substr($number,strripos($number,'=')+2);
				if(!is_array($data_arr) || count($data_arr) != 15) continue;
				$thisdata['Price'] = $this->fengkong($result,$v);  //当前价格
				$thisdata['Open'] = $data_arr[8];  //开盘价
				$thisdata['Close'] = $data_arr[3];  //封盘价
				$thisdata['High'] = $data_arr[4];  //最高
				$thisdata['Low'] = $data_arr[5];   //最低
				$thisdata['Diff'] = 0;  //振幅
				$thisdata['DiffRate'] = 0;  //波幅	
			    }
			}else{
			    
				$url = "http://hq.sinajs.cn/rn=".$nowtime."list=".$v['procode'];
	
				$getdata = $this->curlfun($url);
				$data_arr = explode(',',$getdata);
	
	            //$number = $data_arr[0];
	            //$result = substr($number,strripos($number,'=')+2);
			    if($v['procode']=='sh603393'){
				if(!is_array($data_arr) || count($data_arr) != 34) continue;
				$thisdata['Price'] = $this->fengkong($data_arr[3],$v);  //当前价格
				$thisdata['Open'] = $data_arr[1];  //开盘价
				$thisdata['Close'] = $data_arr[2];  //封盘价
				$thisdata['High'] = $data_arr[4];  //最高
				$thisdata['Low'] = $data_arr[5];   //最低
				$thisdata['Diff'] = 0;  //振幅
				$thisdata['DiffRate'] = 0;  //波幅			        
			        
			        
			        
			    }else{
	
				if(!is_array($data_arr) || count($data_arr) != 18) continue;
				$thisdata['Price'] = $this->fengkong($data_arr[1],$v);  //当前价格
				$thisdata['Open'] = $data_arr[5];  //开盘价
				$thisdata['Close'] = $data_arr[3];  //封盘价
				$thisdata['High'] = $data_arr[6];  //最高
				$thisdata['Low'] = $data_arr[7];   //最低
				$thisdata['Diff'] = $data_arr[12];  //振幅
				$thisdata['DiffRate'] = $data_arr[4]/10000;  //波幅
	            }
			}
			
			
			$thisdata['Name'] = $v['ptitle'];
			$thisdata['UpdateTime'] = $nowtime;
			$thisdata['pid'] = $v['pid'];
	
			$thisdatas[$v['pid']] = $thisdata;
			//$ids =Db::name('productdata')->where('pid',$v['pid'])->update($thisdata);
	
			
		}
		cache('nowdata',$thisdatas);
		$pro = cache('nowdata');
		
				
		
	}
		
	/**
	 * 全局平仓
	 * @return [type] [description]
	 */
	public function order()
	{
		$nowtime = time();
		$s_rand = rand(6,12);
		$db_order = db('order');
		$db_userinfo = db('userinfo');
		//订单列表
		$map['ostaus'] = 0;
		$map['selltime'] = array('elt',$nowtime+$s_rand );
		$_orderlist = Db::name('order')->where($map)->limit(0,50)->select();
		
		$data_info = db('productinfo');

		

		//风控参数
		$risk = db('risk')->find();

		//此刻产品价格
		$p_map['isdelete'] = 0;
		$pro = db('productdata')->field('pid,Price')->where($p_map)->select();
		$prodata = array();
		foreach ($pro as $k => $v) {
			
			$_pro = cache('nowdata');

			if(!isset($_pro[$v['pid']])){
				
				continue;
			}
			$prodata[$v['pid']] = $this->order_type($_orderlist,$_pro[$v['pid']],$risk,$data_info);
			// dump($prodata);
			// //echo '---------------------------------------------------';
		}

		//订单列表
		$map['ostaus'] = 0;
		$map['selltime'] = array('elt',$nowtime);
		$orderlist = Db::name('order')->where($map)->limit(0,50)->select();
		
		//exit;
		if(!$orderlist){
			return false;
		}

		//循环处理订单
		$nowtime = time();
		foreach ($orderlist as $k => $v) {
            $v_oid=$v['oid'];
			$log_excist=Db::name('price_log')->where(['oid'=>$v_oid,'title'=>'结单'])->find();
			
			if(!is_null($log_excist)){
			    //file_put_contents('log_sql.txt',print_r($log_excist,true));
				continue;
			}
			//此刻可平仓价位
			$sellprice = isset($prodata[$v['pid']])?$prodata[$v['pid']]:0;
			
			//买入价
			$buyprice = $v['buyprice'];
			$fee = $v['fee'];

			$order_cha = round(floatval($sellprice)-floatval($buyprice),6);
			
			//买涨
			if($v['ostyle'] == 0 && $nowtime >= $v['selltime']){

				if($order_cha > 0){  //盈利
					$yingli = $v['fee']*($v['endloss']/100);
					$d_map['is_win'] = 1;
					

					//平仓增加用户金额
                   	$u_add = $yingli + $fee;
                   	Db::startTrans();
                    try{
                       
                        $order_log_excist=Db::name('order_log')->where(['oid'=>$v_oid])->find();
			
            			if(!is_null($order_log_excist)){
            			    //file_put_contents('log_sql.txt',print_r($order_log_excist,true)."--1527");
            			    Db::rollback();
            				continue;
            			}else{
            			    $o_log['uid'] = $v['uid'];
                    	   	$o_log['oid'] = $v['oid'];
                    	   	$o_log['addprice'] = $u_add;
                    	   	$o_log['addpoint'] = 0;
                    	   	$o_log['time'] = time();
                    	   	$o_log['user_money'] =Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
                    	   	$rs_order_log=Db::name('order_log')->insert($o_log);
                    	   	
                    	   		$price_log_excist=Db::name('price_log')->where(['oid'=>$v_oid,'title'=>'结单'])->find();
			
                    			if(!is_null($price_log_excist)){
                    			    //file_put_contents('log_sql.txt',print_r($price_log_excist,true)."--1542");
                    			    Db::rollback();
                    				continue;
                    			}else{
                    			    //资金日志
	   	                            //set_price_log($v['uid'],1,$addprice,'结单','订单到期获利结算',$v['oid'],$o_log['user_money']);
                    			    $price_log_data['uid'] = $v['uid'];
                                	$price_log_data['type'] = 1;
                                	$price_log_data['account'] = $u_add;
                                	$price_log_data['title'] = '结单';
                                	$price_log_data['content'] = '订单到期获利结算';
                                	$price_log_data['oid'] = $v['oid'];
                                	$price_log_data['time'] = time();
                                	$price_log_data['nowmoney'] = $o_log['user_money'];
                                	$heheda=Db::name('price_log')->insert($price_log_data);
                                	if($heheda>0){
                                	    Db::name('userinfo')->where('uid',$v['uid'])->setInc('usermoney',$u_add);

                                        Db::commit();
                                	}else{
                                	    Db::rollback();
                                	}
                                	 
                    			}
            			}
                           
                    } catch (\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                    }

				}elseif($order_cha < 0){	//亏损
					$yingli = -1*$v['fee'];
					$d_map['is_win'] = 2;

				}else{		//无效
					$yingli = 0;
					$d_map['is_win'] = 3;

					//平仓增加用户金额
                   	$u_add = $fee;
                   	Db::startTrans();
                    try{
                        
                        $order_log_excist=Db::name('order_log')->where(['oid'=>$v_oid])->find();
			
            			if(!is_null($order_log_excist)){
            			    //file_put_contents('log_sql.txt',print_r($order_log_excist,true)."--1527");
            			    Db::rollback();
            				continue;
            			}else{
            			    $o_log['uid'] = $v['uid'];
                    	   	$o_log['oid'] = $v['oid'];
                    	   	$o_log['addprice'] = $u_add;
                    	   	$o_log['addpoint'] = 0;
                    	   	$o_log['time'] = time();
                    	   	$o_log['user_money'] =Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
                    	   	$rs_order_log=Db::name('order_log')->insert($o_log);
                    	   	
                    	   		$price_log_excist=Db::name('price_log')->where(['oid'=>$v_oid,'title'=>'结单'])->find();
			
                    			if(!is_null($price_log_excist)){
                    			    //file_put_contents('log_sql.txt',print_r($price_log_excist,true)."--1542");
                    			    Db::rollback();
                    				continue;
                    			}else{
                    			    //资金日志
	   	                            //set_price_log($v['uid'],1,$addprice,'结单','订单到期获利结算',$v['oid'],$o_log['user_money']);
                    			    $price_log_data['uid'] = $v['uid'];
                                	$price_log_data['type'] = 1;
                                	$price_log_data['account'] = $u_add;
                                	$price_log_data['title'] = '结单';
                                	$price_log_data['content'] = '订单到期获利结算';
                                	$price_log_data['oid'] = $v['oid'];
                                	$price_log_data['time'] = time();
                                	$price_log_data['nowmoney'] = $o_log['user_money'];
                                	$heheda=Db::name('price_log')->insert($price_log_data);
                                	if($heheda>0){
                                	    Db::name('userinfo')->where('uid',$v['uid'])->setInc('usermoney',$u_add);

                                        Db::commit();
                                	}else{
                                	    Db::rollback();
                                	}
                    			}
            			}
                           
                    } catch (\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                    }
				}

				//平仓处理订单
				$d_map['ostaus'] = 1;
				$d_map['sellprice'] = $sellprice;
				$d_map['ploss'] = $yingli;
				$d_map['oid'] = $v['oid'];
				Db::name('order')->update($d_map);




			//买跌
			}elseif($v['ostyle']==1 && $nowtime >= $v['selltime']){



				if($order_cha < 0){  //盈利
					$yingli = $v['fee']*($v['endloss']/100);
					$d_map['is_win'] = 1;
					

					//平仓增加用户金额
                   	$u_add = $yingli + $fee;
                   	Db::startTrans();
                    try{
                        
                        $order_log_excist=Db::name('order_log')->where(['oid'=>$v_oid])->find();
			
            			if(!is_null($order_log_excist)){
            			    //file_put_contents('log_sql.txt',print_r($order_log_excist,true)."--1527");
            			    Db::rollback();
            				continue;
            			}else{
            			    $o_log['uid'] = $v['uid'];
                    	   	$o_log['oid'] = $v['oid'];
                    	   	$o_log['addprice'] = $u_add;
                    	   	$o_log['addpoint'] = 0;
                    	   	$o_log['time'] = time();
                    	   	$o_log['user_money'] =Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
                    	   	$rs_order_log=Db::name('order_log')->insert($o_log);
                    	   	
                    	   		$price_log_excist=Db::name('price_log')->where(['oid'=>$v_oid,'title'=>'结单'])->find();
			
                    			if(!is_null($price_log_excist)){
                    			    //file_put_contents('log_sql.txt',print_r($price_log_excist,true)."--1542");
                    			    Db::rollback();
                    				continue;
                    			}else{
                    			    //资金日志
	   	                            //set_price_log($v['uid'],1,$addprice,'结单','订单到期获利结算',$v['oid'],$o_log['user_money']);
                    			    $price_log_data['uid'] = $v['uid'];
                                	$price_log_data['type'] = 1;
                                	$price_log_data['account'] = $u_add;
                                	$price_log_data['title'] = '结单';
                                	$price_log_data['content'] = '订单到期获利结算';
                                	$price_log_data['oid'] = $v['oid'];
                                	$price_log_data['time'] = time();
                                	$price_log_data['nowmoney'] = $o_log['user_money'];
                                	$heheda=Db::name('price_log')->insert($price_log_data);
                                	if($heheda>0){
                                	    Db::name('userinfo')->where('uid',$v['uid'])->setInc('usermoney',$u_add);

                                        Db::commit();
                                	}else{
                                	    Db::rollback();
                                	}
                    			}
            			}
                           
                    } catch (\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                    }


				}elseif($order_cha > 0){	//亏损
					$yingli = -1*$v['fee'];
					$d_map['is_win'] = 2;

				}else{		//无效
					$yingli = 0;
					$d_map['is_win'] = 3;

					//平仓增加用户金额
                   	$u_add = $fee;
                   	Db::startTrans();
                    try{
                        
                        $order_log_excist=Db::name('order_log')->where(['oid'=>$v_oid])->find();
			
            			if(!is_null($order_log_excist)){
            			    //file_put_contents('log_sql.txt',print_r($order_log_excist,true)."--1527");
            			    Db::rollback();
            				continue;
            			}else{
            			    $o_log['uid'] = $v['uid'];
                    	   	$o_log['oid'] = $v['oid'];
                    	   	$o_log['addprice'] = $u_add;
                    	   	$o_log['addpoint'] = 0;
                    	   	$o_log['time'] = time();
                    	   	$o_log['user_money'] =Db::name('userinfo')->where('uid',$v['uid'])->value('usermoney');
                    	   	$rs_order_log=Db::name('order_log')->insert($o_log);
                    	   	
                    	   		$price_log_excist=Db::name('price_log')->where(['oid'=>$v_oid,'title'=>'结单'])->find();
			
                    			if(!is_null($price_log_excist)){
                    			    //file_put_contents('log_sql.txt',print_r($price_log_excist,true)."--1542");
                    			    Db::rollback();
                    				continue;
                    			}else{
                    			    //资金日志
	   	                            //set_price_log($v['uid'],1,$addprice,'结单','订单到期获利结算',$v['oid'],$o_log['user_money']);
                    			    $price_log_data['uid'] = $v['uid'];
                                	$price_log_data['type'] = 1;
                                	$price_log_data['account'] = $u_add;
                                	$price_log_data['title'] = '结单';
                                	$price_log_data['content'] = '订单到期获利结算';
                                	$price_log_data['oid'] = $v['oid'];
                                	$price_log_data['time'] = time();
                                	$price_log_data['nowmoney'] = $o_log['user_money'];
                                	$heheda=Db::name('price_log')->insert($price_log_data);
                                	if($heheda>0){
                                	    Db::name('userinfo')->where('uid',$v['uid'])->setInc('usermoney',$u_add);

                                        Db::commit();
                                	}else{
                                	    Db::rollback();
                                	}
                    			}
            			}
                           
                    } catch (\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                    }
				}

				//平仓处理订单
				$d_map['ostaus'] = 1;
				$d_map['sellprice'] = $sellprice;
				$d_map['ploss'] = $yingli;
				$d_map['oid'] = $v['oid'];
				$db_order->update($d_map);



			}



		}
		
	}	
}
