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
// | 股票基金model
// +----------------------------------------------------------------------
namespace app\index\model;
use app\index\model\QstockservicesData as QstockservicesDataModel;
use think\Model;
use think\Db;

class Qstockservices extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $name   = 'qstockservices';
    // protected $is_show = ['is_show' => 1];

    public function getLastLoginTimeAttr($value)
    {
        return date('Y-m-d H:i:s', $value);
    }
    
    
    /**
     * 查詢股票基金
     * @param type $data
     * @return boolean
     */
    public function new_selManager($data){
        // $data['where'] = '1101';
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        if(!empty($data['sectorId'])){
            $where['sectorId'] = $data['sectorId'];//分类编号
        }
        if(!empty($data['exchange'])){
            if ( $data['exchange'] == 'TAI' )  {
                $data['exchange'] = 'tse';
            }
            if ( $data['exchange'] == 'TWO' )  {
                $data['exchange'] = 'otc';
            }
            $where['exchange'] = $data['exchange'];//TAI=上市,TWO=上柜
        }
        $where['is_show'] = 1;
        $QstockservicesDataModel = new QstockservicesDataModel();
        if(!empty($data['where'])){
            $whereLike = $data['where'];
            // dump($likewhere);
            $info = $this
                ->where(function ($query) use ($whereLike) {
                    $query->where('is_show',1)->where('symbolName','like',"%$whereLike%");
                })->whereOr(function ($query) use ($whereLike) {
                    $query->where('is_show',1)->where('symbol','like',"%$whereLike%");
                })
                ->field('id,sectorId,sectorName,symbol,symbolName,systexId,exchange')
                ->page($data['page'],20)
                // ->fetchSql(true)
                ->select()
                ->toArray()
                ;
            // dump($info);exit;
            $info = $QstockservicesDataModel->get_list($info);
            
            $res = code_msg(1);
            $res['data'] = $info;
            return $res;
        }
        
        $info = $this->where($where)
            ->field('id,sectorId,sectorName,symbol,symbolName,systexId,exchange')
            ->page($data['page'],20)
            ->select()->toArray();
        $info = $QstockservicesDataModel->get_list($info);
        $res = code_msg(1);
        $res['data'] = $info;
        return $res;
    }
    
    
    /**
     * 查詢股票基金
     * @param type $data
     * @return boolean
     */
    public function selManager($data){
        // $data['exchange'] = 'TAI';
        // $data['where'] = '元大';
        if (empty($data) || !is_array($data)) {
            return code_msg(3);// 没有数据
        }
        if(!empty($data['sectorId'])){
            $where['sectorId'] = $data['sectorId'];//分类编号
        }
        if(!empty($data['exchange'])){
            if ( $data['exchange'] == 'TAI' )  {
                $data['exchange'] = 'tse';
            }
            if ( $data['exchange'] == 'TWO' )  {
                $data['exchange'] = 'otc';
            }
            $where['exchange'] = $data['exchange'];//TAI=上市,TWO=上柜
        }
        $where['is_show'] = 1;
        if(!empty($data['where'])){
            $whereLike = $data['where'];
            $info = $this
                ->where('is_show',1)
                ->where('symbolName','like',"%$whereLike%")
                ->whereOr('symbol','like',"%$whereLike%")
                ->field('id,sectorId,sectorName,symbol,symbolName,systexId,exchange')
                ->page($data['page'],20)
                // ->fetchSql(true)
                ->select()
                ->toArray()
                ;
            // dump($info);exit;
            if(!empty($info)){
                foreach($info as $k => $v){
                    $qstockservices_data = Db::name('qstockservices_data')->where('id',$v['id'])->field('bid,regularMarketChangePercent')->find();
                    $info[$k]['bid'] = $qstockservices_data['bid'];
                    $info[$k]['regularMarketChangePercent'] = $qstockservices_data['regularMarketChangePercent'];
                }
            }
            // dump($res);
            $res = code_msg(1);
            $res['data'] = $info;
            return $res;
        }
        
        $info = $this->where($where)
            ->field('id,sectorId,sectorName,symbol,symbolName,systexId,exchange')
            ->page($data['page'],20)
            ->select()->toArray();
            
        foreach($info as $k => $v){
            $qstockservices_data = Db::name('qstockservices_data')->where('id',$v['id'])->field('bid,regularMarketChangePercent')->find();
            $info[$k]['bid'] = $qstockservices_data['bid'];
            $info[$k]['regularMarketChangePercent'] = $qstockservices_data['regularMarketChangePercent'];
        }
        $res = code_msg(1);
        $res['data'] = $info;
        return $res;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}