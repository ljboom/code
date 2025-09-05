<?php /*a:1:{s:65:"/www/wwwroot/test.dkewl.com/application/admin/view/dispatch_jump.tpl";i:1618724626;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities((isset($system_config_info['web_site_title']) && ($system_config_info['web_site_title'] !== '')?$system_config_info['web_site_title']:'MEAdmin')); ?> | 跳转提示</title>

    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/static/admin/css/animate.css" rel="stylesheet">
    <link href="/static/admin/css/style.css" rel="stylesheet">
    <link href="/static/admin/css/meadmin.css" rel="stylesheet">

</head>


	<body class="gray-bg">
	    <div class="middle-box text-center animated fadeInDown">
            <?php switch ($code) {case 1:?>
                <h1><i class="fa fa-check-circle text-success"></i></h1>
                <?php break;case 0:?>
                <h1><i class="fa fa-times-circle text-danger"></i></h1>
                <?php break;} ?>

	        <h3 class="font-bold"><?php echo(strip_tags($msg));?></h3>
	
	        <div class="error-desc">
	            页面自动 <a id="href" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait);?></b>秒<br/>
				<a href="/" class="btn btn-primary m-t btn-lg">返回首页</a>
				<a href="<?php echo($url);?>" class="btn btn-success m-t btn-lg">立即跳转</a>
	        </div>
	    </div>

        <!-- Mainly scripts -->
        <script src="/static/admin/js/jquery-3.1.1.min.js"></script>
        <script src="/static/admin/js/popper.min.js"></script>
        <script src="/static/admin/js/bootstrap.js"></script>

        <script type="text/javascript">
            (function(){
                var wait = document.getElementById('wait'),
                    href = document.getElementById('href').href;
                    console.log(wait);
                var interval = setInterval(function(){
                    var time = --wait.innerHTML;
                    if(time <= 0) {
                        location.href = href;
                        clearInterval(interval);
                    };
                }, 1000);
            })();
        </script>

	</body>

</html>