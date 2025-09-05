<?php
namespace app\admin\controller;
use app\common\controller\Admin;
use app\admin\model\AdminUser as UserModel;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\api\model\User as UsersModel;
use think\Db;
/**
 * 系统用户制器
 * @package app\admin\controller
 */
class Users extends Admin
{
    
    //会员列表
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
                $where .= " and `id` = " . $search['keyword'];
            } elseif ($search['type'] == 2) {
                $where .= " and `mobile` like " . $keyword;
            }  
        }
        

        if (!empty($search['status'])) {
            $where .= " and `status` =" . $search['status'];
        }
        // if (!empty($search['group_id'])) {
        //     $where .= " and `group_id` =" . $search['group_id'];
        // }
        if (!empty($search['data_start'])) {
            $where .= " and createtime >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and createtime <= '" . strtotime($search['data_end']) . "'";
        }
        $list = Db::table('me_users')->where($where)->order('createtime desc')->paginate(20, false, ['query' => $search]);
       
    //   var_dump($list);die;
        // 获取分页显示
        $page = $list->render();

        // $roleList = AuthGroupModel::where($whereGroup)->column('name', 'id');
        // 模板变量赋值
        $this->assign('list', $list);
      //  $this->assign('role_list', $roleList);
        $this->assign('page', $page);
        return $this->fetch();
    }
    
    //用户信息
    public function userData()
    {   
        //处理修改的信息
       if($this->request->isPost()){
          
          $params = input('post.');
          
          $uid = $params['uid'];
          //银行信息
          $bankData['opening_bank'] = $params['opening_bank'];
          $bankData['bank_card'] = $params['bank_card'];
          
          //实名信息
          unset($params['opening_bank']);
          unset($params['bank_card']);
          unset($params['uid']);
          $autonymData = $params;
          
          //进行更新信息
          $res1 = Db::table('me_binding_bank')->where(['user_id'=>$uid,'status'=>2])->update($bankData);
          $res2 = Db::table('me_userinfo')->where('user_id',$uid)->update($autonymData);
          
          if($res1){
              $msgbank = "银行信息修改成功！";
          }else{
              $msgbank = "银行信息未修改！";
          }
          if($res2){
              $msgautonym = "实名信息修改成功！";
          }else{
              $msgautonym = "实名信息未修改！";
          }
          
          return apiRule(true,$msgbank.",".$msgautonym);
       }
        
        
        $uid = $this->request->param('id');
        if($uid == null){
              return $this->error("操作太频繁，请稍后操作!");
        }
        
        //实名信息
        $autonymData = Db::table('me_userinfo')->where('user_id',$uid)->find();
        //银行信息
        $bankData = Db::table('me_binding_bank')->where(['user_id'=>$uid,'status'=>2])->find();
        
        if(empty($autonymData) && empty($bankData)){
             return $this->error("该用户没有信息");
        }
        $this->assign('bankData',$bankData);
        $this->assign('autonymData',$autonymData);
        $this->assign('uid',$uid);
        return $this->fetch();
    }
    //修改
    public function useredit()
    {
          if ($this->request->isPost()) {
              $params = input('post.');
              
                //校验成功 修改账号
               $salt = createSalt(); //密码盐
                $UserModel = UsersModel::get($params['id']);
               if($params['password'] != null){
                   $UserModel->password = getEncryptPassword($params['password'],$salt);
                   $UserModel->salt = $salt;
               }
               if($params['pay_password'] != null){
                    $UserModel->pay_password = getEncryptPassword($params['pay_password']);
               }
              // $UserModel->username = $params['username'];
               $UserModel->status = $params['status'];
               $UserModel->money = $params['money'];
               $res = $UserModel->save();
           if($res){
                return apiRule(true, '修改成功','','', url('users/index') );
           }
           return apiRule(false, "错误错误");
    
          } 
          
         $ids = $this->request->param('id');
          $userData = Db::table('me_users')->find($ids);
          $this->assign('userData',$userData);
          return $this->fetch();  
         
    }
    
    //添加
    public function useradd()
    {
        if ($this->request->isPost()) {
            $params = input('post.');
            
            $res = Db::table('me_users')->where('mobile',$params['mobile'])->find();
            if(!empty($res)){
                apiRule(false, "已有该账户");die;
            }
          
            //校验成功 注册账号
          $UserModel = new UsersModel;
           $salt = createSalt(); //密码盐
           $ress = $UserModel->save([
                'mobile' => $params['mobile'],
               // 'username' => $params['username'],
                'password' =>getEncryptPassword($params['password'],$salt),
                'salt' => $salt,
                'status' => $params['status'],
                'createtime' => time(),
           ]);
           if($ress){
                return apiRule(true, '添加成功','','', url('users/index') );
           }
           apiRule(false, "错误错误");die;
        }
       return $this->fetch();
    }
    
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
            Db::table('me_users')->where('id',$v)->update(['status' => $type]);
        }
         return apiRule(true, '修改成功');
    }
    
    //删除
    public function deletes()
    {
        if (!$this->request->isAjax()) {
            $this->error("操作太频繁，请稍后操作!");
        }
 
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $ids = explode(",",$ids);
        }
        if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
        }
       
         foreach($ids as $v){
            Db::table('me_users')->where('id',$v)->delete();
        }
         return apiRule(true, '删除成功');
    }
    
    /**
     * 意见反馈列表
     */ 
    public function feedback()
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
        
        
        $list = Db::table('me_feedback')
                ->alias('r')
                ->join('me_users u', 'r.user_id = u.id')
                ->field('r.*,u.mobile')
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


}
