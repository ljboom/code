<?php /*a:1:{s:79:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/report/data.html";i:1609314392;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>每日报表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/resource/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/mylay.css">
    <link rel="stylesheet" href="/resource/css/page.css">
</head>
<body>
    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card" style="padding: 10px;">
                    <form class="layui-form" action="/manage/report/data" method="get">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">搜索账号</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="username" placeholder="账号" class="layui-input" value="<?php echo isset($where['username']) ? htmlentities($where['username']) : ''; ?>">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">时间</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="date_range" value="<?php echo isset($where['date_range']) ? htmlentities($where['date_range']) : ''; ?>" class="layui-input" readonly>
                                </div>
                            </div>
                        </div>
                        <p style="text-align: center;"><button type="submit" class="layui-btn">搜索</button></p>
                    </form>
                </div>
            </div>
            <div class="layui-col-md12">
                <div class="layui-card">
                    <table class="layui-table" lay-even lay-size="sm">
                        <thead>
                            <tr>
                                <th>日期</th>
                                <th>充值</th>
                                <th>提现</th>
                                <th>任务</th>
                                <th>回扣</th>
                                <th>活动</th>
                                <th>购买会员</th>
                                <th>推广奖励</th>
                                <th>抽水</th>
                                <th>撤销任务</th>
                                <th>任务提成</th>
                                <th>其他</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $key=>$value): ?>
                            <tr>
                                <td><?php echo htmlentities(date("Y-m-d",!is_numeric($value['date'])? strtotime($value['date']) : $value['date'])); ?></td>
                                <td><?php echo !empty($value['recharge']) ? htmlentities($value['recharge']) : 0; ?></td>
                                <td><?php echo !empty($value['withdrawal']) ? htmlentities($value['withdrawal']) : 0; ?></td>
                                <td><?php echo !empty($value['task']) ? htmlentities($value['task']) : 0; ?></td>
                                <td><?php echo !empty($value['rebate']) ? htmlentities($value['rebate']) : 0; ?></td>
                                <td><?php echo !empty($value['regment']) ? htmlentities($value['regment']) : 0; ?></td>
                                <td><?php echo !empty($value['buymembers']) ? htmlentities($value['buymembers']) : 0; ?></td>
                                <td><?php echo !empty($value['spread']) ? htmlentities($value['spread']) : 0; ?></td>
                                <td><?php echo !empty($value['pump']) ? htmlentities($value['pump']) : 0; ?></td>
                                <td><?php echo !empty($value['revoke']) ? htmlentities($value['revoke']) : 0; ?></td>
                                <td><?php echo !empty($value['commission']) ? htmlentities($value['commission']) : 0; ?></td>
                                <td><?php echo !empty($value['other']) ? htmlentities($value['other']) : 0; ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>本页总计</td>
                                <td><?php echo !empty($totalPage['recharge']) ? htmlentities($totalPage['recharge']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['withdrawal']) ? htmlentities($totalPage['withdrawal']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['task']) ? htmlentities($totalPage['task']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['rebate']) ? htmlentities($totalPage['rebate']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['regment']) ? htmlentities($totalPage['regment']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['buymembers']) ? htmlentities($totalPage['buymembers']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['spread']) ? htmlentities($totalPage['spread']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['pump']) ? htmlentities($totalPage['pump']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['revoke']) ? htmlentities($totalPage['revoke']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['commission']) ? htmlentities($totalPage['commission']) : 0; ?></td>
                                <td><?php echo !empty($totalPage['other']) ? htmlentities($totalPage['other']) : 0; ?></td>
                            </tr>
                            <tr>
                                <td>全部总计</td>
                                <td><?php echo !empty($totalAll['recharge']) ? htmlentities($totalAll['recharge']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['withdrawal']) ? htmlentities($totalAll['withdrawal']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['task']) ? htmlentities($totalAll['task']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['rebate']) ? htmlentities($totalAll['rebate']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['regment']) ? htmlentities($totalAll['regment']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['buymembers']) ? htmlentities($totalAll['buymembers']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['spread']) ? htmlentities($totalAll['spread']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['pump']) ? htmlentities($totalAll['pump']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['revoke']) ? htmlentities($totalAll['revoke']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['commission']) ? htmlentities($totalAll['commission']) : 0; ?></td>
                                <td><?php echo !empty($totalAll['other']) ? htmlentities($totalAll['other']) : 0; ?></td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td colspan="12" style="text-align: center;">暂无数据</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo $page; ?>
                </div>
            </div>
        </div>
    </div>

<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/report.js"></script>
</body>
</html>