<?php
// +----------------------------------------------------------------------
// | 基金模型类
// +----------------------------------------------------------------------

namespace app\admin\model;

use think\Model;

class Fund extends Model
{
    // 表名,不含前缀
    protected $name = 'fund';
    protected $autoWriteTimestamp = 'int';
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    
    const TYPE_PUBLIC = 1;//公募基金
    const TYPE_PRIVATE = 2;//私募基金
    
    protected $append = [
        'fund_type_text', 'type_text', 'fund_code'    
    ];

    protected function getFundCodeAttr($value, $data)
    {
        return str_pad($value, 6, "0", STR_PAD_LEFT);
    }
    protected function getTypeTextAttr($value, $data)
    {
        $text = '';
        if($data['type'] == 1) $text = '公募基金';
        if($data['type'] == 2) $text = '私募基金';
        return $text;
    }
    protected function getFundTypeTextAttr($value, $data)
    {
        $text = '';
        switch ($data['fund_type']) {
            case 'CURRENCY':
                $text = '货币型';
                break;
            case 'BOND':
                $text = '债券型';
                break;
            case 'INDEX':
                $text = '指数型';
                break;   
            case 'STOCK':
                $text = '股票型';
                break; 
            default:
                $text = '混合型';
                break;
        }
        return $text;
    }
}
