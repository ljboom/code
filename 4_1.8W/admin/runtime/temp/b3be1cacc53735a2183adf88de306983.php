<?php /*a:1:{s:64:"/www/wwwroot/test.dkewl.com/application/admin/view/login/index.html";i:1618724626;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities((isset($system_config_info['web_site_title']) && ($system_config_info['web_site_title'] !== '')?$system_config_info['web_site_title']:'MEAdmin')); ?> | <?php echo htmlentities((isset($system_config_info['web_site_name']) && ($system_config_info['web_site_name'] !== '')?$system_config_info['web_site_name']:'MEAdmin')); ?></title>

    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="/static/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="/static/admin/css/animate.css" rel="stylesheet">
    <link href="/static/admin/css/style.css" rel="stylesheet">
    <link href="/static/admin/css/meadmin.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">ME</h1>

            </div>
            <h2 class="font-weight-bold">站点后台管理系统</h2>
            <p>Management System</p>
            <form action="<?php echo url('@admin/login/index'); ?>" name="login-form" method="post" id="login-form">
                <div class="form-group text-left">
                    <input type="text" name="username" class="form-control" placeholder="用户名" required="">
                </div>
                <div class="form-group text-left">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>
                <?php if($system_config_info['captcha_signin']==1): ?>
                <div class="form-group">
                    <input type="text" name="captcha" class="form-control w-50 float-left" placeholder="验证码">
                    <img src="<?php echo captcha_src(); ?>" width="150" height="32" id="captcha" style="cursor: pointer;"
                        onclick="this.src='<?php echo captcha_src(); ?>?d='+Math.random();" title="点击刷新" alt="图形验证码">
                </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary block full-width m-b">登录</button>

            </form>
            <p class="m-t"> <small><?php echo htmlentities($system_config_info['web_site_copyright']); ?></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/static/admin/js/jquery-3.1.1.min.js"></script>
    <script src="/static/admin/js/popper.min.js"></script>
    <script src="/static/admin/js/bootstrap.js"></script>
    <script src="/static/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/static/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- bootstrap-notify -->
    <script src="/static/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!-- iCheck -->
    <script src="/static/plugins/iCheck/icheck.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/static/admin/js/app.js"></script>
    <script src="/static/admin/js/meadmin.js"></script>

    <!-- Jquery Validate -->
    <script src="/static/plugins/jquery-validation/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            // 验证表单数据
            $("#login-form").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    username: {
                        required: "请输入用户名",
                        minlength: "用户名长度不能小于2"
                    },
                    password: {
                        required: "请输入密码",
                        minlength: "密码长度不能小于6"
                    }
                }
            });

            $('#login-form').on('submit', function () {
                if ($("#login-form").valid() == false) return false;

                var data = $(this).serialize();
                let url = $(this).attr('action');
                MEAdmin.loading();
                MEAdmin.ajax({
                    url: url,
                    dataType: "json",
                    data: data,
                    type: "post",
                    success: function (res) {
                        var res = eval('(' + res + ')');
                        MEAdmin.loading('hide');
                        if (res.status == "success") {
                            MEAdmin.notify('登录成功，页面即将跳转~', 'success');
                            setTimeout(function () {
                                location.href = res.url;
                            }, 1500);
                        } else {
                            $('#captcha').click();
                            MEAdmin.notify(res.msg, 'danger');
                        }
                    }, failure: function (res) {
                        MEAdmin.loading('hide');
                        MEAdmin.notify('服务器错误~', 'danger');
                    }
                });
                return false;
            });

        });
    </script>

</body>

</html>