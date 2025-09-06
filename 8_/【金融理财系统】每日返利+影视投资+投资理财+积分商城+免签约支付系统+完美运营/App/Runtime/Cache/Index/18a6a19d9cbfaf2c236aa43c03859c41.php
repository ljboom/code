<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>文章详情</title>
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
<body>
<div class="mobile">
    <div class="othertop">
        <a class="goback" href="javascript:history.back();"><img src="/Public/mobile/img/goback.png" /></a>
        <div class="othertop-font">详情</div>
    </div>
    <div class="news_detail">
        <h1 class="tit"><?php echo ($article["title"]); ?></h1>
        <!--<p class="time"><?php echo date("Y-m-d",strtotime($article['time']));?></p>-->
        <div><?php echo htmlspecialchars_decode($article['content']);?></div>
    </div>
<link type="text/css" rel="stylesheet" href="/Public/xin_mobile/staticfaxian/css/foot.css" />
    <footer class='footer'>
<a href="/Mobile/index/index.html"><img src="/Public/xin_mobile/staticfaxian/picture/rbtn_home_hot_normal.png"></a>
<a href="/Mobile/lists.html"><img src="/Public/xin_mobile/staticfaxian/picture/rbtn_home_product_normal.png">
</a><a href="/gs/get_commodity.html"><img src="/Public/xin_mobile/staticfaxian/picture/icon_sanbiao_home.png"></a>
<a href="#"><img src="/Public/xin_mobile/staticfaxian/picture/rbtn_home_find_checked.png"></a>
<a href="/user/person.html"><img src="/Public/xin_mobile/staticfaxian/picture/rbtn_home_my_normal.png"></a>

</footer>
</div>
</body>
</html>