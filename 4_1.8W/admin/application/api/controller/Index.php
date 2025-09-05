<?php

namespace app\api\controller;

use app\api\exception\Exception;


class Index extends Base
{
    //无需登录的方法,同时也就不需要鉴权了
    protected $noNeedLogin = ['config'];
    //无需鉴权的方法,但需要登录
    protected $noNeedRight = ['*'];

    //配置文件
    public function config(){
        $params = $this->request->post();
        
        if(empty($params)) $this->error("参数不存在");
        $config = \app\admin\model\AdminConfig::get(['name' => $params['name']]);

        $this->success("获取成功", $config);
    }
}