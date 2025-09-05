<?php

namespace app\api\model;

use think\Model;

/**
 * 订单
 */
class Order extends Model
{

    // 表名,不含前缀
    protected $name = 'order';
    protected $autoWriteTimestamp = 'int';
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [];
    
    
    public function fund(){
         return $this->belongsTo(\app\api\model\Fund::class, 'code', 'fund_code');
    }
}
