<?php
// +----------------------------------------------------------------------
// | MEAdmin [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020-2020 http://www.meetes.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 扯文艺的猿 <meetes@163.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 后台参数配置模型类
// +----------------------------------------------------------------------

namespace app\admin\model;

use think\Db;
use think\Model;

class AdminConfig extends Model
{
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
    // 设置json类型字段
    protected $json = ['options'];
    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    /**
     * 获取系统参数的标题
     * @return bool|array
     */
    public function subTtile()
    {
        $result = self::field('group,group_name')
                ->order('group asc')
                ->distinct(true)
                ->select();

        return $result;
    }


    /**
     * 对数据进行重新分组输出
     * @return bool|array
     */
    public function list()
    {
        $data = self::order('group asc,id asc')->all()->toArray();
        $groupList = [];
        foreach ($data as $key => $value) {
            $groupList[$value['group']][]= $value;
        }
        return $groupList;
    }
}
