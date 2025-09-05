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
// | 股票基金model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;

class QstockservicesData extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qstockservices_data';
    private  $api_type  = 'cnyes';


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
        $symbols[] = $symbol;
        if ($this->api_type == 'cnyes' )  {
            
            $all_data = $this->api_cnyes($symbols);
        }

        if ( is_array($all_data[$symbol['systexId']]) ) {
            $symbol = array_merge($symbol,$all_data[$symbol['systexId']]);
        }
        $symbol['regularMarketVolumeMoney'] = '0k';
        if ( $symbol['regularMarketVolume'] >  0   ) {
            $symbol['regularMarketVolumeMoney'] = $symbol['regularMarketPreviousClose'] ? number_format($symbol['regularMarketVolume'] * $symbol['regularMarketPreviousClose'],2) : 0;
            $symbol['regularMarketVolume'] .= '張';
            $symbol['regularMarketVolumeMoney'] .= 'k';
        }
        return $symbol;
    }
    
    /**
     * 格式化成列表形式输出
     * @param type $symbols
     * @return boolean
     */
    public function get_list($symbols){
        if ( !is_array($symbols) ) {
            return false;
        }
        if ($this->api_type == 'cnyes' )  {
            $all_data = $this->api_cnyes($symbols);
        }
        if ($this->api_type == 'twse' )  {
            $all_data = $this->api_twse($symbols);
        }
        
        if ( !is_array($all_data) ) {
            return $symbols;
        }
        foreach ($symbols as $key => $val) {
            $symbols[$key]['bid'] = $all_data[$val['systexId']]['bid'];
            $symbols[$key]['regularMarketPrice'] = $all_data[$val['systexId']]['regularMarketPrice'];
            $symbols[$key]['regularMarketChangePercent'] = $all_data[$val['systexId']]['regularMarketChangePercent'];
        }
        return $symbols;
    }
    
    
    
    /**
     * api去取数据并保存后输出
     * @param type $symbols
     * @return boolean
     */
    function api_cnyes($symbols){
        if ( !is_array($symbols) ) {
            return false;
        }

        $str_symbol = [];
        foreach ($symbols as $k => $v) {
            $find_one= $this->where("qstockservices_id", $v['id'])->find();
            if ( $find_one ) {
                $all_data[$v['systexId']] = $find_one->toArray();
            }
            
            $str_symbol[] = 'TWS:' . $v['systexId'] . ':STOCK';
        }
        $str_symbol = implode(',', $str_symbol);
        $url = 'https://ws.api.cnyes.com/ws/api/v1/quote/quotes/' . $str_symbol . '?column=I';
        $json = getSSLPage($url);
        $array = json_decode($json, 1);
        if ($array["statusCode"] != 200 || !is_array($array["data"])) {
            return $all_data;
        }
        $time = time();
        foreach ($array["data"] as $key => $val) {
            $systexId = $val[200010];
            $upd_data = array(
                "upd_time" => $time,
                "regularMarketChange" => $val[11] ?? 0,
                "regularMarketChangePercent" => $val[56] ?? 0,
                "regularMarketTime" => $val[200007] ?? 0,
                "regularMarketPrice" => $val[6] ?? 0,
                "regularMarketDayHigh" => $val[12] ?? 0,
                "regularMarketVolume" => $val[800001] ?? 0,
                "regularMarketDayLow" => $val[13] ?? 0,
                "regularMarketPreviousClose" => $val[21] ?? 0,
                "regularMarketOpen" => $val[19] ?? 0,
                "bid" => $val[6] ?? 0,
                "ask" => $val[6] ?? 0,
                "marketCap" => $val[700005] ?? 0,
            );
            $where = array();
            $where[] = array("symbol_code", "=", $systexId);
            $where[] = array("is_show", "=", 1);
            $res = $this->where($where)->update($upd_data);
            if ($res) {
                $all_data[$systexId] = array_merge($all_data[$systexId],$upd_data);
            }
        }
        return $all_data;
    }
    
    function api_twse($symbols){
        
    }
    

    
    function api_masvn($symbols,$all_data = []){
        
        $url = "https://data.masvn.com/AjaxData/TradingResult/GetStockData.ashx?_=1654325378217&scode=".$symbols;
        
        $json = getSSLPage($url);
        
        $array = json_decode($json, 1);
        
        $data = $array[0];
        
        $time = time();
        
        $upd_data = array(
                "upd_time" => $time,
                "regularMarketChange" => $data['Oscillate'] ?? 0,
                "regularMarketChangePercent" => $data['PercentOscillate'],
               // "regularMarketTime" => $val[200007] ?? 0,
                "regularMarketPrice" => gsh($data['ClosePrice']) ?? 0,
                "regularMarketDayHigh" => gsh($data['Highest']) ?? 0,
                //"regularMarketVolume" => gsh($data['TradingVolume']) ?? 0,
                "regularMarketDayLow" => gsh($data['Lowest']) ?? 0,
                "regularMarketPreviousClose" => gsh($data['PriorClosePrice']) ?? 0,
                "regularMarketOpen" => gsh($data['OpenPrice']) ?? 0,
                "bid" => gsh($data['ClosePrice']) ?? 0,
                "ask" => gsh($data['ClosePrice']) ?? 0,
                "marketCap" => gsh($data['TotalVal']) ?? 0,
                
        );
        $where = array();
        $where[] = array("symbol_code", "=", $symbols);
        $where[] = array("is_show", "=", 1);
        $res = $this->where($where)->update($upd_data);
        
        $upd_data["CeilingPrice"] = gsh($data['CeilingPrice']);
        $upd_data["FloorPrice"] = gsh($data['FloorPrice']);
        
        $upd_data = array_merge($all_data,$upd_data);
        
        return $upd_data;
    }
    
    
    
    
    
    
    
    
    
    
    
    
}