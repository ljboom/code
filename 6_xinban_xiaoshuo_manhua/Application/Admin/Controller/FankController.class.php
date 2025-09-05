<?php
namespace Admin\Controller;
use Think\Controller;
class FankController extends AdminController {
    // 列表
	public function index(){
		$this->assign('fank',C('Fank'));
		$this -> _list('mh_feedback');
	}
	
	public function del(){
		$this -> _del('mh_feedback', $_GET['id']);
		$this -> success('操作成功！', $_SERVER['HTTP_REFERER']);
	}
	

}