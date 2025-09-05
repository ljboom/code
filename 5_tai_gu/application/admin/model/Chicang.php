<?php

namespace app\admin\model;

use think\Model;


class Chicang extends Model
{

    

    

    // 表名
    protected $name = 'chicang';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'fangxiang_data_text',
        'status_text',
        'buy_type_text',
        'buytime_text',
        'selltime_text',
        'selldata_text'
    ];
    

    
    public function getFangxiangDataList()
    {
        return ['0' => __('Fangxiang_data 0'), '1' => __('Fangxiang_data 1')];
    }

    public function getStatusList()
    {
        return ['1' => __('Status 1'), '2' => __('Status 2'), '3' => __('Status 3'), '4' => __('Status 4'), '5' => __('Status 5')];
    }

    public function getBuyTypeList()
    {
        return ['0' => __('Buy_type 0'), '1' => __('Buy_type 1')];
    }

    public function getSelldataList()
    {
        return ['0' => __('Selldata 0'), '1' => __('Selldata 1')];
    }


    public function getFangxiangDataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['fangxiang_data']) ? $data['fangxiang_data'] : '');
        $list = $this->getFangxiangDataList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getBuyTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['buy_type']) ? $data['buy_type'] : '');
        $list = $this->getBuyTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getBuytimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['buytime']) ? $data['buytime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getSelltimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['selltime']) ? $data['selltime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getSelldataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['selldata']) ? $data['selldata'] : '');
        $list = $this->getSelldataList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setBuytimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setSelltimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }


    public function product()
    {
        return $this->belongsTo('Product', 'pro_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
