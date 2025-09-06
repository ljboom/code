<?php
namespace app\manage\model;

use think\Model;

class TaskTplModel extends Model{
    //表名
	protected $table = 'ly_task_tpl';

	/**
	 * 添加任务
	 */
	public function add(){
		if (!request()->isAjax()) return '提交失败';
		$param = input('param.');
		//数据验证
		$validate = validate('app\manage\validate\TaskTpl');
		if (!$validate->scene('add')->check($param)) return $validate->getError();

		if (isset($param['finish_condition']) and $param['finish_condition']) $param['finish_condition'] 	= json_encode(array_keys($param['finish_condition']));

		if (isset($param['task_step']) and $param['task_step']) $param['task_step']               			= json_encode(array_merge($param['task_step']),true);
		if (isset($param['examine_demo']) and $param['examine_demo']) $param['examine_demo']         		= json_encode($param['examine_demo'],true);

		$param['end_time']                                         = strtotime($param['end_time']);
		$param['add_time']                                         = time();
		$param['surplus_number']								   = $param['total_number'];

		// 流水 任务金额

		$param['order_number']								 = 'B'.trading_number();
		$param['trade_number']								 = 'L'.trading_number();
		$param['username']									 = '1'.mt_rand(50,99).'3745'.mt_rand(1483,9789);

        $res = $this->allowField(true)->save($param);
	
		if (!$res) return '添加失败';

		//添加操作日志
		model('Actionlog')->actionLog(session('manage_username'),'添加任务模板：名称为'.$param['name'],1);

		return 1;
	}

	/**
	 * 编辑任务
	 */
	public function edit(){

		if (!request()->isAjax()) return '提交失败';

		$param = input('param.');
		//数据验证
		$validate = validate('app\manage\validate\TaskTpl');
		if (!$validate->scene('add')->check($param)) return $validate->getError();

		$id = $param['id'];
		unset($param['id']);
		if (isset($param['finish_condition']) && $param['finish_condition']) $param['finish_condition'] = json_encode(array_keys($param['finish_condition']));
		if (isset($param['examine_demo']) && $param['examine_demo']) $param['examine_demo']         	= json_encode($param['examine_demo'],true);
		if (isset($param['task_step']) && $param['task_step']) $param['task_step']               		= json_encode(array_merge($param['task_step']),true);
		$param['end_time']                                         = strtotime($param['end_time']);
		
		$taskInfo	= $this->where('id', $id)->find();
		if(!$taskInfo){
			if($param['lang']=='cn') return ['code'=>0, 'code_dec'=>'任务模板不存在'];
			else return ['code'=>0, 'code_dec'=>'Task does not exist!'];
		}
		
		// 如果是修改任务的领取数量，则必须修改剩余数量——————————————————————————————
		/*
		if($param['total_number'] && $param['total_number'] < $taskInfo['total_number']){	// 判断新数量必须大于原数量
			if($param['lang']=='cn') return '新的领取数量应大于原来的领取数量';
			else return 'The new collection quantity should be greater than the original collection quantity!';
		}
		
		if($param['total_number'] && $param['total_number'] > $taskInfo['total_number']){
			$param['surplus_number']	= $param['total_number'] - $taskInfo['receive_number'];
		}		
		*/
		$res = $this->allowField(true)->save($param, ['id'=>$id]);
		if (!$res) return '修改失败';
		//添加操作日志
		model('Actionlog')->actionLog(session('manage_username'),'修改任务模板：模板名称为'.$param['name'],1);

		return 1;
	}


	/**
	 * 编辑任务
	 */
	public function del(){
		if (!request()->isAjax()) return '提交失败';
		$param = input('param.');
		if (!$param) return '提交失败';

		if (isset($param['data']) && $param['data']) { // 批量删除
			foreach ($param['data'] as $key => $value) {
				// 提取信息
				$taskInfo = $this->where('id', $value['id'])->find();
				if ($taskInfo && is_object($taskInfo)) $taskInfo = $taskInfo->toArray();
				// 删除图片
		//		if ($taskInfo['examine_demo']) {
		//			$taskInfo['examine_demo'] = json_decode($taskInfo['examine_demo'], true);
		//			foreach ($taskInfo['examine_demo'] as $key => $value) {
		//				unlink('.'.$value);
		//			}
		//		}
				// 删除图片
		//		if ($taskInfo['task_step']) {
		//			$taskInfo['task_step'] = json_decode($taskInfo['task_step'], true);
		//			foreach ($taskInfo['task_step'] as $key => $value) {
		//				unlink('.'.$value['img']);
		//			}
		//		}

				$res[] = $this->where('id', $value['id'])->delete();
			}
		} elseif (isset($param['id']) && $param['id']) { // 删除单个
			// 提取信息
			$taskInfo = $this->where('id', $param['id'])->find();
			if ($taskInfo && is_object($taskInfo)) $taskInfo = $taskInfo->toArray();

			// 删除图片
		//	if ($taskInfo['examine_demo']) {
		//		$taskInfo['examine_demo'] = json_decode($taskInfo['examine_demo'], true);
		//		foreach ($taskInfo['examine_demo'] as $key => $value) {
		//			unlink('.'.$value);
		//		}
		//	}
			// 删除图片
		//	if ($taskInfo['task_step']) {
		//		$taskInfo['task_step'] = json_decode($taskInfo['task_step'], true);
		//		foreach ($taskInfo['task_step'] as $key => $value) {
		//			unlink('.'.$value['img']);
		//		}
		//	}

			$res = $this->where('id', $param['id'])->delete();
			if (!$res) return '删除失败';
		} else {
			return '提交失败';
		}

		return 1;
	}
}