<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use app\admin\model\AdminUser as UserModel;
use app\admin\model\AdminAttachment as AttachmentModel;
use app\admin\model\AuthRule as AuthRuleModel;
use think\helper\Hash;
use think\facade\Cache;
use think\Db;
/**
 * 后台默认首页控制器
 * @package app\admin\controller
 */
class Index extends Admin
{

    /**
     * 后台首页
     * @return string
     */
    public function index()
    {
        // 获取系统信息
        $systemInfo = getSystemInfo();
        // 获取产品信息
        $productInfo = config('meadmin.');

        $this->assign('system_info',$systemInfo);
        $this->assign('product_info',$productInfo);
        
        $list = Db::table('me_log')->where("user_id",0)->order('createtime desc')->paginate(9, false);
       

        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch();
    }

    /**
     * 清理缓存
     * @return string
     */
    public function clear()
    {
        Cache::clear();
        return apiRule(true, '缓存清理成功！');
    }

    /**
     * 个人信息
     * @return string
     */
    public function personal()
    {
        $user = UserModel::where('uid', ADMIN_UID)->find();

        if ( $this->request->isPost() ) {
            $data = $this->request->post();
            $nickname = $data['nickname'] ? $data['nickname'] : apiRule(false, '昵称不能为空');
            $avatar = $data['avatar'] ? $data['avatar'] : apiRule(false, '头像不能为空');

            // 匹配是否修改过头像
            if (preg_match("/^[0-9]+$/", $avatar)) {
                // 查询获取头像路径
                $avatar = AttachmentModel::where('id', $avatar)->value('path');
            } else {
                // 没有修改头像
                $avatar = $data['avatar'];
            }

            $data['uid'] = ADMIN_UID;
            $data['nickname'] = $nickname;
            $data['avatar'] = $avatar;
            $user = UserModel::update($data);
            if ($user) {
                return apiRule(true, '更新成功');
            }else{
                return apiRule(false, '更新失败');
            }
        } else {
            $this->assign('user', $user);
            return $this->fetch();
        }
    }


    /**
     * 安全设置
     * @return string
     */
    public function password()
    {
        $user = UserModel::where('uid', ADMIN_UID)->find();

        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();

            // 验证数据
            $result = $this->validate($data, 'User.password');
            if (true !== $result) {
                // 验证失败 输出错误信息
                apiRule(false, $result);
            }

            // 验证数据，验证旧密码是否正确；
            if (!Hash::check((string) $data['oldpassword'], $user['password'])) {
                apiRule(false, '原密码错误，请重新输入!');
            }

            // 修改密码
            $map = [];
            $map['password'] = $data['repassword'];
            $map['uid'] = $user['uid'];
            if(!UserModel::update($map)){
                apiRule(false, '操作失败');
            }
            apiRule(true, '操作成功', null,0,url('@admin'));
        }
        
        return $this->fetch();
    }



    /**
     * 菜单搜索
     */
    public function search()
    {
        $search = input('get.top-search');
        if( isset($search) && !empty($search) ){
            $where[] = ['title','like', "%{$search}%"];
            $where[] = ['type','=', 2];
            $url = AuthRuleModel::where($where)->value('name');
            $this->redirect( url($url) );
        }
        $this->error("操作失败");
    }
    
}
