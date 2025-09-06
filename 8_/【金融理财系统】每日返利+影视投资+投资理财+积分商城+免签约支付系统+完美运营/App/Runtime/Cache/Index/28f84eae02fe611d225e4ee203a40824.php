<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>标列表</title>
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
    <div class="header">项目投资</div>
    <div class="header-nbsp"></div>

    <!-- 投资项目 -->

    <?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($i % 2 );++$i;?><div class="pro_box">
            <a class="tier" href="<?php echo U('details','id='.$i['id']);?>">
               <div class="img-box">
                    <img src="/Public/uploads/item/<?php echo ($i["img"]); ?>" class="img">
                </div>
                <div class="info-box">
                    <div class="ib-head">
                        <span class="index">保</span><?php echo ($i["title"]); ?>
                    </div>
                   <!-- <div class="ib-doc">
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
            </a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>


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