<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$system_config_info.web_site_title|default='MEAdmin'} | 跳转提示</title>

    <link href="__ADMIN_CSS__/bootstrap.min.css" rel="stylesheet">
    <link href="__STATIC__/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="__ADMIN_CSS__/animate.css" rel="stylesheet">
    <link href="__ADMIN_CSS__/style.css" rel="stylesheet">
    <link href="__ADMIN_CSS__/meadmin.css" rel="stylesheet">

</head>


	<body class="gray-bg">
	    <div class="middle-box text-center animated fadeInDown">
            <?php switch ($code) {?>
                <?php case 1:?>
                <h1><i class="fa fa-check-circle text-success"></i></h1>
                <?php break;?>
                <?php case 0:?>
                <h1><i class="fa fa-times-circle text-danger"></i></h1>
                <?php break;?>
            <?php } ?>

	        <h3 class="font-bold"><?php echo(strip_tags($msg));?></h3>
	
	        <div class="error-desc">
	            页面自动 <a id="href" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait);?></b>秒<br/>
				<a href="/" class="btn btn-primary m-t btn-lg">返回首页</a>
				<a href="<?php echo($url);?>" class="btn btn-success m-t btn-lg">立即跳转</a>
	        </div>
	    </div>

        <!-- Mainly scripts -->
        <script src="__ADMIN_JS__/jquery-3.1.1.min.js"></script>
        <script src="__ADMIN_JS__/popper.min.js"></script>
        <script src="__ADMIN_JS__/bootstrap.js"></script>

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