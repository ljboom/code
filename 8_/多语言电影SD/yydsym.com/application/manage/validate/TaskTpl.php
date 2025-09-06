<?php
namespace app\manage\validate;

use think\Validate;

class TaskTpl extends Validate
{
	protected $rule =   [
        'task_class'       => 'require|integer',
        'name'            => 'require|chsDash',
        'title'            => 'require|chsDash',
        'content'          => 'require',
        'reward_price'     => 'require|float',
        'total_number'     => 'require|integer',
        'total_price'      => 'require|float',
        //'task_type'        => 'require|integer',
        // 'link_info'        => 'require|url',
        //'link_info'        => 'url',
        'task_level'       => 'require|integer',
        'end_time'         => 'require|date',
        'task_step'        => 'array',
    ];

    protected $message  =   [
        'task_class.require'   => '请选择任务分类',
        'task_class.integer'   => '请选择任务分类',
        'name.require'        =>  '请填写模板名称',
        'name.chsDash'        =>  '模板名称仅限汉字、字母、数字和下划线_及破折号-',
        'title.require'        =>  '请填写任务标题',
        'title.chsDash'        =>  '任务标题仅限汉字、字母、数字和下划线_及破折号-',
        'content.require'      => '请填写任务内容',
        'reward_price.require' => '请填写单价',
        'reward_price.float'   => '单价仅限数字',
        'total_number.require' => '请填写数量',
        'total_number.integer' => '数量仅限整数',
        'total_price.require'  => '请填写总价',
        'total_price.float'    => '总价仅限数字',
        'task_type.require'    => '请选择任务类型',
        'task_type.task_type'  => '请选择任务类型',
        // 'link_info.require'    => '请填写任务链接',
        'link_info.url'        => '请填写有效的任务链接',
        'task_level.require'   => '请选择任务级别',
        'task_level.integer'   => '请选择任务级别',
        'end_time.require'     => '请选择截止日期',
        'end_time.date'        => '请选择有效的截止日期',
        'task_step.array'      => '任务步骤格式不正确',
    ];

    protected $scene = [
        'add' =>  ['task_class','name','title','content','reward_price','total_number','total_price','link_info','task_level','end_time','finish_condition','task_step'],
    ];
}
