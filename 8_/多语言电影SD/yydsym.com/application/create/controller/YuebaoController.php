<?php

namespace app\create\controller;

use think\Controller;
use think\Db;

class YuebaoController extends Controller
{

    public function initialize()
    {
        header('Access-Control-Allow-Origin:*');
    }
    
    
    //每日余额宝收益
    public function index()
    {
        $today_ymd = date('Y-m-d H:i:s', time());
        $today = time();
        $returnstr = '';
        $daynum = 0;//利息计算天数
        $lixi = 0;
        
        
    
        //查询购买批次
        $batch_array = Db::table('ly_yuebao_batch')->where('is_back', 0)->select();
        if($batch_array) foreach($batch_array as $key => $val){
            $daynum = $lixi = 0;
            
            //根据批次及收益天数判断当天是否重复计算收益
            /*
            $starttime  = time();//$val['starttime'];
            $oneday_go  = strtotime($val['batch'] + $val['days']);
            $oneday_end = strtotime($val['batch'] + $val['days'].'23:59:59');
            if($starttime >= $oneday_go && $starttime <= $oneday_end){
                echo 'buytime';
            }else{
                echo 'no buytime';
                echo "<br />$starttime====$oneday_go===$oneday_end";
            }
die();
*/
/*
            //当前时间小于等于完成时间时计算对应利润
            if($today <= $val['endtime']){

                //计算购买时间
                $daynum         = ceil(($today - $val['buytime']) / 86400);
                if($daynum > $val['days']){
*/
            //判断本日是否重复计算利润
            $xianzai = intval(date('Ymd',time()));
            $zhiqian = intval(date('Ymd', $val['starttime']));
            if( $xianzai > $zhiqian){
                
                $daynum = $val['days'] + 1;//已经计算利润天数
                $rwdays = Db::table('ly_yuebao_list')->where('id', $val['pid'])->value('time');
                if($rwdays){
                    if($daynum <= $rwdays){//超出活动天数，则不计算收益
                        $lixi           = $val['income'] + $val['money'] * $val['lilv'];
                        //更新批次表
                        $is_update_cmd = array(
                            'starttime'   => time(),//记录收益上一次计算时间
                            'income'      => $lixi,
                            'days'        => $daynum,
                        );
                        //更新当前批次利润及发放天数
                        Db::table('ly_yuebao_batch')->where('id', $val['id'])->update($is_update_cmd);
                        
                        $returnstr .= PHP_EOL . $today_ymd.'===== UID: '.$val['uid'].' 通过收益宝产品ID: '.$val['pid'].'======获得收益宝利息： '.$lixi . PHP_EOL.'<br />';
                    }else{
                        $returnstr .= PHP_EOL ."UID:$val[uid]收益宝的利润已经全部计算完毕。". PHP_EOL;
                    }
                }else{
                    $returnstr .= PHP_EOL ."UID:$val[uid]没有找到产品数据。". PHP_EOL;
                }
            }else{
                $returnstr .= PHP_EOL ."UID:$val[uid]当日利润已经计算过了。". PHP_EOL;
            }
                
                    
/*
                }else{
                    
                }
                

            }
*/
        }
        
 
        return $returnstr;
    }
    
    //自动返还本金和利息到客户账户
    public function autoReturnMoney()
    {
        $returnstr  = '';
        //检测所有项目
        $list = Db::table('ly_yuebao_list')->where('stat', 1)->select();
        if($list) foreach($list as $key => $val)
        {
            //检测是否有可返还的批次
            $batch = Db::table('ly_yuebao_batch')
                ->where('days','>=', $val['time'])
                ->where('pid', $val['id'])
                ->where('is_back', 0)
                ->select();
            if($batch) foreach($batch as $rs)
            {
                $getUsers             = Db::table('ly_users')->field('id,sid,username')->where('id', $rs['uid'])->find();
                if(!$getUsers){
                    $returnstr  .= PHP_EOL.'[查询用户]===找不到用户 uid:'.$rs['uid'].PHP_EOL;
                    break;
                }
                
                $getUserTotal         = Db::table('ly_user_total')->where('uid',  $rs['uid'])->find();
                if(!$getUserTotal){
                    $returnstr  .= PHP_EOL.'[查询用户账户]===找不到用户 uid:'.$rs['uid'].PHP_EOL;
                    break;
                }
                //本金+利润
                $allmoney = $rs['money'] + $rs['income'];
                //增加余额
                $balance = $getUserTotal['balance'] + $allmoney;
                $userTotalStatus = Db::table('ly_user_total')->where(array('id' => $getUserTotal['id']))->update(array('balance' => $balance));
                if ($userTotalStatus !== 1) {
                    $returnstr  .= PHP_EOL.'[更新账户]===更新失败 id:'.$getUserTotal['id'].PHP_EOL;
                    break;
                }
                //增加流水
                $financialArray = [];
                $financialArray['uid'] = $getUsers['id'];
                $financialArray['sid'] = $getUsers['sid'];
                $financialArray['username'] = $getUsers['username'];
                $financialArray['order_number'] = 'Y' . trading_number();
                $financialArray['trade_number'] = 'L' . trading_number();
                $financialArray['trade_type'] = 16;
                $financialArray['trade_before_balance'] = $getUserTotal['balance'];
                $financialArray['trade_amount'] = $allmoney;
                $financialArray['account_balance'] = $balance;
                $financialArray['remarks'] = '收益宝-系统自动释放收益宝产品本金和收益====产品ID'.$rs['pid'];
                $financialArray['types'] = 1;    // 用户1，商户2
    
                model('common/TradeDetails')->tradeDetails($financialArray);
                //修改批次状态为已追回
                Db::table('ly_yuebao_batch')->where('id', $rs['id'])->update(array('is_back'=>1));
                //修改购买明细状态
                Db::table('ly_yuebao_pay')
                    ->where('uid',$rs['uid'])
                    ->where('yuebaoid', $rs['pid'])
                    ->where('days', $rs['batch'])
                    ->update(array('status' => 2));
                $returnstr  .= PHP_EOL.'[收益宝自动完结]===完成批次id:'.$rs['id'].PHP_EOL;
            }
        }
        if($returnstr == ''){
            $returnstr = PHP_EOL .'[收益宝自动完结]=====没有找到可完成的批次'. PHP_EOL;
        }
        return $returnstr;
    }
    
    //自动更新代理线
    public function auto_s_dailixian()
    {
        $dailixian = 0;
        $ids = [];
        $ids = Db::table('ly_users')->field('id,sid,user_type')->where([])->select();
        
        $res = Db::table('ly_user_team')->where('dailixian', '0')->select();
        if($res) foreach($res as $val){
            

            echo ''.$val['uid'].',代理线：';
            $rs = $this->get_category($val['uid']);
            foreach($rs as $k => $v){
                if($v['user_type'] == 1 || $v['sid'] == 0){
                    Db::table('ly_user_team')->where('id', $val['id']) -> update(['dailixian' => $v['id']]);
                    echo $v['username'];
                    break;
                }
            }
                

        }
    
    }

    function get_category($id){
        $str=array();
        $result = Db::table('ly_users')->field('id,sid,username,user_type')->where('id',$id)->find();
        if($result){
            $str = $this->get_category($result['sid']);
            $str[]=$result;
        }
        return $str;
    }
}