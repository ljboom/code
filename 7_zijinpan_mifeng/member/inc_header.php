<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/member/logged_data.php';
//echo $memberLogged_userName . '|' . $memberLogged_passWord;exit;
if(!$memberLogged){
	redirect('/member/login.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pager.php';
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $pageTitle . $webInfo['h_webName'] . ' - ' . 蜜蜂赚最稳定的理财平台; ?></title>
<meta name="keywords" content="<?php echo $webInfo['h_keyword']; ?>" />
<meta name="description" content="<?php echo $webInfo['h_description']; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
<link rel="stylesheet" href="/ui/css/bootstrap.min.css">
<link href="/ui/css/css.css" rel="stylesheet">
<script type="text/javascript" src="/ui/js/jquery.min.js"></script>
<script type="text/javascript" src="/ui/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/ui/layer/layer.js"></script>
<script type="text/javascript" src="/ui/js/long.js"></script>

<link type="text/css" href="/ui/css/style111.css" rel="stylesheet">
<link href="/css/mstyle.css" rel="stylesheet" type="text/css" />
<link href="/ui/css/component.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/ui/js/jquery.js"></script>
<script type="text/javascript" src="/ui/js/modernizr.custom.js"></script>
<script type="text/javascript" src="/ui/js/jquery.dlmenu.js"></script>

<!--[if lt IE 9]>
<script src="/ui/js/html5shiv.min.js"></script>
<script src="/ui/js/respond.min.js"></script>
<![endif]-->
	<script>
    //$(selector).toggle(speed,callback);
    </script>
    <!--LEFT End-->
<body style="text-align:center;">
    <div style="margin:0px auto">
