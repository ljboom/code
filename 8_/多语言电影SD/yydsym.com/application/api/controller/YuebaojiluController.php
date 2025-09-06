<?php
namespace app\api\controller;

use think\Controller;
use think\Db;

class YuebaojiluController extends Controller{
	//初始化方法
	protected function initialize(){		
	 	parent::initialize();		
		header('Access-Control-Allow-Origin:*');
		//header('Access-Control-Allow-Credentials: true');
		//header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
		//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authKey, sessionId");
    }
	

    /**  获取活动列表  **/
	public function getYuebaojiluList(){
		$data = model('Yuebaojilu')->getYuebaojiluList();
		return json($data);
	}
	
	
	/**  获取用户活动记录列表  **/
	public function getUserYuebaojiluList(){
		$data = model('Yuebaojilu')->getUserYuebaojiluList();
		return json($data);
	}
	
	/*购买活动
     * userid   用户ID
     * money    金额
     * yuebaoid   产品IP
    */
    public function payYuebao(){
        if ($this->request->isPost()){
            $postData = $this->request->post();
            $checkYuebao = Db::table('ly_yuebao_list')->where(array('id'=>$postData['yuebaoid']))->find();
            if($checkYuebao === NULL){
                return json(array('errorCode'=>201,'errorMsg'=>'产品不存在'));
            }

            $getUserTotal = Db::table('ly_user_total')->where(array('uid'=>$postData['userid']))->find();
            if($getUserTotal === NULL || $getUserTotal['balance'] < $postData['money']){
                return json(array('errorCode'=>201,'errorMsg'=>'用户余额不足'));
            }

            $insertData = array(
                'uid'=>$postData['userid'],
                'yuebaoid'=>$postData['yuebaoid'],
                'lilv'=>$checkYuebao['lilv'],
                'money'=>$postData['money'],
                'daynum'=>$checkYuebao['time'],
                'start_time'=>date('Y-m-d H:i:s',time()),
                'end_time'=>date('Y-m-d H:i:s',time()+($checkYuebao['time']*86400)),
                'status'=>1,
            );
            Db::startTrans();
            $yuebaoPayStatus = Db::table('ly_yuebao_pay')->insert($insertData);
            if ($yuebaoPayStatus !== 1){
                Db::rollback();
                return json(array('errorCode'=>201,'errorMsg'=>'网络出错请重试'));
            }
            $balance = $getUserTotal['balance'] - $postData['money'];
            $userTotalStatus = Db::table('ly_user_total')->where(array('id'=>$getUserTotal['id']))->update(array('balance'=>$balance));
            if($userTotalStatus !== 1){
                Db::rollback();
                return json(array('errorCode'=>201,'errorMsg'=>'网络出错请重试'));
            }
            Db::commit();
            return json(array('errorCode'=>200,'errorMsg'=>'','successMsg'=>'购买成功'));
        }
    }
	
}
