<?php namespace app\api\controller;

use think\Db;
use app\common\controller\Stock;


class Order extends Base
{
    //无需登录的方法,同时也就不需要鉴权了
    protected $noNeedLogin = ['closeAnAccount'];
    //无需鉴权的方法,但需要登录
    protected $noNeedRight = ['*'];
    
    
    /**
     * 购买基金
     * 
     * @param int $code 基金代码
     * @param int $sum 金额
     * @param int $payPassword 支付密码
     * @return json 结果
     */ 
    public function purchase()
    {
      $params = $this->request->post();
      $userData = $this->auth->getUser(); //用户信息

      $userData = Db::table('me_users')->where('id',$userData['id'])->find();
      if((date('w') == 6) || (date('w') == 0)) return $this->error("周末休盘");
      
      //校验参数是否合法
      if(empty($params['sum'])) return $this->error("金额不能为空");
      if(empty($params['code'])) return $this->error("基金代码不能为空");
      if(empty($params['payPassword'])) return $this->error("支付密码不能为空");
      if($params['sum'] < 1) return $this->error("公募基金最少1元起购");
        
      $verify = Db::table('me_fund')->where('fund_code',$params['code'])->find();
      if($verify == null) return $this->error("基金代码不存在");
      if(getEncryptPassword($params['payPassword']) != $userData['pay_password']) return $this->error("支付密码错误！");
      
      //查看金额是否足够
      if($userData['money'] < $params['sum']) return $this->error("您当前钱包余额不足！");
      $deduct = Db::table('me_users')->where('id',$userData['id'])->update(['money'=>$userData['money'] - $params['sum']]);
      if(!$deduct) return $this->error("错误错误错误！");
      
      //扣除服务费
      $maintenance = $params['sum'] * 0.015; //管理费
      $trustee = $params['sum'] * 0.0025; //托管费
      $service = $params['sum'] * 0.005; // 服务费
      $money = $params['sum'] - $maintenance - $trustee - $service; //扣除后的费用
      
     //基金信息
      $stock = new Stock();
      $stockData = Db::table('me_fund_history')->where('fund_code',$params['code'])->order("date desc")->find();
      if(empty($stockData)) return $this->error("购买失败基金内部错误，请类型客服！");
      $atpresentNetvalue = $stockData['net_value'];//单位净值
      $addupNetvalue = $stockData['total_value'];//累计净值
       
      //加入订单
      $insert['user_id'] = $userData['id'];
      $insert['code'] = $params['code'];
      $insert['sum'] = $params['sum'];
      $insert['money'] = $money;
      $insert['createtime'] = time();
      $insert['status'] = 1;
      $insert['maintenance'] = $maintenance;
      $insert['trustee'] = $trustee;
      $insert['service'] = $service;
      $insert['worth'] = $atpresentNetvalue;
      $insert['add_worth'] = $addupNetvalue;
      $result = Db::table('me_order')->insert($insert);
      if($result){
          //加入日志
             $log['user_id'] = $userData['id'];
             $log['content'] = "基金购买成功,扣除服务费还有".$money."￥";
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
         return $this->success("购买成功！"); 
      }
      return $this->error("失败失败失败");
          
    }
    
