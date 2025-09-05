<?php
namespace app\admin\controller;

use app\admin\model\AdminUser as UserModel;
use app\admin\model\AdminConfig as ConfigModel;
use app\common\controller\Admin as AdminController;
use think\Controller;

/**
 * 后台用户登录管理
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
    protected function initialize()
    {
        // 获取系统信息
        $systemConfigInfo = ConfigModel::field('id,name,value')->select()->toArray();
        $this->systemConfigInfo = array_column($systemConfigInfo,'value','name');

        $this->assign('system_config_info', $this->systemConfigInfo);
    }
    
    /**
     * 后台用户登录
     */
    public  function index(){
        $UserModel = new UserModel;
        $system_config_info = $this->systemConfigInfo;

        if ($this->request->isPost()) {
            $data = $this->request->post();
            // 验证数据
            $result = $this->validate($data, 'User.login');
            if (true !== $result) {
                // 验证失败 输出错误信息
                apiRule(false, $result);
            }

            // // 验证码
            if ($system_config_info['captcha_signin']==1) {
                $captcha = $this->request->post('captcha', '');
                $captcha == '' && apiRule(false,'请输入验证码');
                if (!captcha_check($captcha, '')) {
                    //验证失败
                    apiRule(false,'验证码错误或失效');
                };
            }

            // 登录
            $uid = $UserModel->login($data['username'], $data['password']);

            return apiRule(true, '登录成功',$uid,200, url('@admin'));
        }else {
            // 判断是否登录着
            if ($UserModel->isLogin()) {
                $this->redirect(url('@admin'));
            }
            return $this->fetch();
        }
        
       

    }
  

    /**
     * 退出登录
     */
    public function logout(){
        session(null);
        $this->redirect('@admin/login/index');
    }
}


