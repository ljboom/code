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
// | 充值
// +----------------------------------------------------------------------
namespace app\member\controller;

use app\index\model\QmoneyJournal as QmoneyJournalModel;
use app\index\model\Qrecharge as QrechargeModel;
use app\common\controller\Adminbase;
use think\Db;
use think\facade\Session;

class Qrecharge extends Adminbase
{
    
    //初始化
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QrechargeModel;
        $this->QmoneyJournalModel = new QmoneyJournalModel;
        
    }
    
    /**
     * 充值列表
     */
    public function index(){
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $quser_arr = quser_arr(1);
            $_list                      = $this->modelClass->where($where)
                ->where($quser_arr['key'],$quser_arr['fuhao'],$quser_arr['val'])
                ->page($page, $limit)->order('id desc')->select();
            foreach($_list as $k => $v){
                 $quser = Db::name('quser')->where('id',$v['quser_id'])->field('username,tel')->find();
                 $_list[$k]['tel'] = $quser['tel'];
                 $_list[$k]['username'] = $quser['username'];
                //  $_list[$k]['s_username'] = Db::name('quser')->where('id',$v['superior_quser_id'])->value('username');
                 $_list[$k]['s_username'] = quser_admin($v['quser_id']);//上級id
                 if($v['qpassageway_id']){
                    $_list[$k]['qpassageway'] = Db::name('qpassageway')->where('id',$v['qpassageway_id'])->value('branch_name');
                 }else{
                    $_list[$k]['qpassageway'] = '手動充值';
                 }
                 if($v['type'] == 0){ $_list[$k]['type_nem'] = '';}
                 elseif($v['type'] == 1){ $_list[$k]['type_nem'] = '通過'; }
                 elseif($v['type'] == 2){ $_list[$k]['type_nem'] = '拒絕'; }
                 $_list[$k]['reg_time'] = date("Y-m-d H:i:s",$v['reg_time']);
                 $_list[$k]['roleid'] = session::get('admin')['roleid'];
            }
            // dump($_list);
            // exit;
            $total                      = $this->modelClass
                ->where($quser_arr['key'],$quser_arr['fuhao'],$quser_arr['val'])
                ->where($where)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();
    }  
    
    
        
    /**
     * 充值添加
     */
    public function add(){
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $res = $this->modelClass->createManager($data);
            if($res['code'] == 200){
                $this->success("添加成功！", url("qrecharge/index"));
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
        
        $data   = $this->request->get();
        $res = $this->modelClass->where('id',$data['id'])->update(['type'=>$data['type'],'upd_time'=>time()]);
        if($data['type'] == 1){
            $res = $this->modelClass->where('id',$data['id'])->field('quser_id,money')->find();
            Db::name('quser')->where('id',$res['quser_id'])->setInc('money', $res['money']);
            //资金流水日志
            $QmoneyJournal = array(
                'quser_id' =>$res['quser_id'],
                'table_id' =>$data['id'],
                'money' =>$res['money'],
                'type' =>1,
                );
            $this->QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);
        }
        $this->success("成功！");
       
        
    }  
}