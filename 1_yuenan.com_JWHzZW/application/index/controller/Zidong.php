<?php
namespace app\index\controller;

use app\index\model\Qchicang as QchicangModel;
use app\index\model\QmoneyJournal as QmoneyJournalModel;
use app\index\model\Qxingushengou as QxingushengouModel;
use app\index\model\QstockAskBid as QstockAskBidModel;
use app\index\model\QstocksNew as QstocksNewModel;
use app\index\model\Qstockservices as QstockservicesModel;
use app\index\model\QstockservicesData as QstockservicesDataModel;
use app\index\model\Quser as QuserModel;
use app\index\model\Article as ArticleModel;
use app\cms\model\Cms as Cms_Model;
use app\admin\model\Config as ConfigModel;
use app\index\model\Qcategory as QcategoryModel;
use app\common\controller\Indexbase;
use think\facade\Session;
use think\Db;

class Zidong extends Indexbase
{
    
    function testttt(){
        $QmoneyJournalModel = new QmoneyJournalModel;
        $list = Db::query("SELECT id,quser_id, table_id, COUNT( 1 ) AS c
            FROM `yzn_qmoney_journal`
            WHERE TYPE =6
            GROUP BY table_id
            HAVING c >1");
        foreach($list as $k =>$v){
            $list_arr = $QmoneyJournalModel->where(['quser_id'=>$v['quser_id'] ,'table_id'=>$v['table_id'],'type'=>6])->select()->toArray();
            $count = count($list_arr);
            // dump($list_arr);
            for($x=0; $x<=$count-2; $x++){
                var_dump($v['quser_id'],$v['table_id'],$list_arr[$x]['id'],$list_arr[$x]['money']);
                $QmoneyJournalModel->where('id',$list_arr[$x]['id'])->delete();
                Db::name('quser')->where('id',$list_arr[$x]['quser_id'])->setDec('money',$list_arr[$x]['money']);
                // dump($list_arr[$x]);
                
            }
            // exit;
        }
    }
    
    
    
    //杠杆自动机制
    public function zidong_gangggang(){
        $ConfigModel = new ConfigModel();
        $QchicangModel = new QchicangModel();
        $QstockservicesDataModel = new QstockservicesDataModel();
        $_list = $QchicangModel->where('ganggang_beilv', '>', 0)->where('status','in',[1,2])->select()->toArray();
        $config = $ConfigModel->where('id',15)->find();
        $config_ggbl = $config['gangan_bili'] * 0.01;
        // dump($config_ggbl);
        foreach($_list as $k => $v){
            $total_money = $v['mairu_total_money'] ; //购买的本金
            $ganggangg_money = $total_money * $config_ggbl * $v['ganggang_beilv'];//杠杆益损金额
            $zuigao_money = $v['ganggang_beilv'] == 5 ? $total_money * 0.4 : $total_money * 0.8;     //最高收益和损失金额 是本金的百分之八十
            
            $yisun_money = $ganggangg_money >= $zuigao_money ? $zuigao_money : $ganggangg_money; // 最终益损值
            
            $QstockservicesData = $QstockservicesDataModel->where('id',$v['qstockservices_id'])->find();
            $new_money = $QstockservicesData['regularMarketPrice']*$v['mairu_num'];//现在的市值
            $cha_money = abs($new_money - $total_money);
            
            if($cha_money >= $yisun_money){
                
                if($total_money > $new_money){
                    if($v['ganggang_beilv'] == 5 &&  $cha_money >= $total_money * 0.6 ){
                        $QchicangModel->pingcangManager(['id'=>$v['id'] ,'maichu_type'=>3 ,'ganggang_money'=>$total_money * 0.6]);
                    } 
                    
                    if($v['ganggang_beilv'] != 5 &&  $cha_money >= $total_money * 0.2 ){
                        $QchicangModel->pingcangManager(['id'=>$v['id'] ,'maichu_type'=>3 ,'ganggang_money'=>$total_money * 0.2]);
                    } 
                    
                    $QchicangModel->pingcangManager(['id'=>$v['id'] ,'maichu_type'=>3]);
                    
                    
                }
                
                $QchicangModel->pingcangManager(['id'=>$v['id'] ,'maichu_type'=>3]);
            }
            
            
        }
    }
    
    
    //排期单转持仓中
    public function paiqi_chicang(){
        $QchicangModel = new QchicangModel();
        $QmoneyJournalModel = new QmoneyJournalModel();
        $QstockservicesDataModel = new QstockservicesDataModel();
        $_list = $QchicangModel->where('status',10)->select()->toArray();
        if(!empty($_list)){
            
            foreach($_list as $k => $v){
                
                $QstockservicesData = $QstockservicesDataModel->where('qstockservices_id',$v['qstockservices_id'])->find();

                // $quser_money = Db::name('quser')->where('id',$v['quser_id'])->value('money');
                // $total_moeny = $v['mairu_total_money'] + $v['mairu_shouxu'];
                //if($QstockservicesData['regularMarketChangePercent'] < 10){
                //$min_money = round($QstockservicesData['regularMarketPreviousClose'] * 0.9002,2);
                //$max_monty = round($QstockservicesData['regularMarketPreviousClose'] * 1.0988,2);
                
                $stock_updw = $QchicangModel->getSTOCKUPDW($v['mairu_money'],$QstockservicesData['regularMarketPreviousClose']);
                
                if ( $stock_updw == true ) {
                    
                    if($v['mairu_type'] == 1 && $QstockservicesData['regularMarketPrice'] >= $v['mairu_money']){
                        $QchicangModel->where('id',$v['id'])->update(['status'=>1]);
                    }
                    
                    if($v['mairu_type'] == 2 && $QstockservicesData['regularMarketPrice'] <= $v['mairu_money']){
                        $QchicangModel->where('id',$v['id'])->update(['status'=>1]);
                    }
                    
                }
                
            }
            
        }
        
        
        
        
    }
    
    
     //新股拨发
    public function xingubofa(){
        
        //查询今天拨发的新股
        $date = date('m/d');
 
        $list = QstocksNewModel::where('roll_date',$date)->select();
        
        if(!$list){
            echo "没有数据";exit;
        }
        //遍历用户购买 转到持仓中
        $insert_data = [];//插入的持仓数据表
        $update_ids = [];//更新的新股申购表
        foreach ($list as $vv){

            $userStock = QxingushengouModel::where('qstocks_new_id',$vv['id'])->where('yirenji_money_num','>',0)->where('status',3)->where('is_send',0)->select();
           
            //没有申购记录则跳过
            if(!$userStock){
                continue;
            }
            
            $qstockservices_id = QstockservicesModel::where('symbol',$vv['symbol'].'.tw')->value('id');
            
            //没有这支股票就不插入
            if(!$qstockservices_id){
                continue;
            }
            
            foreach ($userStock as $val){
                
                
                $array = [];
                $array['number'] = date("YmdHis",time()).random();
                $array['quser_id'] = $val['quser_id']; //用户id
                $array['qstockservices_id'] = $qstockservices_id; //股票id
                $array['mairu_type'] = 1; //买入方向 1 买张 2买跌
                $array['mairu_status'] = 1; //买入方式 1市价 2限价
                $array['status'] = 1; //订单状态 1持仓中 2平仓中 3已平仓 10排单中
                $array['ganggang_beilv'] = 0;  //杠杠倍率
                $array['mairu_count'] = intval($val['yirenji_money_num'] / 1000) ;  //买入张数
                $array['mairu_num'] = $val['yirenji_money_num'] ; //买入股数
                $array['mairu_ori'] = $array['mairu_num'];//原始股数
                $array['mairu_money'] = $val['shengou_money'];
                $array['mairu_total_money'] = $array['mairu_num'] * $val['shengou_money']; //买入总金额（买入本金）
                $array['mairu_shouxu'] = 0;
                $array['mairu_time'] = time();
                
                $insert_data[] = $array;
                array_push($update_ids,$val['id']);
            }
            
        }
        //如果有数据则插入
        if($insert_data){
            
            QchicangModel::startTrans();
            try{
                $res = QchicangModel::insertAll($insert_data);
                $res = $res && QxingushengouModel::where('id','in',$update_ids)->update(['is_send'=>1]);
                
                if($res){
                    QchicangModel::commit();
                    echo "新股拨发成功";exit;
                }
                
                QchicangModel::rollback();
                echo "新股拨发失败";exit;
            }catch(Exception $e){
                QchicangModel::rollback();
                echo "新股拨发异常";exit;
            }
            
        }
        
        echo "没有数据!!";exit;
    }
    
    // 自动平仓
    public function zidong_pingcang(){
        $QchicangModel = new QchicangModel();
        $_list = $QchicangModel->where('status',2)->select()->toArray();
        //print_r($_list);
        foreach($_list as $k => $v){
            $arr = array(
                'id'=>$v['id'],
                'num'=>$v['mairu_num'],
                'maichu_type'=>1,
                );
            //echo $v['id']."<br>";
            $res = $QchicangModel->pingcangManager($arr);
            var_dump($res);
        }
        
        
    }
       
    // 股票详细的 买盘档和卖盘档
    public function maimai_pandang(){
        $QstockAskBid = new QstockAskBidModel;
        $Qstockservices = new QstockservicesModel;
        $list = $Qstockservices
            ->where('is_update',1)
            ->order('upd_time')
            ->page(1,20)
            ->field('id,symbol')->select()->toArray();
        $arr_symbol = [];
        foreach($list as $k => $v){
            if(strpos($v['symbol'],'.TW') !== false){
                $list[$k]['new_symbol'] =$v['symbol'] = str_replace('.TW','',str_replace('O','',$v['symbol'])).'.tw';//strtolower
            	$arr_symbol[$v['id']] = 'tse_'.$v['symbol'];
            }
        }
        $str_symbol = implode('|',$arr_symbol);
        $url = bianliang('maimai_url' ,$str_symbol);
        $info = file_get_contents($url);
        $info = json_decode($info,1)['msgArray'];
        if(!empty($info)){
            $array = [];
            foreach($list as $k => $v){
               foreach($info as $key => $val){
                   if($v['new_symbol'] == $val['ch']){
                       $array[] = array(
                           'id' => $v['id'],
                           'qstockservices_id' => $v['id'],
                           'symbol' => $v['symbol'],
                           'asks' => $val['a'],
                           'bids' => $val['b'],
                           );
                        unset($info[$key]);
                        break;
                   }
                   
               }
            }
            $QstockAskBid->isUpdate()->saveAll($array);
            
        }
        

    }
    // 新股认缴失败
    public function xingurenjiao(){
        $QuserModel = new QuserModel;
        $QstocksNewModel = new QstocksNewModel;
        $QmoneyJournalModel = new QmoneyJournalModel;
        $QxingushengouModel = new QxingushengouModel;
        $date = date("Y/m/d",strtotime("-4 day"));
        $arr_id = $QstocksNewModel->where('draw_date',$date)->field('id')->select()->toArray();
        $array_id = [];
        foreach($arr_id as $k => $v){
            $array_id[] = $v['id'];
        }
        $list = $QxingushengouModel->where('status',1)->where('qstocks_new_id','in',$array_id)->select()->toArray();
        
        $quser_array = []; 
        $Journal_array = [];
        $Qxingushengou = [];
        foreach($list as $k => $v){
            if(!empty($v['yirenji_money_count'])){
                
                $quser_array[] = array(
                    'id' => $v['quser_id'],
                    'money' => $v['yirenji_money'],
                    );
                $Journal_array[] = array(
                    'quser_id' =>$v['quser_id'],
                    'table_id' =>$v['id'],
                    'money' =>$v['yirenji_money'] - admin_config(2),
                    'type' =>4,
                    );
            }
            $Qxingushengou[] = array(
                'id' => $v['id'],
                'yirenji_money' => 0,
                'yirenji_money_count' => 0,
                'status' => 4,
                );
        }
        
        // dump($Qxingushengou);
        // dump($quser_array);
        // dump($Journal_array);
        // exit;
        
        foreach($quser_array as $key => $val){
            $QuserModel->where('id',$val['id'])->setInc('money', $val['money']-admin_config(2));//余额增加
            $QuserModel->where('id',$val['id'])->setDec('dongjie_money', $val['money']);//冻结资金减少
            usleep(100000);//停顿0.1秒再循环
        }
        $QxingushengouModel->isUpdate()->saveAll($Qxingushengou);//批量更新认缴失败
        $QmoneyJournalModel->add_qmoneyjournal($Journal_array);//批量添加资金流水日志
        
    }
    
    // 新股
    public function xingu()
    {
        $QstocksNewModel = new QstocksNewModel;
        $url = file_get_contents(bianliang('xingu_url'));
        $arr = explode('<tr',$url);
        unset($arr[0]);
        unset($arr[1]);
        array_pop($arr);
        array_pop($arr);
        $array = [];
        if(!empty($arr)){
            foreach($arr as $k => $v){
                $v = strip_tags($v ,'<td>');//去除字符串中除td的所有标签
                $v = preg_replace("/\s+/", "", $v);//去除所有的空字符串
                $v = explode('<td' ,$v);
                foreach($v as $key => $val){
                    if($key == 2){
                        $val = str_replace('&nbsp;', ' ',strip_tags('<td'.$val));
                        $v[$key] = explode(' ',$val);
                    }else{
                        $v[$key] = strip_tags('<td'.$val);
                    }
                   
                }
                
                $array[] = array(
                    'draw_date'=> $v[1],
                    'symbol'=> $v[2][0],
                    'symbol_name'=> $v[2][1],
                    'issue_market'=> $v[3],
                    'subscription_period'=> $v[4],
                    'roll_date'=> $v[5],
                    'total_subscription'=> $v[6],
                    'underwriting_price'=> $v[7],
                    'market_price'=> $v[8],
                    'profit'=> $v[9],
                    'rate_return'=> $v[10],
                    'can_purchased'=> 0,//$v[11],
                    'total_parts'=> $v[12],
                    'winning_rate'=> $v[13],
                    'type'=> $v[14] == "已截止" ? 2 : 1,
                    'spread'=> $v[8]-$v[7],
                    );
            }
            $array = array_reverse($array);
            // dump($array);
            // exit;
            foreach($array as $k => $v){
              $res =  $QstocksNewModel->where('symbol',$v['symbol'])->field('id,can_purchased')->find();
              if(empty($res['id'])){
                  $QstocksNewModel->insert($v);
              }else{
                //   $v['id'] = $id;
                  $v['id'] = $res['id'];
                  if($res['can_purchased'] == 0){
                      $v['can_purchased'] = 0;
                  }
                  $QstocksNewModel->isUpdate()->save($v);
              }
            }
            
        }
       
        
    }
   
       
    // 股票详情(上市、上柜) 存入数据库
    public function gupiao_details(){
        
        $Qstockservices = new QstockservicesModel;
        $QstockservicesData = new QstockservicesDataModel;
        
        // for ($i = 1; $i < 70; $i++) {
        
            $list = $QstockservicesData
                //->where(['1'=>1])
                ->page($i,50)
                ->order('upd_time')
                ->field('id,symbol')->select()->toArray();
             
            $str_symbol = [];
            foreach($list as $k => $v){
                $str_symbol[] = $v['symbol'];
            }
            $str_symbol = implode(',' ,$str_symbol);
            //var_dump($str_symbol);
            // 要写成变量(后期要改)
            $url = bianliang('xiangqing_url').$str_symbol;

            $json = headercurlGet($url);

            // if(bianliang('test') == 1){
            //     $json = $this->json_test(1);//测试数据  上线后删除
            // }
            $array = json_decode($json,1)['quoteResponse']['result'];
           // 要写成变量(后期要改)
           
           $data = [];
           $time = time();
           

              foreach($array as $key => $val){

                  $upd_data = array(

                    "upd_time"=>$time,
                    "regularMarketChange"=>$val["regularMarketChange"],
                    "regularMarketChangePercent"=>$val["regularMarketChangePercent"],
                    "regularMarketTime"=>$val["regularMarketTime"],
                    "regularMarketPrice"=>$val["regularMarketPrice"],
                    "regularMarketDayHigh"=>$val["regularMarketDayHigh"],
                    "regularMarketDayRange"=>$val["regularMarketDayRange"],
                    "regularMarketDayLow"=>$val["regularMarketDayLow"],
                    "regularMarketPreviousClose"=>$val["regularMarketPreviousClose"],
                    "regularMarketOpen"=>$val["regularMarketOpen"],
                    "bid"=>$val["bid"],
                    "ask"=>$val["ask"],
                    "marketState"=>$val["marketState"],
                    "messageBoardId"=>$val["messageBoardId"],
                    "exchangeTimezoneName"=>$val["exchangeTimezoneName"],
                    "exchangeTimezoneShortName"=>$val["exchangeTimezoneShortName"],
                    "epsTrailingTwelveMonths"=>$val["epsTrailingTwelveMonths"],
                    "epsForward"=>$val["epsForward"],
                    "epsCurrentYear"=>$val["epsCurrentYear"],
                    "priceEpsCurrentYear"=>$val["priceEpsCurrentYear"],
                    "sharesOutstanding"=>$val["sharesOutstanding"],
                    "bookValue"=>$val["bookValue"],
                    "fiftyDayAverage"=>$val["fiftyDayAverage"],
                    "fiftyDayAverageChange"=>$val["fiftyDayAverageChange"],
                    "fiftyDayAverageChangePercent"=>$val["fiftyDayAverageChangePercent"],
                    "twoHundredDayAverage"=>$val["twoHundredDayAverage"],
                    "twoHundredDayAverageChange"=>$val["twoHundredDayAverageChange"],
                    "twoHundredDayAverageChangePercent"=>$val["twoHundredDayAverageChangePercent"],
                    "marketCap"=>$val["marketCap"],
                    "forwardPE"=>$val["forwardPE"],
                    "priceToBook"=>$val["priceToBook"],
                    "currency"=>$val["currency"],
                    
            
                  );
                  //var_dump($upd_data);
                  $res = $QstockservicesData->where("symbol",$val['symbol'])->update($upd_data);
                  //var_dump($val['symbol'],$res);
                }

           /**
           foreach($list as $k => $v){
               foreach($array as $key => $val){
                   if($v['symbol'] == $val['symbol']){
                       $data[$k] = $val;
                       $data[$k]['id'] = $v['id'];
                       $data[$k]['upd_time'] = $time;
                       $data[$k]['qstockservices_id'] = $v['id'];
                       unset($array[$key]);
                       break;
                   }
               }
           }
           
           $res = $QstockservicesData->isUpdate()->saveAll($data);
           **/
        //   usleep(1000000);// 1秒 1000000
        // }
       
       
    }
    
    // 股票详情(上市、上柜) 存入数据库
    public function gupiao_cnyes_details(){

        $QstockservicesData = new QstockservicesDataModel;
        

        
            $list = $QstockservicesData
                ->page(0,5)
                ->where('is_update',1)
                ->order('upd_time')
                ->field('id,symbol_code')->select()->toArray();
             
            $str_symbol = [];
            foreach($list as $k => $v){
                $str_symbol[] = 'TWS:'.$v['symbol_code'].':STOCK';
                $all_symbol[$v['symbol_code']] = $v['id'];
            }
            $str_symbol = implode(',' ,$str_symbol);
            //var_dump($str_symbol);
            // 要写成变量(后期要改)
            $url = 'https://ws.api.cnyes.com/ws/api/v1/quote/quotes/'.$str_symbol.'?column=I';
            //var_dump($url);
            $json = getSSLPage($url);
            
            $data = [];
            $time = time();
            $array = json_decode($json,1);
            if ( $array["statusCode"] == 200 && is_array($array["data"]) ) {
                
                foreach($array["data"] as $key => $val){

                    $upd_data = array(
    
                      "upd_time"=>$time,
                      "regularMarketChange"=>$val[11],
                      "regularMarketChangePercent"=>$val[56],
                      "regularMarketTime"=>$val[200007],
                      "regularMarketPrice"=>$val[6],
                      "regularMarketDayHigh"=>$val[12],
                      "regularMarketVolume"=>$val[800001],
                      "regularMarketDayLow"=>$val[13],
                      "regularMarketPreviousClose"=>$val[21],
                      "regularMarketOpen"=>$val[19],
                      "bid"=>$val[6],
                      "ask"=>$val[6],
                      "marketCap"=>$val[700005],
                    );
                    //var_dump($upd_data);
                    $up_id = $all_symbol[$val[200010]];
                    $res = $QstockservicesData->where("id",$up_id)->update($upd_data);
                    if ($res) {
                        $res_symbol[] =  $val[200010];
                    }
                    unset($all_symbol[$val[200010]]);
                    //var_dump($val['symbol'],$res);
                  }
                
            } else {
                var_dump($url,$array);
            }
          
           
           

            
          foreach($all_symbol as $key => $val){
            $upd_data = array(

              "upd_time"=>$time,
              //"is_update"=>0, //更新不到的，暂时不要去更新了
            );
            $QstockservicesData->where("id",$val)->update($upd_data);
          }

       
    }
    
    public function chicang_cnyes_update(){
        $QchicangModel = new QchicangModel();
        
        $page = input('page');
        
        $page = $page ? $page : 1;
        
        $start = ($page - 1) * 100;
        
        $where = ['status'=>[1,2,10]];
        
        $res = $QchicangModel->where($where)->group('qstockservices_id')->field('qstockservices_id')/*->limit($start,100)*/->select()->toArray();
        //print_r($res);
        if (!$res) {
            exit();
        }
        //var_dump($res);
        $info = array();
        foreach($res as $k => $v){
            $info[$v['qstockservices_id']] = Db::name('qstockservices')->where('id',$v['qstockservices_id'])->field('id,systexId,symbolName,symbol')->find();
        }
        $QstockservicesDataModel = new QstockservicesDataModel();
        $info = $QstockservicesDataModel->get_list($info);
        //var_dump($info);
        echo '更新'.count($info).'数据';
    }
   

    // 新闻列表
    public function xinwen(){
        $Article = new ArticleModel();
        $xinwenlist = file_get_contents(bianliang('xinwenlist_url'));

        $arr = explode('<div style="height:70px;"',$xinwenlist);
        unset($arr[0]);
        array_pop($arr);
        $this->xinwen_detail(1);
        $array = [];
        foreach($arr as $k => $v){
            $v = strip_tags($v ,'<div> <a> <img>');//去除字符串中除div的所有标签
            $v = explode('<div' ,$v);
            
            foreach($v as $key => $val){
              $val = ('<div'.$val);
              if($key == 3){
                  $v[$key + 10]= $this->cut('src="' , '" srcset=',$val);
              }
              if($key == 0){
                  $v[$key] = substr(strstr(strip_tags($val ,'<a>'),'/id/') ,4 ,7);
              }elseif($key == 1){
                  $v[$key] = date('Y-m-d' ,time()).' '.strip_tags($val).':00';
              }else{
                  $v[$key] = strip_tags($val);
              }
            }
            
            $id = $Article->where('id',$v[0])->value('id');
            if(empty($id)){
                $array = array(
                    'id' => $v[0],
                    'inputtime' => $v[1],
                    'title' => $v[3],
                    'thumb' => $v[13],
                    'catid' => bianliang('catid'),
                    'status' => 1,
                );
                $Article->insert($array);
                // 添加文章内容
                $content = $this->xinwen_detail($url);
                Db::name('article_data')->insert(['did'=>$array['id'] ,'content'=>$content]);
            }
        }
    }
 
    public function xinwen_detail($arr){
        $xinwen = file_get_contents(bianliang('xinwen_url'));
        $xinwen_arr = explode('<p>',$xinwen);
        unset($xinwen_arr[0]);
        $max = count($xinwen_arr);
        $num = strrpos($xinwen_arr[$max] ,'</p>');
        $xinwen_arr[$max] = substr($xinwen_arr[$max] ,0 ,$num);
        $array = [];
        foreach($xinwen_arr as $k => $v){
            $array[] = strip_tags('<p>'.$v);
        }
        return json_encode($array);
    }
    
    public function yuenan_news(){
        
        $url = "https://ndh.vn/lazyload-more?data=%7B%22page%22%3A1%2C%22cate_id%22%3A%221000527%22%7D";
        
        $json = getSSLPage($url);
        
        $data = json_decode($json,true);
        
        foreach ($data['data'] as $val){
            
            $find_data = Db::name('article')->where('id', $val['article_id'])->find();
            if ( $find_data ) {
                continue;
            }
            
            $insert_data = array(
                "id" => $val['article_id'],
                "catid" => $val['category_id'],
                "title" => $val['title'],
                "description" => $val['lead'],
                "thumb" => $val['thumbnail_url'],
                "inputtime" => date("Y-m-d H:i:s", $val['publish_time']),
                "url" => "https://ndh.vn".$val['share_url'],
                "status" => 1,
            );
            //var_dump($insert_data);
            $id = Db::name('article')->insertGetId($insert_data);
            
            $content = getSSLPage($insert_data['url']);
            
            $content = $this->getWebTag('class="fck_detail"',false,'article',$content);
            
            if ($id) {
                Db::name('article_data')->insert(['did' => $id, 'content' => $content]);
            }
        }
        
    }
    
    
    public function news_cnyes() {
        $startAt = time()-86400*7;
        $endAt = time();
        $limit = 50;
        $page = 1;
        $url = 'https://api.cnyes.com/media/api/v1/newslist/category/tw_stock_news?startAt=' . $startAt . '&endAt=' . $endAt . '&limit=' . $limit . '&page=' . $page;
        $json = getSSLPage($url);


        $array = json_decode($json, 1);
        if ($array["statusCode"] != 200 || !is_array($array["items"])) {
            exit($array["message"]);
        }
        
        $items = $array["items"];
        $data = [];
        $time = time();

        foreach ($items["data"] as $key => $val) {
            
            $find_data = Db::name('article')->where('id', $val['newsId'])->find();
            if ( $find_data ) {
                //var_dump($val['newsId']);
                continue;
            }
            $insert_data = array(
                "id" => $val['newsId'],
                "catid" => bianliang('catid'),
                "title" => $val['title'],
                "description" => $val['summary'],
                "thumb" => $val['coverSrc']['l']['src'],
                "inputtime" => date("Y-m-d H:i:s", $val['publishAt']),
                "status" => 1,
            );
            //var_dump($insert_data);
            $id = Db::name('article')->insertGetId($insert_data);
            if ($id) {
                Db::name('article_data')->insert(['did' => $id, 'content' => $val['content']]);
            }
        }
    }
    
    
        
    /**
     * php截取指定两个字符之间字符串，默认字符集为utf-8 Power by 大耳朵图图
     * @param string $begin  开始字符串
     * @param string $end    结束字符串
     * @param string $str    需要截取的字符串
     * @return string
     */
     
    public function cut($begin,$end,$str){
        $b = mb_strpos($str,$begin) + mb_strlen($begin);
        $e = mb_strpos($str,$end) - $b;
        return mb_substr($str,$b,$e);
    }
    
    
    
    
    // 根据分类获取股票列表存入数据库
    //http://www.zhenhanziben.com/index/zidong/gupiao_cats_list
    public function gupiao_cats_list(){

        $Qcategory = new QcategoryModel;
        

        
            $list = $Qcategory
                ->page(0,3)
                ->where('is_update',1)
                ->order('upd_time')
                ->select()->toArray();
             $time = time();

            foreach($list  as $keys => $vals){
            	$url = 'https://mis.twse.com.tw/stock/api/getCategory.jsp?ex='.$vals['category'].'&i='.$vals['sectorId'];
	            
            	$json = getSSLPage($url);	
            	$array = json_decode($json,1);


           		foreach($array["msgArray"] as $key => $val){
           		    $con = array();
           		    $con[] = array('sectorId', "=",$vals['id']);
           		    $con[] = array('symbol', "=",$val['ch']);
           			$find_data = Db::name('qstockservices')->where($con)->find();
		            if ( $find_data ) {
		                var_dump('having',$vals['id'],$val['ch']);
		                continue;
		            }
		            var_dump('inserting',$vals['id'],$val['ch']);
		            $sys = explode('.',$val['ch']);
	                $insert_data = array(
	                  "sectorId"=>$vals['id'],
	                  "sectorName"=>$vals['name'],
	                  "symbol"=>$val['ch'],
	                  "symbolName"=>$val['n'],
	                  "systexId"=>$sys[0],
	                  "exchange"=>$vals['category'],
	                  "sy_key"=>$val['key'],
	                  'is_show'=>1,
	                  'is_update'=>1,
	                  "add_time"=>$time,
	                  "upd_time"=>$time,
	                );
	                $id = Db::name('qstockservices')->insertGetId($insert_data);
		            if ($id) {
		                $data_insert_data = array(
		                    'qstockservices_id' => $id, 
                            'symbol' => $val['ch'],
                            'symbol_code'=>$sys[0],
                            'is_show'=>1,
                            'is_update'=>1,
                            "add_time"=>$time,
                            "upd_time"=>$time,
	                    );
		                Db::name('qstockservices_data')->insert($data_insert_data);
		            }
                }
                $upd_data = array(
                  "upd_time"=>$time,
                );
                Db::name('qcategory')->where("id",$vals['id'])->update($upd_data);
            }    


       
    }
    
    
    // 根据分类获取股票列表存入数据库
    //http://www.zhenhanziben.com/index/zidong/gupiao_cats_repair
    public function gupiao_cats_repair(){

        $Qcategory = new QcategoryModel;
        

        
            $list = $Qcategory
                ->page(0,3)
                ->where('is_update',1)
                ->order('upd_time')
                ->select()->toArray();
             $time = time();
            foreach($list  as $keys => $vals){
            	$url = 'https://mis.twse.com.tw/stock/api/getCategory.jsp?ex='.$vals['category'].'&i='.$vals['sectorId'];

            	$json = getSSLPage($url);	
            	$array = json_decode($json,1);
           		foreach($array["msgArray"] as $key => $val){
           		    $con = array();
           		    $con[] = array('exchange', "=",$vals['category']);
           		    $con[] = array('symbol', "=",$val['ch']);
           			$find_data = Db::name('qstockservices')->where($con)->find();
		            if ( is_array($find_data)  )  {
                        if ( $find_data['sectorId'] !=  $vals['id'] )  {
                            var_dump('updateing',$vals['id'],$val['ch']);
                            $upd_data = array(
                                "sectorId"=>$vals['id'],
                                "sectorName"=>$vals['name'],
                            );
                            Db::name('qstockservices')->where("id",$find_data['id'])->update($upd_data);
                        }
                    } else {
                        var_dump('inserting',$vals['id'],$val['ch']);
                        $sys = explode('.',$val['ch']);
                        $insert_data = array(


                          "sectorId"=>$vals['id'],
                          "sectorName"=>$vals['name'],
                          "symbol"=>$val['ch'],
                          "symbolName"=>$val['n'],
                          "systexId"=>$sys[0],
                          "exchange"=>$vals['category'],
                          "sy_key"=>$val['key'],
                          'is_show'=>1,
                          'is_update'=>1,
                          "add_time"=>$time,
                          "upd_time"=>$time,
                        );
                        //var_dump($insert_data);

                        $id = Db::name('qstockservices')->insertGetId($insert_data);
                        if ($id) {
                            $data_insert_data = array(
                                'qstockservices_id' => $id, 
                                'symbol' => $val['ch'],
                                'symbol_code'=>$sys[0],
                                'is_show'=>1,
                                'is_update'=>1,
                                "add_time"=>$time,
                                "upd_time"=>$time,
                            );
                            //var_dump($data_insert_data);
                            Db::name('qstockservices_data')->insert($data_insert_data);
                        }
                    }
                }
                $upd_data = array(
                  "upd_time"=>$time,
                );
                Db::name('qcategory')->where("id",$vals['id'])->update($upd_data);
            }    


       
    }
    
    /**
     * 获取数据
     */
    public function GetStockData(){
        
        
        $QchicangModel = new QchicangModel();
        
        if(!$QchicangModel->checkTime()){
            exit("非交易时间");
        }
        
        
        $QstockservicesDataModel = new QstockservicesDataModel();
        
        $list = Db::name('qstockservices')->field('id,symbol')->where('exchange','hose')->where('is_show',1)->select();
        
        foreach ($list as $val){
            
            $QstockservicesDataModel->api_masvn($val['symbol']);
        }
        
    }
    
    public function GetStockData1(){
        
        $QchicangModel = new QchicangModel();
        
        if(!$QchicangModel->checkTime()){
            exit("非交易时间");
        }
        
        $QstockservicesDataModel = new QstockservicesDataModel();
        
        $list = Db::name('qstockservices')->field('id,symbol')->where('exchange','hnx')->where('is_show',1)->select();
        
        foreach ($list as $val){
            
            $QstockservicesDataModel->api_masvn($val['symbol']);
        }
        
    }
    
    
    public function GetStockData2(){
        
        $QchicangModel = new QchicangModel();
        
        if(!$QchicangModel->checkTime()){
            exit("非交易时间");
        }
        
        $QstockservicesDataModel = new QstockservicesDataModel();
        
        $list = Db::name('qstockservices')->field('id,symbol')->where('exchange','upcom')->where('is_show',1)->select();
        
        foreach ($list as $val){
            
            $QstockservicesDataModel->api_masvn($val['symbol']);
        }
        
    }
    
    
    //获取越南胡志明数据
    public function getYuenanHose(){
        
       $content = $this->getWebTag('id="content-match"','https://data.masvn.com/vi/transaction_statistics/hose','div');
        
       $list = $this->tdToArray($content);
       
       foreach ($list as $val){
           if(!$val){
               continue;
           }
           $info = Db::name('qstockservices')->where('symbol',trim($val[1]))->find();
           if(!$info){
               $idata = array(
                   'symbol' => trim($val[1]),
                   'systexId' => trim($val[1]),
                   'exchange' => "hose",
                   'is_show' => 1,
                   'add_time' => time(),
               );
               $id = Db::name('qstockservices')->insertGetId($idata);
               
               $idata = array(
                   'is_show' => 1,
                   'qstockservices_id' => $id,
                   'symbol' => trim($val[1]),
                   'symbol_code' => trim($val[1]),
                   'regularMarketChangePercent' => round(($this->gsh($val[8]) - $this->gsh($val[3])) / $this->gsh($val[3]),2),
                   'regularMarketPrice' => $this->gsh($val[8]) / 1000,
                   'add_time' => time()
                );
                
                Db::name('qstockservices_data')->insertGetId($idata);
           }
       }
    }
    
    public function getYuenanHnx(){
        
       $content = $this->getWebTag('id="content-match"','https://data.masvn.com/vi/transaction_statistics/hnx','div');
        
       $list = $this->tdToArray($content);
       
       foreach ($list as $val){
           if(!$val){
               continue;
           }
           $info = Db::name('qstockservices')->where('symbol',trim($val[1]))->find();
           if(!$info){
               $idata = array(
                   'symbol' => trim($val[1]),
                   'systexId' => trim($val[1]),
                   'exchange' => "hnx",
                   'is_show' => 1,
                   'add_time' => time(),
               );
               $id = Db::name('qstockservices')->insertGetId($idata);
               
               $idata = array(
                   'is_show' => 1,
                   'qstockservices_id' => $id,
                   'symbol' => trim($val[1]),
                   'symbol_code' => trim($val[1]),
                   'add_time' => time()
                );
                
                Db::name('qstockservices_data')->insertGetId($idata);
           }
       }
    }
    
    public function getYuenanUpcom(){
        
       $content = $this->getWebTag('id="content-match"','https://data.masvn.com/vi/transaction_statistics/upcom','div');
        
       $list = $this->tdToArray($content);
       
       //print_r($list);exit;
       
       foreach ($list as $val){
           if(!$val){
               continue;
           }
           $info = Db::name('qstockservices')->where('symbol',trim($val[1]))->find();
           if(!$info){
               $idata = array(
                   'symbol' => trim($val[1]),
                   'systexId' => trim($val[1]),
                   'exchange' => "upcom",
                   'is_show' => 1,
                   'add_time' => time(),
               );
               $id = Db::name('qstockservices')->insertGetId($idata);
               
               $idata = array(
                   'is_show' => 1,
                   'qstockservices_id' => $id,
                   'symbol' => trim($val[1]),
                   'symbol_code' => trim($val[1]),
                   'add_time' => time()
                );
                
                Db::name('qstockservices_data')->insertGetId($idata);
           }
       }
    }
    
    function gsh($value){
        
        return intval(str_replace(',','',$value));
    }
    
    
    
    function tdToArray($table) {

    $table = preg_replace("'<table[^>]*?>'si","",$table);

    $table = preg_replace("'<tr[^>]*?>'si","",$table);

    $table = preg_replace("'<td[^>]*?>'si","",$table);

    $table = str_replace("</tr>","{tr}",$table);

    $table = str_replace("</td>","{td}",$table);

    //去掉 HTML 标记

    $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);

    //去掉空白字符

    $table = preg_replace("'([rn])[s]+'","",$table);

    $table = str_replace(" ","",$table);

    $table = str_replace(" ","",$table);

    $table = explode('{tr}', $table);

    array_pop($table);

    foreach ($table as $key=>$tr) {      // 自己可添加对应的替换

        $td = explode('{td}', $tr);

        array_pop($td);

        $td_array[] = $td;

    }

    return $td_array;

}