    /**
     * 收益列表
     * @param int $status 状态[1:获取所有基金收益,2:获取当前基金的所有收益]
     * @param int $order_id 订单id[状态等于2时填入]
     */
     public function returnsList()
     {
        $params = $this->request->post();
        $userData = $this->auth->getUser(); //用户信息 
       // $userData['id'] =1;
        
        if(empty($params['status'])) return $this->error("status必填参数"); 
        
        //校验调用的是所有还是code查询
        if($params['status'] == 2){
            $where = [
                'user_id' => $userData['id'],
                'o.order_id' => $params['order_id'],
            ];
            $where1 = [
                'user_id' => $userData['id'],
                'order_id' => $params['order_id'],
                ];
        }else{
           $where = [
                'user_id' => $userData['id'],
            ]; 
          $where1 = [
            'user_id' => $userData['id'],
            ];
        }
        //查询数据
        $res = Db::table('me_orderinfo')->alias("o")->join('me_fundcode f', 'o.code = f.code')
        ->field('o.code,o.earningstime,o.sum,f.fund_name')
        ->order('o.earningstime','desc')
        ->where($where)->select();
        
        $accumulatedIncome = Db::table('me_orderinfo')->where($where1)->sum('sum');
        $data['accumulatedIncome'] = $accumulatedIncome;
        $data['data'] = $res;
        
        if($res){
            return $this->success("获取成功",$data); 
        }
        return $this->error("暂时没有收益！");
     }
     
     /**
      * 订单列表
      * 
      * @param int $order_id 订单id
      */ 
     public function orderList()
     {
         $params = $this->request->post();
         $userData = $this->auth->getUser(); //用户信息 
         //$userData['id'] = 118;
        //  $params['order_id'] = 6;
         if(empty($params['order_id'])){
              
             $data = Db::table('me_order')
                    ->alias("o")
                    ->field('o.code,o.createtime,o.sum,o.money,f.fund_name,o.id')
                    ->join('me_fundcode f', 'o.code = f.code')
                    ->order('createtime desc')
                    ->where('user_id',$userData['id'])
                    ->select();
                    
            if($data == null) return $this->error("暂时没有数据");  
            
            $arr = [];
            $andMoney = 0; //总金额
            $andYesterday = 0; //昨日收益总和
            $andEarnings = 0; //总收益
            foreach($data as $v){
                $res = Db::table('me_orderinfo')->where('order_id',$v['id'])->order('earningstime desc')->find();
                if( $res != null ){
                   $sumMoney = Db::table('me_orderinfo')->where('order_id',$v['id'])->sum('sum');
                    $v['yesterday'] = $res['sum'];
                    $v['ayerTime'] = date("Y-m-d",$res['earningstime']);
                    $v['worth'] = $res['worth'];
                    $v['amplification'] = $res['amplification'];
                    $v['sumMoney'] = $sumMoney;
                    $arr[] = $v;
                    
                    $andMoney = $andMoney + $v['money'];
                    $andYesterday = $andYesterday + $res['sum'];
                    $andEarnings = $andEarnings + $sumMoney;
                }
            }
            $content['data'] = $arr;
            $content['andMoney'] = $andMoney;
            $content['andYesterday'] = $andYesterday;
            $content['andEarnings'] = $andEarnings;
            
            return $this->success("获取成功",$content);
         }else{  //查询单条
             
             $data = Db::table('me_order')
                    ->alias("o")
                    ->field('o.code,o.createtime,o.sum,o.money,f.fund_name,o.id')
                    ->join('me_fundcode f', 'o.code = f.code')
                    ->order('createtime desc')
                    ->where(['user_id'=>$userData['id'],'o.id'=>$params['order_id']])
                    ->select();
                    
            if(count($data) < 1) return $this->error("暂时没有数据");  
            
            $content = [];
           
            foreach($data as $v){
                $res = Db::table('me_orderinfo')->where('order_id',$v['id'])->order('earningstime','desc')->find();
                if( $res != null ){
                   $sumMoney = Db::table('me_orderinfo')->where('order_id',$v['id'])->sum('sum');
                    $v['yesterday'] = $res['sum'];
                    $v['ayerTime'] = date("Y-m-d",$res['earningstime']);
                    $v['worth'] = $res['worth'];
                    $v['amplification'] = $res['amplification'];
                    $v['sumMoney'] = $sumMoney;
                    $content[] = $v; 
                }
            }
            $content['earnings'] =  Db::table('me_orderinfo')->where('order_id',$params['order_id'])->field('sum,earningstime')->select();
            
            return $this->success("获取成功",$content);
         }
         
        
     }
    
