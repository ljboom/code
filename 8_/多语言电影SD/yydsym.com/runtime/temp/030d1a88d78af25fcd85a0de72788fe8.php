<?php /*a:1:{s:89:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/report/team_statistic.html";i:1657741426;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>团队报表</title>
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
                    <form class="layui-form" action="/manage/report/team_statistic" method="get">
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
                            <div class="layui-inline">
                                <label class="layui-form-label">过滤零结算</label>
                                <div class="layui-input-inline">
                                    <input type="checkbox" name="filter" title="" lay-skin="primary"<?php if(isset($where['filter']) and $where['filter'] == 'on'): ?> checked<?php endif; ?>>
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
                                <th>会员账号</th>
                                <th>锁定团队</th>
                                <th>团队人数</th>
                                <th>vip总人数</th>
                                <td>一级会员数</td>
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
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $key=>$value): ?>
                            <tr>
                                <td><?php echo isset($value['username2']) ? htmlentities($value['username2']) : 0; ?></td>
                                <td>
                                    <form class="layui-form search">
                                        <input type="checkbox" name="lockTeam" value="<?php echo htmlentities($value['id']); ?>" lay-skin="switch" lay-text="是|否" lay-filter="lockTeam" <?php echo $value['lock']==2 ? 'checked'  :  ''; ?>>
                                    </form>
                                </td>
                                <td><?php echo isset($value['teamCount']) ? htmlentities($value['teamCount']) : 0; ?></td>
                                <td><?php echo isset($value['vip_num']) ? htmlentities($value['vip_num']) : 0; ?></td>
                                <td><?php echo isset($value['vip_o_num']) ? htmlentities($value['vip_o_num']) : 0; ?></td>
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
                                <td>
                                    <div class="layui-btn-group">
                                        <?php if($value['sid'] != 0): ?>
                                        <button type="button" class="layui-btn layui-btn-sm" onClick="window.location.href='/manage/report/team_statistic?date_range=<?php echo htmlentities($where['date_range']); ?>&isUser=<?php echo htmlentities($where['isUser']); ?>&sid=<?php echo htmlentities($value['sid']); ?>'">上级</button>
                                        <?php endif; ?>
                                        <button type="button" class="layui-btn layui-btn-sm" onClick="window.location.href='/manage/report/team_statistic?date_range=<?php echo htmlentities($where['date_range']); ?>&isUser=<?php echo htmlentities($where['isUser']); ?>&id=<?php echo htmlentities($key); ?>'">下级</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>分页统计</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo !empty($total['totalPage']['recharge']) ? htmlentities($total['totalPage']['recharge']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['withdrawal']) ? htmlentities($total['totalPage']['withdrawal']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['task']) ? htmlentities($total['totalPage']['task']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['rebate']) ? htmlentities($total['totalPage']['rebate']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['regment']) ? htmlentities($total['totalPage']['regment']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['buymembers']) ? htmlentities($total['totalPage']['buymembers']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['spread']) ? htmlentities($total['totalPage']['spread']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['pump']) ? htmlentities($total['totalPage']['pump']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['revoke']) ? htmlentities($total['totalPage']['revoke']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['commission']) ? htmlentities($total['totalPage']['commission']) : 0; ?></td>
                                <td><?php echo !empty($total['totalPage']['other']) ? htmlentities($total['totalPage']['other']) : 0; ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>全部统计</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo !empty($total['totalAll']['recharge']) ? htmlentities($total['totalAll']['recharge']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['withdrawal']) ? htmlentities($total['totalAll']['withdrawal']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['task']) ? htmlentities($total['totalAll']['task']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['rebate']) ? htmlentities($total['totalAll']['rebate']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['regment']) ? htmlentities($total['totalAll']['regment']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['buymembers']) ? htmlentities($total['totalAll']['buymembers']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['spread']) ? htmlentities($total['totalAll']['spread']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['pump']) ? htmlentities($total['totalAll']['pump']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['revoke']) ? htmlentities($total['totalAll']['revoke']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['commission']) ? htmlentities($total['totalAll']['commission']) : 0; ?></td>
                                <td><?php echo !empty($total['totalAll']['other']) ? htmlentities($total['totalAll']['other']) : 0; ?></td>
                                <td></td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td colspan="15" style="text-align: center;">暂无数据</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php if($data): ?><?php echo $page; ?><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/report.js"></script>
</body>
</html>