<?php /*a:1:{s:80:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/user/capital.html";i:1649799690;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>资金操作</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/resource/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/mylay.css">
</head>
<body>
    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <form class="layui-form" action="">
                            <div class="layui-form-item">
                                <label class="layui-form-label">资金操作</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="price" value="" autocomplete="off" placeholder="金额" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">资金操作：正数增加，负数减少，当前:<?php echo htmlentities($balance['balance']); ?></div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">交易类型</label>
                                <div class="layui-input-inline">
                                    <select name="transaction_type" lay-verify="required" lay-search="">
                                        <option value="8">推广奖励</option>
                                        <?php foreach($transactionType as $key=>$value): if($key==0)continue;?>
                                        <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($value); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="layui-form-mid layui-word-aux">注：【投注、派奖、返点、活动】这几项计入盈亏</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">操作说明</label>
                                <div class="layui-input-block">
                                    <textarea name="explain" placeholder="操作说明" class="layui-textarea"></textarea>
                                </div>
                                <div class="layui-form-mid layui-word-aux"></div>
                            </div>
                            <!--<div class="layui-form-item">-->
                            <!--    <label class="layui-form-label">安全码</label>-->
                            <!--    <div class="layui-input-inline">-->
                            <!--        <input type="password" name="safe_code" value="" autocomplete="off" placeholder="安全码" class="layui-input">-->
                            <!--    </div>-->
                            <!--    <div class="layui-form-mid layui-word-aux"></div>-->
                            <!--</div>-->
                            <div class="layui-form-item" style="margin-top: 40px;text-align: center;">
                                <input type="hidden" name="id" value="<?php echo htmlentities($id); ?>" autocomplete="off" class="layui-input">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="usercapital">立即提交</button>
                                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/user.js"></script>
</body>
</html>