<?php /*a:1:{s:90:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/user/artificial_action.html";i:1658350466;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加用户</title>
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
                        <div class="layui-tab layui-tab-brief">
                            <ul class="layui-tab-title">
                                <li class="layui-this">单个存提</li>
                                <li>批量存提</li>
                            </ul>
                            <div class="layui-tab-content">
                                <div class="layui-tab-item layui-show">
                                    <form class="layui-form" action="">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">会员账号</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="username" placeholder="请输入会员账号" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">金额</label>
                                            <div class="layui-input-block">
                                                <input type="number" name="price" placeholder="请输入金额" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">类型</label>
                                            <div class="layui-input-block">
                                                <select name="type" lay-filter="aihao">
                                                    <option value="">请选择类型</option>
                                                    <?php foreach(app('config')->get('custom.transactionType') as $key=>$value): if($key <= 2): ?>
                                                    <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($value); ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="layui-form-item layui-form-text">
                                            <label class="layui-form-label">备注</label>
                                            <div class="layui-input-block">
                                                <textarea placeholder="请输入内容" class="layui-textarea"></textarea>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">安全码</label>
                                            <div class="layui-input-block">
                                                <input type="password" name="safe_code" placeholder="请输入安全码" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item" style="margin-top: 40px;text-align: center;">
                                            <button type="submit" class="layui-btn" lay-submit="" lay-filter="artificial-action">立即提交</button>
                                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="layui-tab-item">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label"></label>
                                        <div class="layui-input-block">
                                            <h3 style="color: red;">EXCEL文件格式（注意：仅Sheet1有效）</h3><br />
                                            <img src="/resource/image/manage_user_batch_action.png" alt="">
                                        </div>
                                    </div>
                                    <form class="layui-form" action="">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">类型</label>
                                            <div class="layui-input-block">
                                                <select name="type" lay-filter="aihao">
                                                    <option value="">请选择类型</option>
                                                    <?php foreach(app('config')->get('custom.transactionType') as $key=>$value): if($key): ?>
                                                    <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($value); ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">文件</label>
                                            <div class="layui-input-block">
                                                <button type="button" class="layui-btn" id="artificialAction"><i class="layui-icon">&#xe67c;</i>上传文件</button>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">安全码</label>
                                            <div class="layui-input-block">
                                                <input type="password" name="safe_code" placeholder="请输入安全码" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item" style="margin-top: 40px;text-align: center;">
                                            <button type="submit" class="layui-btn" lay-submit="" lay-filter="artificial-batch">立即提交</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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