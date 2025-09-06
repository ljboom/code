<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>首页</title>
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
<link rel="stylesheet" href="/Public/mobile/css/div3.css?k=<?php echo rand(1,99999);?>"/>
<div class="mobile">
    <div class="header">
        <img src="/Public/uploads/logo.png" />
        <?php if(isLogin()): ?><a href="<?php echo U('User/person');?>">会员中心</a>
            <?php else: ?>
            <a href="<?php echo U('Mobile/login');?>">注册/登录</a><?php endif; ?>
    </div>
    <div class="header-nbsp"></div>
    <!--banner-->
    <div class="indexbanner">
        <div class="slide_01" id="slide_01">
            <?php $_result=getData('slide','all','type=2 AND `show`=1','','sort asc');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><div class="mod_01"><a href="<?php echo ($s["url"]); ?>"><img src="/Public/uploads/slide/<?php echo ($s["path"]); ?>" ></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="dotModule_new">
            <div id="slide_01_dot"></div>
        </div>
    </div>
    <script type="text/javascript" src="/Public/mobile/js/srcoll.js"></script>
    <script type="text/javascript">
        //轮播图
        $('.mod_01').css('width',document.body.offsetWidth);
        if(document.getElementById("slide_01")){
            var slide_01 = new ScrollPic();
            slide_01.scrollContId   = "slide_01"; //内容容器ID
            slide_01.dotListId      = "slide_01_dot";//点列表ID
            slide_01.dotOnClassName = "selected";
            slide_01.frameWidth     = document.body.offsetWidth;
            slide_01.pageWidth      = document.body.offsetWidth;
            slide_01.upright        = false;
            slide_01.speed          = 10;
            slide_01.space          = 30;
            slide_01.initialize(); //初始化
        }
    </script>
    <!--end banner-->
    <div class="indexnav" style="height: 2.8rem;">
        <a href="<?php echo U('Mobile/lists');?>"><img src="/Public/mobile/img/index-hlf-icon1.png" /><font>投资项目</font></a>
        <a href="<?php echo U('About/index');?>"><img src="/Public/mobile/img/index-hlf-icon2.png" /><font>关于我们</font></a>
        <a href="<?php echo U('Mobile/calculator');?>"><img src="/Public/mobile/img/index-hlf-icon3.png" /><font>计算器</font></a>
        <a href="javascript:;" onclick="qiandao()"><img src="/Public/mobile/img/index-hlf-icon4.png" /><font>每日签到</font></a>
        <a href="<?php echo U('User/recharge');?>"><img src="/Public/mobile/img/index-hlf-icon5.png" /><font>我要充值</font></a>
        <a href="<?php echo U('User/cash');?>"><img src="/Public/mobile/img/index-hlf-icon6.png" /><font>我要提现</font></a>
        <a href="<?php echo U('Mobile/reg');?>"><img src="/Public/mobile/img/index-hlf-icon7.png" /><font>免费注册</font></a>
        <a href="<?php echo U('User/recommend');?>"><img src="/Public/mobile/img/index-hlf-icon8.png" /><font>邀请好友</font></a>
    </div>
    <div class="marquee_outer" style="margin-bottom: .2rem;">
        <img src="/Public/mobile/img/notice.png" />
        <div class="marquee_txt">
            <marquee scrollamount="3">
                <a><?php echo getInfo('notice');?></a>
            </marquee>
        </div>
    </div>

    <!-- 投资项目 -->
    <?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($i % 2 );++$i;?><a class="tier" href="<?php echo U('details','id='.$i['id']);?>">
        <div class="img-box">
                <img src="/Public/uploads/item/<?php echo ($i["img"]); ?>" class="img">
            </div>
            <div class="info-box">
                <div class="ib-head">
                    <span class="index">保</span><?php echo ($i["title"]); ?>
                </div>
              <!--  <div class="ib-doc">
                    <?php echo ($i["desc"]); ?>
                </div>-->
                <div class="ib-body">
                    <div class="cl-3">
                        <p><span class="red"><?php echo round($i['rate'],2);?></span>%</p>
                        <p>日化利率</p>
                    </div>
                    <div class="cl-3">
                        <p><span class="red"><?php echo ($i["day"]); ?></span>天</p>
                        <p>投资期限</p>
                    </div>
                    <div class="cl-3">
                        <p>￥<span class="red"><?php echo round($i['min'],2);?></span>元</p>
                        <p>起投金额</p>
                    </div>
                </div>
                <div class="ib-foot">
                    <div class="text">
                        <p>项目规模：<?php echo round($i['total'],2);?>万元</p>
                        <p><?php echo getProjectType($i['type']);?></p>
                    </div>
                    <div class="other">
                        <?php if(getProjectPercent($i['id']) == 100): ?><button class="now-btn" style="background-color: #888;">项目已满</button>
                            <?php else: ?>
                            <button class="now-btn">立即投资</button><?php endif; ?>
                    </div>
                </div>
                <div class="plan">
                    <span>项目进度：</span>
                    <div class="plan-wrap">
                        <?php if(getProjectPercent($i['id']) == 100): ?><div class="plan-con" style="width:<?php echo round(getProjectPercent($i['id']),2);?>%;background-color: #888;"></div>
                            <?php else: ?>
                            <div class="plan-con" style="width:<?php echo round(getProjectPercent($i['id']),2);?>%;"></div><?php endif; ?>
                    </div>
                    <span class="plan-text"><?php echo round(getProjectPercent($i['id']),2);?>%</span>
                </div>
                <?php if(getProjectPercent($i['id']) == 100): ?><img class="over" src="/Public/mobile/img/over.png" style="display: block;position: absolute;right: 0;margin-top: -2rem;"/><?php endif; ?>
            </div>
        </a><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php if(getInfo('video') != '无'): ?><div class="vid_box">
            <iframe frameborder="0" width="100%" height="288" src="<?php echo getInfo('video');?>" allowfullscreen=""></iframe>
        </div><?php endif; ?>
   <div class="contact">
        <span class="tel">服务热线：<a href="tel:<?php echo getInfo('tel');?>"><strong><?php echo getInfo('tel');?></strong></a></span>
        <a href="<?php echo getInfo('service');?>" class="kef">进入在线客服</a>
    </div>
    <div class="footer">
        <p>备案号<?php echo getInfo('icp');?></p>
        <div class="zhenjian">
            <!--认证代码 start-->
             <a href="javascript:;">
                <img src="/Public/pc/img/auth_aqwz.png" title="安全网站"/>
            </a>
            <a href="javascript:;">
                <img src="/Public/pc/img/auth_cxwz.png" title="诚信网站"/>
            </a>
            <a href="javascript:;">
                <img src="/Public/pc/img/auth_gwyz.png" title="官网验证"/>
            </a>
            <a href="javascript:;">
                <img src="/Public/pc/img/auth_hyyz.png" title="行业验证"/>
            </a>
            <a href="javascript:;">
                <img src="/Public/pc/img/auth_smyz.png" title="实名验证"/>
            </a>
            <a href="javascript:;">
                <img src="/Public/pc/img/auth_kxwz.png" title="可信网站"/>
            </a>
            <a href="javascript:;">
                <img src="/Public/pc/img/auth_ppgw.png" title="品牌官网"/>
            </a>
            <a href="javascript:;">
                <img src="/Public/pc/img/auth_sdxy.png" title="水滴信用"/>
            </a>
            <a href="javascript:;">
                <img src="/Public/pc/img/auth_hyrz.png" title="行业验证"/>
            </a>
            <!--认证代码 end-->
        </div>
    </div>
    <?php if($_SESSION['isApp'] != 1): ?><div class="appdown" style="width: 7.5rem;height: 1rem;background-color: rgba(0, 0, 0, 0.5);position: fixed;bottom: 1rem;">
            <div style="width: 1rem;float:left;height: 1rem;margin: 0 0.2rem;">
                <img src="/Public/uploads/mlogo2.png" width="100%"/>
            </div>
            <div style="width: 3rem;float: left;left: 1rem;color: #fff;line-height: 0.4rem;margin: 0.1rem 0;font-size: 0.28rem;">
                <?php echo getInfo('webname');?><br/>
                您身边的理财专家
            </div>
            <div style="width: 1rem;float:right;height: 1rem;">
                <a href="javascript:;" onclick="$('.appdown').hide();" style="display: block;width:1rem;font-size:0.5rem;cursor: pointer;color:#fff;line-height: 1rem;text-align: center;">×</a>
            </div>
            <div style="width: 2rem;height: 1rem;float: right;">
                <a href="<?php echo getInfo('app');?>" style="display:block;width:1.6rem;height: 0.6rem;margin: 0.2rem .2rem;line-height:0.6rem;text-align:center;border-radius:0.1rem;background-color: #FD5A21;color:#fff;font-size: 0.28rem;">下载APP</a>
            </div>
        </div><?php endif; ?>
    <script type="text/javascript" src="/Public/xin_mobile/static/js/rem.js"></script>

