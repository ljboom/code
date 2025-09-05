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
// | 资金流水表model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\Db;


class QmoneyJournal extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qmoney_journal';
    
    public function add_qmoneyjournal($data){
        if(!empty($data[0])){
            $array = [];
            foreach($data as $k => $v){
                $total_money = Db::name('quser')->where('id',$v['quser_id'])->value('money');
                $v['log'] = empty($v['log']) ? '' : $v['log'];
                $array[] = array(
                    'quser_id' =>$v['quser_id'],
                    'table_id' =>$v['table_id'],
                    'money' =>$v['money'],
                    'total_money' =>$total_money,
                    'type' =>$v['type'],
                    'log'=>$v['log'],
                    'add_time' => time(),
                    );
            }
            return $this->saveAll($array);
        }else{
            if(empty($data['quser_id']) ||empty($data['table_id']) ||empty($data['money']) ||empty($data['type'])){
            
            }else{
                $total_money = Db::name('quser')->where('id',$data['quser_id'])->value('money');
                $data['log'] = empty($data['log']) ? '' : $data['log'];
                $array = array(
                    'quser_id' =>$data['quser_id'],
                    'table_id' =>$data['table_id'],
                    'money' =>$data['money'],
                    'total_money' =>$total_money,
                    'type' =>$data['type'],
                    'log'=>$data['log'],
                    'add_time' => time(),
                    );
                
                return $this->save($array);
            }
                
        }
        
        
        
        
        
    }
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
}