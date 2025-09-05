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
// | 个人股票基金model
// +----------------------------------------------------------------------
namespace app\index\model;

use think\Model;
use think\facade\Session;
use think\Db;

class QuserQstockservices extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $name   = 'quser_qstockservices';
    // protected $is_show = ['is_show' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
    
    
    /**
     * 查詢用户是否存在股票基金
     * @param type $data
     * @return boolean
     */
    public function sel_gupiao($data){
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        // $data['quser_id'] = empty( Session::get(bianliang(1)) ) ? $data['quser_id'] : Session::get(bianliang(1)) ;
        $id = $this->where(['quser_id'=> $data['quser_id']])->where('symbol',$data['symbol'])->value('id');
        if(empty($id)){
            $data = code_msg(2);
        }else{
            $data = code_msg(1);
            $data['data'] = array(
                'id'=>$id
                );
        }
        return $data;
    }     
    
    /**
     * 查詢用户股票基金
     * @param type $data
     * @return boolean
     */
    public function selManager($data){
        // $data['quser_id'] = 21;
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        if(!empty($data['where'])){
            $whereLike = $data['where'];
            $info = $this->alias('a')
            ->where('is_show',1)
            ->whereOr('a.symbolName','like',"%$whereLike%")
            ->whereOr('a.symbol','like',"%$whereLike%")
            ->where(['a.quser_id'=> $data['quser_id']])
            ->page($data['page'],20)
            ->select()->toArray();
            $data = code_msg(1);
            $data['data'] = $info;
            return $data;
        }
        
        $info = $this->where(['quser_id'=> $data['quser_id']])
            ->page($data['page'],20)
            ->select();
        if(!empty($info)){
            foreach($info as $k => $v){
                $qstockservices_data = Db::name('qstockservices_data')->where('id',$v['qstockservices_id'])->field('bid,regularMarketChangePercent')->find();
                $info[$k]['bid'] = $qstockservices_data['bid'];
                $info[$k]['regularMarketChangePercent'] = $qstockservices_data['regularMarketChangePercent'];
            }
        }
        $res = code_msg(1);
        $res['data'] = $info;
        return $res;
    }    
    
    /**
     * 添加用户股票基金
     * @param type $data
     * @return boolean
     */
    public function addManager($data){
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        // $data['quser_id'] = empty( Session::get(bianliang(1)) ) ? $data['quser_id'] : Session::get(bianliang(1)) ;
        $id = $this->where(['quser_id'=>$data['quser_id'] ,'systexId'=>$data['systexId']])->value('id');
        if($id > 0){
            return code_msg(10);//基金已添加
        }
        $arr = Db::name('qstockservices')->where('id',$data['qstockservices_id'])->find();
        $arr['quser_id'] = $data['quser_id'];
        $arr['qstockservices_id'] = $data['qstockservices_id'];
        unset($arr['id']);
        $id               = $this->allowField(true)->save($arr);
        if ($id) {
            return code_msg(1);// 成功
        }
        return code_msg(2);// 失败
    }
    
    /**
     * 删除用户股票基金
     * @param type $data
     * @return boolean
     */
    public function delManager($data){
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        // $quser_id=  Session::get(bianliang(1));
        $res = $this->where(['id'=>$data['id']])->delete();
        if($res){
            return code_msg(1);// 成功
        }
        return code_msg(8);// 失败
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}