<?php
// +----------------------------------------------------------------------
// | Yzncms [ 御宅男工作室 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://yzncms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 御宅男 <530765310@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 会员管理
// +----------------------------------------------------------------------
namespace app\member\controller;

use app\common\controller\Adminbase;
use app\member\model\Member as Member_Model;
use app\member\service\User;
use app\index\model\Quser as QuserModel; //新的用户表
use app\index\model\Qcard as QcardModel; //用户银行卡表
use think\facade\Session;
use think\Db;

class Member extends Adminbase
{
    protected $searchFields = 'id,username,nickname';
    //初始化
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass  = new Member_Model;
        $this->QuserModel  = new QuserModel;
        $this->QcardModel  = new QcardModel;
        
        $this->UserService = User::instance();
        $this->groupCache  = cache("Member_Group"); //会员模型
    }
    
      public function qmoney_journal(){
        $get = input('get.');
        // $page = empty($post['page']) ? 1 : $post['page'];
        // $get['quser_id'] = 63;
        $_list = Db::name('qmoney_journal')->where('quser_id' ,$get['id'])
            // ->where('type','<>',8)
            // ->page($page ,20)
            ->order('id desc')->select();

        if(empty($_list)){
            $data = [];
            $this->assign("data", $data);
            return $this->fetch();
        }
        $array = [];
        foreach($_list as $k => $v){
            if($v['type'] == 1 ){
                $symbol_name = Db::name('qrecharge')->where('id',$v['table_id'])->value('remarks');
                $array[$k] = array(
                    'id' => $v['id'],
                    'type' =>  '+',
                    'money' => $v['money'],
                    'content' =>  '充值' ,
                    'symbol_name' => $symbol_name,
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                    );
                
            }
            if($v['type'] == 2){
                $symbol_name = Db::name('qwithdrawal')->where('id',$v['table_id'])->value('remarks');
                $array[$k] = array(
                    'id' => $v['id'],
                    'type' =>  '-',
                    'money' => $v['money'],
                    'content' =>  '提現' ,
                    'symbol_name' => $symbol_name,
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                    );
                
            }
            if($v['type'] == 3 || $v['type'] == 4){
                $qxingushengou = Db::name('qxingushengou')->where('id',$v['table_id'])->field('number,qstocks_new_id')->find();
                $qstocks_new = Db::name('qstocks_new')->where('id',$qxingushengou['qstocks_new_id'])->field('symbol_name,symbol')->find();
                $array[$k] = array(
                    'id' => $v['id'],
                    'number' => $qxingushengou['number'],
                    'type' => $v['type'] == 3 ? '-' : '+',
                    'money' => $v['money'],
                    'content' => $v['type'] == 3 ? '新股認繳' : '新股認繳失敗',
                    'symbol_name' => $qstocks_new['symbol_name'] .' ' .$qstocks_new['symbol'],
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                    );
            }
            
            if($v['type'] == 5 || $v['type'] == 6 || $v['type'] == 7){
                $chicang = Db::name('qchicang')->where('id',$v['table_id'])->field('number,qstockservices_id')->find();
                $qstockservices = Db::name('qstockservices')->where('id',$chicang['qstockservices_id'])->field('symbolName,symbol')->find();
                $array[$k] = array(
                    'id' => $v['id'],
                    'number' => $chicang['number'],
                    'type' => $v['type'] == 5 ? '-' : '+',
                    'money' => $v['money'],
                    'content' => $v['type'] == 5 ? '股票買入' : '股票賣出',
                    'symbol_name' => $qstockservices['symbolName'] .' ' .$qstockservices['symbol'],
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                    );
                if($v['type'] == 7){
                    $array[$k]['content'] = '取消股票買入';
                }
            }

            if($v['type'] == 8 || $v['type'] == 9 || $v['type'] == 10){
                $qxingushengou = Db::name('damow_order')->where('id',$v['table_id'])->find();
                $array[$k] = array(
                    'id' => $v['id'],
                    'number' => $qxingushengou['order_number'],
                    'type' => $v['type'] == 9 ? '-' : '+',
                    'money' => $v['money'],
                    'content' => $v['type'] == 9 ? '投資' : ($v['type'] == 10 ?'投資贖回':'獲得收益'),
                    'symbol_name' => $qxingushengou['product_name'],
                    'add_time' => date("Y-m-d H:i:s" ,$v['add_time']),
                );
            }
        }
        $data = array_values($array);
        // dump($data);
        $this->assign("data", $data);
        return $this->fetch();
   }
    /**
     * 客户列表
     */
    public function quserlist(){
        if ($this->request->isAjax()) {
            
            list($page, $limit, $where) = $this->buildTableParames();
            
            $quser_arr = quser_arr(2);
            $_list = $this->QuserModel
                ->where($quser_arr['key'] , $quser_arr['fuhao'] ,$quser_arr['val'])
                ->where($where)->order('id desc')->page($page, $limit)->select();
            foreach($_list as $k => $v){
                $_list[$k]['reg_time'] = date("Y-m-d H:i:s",$v['reg_time']);
                $_list[$k]['code_name'] = quser_admin($v['id']);
                if($v['status'] == 0){ $_list[$k]['status'] = '未填写'; }
                if($v['status'] == 1){ $_list[$k]['status'] = '通过'; }
                if($v['status'] == 2){ $_list[$k]['status'] = '未通过'; }
                if($v['status'] == 4){ $_list[$k]['status'] = '待审核'; }
            }
            $total                      = $this->QuserModel->where($quser_arr['key'] , $quser_arr['fuhao'] ,$quser_arr['val'])->where($where)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();
    }   
    /**
     * 客户添加
     */
    public function quserlist_add(){
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $res = $this->QuserModel->createManager($data);
            if($res['code'] == 200){
                $this->success("添加会员成功！", url("member/quserlist"));
            }else{
                $this->error($res['msg']);
            }
        } else {
            return $this->fetch();
        }
    }   
    /**
     * 客户编辑
     */
    public function quserlist_edit(){
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $res = $this->QuserModel->editManager($data);
            if($res['code'] == 200){
                $this->success("编辑会员成功！", url("member/quserlist"));
            }else{
                $this->error($res['msg']);
            }
        }else {
            $arr['id'] = $this->request->param('id/d', 0);
            $arr['type'] = $this->request->param('type/d', 0);
            $admin = Session::get('admin');
            $data   = $res = $this->QuserModel->selManager($arr);
            
            if ($data['code'] != 200) {
                $this->error("该会员不存在！");
            }
            $this->assign("data", $data['data']);
            $this->assign("admin", $admin);
            if($arr['type'] == 1){
                return view('quserlist_edit_quser');
            }
            if($arr['type'] == 2){
                return view('quserlist_edit_type');
            }
            return $this->fetch();
        }
    }   
    
    
    /**
     * 客户删除
     */
    public function quserlist_del(){
        
        $ids = $this->request->param('id/a', null);
        if (empty($ids)) {
            $this->error('请选择需要删除的会员！');
        }
        if (!is_array($ids)) {
            $ids = array(0 => $ids);
        }
        foreach ($ids as $uid) {
            $this->QuserModel->where('id',$uid)->delete();
        }
        $this->success("删除成功！");
    }
    
    
    /**
     * 客户银行卡
     */
    public function quserlist_qcard(){
        $arr['quser_id'] = $this->request->param('id/d', 0);
        $data = $this->QcardModel->selManager($arr);
        $this->assign("data", $data['data']);
        return $this->fetch();
    }

    /**
     * 会员列表
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $_list                      = $this->modelClass->where($where)->where('status', 1)->page($page, $limit)->select();
            $total                      = $this->modelClass->where($where)->where('status', 1)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();
    }

    /**
     * 审核会员
     */
    public function userverify()
    {
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $_list                      = $this->modelClass->where($where)->where('status', '<>', 1)->page($page, $limit)->select();
            $total                      = $this->modelClass->where($where)->where('status', '<>', 1)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);

        }
        return $this->fetch();
    }

    /**
     * 会员增加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $result = $this->validate($data, 'member');
            if (true !== $result) {
                return $this->error($result);
            }
            $data['overduedate'] = strtotime($data['overduedate']);
            if ($this->UserService->userRegister($data['username'], $data['password'], $data['email'], $data['mobile'], $data)) {
                $this->success("添加会员成功！", url("member/index"));
            } else {
                //$this->UserService->delete($memberinfo['userid']);
                $this->error($this->UserService->getError() ?: '添加会员失败！');
            }
        } else {
            foreach ($this->groupCache as $_key => $_value) {
                $groupCache[$_key] = $_value['name'];
            }
            $this->assign('groupCache', $groupCache);
            return $this->fetch();
        }
    }

    /**
     * 会员编辑
     */
    public function edit()
    {
        if ($this->request->isPost()) {
            $userid = $this->request->param('id/d', 0);
            $data   = $this->request->post();
            $result = $this->validate($data, 'member.edit');
            if (true !== $result) {
                return $this->error($result);
            }
            //获取用户信息
            $userinfo = Member_Model::get($userid);
            if (empty($userinfo)) {
                $this->error('该会员不存在！');
            }
            //修改基本资料
            if ($userinfo['username'] != $data['username'] || !empty($data['password']) || $userinfo['email'] != $data['email']) {
                $res = $this->modelClass->userEdit($userinfo['username'], '', $data['password'], $data['email'], 1);
                if (!$res) {
                    $this->error($this->modelClass->getError());
                }
            }
            unset($data['username'], $data['password'], $data['email']);
            $data['overduedate'] = strtotime($data['overduedate']);
            //更新除基本资料外的其他信息
            if (false === $this->modelClass->allowField(true)->save($data, ['id' => $userid])) {
                $this->error('更新失败！');
            }
            $this->success("更新成功！", url("member/index"));

        } else {
            $userid = $this->request->param('id/d', 0);
            $data   = $this->modelClass->where(["id" => $userid])->withAttr('overduedate', function ($value, $data) {
                return date('Y-m-d H:i:s', $value);
            })->find();
            if (empty($data)) {
                $this->error("该会员不存在！");
            }
            foreach ($this->groupCache as $_key => $_value) {
                $groupCache[$_key] = $_value['name'];
            }
            $this->assign('groupCache', $groupCache);
            $this->assign("data", $data);
            return $this->fetch();
        }
    }

    /**
     * 会员删除
     */
    public function del()
    {
        $ids = $this->request->param('id/a', null);
        if (empty($ids)) {
            $this->error('请选择需要删除的会员！');
        }
        if (!is_array($ids)) {
            $ids = array(0 => $ids);
        }
        foreach ($ids as $uid) {
            $this->UserService->delete($uid);
        }
        $this->success("删除成功！");

    }

    /**
     * 审核会员
     */
    public function pass()
    {
        $ids = $this->request->param('id/a', null);
        if (empty($ids)) {
            $this->error('请选择需要审核的会员！');
        }
        if (!is_array($ids)) {
            $ids = array(0 => $ids);
        }
        foreach ($ids as $uid) {
            $info = Member_Model::where('id', $uid)->update(['status' => 1]);
        }
        $this->success("审核成功！");
    }

}
