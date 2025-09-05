<?php

namespace app\index\model;

use think\Model;
use think\facade\Session;
use app\index\model\Quser;
use app\index\model\DamowOrderModel;
use app\index\model\QmoneyJournal;

class DamowProductModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $name   = 'damow_product';
    
    public function getDayRateAttr($value)
    {
        return $value*100;
    }

    /**
     * 列表数据
     * @param $data
     * @return mixed
     * @date: 2022/4/27 19:57
     */
    public function selManager($data){
        $data['page'] = !isset($data['page'])?1:$data['page'];
        $data['size'] = !isset($data['size'])?20:$data['size'];
        $list = $this->/*where('status',1)->*/order('sort asc')->page($data['page'],$data['size'])->select()->toArray();
        if (empty($list)) return code_msg(3);
        $data           = code_msg(1);
        foreach ($list as &$val){
            $val['day_rate'] = round($val['day_rate'],2);
            $val['status'] = date('Y/m/d') < $val['date'] ? -1 : $val['status'];
        }
        $data['data']   = $list;
        return $data;
    }

    /**
     * 详情数据
     * @param $param
     * @return mixed
     * @date: 2022/4/27 20:29
     */
    public function infoManager($param){
        if(!isset($param['product_id']) || empty($param['product_id']))return code_msg(26);
        $info = $this->get($param['product_id']);
        if (empty($info)) return code_msg(3);
        $info['status'] = date('Y/m/d') < $info['date'] ? -1 : $info['status'];
        //$info['day_rate'] = sprintf("%.2f",$info['day_rate']);
        $data           = code_msg(1);
        $data['data']   = $info;
        return $data;
    }


    

    /**
     * 购买
     * @param $param
     * @return mixed
     * @date: 2022/4/27 20:29
     */
    public function buyManager($param)
    {
        //1.確認是否有購買資格，產品是否存在
        $DamowOrderModel = new DamowOrderModel();
        if(empty($param['money'])) return code_msg(36);
        if(!isset($param['product_id']) || empty($param['product_id']))return code_msg(26);
        if(!isset($param['user_id']) || empty($param['product_id']))return code_msg(27);
        $info = $this->get($param['product_id']);

        if (empty($info)) return code_msg(26);
        if (empty($info['status'])) return code_msg(37);
        if($param['money']<$info['start_price']) return code_msg(30);
        if($info['max_price']!='0'){
            if($param['money']>$info['max_price']) return code_msg(31);
        }
        $day_money = sprintf("%.2f",$param['money']*$info['day_rate']/100);
        $predict_price = sprintf("%.2f",$param['money']+($day_money*$info['day']));


        //2.會員是否存在
        $Quser = new Quser();
        $user  = $Quser->get($param['user_id']);
        if (empty($user)) return code_msg(27);

        //3.判斷用戶的金額是否足夠購買產品
        if($user['money']<$param['money']) return code_msg(28);
        $money = $user['money']-$param['money'];
        if($money<0) return code_msg(28);

        $order_count = $DamowOrderModel->where('user_id',$param['user_id'])
            ->where('product_id',$param['product_id'])->count();
        if($order_count>=$info['investment_count']) return code_msg(100);



        //4.通過判斷，購買產品入庫,扣除餘額
        $add_row = [
            'product_id'=>$param['product_id'],
            'order_number'=> date("YmdHis",time()).random(),
            'product_name'=>$info['product_name'],
            'product_image'=>$info['image'],
            'user_id'=>$param['user_id'],
            'day'=>$info['day'],
            'day_rate'=>$info['day_rate'],
            'start_time'=>date('Y-m-d H:i:s',time()),
            'end_time'=>date('Y-m-d H:i:s',strtotime('+'.$info['day'].' day')),
            'money'=>$param['money'],
            'predict_price'=>$predict_price,
            'predict_day_price'=>$day_money,
            'create_at'=>date('Y-m-d H:i:s',time()),
            'update_at'=>date('Y-m-d H:i:s',time()),
            'status' => 0
        ];

        $DamowOrderModel->data($add_row)->save();
        //DamowOrderModel::insert($add_row);
        $user->money = $money;
        $user->save();



        //寫入資金流水日誌
        $QmoneyJournal = array(
            'quser_id'=>$param['user_id'],
            'table_id'=>$DamowOrderModel->id,
            'money'   =>$param['money'],
            'type'    =>9,
        );
        $QmoneyJournalModel = new QmoneyJournal();
        $QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);

        $data           = code_msg(1);
        return $data;
    }


    /**
     * 訂單列表
     * @param $param
     * @return mixed
     * @date: 2022/4/27 21:21
     */
    public function orderManager($param){
        //1.確認是否有購買資格，產品是否存在
        $DamowOrderModel = new DamowOrderModel();
        $param['page'] = !isset($param['page'])?1:$param['page'];
        $param['size'] = !isset($param['size'])?20:$param['size'];
        $list = $DamowOrderModel->where('user_id',$param['user_id'])->order('start_time desc')->page($param['page'],$param['size'])->select()->toArray();
        if (empty($list)) return code_msg(3);
        foreach ($list as $k=>$item){
            if($item['end_time']>date('Y-m-d 00:00:00') && date('H:i:s') > date('H:i:s',strtotime($item['start_time'])) && (date('Y-m-d') >  $item['start_time'])){
                $list[$k]['day_inc'] = number_format($item['money'] * $item['day_rate']/100,2);
            }else{
                $list[$k]['day_inc'] = '0.00';
            }
        
            
            $list[$k]['total_inc'] = number_format($item['money'] * $item['day_rate'] * $item['fanxian_number'] / 100,2);
        }
        $data           = code_msg(1);
        $data['data']   = $list;
        return $data;
    }


}
