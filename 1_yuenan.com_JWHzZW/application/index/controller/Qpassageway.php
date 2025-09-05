<?php
// +----------------------------------------------------------------------
// | Yzncms [ 御宅男工作室 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://yzncms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 御宅男 <530765310@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 通道
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Qpassageway as QpassagewayModel;
use app\common\controller\Indexbase;
use think\facade\Session;

class Qpassageway extends Indexbase
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QpassagewayModel;
    }
    
    // 查詢
    public function sel(){
        $arr = input('post.');
        $info = $this->modelClass->select()->toArray();
        if (empty($info)) {
            return code_msg(3);//沒有數據
        }
        $data = code_msg(1);
        $data['data'] = $info;
        return json_encode($data);
    }
    
    
    
}