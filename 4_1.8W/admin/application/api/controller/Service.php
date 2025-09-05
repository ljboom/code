<?php namespace app\api\controller;

use think\Db;
use app\api\model\User as UserModel;
use app\api\model\Bindingbank as BindingbankModel;
use app\api\model\Code as CodeModel;



class Service extends Base
{
    //无需登录的方法,同时也就不需要鉴权了
    protected $noNeedLogin = [];
    //无需鉴权的方法,但需要登录
    protected $noNeedRight = ['*'];
    
    
    //查询服务顾问
    public function query(){
        
    }
    /**
     * 绑定银行卡
     */ 
    public function bankdetails()
    {
        $params = $this->request->post();
        //验证参数是否合法
        $this->dataValidate($params, get_class(), 'bankdetails');
        
        $userData = $this->auth->getUser();
        $userRes = Db::table('me_binding_bank')->where('user_id',$userData['id'])->find();
        if(!empty($userRes)){
            $status = 1;
        }else{
            $status = 2;
        }
        
        $insert['name'] = $params['name'];
        $insert['number'] = $params['number'];
        $insert['opening_bank'] = $params['opening_bank'];
        $insert['bank_card'] = $params['bank_card'];
        $insert['phone'] = $params['phone'];
        $insert['createtime'] = time();
        $insert['user_id'] = $userData['id'];
        $insert['status'] = $status;
        
        
        $res = Db::table('me_binding_bank')->insert($insert);
        if($res){
            //加入日志
             $log['user_id'] = $userData['id'];
             $log['content'] = "银行卡添加成功";
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
             return $this->success("绑定成功！");
        }
        return $this->error("绑定失败");
    }
    
    /**
     * 银行卡修改
     */ 
     public function updateBank()
     {
        $params = $this->request->post();
        //验证参数是否合法
        $this->dataValidate($params, get_class(), 'updateBank'); 
        
        $insert['name'] = $params['name'];
        $insert['number'] = $params['number'];
        $insert['opening_bank'] = $params['opening_bank'];
        $insert['bank_card'] = $params['bank_card'];
        $insert['phone'] = $params['phone'];
       // $insert['createtime'] = time();
       
       $update = Db::table('me_binding_bank')->where('id',$params['id'])->update($insert);
       if($update){
           //加入日志
             $log['user_id'] = $userData['id'];
             $log['content'] = "银行卡修改成功";
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
          return $this->success("修改成功！"); 
       }
       return $this->error("修改失败");
        
     }
     
     /**
      * 银行卡删除
      * 
      */ 
     public function deleteBank()
     {
         $params = $this->request->post();
          $userData = $this->auth->getUser();
         if(empty($params['id'])) $this->error("id必传参数");
         
         $jiaoy = DB::table('me_binding_bank')->where('user_id',$userData['id'])->select();
         if(count($jiaoy) <= 1){
             return $this->error("必须保留一张银行卡！");
         }
         
         $res = DB::table('me_binding_bank')->where('id',$params['id'])->delete();
         if($res){
             return $this->success("删除成功！"); 
         }
         return $this->error("删除失败");
     }
    
    /**
     * 实名认证
     */ 
    public function certification()
    {
        $params = $this->request->post();
        //验证参数是否合法
        $this->dataValidate($params, get_class(), 'certification');
        
        
        if(!CodeModel::check($params['phone'], $params['code'])){
            $this->error("验证码错误或不存在");
        }
        
        $userData = $this->auth->getUser();
        $restue = Db::table('me_userinfo')->where('user_id',$userData['id'])->find();
        if(!$restue == null) return $this->error("该账号已绑定！请勿重复操作");
        
        $insert['name'] = $params['name'];
        $insert['number'] = $params['number'];
        $insert['sex'] = $params['sex'];
        $insert['valid_date'] = $params['valid_date'];
        $insert['education'] = $params['education'];
        $insert['phone'] = $params['phone'];
        $insert['profession'] = $params['profession'];
        $insert['dutuies'] = $params['dutuies'];
        $insert['site'] = $params['site'];
        $insert['postal_code'] = $params['postal_code'];
        $insert['e_mail'] = $params['e_mail'];
        $insert['people'] = $params['people'];
        $insert['createtime'] = time();
        $insert['user_id'] = $userData['id'];
        $res = Db::table('me_userinfo')->insert($insert);
        if($res){
            //加入日志
             $log['user_id'] = $userData['id'];
             $log['content'] = "认证成功";
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
             return $this->success("绑定成功！");
        }
         return $this->error("绑定失败");
    }
    
