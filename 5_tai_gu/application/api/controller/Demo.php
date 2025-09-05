<?php

namespace app\api\controller;

use app\common\controller\Api;

use think\Db;
use think\Log;

/**
 * 示例接口
 */
class Demo extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['test', 'test_get', 'test1'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test2'];

	
	public $api_url = "https://ws.api.cnyes.com";
    /**
     * 测试方法
     *
     * @ApiTitle    (测试名称)
     * @ApiSummary  (测试描述信息)
     * @ApiMethod   (POST)
     * @ApiRoute    (/api/demo/test/id/{id}/name/{name})
     * @ApiHeaders  (name=token, type=string, required=true, description="请求的Token")
     * @ApiParams   (name="id", type="integer", required=true, description="会员ID")
     * @ApiParams   (name="name", type="string", required=true, description="用户名")
     * @ApiParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据")
     * @ApiReturnParams   (name="code", type="integer", required=true, sample="0")
     * @ApiReturnParams   (name="msg", type="string", required=true, sample="返回成功")
     * @ApiReturnParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据返回")
     * @ApiReturn   ({
         'code':'1',
         'msg':'返回成功'
        })
     */
    public function test()
    {
        $rs_pro = Db::name('product')->order('id','ASC')->select();
        foreach ($rs_pro as $pro) {
            $thisdataId = $pro['id'];
            $daima = $pro['shuzidaima'];
            $url = $this->api_url."/ws/api/v1/quote/quotes/TWS:{$daima}:STOCK";
        	$html = send_http($url,[],'GET');
        	if(!$html){
                continue; 
        	}
        	$_data_arr = json_decode($html, true);
            $_data_arr = empty($_data_arr['data'])?[]:$_data_arr['data'];
            if(!isset($_data_arr[0])){
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
               'low' => empty($_data_arr['13'])?0:0,
               'vol' => empty($_data_arr['800001'])?0:$_data_arr['800001'],
               'updatetime' => time(),
            ];
            Db::name('product')->where('id',$thisdataId)->update($thisdata);
			$tempdata['pro_'.$thisdataId]=$thisdata;
			
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
        echo "OK";
    }

    public function test_get(){
        $oldData = Db::name('stock')->select();
        foreach ($oldData as $item){
            // 查询分类
            $stock_type_code = $item['stock_type_code'];
            $class_id = Db::name('category')->where('class_id', $stock_type_code)->value('id');
            if(!$class_id){
                $class_id = Db::name('category')->insertGetId([
                    'pid' => $item['exchange']=='TAI'?1:2,
                    'class_id' => $stock_type_code,
                    'name' => $item['stock_type_str'],
                    'nickname' => $item['stock_type_str'],
                    'status' =>'normal',
                    'type' => 'product',
                ]);
            }
            Db::name('product')->insertGetId([
                'category_id' => $class_id,
                'name' => $item['stock_name'],
                'zimudaima' => $item['stock_gid'],
                'shuzidaima' => $item['stock_code'],
            ]);
        }
        echo "执行完毕";
// 		Cache::set('nowdata', $tempdata);
    }

    /**
     * 无需登录的接口
     *
     */
    public function test1()
    {
        $data = json_decode(send_http('http://b.workingman.icu/stock/api/stock/getStockType',[]), true);
        $data = $data['rows'];
        foreach ($data as $item){
            $class_id = Db::name('category')->where('class_id', $item['type'])->value('id');
            if($class_id){
               continue; 
            }
            $className = $item['name'];
            $classId = $item['type'];
            $classId = Db::name('category')->insertGetId([
                'pid' => $item['exchange']=='TAI'?1:2,
                'class_id' => $classId,
                'name' => $className,
                'nickname' => $className,
                'status' =>'normal',
                'type' => 'product',
            ]);
        }
    }

    /**
     * 需要登录的接口
     *
     */
    public function test2()
    {
        $this->success('返回成功', ['action' => 'test2']);
    }

    /**
     * 需要登录且需要验证有相应组的权限
     *
     */
    public function test3()
    {
        $this->success('返回成功', ['action' => 'test3']);
    }

}
