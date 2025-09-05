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
// | 充值管理model
// +----------------------------------------------------------------------
namespace app\index\model;

use app\index\model\QmoneyJournal as QmoneyJournalModel;
use think\Model;
use think\facade\Session;
use think\Db;

class Qrecharge extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qrecharge';
    protected $insert = ['status' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
        
    }
    
     /**
     * 查詢充值model
     * @param type $data
     * @return boolean
     */
     
    public function selManager($data){
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        $info = $this->where('id', $data['id'])
            // ->field('id,nickname,username,name_id,tel,code_str,reg_time')
            ->find()->toArray();
        unset($info['password']);
        unset($info['t_password']);
        if (empty($info)) {
            return code_msg(5);//用戶不存在
        }
        $data = code_msg(1);
        $data['data'] = $info;
        $data['data']['reg_date'] = date("Y-m-d H:i:s",$data['data']['reg_time']);
        return $data;
    }
    
    /**
     * 创建充值
     * @param type $data
     * @return boolean
     */
    public function createManager($data)
    {
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        $this->QmoneyJournalModel = new QmoneyJournalModel;
        $quser = Db::name('quser')->where('tel',$data['tel'])->field('id,code_quserid')->find();
        if(empty($quser)){
            return code_msg(5);
        }else{
            unset($data['tel']);
            $data['quser_id'] = $quser['id'];
            $data['superior_quser_id'] = $quser['code_quserid'];
        }
        $data['type'] = empty($data['type']) ? 0 : 1;
        $time = time();
        $data['number'] = date("YmdHis",$time).random();
        $data['reg_time'] = $time;
        
        
        $id               = $this->insertGetId($data);
        // dump($id);exit;
        if ($id) {
            if($data['type'] == 1){
                Db::name('quser')->where('id',$quser['id'])->setInc('money', $data['money']);
                //资金流水日志
                $QmoneyJournal = array(
                    'quser_id' =>$quser['id'],
                    'table_id' =>$id,
                    'money' =>$data['money'],
                    'type' =>1,
                    );
                $this->QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);
            }
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }
    
    
    // /**
    //  * 充值添加
    //  */
    // public function add(){
    //     if ($this->request->isPost()) {
    //         $data   = $this->request->post();
    //         $res = $this->modelClass->createManager($data);
    //         if($res['code'] == 200){
    //             $this->success("添加成功！", url("qpassageway/index"));
    //         }else{
    //             $this->error($res['msg']);
    //         }
    //     } else {
    //         return $this->fetch();
    //     }
    // }
}