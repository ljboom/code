<?php
namespace app\push\controller;
use think\worker\Server;
use Workerman\Lib\Timer;
use think\Db;
use think\Request;
use think\Cache;
class Shichang extends Server
{	
    protected $socket = 'websocket://0.0.0.0:2004';
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
		Timer::add(5, function()use($worker)
		{	
			if(iskaipan()){
				$cagetory_shangshi=Db::name('category')->where(['pid'=>1,'status'=>'normal'])->field('id')->select();
				$arr_shangshi=array();
				foreach($cagetory_shangshi as $v){
					$arr_shangshi[]=$v['id'];
				}
				$rs_shangshi=Db::name('product')->where(['show_switch'=>1,'category_id'=>['in',$arr_shangshi]])->order('weigh desc')->select();
				
				$cagetory_shanggui=Db::name('category')->where(['pid'=>2,'status'=>'normal'])->field('id')->select();
				$arr_shanggui=array();
				foreach($cagetory_shanggui as $v){
					$arr_shanggui[]=$v['id'];
				}
				$rs_shanggui=Db::name('product')->where(['show_switch'=>1,'category_id'=>['in',$arr_shanggui]])->order('weigh desc')->select();
				
				$result=array(
					'shangshi'=>$rs_shangshi,
					'shanggui'=>$rs_shanggui,
				);
				
				$str=json_encode($result);
				foreach($worker->connections as $connection)
				{
					$connection->send($str);
				}
			}
			
		});
		
		Timer::add(60, function()use($worker)
		{	
			if($worker->id === 0){
		    	echo "开始更新成交额\n";
				$selectData=Db::name('product')->where('turnover_section','not null')->select();
				foreach($selectData as $v){
				    $turnover_section = $v['turnover_section'];
				    $turnover_section = explode('-',$turnover_section);
				    $minNum = $turnover_section[0];
				    $maxNum = $turnover_section[1];
				    if(!empty($v['turnover'])){
				        $minNum = $v['turnover'];
				    }
					$suiji = mt_rand($minNum, $maxNum);
					Db::name('product')->where('id',$v['id'])->update(['turnover'=>$suiji]);
					echo "更新成交额成功\n";
				}
			}
			
		});
    }
	
	

}	
