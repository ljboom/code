<?php
require_once '../include/conn.php';
require_once '../include/webConfig.php';

$ddh=trim($_GET['ddh']); 
$money=str_replace(',', '', trim($_GET['money']));
$name=trim($_GET['name']); 
$name=str_replace("id","",$name);
$key=trim($_GET['key']); 
$lb=trim($_GET['lb']); 
$moneyy= $money;
$date1 = date('Y-m-d H:i:s',time()); //获取日期时间
if (($ddh=="") or ($money=="") or ($key=="")){
   echo "no";
   exit();	
}
	       if($lb=='1')$lbtext='支付宝充值';
           if($lb=='2')$lbtext='财付通QQ充值';
           if($lb=='3')$lbtext='微信支付充值';
		   
		   if($lb=='1')$lbtextx='2';
           if($lb=='2')$lbtextx='3';
           if($lb=='3')$lbtextx='1';
		   
 if ($key !== "2052cd88bea3f9016a0057436dbbd750"){
     echo "key no";
   }else{
       $rsO = $db->get_one("SELECT * FROM `h_pay_order` where h_orderId = '{$ddh}' LIMIT 1");
	 //  print_r($rsO);
	if($rsO==0){
		
		  $bsqlr = "insert into h_pay_order (`h_orderId`) VALUES ('$ddh')";
	      $db->query($bsqlr);
		  
		  $bsqlrr = "insert into h_log_point2 (`h_userName`,`h_price`,`h_about`,`h_addTime`,`h_actIP`,`h_type`) VALUES ('$name','$money','$lbtext','$paytime','$ip','在线充值')";
		  $db->query($bsqlrr);
		  
		  $bsqlrr = "insert into h_recharge (`h_userName`,`h_money`,`h_fee`,`h_bank`,`h_addTime`,`h_state`,`h_isReturn`,`h_bankFullname`) VALUES ('$name','$money','0','$lbtextx','$paytime','1','1','$lbtext')";
		  $db->query($bsqlrr);
		  
		  
		  $csql = "UPDATE h_member SET h_point2=h_point2+'$money' WHERE h_userName = '$name'";
	      $db->query($csql);
		  exit('ok');
	}else{
		
		exit("ddh error");
   }
   }
?>