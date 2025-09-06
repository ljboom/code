<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>实名认证</title>
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
    <div class="othertop">
        <a class="goback" href="<?php echo U('person');?>"><img src="/Public/mobile/img/goback.png" /></a>
        <div class="othertop-font">实名认证</div>
    </div>
    <div class="header-nbsp"></div>
        <div class="login_bg">
	        <?php if($user['auth'] == 1): ?><div class="input_text cert">
                    <label>姓名</label>
                    <input type="text" readonly="readonly" value="<?php echo ($user["name"]); ?>" placeholder="输入姓名">
                </div>
                <div class="input_text cert">
                    <label>身份证号码</label>
                    <input type="text" readonly="readonly" value="<?php echo ($user["idcard"]); ?>" placeholder="输入有效身份证号">
                </div>
                <?php else: ?>
                <form action="<?php echo U('certification');?>" method="post">
                    <div class="input_text cert">
                        <label>姓名</label>
                        <input type="text" name="name" placeholder="输入姓名">
                    </div>
                    <div class="input_text cert">
                        <label>身份证号码</label>
                        <input type="text" name="idcard" placeholder="输入有效身份证号">
                    </div>
                    <input type="submit" class="input_btn" value="立即认证" />
                </form><?php endif; ?>
        </div>
    </div>
</body>
</html>