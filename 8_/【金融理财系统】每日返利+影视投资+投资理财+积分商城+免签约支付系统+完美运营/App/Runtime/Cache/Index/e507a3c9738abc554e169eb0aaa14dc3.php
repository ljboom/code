<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width,height=device-height, initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0,shrink-to-fit=no" />
<meta name="format-detection" content="telephone=no" />
<!--em标准js代码，请放在页面的最上方，前面最好不要再有JS代码或JS文件-->
<script type="text/javascript" src="/Public/xin_mobile/staticfaxian/js/rem.js"></script>
<link type="text/css" rel="stylesheet" href="/Public/xin_mobile/staticfaxian/css/css.css" />
<title>发现</title>
   <style>
@keyframes fadein{
    0%{opacity: 0;
         }
    100%{
        opacity: 1;

    }
}
@-webkit-keyframes fadein{
        0%{opacity: 0;
         }
    100%{
        opacity: 1;

    }
}
@-moz-keyframes fadein{
        0%{opacity: 0;
         }
    100%{
        opacity: 1;

    }
}
@-o-keyframes fadein{
        0%{opacity: 0;
         }
    100%{
        opacity: 1;

    }
}
@-ms-keyframes fadein{
        0%{opacity: 0;
         }
    100%{
        opacity: 1;

    }
}
body{
    animation:fadein 0.1s linear 1;
    -webkit-animation:fadein 0.3s linear 1;
    -moz-animation:fadein 0.3s linear 1;
    -o-animation:fadein 0.3s linear 1;
    -ms-animation:fadein 0.3s linear 1;
}
</style>
</head>

<body>		
	
	<div class="header">
		
	</div>
	<div class="header_zw"></div>

	<div class="find_nav">
	
	  <?php $_result=getData('article', 'all', 'type=1', '', 'time desc');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i; if($t["keyword"] != ''): ?><a href="<?php echo ($t['keyword']); ?>"> 
		<?php else: ?> 
		<a href="<?php echo U('details','id='.$t['id']);?>"><?php endif; ?>
		 
			<img src="/Public/uploads/item/<?php echo ($t["photo"]); ?>" alt="">
			<span><?php echo ($t["title"]); ?></span>
		</a><?php endforeach; endif; else: echo "" ;endif; ?>
		
		<div class="clear"></div>
	</div>

	<div class="find_new">
  <?php $_result=getData('article', 'all', 'type=1006', '', 'time desc');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><div class="find_head">
			<div class="tit"><?php echo ($t["title"]); ?></div>
			<!-- <a href="#" class="more">查看更多 ></a> -->
		</div>
		<?php if($t["keyword"] != ''): ?><a href="<?php echo ($t['keyword']); ?>" class="new_item"> 
		<?php else: ?> 
		<a href="<?php echo U('details','id='.$t['id']);?>" class="new_item"><?php endif; ?>
			<div class="photo">
				<img src="/Public/uploads/item/<?php echo ($t["photo"]); ?>" alt="">
			</div>
			<!-- <div class="name">
				邀请好友签到最高获得888元现金大礼包
			</div> -->
		</a><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>

	<div class="find_new">
		
		<div class="find_head">
			<div class="tit">最新资讯</div>
			<!-- <a href="#" class="more">查看更多 ></a> -->
		</div>

  <?php $_result=getData('article', 'all', 'type=1007', '', 'time desc');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i; if($t["keyword"] != ''): ?><a href="<?php echo ($t['keyword']); ?>" class="ne_item2"> 
		<?php else: ?> 
		<a href="<?php echo U('details','id='.$t['id']);?>" class="ne_item2"><?php endif; ?>
			<div class="c_left">
				<div class="name"><?php echo ($t["title"]); ?></div>
			<!--	<div class="date"><?php echo ($t["time"]); ?></div>-->
			</div>
			<div class="photo">
				<img src="/Public/uploads/item/<?php echo ($t["photo"]); ?>" alt="">
			</div>
			<div class="clear"></div>
		</a><?php endforeach; endif; else: echo "" ;endif; ?>	

	</div>


	
<link type="text/css" rel="stylesheet" href="/Public/xin_mobile/staticfaxian/css/foot.css" />
<div class="hh"></div>
<footer class='footer'>
<a href="/Mobile/index/index.html"><img src="/Public/xin_mobile/staticfaxian/picture/rbtn_home_hot_normal.png"></a>
<a href="/Mobile/lists.html"><img src="/Public/xin_mobile/staticfaxian/picture/rbtn_home_product_normal.png">
</a><a href="/gs/get_commodity.html"><img src="/Public/xin_mobile/staticfaxian/picture/icon_sanbiao_home.png"></a>
<a href="#"><img src="/Public/xin_mobile/staticfaxian/picture/rbtn_home_find_checked.png"></a>
<a href="/user/person.html"><img src="/Public/xin_mobile/staticfaxian/picture/rbtn_home_my_normal.png"></a>

</footer>
	
</body>
<script type="text/javascript" src="/Public/xin_mobile/staticfaxian/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/xin_mobile/staticfaxian/js/base.js"></script>
<script type="text/javascript">
var link=document.getElementsByTagName('link')[0];
    var sUserAgent = navigator.userAgent.toLowerCase();
    var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
    var bIsMidp = sUserAgent.match(/midp/i) == "midp";
    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
    var bIsAndroid = sUserAgent.match(/android/i) == "android";
    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
    if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
    }
    else{
        location.href="https://www.baidu.com"

    }
</script>
<script type="text/javascript">
  var system = {};
  var p = navigator.platform;
  var u = navigator.userAgent;

  system.win = p.indexOf("Win") == 0;
  system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
  if (system.win  || system.xll) else {
      window.location.href = " http://www.baidu.com";
    }
  }
</script>

<script type="text/javascript" src="/Public/xin_mobile/staticfaxian/js/bda090ba14a94dc786a4164247ee8fcf.js"></script>

</html>