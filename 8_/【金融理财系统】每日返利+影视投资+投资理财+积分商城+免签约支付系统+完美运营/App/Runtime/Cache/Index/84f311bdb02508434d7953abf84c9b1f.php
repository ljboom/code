<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理 - 会员银行卡管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/page.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/style.css" />
    <link rel="stylesheet" href="/Public/admin/css/jquery.datetimepicker.css"/>
    <script src="/Public/admin/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/Public/admin/js/jquery.datetimepicker.js"></script>
    <script type="text/javascript" src="/Public/admin/js/public.js"></script>
</head>
<body>
<div class="main">
    <div class="main_left">
        <p class="pub_tit">后台管理系统</p>
        <ul>
            <li class="menu_index">
                <a href="<?php echo U('index');?>">工作台</a>
                <i></i>
            </li>
            <li class="menu_user">
                <p>会员管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('user_list');?>">会员列表</a>
                    <a href="<?php echo U('user_vip');?>">等级设置</a>
                    <a href="<?php echo U('user_relation');?>">会员关联网</a>
                    <a href="<?php echo U('user_yhk_list');?>">关联银行卡管理</a>
                </div>
                <i class="four"></i>
            </li>
            <li class="menu_finance">
                <p>财务管理</p>
                <div  class="son_menu">
                    <a href="<?php echo U('finance_payment');?>">充值记录</a>
                    <a href="<?php echo U('finance_invoice');?>">提现申请</a>
                    <a href="<?php echo U('finance_stream');?>">流水记录查询</a>
                </div>
                <i class="three"></i>
            </li>
            <li class="menu_project">
                <p>项目管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('project_list');?>">项目列表</a>
                    <a href="<?php echo U('project_alreay');?>">已投项目</a>
                    
                    <a href="<?php echo U('project_class');?>">项目分类</a>
                </div>
                <i class="two"></i>
            </li>
            <li class="menu_article">
                <p>文章管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('article_type');?>">文章类型</a>
                    <a href="<?php echo U('article_list');?>">文章列表</a>
                </div>
                <i class="five"></i>
            </li>
            <li class="menu_system">
                <p>系统设置</p>
                <div class="son_menu">
                    <a href="<?php echo U('system_info');?>">网站信息</a>
                    <a href="<?php echo U('system_reward');?>">奖励设置</a>
                    <a href="<?php echo U('system_banner');?>">幻灯片设置</a>
                    <a href="<?php echo U('system_contract');?>">合同章设置</a>
                    <a href="<?php echo U('system_message');?>">短信设置</a>
                    <a href="<?php echo U('system_payment');?>">支付设置</a>
                    <a href="<?php echo U('system_safe');?>">安全设置</a>
                    <a href="<?php echo U('system_pwd');?>">密码设置</a>
                    <a href="<?php echo U('system_img');?>">图片设置</a>
                    <a href="<?php echo U('system_activity');?>">活动设置</a>
                </div>
                <i class="six"></i>
            </li>
			<!--<li class="menu_goods">
                <p>商城管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('goods_list');?>">商品列表</a>
                    <a href="<?php echo U('classify');?>">商品分类</a>
                
                   
                </div>
                <i class="seven"></i>
            </li>
			<li class="menu_order">
                <p>订单管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('order',array('state'=>'1','se'=>'259'));?>">待付款</a>
                    <a href="<?php echo U('order',array('state'=>'2','se'=>'260'));?>">待发货</a>
                    <a href="<?php echo U('order',array('state'=>'3','se'=>'261'));?>">待收货</a>
                    <a href="<?php echo U('order',array('state'=>'4','se'=>'262'));?>">已完成</a>
                
                   
                </div>
                <i class="seven"></i>
            </li>
			<li class="menu_lottery">
                <p>转盘管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('lottery');?>">抽奖设置</a>
                    <a href="<?php echo U('goods_lottery');?>">抽奖名单</a>
                 
                </div>
                <i class="seven"></i>-->
            </li>
        </ul>
    </div>
    <div class="main_right">
        <div class="header">
            <!--<div class="search"><input type="text" placeholder="搜索"><i></i></div>-->
            <div class="title_right">
                <div class="act">
                    <iframe src="" height="1" width="1" frameborder="0" id="ifr"></iframe>
                    欢迎您，管理员[<?php echo ($_SESSION['isAdminUser']); ?>]<img src="/Public/admin/img/down.png">
                    <a href="<?php echo U('logout');?>" class="logout">退出</a>
                </div>
            </div>
        </div>
        <p class="curr">
            <a>会员管理</a>&gt;&gt;
            <span>会员银行卡管理</span>
        </p>
        <div class="content">
            <div class="list_main">
                <div class="title">
                    <form action="<?php echo U('user_yhk_list');?>" method="get">
                        <input type="hidden" name="online" value="<?php echo ($_GET['online']); ?>"/>
                        <p>
                           <label>用户姓名</label><input type="text" name="name" value="<?php echo ($_GET['name']); ?>" class="txt">
                           <label>手机号码</label><input type="text" name="phone" value="<?php echo ($_GET['phone']); ?>"> 
						    
                           <label>会员等级</label><!-- 
                            --><select name="member">
                               <option value="0">全部</option>
                               <?php $_result=getData('user_member','all','','','value asc');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i; if($m['id'] == $_GET['member']): ?><option value="<?php echo ($m["id"]); ?>" selected="selected"><?php echo ($m["name"]); ?></option>
                                       <?php else: ?>
                                       <option value="<?php echo ($m["id"]); ?>"><?php echo ($m["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                           </select>
                           <input type="submit" class="sub1" value="查询">
                          
                        </p>
                    </form>
                </div>
                <div class="width_table">
	                <table style="width:100%;">
	                    <tbody>
	                        <tr>
	                            <th>ID</th>
	                            <th>姓名</th>
	                            <th>手机号</th>  
	                            <th>认证身份证</th> 
	                            <th style="width:40%">银行卡列表</th>   
	                        </tr><?php  ?>
                            <?php $_result=getData('user','all',$where,$limit,'id desc');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($u["id"]); ?></td>
                                    <td><?php echo ($u["name"]); ?></td>
                                    <td><?php echo ($u["phone"]); ?></td>  
                                    <td><?php echo ($u["idcard"]); ?></td>  
                                    <td style="    line-height: 28px;">
									
									<input type="text" placeholder="输入银行卡" id="account<?php echo $u["id"];?>" />
									<input type="text" placeholder="所属银行" id="bank<?php echo $u["id"];?>" />
									<input type="button" value="新增银行卡" onclick="addyhk('<?php echo $u["id"];?>')" /> 
									
									<?php
 $blst=M("bank")->where("uid=".$u["id"])->select(); foreach($blst as $dd=>$vv){ ?>
									<div style="width:100%; margin-bottom:12px;">
									<input type="text" value="<?php echo $vv["account"];?>" id="yhk<?php echo $vv["id"];?>" />
									<input type="button" value="保存" onclick="bcyhk('<?php echo $vv["id"];?>')" />
									<input type="button" value="删除" onclick="scyhk('<?php echo $vv["id"];?>')"/>
 									 </div>
									<?php
 } ?>
									</td>  
									 
                                    
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	              
	                    </tbody>
	                </table>
                </div>
                <ul class="page">
                    <?php echo ($page); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

	function addyhk(uid){
		if(confirm("确认要新增当前用户的银行卡吗？")){
			var data={
				uid:uid,
				account:$("#account" + uid ).val(),
				bank:$("#bank" + uid ).val()
			};
			$.post("<?php echo U('user_yhk_add');?>",data,function(e){
				alert(e.msg); location.reload();
			},"json");	
		}
	}

    function bcyhk(objid){ 
		
		if(confirm("确认要编辑当前银行卡吗？")){
			var data={
				id:objid,
				id:objid,
				account:$("#yhk" + objid ).val()
			};
			
			$.post("<?php echo U('user_yhk_edit');?>",data,function(e){
				alert(e.msg); 
			},"json");	
        }
		
	}
	function scyhk(objid){ 
		
		if(confirm("确认要删除当前银行卡吗？")){
			var data={
				id:objid,
				account:$("#yhk" + objid ).val()
			};
			
			$.post("<?php echo U('user_yhk_del');?>",data,function(e){
				alert(e.msg); 
				location.reload();
			},"json");	
        }
		
	}
</script>

<script type="text/javascript">
    function showPreview(source) {
        var file = source.files[0];
        if(window.FileReader) {
            var fr = new FileReader();
            console.log(fr);
            var portrait = document.getElementById('portrait');
            fr.onloadend = function(e) {
                portrait.src = e.target.result;
            };
            fr.readAsDataURL(file);
            portrait.style.display = 'block';
        }
    }
    function showPreview2(source,obj) {
        var file = source.files[0];
        if(window.FileReader) {
            var fr = new FileReader();
            console.log(fr);
            var portrait = document.getElementById(obj);
            fr.onloadend = function(e) {
                portrait.src = e.target.result;
            };
            fr.readAsDataURL(file);
            portrait.style.display = 'block';
        }
    }

    var menu = "menu_user";
    var nav = "3";
    console.log(nav);
    $(function(){
        $("."+menu+" p").addClass("down");
        $("."+menu+" .son_menu").css("display","block");
        $("."+menu+" .son_menu a").eq(nav).addClass("on");
        seeNum();
    });
    function seeNum(){
        var seeNumUrl = "<?php echo U('seeNum');?>";
        var rechargeState = 1;//充值声音开关，1开/0关
        $.ajax({
            type : "POST",
            url : seeNumUrl,
            data: {rechargeState:rechargeState},
            dataType : "json",
            success : function(result){
                if(result['code']!="000"){
                    $("#ifr").attr("src",result['url']);
                    //alert(result['msg']);
                }else{
                    $("#ifr").attr("src","");
                }
            },
            error:function(){
                //alert();
            }
        });
    }
    setInterval(seeNum,15000);
</script>
</body>
</html>