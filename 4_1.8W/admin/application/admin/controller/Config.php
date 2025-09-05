<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use think\Request;
use app\admin\model\AdminConfig as ConfigModel;

/**
 * 后台参数配置控制器
 * @package app\admin\controller
 */
class Config extends Admin
{
    /**
     * 显示资源列表
     * @return string
     */
    public function index()
    {
        $ConfigModel = new ConfigModel();

        if ($this->request->isPost()) {
            $data = $this->request->post();
            
            unset($data['group']);
            $dataKye = array_keys($data);
            
            foreach ($dataKye as $value) {
                ConfigModel::update([ 'value' => $data[$value] ],[ 'name' => $value ]);
            }

            // 更新配置信息和缓存
            $systemConfig = ConfigModel::column('value', 'name');
            cache('system_config', $systemConfig);
            config($systemConfig, 'app');
            
            apiRule(true, '操作成功');
        } else {
            // 标题组装成一个二位数组
            // 变成一个二维数组输出到页面上。键：分组名；值：记录。查询二维数组，利用foreach进行重新排列
            $subTitle = $ConfigModel->subTtile();
            $groupList = $ConfigModel->list();
            $configList = $ConfigModel::column('type,name','id');
            
            // echo "<pre>";
            // var_dump($groupList);die;
           
            $this->assign('sub_title', $subTitle);
            $this->assign('group_list', $groupList);
            $this->assign('config_list', $configList);
            return $this->fetch();
        }
    }


}
