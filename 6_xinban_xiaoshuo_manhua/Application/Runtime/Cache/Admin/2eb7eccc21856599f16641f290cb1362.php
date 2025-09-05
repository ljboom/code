<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>管理后台</title>
<link rel="stylesheet" href="/Public/admin/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="/Public/plugins/bootstrap/css/bootstrap.font.css" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" src="/Public/admin/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="/Public/admin/js/custom/general.js"></script>

<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="js/plugins/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body class="withvernav">
<div class="bodywrapper">
    <div class="topheader" style="border-bottom: #009688 solid 2px;">
        <div class="left">
            <h1 class="logo"><?php echo ($_site['name']); ?><span></span></h1>
            <span class="slogan" style=" border-left-color:#396F08; color:#fff">后台管理系统</span>
                 
            <br clear="all" />
            
        </div><!--left-->
		<div class="right">
        	 <span style=" color:#fff;"><?php echo session('admin.nickname');?> <a href="<?php echo U('Index/logout');?>" style=" color:#ccc;">[退出]</a></span>
        </div><!--right-->

    </div><!--topheader-->
    
    <style>
	.vernav2 span.text{ padding-left:10px;}
	.menucoll2 span.text{ display:none;}
	.menucoll2>ul>li>a{ width:12px; padding:9px 10px; !important;}
	.dataTables_paginate a{ padding:0 10px;}
	</style>
    <div class="vernav2 iconmenu">
    	<ul>
		
        	<li>
				<a href="#formsub">
					<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
					<span class="text">系统设置</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="formsub">
               		<li><a href="<?php echo U('Config/site');?>">站点设置</a></li>
                    <li><a href="<?php echo U('Config/dist');?>">分销设置</a></li>
					<li><a href="<?php echo U('Config/yyb');?>">优云宝设置</a></li>
                    <li><a href="<?php echo U('Config/charge');?>">充值赠送设置</a></li>
					<li><a href="<?php echo U('Config/send');?>">打赏赠送设置</a></li>
					<li><a href="<?php echo U('Config/ads');?>">广告设置</a></li>					
					<li><a href="<?php echo U('Config/user');?>">修改密码</a></li>
                </ul>
            </li>

			<li>
				<a href="#gzh">
					<span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
					<span class="text">公众号设置</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="gzh">
					<li><a href="<?php echo U('Config/mp');?>">公众号配置</a></li>
					<li><a href="<?php echo U('Autoreply/index');?>">自动回复管理</a></li>
                    <li><a href="<?php echo U('Selfmenu/index');?>">公众号菜单管理</a></li>
					<li><a href="<?php echo U('Config/share');?>">微信分享设置</a></li>
                </ul>
            </li>
		
			
			<li>
				<a href="#finance" class="elements">
					<span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
					<span class="text">系统财务</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="finance">
				    <li><a href="<?php echo U('Withdraw/index');?>">用户提现管理</a></li>
				    <li><a href="<?php echo U('Charge/index');?>">用户充值记录</a></li>
					<li><a href="<?php echo U('Finance/share');?>">用户分享获币记录</a></li>
					<li><a href="<?php echo U('Finance/pay');?>">一键转账</a></li>
					<li><a href="<?php echo U('Finance/finance_log');?>">用户账户变动记录</a></li>
					<li><a href="<?php echo U('Finance/separate_log');?>">代理佣金分成记录</a></li>					
					<li><a href="<?php echo U('Finance/mch_pay_log');?>">转账记录</a></li>
                </ul>
            </li>
			
					
			
			<li>
				<a href="#user" class="typo">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					<span class="text">用户管理</span>
				</a>
				
				<span class="arrow"></span>
				<ul id="user">
					<li><a href="<?php echo U('User/index');?>">用户信息管理</a></li>
					<li><a href="<?php echo U('Report/index');?>">用户新增报表</a></li>
					<li><a href="<?php echo U('Tree/index');?>">用户树形关系</a></li>
                </ul>
				
            </li>
           
			<!--i>
				<a href="#gbal" class="support">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					<span class="text">股东分红</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="gbal">
					<li><a href="<?php echo U('Reward/index');?>">分红记录</a></li>
					<li><a href="<?php echo U('Reward/edit');?>">发放分红</a></li>
                </ul>
            </li-->
			
			
			
			<li>
				<a href="<?php echo U('Member/index');?>">
					<span class="glyphicon glyphicon-eur" aria-hidden="true"></span>
					<span class="text">代理管理</span>
				</a>
            </li>
			
			
			<li>
				<a href="<?php echo U('Notice/index');?>" class="editor">
					<span class="glyphicon glyphicon-volume-down" aria-hidden="true"></span>
					<span class="text">公告管理</span>
				</a>
            </li>
			
			<li>
				<a href="<?php echo U('Custom/index');?>" class="typo">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					<span class="text">群发消息</span>
				</a>
            </li>
			
			<li>
				<a href="<?php echo U('Jub/index');?>" class="typo">
					<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
					<span class="text">举报管理</span>
				</a>
            </li>
			<li>
				<a href="<?php echo U('Fank/index');?>" class="typo">
					<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
					<span class="text">反馈管理</span>
				</a>
            </li>
			
			<li>
				<a href="#book" class="elements">
					<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
					<span class="text">小说管理</span>
				</a>
				<span class="arrow"></span>
            	<ul id="book">
					<li><a href="<?php echo U('Config/xbanner');?>">轮播图设置</a></li>
					<li><a href="<?php echo U('Config/bookcate');?>">分类设置</a></li>
               		<li><a href="<?php echo U('Book/index');?>">小说管理</a></li>
                </ul>
            </li>
		
			<li>
				<a href="#mh" class="elements">
					<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
					<span class="text">漫画管理</span>
				</a>
				<span class="arrow"></span>
            	<ul id="mh">
					<li><a href="<?php echo U('Config/banner');?>">轮播图设置</a></li>
					<li><a href="<?php echo U('Config/mhcate');?>">分类设置</a></li>
               		<li><a href="<?php echo U('Product/index');?>">漫画管理</a></li>
                </ul>
            </li>
			<li>
				<a href="#ysbook" class="elements">
					<span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span>
					<span class="text">听书管理</span>
				</a>
				<span class="arrow"></span>
            	<ul id="ysbook">
					<li><a href="<?php echo U('Config/ybanner');?>">轮播图设置</a></li>
					<li><a href="<?php echo U('Config/yook');?>">分类设置</a></li>
               		<li><a href="<?php echo U('Yook/index');?>">听书管理</a></li>
                </ul>
            </li>
            <li>
				<a href="#video" class="typo">
					<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
					<span class="text">动漫管理</span>
				</a>
              	<span class="arrow"></span>
              	<ul id="video">
					<li><a href="<?php echo U('Config/vbanner');?>">轮播图设置</a></li>
					<li><a href="<?php echo U('Config/video');?>">分类设置</a></li>
               		<li><a href="<?php echo U('Video/index');?>">动漫管理</a></li>
                </ul>
            </li>
			<li>
				<a href="#Chapter" class="elements">
					<span class="glyphicon glyphicon-import" aria-hidden="true"></span>
					<span class="text">文案制作</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="Chapter">
					<li><a href="<?php echo U('Chapter/index');?>">漫画文案</a></li>
               		<li><a href="<?php echo U('Bhapter/index');?>">小说文案</a></li>
                </ul>
            </li> 
			<li>
				<a href="<?php echo U('Chapurl/index');?>" class="addons">
					<span class="glyphicon glyphicon-share" aria-hidden="true"></span>
					<span class="text">文案链接</span>
				</a>
            </li>
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
        
    <div class="centercontent">
		<style>
