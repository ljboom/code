<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理 - 系统管理</title>
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
            <a>系统管理</a>&gt;&gt;
            <span>网站信息</span>
        </p>
        <div class="content">
            <form action="<?php echo U('system_info');?>" method="post">
                <div class="line">
                    <label>网站名称：</label>
                    <input type="text" name="webname" value="<?php echo getInfo('webname');?>"/>
                </div>
                <div class="line">
                    <label>公司名称：</label>
                    <input type="text" name="company" value="<?php echo getInfo('company');?>" class="short"/>
                </div>
                <div class="line">
                    <label>公司电话：</label>
                    <input type="text" name="tel" value="<?php echo getInfo('tel');?>" class="short"/>
                </div>
                <div class="line">
                    <label>公司地址：</label>
                    <input type="text" name="address" value="<?php echo getInfo('address');?>"/>
                </div>
                <div class="line">
                    <label>网站公告：</label>
                    <input type="text" name="notice" value="<?php echo getInfo('notice');?>"/>
                </div>
                <div class="line">
                    <label>客服链接：</label>
                    <input type="text" name="service" value="<?php echo getInfo('service');?>"/>
                </div>
                <div class="line">
                    <label>APP下载链接：</label>
                    <input type="text" name="app" value="<?php echo getInfo('app');?>"/>
                </div>
                <div class="line">
                    <label>ICP备案号：</label>
                    <input type="text" name="icp" value="<?php echo getInfo('icp');?>"/>
                </div>
                <div class="line">
                    <label>客服微信号：</label>
                    <input type="text" name="wechat" value="<?php echo getInfo('wechat');?>" class="short"/>
                </div>
                <div class="line">
                    <label>客服QQ号：</label>
                    <input type="text" name="qq" value="<?php echo getInfo('qq');?>" class="short"/>
                </div> 
				<div class="line">
                    <label>充值多少可看银行卡信息：</label>
                    <input type="text" name="icar" value="<?php echo getInfo('icar');?>" class="short"/>
                </div>
                <div class="line">
                    <label>最低提现金额：</label>
                    <input type="text" name="cash" value="<?php echo getInfo('cash');?>" class="short"/>
                </div> 
				<div class="line">
                    <label>允许提现时间</label>
                    <input type="text" name="allowable" value="<?php echo getInfo('allowable');?>" class="short"/>
                </div>	
				<div class="line">
                    <label>每天允许提现免费次数</label>
                    <input type="text" name="withdrawals" value="<?php echo getInfo('withdrawals');?>" class="short"/>
                </div>
				<div class="line">
                    <label>超出次数比例收取手续费</label>
                    <input type="text" name="charged" value="<?php echo getInfo('charged');?>" class="short"/>
                </div>
                <div class="line">
                    <label>排行榜：</label>
                    <textarea name="ranking"><?php echo getInfo('ranking');?></textarea>
                </div>
                <div class="line">
                    <label>合同设置：</label>
                    <textarea name="contract"><?php echo getInfo('contract');?></textarea>
                </div>
                <div class="line">
                    <label>结算开关：</label>
                    <select name="jiesuan">
                        <option value="0"<?php if(getInfo('jiesuan') == 0): ?>selected="selected"<?php endif; ?>>关闭</option>
                        <option value="1"<?php if(getInfo('jiesuan') == 1): ?>selected="selected"<?php endif; ?>>开启</option>
                    </select>
                </div>
                <!--<div class="line">
                    <label>电脑站开关：</label>
                    <select name="web">
                        <option value="0"<?php if(getInfo('web') == 0): ?>selected="selected"<?php endif; ?>>关闭</option>
                        <option value="1"<?php if(getInfo('web') == 1): ?>selected="selected"<?php endif; ?>>开启</option>
                    </select>
                </div>-->
                <div class="line">
                    <label>手机模板：</label>
                    <select name="template">
                        <option value="one"<?php if(getInfo('template') == 'one'): ?>selected="selected"<?php endif; ?>>模板一</option>
                        <option value="two"<?php if(getInfo('template') == 'two'): ?>selected="selected"<?php endif; ?>>模板二</option>
                        <option value="three"<?php if(getInfo('template') == 'three'): ?>selected="selected"<?php endif; ?>>模板三</option>
                    </select>
                </div>
                <div class="line">
                    <label>公司视频地址：</label>
                    <input type="text" name="video" value="<?php echo getInfo('video');?>" class="" placeholder="不显示请填写“无”，建议mp4格式的链接"/>
                </div>
                <div class="line">
                    <label>短信签名：</label>
                    <input type="text" name="smsname" value="<?php echo getInfo('smsname');?>" class="short"/>
                </div>
                <!-- <div class="line">
                    <label>短信APIKEY：</label>
                    <input type="text" name="smskey" value="<?php echo getInfo('smskey');?>" class="short"/>
                </div> -->
              
                <div class="button">
                    <input type="submit" value="立即提交" class="submit" />
                    <input type="reset" value="重置" class="reset"/>
                </div>
                <input type="hidden" value="">
            </form>
        </div>
    </div>
</div>
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

    var menu = "menu_system";
    var nav = "0";
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