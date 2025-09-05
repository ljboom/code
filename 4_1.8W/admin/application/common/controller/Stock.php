<?php

namespace app\common\controller;

use think\Db;
/**
 * 基金数据抓取
 * @package app\common\controller
 */
class Stock extends Common
{
    /**
     * 获取基金数据
     * 
     * @param int $code 基金代码
     */ 
    public function stock($code,$type=1)
    {
        
        $data = $this->fundData($code,$type);
        
        return $data;
        if($type == 1){ //基本数据
            $typeData = "/getFundDetail";
        }elseif($type == 2){//历史净值
            $typeData = "/fundHistory";
        }elseif($type == 3){//排行
           $typeData = '/fundRank';
        }elseif($type == 4){//走势数据
            $typeData = '/queryFundYield';
        }
       $data = $this->capture($code,$typeData); 
       
       
      return $data;
    }
    
    /**
     * 获取本地采集来的数据
     */ 
    public function fundData($code,$type=1)
    {
        if($type == 1){
            $data = Db::table('me_fund')->where('fund_code',$code)->find();
            
            // $res = $data['fund_code'];
            // for($i=1 ; $i<=6; $i++){
            //     if(strlen($res) < 6){
            //         $res = "0".$res;
            //     }
            // }
            $data['fund_code'] = str_pad($data['fund_code'], 6, "0", STR_PAD_LEFT);
            return $data;
           
        }elseif($type == 2){
           
             $data = Db::table('me_fund_history')->where('fund_code',$code)->select();
            //     $res = $data['fund_code'];
            // for($i=1 ; $i<=6; $i++){
            //     if(strlen($res) < 6){
            //         $res = "0".$res;
            //     }
            // }
           $arr = array();
          foreach($data as $v){
              $v['fund_code'] = str_pad($v['fund_code'], 6, "0", STR_PAD_LEFT);
              $arr[] = $v;
          }
             return $arr;
        }
    }
    
    /**
     * 基金基础数据
     * 
     * @param int $code 基金代码
     */
     public function capture($code,$typeData)
     {
         $host = "https://fund.market.alicloudapi.com";
        $path = $typeData;
        $method = "GET";
        $appcode = "a720799d1ff7425c8877add061f9c0ae"; //阿里接口AppCode
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "fundcode=".$code;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        
         $data = curl_exec($curl);
        return json_decode($data,true); 
     }
    
}
