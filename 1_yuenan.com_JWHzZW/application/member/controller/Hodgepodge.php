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
// | 大杂烩
// |    系统设置 
// | 
// | 
// | 
// | 
// +----------------------------------------------------------------------
namespace app\member\controller;

use app\admin\model\Config as ConfigModel;
use app\common\controller\Adminbase;

class Hodgepodge extends Adminbase
{
    
    protected function initialize()
    {
        // parent::initialize();
        $this->ConfigModel = new ConfigModel;
    }
    
    
    /**
     * 通道编辑
     */
    public function xtconfig(){
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $res = $this->ConfigModel->where('id',15)->update($data);
            $this->success("编辑成功！");
        }else {
            $data = $this->ConfigModel->where('id',15)->find()->toArray();
            $this->assign("data", $data);
            return $this->fetch();
        }
    }  
    
}
    