#upload_form {
    padding: 50px;
}
.til{
    height: 40px;
    line-height: 40px;
    background: #D85046;
    padding-left: 0%;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
}
#file{
	height: 30px;
    line-height: 30px;
    margin-top: 20px;
}
form a{
    width: auto;
    margin: 0;
    font-weight: bold;
    color: #eee;
    background: #FB9337;
    border: 1px solid #F0882C;
    padding: 7px 10px;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    cursor: pointer;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
}
</style>


<form id="upload_form" name="upload_form" action="javascript:init();" method="post" enctype="multipart/form-data" style="background:#fff">
    <div class="til" >
        <label for="file">
            请选择视频文件
        </label>
        <!-- &nbsp;上传到的地址为/upload/类型/文件名 -->
    </div>
    <div>
		<div style="margin-top:10px;">
		视频标题：<input type="text" id="title" name="title" style="width:300px;padding-left:10px;" placeholder="请输入演示视频标题" />
		</div>
		<div style="margin-top:10px;">
		视频作者：<input type="text" id="author" name="author" style="width:300px;padding-left:10px;" placeholder="请输入演示视频作者" />
		</div>
		<div>
		试看时间（秒）：<input type="text" id="trytime" name="trytime" style="width:300px;padding-left:10px;" placeholder="请输入试看时间（秒）" />
		</div>
		<div>
		销售价格：<input type="text" id="price" name="price" style="width:300px;padding-left:10px;" placeholder="请输入销售价格" />
		</div>
		<!-- <div style="margin-top:10px;">
		视频标签：<input type="text" id="title" name="title" style="width:300px;padding-left:10px;" placeholder="请输入演示视频名称" />
		</div> -->
		<div style="margin-top:10px;">
		视频简介：<input type="text" id="summary" name="summary" style="width:300px;padding-left:10px;" placeholder="请输入演示视频简介" />
		</div>
		<div style="margin-top:10px;">
		视频排序：<input type="text" id="sort" name="sort" style="width:300px;padding-left:10px;" placeholder="请输入演示视频排序，越大越前，默认10" />
		</div>
		<!-- <div style="margin-top:10px;">
		外链地址：<input type="text" id="urls" name="urls" style="width:300px;padding-left:10px;" placeholder="请输入外链地址" />
		</div> -->
		<div style="margin-top:10px;">
		视频封面图（用于列表）：	<iframe src="<?php echo U('Admin/upload', array('event'=>'setPic1'));?>" scrolling="no" width="75" height="100"></iframe>
						<input type="hidden" name="cover_pic" id="cover_pic" value="" class="smallinput" />
						<script>
						function setPic1(url){
							document.getElementById('cover_pic').value = url;
						}
						</script>
		</div>
		<!-- <div style="margin-top:10px;">
		分享图标：&nbsp;&nbsp;&nbsp;&nbsp;		
						<iframe src="<?php echo U('Admin/upload', array('event'=>'setPic2'));?>" scrolling="no" width="100" height="100"></iframe>
						<input type="hidden" name="pic2" id="pic2"  class="smallinput" />
						<script>
						function setPic2(url){
							document.getElementById('pic2').value = url;
						}
						</script>
		</div> -->
		
        <input type="file" id="file" name="file" onchange="fileReady()" />
        <div style="margin-top: 20px;">
            <input type="submit" id="submit" name="submit" style="width:80px;" value="上传">
            <button id="clear" onclick="clearUploadFile()" style="width:80px;">
                清除
            </button>
			<a href="<?php echo U('index');?>" style="width:80px;">
                返回
            </a>
            <div class="upload_message_show">
                <!--进度条-->
                <div class="upload_bar_box">
                    <div class="upload_bar">
                    </div>
                    <span class="upload_percent">
                    </span>
                </div>
                <!--上传剩余时间和上传速度-->
                <div class="upload_count">
                    <div class="left_time">
                        剩余时间 | 00:00:00
                    </div>
                    <div class="speed">
                        100k/s
                    </div>
                </div>
                <!--文件信息-->
                <div class="upload_file_message">
                    <div class="message_box">
                        <div class="upload_file_name">
                        </div>
                        <div class="upload_file_size">
                        </div>
                        <div class="upload_file_type">
                        </div>
                        <div class="upload_file_error">
                        </div>
                        <div class="isCompleted">
                        </div>
                    </div>
                </div>
				<div id="package_url"></div>
            </div>
		</form>
	</div>
	<img src="" id="compressTemp" style="display:none;">
	<canvas id="canvas" style="display:none;"></canvas>
</div>
<script type="text/javascript" src="/Public/js/html5_upload_ano.js"></script>
 </body>
</html>

	</div><!-- centercontent -->
</div><!--bodywrapper-->
<script>
	jQuery(document).ready(function(e){
		// 菜单添加提示 
		$ = jQuery;
		
		// 根据cookie打开对应的菜单
		if($.cookie('curIndex')){
			console.log($.cookie('curIndex'));
			$(".vernav2>ul>li").eq($.cookie('curIndex')).find('ul').show();
		}
		
		$(".vernav2 ul li").each(function(index, el){
			$(this).attr('title', $(this).find("a").find('span.text').text());
			
		});
		
		$(".vernav2>ul>li>a").each(function(index,el){
			$(el).on('click',function(e){
				$.cookie('curIndex',$(this).parent('li').index());
			});
		});
		
		// 调整默认选择内容
		$("select").each(function(index, element) {
			$(element).find("option[value='"+$(this).attr('default')+"']").attr('selected','selected');
		});
		// 调整提示内容
	});
</script>
</body>
</html>