    /**
     * 每日结算
     * 
     */ 
    public function closeAnAccount()
    {
        if((date('w') == 6) || (date('w') == 0)) return $this->error("周末休盘");
        
        //收益账单
        $data = Db::table('me_order')->where('status',1)->select();
        if(empty($data)) return $this->error("收益结束");
           
          $succeed = 0;  //成功条数
          $error = 0;  // 失败
          $codeErroe = 0; //基金代码错误
          $notUpdated = 0;//没更新
          $sums = count($data);
        foreach($data as $v){
            $verify = Db::table('me_fund')->where('fund_code',$v['code'])->find();
            if(empty($verify)){echo $v['code'].'-';$codeErroe++;continue;}
        
           //基金数据
            $stock = new Stock();
            $stockData = $stock->stock($v['code'],1);
                
            $updateTime = strtotime($stockData['net_value_date']); //基金最近更新时间
            $presentTime = strtotime(date('Y-m-d',time())); //当前时间
            
            if(empty($stockData['day_of_growth'])){  //没有涨幅
                $insert['user_id'] = $v['user_id'];
                $insert['sum'] = 0;
                $insert['earningstime'] = time();
                $insert['code'] = $v['code'];
                    $insert['worth'] = $stockData['net_value'];
                $insert['amplification'] = 0;
                $res = Db::table('me_orderinfo')->insert($insert);
                if(!$res){$error++;continue;}
                
                //更新金额
                $updates = Db::table('me_order')->where('id',$v['id'])->update(['money'=>$v['money']]);
                if($updates){
                    $succeed++;
                    continue;
                }
                $error++;continue;
            }
            $amountOfIncrease = $stockData['day_of_growth']; //今日涨幅
            
            //计算收益
            if($amountOfIncrease < 0){ //校验涨幅
                $amountOfIncreases = $amountOfIncrease * -1;
                $amountOfIncreases = $amountOfIncreases / 100;
                $money = $v['money'] - ($v['money'] * $amountOfIncreases);
                $sum = '-'.$v['money'] * $amountOfIncreases; //亏
            }else{
                $amountOfIncrease = $amountOfIncrease / 100;
                $money = $v['money'] + ($v['money'] * $amountOfIncrease);
                $sum = $v['money'] * $amountOfIncrease;//赢
            }
            
            if($updateTime == $presentTime){  //查看今日是否有更新数据
                $insert['user_id'] = $v['user_id'];
                 $insert['order_id'] = $v['id'];
                $insert['sum'] = $sum;
                $insert['earningstime'] = time();
                $insert['code'] = $v['code'];
                $insert['worth'] = $stockData['net_value'];
                $insert['amplification'] = $stockData['day_of_growth'];
                $res = Db::table('me_orderinfo')->insert($insert);
                if(!$res){$error++;continue;}
                
                //更新金额
                $updates = Db::table('me_order')->where('id',$v['id'])->update(['money'=>$money]);
                if($updates){
                    
                    //加入日志
                     $log['user_id'] = $v['user_id'];
                     $log['content'] = "基金收益".$sum.'￥';
                     $log['createtime'] = time();
                     Db::table('me_log')->insert($log);
             
                    $succeed++;
                    continue;
                }
                
            }else{
               $notUpdated++;
                continue;
            }
            
        }
        $information = "一共".$sums."条收益数据，成功:".$succeed.'条、失败:'.$error."条、基金代码错误:".$codeErroe.'条、基金未更新:'.$notUpdated.'条！';
        Db::table('me_log')->insert(['user_id' => 0,'content'=>$information,'createtime'=>time()]);
        return $information;
    }
    
    
    /**
     * 充值订单
     * 
     * @param int $money 充值金额
     * @return json 结果
     */ 
    public function recharge()
    {
         $params = $this->request->post();
         $userData = $this->auth->getUser(); //用户信息 

         if($params['money'] < 1) return $this->error("充值金额不能小于1"); 
         if($params['money'] > 100000) return $this->error("充值金额不能大于100000"); 
         
         //生成订单
         $id = "SZP".rand(1,100).time().rand(1000,9999);
         $insert['id'] = $id;
         $insert['user_id'] = $userData['id']; 
         $insert['money'] = $params['money']; 
         $insert['type'] = 1; 
         $insert['createtime'] = time(); 
         $insert['status'] = 1; 
         $resInsert = Db::table('me_withdrawal')->insert($insert);
         
         if($resInsert){
             //加入日志
             $log['user_id'] = $userData['id'];
             $log['content'] = "充值".$params['money']."￥成功，等待后台审核通过！";
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
             
            return $this->success("充值成功，等待后台审核通过！"); 
         }
        return $this->error("充值失败"); 
         
    }
    
