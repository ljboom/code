<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use app\admin\model\AuthRule as AuthRuleModel;
use app\admin\model\AuthGroup as AuthGroupModel;
use think\Controller;
use util\Tree;

/**
 * 系统权限控制器
 * @package app\admin\controller
 */
class AuthRule extends Admin
{
    /**
     * 显示资源首页
     */
    public function index()
    {
        $list = AuthRuleModel::order(['sort asc', 'id asc'])->select()->toArray();
        $lists = Tree::toList($list);
        $this->assign('list', $lists);
        return $this->fetch();
    }


    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $request = $this->request->param();
            // 验证数据
            $result = $this->validate($request, 'AuthRule');
            if (true !== $result) {
                // 验证失败 输出错误信息
                apiRule(false, $result);
            }
            if( $request['pid']==0 ){
                $request['level'] = 1;
            }else{
                $request['level'] = AuthRuleModel::where('id',$request['pid'])->value('level')+1;
            }

            if (AuthRuleModel::create($request, true)) {
                Admin::recordLog("添加");
                return apiRule(true, '添加成功', '', '', url('index'));
            } else {
                return apiRule(false, '添加失败');
            }
        }
        $id = input('param.id') ? input('param.id') : 0;
        $ruleList = AuthRuleModel::getTreeToList();
        $this->assign('pid', $id);
        $this->assign('rule_list', $ruleList);
        return $this->fetch();
    }

    /**
     * 修改
     */
    public function edit()
    {
        // 验证 非超级管理员检查可编辑用户

        $AuthRuleModel = new AuthRuleModel;
        if ($this->request->isPost()) {
            $data = $this->request->post();
            // 验证数据
            $result = $this->validate($data, 'AuthRule');
            if (true !== $result) {
                // 验证失败 输出错误信息
                apiRule(false, $result);
            }
            if( $data['pid']==0 ){
                $data['level'] = 1;
            }else{
                $data['level'] = AuthRuleModel::where('id',$data['pid'])->value('level')+1;
            }

            if (AuthRuleModel::update($data, [],true)) {
                Admin::recordLog("修改");
                return apiRule(true, '修改成功', '', '', url('index'));
            } else {
                return apiRule(false, '修改失败');
            }
        }
        $id = $this->request->param('id');
        $info = AuthRuleModel::get($id);
        $ruleList = $AuthRuleModel->getTreeToList();

        $this->assign('rule_list', $ruleList);
        $this->assign('info', $info);
        return $this->fetch();
    }

    /**
     * 删除
     * @param string $ids id
     */
    public function delete()
    {
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
        }
        if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
        }
        if (empty($ids)) {
            return apiRule(false, '缺少主键');
        }

        // ===== 利用递归，把数据整合成字符串，然后在用destroy删除
        // 查出所有数据
        $list = AuthRuleModel::all();

        // 将父级id与递归出来的子级id进行合并
        $ids = is_array($ids) ? $ids : explode(",", $ids);
        $idArr = $ids;
        foreach ($ids as $v) {
            $treeCid = Tree::getChildsId($list, $v);
            $idArr = array_merge($idArr, $treeCid);
        }

        if (AuthRuleModel::destroy($idArr)) {
            Admin::recordLog("删除");
            return apiRule(true, '删除成功');
        } else {
            return apiRule(false, '删除失败');
        }
    }

    /**
     * 更改状态
     * @param string $ids id
     */
    public function editStatus()
    {
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $type = $this->request->param('type');
        }
        if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
            $type = $this->request->param('type');
        }
        if (empty($ids) || empty($type)) {
            return apiRule(false, '缺少主键');
        }
        $type = $type == 1 ? 1 : 2;
        if (AuthRuleModel::where('id', 'in', $ids)->update(['status' => $type])) {
            Admin::recordLog("修改");
            return apiRule(true, '修改成功');
        } else {
            return apiRule(false, '修改失败');
        }
    }


    /**
     * 更改排序
     * @param string $ids id
     */
    public function editSort()
    {
        if ($this->request->isPost()) {
            $ids = $this->request->post('idsort');
            $sort = $this->request->post('sort');
        }
        if (empty($ids) || empty($sort)) {  
            return apiRule(false, '缺少主键');
        }
        $countid = count($ids);

        $list = [];
        for($i=0;$i< $countid;$i++){
            $list[$i]['id'] = $ids[$i];
            $list[$i]['sort'] = $sort[$i];
        }
        $AuthRuleModel = new AuthRuleModel;
        $AuthRuleModel->saveAll($list);
        Admin::recordLog("修改");
        return apiRule(true, '操作成功');
    }


}
