<?php

namespace app\common\library;

use think\Config;
use think\Db;
use think\Exception;
use think\Hook;
use think\facade\Request;
use think\Validate;
use app\api\model\User;
use app\api\model\UserInfo;
use app\api\model\Bindingbank;

class Auth
{
    protected static $instance = null;
    protected $_error = '';
    protected $_logined = false;
    protected $_user = null;
    protected $_auth = false;  //认证状态
    protected $_userAuth = null;  //认证信息
    protected $_token = '';
    //Token默认有效时长
    protected $keeptime = 2592000;
    protected $requestUri = '';
    protected $rules = [];
    //默认配置
    protected $config = [];
    protected $options = [];
    protected $allowFields = ['id', 'mobile','username', 'money', 'head_avatar'];
    protected $allowUserFields = ['number', 'name'];
    
    public function __construct($options = [])
    {
        // if ($config = Config::get('user')) {
        //     $this->config = array_merge($this->config, $config);
        // }
        // $this->options = array_merge($this->config, $options);
    }

    /**
     *
     * @param array $options 参数
     * @return Auth
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }

        return self::$instance;
    }

    /**
     * 获取User模型
     * @return User
     */
    public function getUser()
    {
        return $this->_user;
    }
    
    
    /**
     * 兼容调用user模型的属性
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->_user ? $this->_user->$name : null;
    }

    /**
     * 根据Token初始化
     *
     * @param string $token Token
     * @return boolean
     */
    public function init($token)
    {
        if ($this->_logined) {
            return true;
        }
        if ($this->_error) {
            return false;
        }
        $data = Token::get($token);
        if (!$data) {
            return false;
        }
        $user_id = intval($data['user_id']);
        if ($user_id > 0) {
            $user = User::get($user_id);
            if (!$user) {
                $this->setError("账号不存在");
                return false;
            }
            if ($user['status'] != User::STATUS_NORMAL) {
                $this->setError("当前账号异常");
                return false;
            }
            $this->_user = $user;
            $this->_logined = true;
            $this->_token = $token;
            $this->_userAuth = UserInfo::get(['user_id' => $user->id]) || Bindingbank::get(['user_id' => $user->id]);
            $this->_auth = $this->_userAuth ? true : false;
            
            return true;
        } else {
            $this->setError('你还没有登录');
            return false;
        }
    }
    /**
     * 判断是否登录
     * @return boolean
     */
    public function isLogin()
    {
        if ($this->_logined) {
            return true;
        }
        return false;
    }
    
    /**
     * 判断是否认证
     * @return boolean
     */
    public function isAuth()
    {
        if ($this->_auth) {
            return true;
        }
        return false;
    }
    /**
     * 获取当前Token
     * @return string
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * 获取当前请求的URI
     * @return string
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * 设置当前请求的URI
     * @param string $uri
     */
    public function setRequestUri($uri)
    {
        $this->requestUri = $uri;
    }

    /**
     * 获取密码加密后的字符串
     * @param string $password 密码
     * @param string $salt     密码盐
     * @return string
     */
    public function getEncryptPassword($password, $salt = '')
    {
        return md5(md5($password) . $salt);
    }

    /**
     * 检测当前控制器和方法是否匹配传递的数组
     *
     * @param array $arr 需要验证权限的数组
     * @return boolean
     */
    public function match($arr = [])
    {
        $request = Request::instance();
        $arr = is_array($arr) ? $arr : explode(',', $arr);
        if (!$arr) {
            return false;
        }
        $arr = array_map('strtolower', $arr);
        // 是否存在
        if (in_array(strtolower($request->action()), $arr) || in_array('*', $arr)) {
            return true;
        }

        // 没找到匹配
        return false;
    }

