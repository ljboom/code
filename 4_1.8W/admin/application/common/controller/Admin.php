<?php
// +----------------------------------------------------------------------
// | MEAdmin [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2020 http://www.meetes.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 扯文艺的猿 <meetes@163.com>
// +----------------------------------------------------------------------

namespace app\common\controller;

use app\admin\model\AdminUser as UserModel;
use app\admin\model\AdminLog as LogModel;
use app\admin\model\AuthRule as AuthRuleModel;
use app\admin\model\AuthGroup as AuthGroupModel;
use util\Tree;
/**
 * 后台公共控制器
 * @package app\common\controller
 */
class Admin extends Common
{
    /**
     * 获取当前访问URL的模块名称
     * @return string
     */
    private $module = null;

    /**
     * 获取当前访问URL的控制器名称
     * @return string
     */
    private $controller = null;

    /**
     * 获取当前访问URL的方法名称
     * @return string
     */
    private $action = null;
    
    /**
     * 无需登录的方法,同时也就不需要鉴权了
     * @var array
     */
    protected $noNeedLogin = [];

    /**
     * 无需鉴权的方法,但需要登录
     * @var array
     */
    protected $noNeedAuth = [];

    public function initialize()
    {
        parent::initialize();
        
        $this->module = request()->module();
        $this->controller = request()->controller();
        $this->action = request()->action();

        // 登录验证
        if (in_array($this->action, $this->noNeedLogin)) {
            return true; //不判断
        } else {
            // 判断登陆
            $login = (new UserModel)->isLogin();
            if (!$login['uid']) {
                return $this->error('请登陆之后在操作！', url('admin/login/index'));
            }
            // 定义常量
            defined("ADMIN_UID") or define("ADMIN_UID", session('admin_user_auth.uid'));
            defined("ADMIN_GID") or define("ADMIN_GID", session('admin_user_auth.group_id'));
            defined("ADMIN_NAME") or define("ADMIN_NAME", session('admin_user_auth.username'));
            $userInfo = UserModel::field('nickname,avatar,group_id')->get(ADMIN_UID, true);

            // 获取菜单/判断用户组是否禁用。
            $menus = $this->userMenu($userInfo['group_id']);
            if (!$menus) {
                session(null);
                return $this->error('禁止访问，用户所在角色未启用或禁止访问后台!', url('admin/login/index'));
            }
            
            // 权限节点验证
            if (in_array($this->action, $this->noNeedAuth)) {
                return true; //不判断
            } else {
                // 判断控制器和方法判断是否有对应权限
                if( !$this->checkAuth($userInfo['group_id']) ){
                    return $this->error('访问权限不足！');
                }
            }
            
            $this->assign('node', $this->module . '/' . $this->controller . '/' . $this->action);
            $this->assign('user_info', $userInfo);
            $this->assign('menus', $menus);
        }        
        
    }

    /**
     * 验证用户访问权限
     * 1、 如果是超级管理员，则下面的直接跳过。全部都可以操作
     * 2、 利用用户group_id获取到用户组表rules
     * 3、 利用module/controller/action和获取规则表的id
     * 4、 利用第二步获取到的id，是否在rules中出现过。如果在rules中，那么就可以访问，不然就不能访问。
     * @param int $role_id 角色组id
     * @return boolean
     */
    private function checkAuth($role_id=0)
    {
        if ($this->action == '') {
            $node = $this->module . '/' . $this->controller;
        } else {
            $node = $this->module . '/' . $this->controller . '/' . $this->action;
        }

        // 超级管理员直接返回true
        if (ADMIN_GID == '1' || $role_id == '1') {
            return true;
        }

        $authRuleId = AuthRuleModel::where('name',$node)->value('id');
        if(!$authRuleId){
            return false;
        }
        $rules = AuthGroupModel::where([ 'id'=> $role_id ])->value('rules');
        $rulesArr = explode(',',$rules);
        if( !in_array($authRuleId,$rulesArr) ){
            return false;
        }
        return true;
    }

    /**
     * 获取当前用户菜单/同时验证当前会员组是否禁用
     * 1、 如果是超级管理员，获取全部菜单
     * 2、 利用用户group_id获取到用户组表rules
     * 3、 利用rules的权限ID获取规则表
     * 4、 遍历菜单，整理格式并输出。
     * @param   int $role_id 角色组id
     * @return  boolean|array 整理过的菜单数据
     */
    private function userMenu($role_id=0)
    {
        // 超级管理员直接返回true
        if (ADMIN_GID == '1' || $role_id == '1') {
            // $authRuleList = AuthRuleModel::where('level', '<=',2)->all(null, true)->toArray();
            $authRuleList = AuthRuleModel::where('level', '<=',2)->all(null)->toArray();
        }else{
            $rules = AuthGroupModel::where(['id' => $role_id,'status'=>1])->value('rules');
            if(!$rules) return false;
            $authRuleList = AuthRuleModel::where('level', '<=', 2)->order(['sort asc', 'id asc'])->all($rules, true)->toArray();
        }
        $menus = Tree::toLayer($authRuleList);
        return $menus;
    }

    /**
     * 系统日志记录
     * @param string [$remark] 日志描述
     */
    public static function recordLog($remark="")
    {
        $module = request()->module();
        $controller = request()->controller();
        $node = $module . '/' . $controller . '/index';
        $authRuleTitle = AuthRuleModel::where('name', $node)->value('title');

        $admin_user = session('admin_user_auth');
        
        // 系统日志记录
        $log                = [];
        $log['uid']         = $admin_user['uid'];
        $log['username']    = $admin_user['username'];
        $log['title']       = $authRuleTitle;
        $log['url']         = request()->url();
        $log['remark']      = $remark ? $remark : '浏览数据';
        $log['ip']          = request()->ip();
        LogModel::create($log);
    }


}
