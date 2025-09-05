<?php

namespace app\api\model;

use think\Model;

/**
 * 基金历史数据
 */
class FundHistory extends Model
{

    // 表名,不含前缀
    protected $name = 'fund_history';
    // 追加属性
    protected $append = [
        'fund_code'
    ];
    //创建时间
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    protected function getFundCodeAttr($value, $data)
    {
        return str_pad($value, 6, "0", STR_PAD_LEFT);
    }
    
}
