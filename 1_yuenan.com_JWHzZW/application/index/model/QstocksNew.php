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
// | 新股model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\Db;

class QstocksNew extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qstocks_new';
    // protected $is_show = ['is_show' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}