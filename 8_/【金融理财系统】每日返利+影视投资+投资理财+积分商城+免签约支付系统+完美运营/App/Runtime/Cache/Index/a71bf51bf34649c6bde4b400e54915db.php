<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>个人中心</title>
    <link rel="stylesheet" href="/Public/mobile/css/base.css?k=<?php echo rand(1,99999);?>"/>
    <script type="text/javascript" src="/Public/mobile/js/adaptive.js"></script>
    <script type="text/javascript" src="/Public/mobile/js/config.js"></script>
    <script type="text/javascript" src="/Public/mobile/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/Public/mobile/js/public.js"></script>
    <script type="text/javascript">
        function msg(title,content,type,url){
            $("#msgTitle").html(title);
            $("#msgContent").html(content);
            if(type==1){
                var btn = '<input type="button" value="确定" onclick="$(\'#msgBox\').hide();" style="background-color: #4f79bc;color:#fff;border: none;padding:5px 10px;"/>';
            }
            else{
                var btn = '<input type="button" value="确定" onclick="window.location.href=\''+url+'\'" style="background-color: #4f79bc;color:#fff;border: none;padding:5px 10px;"/>';
            }
            $("#msgBtn").html(btn);
            $("#msgBox").show();
        }
    </script>
</head>
<body>
<div id="msgBox" style="width: 100%;background-color: rgba(0,0,0,0.25);height: 1000px;position: fixed;top: 0;left: 0;z-index: 9999;font-size:.28rem;display: none;">
    <div style="width: 80%;margin-top: 40%;margin-left: 10%;background-color: #fff;border-radius: 5px;overflow: hidden;">
        <div id="msgTitle" style="padding:10px 20px;background-color: #4f79bc;color:#fff;">
            提示
        </div>
        <div id="msgContent" style="padding:20px;line-height: 25px;">
            内容
        </div>
        <div id="msgBtn" style="padding: 10px 20px;text-align: right;border-top: 1px solid #eee;">
            <input type="button" value="确定" style="background-color: #4f79bc;color:#fff;border: none;padding:5px 10px;"/>
            <input type="button" value="取消" style="background-color: #4f79bc;color:#fff;border: none;padding:5px 10px;"/>
        </div>
    </div>
</div>
<div class="mobile">
    <div class="my_total">
        <div class="user">
            <span>我的账户：<?php echo ($user["phone"]); ?></span>
            <span>用户等级：<?php echo getUserMember($user['member']);?></span>
        </div>
        <p class="bal"><?php echo ($user["money"]); ?></p>
        <p class="bal_tit">账户余额（元）帐户积分（<?php echo ($user["jifen"]); ?>）</p>  
<?php if($user["dongjiemoney"] != ''): ?><p class="bal"><?php echo ($user["dongjiemoney"]); ?></p>
        <p class="bal_tit">冻结余额（元）</p>
					<?php else: endif; ?>		
		
        <div class="wait">
            <div class="item">
                <span class="span_num"><?php echo getUserUnIncome($uid);?></span>
                <span class="span_tit">待收利息（元）</span>
            </div>
            <div class="item">
                <span class="span_num"><?php echo getUserUnPrincipal($uid);?></span>
                <span class="span_tit">待收本金（元）</span>
            </div>
        </div>
    </div>
    <div class="user_btn" >
        <a href="<?php echo U('recharge');?>"  style = "    color: #ffffff;background: #3582b3;">充值</a>
        <a href="<?php echo U('cash');?>"  style = "    color: #ffffff;background: #3582b3;">提现</a>
    </div>
    <ul class="user_list">
        <!--li><a href="<?php echo getInfo('service');?>"><img src="/Public/mobile/img/notice.png">在线客服</a></li-->
        <li><a href="<?php echo U('zhannei');?>"><img src="/Public/mobile/img/notice.png">站内消息</a></li>
		<!--<li><a href="/gs/my_order.html?state=1"><img src="/Public/mobile/img/user_fund.png">我的订单</a></li>-->
        <li><a href="javascript:;" onclick="qiandao()"><img src="/Public/mobile/img/nav4.png">每日签到</a></li>
        <li><a href="<?php echo U('fund');?>"><img src="/Public/mobile/img/user_fund.png">资金明细</a></li>
        <li><a href="<?php echo U('invest');?>"><img src="/Public/mobile/img/user_invest.png">投资记录</a></li>
        <li><a href="<?php echo U('interest');?>"><img src="/Public/mobile/img/user_inter.png">收益记录</a></li>
        <li><a href="<?php echo U('tuiguang');?>"><img src="/Public/mobile/img/user_inter.png">推广记录</a></li>
        <li><a href="<?php echo U('recharge_record');?>"><img src="/Public/mobile/img/user_rech.png">充值记录</a></li>
        <li><a href="<?php echo U('cash_record');?>"><img src="/Public/mobile/img/user_cash.png">提现记录</a></li>
        <!--li><a href="/lottery/index.html"><img src="/Public/mobile/img/user_cash.png">大转盘</a></li-->
    </ul>
    <ul class="user_list">
        <li><a href="<?php echo U('set_account');?>"><img src="/Public/mobile/img/user_safe.png">账户安全</a></li>
        <li><a href="<?php echo U('add_card');?>"><img src="/Public/mobile/img/user_card.png">银行卡绑定</a></li>
        <li><a href="<?php echo U('certification');?>"><img src="/Public/mobile/img/user_cert.png">实名认证</a></li>
        <!--li><a href="javascript:alert('登陆成功')"><img src="/Public/mobile/img/user_cert.png">微信登陆</a></li-->
    </ul>
    <ul class="user_list">
        <li><a href="<?php echo U('recommend');?>"><img src="/Public/mobile/img/user_invite.png">邀请好友</a></li>
        <a href="<?php echo U('logout');?>" class="input_btn">安全退出</a>	
    </ul>
    <a href="<?php echo U('logout');?>" class="input_btn"></a>	

    <script type="text/javascript" src="/Public/xin_mobile/static/js/rem.js"></script>

<link type="text/css" rel="stylesheet" href="/Public/xin_mobile/static/css/foot.css" />

<footer class=footer>
<a href="/Mobile/index/index.html"><img src="/Public/xin_mobile/static/picture/rbtn_home_hot_normal.png"></a>
<a href="/Mobile/lists.html"><img src="/Public/xin_mobile/static/picture/rbtn_home_product_checked.png"></a>
<a href="https://api.pop800.com/chat/574513"><img src="/Public/xin_mobile/static/picture/icon_sanbiao_home.png"></a>
<a href="/about/index.html"><img src="/Public/xin_mobile/static/picture/rbtn_home_find_normal.png"></a>
<a href="/user/person.html"><img src="/Public/xin_mobile/static/picture/rbtn_home_my_normal.png"></a></footer>
</div>
</body>
</html>