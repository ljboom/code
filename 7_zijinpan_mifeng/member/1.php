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
<title><?php echo $pageTitle . $webInfo['h_webName'] . ' - ' . 最稳定的理财平台; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<link rel=stylesheet type=text/css href="/css/user_index.css" />
<link rel="stylesheet" type="text/css" href="/css/liMarquee.css">
<script type="text/javascript" src="/js/user_index.js"></script>
<script src="/js/jquery.liMarquee.js"></script> 

<style type="text/css">
.tuichu{background:#EC1A5B;width:95%; float:left;  padding:15px 0 ; margin-left:5px; margin:5px 0 10px 10px;font-size:16px; text-align:center; color:#fff;border-radius:4px;}
.tuichu a{text-align:center; color:#fff; font-weight:600}
.xziti{font-size: 12px;color: #fe7600;}
.cefeff4{color: #ccc}
.name{text-align: center;}
.name a{color: #fff;}
.bdziti{width: 100%;height:30px;background:#f25b0f;margin-top:10px;text-align: center;}
.bdziti ul li{width:33%;float:left; height:30px; line-height:30px;}
.bdziti ul li span{color:#fff;}
.tx{width:100%; text-align:center;}
</style>