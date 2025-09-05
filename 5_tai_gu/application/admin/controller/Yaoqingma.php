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
 * 邀请码管理
 *
 * @icon fa fa-circle-o
 */
class Yaoqingma extends Backend
{
    
    /**
     * Yaoqingma模型对象
     * @var \app\admin\model\Yaoqingma
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Yaoqingma;
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
               $list = $this->model
			    ->with('admin')
            	->where($where)
            	->where(['daili_id'=>$admin_id])
            	->order($sort, $order)
            	->paginate($limit);
            	
            }else{
            	$list = $this->model
				->with('admin')
            	->where($where)
            	->order($sort, $order)
            	->paginate($limit);
            }

            foreach ($list as $row) {
                
                $row->getRelation('admin')->visible(['username']);
            }

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }
	
	public function shengcheng(Request $request){
		if($request->isAjax()){
		    $available_num = $request->param('available_num');
		    if(empty($available_num)){
		        $result=array(
					'code'=>0,
					'msg'=>'可用次数不能为0',
				);
				return json($result);
		    }
			$admin_id=Session::get('admin')['id'];
			$data=array();
			for($i=0;$i<30;$i++){
				$data[]=array(
					'daili_id'=>$admin_id,
					'code'=>GetRandStr(6),
					'available_num' => $available_num,
					'status'=>'0',
					'createtime'=>time(),
				);
			}
			
			$rs=Db::name('yaoqingma')->insertAll($data);
			if($rs>0){
				$result=array(
					'code'=>1,
					'msg'=>'生成成功',
				);
			}else{
				$result=array(
					'code'=>0,
					'msg'=>'生成失败',
				);
			}
			
			return json($result);
		}
	}
}
