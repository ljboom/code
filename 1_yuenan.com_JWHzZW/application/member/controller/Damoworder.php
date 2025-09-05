<?php
namespace app\member\controller;

use app\common\controller\Adminbase;
use app\index\model\DamowOrderModel;
use think\Db;

class Damoworder extends Adminbase
{
    //初始化
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new DamowOrderModel;
    }

    public function index(){
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $quser_arr = quser_arr(3);
            $_list                      = $this->modelClass->where($where)
                ->where($quser_arr['key'] , $quser_arr['fuhao'] ,$quser_arr['val'])
                ->page($page, $limit)->order('id desc')->select();
            foreach ($_list as $k=>$item){
                if($item['end_time']<date('Y-m-d H:i:s')){
                    $item['status'] = 0;
                }else{
                    $item['status'] = 1;
                }
                $_list[$k]['status'] = $item['status']==1?'增值中':'已完成';
                $_list[$k]['yuji_money'] = sprintf("%.2f",$item['predict_price']-$item['money']);
                $_list[$k]['yi_money'] = sprintf("%.2f",$item['fanxian_number']*$item['predict_day_price']);
                $user = Db::name('quser')->where('id',$item['user_id'])->find();
                // $_list[$k]['s_username'] = Db::name('quser')->where('id',$user['code_quserid'])->value('username');
                $_list[$k]['s_username'] = quser_admin($item['user_id']);//上級id
                $_list[$k]['user_name'] =$user['username'];
                $_list[$k]['tel'] =$user['tel'];
            }
            $total                      = $this->modelClass->where($quser_arr['key'] , $quser_arr['fuhao'] ,$quser_arr['val'])->where($where)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();
    }


    public function del()
    {
        $data = input('get.');
        $res = $this->modelClass->destroy($data['id']);
        if($res == 200){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }
}