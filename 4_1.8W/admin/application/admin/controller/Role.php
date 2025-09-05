<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AuthRule as AuthRuleModel;
use app\admin\model\AdminMenu as AdminMenuModel;
use app\admin\model\AdminUser as UserModel;

use util\Tree;

/**
 * 系统角色控制器
 * @package app\admin\controller
 */
class Role extends Admin
{
    
    /**
     * 显示资源首页
     */
    public function index()
    {
        $list = AuthGroupModel::select()->toArray();
        Tree::config(['title'=>'name']);
        if(ADMIN_GID!=1){
            $pid = ADMIN_GID;
        }else{
            $pid=0;
        }
        $lists = Tree::toList($list, $pid);
        $this->assign('list', $lists);
        return $this->fetch();
    }

    /**
     * 角色管理-添加
     */
    public function add()
    {
        // 添加角色
        if ( $this->request->isPost() ) {
            $request = $this->request->param();

            // 验证
            $result = $this->validate($request, 'Role');
            // 验证失败 输出错误信息
            if (true !== $result) apiRule(false, $result);

            // 添加数据
            if ($role = AuthGroupModel::create($request)) {
                // 记录行为
                Admin::recordLog('新增');
                return apiRule(true, '新增成功', '', '', url('index'));
            } else {
                return apiRule(false, '新增失败');
            }
        }
        // 非管理员所能展示的授权组
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::where('id', ADMIN_GID)->value('rules');
            $where = "id IN ({$groupId})";
        }else{
            $where = 1;
        }

        $authGroup  = AuthGroupModel::getTreeToList();
        $groupList   = AuthRuleModel::where('pid=0 and '.$where)->order(['sort asc','id asc'])->column('id,title');
        $ruleList   = AuthRuleModel::where($where)->order(['sort asc','id asc'])->all(null)->toArray();

        // 对节点进行分组
        $ruleGroup = [];
        foreach ($groupList as $key => $value) {
            $temp = AuthRuleModel::get($key);
            $ruleGroup[$key] = Tree::getChilds($ruleList, $key);
            array_unshift($ruleGroup[$key], $temp);
        }

        // 层级化每个分组的菜单
        $roleRule = [];
        foreach ($ruleGroup as $key => $rule) {
            $menu = Tree::toLayer($rule);
            $roleRule[$key] = $this->buildJsTree($menu);
        }

