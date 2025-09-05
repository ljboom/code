<?php
namespace app\index\controller;

use app\index\model\QstocksNew as QstocksNewModel;
use app\index\model\QstockservicesData as QstockservicesDataModel;
use app\index\model\Quser as QuserModel;
use app\index\model\QstockAskBid as QstockAskBidModel;
use app\cms\model\Cms as Cms_Model;
use app\admin\model\Config as ConfigModel;

use app\common\controller\Indexbase;
use think\facade\Session;
use think\Db;

class Index extends Indexbase
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->Cms_Model = new Cms_Model;
        $this->modelClass = new QuserModel;
        $this->ConfigModel = new ConfigModel;
    }
    
    
        function isMobile() { 
  // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
  if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
    return true;
  } 
  // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
  if (isset($_SERVER['HTTP_VIA'])) { 
    // 找不到为flase,否则为true
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
  } 
  // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
  if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger'); 
    // 从HTTP_USER_AGENT中查找手机浏览器的关键字
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
      return true;
    } 
  } 
  // 协议法，因为有可能不准确，放到最后判断
  if (isset ($_SERVER['HTTP_ACCEPT'])) { 
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
      return true;
    } 
  } 
  return false;
}
    
    
    public function service(){
        
        $url = 'https://line.me/ti/p/~@181pelyd';
        
        if(!$this->isMobile()){
            header('location:'.$url);exit;
        }
        
        
        return $this->fetch();
    }
    
    
    public function dating(){
        
        $content = getSSLPage("http://stockboard.sbsc.com.vn/HO.ashx?FileName=0&_=1654591483036");
        
        $arr = explode('|',$content);
        
        $HNXIndex = $arr[13];
        
        $HNX_arr = explode(';',$HNXIndex);
        
        $HNX = array(6=>$HNX_arr[2],11=>$HNX_arr[3],56=>$HNX_arr[4]);
 
        $HNX30Index = $arr[12];
        
        $HNX30_arr = explode(';',$HNX30Index);
        
        $HNX30 = array(6=>$HNX30_arr[2],11=>$HNX30_arr[3],56=>$HNX30_arr[4]);
        
        $HNXUpcomIndex = $arr[14];
        
        $HNXUpcom_arr = explode(';',$HNXUpcomIndex);
        
        $HNXUpcom = array(6=>$HNXUpcom_arr[2],11=>$HNXUpcom_arr[3],56=>$HNXUpcom_arr[4]);
        
        
        $data = code_msg(1);
        $data['data'] = array(
            'jiaquan' => $HNX,
            'guimai' => $HNX30,
            'taizhi' => $HNXUpcom,
        );
        return json_encode($data);
    }
    
    
    // 大厅上方数据
    /*public function dating(){
                
        $time = time();
        $dating_time = empty(redis_get('dating_time')) ? 0 : redis_get('dating_time');
        $num = $time - $dating_time;
        if($num > bianliang('dating_time')){
            $jiaquan = getSSLPage('https://ws.api.cnyes.com/ws/api/v1/charting/history?resolution=5&symbol=TWS:TSE01:INDEX&quote=1');
            $taizhi = getSSLPage('https://ws.api.cnyes.com/ws/api/v1/charting/history?resolution=5&symbol=TWF:TXF:FUTURES&quote=1');
            $guimai = getSSLPage('https://ws.api.cnyes.com/ws/api/v1/charting/history?resolution=5&symbol=TWS:OTC01:INDEX&quote=1');
            //测试数据  上线后删除
            if(bianliang('test') == 1){   $jiaquan = $this->json_test(2);    $taizhi = $this->json_test(3);      $guimai =$this->json_test(4);   }
            
            redis_set('jiaquan', $jiaquan);
            redis_set('taizhi', $taizhi);
            redis_set('guimai', $guimai);
            redis_set('dating_time', time());
        
        }else{
            $jiaquan = redis_get('jiaquan');
            $guimai = redis_get('guimai');
            $taizhi = redis_get('taizhi');
            
        }
        
        $jiaquan = json_decode($jiaquan ,1);
        $guimai = json_decode($guimai ,1);
        $taizhi = json_decode($taizhi ,1);
        $data = code_msg(1);
        $data['data'] = array(
            'jiaquan' => empty($jiaquan['data']['quote']) ? [] : $jiaquan['data']['quote'],
            'guimai' => empty($guimai['data']['quote']) ? [] : $guimai['data']['quote'],
            'taizhi' => empty($taizhi['data']['quote']) ? [] : $taizhi['data']['quote'],
            );
        return json_encode($data);
    }*/
    
    
    // 股票详情(上市、上柜)
    public function _back_gupiao_details(){
        $post = input('post.id');
        $QstockservicesDataModel = new QstockservicesDataModel;
        $arr = $QstockservicesDataModel->where('id',$post)->find()->toArray();
        $arr['sectorName'] = Db::name('qstockservices')->where('id',$post)->value('symbolName');
       if(empty($arr)){
            $data = code_msg(2);
            
       }else{
            $data = code_msg(1);
            $data['data'] = $arr;
       }
       return json_encode($data);
    }
    
    public function gupiao_details(){
        $post = input('post.id');
        $QstockservicesDataModel = new QstockservicesDataModel;
        $arr = Db::name('qstockservices')->where('id',$post)->find();
        if ($arr ) {
            $arr = $QstockservicesDataModel->api_masvn($arr['symbol'],$arr);
        }
        if(empty($arr)){
            $data = code_msg(2);
       }else{
            $data = code_msg(1);
            $data['data'] = $arr;
       }
       return json_encode($data);
    }

    
    
    // 新股详情
    public function xingu_details()
    {
        $id = input('post.id');
        $quser_id=  Session::get(bianliang(1));
        // $id = 231;
        // $quser_id = 3;
        
        if(empty($id)){
            return json_encode(code_msg(2));
        }
        
        $QstocksNewModel = new QstocksNewModel;
        $array = $QstocksNewModel->where('id',$id)
            ->find();
        $array['quser_money'] = Db::name('quser')->where('id',$quser_id)->value('money');
        $array['yukoukuan'] = date("m/d" ,strtotime($array['draw_date'])+3600*24).'~'.date("m/d" ,strtotime($array['draw_date'])+3600*24*3);
        $array['yijiacha'] = number_format($array['spread']/$array['underwriting_price'],2);
        $subscription_period = explode('~',$array['subscription_period']);
        $array['jiezhi_date'] = $subscription_period[1];
        $array['can_purchased'] = 'Vô hạn';//empty($array['can_purchased']) ? '不限' : $array['can_purchased'].'張';
        $array['winning_rate'] = empty($array['winning_rate']) ? '--' : $array['winning_rate'];
        // dump($array);
        $data = code_msg(1);
        $data['data'] = $array;
        return json_encode($data);
        
    }
    
    
    // 新股
    public function xingu()
    {
        $page = empty(input('post.page'))? 1 : input('post.page');
        $data = code_msg(1);
        $QstocksNewModel = new QstocksNewModel;
        $array = $QstocksNewModel
            ->page($page, 20)
            ->order('id desc')
            ->select()->toArray();
        foreach($array as $k => $v){
            if(if_date($v['subscription_period'])['code'] == 200 ){
                $array[$k]['type'] = 'Đăng ký';
            }elseif(if_date($v['subscription_period'])['code'] == 201){
                $array[$k]['type'] = 'Dã hết hạn';
            }else{
                $array[$k]['type'] = 'Chưa bắt đầu';
            }
            // $array[$k]['type'] = if_date($v['subscription_period'])['code'] == 200 ? '申購中' : '已截止';
            $array[$k]['yijiacha'] = number_format($v['spread']/$v['underwriting_price'],2);
            $array[$k]['can_purchased'] = 0;
        }
        // dump($array);
        $data['data'] = $array;
        return json_encode($data);
        
    }
    
    
    // // 股票线条
    // public function xiantiao(){
        
    //     $xiantiao_time = empty(redis_get('xiantiao_time')) ? 0 : redis_get('xiantiao_time');
    //     $time = time();
    //     $num = $time - $xiantiao_time;
        
    //     if($num > bianliang('xiantiao_time')){//默认1个小时获取一次
    //         $url = bianliang('xiantiao_url');
    //         $info = getSSLPage($url);
    //         redis_set('xiantiao', $info);
    //         redis_set('xiantiao_time', time());
    //     }else{
    //         $info = redis_get('xiantiao');
    //     }
    //     if(empty($info)){
    //         return json_encode(code_msg(2));
    //     }
    //     $info = json_decode($info,1);
    //     $data = code_msg(1);
    //     $data['data'] = array(
    //         't' => empty($info['data']['t']) ? [] : $info['data']['t'],
    //         'o' => empty($info['data']['o']) ? [] : $info['data']['o'],
    //         'h' => empty($info['data']['h']) ? [] : $info['data']['h'],
    //         'l' => empty($info['data']['l']) ? [] : $info['data']['l'],
    //         'c' => empty($info['data']['c']) ? [] : $info['data']['c'],
    //         );
    //     return json_encode($data);

    // }    
    
    // 股票线条
    public function xiantiao(){
        $content = input('post.symbol');
        $resolution = 'D';
        $from = time();
        $to = $from - 86400*180;
        //&resolution=1D  天
        $url = "https://services.entrade.com.vn/chart-api/v2/ohlcs/stock?from=1613952000&resolution=1D&symbol={$content}";

        $info = getSSLPage($url);

        // $info = $this->json_test(6);
        if(empty($info)){
            return json_encode(code_msg(2));
        }
        
        $info = json_decode($info,1);
        $data = [];
        $data = code_msg(1);
        $count = count($info['t']);
        $i=0;
        for( $k=0;$k<$count;$k++){
            if ( empty($info['t'][$k])) {
                continue;
            }
            $data['data'][$i][] = date("Y-m-d" ,$info['t'][$k]);
            $data['data'][$i][] = $info['o'][$k];
            $data['data'][$i][] = $info['c'][$k];
            $data['data'][$i][] = $info['l'][$k];
            $data['data'][$i][] = $info['h'][$k];
            $data['data'][$i][] = $info['v'][$k];
            $i++;
        }
        return json_encode($data);

    }
    
    public function xiantiao1(){
        
        $content = input('post.symbol');
        
        $from = time() - 3600*24*7;
        
        $url = "https://services.entrade.com.vn/chart-api/v2/ohlcs/stock?from=$from&symbol=".$content;
        
        
        $info = getSSLPage($url);

        if(empty($info)){
            return json_encode(code_msg(2));
        }
        
        $info = json_decode($info,1);
        
        $data = [];
        $data = code_msg(1);
        
        $count = count($info['t']);
        $i=0;
        for( $k=0;$k<$count;$k++){
            $data['data'][$i][] = date("Y-m-d H:i:s" ,$info['t'][$k]);
            $data['data'][$i][] = $info['o'][$k];
            $data['data'][$i][] = $info['c'][$k];
            $data['data'][$i][] = $info['l'][$k];
            $data['data'][$i][] = $info['h'][$k];
            $data['data'][$i][] = $info['v'][$k];
            $i++;
        }
        
        return json_encode($data);
    }
    
    
    
    /*public function xiantiao(){
        $content = input('post.symbol');
        $content = explode('.',$content);
        $resolution = 'D';
        $from = time();
        $to = $from - 86400*180;
        $url = 'https://ws.api.cnyes.com/ws/api/v1/charting/history?resolution='.$resolution.'&symbol=TWS:'.$content[0].':STOCK&from='.$from.'&to='.$to;

        $info = getSSLPage($url);
        // $info = $this->json_test(6);
        if(empty($info)){
            return json_encode(code_msg(2));
        }
        
        $info = json_decode($info,1);
        $data = [];
        $data = code_msg(1);
        $count = count($info['data']['t']);
        $i=0;
        for( $k=$count;$k>=0;$k--){
            if ( empty($info['data']['t'][$k]) ) {
                continue;
            }
            $data['data'][$i][] = date("Y-m-d" ,$info['data']['t'][$k]);
            $data['data'][$i][] = $info['data']['o'][$k];
            $data['data'][$i][] = $info['data']['c'][$k];
            $data['data'][$i][] = $info['data']['l'][$k];
            $data['data'][$i][] = $info['data']['h'][$k];
            $data['data'][$i][] = $info['data']['v'][$k];
            $i++;
        }
        return json_encode($data);

    }*/    
    
    
    // 股票详细的 买盘档和卖盘档
    public function _back_maimai_pandang(){
        $id = input('post.id');
        $info = Db::name('qstock_ask_bid')->where('qstockservices_id',$id)->find();
        $jin = explode('_',$info['asks']);
        $chu = explode('_',$info['bids']);
        $data = code_msg(1);
        $data['data']['jin'] = array_filter($jin);
        $data['data']['chu'] = array_filter($chu);
        return json_encode($data);

    }
    
    // 股票详细的 买盘档和卖盘档
    public function maimai_pandang(){
        $id = input('post.id');
        $QstockservicesDataModel = new QstockservicesDataModel;
        $arr = Db::name('qstockservices')->where('id',$id)->find();
        
        $QstockAskBidModel = new QstockAskBidModel;
        $res = $QstockAskBidModel->get_one($arr);
        $data = code_msg(1);
        $data['data']['jin'] = $res['jin'];
        $data['data']['chu'] = $res['chu'];
        return json_encode($data);

    }
    
    
    // 登錄接口
    public function login(){
        $arr = input('post.');
        if (empty($arr) || !is_array($arr)) {
            return code_msg(3);// 没有数据
        }
        $password = empty($arr['password']) ? '' : encrypt_password($arr['password'],bianliang(2));
        $res = DB::name('quser')->where(['tel' =>$arr['tel'] ,'password' => $password])->find();

        
        if(!empty($res)){
            if($res['login'] ==2 ){ return json_encode(code_msg(15)); }
            Session::set(bianliang(1) ,$res['id']);
            Session::set(bianliang(3) ,$res['tel']);
            $array = code_msg(1);
            $array['data'] = ['id'=>$res['id']];
            return json_encode($array);
        }else{
            return json_encode(code_msg(9));
        }
    }
    
    // 推出登錄
    public function del_login(){
        Session::delete(bianliang(1));
        Session::delete(bianliang(3));
        return json_encode(code_msg(1));
    }
    
    
    //文章信息列表
    public function articlelist()
    {
        
        $catid =  bianliang('catid');
        //当前栏目信息
        $catInfo = getCategory($catid);
        if (empty($catInfo)) {
            // $this->error('该栏目不存在！');
        }
        //栏目所属模型
        $modelid = $catInfo['modelid'];
        //检查模型是否被禁用
        if (!getModel($modelid, 'status')) {
            // $this->error('模型被禁用！');
        }
        $modelCache = cache("Model");
        $tableName  = $modelCache[$modelid]['tablename'];

        $this->modelClass = Db::name($tableName);
        //如果发送的来源是Selectpage，则转发到Selectpage
        if ($this->request->request('keyField')) {
            return $this->selectpage();
        }
        list($page, $limit, $where) = $this->buildTableParames();
        
        $limit = 20;

        $conditions = [
            
            ['status', 'in', [0, 1]],
        ];
        $total = Db::name($tableName)->where($where)->where($conditions)->count();
        $list  = Db::name($tableName)->page($page, $limit)->where($where)->where($conditions)->order('inputtime DESC, id DESC')->limit(10)->select();
        
        //echo Db::name($tableName)->getLastSql();
 
        $_list = [];
        foreach ($list as $k => $v) {
            $v['tranTime'] = $v['inputtime'];
            $v['updatetime'] = date('Y-m-d H:i:s', $v['updatetime']);
            $_list[]         = $v;
        }
        $result = code_msg(1);
        // dump($_list);
        $result['data'] = $_list;

        return json_encode($result);
        
    }
    //文章内容
    public function article(){
        $catid    = bianliang('catid');
        $id       = $this->request->param('id/d');
        $category = getCategory($catid);
        if (empty($category)) {
            // $this->error('该栏目不存在！');
        }
        if ($category['type'] == 2) {
            $modelid   = $category['modelid'];
            $fieldList = $this->Cms_Model->getFieldList($modelid, $id);
            $result = code_msg(1);
            
            $data['data'] =  $fieldList;
            $data['data']['tranTime'] = [
                'value' => $data['data']['inputtime']['value'],
            ];
            
           
            
            //preg_match_all('|<p>(.*?)<\/p>|s',$data['data']['content']['value'],$match);

            $data['data']['content'] = [
                'value' => [0=>$data['data']['content']['value']],
            ];
            $result = code_msg(1);
            // dump(json_decode($data['data']['content']['value'],1));
            // dump($data['data']);
            // exit;
            $result['data'] = $data['data'];
            return json_encode($result);
            
        }
    }
    // 系統配置
    public function xtconfig(){
        
        $data = $this->ConfigModel->where('id',15)->field('title,value,value1')->find()->toArray();
        $result = code_msg(1);
        $result['data'] = $data;
        return json_encode($result);
    }
    
    //新闻详情 
    public function xinwen_html(){
        return $this->fetch('xinwen');
    }
    //新闻列表
    public function xinwenlist_html(){
        return $this->fetch('xinwenlist');
    }
    // 新股
    public function xingu_html(){
        return $this->fetch('xingu');
    }
    
    public function json_test($res){
        if($res ==6 ){
            return '{
    "statusCode": 200, 
    "message": "OK", 
    "data": {
        "s": "ok", 
        "t": [
            1650000600, 
            1650000240, 
            1650000180, 
            1650000120, 
            1650000060, 
            1650000000, 
            1649999940, 
            1649999880, 
            1649999820, 
            1649999760, 
            1649999700, 
            1649999640, 
            1649999580, 
            1649999520, 
            1649999460, 
            1649999400, 
            1649999340, 
            1649999280, 
            1649999220, 
            1649999160, 
            1649999100, 
            1649999040, 
            1649998980, 
            1649998920, 
            1649998860, 
            1649998800, 
            1649998740, 
            1649998680, 
            1649998620, 
            1649998560, 
            1649998500, 
            1649998440, 
            1649998380, 
            1649998320, 
            1649998260, 
            1649998200, 
            1649998140, 
            1649998080, 
            1649998020, 
            1649997960, 
            1649997900, 
            1649997840, 
            1649997780, 
            1649997720, 
            1649997660, 
            1649997600, 
            1649997540, 
            1649997480, 
            1649997420, 
            1649997360, 
            1649997300, 
            1649997240, 
            1649997180, 
            1649997120, 
            1649997060, 
            1649997000, 
            1649996940, 
            1649996880, 
            1649996820, 
            1649996760, 
            1649996700, 
            1649996640, 
            1649996580, 
            1649996520, 
            1649996460, 
            1649996400, 
            1649996340, 
            1649996280, 
            1649996220, 
            1649996160, 
            1649996100, 
            1649996040, 
            1649995980, 
            1649995920, 
            1649995860, 
            1649995800, 
            1649995740, 
            1649995680, 
            1649995620, 
            1649995560, 
            1649995500, 
            1649995440, 
            1649995380, 
            1649995320, 
            1649995260, 
            1649995200, 
            1649995140, 
            1649995080, 
            1649995020, 
            1649994960, 
            1649994900, 
            1649994840, 
            1649994780, 
            1649994720, 
            1649994660, 
            1649994600, 
            1649994540, 
            1649994480, 
            1649994420, 
            1649994360, 
            1649994300, 
            1649994240, 
            1649994180, 
            1649994120, 
            1649994060, 
            1649994000, 
            1649993940, 
            1649993880, 
            1649993820, 
            1649993760, 
            1649993700, 
            1649993640, 
            1649993580, 
            1649993520, 
            1649993460, 
            1649993400, 
            1649993340, 
            1649993280, 
            1649993220, 
            1649993160, 
            1649993100, 
            1649993040, 
            1649992980, 
            1649992920, 
            1649992860, 
            1649992800, 
            1649992740, 
            1649992680, 
            1649992620, 
            1649992560, 
            1649992500, 
            1649992440, 
            1649992380, 
            1649992320, 
            1649992260, 
            1649992200, 
            1649992140, 
            1649992080, 
            1649992020, 
            1649991960, 
            1649991900, 
            1649991840, 
            1649991780, 
            1649991720, 
            1649991660, 
            1649991600, 
            1649991540, 
            1649991480, 
            1649991420, 
            1649991360, 
            1649991300, 
            1649991240, 
            1649991180, 
            1649991120, 
            1649991060, 
            1649991000, 
            1649990940, 
            1649990880, 
            1649990820, 
            1649990760, 
            1649990700, 
            1649990640, 
            1649990580, 
            1649990520, 
            1649990460, 
            1649990400, 
            1649990340, 
            1649990280, 
            1649990220, 
            1649990160, 
            1649990100, 
            1649990040, 
            1649989980, 
            1649989920, 
            1649989860, 
            1649989800, 
            1649989740, 
            1649989680, 
            1649989620, 
            1649989560, 
            1649989500, 
            1649989440, 
            1649989380, 
            1649989320, 
            1649989260, 
            1649989200, 
            1649989140, 
            1649989080, 
            1649989020, 
            1649988960, 
            1649988900, 
            1649988840, 
            1649988780, 
            1649988720, 
            1649988660, 
            1649988600, 
            1649988540, 
            1649988480, 
            1649988420, 
            1649988360, 
            1649988300, 
            1649988240, 
            1649988180, 
            1649988120, 
            1649988060, 
            1649988000, 
            1649987940, 
            1649987880, 
            1649987820, 
            1649987760, 
            1649987700, 
            1649987640, 
            1649987580, 
            1649987520, 
            1649987460, 
            1649987400, 
            1649987340, 
            1649987280, 
            1649987220, 
            1649987160, 
            1649987100, 
            1649987040, 
            1649986980, 
            1649986920, 
            1649986860, 
            1649986800, 
            1649986740, 
            1649986680, 
            1649986620, 
            1649986560, 
            1649986500, 
            1649986440, 
            1649986380, 
            1649986320, 
            1649986260, 
            1649986200, 
            1649986140, 
            1649986080, 
            1649986020, 
            1649985960, 
            1649985900, 
            1649985840, 
            1649985780, 
            1649985720, 
            1649985660, 
            1649985600, 
            1649985540, 
            1649985480, 
            1649985420, 
            1649985360, 
            1649985300, 
            1649985240, 
            1649985180, 
            1649985120, 
            1649985060, 
            1649985000, 
            1649984940, 
            1649984880, 
            1649984820, 
            1649984760, 
            1649984700, 
            1649984640, 
            1649984580, 
            1649984520, 
            1649984460, 
            1649984400
        ], 
        "o": [
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.15, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.1, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.2, 
            47.15, 
            47.15, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.4, 
            47.35, 
            47.4, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.4, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.3, 
            47.35, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.35, 
            47.35, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.55, 
            47.5
        ], 
        "h": [
            47.1, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.2, 
            47.15, 
            47.15, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.35, 
            47.4, 
            47.35, 
            47.4, 
            47.35, 
            47.4, 
            47.4, 
            47.4, 
            47.45, 
            47.45, 
            47.45, 
            47.45, 
            47.55, 
            47.55
        ], 
        "l": [
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.35, 
            47.35, 
            47.35, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.5
        ], 
        "c": [
            47.1, 
            47.15, 
            47.2, 
            47.15, 
            47.2, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.1, 
            47.05, 
            47.1, 
            47.05, 
            47.1, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.1, 
            47.1, 
            47.05, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.05, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.05, 
            47.1, 
            47.05, 
            47.1, 
            47.1, 
            47.05, 
            47.05, 
            47.05, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.15, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.1, 
            47.15, 
            47.15, 
            47.1, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.15, 
            47.2, 
            47.15, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.2, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.25, 
            47.25, 
            47.25, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.3, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.4, 
            47.4, 
            47.35, 
            47.4, 
            47.4, 
            47.35, 
            47.4, 
            47.4, 
            47.4, 
            47.35, 
            47.35, 
            47.35, 
            47.4, 
            47.4, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.35, 
            47.3, 
            47.3, 
            47.3, 
            47.35, 
            47.35, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.4, 
            47.5
        ], 
        "v": [
            1207, 
            67, 
            60, 
            57, 
            93, 
            75, 
            73, 
            149, 
            34, 
            74, 
            124, 
            67, 
            90, 
            62, 
            63, 
            92, 
            93, 
            41, 
            61, 
            85, 
            28, 
            38, 
            36, 
            25, 
            41, 
            41, 
            41, 
            50, 
            42, 
            19, 
            47, 
            43, 
            15, 
            42, 
            61, 
            250, 
            63, 
            52, 
            30, 
            48, 
            54, 
            40, 
            64, 
            59, 
            23, 
            40, 
            40, 
            87, 
            38, 
            94, 
            41, 
            51, 
            90, 
            45, 
            68, 
            65, 
            27, 
            21, 
            24, 
            14, 
            71, 
            30, 
            26, 
            18, 
            23, 
            35, 
            24, 
            43, 
            20, 
            41, 
            27, 
            36, 
            32, 
            21, 
            29, 
            61, 
            69, 
            37, 
            36, 
            102, 
            110, 
            18, 
            25, 
            20, 
            27, 
            41, 
            35, 
            64, 
            26, 
            33, 
            22, 
            73, 
            130, 
            64, 
            18, 
            22, 
            44, 
            31, 
            41, 
            69, 
            68, 
            57, 
            19, 
            48, 
            36, 
            65, 
            65, 
            36, 
            195, 
            23, 
            24, 
            24, 
            25, 
            29, 
            149, 
            32, 
            38, 
            23, 
            23, 
            34, 
            24, 
            30, 
            26, 
            33, 
            26, 
            32, 
            72, 
            26, 
            23, 
            36, 
            26, 
            47, 
            220, 
            27, 
            163, 
            19, 
            41, 
            81, 
            44, 
            92, 
            46, 
            52, 
            45, 
            99, 
            27, 
            30, 
            28, 
            27, 
            28, 
            41, 
            49, 
            35, 
            33, 
            35, 
            192, 
            21, 
            57, 
            33, 
            36, 
            28, 
            25, 
            42, 
            54, 
            54, 
            62, 
            27, 
            24, 
            42, 
            32, 
            43, 
            46, 
            16, 
            29, 
            33, 
            37, 
            24, 
            40, 
            45, 
            42, 
            59, 
            205, 
            60, 
            55, 
            71, 
            235, 
            57, 
            49, 
            41, 
            25, 
            61, 
            361, 
            64, 
            529, 
            49, 
            114, 
            619, 
            15, 
            62, 
            27, 
            36, 
            38, 
            19, 
            17, 
            63, 
            33, 
            30, 
            61, 
            40, 
            23, 
            19, 
            19, 
            15, 
            23, 
            36, 
            35, 
            28, 
            31, 
            40, 
            35, 
            34, 
            47, 
            44, 
            57, 
            78, 
            52, 
            484, 
            135, 
            93, 
            130, 
            106, 
            34, 
            567, 
            106, 
            50, 
            23, 
            28, 
            35, 
            42, 
            39, 
            33, 
            29, 
            18, 
            35, 
            58, 
            47, 
            41, 
            45, 
            31, 
            43, 
            41, 
            53, 
            124, 
            51, 
            112, 
            56, 
            269, 
            66, 
            86, 
            121, 
            36, 
            166, 
            55, 
            47, 
            87, 
            374, 
            4287
        ], 
        "vwap": [
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null, 
            null
        ], 
        "quote": {
            "0": "TWS:1101:STOCK", 
            "6": 47.1, 
            "11": -0.6, 
            "12": 47.55, 
            "13": 47.05, 
            "21": 47.7, 
            "56": -1.26, 
            "75": 52.4, 
            "76": 42.95, 
            "3404": 47.2463, 
            "200009": "", 
            "800001": 22509.963, 
            "800013": "TWS:1101:STOCK", 
            "800041": 0, 
            "isTrading": 0
        }, 
        "session": [
            [
                1649984400, 
                1650000900
            ]
        ], 
        "nextTime": 1650007471
    }
}';
        }
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
        "tradeable": false,
        "epsTrailingTwelveMonths": 3.265,
        "epsForward": 3.75,
        "epsCurrentYear": 3.58,
        "priceEpsCurrentYear": 13.743017,
        "sharesOutstanding": 6116170240,
        "bookValue": 33.105,
        "fiftyDayAverage": 47.681,
        "fiftyDayAverageChange": 1.519001,
        "fiftyDayAverageChangePercent": 0.031857576,
        "twoHundredDayAverage": 49.00325,
        "twoHundredDayAverageChange": 0.19675064,
        "twoHundredDayAverageChangePercent": 0.0040150527,
        "marketCap": 300915589120,
        "forwardPE": 13.12,
        "priceToBook": 1.4861804,
        "currency": "TWD",
        "priceHint": 2,
        "regularMarketChange": -0.5,
        "regularMarketChangePercent": -1.0060362,
        "regularMarketTime": 1648434626,
        "regularMarketPrice": 49.2,
        "regularMarketDayHigh": 49.4,
        "regularMarketDayRange": "49.1 - 49.4",
        "regularMarketDayLow": 49.1,
        "regularMarketVolume": 3955440,
		"bid": 49.2,
        "sourceInterval": 20,
        "exchangeDataDelayedBy": 20,
        "averageAnalystRating": "2.8 - Hold",
        "firstTradeDateMilliseconds": 946947600000,
        "regularMarketPreviousClose": 49.7,
		"ask": 49.25,
        "bidSize": 0,
        "askSize": 0,
        "fullExchangeName": "Taiwan",
        "financialCurrency": "TWD",
        "regularMarketOpen": 49.4,
        "averageDailyVolume3Month": 10760271,
        "averageDailyVolume10Day": 14843692,
        "fiftyTwoWeekLowChange": 3.5499992,
        "fiftyTwoWeekLowChangePercent": 0.07776559,
        "fiftyTwoWeekRange": "45.65 - 58.7",
        "fiftyTwoWeekHighChange": -9.5,
        "fiftyTwoWeekHighChangePercent": -0.16183986,
        "fiftyTwoWeekLow": 45.65,
        "fiftyTwoWeekHigh": 58.7,
        "earningsTimestamp": 1645786740,
        "earningsTimestampStart": 1652180340,
        "earningsTimestampEnd": 1652702400,
        "trailingAnnualDividendRate": 0,
        "trailingPE": 15.0689125,
        "trailingAnnualDividendYield": 0,
        "marketState": "REGULAR",
        "exchange": "TAI",
        "shortName": "TAIWAN CEMENT",
        "longName": "台泥",
        "messageBoardId": "finmb_877741_lang_zh",
        "exchangeTimezoneName": "Asia/Taipei",
        "exchangeTimezoneShortName": "CST",
        "gmtOffSetMilliseconds": 28800000,
        "market": "tw_market",
        "esgPopulated": false,
        "symbol": "1101.TW"
      }
    ],
    "error": null
  }
}';
        }
        
    }
    
    
    
    
    
}
