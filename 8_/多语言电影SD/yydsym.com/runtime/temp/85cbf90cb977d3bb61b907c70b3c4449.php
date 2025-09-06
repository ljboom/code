<?php /*a:1:{s:81:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/report/counts.html";i:1609314392;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>全局报表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/resource/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/mylay.css">
    <link rel="stylesheet" href="/resource/css/page.css">
</head>
<body>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li class="layui-this">总计</li>
                    <?php foreach($gradeData['grade'] as $key=>$value): ?>
                    <li><?php echo htmlentities($value['name']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-col-sm6 layui-col-md1">
                            <div class="layui-card">
                                <div class="layui-card-header">
                                    全部VIP
                                    <span class="layui-badge layui-bg-blue layuiadmin-badge">人</span>
                                </div>
                                <div class="layui-card-body layuiadmin-card-list">
                                    <p class="layuiadmin-big-font"><?php echo isset($gradeData['total']) ? htmlentities($gradeData['total']) : 0; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach($gradeData['grade'] as $key=>$value): ?>
                    <div class="layui-tab-item">
                        <div class="layui-col-sm6 layui-col-md1">
                            <div class="layui-card">
                                <div class="layui-card-header">
                                    今日新增
                                    <span class="layui-badge layui-bg-blue layuiadmin-badge">人</span>
                                </div>
                                <div class="layui-card-body layuiadmin-card-list">
                                    <p class="layuiadmin-big-font"><?php echo htmlentities($value['gradeData']['todayAdd']); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="layui-col-sm6 layui-col-md1" style="margin-left: 20px;">
                            <div class="layui-card">
                                <div class="layui-card-header">
                                    总数
                                    <span class="layui-badge layui-bg-blue layuiadmin-badge">人</span>
                                </div>
                                <div class="layui-card-body layuiadmin-card-list">
                                    <p class="layuiadmin-big-font"><?php echo htmlentities($value['gradeData']['total']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">今日统计报表</div>
                    <div class="layui-card-body">
                        <table class="layui-table" lay-even lay-size="sm">
                            <thead>
                                <tr>
                                    <th>新注册会员做任务人数</th>
                                    <th>做任务总人数</th>
                                    <th>任务领取</th>
                                    <th>任务成功</th>
                                    <th>任务失败</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo isset($todayStatis['todayRegCount']) ? htmlentities($todayStatis['todayRegCount']) : 0; ?></td>
                                    <td><?php echo isset($todayStatis['todayCount']) ? htmlentities($todayStatis['todayCount']) : 0; ?></td>
                                    <td><?php echo isset($todayStatis['todayLed']) ? htmlentities($todayStatis['todayLed']) : 0; ?></td>
                                    <td><?php echo isset($todayStatis['todaySuccess']) ? htmlentities($todayStatis['todaySuccess']) : 0; ?></td>
                                    <td><?php echo isset($todayStatis['todayFail']) ? htmlentities($todayStatis['todayFail']) : 0; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="layui-card">
                    <div class="layui-card-body">
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
                                <tr>
                                    <td>今日统计</td>
                                    <td><?php echo !empty($dataTimeArray['today']['recharge']) ? htmlentities($dataTimeArray['today']['recharge']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['withdrawal']) ? htmlentities($dataTimeArray['today']['withdrawal']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['task']) ? htmlentities($dataTimeArray['today']['task']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['rebate']) ? htmlentities($dataTimeArray['today']['rebate']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['regment']) ? htmlentities($dataTimeArray['today']['regment']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['buymembers']) ? htmlentities($dataTimeArray['today']['buymembers']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['spread']) ? htmlentities($dataTimeArray['today']['spread']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['pump']) ? htmlentities($dataTimeArray['today']['pump']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['revoke']) ? htmlentities($dataTimeArray['today']['revoke']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['commission']) ? htmlentities($dataTimeArray['today']['commission']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['today']['other']) ? htmlentities($dataTimeArray['today']['other']) : 0; ?></td>
                                </tr>
                                <tr>
                                    <td>昨日统计</td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['recharge']) ? htmlentities($dataTimeArray['yesterday']['recharge']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['withdrawal']) ? htmlentities($dataTimeArray['yesterday']['withdrawal']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['task']) ? htmlentities($dataTimeArray['yesterday']['task']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['rebate']) ? htmlentities($dataTimeArray['yesterday']['rebate']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['regment']) ? htmlentities($dataTimeArray['yesterday']['regment']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['buymembers']) ? htmlentities($dataTimeArray['yesterday']['buymembers']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['spread']) ? htmlentities($dataTimeArray['yesterday']['spread']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['pump']) ? htmlentities($dataTimeArray['yesterday']['pump']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['revoke']) ? htmlentities($dataTimeArray['yesterday']['revoke']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['commission']) ? htmlentities($dataTimeArray['yesterday']['commission']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['yesterday']['other']) ? htmlentities($dataTimeArray['yesterday']['other']) : 0; ?></td>
                                </tr>
                                <tr>
                                    <td>本周统计</td>
                                    <td><?php echo !empty($dataTimeArray['week']['recharge']) ? htmlentities($dataTimeArray['week']['recharge']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['withdrawal']) ? htmlentities($dataTimeArray['week']['withdrawal']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['task']) ? htmlentities($dataTimeArray['week']['task']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['rebate']) ? htmlentities($dataTimeArray['week']['rebate']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['regment']) ? htmlentities($dataTimeArray['week']['regment']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['buymembers']) ? htmlentities($dataTimeArray['week']['buymembers']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['spread']) ? htmlentities($dataTimeArray['week']['spread']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['pump']) ? htmlentities($dataTimeArray['week']['pump']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['revoke']) ? htmlentities($dataTimeArray['week']['revoke']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['commission']) ? htmlentities($dataTimeArray['week']['commission']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['week']['other']) ? htmlentities($dataTimeArray['week']['other']) : 0; ?></td>
                                </tr>
                                <tr>
                                    <td>本月统计</td>
                                    <td><?php echo !empty($dataTimeArray['month']['recharge']) ? htmlentities($dataTimeArray['month']['recharge']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['withdrawal']) ? htmlentities($dataTimeArray['month']['withdrawal']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['task']) ? htmlentities($dataTimeArray['month']['task']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['rebate']) ? htmlentities($dataTimeArray['month']['rebate']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['regment']) ? htmlentities($dataTimeArray['month']['regment']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['buymembers']) ? htmlentities($dataTimeArray['month']['buymembers']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['spread']) ? htmlentities($dataTimeArray['month']['spread']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['pump']) ? htmlentities($dataTimeArray['month']['pump']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['revoke']) ? htmlentities($dataTimeArray['month']['revoke']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['commission']) ? htmlentities($dataTimeArray['month']['commission']) : 0; ?></td>
                                    <td><?php echo !empty($dataTimeArray['month']['other']) ? htmlentities($dataTimeArray['month']['other']) : 0; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="layui-card">
                    <div class="layui-card-body">
                        <table class="layui-table" lay-even lay-size="sm">
                            <thead>
                                <tr>
                                    <th>排行TOP10</th>
                                    <th>会员账号</th>
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
                                
                                
                                <tr>
                                    <td><?php echo !empty($value['rank']) ? htmlentities($value['rank']) : 0; ?></td>
                                    <td><?php echo !empty($value['username']) ? htmlentities($value['username']) : 0; ?></td>
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
                                
                                
                                <tr>
                                    <td colspan="13">暂无数据</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div> -->
                <div class="layui-card">
                    <div class="layui-card-body">
                        <table class="layui-table" lay-even lay-size="sm">
                            <thead>
                                <tr>
                                    <th>今日注册</th>
                                    <th>昨日注册</th>
                                    <th>本月注册</th>
                                    <th>总人数</th>
                                    <th>当前余额</th>
                                    <th>当前总资产</th>
                                    <th>当前在线人数</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo !empty($total['todayReg']) ? htmlentities($total['todayReg']) : 0; ?></td>
                                    <td><?php echo !empty($total['yesterdayReg']) ? htmlentities($total['yesterdayReg']) : 0; ?></td>
                                    <td><?php echo !empty($total['monthReg']) ? htmlentities($total['monthReg']) : 0; ?></td>
                                    <td><?php echo !empty($total['countUser']) ? htmlentities($total['countUser']) : 0; ?></td>
                                    <td><?php echo !empty($total['balance']) ? htmlentities($total['balance']) : 0; ?></td>
                                    <td><?php echo !empty($total['total_balance']) ? htmlentities($total['total_balance']) : 0; ?></td>
                                    <td><?php echo !empty($total['online']) ? htmlentities($total['online']) : 0; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/report.js"></script>
</body>
</html>