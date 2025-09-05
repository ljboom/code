<?php
// +----------------------------------------------------------------------
// | 系统用户模型类
// +----------------------------------------------------------------------

namespace app\admin\model;

use think\Model;
//use think\helper\Hash;
use think\model\concern\SoftDelete;
use app\admin\model\AuthGroup as AuthGroupModel;

class AdminUser extends Model
{
    //设置主键
    protected $pk = 'uid';
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
    // 软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    // 对密码进行加密
    public function setPasswordAttr($value)
    {
        return md5((string) $value);
    }


    /**
     * 用户登录
     * @param string $username 用户名
     * @param string $password 密码
     * @return bool|mixed
     */
    public function login($username = '', $password = '')
    {
        $username = trim($username);
        $password = trim($password);

        // 匹配登录方式
        if (preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $username)) {
            // 邮箱登录
            $map['email'] = $username;
        }else{
            // 用户名登录
            $map['username'] = $username;
        }
        
        // 查找用户
        $user = self::where($map)->find();

        // 检查是否可登录后台        
        if (!$user) {
            apiRule(false, '登录账号或密码错误，请重新输入!');
        } else {
            if (!md5((string) $password, $user['password'])) {
                apiRule(false,'登录账号或密码错误，请重新输入!');
            }
            if ($user['status']!=1) {
                apiRule(false, '账号已经被禁用，请联系管理员!');
            }
            // 检查是否分配用户组
            if ($user['group_id'] == 0) {
                apiRule(false, '禁止访问，原因：未分配角色!');
            }
            // 检查是可登录后台
            if (!AuthGroupModel::where(['id' => $user['group_id'], 'status' => 1])->value('name')) {
                apiRule(false, '禁止访问，用户所在角色未启用或禁止访问后台!');
            }

            $uid = $user['uid'];

            // 更新登录信息
            $user['last_login_time'] = request()->time();
            $user['last_login_ip'] = request()->ip();
            $user['login_num'] += 1 ;
            if ($user->save()) {
                // 自动登录
                return $this->autoLogin(self::get($uid));
            } else {
                // 更新登录信息失败
                apiRule(false, '登录信息更新失败，请重新登录！!');
            }
        }
        
    }


    /**
     * 记录登录信息
     * @param object $user 用户对象
     * @return bool|int
     */
    public function autoLogin($user)
    {
        // 记录登录SESSION和COOKIES
        $auth = array(
            'uid'             => $user->uid,
            'group_id'        => $user->group_id,
            'username'        => $user->username,
            'last_login_time' => $user->last_login_time,
        );
        session('admin_user_auth', $auth);
        session('admin_user_auth_sign', $this->data_auth_sign($auth));
        return $user->uid;
    }


    /**
     * 数据签名认证
     * @param array $data 被认证的数据
     * @return string
     */
    function data_auth_sign($data = [])
    {
        // 数据类型检测
        if (!is_array($data)) {
            $data = (array) $data;
        }

        // 排序
        ksort($data);
        // url编码并生成query字符串
        $code = http_build_query($data);
        // 生成签名
        $sign = sha1($code);
        return $sign;
    }


    /**
     * 判断是否登录
     * @return bool|array
     */
    public function isLogin()
    {
        $user = session('admin_user_auth');
        if (isset($user['uid'])) {
            if (!self::where(['uid'=> $user['uid'],'status'=>1])->value('uid')) {
                return false;
            }
            return session('admin_user_auth_sign') == $this->data_auth_sign($user) ? $user : false;
        }
        return false;
    }

}
