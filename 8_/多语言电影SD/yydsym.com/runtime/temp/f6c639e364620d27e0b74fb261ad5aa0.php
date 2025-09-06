<?php /*a:1:{s:77:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/user/edit.html";i:1612599876;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>编辑用户</title>
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
                            <table class="layui-table" lay-even lay-skin="nob">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">上级</label>
                                                <div class="layui-input-block">
                                                    <textarea placeholder="" class="layui-textarea" disabled="true"><?php echo htmlentities($userInfo['userSup']); ?></textarea>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">上级ID</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['sid']); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">该ID为上级ID</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">返点级别</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="rebate" value="<?php echo htmlentities($userInfo['rebate']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">当前返点级别</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">安全时间</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">登陆时间小于该时间不能登录</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">积分等级</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="grade" value="<?php echo htmlentities($userInfo['grade']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">积分等级</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">性别</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="sex" value="<?php echo htmlentities($userInfo['sex']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">性别</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">生日</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="birthday" value="<?php echo htmlentities($userInfo['birthday']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">生日</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">登录密码</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="password" value="" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">登录操作时验证的密码，不修改留空</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">取款密码</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="fund_password" value="" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">取款等操作时验证的密码，不修改留空</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">绑定银行</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['bankInfo']['bank_name']); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">开户地址</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['bankInfo']['bank_branch_name']); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">取款户名</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['bankInfo']['name']); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">取款卡号</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['bankInfo']['card_no']); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">充值总额</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['userTotal']['total_recharge']); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">最后充值</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['LastRecharge']); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">用户昵称</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="nickname" value="<?php echo htmlentities($userInfo['nickname']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">用户昵称</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">会员头像</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">可以直接修改该会员的头像地址</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">联系电话</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="phone" value="<?php echo htmlentities($userInfo['phone']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">联系电话</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">安全邮箱</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['mail']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">请不要随意填写，否则导致账户不安全</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">当前状态</label>
                                                <div class="layui-input-inline">
                                                    <select name="state" lay-verify="required" lay-search="">
                                                        <?php foreach($userState as $key=>$value): if($key): ?>
                                                        <option value="<?php echo htmlentities($key); ?>"<?php if($userInfo['state'] == $key): ?> selected<?php endif; ?>><?php echo htmlentities($value); ?></option>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">当前状态</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">注册时间</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($userInfo['reg_time'])? strtotime($userInfo['reg_time']) : $userInfo['reg_time'])); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">总共登录</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="" value="<?php echo htmlentities($userInfo['login_number']); ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">登录时间</label>
                                                <div class="layui-input-inline">
                                                    <input type="text"  value="<?php if($userInfo['last_login']): ?><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($userInfo['last_login'])? strtotime($userInfo['last_login']) : $userInfo['last_login'])); ?><?php endif; ?>" autocomplete="off" placeholder="" class="layui-input" readonly>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">只供查看，不能修改</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">QQ</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="qq" value="<?php echo htmlentities($userInfo['qq']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">QQ</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">抖音号</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="douyin" value="<?php echo htmlentities($userInfo['douyin']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">安全问题</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="question" value="<?php echo htmlentities($userInfo['question']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">安全问题</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">安全问题答案</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="answer" value="<?php echo htmlentities($userInfo['answer']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">安全问题答案</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">备注说明</label>
                                                <div class="layui-input-inline">
                                                    <textarea name="" value="" placeholder="请输入内容" class="layui-textarea"></textarea>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">备注说明</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">会员等级</label>
                                                <div class="layui-input-inline">
                                                    <select name="vip_level" lay-verify="required" lay-search="">
                                                        <?php foreach($userInfo['userVip'] as $key=>$value): ?>
                                                        <option value="<?php echo htmlentities($value['grade']); ?>"<?php if($userInfo['vip_level'] == $value['grade']): ?> selected<?php endif; ?>><?php echo htmlentities($value['name']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">当前状态(不能修改，跟vip会员有关联,需要改名会员)</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">信用</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="credit" value="<?php echo htmlentities($userInfo['credit']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">所属银行</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay_names" value="<?php echo htmlentities($userInfo['alipay_names']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux"></div>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">真实姓名</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay_name" value="<?php echo htmlentities($userInfo['alipay_name']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">银行卡号</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="alipay" value="<?php echo htmlentities($userInfo['alipay']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux"></div>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">实名认证</label>
                                                <div class="layui-input-inline">
                                                    <input type="text" name="realname" value="<?php echo htmlentities($userInfo['realname']); ?>" autocomplete="off" placeholder="" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid layui-word-aux"></div>
                                            </div>
                                        </td>
                                       <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">私发状态</label>
                                                <div class="layui-input-inline">
                                                    <select name="s_hb" lay-verify="required" lay-search="">
                                                        <option value="1"<?php if($userInfo['s_hb'] == 1): ?> selected<?php endif; ?>>允许</option>
                                                        <option value="2"<?php if($userInfo['s_hb'] == 2): ?> selected<?php endif; ?>>不允许</option>
                                                    </select>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">当前状态</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">自动好友</label>
                                                <div class="layui-input-inline">
                                                    <select name="is_auto_f" lay-verify="required" lay-search="">
                                                        <option value="1"<?php if($userInfo['is_auto_f'] == 1): ?> selected<?php endif; ?>>允许</option>
                                                        <option value="2"<?php if($userInfo['is_auto_f'] == 2): ?> selected<?php endif; ?>>不允许</option>
                                                    </select>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">当前状态</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">提现状态</label>
                                                <div class="layui-input-inline">
                                                    <select name="withdrawals_state" lay-verify="required" lay-search="">
                                                        <option value="1"<?php if($userInfo['withdrawals_state'] == 1): ?> selected<?php endif; ?>>开启</option>
                                                        <option value="2"<?php if($userInfo['withdrawals_state'] == 2): ?> selected<?php endif; ?>>关闭</option>
                                                    </select>
                                                </div>
                                                <div class="layui-form-mid layui-word-aux">当前状态</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="layui-form-item" style="margin-top: 40px;text-align: center;">
                                <input type="hidden" name="id" value="<?php echo htmlentities($userInfo['id']); ?>" autocomplete="off" class="layui-input">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="useredit">立即提交</button>
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