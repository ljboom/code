<?php namespace app\api\controller;

use think\Db;
use think\Controller;
use app\common\controller\Stock;
use app\api\model\Optional;

class Stocks extends Base
{
    //无需登录的方法,同时也就不需要鉴权了
    protected $noNeedLogin = ['stockData','listoffund','seekFund','fundType','searchSeaderboards','popularProduct','choiceness'];
    //无需鉴权的方法,但需要登录
    protected $noNeedRight = ['*'];
    
    // public function test(){
    //     $code = '000003';
    //     $type = 1;
    //     $res = (new Stock)->stock($code, $type);
    //     $insert = [];
    //     foreach($res['fundFullInfo'] as $key => $val){
    //         $insert[capital_to_underline($key)] = $val;
            
    //     }
    //     $insert['type'] = \app\api\model\Fund::TYPE_PRIVATE;
    //     // dump($insert);die;
    //     $res = (new \app\api\model\Fund)->save($insert);
    //     // $result = 
    //     dump($res);die;
    // }
    
    // public function test_history(){
    //     $code_real = '009213';
    //     $code = '000004';
    //     $res = (new Stock)->stock($code, 2);
    //     $insert = [];
    //     dump($res);
    //     foreach($res as $k => $v){
    //             foreach($v as $listKey => $list){
    //                 if($listKey == 'fundCode') $list = $code_real;
    //                 //将键值更改
    //                 $insert[$k][capital_to_underline($listKey)] = $list;
    //                 $insert[$k]['createtime'] = time();
    //             }
    //         }
    //         //保存
    //     $res_number = (new \app\api\model\FundHistory)->insertAll($insert);
        
    //     dump($res_number);
    // }
    /**
     * 获取基金数据
     * 
     * @param int $code 基金代码
     * @param int $type 数据类型
     * @param int $seek 搜索
     * @return array 数据
     */ 
   public function stockData()
   {   
         $params = $this->request->post();
        if($params['code'] == null || $params['type'] == null){
            return $this->error("缺少必填参数"); 
        }
        //校验基金代码是否正确
        $verify = Db::table('me_fund')->where('fund_code',$params['code'])->find();
              
        if($verify == null){
            return $this->error("基金代码不存在");
        }  
        if(isset($params['seek'])){  //搜索来的数据
            $verify = Db::table('me_fund')->where('fund_code',$params['code'])->update(['seek_sum' => $verify['seek_sum'] + 1]);
        }
        $data = new Stock();
        
      
        $res = $data->stock($params['code'],$params['type']);
        
       
          
        if(!empty($res)){
            if($params['type'] == 1){
               $user_id = $this->auth->getUser() ? $this->auth->getUser()->id : 0;
                $is_optional = Optional::get(['code' => $params['code'], 'user_id' => $user_id]);
                $res['is_optional'] = $is_optional ? true : false; 
            }
            
            return $this->success('获取成功', $res);
        }
        return $this->error("获取失败");
        
    }
    
    
    /**
     * 基金列表
     * 
     * @param int limit 显示条数
     * @param int $type 数据类型
     * @return array 数据
     */
    public function listoffund()
    {
        
        $params = $this->request->post();
        if($params['limit'] == null || $params['type'] == null){
            return $this->error("缺少必填参数"); 
        }
        $data = Db::table('me_fund')->orderRand()->limit($params['limit'])->select();
        
        $fundList = array();
        foreach($data as $v){
             $data = new Stock();
            $res = $data->stock($v['fund_code'],$params['type']);
            $fundList[] = $res;
        }
      
        if(!empty($fundList)){
           
             return $this->success('获取成功',$fundList);
        }
       
        return $this->error("获取失败"); 
        
    }
    
    /**
     * 基金搜索
     * 
     * @param int $type 数据类型
     * @param string $content ['基金代码或基金名称']
     * @return array 数据
     */
    public function seekFund()
    {
        $params = $this->request->post();
        if($params['content'] == null  || $params['type'] == null){
            return $this->error("缺少必填参数"); 
        }
        //校验客户搜索的是基金代码还是基金名称
        if((int)$params['content'] > 1){
            $where = "fund_code = {$params['content']}";
        }else{
            $where = "fund_name like '%{$params['content']}%'";
        }
       
        //校验成功进行匹配
        $data = Db::table('me_fund')->where($where)->limit(10)->select();
        if(empty($data)){
            return $this->error("暂无获取内容"); 
        }
        
        $fundList = array();
        foreach($data as $v){
             $data = new Stock();
            $res = $data->stock($v['fund_code'],$params['type']);
            $fundList[] = $res;
        }
      
        if(!empty($fundList)){
             return $this->success('获取成功',$fundList);
        }
       
        return $this->error("获取失败"); 
    }
    
