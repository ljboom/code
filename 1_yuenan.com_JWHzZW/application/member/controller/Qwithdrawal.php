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
// | 提现
// +----------------------------------------------------------------------
namespace app\member\controller;

use app\index\model\QmoneyJournal as QmoneyJournalModel;
use app\index\model\Qwithdrawal as QwithdrawalModel;
use app\common\controller\Adminbase;
use think\Db;
use think\facade\Session;

class Qwithdrawal extends Adminbase
{
    
    //初始化
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QwithdrawalModel;
        $this->QmoneyJournalModel = new QmoneyJournalModel;
        
    }
    
    /**
     * 提现列表
     */
    public function index(){
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $quser_arr = quser_arr(1);
            $_list                      = $this->modelClass
                ->where($quser_arr['key'],$quser_arr['fuhao'],$quser_arr['val'])
                ->where($where)->page($page, $limit)->order('id desc')->select();
            foreach($_list as $k => $v){
                 $quser = Db::name('quser')->where('id',$v['quser_id'])->field('username,tel')->find();
                 $_list[$k]['tel'] = $quser['tel'];
                 $_list[$k]['username'] = $quser['username'];
                 $_list[$k]['s_username'] = quser_admin($v['quser_id']);//上級id
                 $qcard = Db::name('qcard')->where('id',$v['qcard_id'])->find();
                 $_list[$k]['qcard'] = '银行名字:'.$qcard['card_type'].'('.$qcard['branch_number'].')<br />银行卡号:'.$qcard['card_id'].'<br />支行名称:'.$qcard['card_branch'];
                 if($v['type'] == 0){ $_list[$k]['type_nem'] = '';}
                 elseif($v['type'] == 1){ $_list[$k]['type_nem'] = '通過'; }
                 elseif($v['type'] == 2){ $_list[$k]['type_nem'] = '拒絕'; }
                 $_list[$k]['reg_time'] = date("Y-m-d H:i:s",$v['reg_time']);
                 $_list[$k]['roleid'] = session::get('admin')['roleid'];
            }
            $total                      = $this->modelClass
                ->where($quser_arr['key'],$quser_arr['fuhao'],$quser_arr['val'])
                ->where($where)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();
    }  
    
    
    /**
     * 提现编辑
     */
    public function edit(){
        $data   = $this->request->get();
        $res = $this->modelClass->where('id',$data['id'])->update(['type'=>$data['type'],'upd_time'=>time()]);
        if($data['type'] == 2){
            $res = $this->modelClass->where('id',$data['id'])->field('quser_id,money')->find();
            Db::name('quser')->where('id',$res['quser_id'])->setInc('money', $res['money']);
        }
        $res = $this->modelClass->where('id',$data['id'])->field('quser_id,money')->find();
        //资金流水日志
        $QmoneyJournal = array(
            'quser_id' =>$res['quser_id'],
            'table_id' =>$data['id'],
            'money' =>$res['money'],
            'type' =>2,
            );
        $this->QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);
        $this->success("成功！");
       
        
    }  
}