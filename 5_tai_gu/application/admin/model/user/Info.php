<?php

namespace app\admin\model\user;

use think\Model;


class Info extends Model
{

    

    

    // 表名
    protected $name = 'user_info';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'login_data_text',
        'trans_data_text',
        'liangrong_data_text',
        'peizi_data_text'
    ];
    

    
    public function getLoginDataList()
    {
        return ['0' => __('Login_data 0'), '1' => __('Login_data 1')];
    }

    public function getTransDataList()
    {
        return ['0' => __('Trans_data 0'), '1' => __('Trans_data 1')];
    }

    public function getLiangrongDataList()
    {
        return ['0' => __('Liangrong_data 0'), '1' => __('Liangrong_data 1')];
    }

    public function getPeiziDataList()
    {
        return ['0' => __('Peizi_data 0'), '1' => __('Peizi_data 1')];
    }


    public function getLoginDataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['login_data']) ? $data['login_data'] : '');
        $list = $this->getLoginDataList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getTransDataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['trans_data']) ? $data['trans_data'] : '');
        $list = $this->getTransDataList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getLiangrongDataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['liangrong_data']) ? $data['liangrong_data'] : '');
        $list = $this->getLiangrongDataList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getPeiziDataTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['peizi_data']) ? $data['peizi_data'] : '');
        $list = $this->getPeiziDataList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function user()
    {
        return $this->belongsTo('app\admin\model\User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
