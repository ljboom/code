<?php
// +----------------------------------------------------------------------
// | Yzncms [ 御宅男工作室 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 http://yzncms.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 御宅男 <530765310@qq.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 通道
// +----------------------------------------------------------------------
namespace app\member\controller;

use app\index\model\Qpassageway as QpassagewayModel;
use app\common\controller\Adminbase;

class Qpassageway extends Adminbase
{
    
    //初始化
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QpassagewayModel;
        
    }
   /**
     * 通道列表
     */
    public function index(){
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $_list                      = $this->modelClass->where($where)->page($page, $limit)->select();
            // foreach($_list as $k => $v){
            //     $_list[$k]['reg_time'] = date("Y-m-d H:i:s",$v['reg_time']);
            // }
            $total                      = $this->modelClass->where($where)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();
    }  
    
    /**
     * 通道添加
     */
    public function add(){
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $res = $this->modelClass->createManager($data);
            if($res['code'] == 200){
                $this->success("添加成功！", url("qpassageway/index"));
            }else{
                $this->error($res['msg']);
            }
        } else {
            return $this->fetch();
        }
    }   
    /**
     * 通道编辑
     */
    public function edit(){
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $res = $this->modelClass->editManager($data);
            if($res['code'] == 200){
                $this->success("编辑成功！", url("qpassageway/index"));
            }else{
                $this->error("编辑失敗！");
            }
        }else {
            $arr['id'] = $this->request->param('id/d', 0);
            $data  =  $this->modelClass->selManager($arr);
            if ($data['code'] != 200) {
                $this->error("该通道不存在！");
            }
            $this->assign("data", $data['data']);
            return $this->fetch();
        }
    }   
    
    
    /**
     * 通道删除
     */
    public function del(){
        
        $ids = $this->request->param('id/a', null);
        if (empty($ids)) {
            $this->error('请选择需要删除的通道！');
        }
        if (!is_array($ids)) {
            $ids = array(0 => $ids);
        }
        foreach ($ids as $uid) {
            $this->modelClass->where('id',$uid)->delete();
        }
        $this->success("删除成功！");
    }
    
    
}