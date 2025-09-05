<?php
namespace app\member\controller;

use app\common\controller\Adminbase;
use app\index\model\DamowProductModel; //产品表
use think\Validate;

class Damowproduct extends Adminbase
{
    protected $DamowProductModel;
    //初始化
    protected function initialize()
    {
        parent::initialize();
        $this->modelClass = new DamowProductModel;
    }


    public function index(){
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $_list                      = $this->modelClass->where($where)->page($page, $limit)->order('id desc')->select();
            foreach ($_list as $k=>$item){
                $_list[$k]['status'] = $item['status']==1?'打開':'關閉';
                $_list[$k]['day_rate'] = strval($item['day_rate']);
            }
            $total                      = $this->modelClass->where($where)->count();
            $result                     = array("code" => 0, "count" => $total, "data" => $_list);
            return json($result);
        }
        return $this->fetch();
    }



    public function add()
    {
        if ($this->request->isPost()) {
            $data   = $this->request->post();
//            $data['image'] = $this->request->domain().$data['image'];
            $rule = [
                'product_name'  => 'require|max:120',
                'image'         => 'require',
                'day_rate'      => 'require|float',
                'day'           => 'require|number',
                'start_price'   => 'require|float',
            ];
            $msg = [
                'product_name.require'  => '項目名稱必须',
                'product_name.max'      => '項目名稱最多不能超过120个字符',
                'image.require'         => '圖片必須有',
                'day_rate.require'      => '日利率必須有',
                'day_rate.float'     => '日利率格式有誤',
                'day.require'           => '週期必須有',
                'day.number'            => '週期天數有誤',
                'start_price.require'   => '起始金額必須有',
                'start_price.float'     => '起始金額格式有誤',
                'status.require'        => '狀態必須有',
            ];
            if(isset($data['investment_count']) && $data['investment_count']<1){
                $this->error('最低投資數量為1');
            }
            $validate = new Validate($rule,$msg);
            $result   = $validate->check($data);

            if(true !== $result){
                $this->error($validate->getError());
            }
            $DamowProductModel = new DamowProductModel();
            $data['day_rate']= $data['day_rate']/100;
            $data['create_at'] = date('Y-m-d H:i:s',time());
            $data['update_at'] = date('Y-m-d H:i:s',time());
            $DamowProductModel->data($data)->save();

            $this->success("添加成功！", url("damow_product/index"));
        } else {
            return $this->fetch();
        }
        return parent::add();
    }



    public function edit(){
        if ($this->request->isPost()) {
            $data   = $this->request->post();
            $rule = [
                'product_name'  => 'require|max:120',
                'image'         => 'require',
                'day_rate'      => 'require|float',
                'day'           => 'require|number',
                'start_price'   => 'require|float',
            ];
            $msg = [
                'product_name.require'  => '項目名稱必须',
                'product_name.max'      => '項目名稱最多不能超过120个字符',
                'image.require'         => '圖片必須有',
                'day_rate.require'      => '日利率必須有',
                'day_rate.float'     => '日利率格式有誤',
                'day.require'           => '週期必須有',
                'day.number'            => '週期天數有誤',
                'start_price.require'   => '起始金額必須有',
                'start_price.float'     => '起始金額格式有誤',
                'status.require'        => '狀態必須有',
            ];
            if(isset($data['investment_count']) && $data['investment_count']<1){
                $this->error('最低投資數量為1');
            }
            $validate = new Validate($rule,$msg);
            $result   = $validate->check($data);
            if(true !== $result){
                $this->error($validate->getError());
            }
            $DamowProductModel = new DamowProductModel();
            $data['day_rate']= $data['day_rate']/100;
            $data['update_at'] = date('Y-m-d H:i:s',time());
            $res = $DamowProductModel->update($data);

            if(!empty($res)){
                $this->success("编辑成功！", url("damow_product/index"));
            }else{
                $this->error("编辑失敗！");
            }
        }else {
            $arr['product_id'] = $this->request->param('id/d', 0);
            $data  =  $this->modelClass->infoManager($arr);
            if ($data['code'] != 200) {
                $this->error("该项目不存在！");
            }
            $data = $data['data']->toArray();
            $this->assign("data", $data);
            return $this->fetch();
        }
    }


    public function del()
    {
        $data = input('get.');
        $DamowProductModel = new DamowProductModel();
        $res = $DamowProductModel->destroy($data['id']);
        if($res == 200){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }




}