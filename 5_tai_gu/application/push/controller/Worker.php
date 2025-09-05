<?php
namespace app\push\controller;
use think\worker\Server;
use Workerman\Lib\Timer;
use think\Db;
use think\Request;
use think\Cache;
class Worker extends Server
{	
    protected $socket = 'websocket://0.0.0.0:2001';
	public static $i=0;
	public $opentime="";
	public $closetime="";
	
	public $api_url = "https://ws.api.cnyes.com";
	
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {

		if($data=="index_zhishu"){
			$rs_zhishu=Db::name('zhishu')->where('show_switch',1)->order('weigh desc')->limit(3)->select();
			$str=json_encode($rs_zhishu);
			$connection->send($str);
		}else if(strpos($data,"getzhishu")!==false){
			$arr=explode("_",$data);
			$pro_id=intval($arr[1]);
			$rs_zhishu=Db::name('zhishu')->where('id',$pro_id)->field('name,price,zhangdieshu,zhangdiebaifenbi,open,close,high,low,vol,turnover')->find();
			if(!is_null($rs_zhishu)){
				$connection->send(json_encode($rs_zhishu));
			}
			
		}else if(strpos($data,"getgupiao")!==false){
			$arr=explode("_",$data);
			$pro_id=intval($arr[1]);
			$rs_product=Db::name('product')->where('id',$pro_id)->field('name,price,zhangdieshu,zhangdiebaifenbi,open,close,high,low,vol,turnover')->find();
			if(!is_null($rs_product)){
				$connection->send(json_encode($rs_product));
			}
		}
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
        if($worker->id === 0){
    		//采集数据
    		Timer::add(60, function()use($worker)
    		{	
    		    echo "第{$worker->id}开始定时执行股票采集\n";
    			if(iskaipan()){
    				$this->getdata();
    			}
    		});
        }
        if($worker->id === 1){
    		//采集数据
    		Timer::add(60, function()use($worker)
    		{	
    		    echo "第{$worker->id}开始定时执行指数采集\n";
    			$this->getzhishudata();
    		});
        }
        //采集数据
    	Timer::add(120, function()use($worker)
    	{	
    	    echo "第{$worker->id}开始定时执行新股采集\n";
    		$this->get_xingu_data();
    	});
		
		//结算订单
		/* Timer::add(2, function()use($worker)	
		{
			$this->order();
			//Db::close();
		}); */
    }
	
