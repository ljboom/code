<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理 - 文章管理</title>
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
        <p class="curr">
            <a>文章管理</a>&gt;&gt;
            <span>文章类型</span>
        </p>
        <div class="content">
            <div class="list_main">
                <div class="title">
                    <a class="two" onclick="showDiv('mask_add')">添加类型</a>
                    <a href="javascript:;" onclick="delCheck()" class="four">批量删除</a>
                </div>
                <table>
                    <tbody>

                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>编号</th>
                        <th>类型名称</th>
                        <th>类型图标</th>
                        <th>排序</th>
                        <th>电脑版显示</th>
                        <th>操作</th>
                    </tr>
                    <?php $_result=getData('article_type','all','','','sort');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><tr>
                            <td><input type="checkbox" name="ck[]" value="<?php echo ($t["id"]); ?>"></td>
                            <td data-id="<?php echo ($t["id"]); ?>"><?php echo ($t["id"]); ?></td>
                            <td data-name="<?php echo ($t["name"]); ?>"><?php echo ($t["name"]); ?></td>
                            <td data-name="<?php echo ($t["ico"]); ?>"><?php echo ($t["ico"]); ?></td>
                            <td data-sort="<?php echo ($t["sort"]); ?>"><?php echo ($t["sort"]); ?></td>
                            <td data-show="<?php echo ($t["show"]); ?>"> <?php if($t['show'] == 0): ?>否<?php else: ?>是<?php endif; ?></td>
                            <!--<td data-show="<?php echo ($t["show"]); ?>">
                                <?php if($t['show'] == 0): ?><div class="iosopen close">
                                        <div class="ios no on"></div>
                                        <span class="off no on">否</span>
                                    </div>
                                    <?php else: ?>
                                    <div class="iosopen">
                                        <div class="ios"></div>
                                        <span class="off">是</span>
                                    </div><?php endif; ?>
                            </td>-->
                            <td>
                                <a href="javascript:void(0);" class="update">编辑</a>
                                <a href="javascript:;" onclick="delList(<?php echo ($t["id"]); ?>)" class="del">删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <ul class="page">
                    <?php echo ($page); ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="mask_add" class="mask">
    <form class="popup" action="<?php echo U('article_type_add');?>" method="post">
        <h3>添加类型<span onclick="closeDiv('mask_add')">×</span></h3>
        <p>
            <label>类型名称</label>
            <input name="name" type="text">
        </p>
        <p>
            <label>显示排序</label>
            <input name="sort" type="number" min="0" max="99999">
        </p>
        <p>
            <label>电脑显示</label>
            <select name="show">
                <option value="1">是</option>
                <option value="0">否</option>
            </select>
        </p>
        <p>
            <label>分类图标</label>
            <select name="ico">
                <option value="notice">网站公告</option>
                <option value="company">公司简介</option>
                <option value="user">会员等级</option>
                <option value="safe">安全保障</option>
                <option value="tel">联系我们</option>
                <option value="photo">平台资质</option>
                <option value="pay">支付方式</option>
                <option value="help">帮助中心</option>
            </select>
        </p>
        <p><input type="submit" class="sub" value="确定添加"></p>
    </form>
</div>
<div id="mask_edit" class="mask"></div>
<script>
    $().ready(function(){
        $("tr .update").click(function(){
            $("#mask_edit").empty();
            var id = $(this).parent().prevAll("td:nth-child(2)").attr("data-id");
            var name = $(this).parent().prevAll("td:nth-child(3)").attr("data-name");
            var sort = $(this).parent().prevAll("td:nth-child(5)").attr("data-sort");
            var show = $(this).parent().prevAll("td:nth-child(6)").attr("data-show");
            var showvar = "";
            if(show==0){
                showvar = "<p><label>电脑显示</label><select name='show'><option value='1'>是</option><option value='0' selected='selected'>否</option></select></p>";
            }
            else{
                showvar = "<p><label>电脑显示</label><select name='show'><option value='1' selected='selected'>是</option><option value='0'>否</option></select></p>";
            }
            var html1 = "<form class='popup' action='<?php echo U("article_type_edit");?>' method='post'>\
    		             <h3>修改文章类型<span class='close_div'>×</span></h3>\
    		             <p><label>类型名称</label><input type='text' name='name' value='"+name+"'></p>\
    		             <p><label>显示排序</label><input type='number' name='sort' min='0' max='99999' value='"+sort+"'></p>\
    		             "+showvar+"\
    		             <p> <label>分类图标</label> <select name='ico'> <option value='notice'>网站公告</option> <option value='company'>公司简介</option> <option value='user'>会员等级</option> <option value='safe'>安全保障</option> <option value='tel'>联系我们</option> <option value='photo'>平台资质</option> <option value='pay'>支付方式</option> <option value='help'>帮助中心</option> </select> </p>\
    		             <input type='hidden' name='id' value='"+id+"'>\
    		             <p><input type='submit' class='sub' value='确定修改'></p>\
    		         </form>"
            $("#mask_edit").append(html1);
            $("#mask_edit").show();
        });
        $('#mask_edit').on('click','.close_div',function(){
            $("#mask_edit").hide();
        });
    });
    function delList(obj){
        if(confirm("确认删除这条记录吗？")){
//            window.location.href = "/admin/dellist/data/article_type/list/"+obj+".html?re=<?php echo U('article_type');?>";
            window.location.href = "<?php echo U('dellist');?>?data=article_type&list="+obj+"&re=<?php echo U('article_type');?>";
        }
    }
    function delCheck(){
        var arr = new Array();
        $("input[name='ck[]']:checked").each(function(i){
            arr[i] = $(this).val();
        });
        var vals = arr.join(",");
        if(vals != ""){
            delList(vals);
        }
        else{
            alert("请选择需要删除的内容！");
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

    var menu = "menu_article";
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