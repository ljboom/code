<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use think\Request;
use app\admin\model\AdminLog as LogModel;

/**
 * 系统日志控制器
 * @package app\admin\controller
 */
class Log extends Admin
{
    /**
     * 系统日志首页
     */
    public function index()
    {
        if (ADMIN_GID != 1) {
            $data = LogModel::where(['uid' => ADMIN_UID])->select();
        } else {
            $data = LogModel::select();
        }

        $this->assign('data', $data);
        return $this->fetch();
    }


    /**
     * 删除日志
     */
    public function delete($id='',$type='')
    {
        if($type=='all'){
            if (ADMIN_GID != 1) {
                $result = LogModel::where('uid', ADMIN_UID)->delete();
            } else {
                $result = LogModel::where('id','>',1)->delete();
            }
        }
        if(isset($result)){
            return apiRule(true,'操作成功',$result);
        }
        return apiRule(false,'操作失败',$result);
    }
}
