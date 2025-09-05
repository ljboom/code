<?php

namespace app\api\model;

use think\Model;

/**
 * 基金
 */
class Fund extends Model
{

    // 表名,不含前缀
    protected $name = 'fund';
    // 追加属性
    protected $append = [
        'fund_code','fund_type_text','risk_level_text'   
    ];
    //创建时间
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    const TYPE_PUBLIC = 1;//公募基金
    const TYPE_PRIVATE = 2;//私募基金
    
    protected function getFundCodeAttr($value, $data)
    {
        return str_pad($value, 6, "0", STR_PAD_LEFT);
    }
    protected function getRiskLevelTextAttr($value, $data)
    {
        $text = '';
        switch($data['risk_level']){
            case 'L':
                $text =  '低风险';
                break;
            case 'M':
                $text =  '中高风险';
                break;
            case 'H':
                $text =  '高风险';
                break;
        }
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
