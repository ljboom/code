<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use app\common\library\Auth;
use think\Db;
use think\Request;
use think\Session;
use think\exception\PDOException;
use think\exception\ValidateException;
/**
 * 充值管理
 *
 * @icon fa fa-circle-o
 */
class Chongzhi extends Backend
{
    
    /**
     * Chongzhi模型对象
     * @var \app\admin\model\Chongzhi
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Chongzhi;
        $this->view->assign("statusList", $this->model->getStatusList());
    }

    public function import()
    {
        parent::import();
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            
            $admin_id=Session::get('admin')['id'];
			$admin=Db::name('auth_group_access')->where('uid',$admin_id)->select();
			
			$group_arr=array();
			foreach($admin as $k=>$v){
				$group_arr[]=$v['group_id'];
			}
			
			if(!in_array(1,$group_arr)){
			    
			   $user_arr=Db::name('user_info')->where('daili_id',$admin_id)->select();
			   $arr=array();
			   foreach($user_arr as $k=>$v){
			       $arr[]=$v['user_id'];
			       
			   }
			    
			   $list = $this->model
			    ->with(['user'])
				->where($where)
				->where(['user_id'=>['in',$arr]])
				->order($sort, $order)
				->paginate($limit);
				
			}else{
				$list = $this->model
				->with(['user'])
				->where($where)
				->order($sort, $order)
				->paginate($limit);
			}



            foreach ($list as $row) {
                
                $row->getRelation('user')->visible(['username']);
            }

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }
	
	/**
	 * 编辑
	 */
	public function edit($ids = null)
	{
	    $row = $this->model->get($ids);
	    if (!$row) {
	        $this->error(__('No Results were found'));
	    }
	    $adminIds = $this->getDataLimitAdminIds();
	    if (is_array($adminIds)) {
	        if (!in_array($row[$this->dataLimitField], $adminIds)) {
	            $this->error(__('You have no permission'));
	        }
	    }
	    if ($this->request->isPost()) {
	        $params = $this->request->post("row/a");
			$old_status=$row->status;

			

	        if ($params) {
	            $params = $this->preExcludeFields($params);
	            $result = false;
	            Db::startTrans();
	            try {
	                //是否采用模型验证
	                if ($this->modelValidate) {
	                    $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
	                    $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
	                    $row->validateFailException(true)->validate($validate);
	                }
	                $result = $row->allowField(true)->save($params);
	                Db::commit();
	            } catch (ValidateException $e) {
	                Db::rollback();
	                $this->error($e->getMessage());
	            } catch (PDOException $e) {
	                Db::rollback();
	                $this->error($e->getMessage());
	            } catch (Exception $e) {
	                Db::rollback();
	                $this->error($e->getMessage());
	            }
	            if ($result !== false) {

					//如果状态是由未审核变为通过，则增加用户余额，和添加资金流水
					if($old_status=='0' && $params['status']=='1'){
						$money=$row->money;
						Db::name('user')->where('id',$row->user_id)->setInc('money',$money);
						$user=Db::name('user')->where('id',$row->user_id)->find();
						$liushui_data=array(
							'use_id'=>$row->user_id,
							'user_name'=>$user['username'],
							'neirong'=>$user['username'].'于'.date('Y-m-d H:i:s',time()).'充值+'.$money,
							'money'=>$money,
							'status'=>0,
							'createtime'=>time(),
						);
						Db::name('liushui')->insert($liushui_data);
					}
					
					
	                $this->success();
	            } else {
	                $this->error(__('No rows were updated'));
	            }
	        }
	        $this->error(__('Parameter %s can not be empty', ''));
	    }
	    $this->view->assign("row", $row);
	    return $this->view->fetch();
	}

}
