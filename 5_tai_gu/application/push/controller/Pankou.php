<?php
namespace app\push\controller;
use think\worker\Server;
use Workerman\Lib\Timer;
use think\Db;
use think\Request;
use think\Cache;
class Pankou extends Server
{	
    protected $socket = 'websocket://0.0.0.0:2005';
	protected $processes = 1;
	public static $i=0;
	public $opentime="";
	public $closetime="";
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {

			if(strpos($data,"getpankou")!==false){
				$arr=explode("_",$data);
				$pro_id=intval($arr[1]);
				$rs_pankou=Db::name('pankou')->where('product_id',$pro_id)->find();
				$str=json_encode($rs_pankou);
				$connection->send($str);
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

    }
	
	

}	
