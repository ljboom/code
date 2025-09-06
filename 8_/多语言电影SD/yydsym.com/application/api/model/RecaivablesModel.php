<?php
namespace app\api\model;

use think\model;

class RecaivablesModel extends model{
	protected $table = 'ly_recaivables';

    public function getPayBankCode(){
        $pay_id = input('post.pay_id');
        $data = $this->where(['type' => $pay_id])->field('id,bank,qrcode,name as recename,account as rececode')->select();
        return $data;
    }

	
}
