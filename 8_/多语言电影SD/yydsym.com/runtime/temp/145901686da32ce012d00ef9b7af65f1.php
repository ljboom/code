<?php /*a:1:{s:90:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/bet/batch_task_youtube.html";i:1642715004;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会员列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/resource/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/mylay.css">
</head>
<body>
<div style="padding: 20px; background-color: #F2F2F2;">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card" style="padding: 10px;">
                <form class="layui-form search">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">等级</label>
                            <div class="layui-input-inline">
                                <select id="vip_level" lay-search="">
                                    <?php foreach($level_list as $k=>$v): ?>
                                    <option value="<?php echo htmlentities($k); ?>"><?php echo htmlentities($v); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label" style="width: 130px">YouTube列表地址</label>
                            <div class="layui-input-inline" style="width: 300px">
                                <input class="layui-input" id="get_url" autocomplete="off">
                            </div>
                        </div>
                        <div class="layui-inline" style="text-align: center;">
                            <button type="button" class="layui-btn" id="go-search">采集</button>
                        </div>
                    </div>
                    <div class="layui-form-item">
                    </div>
                </form>
                <div style="line-height: 200%;font-size: 16px">
                    YouTube地址类似这种：<br>
                    <a target="_blank" href="https://www.youtube.com/c/BeautyChickee/videos">https://www.youtube.com/c/BeautyChickee/videos</a><br>
                    <a target="_blank" href="https://www.youtube.com/channel/UCqWNOHjgfL8ADEdXGznzwUw/videos">https://www.youtube.com/channel/UCqWNOHjgfL8ADEdXGznzwUw/videos</a>
                    <br>
                    地址要填对，如果填错了 会采集失败。<br>
                    任务佣金设置为等级佣金。其他参数全部随机。一条链接采集50条数据。
                </div>
                <div id="result-msg" style="font-size: 20px;font-weight: bold;margin-top: 20px;color: red">

                </div>
            </div>
        </div>
    </div>
</div>
<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/user.js"></script>
<script src="/resource/js/manage/jquery.min.js"></script>
<script>
    $(function () {
        var sub = false;
        $('#go-search').on('click', function () {
            if (sub) return;
            sub = true;
            $('#result-msg').html('采集中......');
            $.ajax({
                url: '<?php echo url("batchTaskYoutube"); ?>',
                data: {grade: $('#vip_level').val(), get_url: $('#get_url').val()},
                type: 'post',
                success: function (res) {
                    $('#result-msg').html(res);
                    sub = false;
                }, error: function () {
                    $('#result-msg').html('采集失败，请返回列表查看数据');
                    sub = false;
                }
            })
        });
    });
</script>
</body>
</html>
