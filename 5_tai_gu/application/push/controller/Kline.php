<?php

namespace app\push\controller;

use think\worker\Server;
use Workerman\Lib\Timer;
use think\Db;
use think\Request;
use think\Cache;

class Kline extends Server
{
	protected $socket = 'websocket://0.0.0.0:2003';
	public static $i = 0;
	public $opentime = "";
	public $closetime = "";
	public $api_url = "http://www.ming666.top";

	/**
	 * 收到信息
	 * @param $connection
	 * @param $data
	 */
	public function onMessage($connection, $data)
	{
		// 後面關閉
		if (iskaipan()) {
			if (strpos($data, "getzhishuk_") !== false) {
				$arr = explode("_", $data);
				//getk_1_5
				$pro_id = $arr[1];
				$interval = $arr[2];

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
				    
					$connection->send(json_encode($result));
				}

			} else if (strpos($data, "getgupiaok_") !== false) {
				$arr = explode("_", $data);
				//getk_1_5
				$pro_id = $arr[1];
				$interval = $arr[2];

				$pro = Db::name('product')->where('id', $pro_id)->find();
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
    				
					$connection->send(json_encode($result));
				}
			}

		}
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

	}

	/**
	 * 获取K线。缓存起来
	 * @author lukui  2017-08-13
	 * @return [type] [description]
	 */


	public function curlfunS($url)
	{
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
}