    function getWebTag($tag_id, $url = false, $tag = 'div', $data = false) {
    if ($url !== false) {
        $arrContextOptions = [
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                            ]
                        ];
        $data = file_get_contents ( $url,false,stream_context_create($arrContextOptions) );
    }
    $charset_pos = stripos ( $data, 'charset' );
    if ($charset_pos) {
        if (stripos ( $data, 'utf-8', $charset_pos )) {
            $data = iconv ( 'utf-8', 'utf-8', $data );
        } else if (stripos ( $data, 'gb2312', $charset_pos )) {
            $data = iconv ( 'gb2312', 'utf-8', $data );
        } else if (stripos ( $data, 'gbk', $charset_pos )) {
            $data = iconv ( 'gbk', 'utf-8', $data );
        }
    }
    preg_match_all ( '/<' . $tag . '/i', $data, $pre_matches, PREG_OFFSET_CAPTURE ); // 获取所有div前缀
    preg_match_all ( '/<\/' . $tag . '/i', $data, $suf_matches, PREG_OFFSET_CAPTURE ); // 获取所有div后缀
    $hit = strpos ( $data, $tag_id );
    if ($hit == - 1)
        return false; // 未命中
    $divs = array (); // 合并所有div
    foreach ( $pre_matches [0] as $index => $pre_div ) {
        $divs [( int ) $pre_div [1]] = 'p';
        $divs [( int ) $suf_matches [0] [$index] [1]] = 's';
    }
    // 对div进行排序
    $sort = array_keys ( $divs );
    asort ( $sort );
    $count = count ( $pre_matches [0] );
    foreach ( $pre_matches [0] as $index => $pre_div ) {
        // <div $hit <div+1 时div被命中
        if (($pre_matches [0] [$index] [1] < $hit) && ($hit < $pre_matches [0] [$index + 1] [1])) {
            $deeper = 0;
            // 弹出被命中div前的div
            while ( array_shift ( $sort ) != $pre_matches [0] [$index] [1] && ($count --) )
                continue;
                // 对剩余div进行匹配，若下一个为前缀，则向下一层，$deeper加1，
                // 否则后退一层，$deeper减1，$deeper为0则命中匹配，计算div长度
            foreach ( $sort as $key ) {
                if ($divs [$key] == 'p')
                    $deeper ++;
                else if ($deeper == 0) {
                    $length = $key - $pre_matches [0] [$index] [1];
                    break;
                } else {
                    $deeper --;
                }
            }
            $hitDivString = substr ( $data, $pre_matches [0] [$index] [1], $length ) . '</' . $tag . '>';
            break;
        }
    }
    return $hitDivString;
}
    
    
    /**
     * 获取所有数据  3秒一次
     */
    function getYueNanData(){
        
         
        $QchicangModel = new QchicangModel();
        
        if(!$QchicangModel->checkTime()){
            exit("非交易时间");
        }
        
        //参考原网站  https://tw.tradingview.com/markets/stocks-vietnam/market-movers-all-stocks/
        
        
        $url = "https://scanner.tradingview.com/vietnam/scan";
        
        $post_data = array(
            'columns' => ['name','close','change',"volume"]
        );
        
        $json = getSSLPage2($url,$post_data);
        
        $data = json_decode($json,true);
        
        $data = $data['data'];
        
        
        foreach ($data as $val){
            
            $upd_data = array(
                'bid' => gsh($val['d'][1]),
                'regularMarketPrice' => gsh($val['d'][1]),
                'regularMarketChangePercent' => $val['d'][2],
                'regularMarketVolume' =>  $val['d'][3],
            );
            
            $where = array();
            $where[] = array("symbol_code", "=", $val['d'][0]);
            $where[] = array("is_show", "=", 1);
            Db::name('qstockservices_data')->where($where)->update($upd_data);
        }
        
        echo "success";
    }
    
    
    
    
        
    public function json_test($res){
        if($res == 5){
            return '{
  "quoteResponse": {
    "result": [
      {
        "language": "zh-Hant-HK",
        "region": "TW",
        "quoteType": "EQUITY",
        "typeDisp": "股票",
        "quoteSourceName": "Delayed Quote",
        "triggerable": false,
        "customPriceAlertConfidence": "LOW",
        "currency": "TWD",
        "firstTradeDateMilliseconds": 946947600000,
        "priceHint": 2,
        "exchange": "TAI",
        "shortName": "TAIWAN CEMENT",
        "longName": "台泥",
        "messageBoardId": "finmb_877741_lang_zh",
        "exchangeTimezoneName": "Asia/Taipei",
        "exchangeTimezoneShortName": "CST",
        "gmtOffSetMilliseconds": 28800000,
        "market": "tw_market",
        "esgPopulated": false,
        "marketState": "REGULAR",
        "regularMarketChange": 0.15000153,
        "regularMarketChangePercent": 0.3236279,
        "regularMarketTime": 1650418024,
        "regularMarketPrice": 46.5,
        "regularMarketDayHigh": 46.75,
        "regularMarketDayRange": "46.4 - 46.75",
        "regularMarketDayLow": 46.4,
        "regularMarketVolume": 2056436,
        "regularMarketPreviousClose": 46.35,
        "bid": 46.5,
        "ask": 46.55,
        "bidSize": 0,
        "askSize": 0,
        "fullExchangeName": "Taiwan",
        "financialCurrency": "TWD",
        "regularMarketOpen": 46.5,
        "averageDailyVolume3Month": 12143608,
        "averageDailyVolume10Day": 16750348,
        "fiftyTwoWeekLowChange": 0.8499985,
        "fiftyTwoWeekLowChangePercent": 0.0186199,
        "fiftyTwoWeekRange": "45.65 - 58.7",
        "fiftyTwoWeekHighChange": -12.200001,
        "fiftyTwoWeekHighChangePercent": -0.20783646,
        "fiftyTwoWeekLow": 45.65,
        "fiftyTwoWeekHigh": 58.7,
        "earningsTimestamp": 1645786740,
        "earningsTimestampStart": 1652180340,
        "earningsTimestampEnd": 1652702400,
        "trailingAnnualDividendRate": 0,
        "trailingPE": 14.24196,
        "trailingAnnualDividendYield": 0,
        "epsTrailingTwelveMonths": 3.265,
        "epsForward": 3.68,
        "epsCurrentYear": 3.46,
        "priceEpsCurrentYear": 13.439306,
        "sharesOutstanding": 6116170240,
        "bookValue": 33.105,
        "fiftyDayAverage": 48.12,
        "fiftyDayAverageChange": -1.6199989,
        "fiftyDayAverageChangePercent": -0.033665814,
        "twoHundredDayAverage": 48.84675,
        "twoHundredDayAverageChange": -2.3467484,
        "twoHundredDayAverageChangePercent": -0.048043083,
        "marketCap": 284401926144,
        "forwardPE": 12.635869,
        "priceToBook": 1.4046217,
        "sourceInterval": 20,
        "exchangeDataDelayedBy": 20,
        "averageAnalystRating": "2.8 - Hold",
        "tradeable": false,
        "symbol": "1101.TW"
      },
      {
        "language": "zh-Hant-HK",
        "region": "TW",
        "quoteType": "EQUITY",
        "typeDisp": "股票",
        "quoteSourceName": "Delayed Quote",
        "triggerable": false,
        "customPriceAlertConfidence": "LOW",
        "currency": "TWD",
        "firstTradeDateMilliseconds": 946947600000,
        "priceHint": 2,
        "exchange": "TAI",
        "shortName": "ASIA CEMENT CORP",
        "longName": "亞泥",
        "messageBoardId": "finmb_877186_lang_zh",
        "exchangeTimezoneName": "Asia/Taipei",
        "exchangeTimezoneShortName": "CST",
        "gmtOffSetMilliseconds": 28800000,
        "market": "tw_market",
        "esgPopulated": false,
        "marketState": "REGULAR",
        "regularMarketChange": 0,
        "regularMarketChangePercent": 0,
        "regularMarketTime": 1650418007,
        "regularMarketPrice": 46.95,
        "regularMarketDayHigh": 47.25,
        "regularMarketDayRange": "46.9 - 47.25",
        "regularMarketDayLow": 46.9,
        "regularMarketVolume": 497778,
        "regularMarketPreviousClose": 46.95,
        "bid": 46.95,
        "ask": 47,
        "bidSize": 0,
        "askSize": 0,
        "fullExchangeName": "Taiwan",
        "financialCurrency": "TWD",
        "regularMarketOpen": 47,
        "averageDailyVolume3Month": 5048515,
        "averageDailyVolume10Day": 4823408,
        "fiftyTwoWeekLowChange": 4.950001,
        "fiftyTwoWeekLowChangePercent": 0.11785716,
        "fiftyTwoWeekRange": "42.0 - 54.3",
        "fiftyTwoWeekHighChange": -7.3499985,
        "fiftyTwoWeekHighChangePercent": -0.1353591,
        "fiftyTwoWeekLow": 42,
        "fiftyTwoWeekHigh": 54.3,
        "earningsTimestamp": 1648699200,
        "earningsTimestampStart": 1650970740,
        "earningsTimestampEnd": 1651492800,
        "trailingAnnualDividendRate": 3.55,
        "trailingPE": 10.017069,
        "trailingAnnualDividendYield": 0.07561235,
        "epsTrailingTwelveMonths": 4.687,
        "epsForward": 4.5,
        "epsCurrentYear": 4.58,
        "priceEpsCurrentYear": 10.251092,
        "sharesOutstanding": 3545570048,
        "bookValue": 44.022,
        "fiftyDayAverage": 46.628,
        "fiftyDayAverageChange": 0.3220024,
        "fiftyDayAverageChangePercent": 0.0069057737,
        "twoHundredDayAverage": 46.0175,
        "twoHundredDayAverageChange": 0.93249893,
        "twoHundredDayAverageChangePercent": 0.020264005,
        "marketCap": 166464520192,
        "forwardPE": 10.433333,
        "priceToBook": 1.0665122,
        "sourceInterval": 20,
        "exchangeDataDelayedBy": 20,
        "averageAnalystRating": "2.5 - Buy",
        "tradeable": false,
        "symbol": "1102.TW"
      }
    ],
    "error": null
  }
}';
        }
        if($res == 4){
            return '{"statusCode":200,"message":"OK","data":{"s":"ok","t":[1650346200,1650345900,1650345600,1650345300,1650345000,1650344700,1650344400,1650344100,1650343800,1650343500,1650343200,1650342900,1650342600,1650342300,1650342000,1650341700,1650341400,1650341100,1650340800,1650340500,1650340200,1650339900,1650339600,1650339300,1650339000,1650338700,1650338400,1650338100,1650337800,1650337500,1650337200,1650336900,1650336600,1650336300,1650336000,1650335700,1650335400,1650335100,1650334800,1650334500,1650334200,1650333900,1650333600,1650333300,1650333000,1650332700,1650332400,1650332100,1650331800,1650331500,1650331200,1650330900,1650330600,1650330300,1650330000],"o":[],"h":[],"l":[],"c":[204.76,205.09,205.12,205.19,205.27,205.28,205.4,205.41,205.06,204.93,205.0,205.04,205.04,205.06,205.15,205.1,205.17,205.21,205.24,205.32,205.44,205.5,205.62,205.65,205.72,205.8,205.75,205.61,205.57,205.55,205.52,205.68,205.59,205.68,205.71,205.71,205.55,205.63,205.77,205.92,205.84,205.81,206.04,206.06,206.18,206.33,206.37,206.57,206.41,206.47,206.39,206.51,206.47,206.25,206.13],"v":[],"vwap":[],"quote":{"0":"TWS:OTC01:INDEX","800013":"TWS:OTC01:INDEX","800041":0,"isTrading":0,"6":204.76,"200009":"櫃買指數","75":null,"11":0.65,"76":null,"12":206.62,"3404":null,"13":204.59,"800001":5.8286416E10,"21":204.11,"56":0.32},"session":[[1650330000,1650346500]],"nextTime":1650354557}}';
        }   
        if($res == 3){
            return '{"statusCode":200,"message":"OK","data":{"s":"ok","t":[1650354300,1650354000,1650353700,1650353400,1650353100,1650352800,1650352500,1650352200,1650351900,1650351600],"o":[],"h":[],"l":[],"c":[16976.0,16966.0,16963.0,16972.0,16979.0,16973.0,16970.0,16980.0,17017.0,17013.0],"v":[],"vwap":[],"quote":{"0":"TWF:TXF:FUTURES","800013":"TWF:TXF:FUTURES","800041":2,"isTrading":1,"6":16976.0,"200009":"台指期","75":18704.0,"11":-28.0,"76":15304.0,"12":17018.0,"3404":16981.3406,"13":16957.0,"800001":5846.0,"21":17004.0,"56":-0.16},"session":[[1650351600,1650402000],[1650415500,1650433500]],"nextTime":1650354574}}';
        }
        if($res == 2){
            return '{"statusCode":200,"message":"OK","data":{"s":"ok","t":[1650346200,1650345900,1650345600,1650345300,1650345000,1650344700,1650344400,1650344100,1650343800,1650343500,1650343200,1650342900,1650342600,1650342300,1650342000,1650341700,1650341400,1650341100,1650340800,1650340500,1650340200,1650339900,1650339600,1650339300,1650339000,1650338700,1650338400,1650338100,1650337800,1650337500,1650337200,1650336900,1650336600,1650336300,1650336000,1650335700,1650335400,1650335100,1650334800,1650334500,1650334200,1650333900,1650333600,1650333300,1650333000,1650332700,1650332400,1650332100,1650331800,1650331500,1650331200,1650330900,1650330600,1650330300,1650330000],"o":[],"h":[],"l":[],"c":[17005.58,17005.58,17009.11,17016.13,17015.22,17020.61,17021.22,17028.55,17012.5,17012.08,17022.63,17028.94,17032.79,17028.08,17030.71,17026.93,17022.62,17014.9,17018.61,17018.56,17022.46,17029.67,17034.7,17037.89,17033.95,17054.51,17047.85,17026.67,17024.08,17025.29,17030.39,17031.45,17036.52,17037.14,17031.01,17022.93,17025.82,17023.1,17041.72,17047.83,17060.54,17041.84,17055.13,17060.4,17074.2,17078.39,17078.54,17083.02,17098.23,17103.71,17067.64,17065.09,17073.36,17047.69,17035.25],"v":[],"vwap":[],"quote":{"0":"TWS:TSE01:INDEX","800013":"TWS:TSE01:INDEX","800041":0,"isTrading":0,"6":16993.4,"200009":"台灣加權指數","75":null,"11":94.53,"76":null,"12":17106.26,"3404":null,"13":16926.34,"800001":2.28474E11,"21":16898.87,"56":0.56},"session":[[1650330000,1650346500]],"nextTime":1650354566}}';
        }
        
        
        
        if($res == 1){
            return '{
  "quoteResponse": {
    "result": [
      {
        "language": "zh-Hant-HK",
        "region": "TW",
        "quoteType": "EQUITY",
        "typeDisp": "股票",
        "quoteSourceName": "Delayed Quote",
        "triggerable": false,
        "customPriceAlertConfidence": "LOW",
        "currency": "TWD",
        "firstTradeDateMilliseconds": 946947600000,
        "priceHint": 2,
        "exchange": "TAI",
        "shortName": "TAIWAN CEMENT",
        "longName": "台泥",
        "messageBoardId": "finmb_877741_lang_zh",
        "exchangeTimezoneName": "Asia/Taipei",
        "exchangeTimezoneShortName": "CST",
        "gmtOffSetMilliseconds": 28800000,
        "market": "tw_market",
        "esgPopulated": false,
        "marketState": "REGULAR",
        "regularMarketChange": 0.15000153,
        "regularMarketChangePercent": 0.3236279,
        "regularMarketTime": 1650418024,
        "regularMarketPrice": 46.5,
        "regularMarketDayHigh": 46.75,
        "regularMarketDayRange": "46.4 - 46.75",
        "regularMarketDayLow": 46.4,
        "regularMarketVolume": 2056436,
        "regularMarketPreviousClose": 46.35,
        "bid": 46.5,
        "ask": 46.55,
        "bidSize": 0,
        "askSize": 0,
        "fullExchangeName": "Taiwan",
        "financialCurrency": "TWD",
        "regularMarketOpen": 46.5,
        "averageDailyVolume3Month": 12143608,
        "averageDailyVolume10Day": 16750348,
        "fiftyTwoWeekLowChange": 0.8499985,
        "fiftyTwoWeekLowChangePercent": 0.0186199,
        "fiftyTwoWeekRange": "45.65 - 58.7",
        "fiftyTwoWeekHighChange": -12.200001,
        "fiftyTwoWeekHighChangePercent": -0.20783646,
        "fiftyTwoWeekLow": 45.65,
        "fiftyTwoWeekHigh": 58.7,
        "earningsTimestamp": 1645786740,
        "earningsTimestampStart": 1652180340,
        "earningsTimestampEnd": 1652702400,
        "trailingAnnualDividendRate": 0,
        "trailingPE": 14.24196,
        "trailingAnnualDividendYield": 0,
        "epsTrailingTwelveMonths": 3.265,
        "epsForward": 3.68,
        "epsCurrentYear": 3.46,
        "priceEpsCurrentYear": 13.439306,
        "sharesOutstanding": 6116170240,
        "bookValue": 33.105,
        "fiftyDayAverage": 48.12,
        "fiftyDayAverageChange": -1.6199989,
        "fiftyDayAverageChangePercent": -0.033665814,
        "twoHundredDayAverage": 48.84675,
        "twoHundredDayAverageChange": -2.3467484,
        "twoHundredDayAverageChangePercent": -0.048043083,
        "marketCap": 284401926144,
        "forwardPE": 12.635869,
        "priceToBook": 1.4046217,
        "sourceInterval": 20,
        "exchangeDataDelayedBy": 20,
        "averageAnalystRating": "2.8 - Hold",
        "tradeable": false,
        "symbol": "1101.TW"
      },
      {
        "language": "zh-Hant-HK",
        "region": "TW",
        "quoteType": "EQUITY",
        "typeDisp": "股票",
        "quoteSourceName": "Delayed Quote",
        "triggerable": false,
        "customPriceAlertConfidence": "LOW",
        "currency": "TWD",
        "firstTradeDateMilliseconds": 946947600000,
        "priceHint": 2,
        "exchange": "TAI",
        "shortName": "ASIA CEMENT CORP",
        "longName": "亞泥",
        "messageBoardId": "finmb_877186_lang_zh",
        "exchangeTimezoneName": "Asia/Taipei",
        "exchangeTimezoneShortName": "CST",
        "gmtOffSetMilliseconds": 28800000,
        "market": "tw_market",
        "esgPopulated": false,
        "marketState": "REGULAR",
        "regularMarketChange": 0,
        "regularMarketChangePercent": 0,
        "regularMarketTime": 1650418007,
        "regularMarketPrice": 46.95,
        "regularMarketDayHigh": 47.25,
        "regularMarketDayRange": "46.9 - 47.25",
        "regularMarketDayLow": 46.9,
        "regularMarketVolume": 497778,
        "regularMarketPreviousClose": 46.95,
        "bid": 46.95,
        "ask": 47,
        "bidSize": 0,
        "askSize": 0,
        "fullExchangeName": "Taiwan",
        "financialCurrency": "TWD",
        "regularMarketOpen": 47,
        "averageDailyVolume3Month": 5048515,
        "averageDailyVolume10Day": 4823408,
        "fiftyTwoWeekLowChange": 4.950001,
        "fiftyTwoWeekLowChangePercent": 0.11785716,
        "fiftyTwoWeekRange": "42.0 - 54.3",
        "fiftyTwoWeekHighChange": -7.3499985,
        "fiftyTwoWeekHighChangePercent": -0.1353591,
        "fiftyTwoWeekLow": 42,
        "fiftyTwoWeekHigh": 54.3,
        "earningsTimestamp": 1648699200,
        "earningsTimestampStart": 1650970740,
        "earningsTimestampEnd": 1651492800,
        "trailingAnnualDividendRate": 3.55,
        "trailingPE": 10.017069,
        "trailingAnnualDividendYield": 0.07561235,
        "epsTrailingTwelveMonths": 4.687,
        "epsForward": 4.5,
        "epsCurrentYear": 4.58,
        "priceEpsCurrentYear": 10.251092,
        "sharesOutstanding": 3545570048,
        "bookValue": 44.022,
        "fiftyDayAverage": 46.628,
        "fiftyDayAverageChange": 0.3220024,
        "fiftyDayAverageChangePercent": 0.0069057737,
        "twoHundredDayAverage": 46.0175,
        "twoHundredDayAverageChange": 0.93249893,
        "twoHundredDayAverageChangePercent": 0.020264005,
        "marketCap": 166464520192,
        "forwardPE": 10.433333,
        "priceToBook": 1.0665122,
        "sourceInterval": 20,
        "exchangeDataDelayedBy": 20,
        "averageAnalystRating": "2.5 - Buy",
        "tradeable": false,
        "symbol": "1102.TW"
      }
    ],
    "error": null
  }
}';
        }
        
    }
    
    
}