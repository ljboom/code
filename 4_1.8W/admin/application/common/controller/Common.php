<?php
// +----------------------------------------------------------------------
// | MEAdmin [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2020 http://www.meetes.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 扯文艺的猿 <meetes@163.com>
// +----------------------------------------------------------------------

namespace app\common\controller;

use think\Controller;
use think\facade\Request;
use app\admin\model\AdminConfig as ConfigModel;

/**
 * 框架公共控制器
 * @package app\common\controller
 */
class Common extends Controller
{
    protected function initialize()
    {
        // 初始化配置信息行为
        self::initConfig();
    }

    /**
     * 初始化配置信息行为
     * 将系统配置信息合并到本地配置
     */
    public static function initConfig(){
        $system_config = cache('system_config');
        if(!$system_config){
            $system_config = ConfigModel::column('value' , 'name');
            cache('system_config',$system_config);
        }

        // 设置配置信息
        config($system_config, 'app');
    }
  

}
