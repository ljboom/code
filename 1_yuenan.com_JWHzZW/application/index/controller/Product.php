<?php

namespace app\index\controller;

use app\index\model\DamowProductModel;
use app\common\controller\Indexbase;
use app\index\model\DamowOrderModel;
use app\index\model\QmoneyJournal;
use app\index\model\Quser;
use think\facade\Session;

class Product extends Indexbase
{
    
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new DamowProductModel;
    }
    
    // 查詢
    public function sel(){
        $arr = input();
        $res = $this->modelClass->selManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }

    // 查詢详情
    public function info(){
        $arr = input();
        $res = $this->modelClass->infoManager($arr);

        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }


    // 购买
    public function buy(){
        $arr = input();
        $arr['user_id']=   Session::get(bianliang(1));
        $res = $this->modelClass->buyManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }



    // 訂單
    public function order(){
        $arr = input();
        $arr['user_id']=   Session::get(bianliang(1));
        $res = $this->modelClass->orderManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
    }
    
    /**
     * 赎回
     */
    public function redemption(){
        
        $post = input('post.');
        $post['user_id']=   Session::get(bianliang(1));
        if(!$post['id']) return json_encode(code_msg(3));
        
        $info = DamowOrderModel::where('id',$post['id'])->where('user_id',$post['user_id'])->find();
        
        if(!$info) return  json_encode(code_msg(3));
        
        if($info['status']) return json_encode(code_msg(46));
        
        if($info['day'] > $info['fanxian_number']) return json_encode(code_msg(47));
        
        $Quser = new Quser();
        $user  = $Quser->get($info['user_id']);
        $money = round($info['money'] + ($info['money'] * $info['day_rate'] / 100 * $info['day']),2);
        $user->money = $user->money + $money;
        $user->save();
        
        $QmoneyJournal = array(
            'quser_id'=>$info['user_id'],
            'table_id'=>$info['id'],
            'money'   =>$money,
            'type'    =>10,
        );
        $QmoneyJournalModel = new QmoneyJournal();
        $QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);
        
        DamowOrderModel::where('id',$post['id'])->where('user_id',$post['user_id'])->update(['status'=>1]);
        
        return json_encode(code_msg(1));
    }
    

    public function fanxian(){
        //当天时间内，现在时间>date时间
        //每分鐘遍歷訂單表，返現金額,字段為predict_day_price
        DamowOrderModel::where('update_at','<',date('Y-m-d 00:00:00',time()))->whereRaw('fanxian_number<day')->chunk(100,function($items){
            //print_r($items);
            foreach($items as $item){
                /*if($item['fanxian_number'] >= $item['day']){
                    dump(date('Y-m-d H:i:s',time()).'-'.$item['id'].'-已全部返现');
                    continue;//全部返现了
                }*/
                $zero1 = strtotime ($item['start_time']);
                $zero2 = time();
                $diff_time = ($zero2-$zero1)/86400;

                if($diff_time<1){
                    dump(date('Y-m-d H:i:s',time()).'-'.$item['id'].'-必須是購買的第二天，才能返現');
                    continue;//必須是購買的第二天，才能返現
                }
                $day = intval($diff_time);
                if($item['fanxian_number'] == $day){
                    dump(date('Y-m-d H:i:s',time()).'-'.$item['id'].'-今天已經返現了');
                    continue;//今天已經返現了
                }

                //返現次數修改
                $DamowOrderModels = new DamowOrderModel();
                $fanxian_number = $item['fanxian_number']+1;
                $DamowOrderModels->save([
                    'fanxian_number'  => $fanxian_number,
                    'update_at' => date('Y-m-d H:i:s')
                ],['id' => $item['id']]);

                //修改-只写入日志不进行结算  结算需要自己赎回
                $predict_day_price = $item['predict_day_price'];
                
                //寫入資金流水日誌
                $QmoneyJournal = array(
                    'quser_id'=>$item['user_id'],
                    'table_id'=>$item['id'],
                    'money'   =>$predict_day_price,
                    'type'    =>8,
                );
                $QmoneyJournalModel = new QmoneyJournal();
                $QmoneyJournalModel->add_qmoneyjournal($QmoneyJournal);
                dump(date('Y-m-d H:i:s',time()).'-'.$item['id'].'-返现成功');
            }
        });
        dump('success');
    }
    
}