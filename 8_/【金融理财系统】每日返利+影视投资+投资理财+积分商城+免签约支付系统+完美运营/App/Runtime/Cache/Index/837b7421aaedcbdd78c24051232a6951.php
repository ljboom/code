<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理 - 会员管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/page.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/style.css" />
    <link rel="stylesheet" href="/Public/admin/css/jquery.datetimepicker.css"/>
    <script src="/Public/admin/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/Public/admin/js/jquery.datetimepicker.js"></script>
    <script type="text/javascript" src="/Public/admin/js/public.js"></script>
</head>
<body>
<div class="main">
    <div class="main_left">
        <p class="pub_tit">后台管理系统</p>
        <ul>
            <li class="menu_index">
                <a href="<?php echo U('index');?>">工作台</a>
                <i></i>
            </li>
            <li class="menu_user">
                <p>会员管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('user_list');?>">会员列表</a>
                    <a href="<?php echo U('user_vip');?>">等级设置</a>
                    <a href="<?php echo U('user_relation');?>">会员关联网</a>
                    <a href="<?php echo U('user_yhk_list');?>">关联银行卡管理</a>
                </div>
                <i class="four"></i>
            </li>
            <li class="menu_finance">
                <p>财务管理</p>
                <div  class="son_menu">
                    <a href="<?php echo U('finance_payment');?>">充值记录</a>
                    <a href="<?php echo U('finance_invoice');?>">提现申请</a>
                    <a href="<?php echo U('finance_stream');?>">流水记录查询</a>
                </div>
                <i class="three"></i>
            </li>
            <li class="menu_project">
                <p>项目管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('project_list');?>">项目列表</a>
                    <a href="<?php echo U('project_alreay');?>">已投项目</a>
                    
                    <a href="<?php echo U('project_class');?>">项目分类</a>
                </div>
                <i class="two"></i>
            </li>
            <li class="menu_article">
                <p>文章管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('article_type');?>">文章类型</a>
                    <a href="<?php echo U('article_list');?>">文章列表</a>
                </div>
                <i class="five"></i>
            </li>
            <li class="menu_system">
                <p>系统设置</p>
                <div class="son_menu">
                    <a href="<?php echo U('system_info');?>">网站信息</a>
                    <a href="<?php echo U('system_reward');?>">奖励设置</a>
                    <a href="<?php echo U('system_banner');?>">幻灯片设置</a>
                    <a href="<?php echo U('system_contract');?>">合同章设置</a>
                    <a href="<?php echo U('system_message');?>">短信设置</a>
                    <a href="<?php echo U('system_payment');?>">支付设置</a>
                    <a href="<?php echo U('system_safe');?>">安全设置</a>
                    <a href="<?php echo U('system_pwd');?>">密码设置</a>
                    <a href="<?php echo U('system_img');?>">图片设置</a>
                    <a href="<?php echo U('system_activity');?>">活动设置</a>
                </div>
                <i class="six"></i>
            </li>
			<!--<li class="menu_goods">
                <p>商城管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('goods_list');?>">商品列表</a>
                    <a href="<?php echo U('classify');?>">商品分类</a>
                
                   
                </div>
                <i class="seven"></i>
            </li>
			<li class="menu_order">
                <p>订单管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('order',array('state'=>'1','se'=>'259'));?>">待付款</a>
                    <a href="<?php echo U('order',array('state'=>'2','se'=>'260'));?>">待发货</a>
                    <a href="<?php echo U('order',array('state'=>'3','se'=>'261'));?>">待收货</a>
                    <a href="<?php echo U('order',array('state'=>'4','se'=>'262'));?>">已完成</a>
                
                   
                </div>
                <i class="seven"></i>
            </li>
			<li class="menu_lottery">
                <p>转盘管理</p>
                <div class="son_menu">
                    <a href="<?php echo U('lottery');?>">抽奖设置</a>
                    <a href="<?php echo U('goods_lottery');?>">抽奖名单</a>
                 
                </div>
                <i class="seven"></i>-->
            </li>
        </ul>
    </div>
    <div class="main_right">
        <div class="header">
            <!--<div class="search"><input type="text" placeholder="搜索"><i></i></div>-->
            <div class="title_right">
                <div class="act">
                    <iframe src="" height="1" width="1" frameborder="0" id="ifr"></iframe>
                    欢迎您，管理员[<?php echo ($_SESSION['isAdminUser']); ?>]<img src="/Public/admin/img/down.png">
                    <a href="<?php echo U('logout');?>" class="logout">退出</a>
                </div>
            </div>
        </div>
