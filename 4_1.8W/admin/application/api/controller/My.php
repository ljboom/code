<?php namespace app\api\controller;

use think\Db;
use app\api\model\User as UserModel;
use app\api\model\Code as CodeModel;
use app\api\model\Fund;
use app\api\model\Order;

class My extends Base
{
    //无需登录的方法,同时也就不需要鉴权了
    protected $noNeedLogin = ['service'];
    //无需鉴权的方法,但需要登录
    protected $noNeedRight = ['*'];
   
   /**
    * 获取用户详细信息
    */ 
   public function userData()
   {
       $user = $this->auth->getUserInfo();  //信息

        //公募只数
        $public_number = 0;
        //公募总金额
        $public_total_money = 0;
        //私募只数
        $private_number = 0;
        //私募总金额
        $private_total_money = 0;
        //关联查询
       $fund_order = Order::with(['fund'])->where(['user_id' => 1])->select();
       foreach($fund_order as $key => $val){
           switch ($val['fund']['type']) {
               case Fund::TYPE_PUBLIC:
                    $public_number++;
                    $public_total_money+=$val['sum'];
                   break;
               case Fund::TYPE_PRIVATE:
                    $private_number++;
                    $private_total_money+=$val['sum'];
                   break;
           }
       }
        //私募基金
       $data['private_fund'] = [
            'total_money' => $private_total_money,//总金额
            'number' => $private_number, //只数
        ];
        //公募基金
        $data['public_fund'] = [
            'total_money' => $public_total_money,//总金额
            'number' => $public_number, //只数
        ];
        
       $data['sum_money'] = $public_total_money + $user['money'] + $private_total_money;
      return $this->success("获取成功", array_merge($user, $data)); 
   }
   
   /**
    * 获取用户信息
    */ 
   public function user()
   {
        $userDatas = $this->auth->getUser();  //信息
       
         //排除数据
       $userData = Db::table('me_users')->where('id',$userDatas['id'])->field("mobile,head_avatar,id")->find();
       $data['mobile'] = $userData['mobile'];
       $data['head_avatar'] = $userData['head_avatar'];
       $datas = Db::table('me_userinfo')->where('user_id',$userDatas['id'])->find();
       
       $data['name'] = $datas['name'];
       $data['number'] = $datas['number'];
       
       return $this->success("获取成功",$data);  
   }
   
   /**
    * 修改登录手机号
    */ 
    public function updatePhone()
    {
        $params = $this->request->post();
        $userData = $this->auth->getUser();  //信息
        
        if(empty($params['status'])){
            if(!CodeModel::check($params['mobile'], $params['code'])){
                 return $this->error("验证码错误");
            }else{
                return $this->success("验证成功",1);  
            }
        }
        
        if(CodeModel::check($params['phone'], $params['code2'])){
            $user = Db::table('me_users')->where('mobile',$params['phone'])->find();
           
            if(!$user == null) return $this->error("手机号已被注册");
          
            $update = Db::table('me_users')->where('id',$userData['id'])->update(['mobile'=>$params['phone']]);
            if($update){
                return $this->success("修改成功"); 
            }
        }
        return $this->error("验证码错误");
    }
    
   /**
    * 投资者实名信息
    */ 
    public function autonymData()
    {
       $userData = $this->auth->getUser();  //信息
      
       $data = Db::table('me_userinfo')->where('user_id',$userData['id'])->find();
       if($data){
           return $this->success("获取成功",$data);
       }
       $this->error("该用户还未绑定！");
    }
    
    /**
     * 客服 
     */ 
     public function service()
     {
      
        if((date('w') == 6) || (date('w') == 0)) return $this->error("开放时间为工作日");
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y')); //今日开始时间
        $hours = 60*60;
        
        if(time() < ($beginToday + ($hours * 9)) || time() > ($beginToday + ($hours * 21))){
            $this->error("开放时间为：09--18");
        }
        
        $data = Db::table('me_admin_config')->where('name','service_url')->find();
       
        return $this->success("获取成功",$data['value']);
     }
    
    
    
}