    /**
     * 提现订单
     * 
     * @param int $money 充值金额
     * @param int $payPassword 支付密码
     * @return json 结果
     */ 
    public function deposit()
    {
      $params = $this->request->post();
      $userData = $this->auth->getUser(); //用户信息   
      $userData = Db::table('me_users')->where('id',$userData['id'])->find();
        //校验参数是否合法
      if(empty($params['money'])) return $this->error("金额不能为空");
      if(empty($params['payPassword'])) return $this->error("支付密码不能为空");
      if($params['money'] < 1) return $this->error("充值金额不能小于1"); 
      if($params['money'] > 100000) return $this->error("充值金额不能大于100000");     
      if(getEncryptPassword($params['payPassword']) != $userData['pay_password']) return $this->error("支付密码错误！");
      
      //查看金额是否足够
      if($userData['money'] < $params['money']) return $this->error("您当前钱包余额不足！");
      $deduct = Db::table('me_users')->where('id',$userData['id'])->update(['money'=>$userData['money'] - $params['money']]);
      if($deduct){
          //加入日志
          $log['user_id'] = $userData['id'];
          $log['content'] = "提现扣除".$params['money'].'￥';
          $log['createtime'] = time();
          Db::table('me_log')->insert($log);
      }else{
          return $this->error("提现失败"); 
      }
      
      //生成订单
         $id = "SZP".rand(1,100).time().rand(1000,9999);
         $insert['id'] = $id;
         $insert['user_id'] = $userData['id']; 
         $insert['money'] = $params['money']; 
         $insert['type'] = 2; 
         $insert['createtime'] = time(); 
         $insert['status'] = 1; 
         $insert['bank_id'] = $params['bank_id'];
         $resInsert = Db::table('me_withdrawal')->insert($insert);
         
         if($resInsert){
             //加入日志
             $log['user_id'] = $userData['id'];
             $log['content'] = "提现".$params['money'].'成功，请耐心等待后台审核通过！';
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
             
            return $this->success("提现成功，等待后台审核通过！"); 
         }
        return $this->error("提现失败");
      
    }
    