    /**
     * 认证修改
     */ 
     public function certificationUpdate()
     {
         $params = $this->request->post();
        //验证参数是否合法
        $this->dataValidate($params, get_class(), 'certificationUpdate');
        $userData = $this->auth->getUser();
       
        $insert['name'] = $params['name'];
        $insert['number'] = $params['number'];
        $insert['sex'] = $params['sex'];
        $insert['valid_date'] = $params['valid_date'];
        $insert['education'] = $params['education'];
        $insert['phone'] = $params['phone'];
        $insert['profession'] = $params['profession'];
        $insert['dutuies'] = $params['dutuies'];
        $insert['site'] = $params['site'];
        $insert['postal_code'] = $params['postal_code'];
        $insert['e_mail'] = $params['e_mail'];
        $insert['people'] = $params['people'];
        //$insert['createtime'] = time();
       // $insert['user_id'] = $userData['id'];
        $res = Db::table('me_userinfo')->where('user_id',$userData['id'])->update($insert);
        if($res){
            //加入日志
             $log['user_id'] = $userData['id'];
             $log['content'] = "修改成功";
             $log['createtime'] = time();
             Db::table('me_log')->insert($log);
             return $this->success("保存成功！");
        }
         return $this->success("保存成功！");
     }
    
    /**
     * 银行卡显示
     * 
     */ 
     public function bankData()
     {
          $user = $this->auth->getUser();
         
          $data = Db::table('me_binding_bank')->field("id,opening_bank,bank_card,status")->where('user_id', $user->id)->select();
        
          if($data){
              return $this->success("获取成功", $data);
              
          }
          return $this->error("获取失败，该账户没有银行信息");
          
     }
     
     /**
      *  上传头像
      */
      public function headPortrait()
      {
         $params = $this->request->post();
        
        //验证参数是否合法
        $userData = $this->auth->getUser();
       
          if (is_image_base64($params['pic'])) {
                $pic = '/' . $this->upload_base64('tx', $params['pic']);  //调用图片上传的方法
            }else{
                return $this->error("图片格式错误");
            }
            
            $update = Db::table("me_users")->where("id",$userData['id'])->update(['head_avatar'=>$pic]);
            if($update){
                return $this->success("修改成功");
            }
           return $this->error("修改失败");
      }
      
     /**
     * 意见反馈
     */
     public function feedback()
     { 
        
         $params = $this->request->post();
         $userData = $this->auth->getUser();  //信息
      
        if(empty($params['content'])) return $this->error("反馈内容不能为空"); 
        if(empty($params['relation'])) return $this->error("联系方式不能为空"); 
       
        $data = Db::table('me_feedback')->where('user_id',$userData['id'])->order("createtime desc")->find();
        if($data != null){
            $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y')); //今日开始时间戳
            $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1; //今日结束时间戳
            
            if($data['createtime'] > $beginToday && $data['createtime'] < $endToday){
                return $this->error("今日已经反馈过了");
            }
            
        }
        
        if(is_image_base64($params['pic'])) {
             $pic = '/' . $this->upload_base64('tx', $params['pic']);  //调用图片上传的方法
         }else{
              return $this->error("图片格式错误");
         }
         
         $insert['content'] = $params['content'];
         $insert['relation'] = $params['relation'];
         $insert['voucher'] = $pic;
         $insert['createtime'] = time();
         $insert['user_id'] = $userData['id'];
         $res = Db::table('me_feedback')->insert($insert);
         
         if($res){
             return $this->success("反馈成功");
         }
         
         return $this->error("反馈失败");   
     }
     
     
     /**
      * 图片上传为base64为的图片
      */ 
    public function upload_base64($type,$img){
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $img, $result)){
            $type_img = $result[2];  //得到图片的后缀
            //上传 的文件目录

            $App = new \think\App();
            $new_files = $App->getRootPath() . 'upload'. DIRECTORY_SEPARATOR . $type. DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m-d') . DIRECTORY_SEPARATOR ;

            if(!file_exists($new_files)) {
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                //服务器给文件夹权限
                mkdir($new_files, 0777,true);
            }
            //$new_files = $new_files.date("YmdHis"). '-' . rand(0,99999999999) . ".{$type_img}";
            $new_files = check_pic($new_files,".{$type_img}");
            if (file_put_contents($new_files, base64_decode(str_replace($result[1], '', $img)))){
                //上传成功后  得到信息
                $filenames=str_replace('\\', '/', $new_files);
                $file_name=substr($filenames,strripos($filenames,"/upload"));
                return $file_name;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
     
    
}