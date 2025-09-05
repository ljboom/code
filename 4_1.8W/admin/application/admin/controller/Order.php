<?php
namespace app\admin\controller;
use app\common\controller\Admin;

use think\Db;
/**
 * 订单列表
 * @package app\admin\controller
 */
class Order extends Admin
{
    /**
     * 订单列表 
     * 
     */
    public function index()
    {
         $param = $this->request->param();
        // 非超级管理员检查可管理角色、用户
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::getTreeGetChildsId(ADMIN_GID,2);
            $where = "group_id IN ({$groupId})";
            $whereGroup = "id IN ({$groupId})";
        }else{
            $where = $whereGroup = 1;
        }
       if(!isset($search['keyword'])){
           $search['keyword'] = '';
       }
        $search['status'] = '';
        if (isset($param['status'])) {
            $search['status'] = $param['status'];
        }
        if (isset($param['group_id'])) {
            $search['group_id'] = $param['group_id'];
        }
        if (isset($param['type'])) {
            $search['type'] = $param['type'];
        }
        if (isset($param['keyword'])) {
            $search['keyword'] = $param['keyword'];
        }
        if (isset($param['data_start'])) {
            $search['data_start'] = $param['data_start'];
        }
        if (isset($param['data_end'])) {
            $search['data_end'] = $param['data_end'];
        }

       
        if ($search['keyword']) {
            $keyword = "'%" . $search['keyword'] . "%'";
            if ($search['type'] == 1) {
                $where .= " and o.id = " . $search['keyword'];
            } elseif ($search['type'] == 2) {
                $where .= " and u.mobile like " . $keyword;
            }  
        }
        

        if (!empty($search['status'])) {
            $where .= " and o.status =" . $search['status'];
        }
        // if (!empty($search['group_id'])) {
        //     $where .= " and `group_id` =" . $search['group_id'];
        // }
        if (!empty($search['data_start'])) {
            $where .= " and o.createtime >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and o.createtime <= '" . strtotime($search['data_end']) . "'";
        }
        
           $list = Db::table('me_order')
                ->alias("o")
                ->join('me_fundcode f', 'o.code = f.code')
                ->join('me_users u', 'o.user_id = u.id')
                ->field('o.*,f.fund_name,u.mobile')
                ->where($where)
                ->order('createtime desc')
                ->paginate(20, false, ['query' => $search]);
      
        // 获取分页显示
        $page = $list->render();