    /**
     * 基金卖出
     */ 
    public function sellOut()
    {
      $params = $this->request->post();
      $userData = $this->auth->getUser(); //用户信息  
     // $userData['id'] = 1;
      $userData = Db::table('me_users')->where('id',$userData['id'])->find();
        //校验参数是否合法
      if(empty($params['money'])) return $this->error("金额不能为空");
      if(empty($params['payPassword'])) return $this->error("支付密码不能为空");
      if($params['money'] < 1) return $this->error("充值金额不能小于1"); 
      if($params['money'] > 100000) return $this->error("充值金额不能大于100000");  
      if(empty($params['oid'])) return $this->error("订单id不能为空");
      if(empty($params['status'])) return $this->error("卖出类型不能为空");
      if(getEncryptPassword($params['payPassword']) != $userData['pay_password']) return $this->error("支付密码错误！");
      
      $oData = Db::table('me_order')->where(['user_id' => $userData['id'],'id' => $params['oid']])->find();
      if($oData == null ) return $this->error("订单错误，或非法进入！");
      //查看金额是否足够
      if($oData['money'] < $params['money']) return $this->error("您当前基金余额不足！");
      $deduct = Db::table('me_order')->where(['user_id' => $userData['id'],'id' => $params['oid']])->update(['money'=>$oData['money'] - $params['money']]);
      
       //加入日志
     if($deduct){
          $log['user_id'] = $userData['id'];
          $log['content'] = "卖出基金金额扣除".$params['money'].'元';
          $log['createtime'] = time();
          Db::table('me_log')->insert($log);
      }else{
          return $this->error("扣除失败"); 
      }
      
     //生成订单
        
      //卖出类型
      if($params['status'] == 1){//1卖出到钱包2卖出到银行卡
        
         $id = "SZP".rand(1,100).time().rand(1000,9999);
         $insert['id'] = $id;
         $insert['user_id'] = $userData['id']; 
         $insert['money'] = $params['money']; 
         $insert['type'] = 3; 
         $insert['createtime'] = time(); 
         $insert['status'] = 2; 
         $insert['bank_id'] = 2; 
         $insert['o_id'] = $params['oid']; 
         
         //加入钱包
         $deducts = Db::table('me_users')->where('id',$userData['id'])->update(['money'=>$userData['money'] + $params['money']]);
         //加入日志
         if($deducts){
             $content = "卖出成功，金额已达钱包！";
             $log['user_id'] = $userData['id'];
             $log['content'] = "卖出到钱包已到账".$params['money'].'元';
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
         }
         
      }elseif($params['status'] == 2){
         $id = "SZP".rand(1,100).time().rand(1000,9999);
         $insert['id'] = $id;
         $insert['user_id'] = $userData['id']; 
         $insert['money'] = $params['money']; 
         $insert['type'] = 4; 
         $insert['createtime'] = time(); 
         $insert['status'] = 1; 
         $insert['bank_id'] = $params['bank_id']; 
         $insert['o_id'] = $params['oid']; 
         $content = "卖出成功，等待后台审核通过！";
      }
      
         $resInsert = Db::table('me_withdrawal')->insert($insert);
         if($resInsert){
             //加入日志
             $log['user_id'] = $userData['id'];
             $log['content'] = "卖出".$params['money'].'成功，请耐心等待后台审核通过！';
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
             
            return $this->success($content); 
         }
      return $this->error("错误错误请联系客服！"); 
    }
    
    /**
     * 获取卖出列表
     */ 
     public function sellOutList()
     {
        $params = $this->request->post();
        $userData = $this->auth->getUser(); //用户信息
        //$userData['id'] = 1;
        $data = Db::table('me_withdrawal')
            ->alias("w")
            ->where("(w.type = 3 || w.type = 4) && w.user_id = {$userData['id']}")
            ->join('me_order o', 'w.o_id = o.id')
            ->join('me_fund f', 'o.code = f.fund_code ')
            ->field("w.id,w.money,w.createtime,w.status,w.o_id,f.fund_name_abbr")
            ->select();
        //$sql = "select * from me_withdrawal where (type = 3 || type = 4) && user_id = {$userData['id']} order by ";
        if($data != null){
            return $this->success('获取成功',$data); 
        }
        return $this->error("暂时没有数据！"); 
     }
     
    /**
     * 买入卖出单个基金记录
     */ 
    public function goinandout()
    {
       $params = $this->request->post();
       $userData = $this->auth->getUser(); //用户信息 
    }
    
    /**
     * 通知
     */ 
    public function inform()
    {
       $params = $this->request->post();
       $userData = $this->auth->getUser(); //用户信息  

       $logData = Db::table('me_log')->where('user_id',$userData['id'])->order('createtime desc')->select();
       if(count($logData) > 0){
           return $this->success("获取成功",$logData); 
       }
       return $this->error("暂无信息！");
    }
     
    
}
