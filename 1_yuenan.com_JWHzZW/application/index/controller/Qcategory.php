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
// | 股票类
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Qcategory as QcategoryModel;
use app\common\controller\Indexbase;
use think\facade\Session;

class Qcategory extends Indexbase
{

    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QcategoryModel;
    }
    
    public function sel(){
        $arr = input('post.');
        $res = $this->modelClass->selManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
        
    }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}