<link type="text/css" rel="stylesheet" href="/Public/xin_mobile/static/css/foot.css" />

<footer class=footer>
<a href="/Mobile/index/index.html"><img src="/Public/xin_mobile/static/picture/rbtn_home_hot_normal.png"></a>
<a href="/Mobile/lists.html"><img src="/Public/xin_mobile/static/picture/rbtn_home_product_checked.png"></a>
<a href="https://api.pop800.com/chat/574513"><img src="/Public/xin_mobile/static/picture/icon_sanbiao_home.png"></a>
<a href="/about/index.html"><img src="/Public/xin_mobile/static/picture/rbtn_home_find_normal.png"></a>
<a href="/user/person.html"><img src="/Public/xin_mobile/static/picture/rbtn_home_my_normal.png"></a></footer>
    <?php if(getInfo('activity_status') == 1): ?><!--活动弹窗 S -->
        <div class="huodongbg" style="width:100%;height:2000px;position: fixed;top: 0;left:0;background-color: rgba(0,0,0,0.35);z-index: 9999999;">
            <div style="width:300px;height:200px;position: fixed;top: 0;left:0;right:0;bottom:0;margin:auto;background-color: #666;">
                <a href="javascript:;" onclick="$('.huodongbg').hide();" style="width:110px;height:25px;line-height:25px;text-align: center;position:absolute;right: 5px;top: 10px;border: 1px solid #fff;color:#fff;border-radius:5px;">关闭活动广告</ a>
                <a href="<?php echo getInfo('activity_url');?>" style="">
                    <img src="/Public/uploads/activity.png" width="300px" height="200px"/>
                </a>
            </div>
        </div>
        <!--活动弹窗 E--><?php endif; ?>
</div>

</body>
</html>