        // $roleList = AuthGroupModel::where($whereGroup)->column('name', 'id');
        // 模板变量赋值
        $this->assign('list', $list);
      //  $this->assign('role_list', $roleList);
        $this->assign('page', $page);
        return $this->fetch();
    }
    
    /**
     * 订单状态修改
     * 
     */ 
     //禁用
    public function editStatus()
    {   
        if(!$this->request->isAjax()){
            $this->error("操作太频繁，请稍后操作!");
        }
        
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $type = $this->request->param('type');
            $ids = explode(",", $ids);
        }
         if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
            $type = $this->request->param('type');
        }
       
        foreach($ids as $v){
            Db::table('me_order')->where('id',$v)->update(['status' => $type]);
        }
         return apiRule(true, '修改成功');
    }
    
    
    public function earnings()
    {
         $param = $this->request->param();
        // 非超级管理员检查可管理角色、用户
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::getTreeGetChildsId(ADMIN_GID,2);
            $where = "group_id IN ({$groupId})";
            $whereGroup = "id IN ({$groupId})";
        }else{
            $where = $whereGroup = 1;
        }
       if(!isset($search['keyword'])){
           $search['keyword'] = '';
       }
        $search['status'] = '';
        if (isset($param['status'])) {
            $search['status'] = $param['status'];
        }
        if (isset($param['group_id'])) {
            $search['group_id'] = $param['group_id'];
        }
        if (isset($param['type'])) {
            $search['type'] = $param['type'];
        }
        if (isset($param['keyword'])) {
            $search['keyword'] = $param['keyword'];
        }
        if (isset($param['data_start'])) {
            $search['data_start'] = $param['data_start'];
        }
        if (isset($param['data_end'])) {
            $search['data_end'] = $param['data_end'];
        }

       
        if ($search['keyword']) {
            $keyword = "'%" . $search['keyword'] . "%'";
            if ($search['type'] == 1) {
                $where .= " and o.id = " . $search['keyword'];
            } elseif ($search['type'] == 2) {
                $where .= " and u.mobile like " . $keyword;
            }  
        }
        

        if (!empty($search['status'])) {
            $where .= " and o.status =" . $search['status'];
        }
        // if (!empty($search['group_id'])) {
        //     $where .= " and `group_id` =" . $search['group_id'];
        // }
        if (!empty($search['data_start'])) {
            $where .= " and o.earningstime >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and o.earningstime <= '" . strtotime($search['data_end']) . "'";
        }
        
           $list = Db::table('me_orderinfo')
                ->alias("o")
                ->join('me_fundcode f', 'o.code = f.code')
                ->join('me_users u', 'o.user_id = u.id')
                ->field('o.*,f.fund_name,u.mobile')
                ->where($where)
                ->order('earningstime desc')
                ->paginate(20, false, ['query' => $search]);
      
        // 获取分页显示
       
        $page = $list->render();

        // $roleList = AuthGroupModel::where($whereGroup)->column('name', 'id');
        // 模板变量赋值
        $this->assign('list', $list);
      //  $this->assign('role_list', $roleList);
        $this->assign('page', $page);
        return $this->fetch();
    }
    
    /**
     * 充值列表
     */ 
    public function recharge()
    {
        $param = $this->request->param();
        // 非超级管理员检查可管理角色、用户
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::getTreeGetChildsId(ADMIN_GID,2);
           
            $where = "group_id IN ({$groupId})";
            $whereGroup = "id IN ({$groupId})";
        }else{
            $where = $whereGroup = 1;
        }
       if(!isset($search['keyword'])){
           $search['keyword'] = '';
       }
        $search['status'] = '';
        if (isset($param['status'])) {
            $search['status'] = $param['status'];
        }
        if (isset($param['group_id'])) {
            $search['group_id'] = $param['group_id'];
        }
        if (isset($param['type'])) {
            $search['type'] = $param['type'];
        }
        if (isset($param['keyword'])) {
            $search['keyword'] = $param['keyword'];
        }
        if (isset($param['data_start'])) {
            $search['data_start'] = $param['data_start'];
        }
        if (isset($param['data_end'])) {
            $search['data_end'] = $param['data_end'];
        }

       
        if ($search['keyword']) {
            $keyword = "'%" . $search['keyword'] . "%'";
            if ($search['type'] == 1) {
                $where .= " and r.id = " . "{$search['keyword']}";
            } elseif ($search['type'] == 2) {
                $where .= " and u.mobile like " . $keyword;
            }  
        }
       // var_dump($where);die;

        if (!empty($search['status'])) {
            $where .= " and r.status =" . $search['status'];
        }
        // if (!empty($search['group_id'])) {
        //     $where .= " and `group_id` =" . $search['group_id'];
        // }
        if (!empty($search['data_start'])) {
            $where .= " and r.createtime >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and r.createtime <= '" . strtotime($search['data_end']) . "'";
        }
        
        
        $list = Db::table('me_withdrawal')
                ->alias('r')
                ->join('me_users u', 'r.user_id = u.id')
                ->field('r.*,u.mobile')
                ->where($where)
                ->where('type',1)
                ->order('createtime desc')
                ->paginate(20, false, ['query' => $search]);

      
        // 获取分页显示
        $page = $list->render();

        // $roleList = AuthGroupModel::where($whereGroup)->column('name', 'id');
        // 模板变量赋值
        $this->assign('list', $list);
      //  $this->assign('role_list', $roleList);
        $this->assign('page', $page);
        return $this->fetch();
    }
      
     /**
      * 充值审核
      */ 
    public function recharge_editStatus()
    {   
        if(!$this->request->isAjax()){
            $this->error("操作太频繁，请稍后操作!");
        }
        
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $type = $this->request->param('type');
            $ids = explode(",", $ids);
        }
         if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
            $type = $this->request->param('type');
        }
       
         
        foreach($ids as $v){
            if($type == 3){
                $withdrawalData = Db::table('me_withdrawal')->where('id',$v)->find();
               Db::table('me_withdrawal')->where('id',$v)->update(['status' => $type,'disposetime'=>time()]); 
                //加入日志
                 $log['user_id'] = $withdrawalData['user_id'];
                 $log['content'] = "充值".$withdrawalData['money']."￥".'审核驳回';
                 $log['createtime'] = time();
                 Db::table('me_log')->insert($log);
               
            }elseif($type == 2){
                $withdrawalData = Db::table('me_withdrawal')->where('id',$v)->find();
                $userData = Db::table('me_users')->where('id',$withdrawalData['user_id'])->find();
                $res = Db::table('me_users')->where('id',$userData['id'])->update(['money'=>$userData['money'] + $withdrawalData['money']]);
                if($res){
                    //加入日志
                     $log['user_id'] = $userData['id'];
                     $log['content'] = "充值".$withdrawalData['money']."￥".'审核通过！';
                     $log['createtime'] = time();
                     Db::table('me_log')->insert($log);
                }
                Db::table('me_withdrawal')->where('id',$v)->update(['status' => $type,'disposetime'=>time()]);
            }
            
        }
         return apiRule(true, '审核成功');
    }
    
    
    /**
     * 提现列表
     */ 
    public function deposit()
    {
       $param = $this->request->param();
        // 非超级管理员检查可管理角色、用户
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::getTreeGetChildsId(ADMIN_GID,2);
           
            $where = "group_id IN ({$groupId})";
            $whereGroup = "id IN ({$groupId})";
        }else{
            $where = $whereGroup = 1;
        }
       if(!isset($search['keyword'])){
           $search['keyword'] = '';
       }
        $search['status'] = '';
        if (isset($param['status'])) {
            $search['status'] = $param['status'];
        }
        if (isset($param['group_id'])) {
            $search['group_id'] = $param['group_id'];
        }
        if (isset($param['type'])) {
            $search['type'] = $param['type'];
        }
        if (isset($param['keyword'])) {
            $search['keyword'] = $param['keyword'];
        }
        if (isset($param['data_start'])) {
            $search['data_start'] = $param['data_start'];
        }
        if (isset($param['data_end'])) {
            $search['data_end'] = $param['data_end'];
        }

       
        if ($search['keyword']) {
            $keyword = "'%" . $search['keyword'] . "%'";
            if ($search['type'] == 1) {
                $where .= " and r.id = " . "{$search['keyword']}";
            } elseif ($search['type'] == 2) {
                $where .= " and u.mobile like " . $keyword;
            }  
        }
       // var_dump($where);die;

        if (!empty($search['status'])) {
            $where .= " and r.status =" . $search['status'];
        }
        // if (!empty($search['group_id'])) {
        //     $where .= " and `group_id` =" . $search['group_id'];
        // }
        if (!empty($search['data_start'])) {
            $where .= " and r.createtime >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and r.createtime <= '" . strtotime($search['data_end']) . "'";
        }
        
        
        $list = Db::table('me_withdrawal')
                ->alias('r')
                ->join('me_users u', 'r.user_id = u.id')
                ->join('me_binding_bank b', 'r.bank_id = b.id')
                ->field('r.*,u.mobile,b.name,b.number,b.opening_bank,b.bank_card,b.phone')
                ->where($where)
                ->where('type',2)
                ->order('createtime desc')
                ->paginate(20, false, ['query' => $search]);

      
        // 获取分页显示
        $page = $list->render();
      
        // $roleList = AuthGroupModel::where($whereGroup)->column('name', 'id');
        // 模板变量赋值
        $this->assign('list', $list);
      //  $this->assign('role_list', $roleList);
        $this->assign('page', $page);
        return $this->fetch();
    }
    
    /**
     * 基金卖出
     */ 
    public function sellout()
    {
       $param = $this->request->param();
        // 非超级管理员检查可管理角色、用户
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::getTreeGetChildsId(ADMIN_GID,2);
           
            $where = "group_id IN ({$groupId})";
            $whereGroup = "id IN ({$groupId})";
        }else{
            $where = $whereGroup = 1;
        }
       if(!isset($search['keyword'])){
           $search['keyword'] = '';
       }
        $search['status'] = '';
        if (isset($param['status'])) {
            $search['status'] = $param['status'];
        }
        if (isset($param['group_id'])) {
            $search['group_id'] = $param['group_id'];
        }
        if (isset($param['type'])) {
            $search['type'] = $param['type'];
        }
        if (isset($param['keyword'])) {
            $search['keyword'] = $param['keyword'];
        }
        if (isset($param['data_start'])) {
            $search['data_start'] = $param['data_start'];
        }
        if (isset($param['data_end'])) {
            $search['data_end'] = $param['data_end'];
        }

       
        if ($search['keyword']) {
            $keyword = "'%" . $search['keyword'] . "%'";
            if ($search['type'] == 1) {
                $where .= " and r.id = " . "{$search['keyword']}";
            } elseif ($search['type'] == 2) {
                $where .= " and u.mobile like " . $keyword;
            }  
        }
       // var_dump($where);die;

        if (!empty($search['status'])) {
            $where .= " and r.status =" . $search['status'];
        }
        // if (!empty($search['group_id'])) {
        //     $where .= " and `group_id` =" . $search['group_id'];
        // }
        if (!empty($search['data_start'])) {
            $where .= " and r.createtime >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and r.createtime <= '" . strtotime($search['data_end']) . "'";
        }
        
        
        $list = Db::table('me_withdrawal')
                ->alias('r')
                ->join('me_users u', 'r.user_id = u.id')
                ->join('me_binding_bank b', 'r.bank_id = b.id')
               
                ->field('r.*,u.mobile,b.name,b.number,b.opening_bank,b.bank_card,b.phone')
                ->where($where)
                ->where("type = 3 || type = 4")
                ->order('createtime desc')
                ->paginate(20, false, ['query' => $search]);

      
        // 获取分页显示
        $page = $list->render();
      
        // $roleList = AuthGroupModel::where($whereGroup)->column('name', 'id');
        // 模板变量赋值
        $this->assign('list', $list);
      //  $this->assign('role_list', $roleList);
        $this->assign('page', $page);
        return $this->fetch();
    }
    
    /**
      * 提现审核
      */ 
    public function sellout_editStatus()
    {   
        if(!$this->request->isAjax()){
            $this->error("操作太频繁，请稍后操作!");
        }
        
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $type = $this->request->param('type');
            $ids = explode(",", $ids);
        }
         if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
            $type = $this->request->param('type');
        }
       
         
        foreach($ids as $v){
            if($type == 2){
                $withdrawalData = Db::table('me_withdrawal')->where('id',$v)->find();
               Db::table('me_withdrawal')->where('id',$v)->update(['status' => $type,'disposetime'=>time()]); 
                //加入日志
                 $log['user_id'] = $withdrawalData['user_id'];
                 $log['content'] = "卖出基金".$withdrawalData['money']."￥".'审核通过';
                 $log['createtime'] = time();
                 Db::table('me_log')->insert($log);
               
            }elseif($type == 3){
                $withdrawalData = Db::table('me_withdrawal')->where('id',$v)->find();
                
                $userData = Db::table('me_order')->where('id',$withdrawalData['o_id'])->find();
                $res = Db::table('me_order')->where('id',$userData['id'])->update(['money'=>$userData['money'] + $withdrawalData['money']]);
                if($res){
                    //加入日志
                     $log['user_id'] = $userData['user_id'];
                     $log['content'] = "卖出基金".$withdrawalData['money']."￥".'审核驳回！';
                     $log['createtime'] = time();
                     Db::table('me_log')->insert($log);
                }
                Db::table('me_withdrawal')->where('id',$v)->update(['status' => $type,'disposetime'=>time()]);
            }
            
        }
         return apiRule(true, '审核成功');
    }
    
    
     /**
      * 基金卖出审核
      */ 
    public function deposit_editStatus()
    {   
        if(!$this->request->isAjax()){
            $this->error("操作太频繁，请稍后操作!");
        }
        
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $type = $this->request->param('type');
            $ids = explode(",", $ids);
        }
         if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
            $type = $this->request->param('type');
        }
       
         
        foreach($ids as $v){
            if($type == 2){
                $withdrawalData = Db::table('me_withdrawal')->where('id',$v)->find();
               Db::table('me_withdrawal')->where('id',$v)->update(['status' => $type,'disposetime'=>time()]); 
                //加入日志
                 $log['user_id'] = $withdrawalData['user_id'];
                 $log['content'] = "提现".$withdrawalData['money']."￥".'审核通过';
                 $log['createtime'] = time();
                 Db::table('me_log')->insert($log);
               
            }elseif($type == 3){
                $withdrawalData = Db::table('me_withdrawal')->where('id',$v)->find();
                $userData = Db::table('me_users')->where('id',$withdrawalData['user_id'])->find();
                $res = Db::table('me_users')->where('id',$userData['id'])->update(['money'=>$userData['money'] + $withdrawalData['money']]);
                if($res){
                    //加入日志
                     $log['user_id'] = $userData['id'];
                     $log['content'] = "提现".$withdrawalData['money']."￥".'审核驳回！';
                     $log['createtime'] = time();
                     Db::table('me_log')->insert($log);
                }
                Db::table('me_withdrawal')->where('id',$v)->update(['status' => $type,'disposetime'=>time()]);
            }
            
        }
         return apiRule(true, '审核成功');
    }
    
    

}
