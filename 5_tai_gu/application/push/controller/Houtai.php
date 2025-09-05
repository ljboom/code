<?php
namespace app\push\controller;
use think\worker\Server;
use Workerman\Lib\Timer;
use think\Db;
use think\Request;
use think\Cache;
class Houtai extends Server
{	
    protected $socket = 'websocket://0.0.0.0:2006';
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
		Timer::add(6, function()use($worker)
		{	
			$chongzhi=Db::name('chongzhi')->where(['status'=>0])->count();
			$tixian=Db::name('tixian')->where(['status'=>0])->count();
			$result=array(
				'chongzhi'=>$chongzhi,
				'tixian'=>$tixian,
			);
			$str=json_encode($result);
			
			foreach($worker->connections as $connection)
			{
				$connection->send($str);
			}
			
		});
    }
	
	

}	
