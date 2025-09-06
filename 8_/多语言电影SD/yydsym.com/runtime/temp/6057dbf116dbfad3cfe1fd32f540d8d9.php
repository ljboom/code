<?php /*a:1:{s:78:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/yuebao/add.html";i:1657993730;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加余额宝</title>
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
                        <form class="layui-form layui-form-pane" action="">
                            <div class="layui-form-item">
                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">如：充值返利</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">利率</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="lilv" autocomplete="off" placeholder="请输入利率" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">如：0.01=1%，注：系统仅支持小数点后四位，例：0.003，系统默认识别为0.0001</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">时间</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="time" autocomplete="off" placeholder="请输入时间" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">如：1天，定期时间</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">最低金额</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="min_money" autocomplete="off" placeholder="最低购买金额" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">最高金额</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="max_money" autocomplete="off" placeholder="最高购买金额" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">购买次数</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="buy_num" autocomplete="off" placeholder="购买次数" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">输入0表示不限制购买次数</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">是否赎回</label>
                                <div class="layui-input-inline">
                                    <select name="is_return" lay-search="">
                                        <option value="0">否</option>
                                        <option value="1">是</option>
                                        
                                    </select>
                                </div>
                                <div class="layui-form-mid layui-word-aux">否：不允许赎回，是：允许赎回</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">自动购买</label>
                                <div class="layui-input-inline">
                                    <select name="is_deposit" lay-search="">
                                        <option value="0">关</option>
                                        <option value="1">开</option>
                                    </select>
                                </div>
                                <div class="layui-form-mid layui-word-aux">开启后，完成任务的客户会自动购买收益宝。注：用户的单次任务佣金小于最低购买金额时，无法完成自动购买</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">赎回天数</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="min_time" autocomplete="off" placeholder="最小赎回天数" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">此项配置只有允许赎回时才能生效，不允许赎回时设置无效</div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">有效开关</label>
                                <div class="layui-input-inline">
                                    <select name="stat" lay-search="">
                                        <option value="1">开</option>
                                        <option value="2">关</option>
                                        
                                    </select>
                                </div>
                                <div class="layui-form-mid layui-word-aux"></div>
                            </div>
                            <div class="layui-form-item" style="margin-top: 40px;text-align: center;">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="yuebaolist_add">立即提交</button>
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
<script src="/resource/js/manage/yuebao.js"></script>

<script type="text/javascript" src="/resource/plugs/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/resource/plugs/ueditor/ueditor.all.min.js"></script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" src="/resource/plugs/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
var ue = UE.getEditor('editor');
</script>
</body>
</html>