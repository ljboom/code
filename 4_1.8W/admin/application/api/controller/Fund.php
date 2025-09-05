<?php namespace app\api\controller;

use think\Db;
use think\Controller;
use app\api\model\Fund as FundModel;

//私募基金控制器
class Fund extends Base
{
    //无需登录的方法,同时也就不需要鉴权了
    protected $noNeedLogin = ['list'];
    //无需鉴权的方法,但需要登录
    protected $noNeedRight = ['*'];
    
    
    /**
     * 私募基金列表
     * 
     * @param int $code 基金代码
     * @param int $type 数据类型
     * @param int $seek 搜索
     * @return array 数据
     */ 
   public function list()
   {   
        $params = $this->request->post();
        
        $where[] = ['type', '=' ,FundModel::TYPE_PRIVATE];
        //模糊搜索
        if(isset($params['fund_name'])){
            $where[] = ['fund_name', 'like', '%'.$params['fund_name'].'%'];
        }     
        $fundList = FundModel::where($where)->paginate(15)->each(function($item, $key){
            $item->fund_code = $item->fund_code;
            $item->last_year = $item->last_year * 100 .'%';
            $item->starting_amount = $item->starting_amount .'元起投';
            if(!$this->auth->isAuth()){
                $item->last_year = '认证可见';
                $item->starting_amount = '认证可见';
            }
            $item->visible(['id','fund_code','last_year','starting_amount','fund_type_text','fund_name','fund_name_abbr','fund_type','risk_level']);
            return $item;
        });
        return $this->success("获取成功", $fundList);
    }
    //基金历史数据
    public function history(){
        $params = $this->request->post();
        
        $this->dataValidate($params, get_class(), 'details');
        //查询数据
        $details = \app\api\model\FundHistory::where('fund_code', $params['code'])
                    ->paginate(15)
                    ->each(function($item, $key){
                        $item->fund_code = $item->fund_code;
                        return $item;
                    });
        return $this->success("获取成功", $details);
    }
    //基金详情
    public function details(){
        $params = $this->request->post();
        
        $this->dataValidate($params, get_class(), 'details');
        //查询数据
        $details = FundModel::where('fund_code', $params['code'])->find();
        
        return $this->success("获取成功", $details);
    }
    //私募基金资产详情
    public function private_asset(){
        //用户信息
        $user = $this->auth->getUser();
        
        
    }
    /**
     * 基金列表
     * 
     * @param int limit 显示条数
     * @param int $type 数据类型
     * @return array 数据
     */
    // public function listoffund()
    // {
        
    //     $params = $this->request->post();
    //     if($params['limit'] == null || $params['type'] == null){
    //         return $this->error("缺少必填参数"); 
    //     }
    //     $data = Db::table('me_fundcode')->orderRand()->limit($params['limit'])->select();
        
    //     $fundList = array();
    //     foreach($data as $v){
    //          $data = new Stock();
    //         $res = $data->stock($v['code'],$params['type']);
    //         $fundList[] = $res;
    //     }
      
    //     if(!empty($fundList)){
           
    //          return $this->success('获取成功',$fundList);
    //     }
       
    //     return $this->error("获取失败"); 
        
    // }
    
    /**
     * 基金搜索
     * 
     * @param int $type 数据类型
     * @param string $content ['基金代码或基金名称']
     * @return array 数据
     */
    // public function seekFund()
    // {
    //     $params = $this->request->post();
    //     if($params['content'] == null  || $params['type'] == null){
    //         return $this->error("缺少必填参数"); 
    //     }
    //     //校验客户搜索的是基金代码还是基金名称
    //     if((int)$params['content'] > 1){
    //         $where = "code = {$params['content']}";
    //     }else{
    //         $where = "fund_name like '%{$params['content']}%'";
    //     }
       
    //     //校验成功进行匹配
    //     $data = Db::table('me_fundcode')->where($where)->limit(10)->select();
    //     if(empty($data)){
    //         return $this->error("暂无获取内容"); 
    //     }
        
    //     $fundList = array();
    //     foreach($data as $v){
    //          $data = new Stock();
    //         $res = $data->stock($v['code'],$params['type']);
    //         $fundList[] = $res;
    //     }
      
    //     if(!empty($fundList)){
    //          return $this->success('获取成功',$fundList);
    //     }
       
    //     return $this->error("获取失败"); 
    // }
    
