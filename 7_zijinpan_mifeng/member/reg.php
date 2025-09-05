<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/member/logged_data.php';
?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>注册用户</title>
    <link rel="stylesheet" href="/ui/css/bootstrap.min.css">
    <link href="/ui/css/css.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="/ui/js/html5shiv.min.js"></script>
      <script src="/ui/js/respond.min.js"></script>
    <![endif]-->
    <style>
    body{background:#ffa203; min-width:320px;}
    </style>
    
  </head>
  <body>
  
 
  
  
<div class="container reg">
<div class="tit"><img src="<?php echo $webInfo['h_webLogoLogin'];?>"></div>
<div class="xlogin center-block">
<div class="xlogin2 form-horizontal">
	<div class="lo1">注册新用户</div>
    

    <div class="form-group">
    <label for="comMember" class="col-sm-4 control-label">直推会员:</label>
    <div class="col-sm-8">
      <input class="form-control" id="comMember" placeholder="请输入直推人的会员编号" value="<?php echo $t; ?>" >
    </div>
  </div>    
    
    <div class="lo4"></div>
    
   <div class="form-group">
    <label for="username" class="col-sm-4 control-label">会员账号:</label>
    <div class="col-sm-8">
      <input class="form-control" id="username" placeholder="只能使用您的手机号码">
    </div>
  </div>
 <!----------------验证码 -----------------
  
   <div class="form-group">
             <label for="username" class="col-sm-4 control-label">
                手机验证:  </label> <div class="col-sm-8">
                <input id="phone_code" type="text" name="code" value="<?php echo isset($_POST['code']) ? $_POST['code'] : ''; ?>"/>
                <button type="button" id="get_code">获取验证码</button>
                <p id="phone_err" class="errmsg" style="margin:5px 0 0 88px; color:red;"><?php echo isset($res['code']) ? $res['code'] : ''; ?></p>
            </label>
  
  
 </div>-->
 </div>
  
  
  <div class="form-group">
    <label for="pwd" class="col-sm-4 control-label">登录密码:</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="pwd" placeholder="6-32位任意字符">
    </div>
  </div>
  
    <div class="form-group">
    <label for="pwd2" class="col-sm-4 control-label">确认密码:</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="pwd2" placeholder="请再次输入您的登录密码">
    </div>
  </div>
  
<!--  <div class="lo4"></div>
  
  <div class="form-group">
    <label for="x5" class="col-sm-4 control-label">玩家姓名:</label>
    <div class="col-sm-8">
      <input class="form-control" id="x5" placeholder="请输入您的姓名">
    </div>
  </div>
 
  <div class="form-group">
    <label for="x6" class="col-sm-4 control-label">安全问题:</label>
     <div class="col-sm-8">
		<select class="form-control" id="x6">
             <option value="" selected >请选择安全问题...</option>
             <option value="您的生日是什么时间？" >您的生日是什么时间？</option>
             <option value="您的爱人叫什么名字？" >您的爱人叫什么名字？</option>
             <option value="您最喜欢的是什么？" >您最喜欢的是什么？</option>
             <option value="您的父亲的姓名是什么？" >您的父亲的姓名是什么？</option>
             <option value="您的母亲的姓名是什么？" >您的母亲的姓名是什么？</option>
             <option value="您的小学名称叫什么名字？" >您的小学名称叫什么名字？</option>
		</select>
    </div>
  </div>
    
  <div class="form-group">
    <label for="x7" class="col-sm-4 control-label">安全答案:</label>
    <div class="col-sm-8">
      <input class="form-control" id="x7" placeholder="请输入您的身份证号码">
    </div>
  </div>
  
  <div class="lo4"></div>
    
  <div class="form-group">
    <label for="pwdII" class="col-sm-4 control-label">资金密码:</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="pwdII" placeholder="6-32位任意字符">
    </div>
  </div>
  
    <div class="form-group">
    <label for="pwdII2" class="col-sm-4 control-label">确认密码:</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="pwdII2" placeholder="请再次输入您的资金密码">
    </div>
  </div>-->
    
  <div class="form-group">
    <label for="vCode" class="col-sm-4 control-label">验证码:</label>
    <div class="col-sm-4">
      <input class="form-control" id="vCode" placeholder="验证码">
    </div>
    <div class="col-sm-4">
      <img src="/include/getCode.php" width="70" height="34" id="yzmpic" class="loimg" onclick="sxyzm();"/>
    </div>     
  </div>  
  
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
      <div class="checkbox"><label><input type="checkbox" id="zhucetiaokuan" value="1" checked='CHECKED'> <a href="#">同意条款</a></label></div>
	</div>
    
  <div class="col-sm-4"><button type="submit" class="btn btn-primary form-control reggo">注册</button></div>
  </div> 
 <div class="lo4"></div>
 <div class="lo lo5">已经注册的有账户? <a href="/member/login.php">立即登录</a></div>
</div> 
</div>   
    
    </div>

    <script src="/ui/js/jquery.min.js"></script>
    <!--<script src="/ui/js/bootstrap.min.js"></script>-->
    <script src="/ui/js/jquery.backstretch.min.js"></script>
    <script src="/ui/layer/layer.js"></script>
    <script src="/ui/js/long.js"></script>
    
    <script>

    	$(".reggo").click(function () {
			denglu_go();
			return false;
		});	
		function denglu_go(){
			
			var comMember=$("#comMember").val();
			var username=$("#username").val();
			var pwd=$("#pwd").val();
			var pwd2=$("#pwd2").val();
			//var x5=$("#x5").val();
			//var x6=$("#x6").val();
			//var x7=$("#x7").val();
			var pwdII=$("#pwdII").val();
			var pwdII2=$("#pwdII2").val();
			var vCode=$("#vCode").val();
			var phone_code=$("#phone_code").val();
			if(comMember==""){
				tishi4('请输入直推人编号','#comMember')
				return false;
				}
			if(!checkMobile(comMember)){
				tishi4('直推人编号不正确,应该是手机号码形式的11位数字','#comMember')
				return false;
				}
			if(username==""){
				tishi4('请填写您自己的编号','#username')
				return false;
				}			
			if(!checkMobile(username)){
				tishi4('编号请填写您的手机号码,请勿用其他格式','#username')
				return false;
				}
/*			if(phone_code==""){
				tishi4('请输入手机验证码','#phone_code')
				return false;
				}*/
			if(!checkPwd(pwd)){
				tishi4('请输入6-30位密码','#pwd')
				return false;
				}
			if(pwd!=pwd2){
				tishi4('两次密码输入的不一样','#pwd2')
				return false;
				}				

/*			if(!checkName(x5)){
				tishi4('请输入您的姓名,最多10位','#x5')
				return false;
				}							

			if(x6==""){
				tishi4('请选择您的安全问题','#x6')
				return false;
				}	

			if(x7==""){
				tishi4('请输入您的密保信息,密码忘记时候,这是您取回密码的凭证','#x7')
				return false;
				}
				
			if(!checkPwd(pwdII)){
				tishi4('请输入6-30位的安全密码','#pwdII')
				return false;
				}
			if(pwdII!=pwdII2){
				tishi4('两次密码输入的不一样','#pwdII2')
				return false;
				}*/
								
			if(vCode==""){
				tishi4('请输入您的验证码','#vCode')
				return false;
				}				

			var url="/member/bin.php?act=reg&comMember="+encodeURI(comMember)+"&username="+encodeURI(username)+"&pwd="+encodeURI(pwd)+"&pwd2="+encodeURI(pwd2)+"&pwdII="+encodeURI(pwdII)+"&pwdII2="+encodeURI(pwdII2)+"&vCode="+encodeURI(vCode)+"&phone_code="+encodeURI(phone_code);
			tishi2();
			$.ajax({ type : "get", async:true,  url : url, dataType : "json",
				success: function(json){
					tishi2close();
					if(json.state == true){
						layer.alert(json.msg,function(){
							//跳转
							window.location.href = '/';
						});
						
					} else {
						layer.alert(json.msg);
					}
				},
				error:function(json){
					tishi2close();
					layer.alert('网络错误，请重新提交');
				}
			});
		}
		
/*		 $.backstretch(["/ui/images/dl.jpg"], {
		          fade: 100,
		         duration: 100
		      });*/
			  
	$(document).ready(function(){
		var lesstime=0;
		var wait = function(lesstime){
			if (lesstime < 1) {
				$("#get_code").removeAttr("disabled").text('重发短信验证码');
			}else{
				$("#get_code").attr("disabled", true).text(lesstime + '秒');
				lesstime--;
				setTimeout(function (){wait(lesstime);}, 1000);
			}
		}

		$("#get_code").click(function(){
			$.get("public.php?act=smscode",{phone:$('#username').val()},function(res){
				if(res.status==1){
					wait(30);
				}else{
					layer.alert(res.info);
				}
			},'json');
		});
	});
    </script>
  </body>
</html>