<head>
<title><?php echo ($sys['sys_name']); ?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="/Public/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/Public/Admin/css/font-awesome.min.css?v=4.1" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/Public/Admin/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="/Public/Admin/css/animate.min.css" rel="stylesheet">  
    <link href="/Public/Admin/css/style.min.css?v=4.0.0" rel="stylesheet">	
    <link href="/Public/Admin/css/uploadfile.css" rel="stylesheet">
   	<script src="/Public/Admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Public/Common/layer/layer.js"></script>
    <script src="/Public/Admin/js/jquery.form.js"></script>
</head>


        <p class="curr">
            <a>会员管理</a>&gt;&gt;
            <span>会员列表</span>
        </p>
        <div class="content">
            <div class="list_main">
                <div class="title">
                    <form action="<?php echo U('user_list');?>" method="get">
                        <input type="hidden" name="online" value="<?php echo ($_GET['online']); ?>"/>
                        <p>
                           <label>用户姓名</label><input type="text" name="name" value="<?php echo ($_GET['name']); ?>" class="txt">
                           <label>手机号码</label><input type="text" name="phone" value="<?php echo ($_GET['phone']); ?>">&nbsp;&nbsp;
                           <label>注册IP</label><input type="text" name="reg_ip" value="<?php echo ($_GET['reg_ip']); ?>">&nbsp;&nbsp;
						    <label>会员总数：</label><label><?php echo count(getData('user','all'));?>人</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<label>在线人数：</label><label><?php echo getUserOnlineNum();?>人</label>
                        </p>
                        <p>
                           <label>会员等级</label><!-- 
                            --><select name="member">
                               <option value="0">全部</option>
                               <?php $_result=getData('user_member','all','','','value asc');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i; if($m['id'] == $_GET['member']): ?><option value="<?php echo ($m["id"]); ?>" selected="selected"><?php echo ($m["name"]); ?></option>
                                       <?php else: ?>
                                       <option value="<?php echo ($m["id"]); ?>"><?php echo ($m["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                           </select>
                           <input type="submit" class="sub1" value="查询">
                            <a href="<?php echo U('user_add');?>" class="two">添加会员</a>
                            <a href="<?php echo U('user_list','online=1');?>" class="three">在线会员</a>
                            <a href="<?php echo U('user_setmoney');?>" class="six">增减余额</a>
                            <?php if($isWin == 1): ?><a href="<?php echo U('user_analysis');?>" class="five">分析数据</a>
                                <?php else: ?>
                                <a href="javascript:;" onclick="alert('Windows以外的系统暂时不能使用！')" class="five">分析数据</a><?php endif; ?>
                        </p>
                    </form>
                </div>
                <div class="width_table">
	                <table style="width:1900px;">
	                    <tbody>
	                        <tr>
	                            <th>ID</th>
	                            <th>姓名</th>
	                            <th>手机号</th>
	                            <th>状态</th>
	                            <th>会员等级</th>
                                <th>推荐人手机号</th>
                                <th>注册IP</th>
	                            <th>账户余额</th>
	                            <th>账户积分</th>
								<th>提现总额</th>
								<th>投资总额</th>
								<th>待收利息</th>
								<th>待收本金</th>
								<th>成长值</th>
								<th>时间</th>
								<!--<th>登录IP</th>-->
	                            <th>冻结</th>
	                            <th style="width:200px">操作</th>
	                        </tr><?php  $Ip = new \Org\Net\IpLocation('UTFWry.dat'); ?>
                            <?php $_result=getData('user','all',$where,$limit,'id desc');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($u["id"]); ?></td>
                                    <td><?php echo ($u["name"]); ?></td>
                                    <td><?php echo ($u["phone"]); ?></td>
                                    <td>
                                        <?php if(getUserStatus($u['id']) == 1): ?><p style="background-color:#5cb85c;color:#fff;">在线</p>
                                            <?php else: ?>
                                            <p style="background-color:#ccc;color:#fff;">离线</p><?php endif; ?>
                                    </td>
                                    <td><?php echo getUserMember($u['member']);?></td>
                                    <td><?php echo getUserPhone($u['top']);?></td>
                                    <td><?php echo ($u["reg_ip"]); ?><hr><?php
 $area = $Ip->getlocation($u["reg_ip"]); echo mb_convert_encoding($area['country'], "UTF-8", "GBK").mb_convert_encoding($area['area'], "UTF-8", "GBK"); ?></td>
                                    <td><?php echo ($u["money"]); ?></td>
                                    <td><?php echo ($u["jifen"]); ?></td>
                                    <td><?php echo getUserCashMoney($u['id']);?></td>
                                    <td><?php echo getUserInvestMoney($u['id']);?></td>
                                    <td><?php echo getUserUnIncome($u['id']);?></td>
                                    <td><?php echo getUserUnPrincipal($u['id']);?></td>
                                    <td><?php echo ($u["value"]); ?></td>
                                    <td>注册时间：<?php echo ($u["time"]); ?>
                                        <br>最近操作：<?php echo date('Y-m-d H:i:s',$u['logintime']);?>
                                    </td>
                                    <!--<td>500.00</td>-->
                                    <td>
                                        <?php if($u['clock'] == 0): ?><p style="background-color:#5cb85c;color:#fff;padding:5px 0;">正常</p>
                                            <?php else: ?>
                                            <p style="background-color:red;color:#fff;padding:5px 0;">冻结</p><?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo U('user_details','id='.$u['id']);?>" class="status_three">详情</a>
                                        <?php if($u['clock'] == 0): ?><a href="javascript:;" onclick="upStatus(<?php echo ($u['id']); ?>,2)" class="status_four">冻结</a>
                                            <?php else: ?>
                                            <a href="javascript:;" onclick="upStatus(<?php echo ($u['id']); ?>,1)" class="status_one">解冻</a><?php endif; ?> 
												<a href="<?php echo U('user_distribution','id='.$u['id']);?>" class="status_two">下线</a>
                                        	<a href="javascript:;" onclick="upStatus(<?php echo ($u['id']); ?>,3)" class="status_four">删除</a><!---->
                                        	<!-- <a href="javascript:;" onclick="fh(<?php echo ($u['id']); ?>)" class="status_three">发消息</a><!----> 
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	              
	                    </tbody>
	                </table>
                </div>
                <ul class="page">
                    <?php echo ($page); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal fade" id="myModal7" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4>输入信息</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal"  method="post" action="<?php echo U('chuhzg19tvgabxm/zhannei_add');?>" onsubmit="return toVaild()">
                    <input id="order_id" type="hidden" name="uid" value=""/>
           
                    <div class="form-group">
                        <label class="col-sm-3 control-label">消息</label>
                        <div class="col-sm-8">
                            <input type="text" name="content" id="kd_dh" placeholder="输入消息" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button class="btn btn-sm btn-primary" type="submit" style="float: right">发送</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script src="/Public/Admin/js/bootstrap.min.js?v=2.1.4"></script>
<script type="text/javascript">

 function fh(order_id) {
        $("#order_id").val(order_id);
        $("#myModal7").modal('show');
    }
    function upStatus(obj,type){
        var msg = "";
        if(type == 1){
            msg = "确认冻结该会员吗？";
        }
        if(type == 2){
            msg = "确认解冻该会员吗？";
        }
        if(type == 3){
            msg = "确认删除该会员吗？";
        }
        if(confirm(msg)){
//            window.location.href = "/admin/user_update_status/id/"+obj+"/type/"+type+".html?re=<?php echo U('');?>";
            window.location.href = "<?php echo U('user_update_status');?>?id="+obj+"&type="+type+"&re=<?php echo U('');?>";
        }
    }
</script>

<script type="text/javascript">
    function showPreview(source) {
        var file = source.files[0];
        if(window.FileReader) {
            var fr = new FileReader();
            console.log(fr);
            var portrait = document.getElementById('portrait');
            fr.onloadend = function(e) {
                portrait.src = e.target.result;
            };
            fr.readAsDataURL(file);
            portrait.style.display = 'block';
        }
    }
    function showPreview2(source,obj) {
        var file = source.files[0];
        if(window.FileReader) {
            var fr = new FileReader();
            console.log(fr);
            var portrait = document.getElementById(obj);
            fr.onloadend = function(e) {
                portrait.src = e.target.result;
            };
            fr.readAsDataURL(file);
            portrait.style.display = 'block';
        }
    }

    var menu = "menu_user";
    var nav = "0";
    console.log(nav);
    $(function(){
        $("."+menu+" p").addClass("down");
        $("."+menu+" .son_menu").css("display","block");
        $("."+menu+" .son_menu a").eq(nav).addClass("on");
        seeNum();
    });
    function seeNum(){
        var seeNumUrl = "<?php echo U('seeNum');?>";
        var rechargeState = 1;//充值声音开关，1开/0关
        $.ajax({
            type : "POST",
            url : seeNumUrl,
            data: {rechargeState:rechargeState},
            dataType : "json",
            success : function(result){
                if(result['code']!="000"){
                    $("#ifr").attr("src",result['url']);
                    //alert(result['msg']);
                }else{
                    $("#ifr").attr("src","");
                }
            },
            error:function(){
                //alert();
            }
        });
    }
    setInterval(seeNum,15000);
</script>
</body>
</html>