	/**
	 * 获取K线。缓存起来
	 * @author lukui  2017-08-13
	 * @return [type] [description]
	 */
	public function cachekline()
	{
		
		$pro =Db::name('product')->field('pid')->where('isdelete',0)->select();
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
	
	public function get_xingu_data(){
	    $url = "https://marketinfo.api.cnyes.com/mi/api/v1/publicsubscription?page=1&limit=900";
        $html = send_http($url,[],'GET');
        if(!$html){
            echo "新股未读取到数据\n";
            return "";
        }
        $_data_arr = json_decode($html, true);
        $_data_arr = empty($_data_arr['data']['items'])?[]:$_data_arr['data']['items'];
        if(empty($_data_arr)){
            echo "新股数据不正确\n";
            return "";
        }
        foreach ($_data_arr as $item){
            $check_find = Db::name('xingu')->where('shuzidaima',$item['code'])->find();
            $data = [
                'name' => $item['name'],
                'zimudaima' => $item['symbolId'],
                'shuzidaima' => $item['code'],
                'shijia' => $item['last'],
                'chengxiaojia' => $item['offeringPrice'],
                'zongshengou' => $item['offeringShares'],
                'chouqiandate' => $item['drawDate'],
                'kaifangdate' => $item['subscriptionStartDate'],
                'jiezhidate' => $item['subscriptionEndDate'],
                'faquan_date' => $item['listingDate'],
                'updatetime' => time(),
                'status' => $item['isSubscribing']?1:2,
                'shichanglist' => strstr($item['issuanceMarket'], '上市')?1:2,
                'weigh' => 1,
            ];
            if(!$check_find){
                Db::name('xingu')->insert($data);
            }else{
                unset($data['weigh']);
                if(empty($data['shijia'])){
                    unset($data['shijia']);
                }
                Db::name('xingu')->where('shuzidaima',$item['code'])->update($data);
            }
        }
        echo "新股数据采集完成\n";
	}
	
	public function getzhishudata(){
		$rs_pro=Db::name('zhishu')->where('show_switch',1)->order('weigh desc')->limit(3)->select();
		foreach ($rs_pro as $pro) {
		    $thisdataId = $pro['id'];
		    $daima = $pro['zimudaima'];
            echo "指数{$daima}开始更新\n";
            $url = $this->api_url."/ws/api/v1/quote/quotes/TWS:{$daima}:INDEX";
            $html = send_http($url,[],'GET');
            if(!$html){
                echo "指数{$daima}未读取到数据\n";
                continue; 
            }
            $_data_arr = json_decode($html, true);
            $_data_arr = empty($_data_arr['data'])?[]:$_data_arr['data'];
            if(!isset($_data_arr[0])){
                echo "指数{$daima}数据下标不正确\n";
                continue;
            }
            $_data_arr = $_data_arr[0];
            $thisdata = [
               'zhangdieshu' => empty($_data_arr['11'])?0:$_data_arr['11'],
               'zhangdiebaifenbi' => empty($_data_arr['56'])?0:$_data_arr['56'],
               'price' => empty($_data_arr['6'])?0:$_data_arr['6'],
               'open' => empty($_data_arr['12'])?0:$_data_arr['12'],
               'close' => empty($_data_arr['19'])?0:$_data_arr['19'],
               'high' => empty($_data_arr['75'])?0:$_data_arr['75'],
               'low' => empty($_data_arr['13'])?0:$_data_arr['13'],
               'vol' => empty($_data_arr['800001'])?0:$_data_arr['800001'],
               'updatetime' => time(),
            ];
            Db::name('zhishu')->where('id',$thisdataId)->update($thisdata);
            echo "指数{$daima}更新完成\n";
		}
	}
	
	//采集数据
	public function getdata(){
	    ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.  
        set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
		//比较是不是在开盘时间内
		/* $nowtime=time();
		$date_str1=date("Y-m-d",$nowtime)." ".$this->opentime;
		$date_str2=date("Y-m-d",$nowtime)." ".$this->closetime;
		if($nowtime<strtotime($date_str1) || $nowtime>strtotime($date_str2)){
			return '不在交易时间';
		} */
		$tempdata=array();
		
		Db::name('product')->chunk(100, function($rs_pro) use (&$tempdata){
            foreach ($rs_pro as $pro) {
                $thisdataId = $pro['id'];
                $daima = $pro['shuzidaima'];
                echo "{$daima}开始更新\n";
                $url = $this->api_url."/ws/api/v1/quote/quotes/TWS:{$daima}:STOCK";
            	$html = send_http($url,[],'GET');
            	if(!$html){
                    // echo "{$daima}未读取到数据\n";
                    continue; 
            	}
            	$_data_arr = json_decode($html, true);
                $_data_arr = empty($_data_arr['data'])?[]:$_data_arr['data'];
                if(!isset($_data_arr[0])){
                    // echo "{$daima}数据下标不正确\n";
                    continue;
                }
                $_data_arr = $_data_arr[0];
                $thisdata = [
                   'zhangdieshu' => empty($_data_arr['11'])?0:$_data_arr['11'],
                   'zhangdiebaifenbi' => empty($_data_arr['56'])?0:$_data_arr['56'],
                   'price' => empty($_data_arr['6'])?0:$_data_arr['6'],
                   'open' => empty($_data_arr['12'])?0:$_data_arr['12'],
                   'close' => empty($_data_arr['19'])?0:$_data_arr['19'],
                   'high' => empty($_data_arr['75'])?0:$_data_arr['75'],
                   'low' => empty($_data_arr['13'])?0:$_data_arr['13'],
                   'vol' => empty($_data_arr['800001'])?0:$_data_arr['800001'],
                   'updatetime' => time(),
                ];
                Db::name('product')->where('id',$thisdataId)->update($thisdata);
    			$tempdata['pro_'.$thisdataId]=$thisdata;
                echo "{$daima}股票更新成功\n";
				
				//刷新盘口数据
        		$arr=range(100000,999999);
        		shuffle($arr);
        		$random_keys=array_rand($arr,10);
        		$pankou=Db::name('pankou')->where('product_id',$thisdataId)->find();
        		$nowprice=floatval($thisdata['price']);
        		if(!$pankou){
        			Db::name('pankou')->insert([
        			'product_id'=>$thisdataId,
        			'buy1_price'=>$nowprice,
        			'buy1_num'=>$arr[$random_keys[0]],
        			'buy2_price'=>$nowprice-0.01,	
        			'buy2_num'=>$arr[$random_keys[1]],
        			'buy3_price'=>$nowprice-0.02,
        			'buy3_num'=>$arr[$random_keys[2]],
        			'buy4_price'=>$nowprice-0.03,
        			'buy4_num'=>$arr[$random_keys[3]],
        			'buy5_price'=>$nowprice-0.04,
        			'buy5_num'=>$arr[$random_keys[4]],
        			'sell1_price'=>$nowprice+0.01,
        			'sell1_num'=>$arr[$random_keys[5]],
        			'sell2_price'=>$nowprice+0.02,
        			'sell2_num'=>$arr[$random_keys[6]],
        			'sell3_price'=>$nowprice+0.03,
        			'sell3_num'=>$arr[$random_keys[7]],
        			'sell4_price'=>$nowprice+0.04,
        			'sell4_num'=>$arr[$random_keys[8]],
        			'sell5_price'=>$nowprice+0.05,
        			'sell5_num'=>$arr[$random_keys[9]],
        			'updatetime'=>time(),
        			]);
        		}else{
        			Db::name('pankou')->where('product_id',$thisdataId)->update([
        			'buy1_price'=>$nowprice,
        			'buy1_num'=>$arr[$random_keys[0]],
        			'buy2_price'=>$nowprice-0.01,	
        			'buy2_num'=>$arr[$random_keys[1]],
        			'buy3_price'=>$nowprice-0.02,
        			'buy3_num'=>$arr[$random_keys[2]],
        			'buy4_price'=>$nowprice-0.03,
        			'buy4_num'=>$arr[$random_keys[3]],
        			'buy5_price'=>$nowprice-0.04,
        			'buy5_num'=>$arr[$random_keys[4]],
        			'sell1_price'=>$nowprice+0.01,
        			'sell1_num'=>$arr[$random_keys[5]],
        			'sell2_price'=>$nowprice+0.02,
        			'sell2_num'=>$arr[$random_keys[6]],
        			'sell3_price'=>$nowprice+0.03,
        			'sell3_num'=>$arr[$random_keys[7]],
        			'sell4_price'=>$nowprice+0.04,
        			'sell4_num'=>$arr[$random_keys[8]],
        			'sell5_price'=>$nowprice+0.05,
        			'sell5_num'=>$arr[$random_keys[9]],
        			'updatetime'=>time(),
        			]);
        		}
        		
        		//将挂单中的订单，扫掉买入
        		Db::name('chicang')->where(['fangxiang_data'=>1,'price'=>['>=',$nowprice],'status'=>4])->update(['status'=>1]);
        		Db::name('chicang')->where(['fangxiang_data'=>0,'price'=>['<=',$nowprice],'status'=>4])->update(['status'=>1]);
        		
        		//实时更新持仓中的订单盈亏
        		$orders=Db::name('chicang')->where(['pro_id'=>$thisdataId,'status'=>1])->select();
        		foreach($orders as $k=>$v){
        			if($v['fangxiang_data']=='1'){	//如果是多单
        				$yingkui=($nowprice-$v['price'])*$v['shuliang'];
        			}else{	//如果是空单
        				$yingkui=-($nowprice-$v['price'])*$v['shuliang'];
        			}
        			Db::name('chicang')->where(['id'=>$v['id']])->update(['yingkui'=>$yingkui]);
        		}
            }
        });
		Cache::set('nowdata', $tempdata);
		echo "采集数据全部完成\n";
	}
	
	public function getkdata($pid=null,$interval=null){
		$pid = empty($pid)?input('param.pid'):$pid;
		$pro = Db::name('product')->where('id',$pid)->find();
		if(is_null($pro)){
			$this->error('不存在');
		}
		$year = date('Y_n_j',time());
		$is_day=false;
		$nowtime = time().rand(100,999);
		if($interval == 'd'){
			$interval =date('Y_m_d');
			$is_day=true;
		} 
		if($is_day){
			$geturl="https://stock.finance.sina.com.cn/usstock/api/jsonp_v2.php/var%20_".strtoupper($pro['zimudaima'])."_60_$nowtime=/US_MinKService.getDailyK?symbol=".strtoupper($pro['zimudaima'])."&type=5&___qn=3";
		}else{
			$geturl="https://stock.finance.sina.com.cn/usstock/api/jsonp_v2.php/var%20_".strtoupper($pro['zimudaima'])."_$interval"."_$nowtime=/US_MinKService.getMinK?symbol=".strtoupper($pro['zimudaima'])."&type=$interval&___qn=3";
		}
	
		$html = $this->curlfunS($geturl);
		//$html=htmlspecialchars($html);
		$html=ltrim($html,"/*<script>location.href='//sina.com';</script>*/");
		$k_data=explode("=",$html);
		$k_data=$k_data[1];
		$k_data=ltrim($k_data,"(");
		$k_data=rtrim($k_data,");");
		
		$this->success($k_data);
	
		
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
	
	
	    /**
     * 发起一个请求
     * @param $url
     * @param $params
     * @param string $method
     * @param array $header
     * @param false $multi
     * @return bool|string
     */
    // public function send_http($url, $params, $method = 'GET', $header = array(), $multi = false){
    //     $opts = array(
    //         CURLOPT_TIMEOUT        => 30,
    //         CURLOPT_RETURNTRANSFER => 1,
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_SSL_VERIFYHOST => false,
    //         CURLOPT_HTTPHEADER     => $header
    //     );
    //     switch(strtoupper($method)){
    //         case 'GET':
    //             $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
    //             break;
    //         case 'POST':
    //             $params = $multi ? $params : http_build_query($params);
    //             $opts[CURLOPT_URL] = $url;
    //             $opts[CURLOPT_POST] = 1;
    //             $opts[CURLOPT_POSTFIELDS] = $params;
    //             break;
    //         default:
    //             return false;
    //     }
    //     $ch = curl_init();
    //     curl_setopt_array($ch, $opts);
    //     $data  = curl_exec($ch);
    //     $error = curl_error($ch);
    //     curl_close($ch);
    //     if ($error){
    //         return false;
    //     }
    //     return  $data;
    // }
}