    /**
     * 设置会话有效时间
     * @param int $keeptime 默认为永久
     */
    public function keeptime($keeptime = 0)
    {
        $this->keeptime = $keeptime;
    }
    /**
     * 获取允许输出的字段
     * @return array
     */
    public function getAllowFields()
    {
        return $this->allowFields;
    }
    /**
     * 获取会员基本信息
     */
    public function getUserInfo()
    {
        $data = $this->_user->toArray();
        $allowFields = $this->getAllowFields();
        $user = array_intersect_key($data, array_flip($allowFields));
        //查询token
        $token = Token::get($this->_token)->toArray();
        $user['auth_status'] = intval($this->_auth);
        //用户信息
        $user_real_info = UserInfo::get(['user_id' => $user['id']]);
        $user_bank_info = Bindingbank::get(['user_id' => $user['id']]);
        $real_info = $user_real_info ? $user_real_info->toArray() : $user_bank_info ? $user_bank_info->toArray() : [];
        if(count($real_info) > 0){
            //用户字段
            $real_info = array_intersect_key($real_info, array_flip($this->allowUserFields));
        }
        $userinfo = array_merge($token, $user, $real_info);
        return $userinfo;
    }
    /*
     *  登录 
     *
    */
    public function login($username, $password){
        $user = User::getByMobile(['mobile' => $username]);
        if (!$user) {
            $this->setError('账号不存在');
            return false;
        }
        if ($user->status != User::STATUS_NORMAL) {
            $this->setError("当前账号异常");
            return false;
        }
        if ($user->password != $this->getEncryptPassword($password, $user->salt)) {
            $this->setError("密码错误");
            return false;
        }
        //直接登录会员
        $this->direct($user->id);

        return true;
    }
    /**
     * 注册
     * @param string $username
     * @return boolean
     */
     public function register($username){
        $user = User::getByMobile(['mobile' => $username]);
        if ($user) {
            $this->setError('账号已存在');
            return false;
        }
        $userInfo = [
            'mobile' => $username,
        ];
        //账号注册时需要开启事务,避免出现垃圾数据
        Db::startTrans();
        try {
            $user = User::create($userInfo, true);

            $this->_user = User::get($user->id);

            //设置Token
            $this->_token = uuid();
            Token::set($this->_token, $user->id, $this->keeptime);

            //设置登录状态
            $this->_logined = true;

            Db::commit();
        } catch (Exception $e) {
            $this->setError($e->getMessage());
            Db::rollback();
            return false;
        }
        return true;
        
     }
      /**
     * 修改密码
     * @param string $newpassword       新密码
     * @return boolean
     */
    public function changepwd($newpassword)
    {
        //是否登录
        if(!$this->_logined){
            $this->setError("未登录");
            return false;
        }
            Db::startTrans();
            try {
                //生成盐值
                $salt = createSalt();
                //加密密码
                $newpassword = $this->getEncryptPassword($newpassword, $salt);
                //保存新密码
                $this->_user->save(['password' => $newpassword, 'salt' => $salt]);
                //删除旧token
                Token::delete($this->_token);
                //生成Token
                // $this->_token = uuid();
                // //设置Token
                // Token::set($this->_token, $this->_user->id, $this->keeptime);

                Db::commit();
            } catch (Exception $e) {
                $this->setError($e->getMessage());
                Db::rollback();
                return false;
            }
        return true;
     }
    /**
     * 修改交易密码
     * @param string $newpassword   新交易密码
     * @return boolean
     */
     public function changepay_pwd($newpay_password){
         //是否登录
        if(!$this->_logined){
            $this->setError("未登录");
            return false;
        }
            Db::startTrans();
            try {
                //加密交易密码
                $newpay_password = $this->getEncryptPassword($newpay_password);
                //保存新交易密码
                $this->_user->save(['pay_password' => $newpay_password]);

                Db::commit();
            } catch (Exception $e) {
                $this->setError($e->getMessage());
                Db::rollback();
                return false;
            }
        return true;
     }
     /**
     * 退出
     *
     * @return boolean
     */
    public function logout()
    {
        if (!$this->_logined) {
            $this->setError("已退出登录");
            return false;
        }
        //设置登录标识
        $this->_logined = false;
        //删除Token
        Token::delete($this->_token);
        return true;
    }
    /**
     * 直接登录账号
     * @param int $user_id
     * @return boolean
     */
    public function direct($user_id)
    {
        $user = User::get($user_id);
        if ($user) {
            Db::startTrans();
            try {
                $ip = request()->ip();
                $time = time();

                //记录本次登录的IP和时间
                $user->loginip = $ip;
                $user->logintime = $time;

                $user->save();

                $this->_user = $user;
                $this->_token = uuid();
                $res = Token::set($this->_token, $user->id, $this->keeptime);
                $this->_logined = true;
                
                $this->_userAuth = UserInfo::get(['user_id' => $user->id]) || Bindingbank::get(['user_id' => $user->id]);
                $this->_auth = $this->_userAuth ? true : false;
                //登录成功的事件
                Db::commit();
            } catch (Exception $e) {
                Db::rollback();
                $this->setError($e->getMessage());
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 设置错误信息
     *
     * @param $error 错误信息
     * @return Auth
     */
    public function setError($error)
    {
        $this->_error = $error;
        return $this;
    }
    
    /**
     * 获取错误信息
     * @return string
     */
    public function getError()
    {
        return $this->_error ?: '';
    }
}