    /**
     * 基金搜索排行榜
     * 
     */
    //  public function searchSeaderboards()
    //  {
    //      $data = Db::table('me_fundcode')
    //                 ->field(['id','code','fund_type','fund_name'])
    //                 ->order('seek_sum')
    //                 ->limit(6)
    //                 ->select();
    //      return $this->success('获取成功',$data);
    //  }
    
    /**
     * 基金类型
     * 
     * @param int limit 显示条数
     * @param int $dataType 数据类型
     * @param int fundType 基金类型
     * @return array 数据
     */ 
    // public function fundType()
    // {
    //     $params = $this->request->post();
    //     if($params['limit'] == null || $params['dataType'] == null || $params['fundType'] == null){
    //         return $this->error("缺少必填参数"); 
    //     }
        
    //     //进行分类
    //     if($params['fundType'] == 1){
    //         $fundType = '股票型';
    //     }elseif($params['fundType'] == 2){
    //         $fundType = '货币型';
    //     }elseif($params['fundType'] == 3){
    //          $fundType = '混合型';
    //     }elseif($params['fundType'] == 4){
    //         $fundType = '债券型';
    //     }else{
    //          return $this->error("基金类型非法！"); 
    //     }
        
    //     $data = Db::table('me_fundcode')->orderRand()->where('fund_type',$fundType)->limit($params['limit'])->select();
       
    //   //调用第三方接口获取最新的基金数据
    //     $fundList = array();
    //     foreach($data as $v){
    //          $data = new Stock();
    //         $res = $data->stock($v['code'],$params['dataType']);
    //         $fundList[] = $res;
    //     }
      
    //     if(!empty($fundList)){
    //          return $this->success('获取成功',$fundList);
    //     }
       
    //     return $this->error("获取失败"); 
    // }
    
    /**
     * 基金自选
     * 
     * @param int code 基金代码
     * @return json 结果
     */
    //  public function fundsareoptional()
    //  {
    //      $params = $this->request->post();
    //      $userData = $this->auth->getUser(); //用户信息
         
    //      //校验参数是否合法
    //     if( $params['code'] == null ){
    //         return $this->error("缺少必填参数"); 
    //     }
    //     $res = Db::table('me_fundcode')->where('code',$params['code'])->find();
    //     if(empty($res)){
    //         return $this->error("基金代码错误");
    //     }
    //     //校验基金代码是否被添加过
    //     $verify = Db::table('me_fundall')->where('code',$params['code'])->where('user_id',$userData['id'])->find();
    //     if(!empty($verify)){
    //         return $this->error("该基金已被添加过了");
    //     }
        
    //     //校验成功
    //     $insert['code'] = $params['code'];
    //     $insert['user_id'] = $userData['id'];
    //     $insert['createtime'] = time();
    //     $result = Db::table('me_fundall')->insert($insert);
    //     if($result){
    //       return $this->success("添加成功"); 
    //     }
        
    //     return $this->error("错误错误");
    //  }
     
     /**
     * 基金自选列表
     * 
     * @return json 数据
     */
    // public function sareoptionallist()
    // {
    //     $userData = $this->auth->getUser(); //用户信息
       
    //     $res = Db::table('me_fundall')->where('user_id',$userData['id'])->select();
    //     if(empty($res)){
    //         return $this->error("该用户还没自选");
    //     }
    //     $fundList = [];
    //     foreach($res as $v){
    //          $data = new Stock();
    //         $res1 = $data->stock($v['code'],1);
    //         $fundList[] = $res1;
    //     }
        
    //     if(!empty($fundList)){
    //          return $this->success('获取成功',$fundList);
    //     }
    //     return $this->error("获取失败");
        
    // }
    
    /**
     * 基金自选列表删除
     * 
     * @param int code 基金代码
     * @return json 结果
     */
    // public function sareoptionaldelete()
    // {
    //     $params = $this->request->post();
    //      $userData = $this->auth->getUser(); //用户信息
         
    //      //校验参数是否合法
    //     if( $params['code'] == null ){
    //         return $this->error("缺少必填参数"); 
    //     }
    //     $res = Db::table('me_fundcode')->where('code',$params['code'])->find();
    //     if(empty($res)){
    //         return $this->error("基金代码错误");
    //     }
        
    //     $result = Db::table('me_fundall')->where('code',$params['code'])->where('user_id',$userData['id'])->delete();
    //     if($result){
    //         return $this->success('移除成功');
    //     }
    //     return $this->error("移除失败");
    // }
     
 
     
    
}