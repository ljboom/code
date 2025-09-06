<?php 
namespace app\api\controller;

use app\api\controller\BaseController;

class OrderController extends BaseController{
	
	//创建订单接口
	//返回支付页面 paymentUrl
	//直接创建订单 跳转 页面提交入库
	public function createOrder(){
		$data = model('Order')->createOrder();
		return json($data);
	}

	//订单详细
	public function orderDetail(){

		$data = model('Order')->orderDetail();
		return json($data);

	}
	
	//订单列表
	public function orderList(){

		$data = model('Order')->orderList();
		return json($data);
		
	}
	
	//付息还本记录
	public function orderRecordList(){

		$data = model('Order')->orderRecordList();
		return json($data);
		
	}
	
	//合同
	public function hetong(){

		$data = model('Order')->hetong();
		return json($data);
		
	}
	
	//付息还本
	public function repayMent(){

		$data = model('Order')->repayMent();
		return json($data);
		
	}
	
}