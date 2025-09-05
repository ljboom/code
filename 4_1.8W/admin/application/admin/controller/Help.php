<?php
namespace app\admin\controller;
use app\common\controller\Admin;

use think\Db;
/**
 * 帮助中心
 * @package app\admin\controller
 */
class Help extends Admin
{
    
   /**
    * 意见反馈列表
    */ 
    public function feedbackList()
    {
       $param = $this->request->param();
        // 非超级管理员检查可管理角色、用户
        if (ADMIN_GID != 1) {
            $groupId = AuthGroupModel::getTreeGetChildsId(ADMIN_GID,2);
           
            $where = "group_id IN ({$groupId})";
            $whereGroup = "id IN ({$groupId})";
        }else{
            $where = $whereGroup = 1;
        }
       if(!isset($search['keyword'])){
           $search['keyword'] = '';
       }
        $search['status'] = '';
        if (isset($param['status'])) {
            $search['status'] = $param['status'];
        }
        if (isset($param['group_id'])) {
            $search['group_id'] = $param['group_id'];
        }
        if (isset($param['type'])) {
            $search['type'] = $param['type'];
        }
        if (isset($param['keyword'])) {
            $search['keyword'] = $param['keyword'];
        }
        if (isset($param['data_start'])) {
            $search['data_start'] = $param['data_start'];
        }
        if (isset($param['data_end'])) {
            $search['data_end'] = $param['data_end'];
        }

       
        if ($search['keyword']) {
            $keyword = "'%" . $search['keyword'] . "%'";
            if ($search['type'] == 1) {
                $where .= " and r.id = " . "{$search['keyword']}";
            } elseif ($search['type'] == 2) {
                $where .= " and u.mobile like " . $keyword;
            }  
        }
       // var_dump($where);die;

        if (!empty($search['status'])) {
            $where .= " and r.status =" . $search['status'];
        }
        // if (!empty($search['group_id'])) {
        //     $where .= " and `group_id` =" . $search['group_id'];
        // }
        if (!empty($search['data_start'])) {
            $where .= " and r.createtime >= '" . strtotime($search['data_start']) . "'";
        }
        if (!empty($search['data_end'])) {
            $where .= " and r.createtime <= '" . strtotime($search['data_end']) . "'";
        }
        
        
        $list = Db::table('me_feedback')
                ->alias('r')
                ->join('me_users u', 'r.user_id = u.id')
                ->field('r.*,u.mobile')
                ->where($where)
                ->order('createtime desc')
                ->paginate(20, false, ['query' => $search]);


        // 获取分页显示
        $page = $list->render();

        // $roleList = AuthGroupModel::where($whereGroup)->column('name', 'id');
        // 模板变量赋值
        $this->assign('list', $list);
      //  $this->assign('role_list', $roleList);
        $this->assign('page', $page);
        return $this->fetch();
    }
    
    /**
      * 意见反馈审核
      */ 
    public function feedback_editStatus()
    {   
        if(!$this->request->isAjax()){
            $this->error("操作太频繁，请稍后操作!");
        }
        
        if ($this->request->isGet()) {
            $ids = $this->request->param('id');
            $type = $this->request->param('type');
            $ids = explode(",", $ids);
        }
         if ($this->request->isPost()) {
            $ids = $this->request->post('ids');
            $type = $this->request->param('type');
        }
       
         
        foreach($ids as $v){
            if($type == 2){
                $me_feedback = Db::table('me_feedback')->where('id',$v)->find();
               Db::table('me_feedback')->where('id',$v)->update(['status' => $type,'checktime'=>time()]); 
                //加入日志
                 $log['user_id'] = $me_feedback['user_id'];
                 $log['content'] = "您反馈的意见".$me_feedback['content'].'处理成功';
                 $log['createtime'] = time();
                 Db::table('me_log')->insert($log);
               
            }elseif($type == 3){
                $me_feedback = Db::table('me_feedback')->where('id',$v)->find();
               
                    //加入日志
                     $log['user_id'] = $me_feedback['id'];
                     $log['content'] = "你反馈的意见，已被驳回！";
                     $log['createtime'] = time();
                     Db::table('me_log')->insert($log);
                
                Db::table('me_feedback')->where('id',$v)->update(['status' => $type,'checktime'=>time()]);
            }
            
        }
         return apiRule(true, '处理成功');
    }
}
