<?php
namespace app\admin\controller;
use app\common\controller\Admin;
use app\admin\model\AdminUser as UserModel;
use app\admin\model\AuthGroup as AuthGroupModel;

/**
 * 系统用户制器
 * @package app\admin\controller
 */
class User extends Admin
{
    
    /**
     * 显示资源首页
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

        $search['type'] = 0;
        $search['keyword'] = '';
        $search['data_start'] = '';
        $search['data_end'] = '';
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
                if($search['keyword'] == null){
                    $search['keyword'] = 0;
                }
                $where .= " and `uid` = " . $search['keyword'];
            } elseif ($search['type'] == 2) {
                $where .= " and `username` like " . $keyword;
            } elseif ($search['type'] == 3) {
                $where .= " and `nickname` like " . $keyword;
            } elseif ($search['type'] == 4) {
                $where .= " and `email` like " . $keyword;
            }
        }

        if (!empty($search['status'])) {
            $where .= " and `status` =" . $search['status'];
        }
        if (!empty($search['group_id'])) {
            $where .= " and `group_id` =" . $search['group_id'];
        }
        if (!empty($search['data_start'])) {
            $where .= " and create_time >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and create_time <= '" . strtotime($search['data_end']) . "'";
        }
        $list = UserModel::where($where)->order('uid desc')->paginate(20, false, ['query' => $search]);
        // 获取分页显示
        $page = $list->render();

        $roleList = AuthGroupModel::where($whereGroup)->column('name', 'id');
        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('role_list', $roleList);
        $this->assign('page', $page);
        return $this->fetch();
    }

    /**
     * 会员管理-添加
     */
    public function add()
    {
        if( $this->request->isPost() ) {
            $request = $this->request->param();
            // 验证数据
            $result = $this->validate($request, 'User.add');
            if (true !== $result) {
                // 验证失败 输出错误信息
                apiRule(false, $result);
            }
            // 非超级管理需要验证可选择角色
            if( !AuthGroupModel::verifyAuthGroup($request['group_id']) ) {
                apiRule(false, '权限不足，禁止操作非法角色的用户');
            }

            if ( (new UserModel)->allowField(true)->save($request) ) {
                Admin::recordLog("添加");
                return apiRule(true, '添加成功','','', url('index') );
            } else {
                return apiRule(false, '添加失败');
            }
        }
        $authGroup  = AuthGroupModel::getTreeToList();
        $this->assign('auth_group', $authGroup);
        return $this->fetch();
    }

    /**
     * 会员管理-修改
     */
    public function edit()
    {
        $id = $this->request->param('id');
        $info = UserModel::get($id);

        // 非超级管理员检查可编辑用户
        if (!AuthGroupModel::verifyAuthGroup($info['group_id'])) {
            $this->error('权限不足，没有可操作的用户');
        }

        if ( $this->request->isPost() ) {
            $data = $this->request->post();
            // 验证数据
            $result = $this->validate($data, 'User.edit');
            if (true !== $result) {
                // 验证失败 输出错误信息
                apiRule(false, $result);
            }
            if ($data['uid']==1) {
                return apiRule(false, '超级管理员无法修改！');
            }

            // 如果有密码，则需要验证密码
            if ($data['password']) {
                $result = $this->validate($data, 'User.password');
                if (true !== $result) {
                    // 验证失败 输出错误信息
                    apiRule(false, $result);
                }
            }
            // 非超级管理需要验证可选择角色
            if (!AuthGroupModel::verifyAuthGroup($data['group_id'])) {
                apiRule(false, '权限不足，禁止操作非法角色的用户');
            }

            $updateValue = ['nickname','email', 'describe', 'status','group_id'];
            if ($data['password'] ) array_push($updateValue, 'password');
            $where = [ 'uid'=>$data['uid'] ];
            if (UserModel::update($data,$where,$updateValue)) {
                Admin::recordLog("修改");
                return apiRule(true, '修改成功', '', '', url('index'));
            } else {
                return apiRule(false, '修改失败');
            }
        }
        $authGroup  = AuthGroupModel::getTreeToList();

        $this->assign('auth_group', $authGroup);
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * 会员管理-删除
     * @request ajax
     * @param string $ids 会员id
     */
    public function delete()
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
        if (empty($ids)) {
            return apiRule(false, '缺少主键');
        }
        if( in_array(1,$ids) ) {
            return apiRule(false, '超级管理员无法删除！');
        }
        // 非管理员所能操作的用户
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::getTreeGetChildsId(ADMIN_GID);
            $userList = UserModel::where('group_id', 'in', $groupId)->column('uid');
            if (!$userList) {
                return apiRule(false, '权限不足，没有可操作的用户!');
            }

            $ids = array_intersect($userList, $ids);
            if (!$ids) {
                return apiRule(false, '权限不足，没有可操作的用户');
            }
        }
        
        if (UserModel::destroy($ids)) {
            Admin::recordLog("删除");
            return apiRule(true, '删除成功');
        } else {
            return apiRule(false, '删除失败');
        }
    }

    /**
     * 会员管理-更改状态
     * @request ajax
     * @param string $ids 会员id
     */
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
        if ( empty($ids) || empty($type) ) {
            return apiRule(false, '缺少主键');
        }
        if (in_array(1, $ids)) {
            return apiRule(false, '超级管理员无法删除！');
        }
        // 非管理员所能操作的用户
        if (ADMIN_GID != 1){
            $groupId = AuthGroupModel::getTreeGetChildsId(ADMIN_GID);
            $userList = UserModel::where('group_id', 'in', $groupId)->column('uid');
            if (!$userList) {
                return apiRule(false, '权限不足，没有可操作的用户!');
            }
    
            $ids = array_intersect($userList, $ids);
            if (!$ids) {
                return apiRule(false, '权限不足，没有可操作的用户');
            }
        }

        $type = $type==1 ? 1 : 2;

        if ( UserModel::where('uid','in',$ids)->update(['status'=>$type]) ) {
            Admin::recordLog("修改");
            return apiRule(true, '修改成功');
        } else {
            return apiRule(false, '修改失败');
        }
    }


}
