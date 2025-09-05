<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=no">
<title>在线充值</title>
<link href="/Public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/css/store.css?bc" rel="stylesheet" type="text/css" />
<link href="/Public/css/user.css" rel="stylesheet" type="text/css" />
<script src="/Public/js/jquery.min.js" type="text/javascript"></script>
<script src="/Public/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<style>
	.title{
		width: 100%;
		height: 60px;
		line-height: 60px;
		text-align: center;
		font-size: 16px;
		border-bottom: 1px solid #eee;
	}
	.title img{
		width:35px;
		height:35px;
	}
	.content{width:100%;}
	.content .price{
		height: 50px;
		line-height: 70px;
		text-align: center;
		font-size: 30px;
	}
	.content .qrcode{
		width: 70%;
		height: 70%;
		margin: 0 15%;
	}
	.content .remark{
		width: 70%;
		margin: 0 auto;
		text-align: center;
		z-index: 99;
		margin-top: -30px;
		color: #19ca28;
		font-weight: 600;
		font-size: 16px;
	}
	.content .remark p{
		margin: 0;
	}
	.content .order{
		margin: 30px 0 0 0;
		text-align: center;
		font-size: 15px;
		font-weight: 600;
		border-bottom: 1px solid #eee;
		padding-bottom: 20px;
	}
	.content .times span{
		background: #19ca28;
		padding: 2px 10px;
		border-radius: 5px;
		margin-right: 10px;
		color: #fff;
	}
	.content .actions{
		height: 60px;
		font-size: 15px;
		font-weight: 600;
		text-align: center;
		line-height: 60px;
	}
</style>
<body>
	<div class="title">
		<img src="/Public/images/wxpay.png" />
		微信支付
	</div>
	<div class="content">
		<div class="price">¥&nbsp;<?php echo ($info["money"]); ?></div>
		<img src="https://www.kuaizhan.com/common/encode-png?large=true&data=<?php echo ($_GET['qrcode']); ?>" class="qrcode" />
		<div class="remark">
		</div>
		<div class="order">
			<p>付款成功后，书币会立即到账</p>
			<p>订单：<?php echo ($_GET['sn']); ?></p>
			<div class="times">
				<span id="hour_show">0时</span>
				<span id="minute_show">05分</span>
				<span id="second_show">30秒</span>
			</div>
		</div>
		<div class="actions">
			长按上方二维码进行识别
		</div>
	</div>

<script type="text/javascript">
	
	var intDiff = parseInt(329);//倒计时总秒数量
	function timer(intDiff){
		var intInterval = setInterval(function(){
			var day=0,
				hour=0,
				minute=0,
				second=0;//时间默认值        
			if(intDiff >= 0){
				day = Math.floor(intDiff / (60 * 60 * 24));
				hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
				minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
				second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
				
				if (minute <= 9) minute = '0' + minute;
				if (second <= 9) second = '0' + second;
				$('#hour_show').html(hour+'时');
				$('#minute_show').html(minute+'分');
				$('#second_show').html(second+'秒');
				intDiff--;
				
				getOrderStatus("<?php echo ($_GET['sn']); ?>");
				
			}else{
				clearInterval(intInterval);
			}
		}, 1000);
	} 
	
	$(function(){
		timer(intDiff);
	}); 
	
	
	//ajax查询订单状态
	function getOrderStatus(sn){
		$.post("<?php echo U('getOrderStatus');?>",{sn:sn},function(d){
			if(d){
				if(d.status){
					alert('支付成功，跳转到个人中心！');
					location.href="<?php echo U('Mh/my');?>";
				}
			}
		});
	}
	
	window.alert = function(name){
		var iframe = document.createElement("IFRAME");
		iframe.style.display="none";
		iframe.setAttribute("src", 'data:text/plain,');
		document.documentElement.appendChild(iframe);
		window.frames[0].window.alert(name);
		iframe.parentNode.removeChild(iframe);
	}
	
</script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
var links = window.location.href+'&parent='+"<?php echo ($user["id"]); ?>";
var img = "<?php echo ($share["pic"]); ?>";
var title = "<?php echo ($share["title"]); ?>";
var desc = "<?php echo ($share["desc"]); ?>";
wx.config({
	debug: false,
	appId: "<?php echo ($jssdk['appId']); ?>",
	timestamp:"<?php echo ($jssdk['timestamp']); ?>",
	nonceStr: "<?php echo ($jssdk['nonceStr']); ?>",
	signature: "<?php echo ($jssdk['signature']); ?>",
	jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage']
});
wx.ready(function () {
	wx.checkJsApi({
		jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
		success: function(res) {
			//alert(JSON.stringify(res));
		}
	});
	wx.error(function(res){
		console.log('err:'+JSON.stringify(res));
	});
	//分享给朋友
	wx.onMenuShareAppMessage({
		title:title, // 分享标题
		desc:desc, // 分享描述
		link:links, // 分享链接
		imgUrl:img, // 分享图标
		type: 'link', // 分享类型,music、video或link，不填默认为link
		dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		success: function () { 
		},
		cancel: function () { 
			
		}
	});
	//分享到朋友圈
	wx.onMenuShareTimeline({
		title:title, // 分享标题
		link: links, // 分享链接
		imgUrl:img, // 分享图标
		success: function () { 
			// 用户确认分享后执行的回调函数
		},
		cancel: function () { 
			// 用户取消分享后执行的回调函数
		}
	});
});
</script>
<?php echo ($_CFG["site"]["thirdcode"]); ?>
</body>
</html>