<?php /*a:1:{s:78:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/bank/lists.html";i:1609314392;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>银行配置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/resource/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>
    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <form class="layui-form" action="">
                        <table class="layui-table" lay-even lay-size="sm">
                            <thead>
                                <tr>
                                    <th>银行名称</th>
                                    <th>直连代码</th>
                                    <th>取款开关</th>
                                    <th>取款开始</th>
                                    <th>取款结束</th>
                                    <th>最小取款（元）</th>
                                    <th>最大取款（元）</th>
                                    <th>充值开关</th>
                                    <th>充值开始</th>
                                    <th>充值结束</th>
                                    <th>最小充值（元）</th>
                                    <th>最大充值（元）</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($data): foreach($data as $key=>$value): ?>
                                <tr>
                                    <td style="text-align:left;"><?php echo htmlentities($value['name']); ?>-<?php echo htmlentities($value['type']); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="layui-btn-group">
                                            <button type="button" class="layui-btn layui-btn-xs" onClick="bankAdd(this,<?php echo htmlentities($value['id']); ?>)">
                                                <i class="layui-icon">&#xe654;</i>
                                            </button>
                                            <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" onClick="pubdel(this,<?php echo htmlentities($value['id']); ?>,'recharge_channel_delete')">
                                                <i class="layui-icon">&#xe640;</i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php foreach($value['bankList'] as $key2=>$value2): ?>
                                <tr>
                                    <td style="text-align:left;">
                                        <?php if($key2 == count($value['bankList'])-1): ?>&ensp;&ensp;└─&nbsp;&nbsp;<?php else: ?>&ensp;&ensp;├─&nbsp;&nbsp;<?php endif; ?>
                                        <?php echo htmlentities($value2['bank_name']); ?>
                                    </td>
                                    <td><?php echo htmlentities($value2['bank_code']); ?></td>
                                    <td>
                                        <input type="checkbox" name="q_state" value="<?php echo htmlentities($value2['id']); ?>" lay-skin="switch" lay-text="开|关" lay-filter="rechargeBankStatus" data-field="q_state"<?php if($value2['q_state'] == 1): ?> checked<?php endif; ?>>
                                    </td>
                                    <td><?php echo htmlentities($value2['q_start_time']); ?></td>
                                    <td><?php echo htmlentities($value2['q_end_time']); ?></td>
                                    <td><?php echo htmlentities($value2['q_min']); ?></td>
                                    <td><?php echo htmlentities($value2['q_max']); ?></td>
                                    <td>
                                        <input type="checkbox" name="c_state" value="<?php echo htmlentities($value2['id']); ?>" lay-skin="switch" lay-text="开|关" lay-filter="rechargeBankStatus" data-field="c_state"<?php if($value2['c_state'] == 1): ?> checked<?php endif; ?>>
                                    </td>
                                    <td><?php echo htmlentities($value2['c_start_time']); ?></td>
                                    <td><?php echo htmlentities($value2['c_end_time']); ?></td>
                                    <td><?php echo htmlentities($value2['c_min']); ?></td>
                                    <td><?php echo htmlentities($value2['c_max']); ?></td>
                                    <td>
                                        <div class="layui-btn-group">
                                            <button type="button" class="layui-btn layui-btn-xs layui-btn-warm" onClick="pubedit(this,<?php echo htmlentities($value2['id']); ?>,'edit','编辑银行','40%','80%')">
                                                <i class="layui-icon">&#xe642;</i>
                                            </button>
                                            <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" onClick="pubdel(this,<?php echo htmlentities($value2['id']); ?>,'delete')">
                                                <i class="layui-icon">&#xe640;</i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="13">暂无数据</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/bank.js"></script>
</body>
</html>