    /**
     * 基金搜索排行榜
     * 
     */
     public function searchSeaderboards()
     {
         $data = Db::table('me_fund')
                    ->field(['id','fund_code','fund_type','fund_name','fund_name_abbr'])
                    ->order('seek_sum')
                    ->limit(6)
                    ->select();
         return $this->success('获取成功',$data);
     }
     
     /**
      * 公募精选
      */ 
      public function choiceness()
      {
           $params = $this->request->post();
           if(empty($params['limit'])) return $this->error("缺少参数"); 
           if($params['limit'] < 1) return $this->error("数据条数必须大于1"); 
           
          $data = Db::table("me_fund")->order("seek_sum desc")->limit($params['limit'])->select();
          return $this->success('获取成功',$data);
      }
    
    /**
     * 基金类型
     * 
     * @param int limit 显示条数
     * @param int $dataType 数据类型
     * @param int fundType 基金类型
     * @return array 数据
     */ 
    public function fundType()
    {
        $params = $this->request->post();
        if($params['limit'] == null || $params['dataType'] == null || $params['fundType'] == null){
            return $this->error("缺少必填参数"); 
        }
        
        //进行分类
        if($params['fundType'] == 1){
            $fundType = 'STOCK';
        }elseif($params['fundType'] == 2){
            $fundType = 'CURRENCY';
        }elseif($params['fundType'] == 3){
             $fundType = 'BLEND';
        }elseif($params['fundType'] == 4){
            $fundType = 'BOND';
        }else{
             return $this->error("基金类型非法！"); 
        }
        
        $data = Db::table('me_fund')->orderRand()->where('fund_type',$fundType)->limit($params['limit'])->select();
       
       //调用第三方接口获取最新的基金数据
        $fundList = array();
        foreach($data as $v){
             $data = new Stock();
            $res = $data->stock($v['fund_code'],$params['dataType']);
            $fundList[] = $res;
        }
      
        if(!empty($fundList)){
             return $this->success('获取成功',$fundList);
        }
       
        return $this->error("获取失败"); 
    }
    
    /**
     * 基金自选
     * 
     * @param int code 基金代码
     * @return json 结果
     */
     public function fundsareoptional()
     {
         $params = $this->request->post();
         $userData = $this->auth->getUser(); //用户信息
         
         //校验参数是否合法
        if( $params['code'] == null ){
            return $this->error("缺少必填参数"); 
        }
        $res = Db::table('me_fund')->where('fund_code',$params['code'])->find();
        if(empty($res)){
            return $this->error("基金代码错误");
        }
        //校验基金代码是否被添加过
        $verify = Db::table('me_fundall')->where('code',$params['code'])->where('user_id',$userData['id'])->find();
        if(!empty($verify)){
            return $this->error("该基金已被添加过了");
        }
        
        //校验成功
        $insert['code'] = $params['code'];
        $insert['user_id'] = $userData['id'];
        $insert['createtime'] = time();
        $result = Db::table('me_fundall')->insert($insert);
        if($result){
           return $this->success("添加成功"); 
        }
        
        return $this->error("错误错误");
     }
     
     /**
     * 基金自选列表
     * 
     * @return json 数据
     */
    public function sareoptionallist()
    {
        $userData = $this->auth->getUser(); //用户信息
     
        $res = Db::table('me_fundall')->where('user_id',$userData['id'])->select();
        if(empty($res)){
            return $this->error("该用户还没自选");
        }
        $fundList = [];
        foreach($res as $v){
             $data = new Stock();
            $res1 = $data->stock($v['code'],1);
            $fundList[] = $res1;
        }
        
        if(!empty($fundList)){
             return $this->success('获取成功',$fundList);
        }
        return $this->error("获取失败");
        
    }
    
    /**
     * 基金自选列表删除
     * 
     * @param int code 基金代码
     * @return json 结果
     */
    public function sareoptionaldelete()
    {
        $params = $this->request->post();
         $userData = $this->auth->getUser(); //用户信息
         
         //校验参数是否合法
        if( $params['code'] == null ){
            return $this->error("缺少必填参数"); 
        }
        $res = Db::table('me_fund')->where('fund_code',$params['code'])->find();
        if(empty($res)){
            return $this->error("基金代码错误");
        }
        
        $result = Db::table('me_fundall')->where('code',$params['code'])->where('user_id',$userData['id'])->delete();
        if($result){
            return $this->success('移除成功');
        }
        return $this->error("移除失败");
    }
    
    /**
     * 热门产品
     */ 
    public function popularProduct()
    {
        
    }
     
 
     
    
}