<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use think\Request;
use app\admin\model\Fund as FundModel;
use think\Db;
/**
 * 基金控制器
 * @package app\admin\controller
 */
class Fund extends Admin
{
    /**
     * 基金首页
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        
        $fund_type = $this->request->get('fund_type');
        $type = $this->request->get('type');
        $keyword = $this->request->get('keyword');
        $data_start = $this->request->get('data_start');
        $data_end = $this->request->get('data_end');
        $where = [];
        if($fund_type != "" && $fund_type != 'all'){
            $where[] = ['fund_type', '=', $fund_type];
        }
        
        if($type != "" && $keyword != "" && $type != 'all'){
            $where[] = [$type, '=', $keyword];
        }
         if($data_start != "" && $data_end != ""){
            $range = strtotime($data_start) . ',' . strtotime($data_end);
            $where[] = ['createtime', 'between', $range];
        }
          $list = FundModel::where($where)->paginate(20)->each(function($item, $key){
              $item->fund_code = $item->fund_code;
              $item->fund_type_text = $item->fund_type_text;
              $item->type_text = $item->type_text;
              return $item;
          });
        // 获取分页显示
        $page = $list->render();
        
        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch();
    }
    public function add(){
        if($this->request->isAjax()){
            $params = $this->request->post();
            Db::startTrans();
            try{
                $params['type'] = FundModel::TYPE_PRIVATE;
                
                $res = (new FundModel)->allowField(true)->save($params);
                if($res){
                    Db::commit();
                    return apiRule(true, '添加成功','','', url('fund/index') );
                }
            }catch(Exception $e){
                Db::rollback();
                return apiRule(false, $e->getMessage());
            }
        }
        return $this->fetch();
    }
    //修改
    public function edit(){
        if ($this->request->isPost()) {
            $params = $this->request->post();
            Db::startTrans();
            try{
                $id = $params['id'];
                unset($params['id']);
                $res = (new FundModel)->allowField(true)->save($params,['id'=>$id]);
                if($res){
                    Db::commit();
                    return apiRule(true, '修改成功','','', url('fund/index') );
                }
            }catch(Exception $e){
                Db::rollback();
                return apiRule(false, $e->getMessage());
            }
        } 
        $ids = $this->request->param('id');
        $fund = FundModel::find($ids);
        $this->assign('fund',$fund);
        return $this->fetch();  
    }
    /**
     * 删除日志
     */
    public function deletes($id='',$type='')
    {
         if (!$this->request->isAjax()) {
            $this->error("操作太频繁，请稍后操作!");
        }
 
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $ids = explode(",",$ids);
        }
        if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
        }
       
        foreach($ids as $v){
            FundModel::where('id',$v)->delete();
        }
         return apiRule(true, '删除成功');
    }
}
