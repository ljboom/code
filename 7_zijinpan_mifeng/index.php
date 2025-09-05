<?php 
header("Location: /member/login.php"); 
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/member/logged_data.php';
?><!DOCTYPE html>
<html lang="zh-CN"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $webInfo['h_webName']; ?></title>
    <link rel="stylesheet" href="/ui/css/bootstrap.min.css">
    <link href="/ui/css/css.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="/ui/js/html5shiv.min.js"></script>
      <script src="/ui/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
  body{ min-width:320px; background:#2fa0f0}
  .image{ text-align:center; margin-bottom:50px}
  .an{margin:0px auto 0 auto;  text-align:center;}
  .btn-danger{  background:#FF4400;}
  .btn-danger:hover{background:#F22D00;}
  .btn-danger:focus{background:#F22D00;}
  @media (max-width: 500px) {
	   .image img{ width:100%; height:auto;}
	   }
  </style>
  <body>
  <div class="image"><img src="/ui/images/a2.png"></div>
  <div class="an"><a class="btn btn-danger btn-lg" href="/member/login.php" target="_blank"> 会员登录 </a>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a class="btn btn-danger btn-lg" href="/app/" target="_blank"> APP下载 </a></div>
    <script src="/ui/js/jquery.min.js"></script>
    <script src="/ui/js/bootstrap.min.js"></script>
    <script src="/ui/js/jquery.backstretch.min.js"></script> 
  </body>
</html>