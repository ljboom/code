<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\exception\PDOException;
use think\exception\ValidateException;
use think\Request;
use think\Db;
/**
 * 折价申购
 *
 * @icon fa fa-circle-o
 */
class Zjsg extends Backend
{

    /**
     * Zjsg模型对象
     * @var \app\common\model\Zjsg
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\Zjsg;
        $this->view->assign("statusList", $this->model->getStatusList());
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

            $list = $this->model
                    ->with(['product','user'])
                    ->where($where)
                    ->order($sort, $order)
                    ->paginate($limit);

            foreach ($list as $row) {
                $row->visible(['id','price','num','turnover','status']);
                $row->visible(['product']);
				$row->getRelation('product')->visible(['name']);
				$row->visible(['user']);
				$row->getRelation('user')->visible(['username','nickname']);
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
			        $price=$row['price'];
                    if($row['status'] == 1 && $params['status'] == 2){
                        // 转为交易单
                        $pro=Db::name('product')->where('id',$row['pro_id'])->find();
                        //计算手续费
            			$shouxufeilv=floatval(config('site.shouxufeilv'))/100;
            			$shouxufei=$price*$shouxufeilv;
            			$shouxufei=$shouxufei>=20?$shouxufei:20;
            			$shouxufei=-1*$shouxufei;
                        $rs1=Db::name('chicang')->insert([
        					'order_sn'=>getMillisecond(),
        					'fangxiang_data'=>1,
        					'user_id'=>$row['user_id'],
        					'pro_id'=>$row['pro_id'],
        					'price'=>$price/1000,
        					'shuliang'=>$row['turnover'],
        					'benjin'=>$price,
        					'sxf_gyf'=>$shouxufei,
        					'shizhi'=>$pro['price']*$row['turnover'],
        					'status'=>1,
        					'buytime'=>time(),
        					'buy_type'=>1,
        				]);
                    }
                    if($row['status'] == 1 && $params['status'] == 3){
                        Db::name('user')->where('id',$row['user_id'])->setInc('money',$price);
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
