<?php
// +----------------------------------------------------------------------
// | Yzncms [ 御宅男工作室 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://yzncms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 御宅男 <530765310@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 买卖档model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\Db;

class QstockAskBid extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qstock_ask_bid';
    
    private  $api_type  = 'twse';
    // protected $is_show = ['is_show' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
    
    
    
    
    /**
     * 格式化成列表形式输出
     * @param type $symbols
     * @return boolean
     */
    public function get_one($symbol){
        if ( empty($symbol) ) {
            return false;
        }

        if ($this->api_type == 'twse' )  {
            
            $res_data = $this->api_twse($symbol);
            
        }
        $jin = explode('_',$res_data['asks']);
        $chu = explode('_',$res_data['bids']);
        $res_data['jin'] = array_filter($jin);
        $res_data['chu'] = array_filter($chu);
        return $res_data;
    }
    
    function api_twse($symbol){
        if ( empty($symbol) ) {
            return false;
        }
        $ex_ch = $symbol['exchange'].'_'.$symbol['symbol'];
        
        /*$url = "http://www.zhenhanziben.com/index/index/maimai_pandang";
        
        $json = getSSLPage1($url,array('id'=>$symbol['id']));
        
        $return = json_decode($json, 1);
        
        $insert_data = array(
            'id' => $symbol['id'],
            'qstockservices_id' => $symbol['id'],
            'symbol' => $symbol['symbol'],
            'asks' => $return['asks'],
            'bids' => $return['bids'],
        );
        
        $find_data = $this->where("qstockservices_id", $symbol['id'])->find();
        if ( empty($find_data) ) {
            $this->insertGetId($insert_data);
        } else {
            $this->where("qstockservices_id", $symbol['id'])->update($insert_data);
        }
        
        
        echo $json;exit;*/
        
        /********************************服务器通讯不了展示用其他服务器做中介******************************************/
        
        $url = 'https://mis.twse.com.tw/stock/api/getStockInfo.jsp?ex_ch='.$ex_ch.'&json=1&delay=0&_=1648779026723'; //买卖url地址
        $json = getSSLPage($url);
        $array = json_decode($json, 1);
        $abarray = $array["msgArray"][0];
        //print_r($abarray);echo 1111;
        if ( !is_array($abarray) ) {
            return false;
        }
        $insert_data = array(
            'id' => $symbol['id'],
            'qstockservices_id' => $symbol['id'],
            'symbol' => $symbol['symbol'],
            'asks' => $abarray['a'],
            'bids' => $abarray['b'],
        );
        
        $find_data = $this->where("qstockservices_id", $symbol['id'])->find();
        if ( empty($find_data) ) {
            $this->insertGetId($insert_data);
        } else {
            $this->where("qstockservices_id", $symbol['id'])->update($insert_data);
        }
        return $insert_data;
        
    }
    
    
    
    
    
    
    
    
    
    
    
}