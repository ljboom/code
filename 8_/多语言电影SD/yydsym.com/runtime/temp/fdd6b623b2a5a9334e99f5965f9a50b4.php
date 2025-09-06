<?php /*a:1:{s:80:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/base/setting.html";i:1658339596;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>基本设置</title>
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
                <div class="layui-card-body">
                    <form class="layui-form" action="">
                        <div class="layui-tab layui-tab-card">
                            <ul class="layui-tab-title">
                                <li class="layui-this">基本设置</li>
                                <li>信用设置</li>
                                <li>文件上传</li>
                                <li>风格设置</li>

                                <li>语言设置</li>
                            </ul>
                            <div class="layui-tab-content">
                                <!-- 基本设置 -->
                                <div class="layui-tab-item layui-show">
                                    <table class="layui-table" lay-even lay-skin="nob" lay-size="sm">
                                        <thead></thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">前台域名/地址</label>
                                                        <div class="layui-input-inline">
                                                            <textarea name="q_server_name" placeholder="请输入前台域名/地址" class="layui-textarea"><?php echo htmlentities($data['q_server_name']); ?></textarea>
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">开头必须加通信协议，末尾不要留斜杠。如：https://www.baidu.com</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">后台域名/地址</label>
                                                        <div class="layui-input-inline">
                                                            <textarea name="h_server_name" placeholder="请输入后台域名/地址" class="layui-textarea"><?php echo htmlentities($data['h_server_name']); ?></textarea>
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">开头必须加通信协议，末尾不要留斜杠。如：https://www.baidu.com</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">后台网站标题</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="manage_title" value="<?php echo htmlentities($data['manage_title']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">商户后台网站标题</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="admin_title" value="<?php echo htmlentities($data['admin_title']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">后台登录IP过滤</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="manage_ip_white" value="1" title="是"<?php echo $data['manage_ip_white']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="manage_ip_white" value="2" title="否"<?php echo $data['manage_ip_white']==2 ? ' checked'  :  ''; ?>>
                                                            <!-- <input type="checkbox" name="manage_ip_white"<?php echo $data['manage_ip_white']==1 ? ' checked'  :  ''; ?> lay-skin="switch" lay-filter="manage_ip_white" lay-text="开|关"> -->
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">
                                                            <button type="button" class="layui-btn layui-btn-xs" onclick="window.location.href='/manage/base/ip_white'">去添加IP</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">客服链接</label>
                                                        <div class="layui-input-inline">
                                                            <textarea name="service_url" placeholder="请输入客服链接" class="layui-textarea"><?php echo htmlentities($data['service_url']); ?></textarea>
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">备案号</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="record_number" value="<?php echo htmlentities($data['record_number']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">服务热线</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="service_hotline" value="<?php echo htmlentities($data['service_hotline']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">官方QQ</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="official_QQ" value="<?php echo htmlentities($data['official_QQ']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">客服QQ</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="Customer_QQ" value="<?php echo htmlentities($data['Customer_QQ']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">上级返点</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="rebate1" value="<?php echo htmlentities($data['rebate1']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">次上级返点</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="rebate2" value="<?php echo htmlentities($data['rebate2']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">次次上级返点</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="rebate3" value="<?php echo htmlentities($data['rebate3']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td><div class="layui-form-item">
                                                        <label class="layui-form-label">邀请奖励</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="regment" value="<?php echo htmlentities($data['regment']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">最低提现金额</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="min_w" value="<?php echo htmlentities($data['min_w']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td><div class="layui-form-item">
                                                        <label class="layui-form-label">最高提现金额</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="max_w" value="<?php echo htmlentities($data['max_w']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">提现翻倍次数</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="min_txcs" value="<?php echo htmlentities($data['min_txcs']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">例如：4 提现次后范围</div>
                                                    </div>
                                                </td>
                                                <td><div class="layui-form-item">
                                                        <label class="layui-form-label">提现翻倍次数</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="min_txbs" value="<?php echo htmlentities($data['min_txbs']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">VIP设置数*次数</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">充值奖励次数</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="hiton_promote" value="<?php echo htmlentities($data['hiton_promote']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">=1不重复发放 =2可以重复发放  =0关闭充值返点</div>
                                                    </div>
                                                </td>
                                                <td><div class="layui-form-item">
                                                        <label class="layui-form-label">提现手续费设置</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="ht_fee" value="<?php echo htmlentities($data['ht_fee']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">0.01=1%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">自动审核</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="auto_audit" value="1" title="是"<?php echo $data['auto_audit']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="auto_audit" value="2" title="否"<?php echo $data['auto_audit']==2 ? ' checked'  :  ''; ?>>
                                                            <!-- <input type="checkbox" name="manage_ip_white"<?php echo $data['manage_ip_white']==1 ? ' checked'  :  ''; ?> lay-skin="switch" lay-filter="manage_ip_white" lay-text="开|关"> -->
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
<div class="layui-form-item">
                                                        <label class="layui-form-label">提现公告</label>
                                                        <div class="layui-input-inline">
                                                            <textarea name="info_w" placeholder="请输入提现提示" class="layui-textarea"><?php echo htmlentities($data['info_w']); ?></textarea>
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">注册链接</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="reg_url" value="<?php echo htmlentities($data['reg_url']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                <div class="layui-form-item">
                                                        <label class="layui-form-label">注册短信</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="is_sms" value="1" title="开"<?php echo $data['is_sms']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="is_sms" value="2" title="关"<?php echo $data['is_sms']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">注册人数</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="reg_code_num" value="<?php echo htmlentities($data['reg_code_num']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">网站币种</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="currency" value="<?php echo htmlentities($data['currency']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">注册邀请码</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="is_rec_code" value="1" title="必填"<?php echo $data['is_rec_code']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="is_rec_code" value="0" title="选填"<?php echo $data['is_rec_code']==0 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div> 
                                                </td>
                                                 <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">前台默认语言</label>
                                                        <div class="layui-input-inline">
                                                            <select name="default_language" lay-search="">
                                                                <option <?php if($data['default_language'] == 'cn'): ?>selected<?php endif; ?> value="cn">简体中文</option>
                                                                <option <?php if($data['default_language'] == 'en'): ?>selected<?php endif; ?>  value="en">English</option>
                                                                <option <?php if($data['default_language'] == 'ft'): ?>selected<?php endif; ?>  value="ft">繁體中文</option>
                                                                <option <?php if($data['default_language'] == 'vi'): ?>selected<?php endif; ?>  value="vi">越南语言</option>
                                                                <option <?php if($data['default_language'] == 'th'): ?>selected<?php endif; ?>  value="th">泰语</option>
                                                                <option <?php if($data['default_language'] == 'id'): ?>selected<?php endif; ?>  value="id">印度尼西亚语言</option>
                                                                <option <?php if($data['default_language'] == 'ja'): ?>selected<?php endif; ?>  value="ja">日语</option>
                                                                <option <?php if($data['default_language'] == 'es'): ?>selected<?php endif; ?>  value="es">西班牙语</option>
                                                                <option <?php if($data['default_language'] == 'yd'): ?>selected<?php endif; ?>  value="yd">印度语</option>
                                                                <option <?php if($data['default_language'] == 'ma'): ?>selected<?php endif; ?>  value="ma">马来语</option>
                                                                <option <?php if($data['default_language'] == 'pt'): ?>selected<?php endif; ?>  value="pt">葡萄牙语</option>
                                                            </select>
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td><div class="layui-form-item">
                                                        <label class="layui-form-label">短信账号</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="sms_user" value="<?php echo htmlentities($data['sms_user']); ?>" required  lay-verify="" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div></td>
                                                <td><div class="layui-form-item">
                                                        <label class="layui-form-label">短信密码</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="sms_pwd" value="<?php echo htmlentities($data['sms_pwd']); ?>" required  lay-verify="" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">开通云管家最低会员等级</label>
                                                        <div class="layui-input-inline">
                                                            <select name="robot_level" lay-search="">
                                                                <?php foreach($user_grades as $key=>$value): ?>
                                                                    <option <?php if($data['robot_level'] == $value['grade']): ?>selected<?php endif; ?> value="<?php echo htmlentities($value['grade']); ?>"><?php echo htmlentities($value['name']); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">活动链接</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="activity_url" value="<?php echo htmlentities($data['activity_url']); ?>"   placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">不填写则不显示入口</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">网站名称</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="web_title" value="<?php echo htmlentities($data['web_title']); ?>" required  lay-verify="" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux">前端显示网站名称</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">APP下载地址</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="app_down" value="<?php echo htmlentities($data['app_down']); ?>" required  lay-verify="" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- 信用社治 -->
                                <div class="layui-tab-item">
                                    <table class="layui-table" lay-even lay-skin="nob" lay-size="sm">
                                        <thead></thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">用户注册</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="reg_init" value="<?php echo htmlentities($data['reg_init']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">任务</label>
                                                        <div class="layui-input-inline">
                                                            信用低于<input type="text" name="credit_points_lt" value="<?php echo htmlentities($data['credit_points_lt']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">， 每天只能报名完成<input type="text" name="credit_points_task" value="<?php echo htmlentities($data['credit_points_task']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">次任务
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">封号信用分</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="credit_points_close" value="<?php echo htmlentities($data['credit_points_close']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="display:none">
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">签到（加）</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="signin_push" value="<?php echo htmlentities($data['signin_push']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">完成当日任务（加）</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="first_win_push" value="<?php echo htmlentities($data['first_win_push']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr >
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">未完成当日任务（减）</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="overdue_ded" value="<?php echo htmlentities($data['overdue_ded']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">当日新增直推会员（加）</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="add_xinyong" value="<?php echo htmlentities($data['add_xinyong']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">当日未新增直推会员（减）</label>
                                                        <div class="layui-input-inline">
                                                            <input type="text" name="del_xinyong" value="<?php echo htmlentities($data['del_xinyong']); ?>" required  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                        <div class="layui-form-mid layui-word-aux"></div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- 文件上传 -->
                                <div class="layui-tab-item">
                                    <table class="layui-table" lay-even="" lay-skin="nob" lay-size="sm">
                                            <tr>
                                            	<td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">手机客户端</label>
                                                        <div class="layui-input-inline">
                                                            <div class="layui-upload">
                                                                <button type="button" class="layui-btn" id="mobile_client">
                                                                    <i class="layui-icon">&#xe67c;</i>上传图片
                                                                </button>
                                                                <div class="layui-upload-list">
                                                                    <img class="layui-upload-img" id="mobile_client_image" src="<?php echo isset($data['Mobile_client']) ? htmlentities($data['Mobile_client']) : ''; ?>">
                                                                    <p id="mobile_client_text"></p>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="Mobile_client" value="<?php echo htmlentities($data['Mobile_client']); ?>" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">微信公众号</label>
                                                        <div class="layui-input-inline">
                                                            <div class="layui-upload">
                                                                <button type="button" class="layui-btn" id="wechat_official">
                                                                    <i class="layui-icon">&#xe67c;</i>上传图片
                                                                </button>
                                                                <div class="layui-upload-list">
                                                                    <img class="layui-upload-img" id="wechat_official_image" src="<?php echo isset($data['WeChat_official']) ? htmlentities($data['WeChat_official']) : ''; ?>">
                                                                    <p id="wechat_official_text"></p>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="WeChat_official" value="<?php echo htmlentities($data['WeChat_official']); ?>" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">合同公章</label>
                                                        <div class="layui-input-inline">
                                                            <div class="layui-upload">
                                                                <button type="button" class="layui-btn" id="seal_img">
                                                                    <i class="layui-icon">&#xe67c;</i>上传图片
                                                                </button>
                                                                <div class="layui-upload-list">
                                                                    <img class="layui-upload-img" id="seal_img_image" src="<?php echo isset($data['seal_img']) ? htmlentities($data['seal_img']) : ''; ?>">
                                                                    <p id="seal_img_text"></p>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="seal_img" value="<?php echo htmlentities($data['seal_img']); ?>" placeholder="" autocomplete="off" class="layui-input">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                
                                
                                  <!-- 风格设置 -->
                                <div class="layui-tab-item">
                                    <table class="layui-table" lay-even lay-skin="nob" lay-size="sm">
                                        <thead></thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                   <div class="layui-form-item">
                                                          <label class="layui-form-label">
                                                              风格选择
                                                          </label>
                                                          <div class="layui-input-block">
                                                            <select name="fengge" lay-verify="required">
                                                              <option <?php if($data['fengge'] == 'xml'): ?>selected<?php endif; ?> value="xml">默认(xml)</option>
                                                              <option <?php if($data['fengge'] == 'spring'): ?>selected<?php endif; ?> value="spring">银白色（spring）</option>
                                                              <option <?php if($data['fengge'] == 'summer'): ?>selected<?php endif; ?> value="summer">浅橙色（summer）</option>
                                                               <option <?php if($data['fengge'] == 'autumn'): ?>selected<?php endif; ?> value="autumn">紫色（autumn）</option>
                                                                <option <?php if($data['fengge'] == 'winter'): ?>selected<?php endif; ?> value="winter">浅绿色（winter）</option>
                                                            
                                                            </select>
                                                            <div class="layui-unselect layui-form-select layui-form-selected">
                                                                <div class="layui-select-title">
                                                                    <input type="text" placeholder="请选择" value="" readonly="" class="layui-input layui-unselect">
                                                                    <i class="layui-edge"></i>
                                                               </div>
                                                               <dl class="layui-anim layui-anim-upbit" style="">
                                                                   <dd lay-value="" class="layui-select-tips <?php if($data['fengge'] == 'xml'): ?>layui-this<?php endif; ?>">xml</dd>
                                                                    <dd lay-value="" class="layui-select-tips <?php if($data['fengge'] == 'xml'): ?>layui-this<?php endif; ?>">cml</dd>
                                                               </dl>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                                                                
                               
                                  <!-- 语言设置 -->
                                <div class="layui-tab-item">
                                    <table class="layui-table" lay-even lay-skin="nob" lay-size="sm">
                                        <thead></thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">简体中文</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="cn" value="1" title="开启"<?php echo $data['cn']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="cn" value="2" title="关闭"<?php echo $data['cn']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">繁体中文</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="ft" value="1" title="开启"<?php echo $data['ft']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="ft" value="2" title="关闭"<?php echo $data['ft']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">英语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="en" value="1" title="开启"<?php echo $data['en']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="en" value="2" title="关闭"<?php echo $data['en']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">印尼语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="yny" value="1" title="开启"<?php echo $data['yny']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="yny" value="2" title="关闭"<?php echo $data['yny']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">越南语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="vi" value="1" title="开启"<?php echo $data['vi']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="vi" value="2" title="关闭"<?php echo $data['vi']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">日语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="jp" value="1" title="开启"<?php echo $data['jp']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="jp" value="2" title="关闭"<?php echo $data['jp']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">西班牙语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="es" value="1" title="开启"<?php echo $data['es']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="es" value="2" title="关闭"<?php echo $data['es']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">泰语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="ty" value="1" title="开启"<?php echo $data['ty']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="ty" value="2" title="关闭"<?php echo $data['ty']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">印度语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="yd" value="1" title="开启"<?php echo $data['yd']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="yd" value="2" title="关闭"<?php echo $data['yd']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">马来语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="ma" value="1" title="开启"<?php echo $data['ma']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="ma" value="2" title="关闭"<?php echo $data['ma']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label">葡萄牙语</label>
                                                        <div class="layui-input-inline">
                                                            <input type="radio" name="pt" value="1" title="开启"<?php echo $data['pt']==1 ? ' checked'  :  ''; ?>>
                                                            <input type="radio" name="pt" value="2" title="关闭"<?php echo $data['pt']==2 ? ' checked'  :  ''; ?>>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="layui-form-item" style="margin-top: 40px;text-align: center;">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="settingedit">立即提交</button>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/resource/plugs/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/resource/plugs/ueditor/ueditor.all.min.js"></script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" src="/resource/plugs/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/base.js"></script>
<script>
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
var ue  = UE.getEditor('editor');
var ue2 = UE.getEditor('editor2');
var ue3 = UE.getEditor('editor3');
var ue4 = UE.getEditor('editor4');
var ue5 = UE.getEditor('editor5');
var ue6 = UE.getEditor('editor6');
var ue7 = UE.getEditor('editor7');
</script>
</body>
</html>
