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
// | 股票基金
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\index\model\Qstockservices as QstockservicesModel;
use app\index\model\Qcategory as QcategoryModel;
use app\common\controller\Indexbase;
use think\facade\Session;

class Qstockservices extends Indexbase
{

    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new QstockservicesModel;
    }


    public function sel(){

        $arr = input('post.');
        
        if(!empty($arr['sectorId'])){
            $QcategoryModel = new QcategoryModel();
            $where = array();
            $where[] = array('category','=',$arr['exchange']);
            $where[] = array('sectorId','=',$arr['sectorId']);
            $category_data = $QcategoryModel->where($where)->find();
            if ( $category_data ) {
                $arr['sectorId'] = $category_data['id'];
            }
        }

        // $res = $this->modelClass->selManager($arr);
        $res = $this->modelClass->new_selManager($arr);

        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
        
    }
    
    public function msel(){
        $arr = input('get.');
        $res = $this->modelClass->new_selManager($arr);
        if($res['code'] == 200){
            return json_encode($res);
        }else{
            return json_encode($res);
        }
        
    }
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}