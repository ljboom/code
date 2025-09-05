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
// | 新股申购
// +----------------------------------------------------------------------
namespace app\member\controller;

use app\index\model\QmoneyJournal as QmoneyJournalModel;
use app\index\model\Qxingushengou as QxingushengouModel;
use app\common\controller\Adminbase;
use think\Db;

class Qxingushengou extends Adminbase
{
    
    //初始化
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QxingushengouModel;
        $this->QmoneyJournalModel = new QmoneyJournalModel;
        
    }
    
    /**
     * 新股申购列表
     */
    public function index(){
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $quser_arr = quser_arr(1);
            $_list                      = $this->modelClass->where($where)
                ->where($quser_arr['key'] , $quser_arr['fuhao'] ,$quser_arr['val'])
                ->page($page, $limit)->order('id desc')->select();
            foreach($_list as $k => $v){
                 $quser = Db::name('quser')->where('id',$v['quser_id'])->field('username,tel,code_quserid')->find();
                 $_list[$k]['username'] = $quser['tel'].'<br />'.$quser['username'];
                 $_list[$k]['s_username'] = quser_admin($v['quser_id']);//上級id
                 $qstockservices = Db::name('qstocks_new')->where('id',$v['qstocks_new_id'])->field('symbol_name,symbol')->find();
                 $_list[$k]['qstockservices']  = $qstockservices['symbol'].'<br />'.$qstockservices['symbol_name'];
                 
                 $_list[$k]['zhongqian_renji_ori_money'] = $v['shengou_money']*$v['zhongqian_num'] ;
                 $_list[$k]['zhongqian_shouxu_money'] = $v['zhongqian_renji_money'] - $_list[$k]['zhongqian_renji_ori_money'] ;
                
                 if($v['status'] == 0){ $_list[$k]['status_name'] = '待中签';}
                 elseif($v['status'] == 1){ $_list[$k]['status_name'] = '已中签'; }
                 elseif($v['status'] == 2){ $_list[$k]['status_name'] = '未中签'; }
                 elseif($v['status'] == 3){ $_list[$k]['status_name'] = '认缴成功'; }
                 elseif($v['status'] == 4){ $_list[$k]['status_name'] = '认缴失败'; }
                 elseif($v['status'] == 5){ $_list[$k]['status_name'] = '已取消'; }
                 $_list[$k]['reg_time'] = date("Y/m/d",$v['reg_time']).'<br />'.date('H:i:s',$v['reg_time']);
                 
            }
            $total                      = $this->modelClass->where($quser_arr['key'] , $quser_arr['fuhao'] ,$quser_arr['val'])->where($where)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();
    }  
    
    // 改签
    public function gaiqian(){
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $find = $this->modelClass->where('id',$data['id'])->find();
            if($data['zhongqian_num'] > $find['shengou_num']){
                $this->error(code_msg(18)['msg']);//超过申购数量
            }
            if($data['zhongqian_num'] <= 0){
                $this->error(code_msg(19)['msg']);//数值不能小于等于0
            }
            
            if($data['zhongqian_num'] % 1000 != 0){
                $this->error("中签股数必须是1000倍数");//数值不能小于等于0
            }
            
            $res = $this->modelClass->editManager($data);
            if($res['code'] == 200){
                $this->success("改签成功！", url("qxingushengou/index"));
            }else{
                $this->error($res['msg']);
            }
        }else {
            $arr['id'] = $this->request->param('id/d', 0);
            // dump($arr);exit;
            $res = $this->modelClass->where('id',$arr['id'])->find();
            $this->assign("data", $res);
            return $this->fetch();
        }
    }
    
    // 发布
    public function fabu(){
        $data   = $this->request->param();
        if(!empty($data['id'])){
            $arr_id = $data['id'];
        }else{
            $arr_id = $data;
        }
        if (empty($arr_id) || !is_array($arr_id)) {
            // return code_msg(3);// 没有数据
        }
        $array = $this->modelClass->where('id','in',$arr_id)->field('id,zhongqian_num,shengou_money')->select()->toArray();
        $list = [];
        foreach($array as $k => $v){
            if(empty($v['zhongqian_num'])){
                $list[] = array(
                    'id' => $v['id'],
                    'status' => 2,
                    );
            }else{
                $list[] = array(
                    'id' => $v['id'],
                    'status' => 1,
                    'zhongqian_renji_money' => $v['zhongqian_num']*$v['shengou_money']+admin_config(1),//中签缴费金额
                    );
            }
        }
        $this->modelClass->isUpdate()->saveAll($list);
        $this->success("成功！");
    }
    
    
    // 认缴
    public function renjiao(){
        $id   = $this->request->param('id');
        $time = time();
        $res = $this->modelClass->where('id',$id)->find();
        $quser = Db::name('quser')->where('id',$res['quser_id'])->find();
        $quser = Db::name('quser')->where('id',$res['quser_id'])->find();
        
        if($res['status'] != 1 || empty($res['zhongqian_num'])){
            $this->error(code_msg(20)['msg']);//非法操作
        }
        $draw_date = Db::name('qstocks_new')->where('id',$res['qstocks_new_id'])->value('draw_date');
        $kaishi_date = strtotime($draw_date);
        $jieshu_date = strtotime($draw_date)+(3600*24*4);
        if($time < $kaishi_date || $time > $jieshu_date ){
            $this->error(code_msg(21)['msg']);//不在认缴时间内
        }
        // 判断已认缴中签数量
        if(empty($res['yirenji_money_count'])){
            // 第一次认缴
            $gupiao_num = floor(($quser['money'] - admin_config(1))/$res['shengou_money']);
            if(empty($gupiao_num)){            $this->error(code_msg(13)['msg']);       }//余额不足
            
            // 判断第一次认缴 用户金额是否支持 全部认缴中签金额
            if($gupiao_num >= $res['zhongqian_num']){
                // 用户金额 够 一次性认缴
                $array = array(
                    'id' => $res['id'],
                    'yirenji_money' => $res['zhongqian_renji_money'],
                    'yirenji_money_num' => $res['zhongqian_num'],
                    'yirenji_money_count' => 1,
                    'status' => 3,// 认缴成功
                    );
                $money = $array['yirenji_money'];

            }else{
                // 用户金额 不够 一次性认缴
                $array = array(
                    'id' => $res['id'],
                    'yirenji_money' => $gupiao_num*$res['shengou_money'],
                    'yirenji_money_num' => $gupiao_num,
                    'yirenji_money_count' => 1,
                    );
                $money = $array['yirenji_money'];
            }
            
            
        }else{
            // 第二次 或二次以上认缴
            $gupiao_num = floor($quser['money']/$res['shengou_money']);
            if(empty($gupiao_num)){            $this->error(code_msg(13)['msg']);       }//余额不足
            // 剩余要认缴数量
            $shengyu_num = $res['zhongqian_num'] - $res['yirenji_money_num'];
            if($gupiao_num >= $shengyu_num){
                // 用户金额 够 一次性认缴
                $array = array(
                    'id' => $res['id'],
                    'yirenji_money' => $res['zhongqian_renji_money'],
                    'yirenji_money_num' => $res['zhongqian_num'],
                    'yirenji_money_count' => $res['yirenji_money_count'] + 1,
                    'status' => 3,// 认缴成功
                    );
                $money = $shengyu_num * $res['shengou_money'];
            }else{
                // 用户金额 不够 一次性认缴
                $array = array(
                    'id' => $res['id'],
                    'yirenji_money' => $gupiao_num*$res['shengou_money']+$res['yirenji_money'],
                    'yirenji_money_num' => $res['yirenji_money_num'] + $gupiao_num,
                    'yirenji_money_count' => $res['yirenji_money_count'] + 1,
                    );
                
                $money = $gupiao_num * $res['shengou_money'];
            }
            
        }
        $money_journal = array(
            'quser_id' =>$res['quser_id'],
            'table_id' =>$array['id'],
            'money' =>$money,
            'type' =>3,
            );
        // dump($money);
        // dump($money_journal);
        // dump($array);exit;
        Db::name('quser')->where('id',$res['quser_id'])->setInc('dongjie_money', $money);//冻结金额
        Db::name('quser')->where('id',$res['quser_id'])->setDec('money', $money);//
        $this->modelClass->isUpdate()->save($array);
        $this->QmoneyJournalModel->add_qmoneyjournal($money_journal);

        $this->success("成功！");
    }

    /**
     * 新股申购取消
     */
    public function edit(){
        
        // $data   = $this->request->get();
        // $res = $this->modelClass->where('id',$data['id'])->update(['status'=>$data['status']]);
        // $this->success("成功！");
        $data   = $this->request->get();
        $xingu = $this->modelClass->where('id',$data['id'])->find();
        if(!empty($xingu['status'])){
            $this->error(code_msg(33)['msg']);
        }
        $count =$this->modelClass->where('qstocks_new_id',$xingu['qstocks_new_id'])->where('quser_id',$xingu['quser_id'])->count();
        if($count > 1){
            $this->error(code_msg(40)['msg']);
        }
        $res = $this->modelClass->where('id',$data['id'])->update(['status'=>$data['status']]);
        $this->success("成功！");
        
    }  


}