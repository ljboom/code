<?php

//----------------------------------
// 授权页面 请勿修改 为了防止一些人的转载和程序的泛滥 极个别源码需要授权 绝对不包含任何后门和木马 请放心使用
//----------------------------------
if(isset($_GET['act']) && $_GET['act']=='save'){
	$_code = $_POST['code'];
    if(strlen($_code)!==40){exit('请输入正确的授权码');}
	$file = file(__FILE__);
	foreach($file as $k=>$v){
		if(strpos($v,'shouquan')!==false && strpos($v,'strpos')===false){
 			$_t = explode('"',$v);
			$file[$k]  = $_t[0].'"'.$_code.'"'.$_t[2];
		}
		file_put_contents(__FILE__,implode("",$file));
	}
	header("Location: index.php"); 
}
$shouquan = "cb971c5766bc34f6796791388f52b4a7578d2849";