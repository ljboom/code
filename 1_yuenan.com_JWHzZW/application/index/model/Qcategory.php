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
// | 股票类model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;

class Qcategory extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qcategory';
    protected $is_show = ['is_show' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
    
    
    /**
     * 查詢股票类
     * @param type $data
     * @return boolean
     */
    public function selManager($data){
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        if ( $data['category'] == 'TAI' )  {
                $data['category'] = 'tse';
        }
        if ( $data['category'] == 'TWO' )  {
            $data['category'] = 'otc';
        }
        $info = $this->where(['category'=> $data['category']])->where($this->is_show)
            ->field('id,sectorId,name,category,is_show')
            ->select()->toArray();
        $data = code_msg(1);
        $data['data'] = $info;
        return $data;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}