        $this->assign('auth_group', $authGroup);
        $this->assign('group_list', $groupList);
        $this->assign('role_rule', $roleRule);
        return $this->fetch();
    }

    /**
     * 角色管理-修改
     */
    public function edit()
    {
        $id = input('param.id');
        if ($id === null) $this->error('缺少参数');
        if ($id == 1) $this->error('超级管理员不可修改');
        // 非超级管理员检查可编辑用户
        if (!AuthGroupModel::verifyAuthGroup($id)) {
            $this->error('权限不足，没有可操作的用户');
        }

        // 修改角色
        if ($this->request->isPost()) {
            $request = $this->request->param();

            // 验证
            $result = $this->validate($request, 'Role');
            // 验证失败 输出错误信息
            if (true !== $result) apiRule(false, $result);

            if ($request['id'] == 1) {
                return apiRule(false, '超级管理员组无法修改！');
            }

            // 无法放在自己同级下面
            if($request['pid']== $request['id']){
                return apiRule(false, '所属角色无法调整成自己！');
            }
            // 非超级管理需要验证可选择角色
            if (!AuthGroupModel::verifyAuthGroup($request['id'])) {
                apiRule(false, '权限不足，禁止操作非法角色的用户');
            }

            // 修改数据
            if ($role = AuthGroupModel::update($request)) {
                // 记录行为
                Admin::recordLog('修改');
                return apiRule(true, '修改成功', '', '', url('index'));
            } else {
                return apiRule(false, '修改失败');
            }
        }
        $info = AuthGroupModel::get($id);
        if(!$info) $this->error('操作错误');
        $info['rules'] = explode(',',$info['rules']);

        // 非管理员所能展示的授权组
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::where('id', ADMIN_GID)->value('rules');
            $where = "id IN ({$groupId})";
        } else {
            $where = 1;
        }

        $authGroup  = AuthGroupModel::getTreeToList();
        $groupList   = AuthRuleModel::where('pid=0 and ' . $where)->order(['sort asc', 'id asc'])->column('id,title');
        $ruleList   = AuthRuleModel::where($where)->order(['sort asc', 'id asc'])->select()->toArray();

        // 对节点进行分组
        $ruleGroup = [];
        foreach ($groupList as $key => $value) {
            $temp = AuthRuleModel::get($key);
            $ruleGroup[$key] = Tree::getChilds($ruleList, $key);
            array_unshift($ruleGroup[$key], $temp);
        }

        // 层级化每个分组的菜单
        foreach ($ruleGroup as $key => $rule) {
            $menu = Tree::toLayer($rule);
            $roleRule[$key] = $this->buildJsTree($menu, $info);
        }

        $this->assign('auth_group', $authGroup);
        $this->assign('group_list', $groupList);
        $this->assign('role_rule', $roleRule);
        $this->assign('info', $info);

        return $this->fetch();
    }

    /**
     * 角色管理-删除
     * @param string $ids 角色id
     */
    public function delete()
    {
        if (!$this->request->isAjax()) {
            $this->error("操作太频繁，请稍后操作!");
        }
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $ids = explode(",", $ids);
        }
        if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
        }
        if (empty($ids)) {
            return apiRule(false, '缺少主键');
        }
        if (in_array(1, $ids)) {
            return apiRule(false, '超级管理员组无法删除！');
        }
        // 非管理员所能操作的角色
        if (!AuthGroupModel::verifyAuthGroup($ids)) {
            apiRule(false, '权限不足，禁止操作非法角色的用户');
        }
        
        // ======= 验证要删除的会员组中是否存在子组别
        // 查出所有数据
        $list = AuthGroupModel::all();
        $ids = is_array($ids) ? $ids : explode(",", $ids);

        // 利用父级遍历是否有子级（不包括）。有的话直接跳出
        foreach ($ids as $v) {
            $treeCid = Tree::getChildsId($list, $v);
            // 数组比较，查出交集，然后在和子级比较是否一致
            if(!empty($treeCid) && $treeCid != array_values(array_intersect($ids,$treeCid))){
                return apiRule(false, '该分组下有子分组，请先删除子分组！');
            break;
            }
        }

        // ======= 验证当前要删除的会员组中是否存在会员
        $userId = UserModel::field('group_id')->group('group_id')->select();
        $groupList = is_array($ids) ? $ids : explode(",",$ids);
        $uidArr = [];
        foreach ($userId as $v) {
            $uidArr[] = $v['group_id'];
        }
        if (!empty(array_intersect($uidArr, $groupList))) {
            return apiRule(false, '该会员组中有会员存在，请先删除会员！');
        }

        Admin::recordLog("删除");
        if (AuthGroupModel::destroy($ids)) {
            return apiRule(true, '删除成功');
        } else {
            return apiRule(false, '删除失败');
        }
    }


    /**
     * 角色管理-更改状态
     * @param string $ids 角色id
     */
    public function editStatus()
    {
        if (!$this->request->isAjax()) {
            $this->error("操作太频繁，请稍后操作!");
        }
 
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $type = $this->request->param('type');
            if ($ids == 1) apiRule(false, '超级管理员无法修改！');
        }
        if (empty($ids) || empty($type)) {
            return apiRule(false, '缺少主键');
        }
        // 非管理员所能操作的角色
        if (!AuthGroupModel::verifyAuthGroup($ids)) {
            apiRule(false, '权限不足，禁止操作非法角色的用户');
        }

        $type = $type == 1 ? 1 : 2;

        Admin::recordLog("修改");
        if (AuthGroupModel::where('id', 'in', $ids)->update(['status' => $type])) {
            return apiRule(true, '修改成功');
        } else {
            return apiRule(false, '修改失败');
        }
    }



    /**
     * 构建jstree代码
     * @param array $menus 菜单节点
     * @param array $user 用户信息
     * @author 蔡伟明 <314013107@qq.com>
     * @return string
     */
    private function buildJsTree($menus = [], $user = [])
    {
        $result = '';
        if (!empty($menus)) {
            $option = [
                'opened'   => true,
                'selected' => false,
                'icon'     => '',
            ];
            foreach ($menus as $menu) {
                $option['icon'] = $menu['icon'];
                if (isset($user['rules'])) {
                    $option['selected'] = in_array($menu['id'], $user['rules']) ? true : false;
                }
                if (isset($menu['child'])) {
                    $result .= '<li id="' . $menu['id'] . '" data-jstree=\'' . json_encode($option) . '\'>' . $menu['title'] . ($menu['name'] == '' ? '' : ' (' . $menu['name'] . ')') . $this->buildJsTree($menu['child'], $user) . '</li>';
                } else {
                    $result .= '<li id="' . $menu['id'] . '" data-jstree=\'' . json_encode($option) . '\'>' . $menu['title'] . ($menu['name'] == '' ? '' : ' (' . $menu['name'] . ')') . '</li>';
                }
            }
        }

        return '<ul>' . $result . '</ul>';
    }



}
