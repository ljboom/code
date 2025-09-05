<?php /*a:7:{s:62:"/www/wwwroot/test.dkewl.com/application/admin/view/role/edit.html";i:1618724626;s:59:"/www/wwwroot/test.dkewl.com/application/admin/view/layout.html";i:1618975294;s:63:"/www/wwwroot/test.dkewl.com/application/admin/view/common/nav.html";i:1618724626;s:66:"/www/wwwroot/test.dkewl.com/application/admin/view/common/header.html";i:1618724626;s:66:"/www/wwwroot/test.dkewl.com/application/admin/view/common/footer.html";i:1618724626;s:67:"/www/wwwroot/test.dkewl.com/application/admin/view/common/sidebar.html";i:1618724626;s:72:"/www/wwwroot/test.dkewl.com/application/admin/view/common/theme-config.html";i:1618724626;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities((app('config')->get('web_site_title') ?: 'MEAdmin')); ?> | <?php echo htmlentities((app('config')->get('web_site_name') ?: 'MEAdmin')); ?></title>

    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="/static/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/static/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/static/plugins/iCheck/green.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="/static/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- bootstrap-datepicker -->
    <link href="/static/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css" rel="stylesheet">
    <!-- bootstrap-tagsinput -->
    <link href="/static/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <!-- jasny -->
    <link href="/static/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <!-- Gallery -->
    <link href="/static/plugins/Gallery/css/blueimp-gallery.min.css" rel="stylesheet">

    <link href="/static/admin/css/animate.css" rel="stylesheet">
    <link href="/static/admin/css/style.css" rel="stylesheet">
    <link href="/static/admin/css/meadmin.css" rel="stylesheet">
    <!--页面css-->
    
<!-- Image cropper -->
<link href="/static/plugins/jsTree/themes/default/style.min.css" rel="stylesheet" />


</head>

<body>
    <div id="wrapper">

        <!-- left nav -->
                <!-- left nav -->
        
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="<?php echo htmlentities((isset($user_info['nickname']) && ($user_info['nickname'] !== '')?$user_info['nickname']:'')); ?>" class="rounded-circle" width="60" height="60" src="<?php echo htmlentities((isset($user_info['avatar']) && ($user_info['avatar'] !== '')?$user_info['avatar']:'/static/admin/img/avatar.png')); ?>" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"><?php echo htmlentities(ADMIN_NAME); ?></span>
                                <span class="text-muted text-xs block"><?php echo htmlentities($user_info['nickname']); ?> <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs ">
                                <li>
                                    <a class="dropdown-item" href="<?php echo url('admin/index/personal'); ?>">个人信息</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo url('admin/index/password'); ?>">安全设置</a>
                                </li>
                                <li>
                                    <a class="dropdown-item ajax-get" href="<?php echo url('admin/index/clear'); ?>">清理缓存</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo url('admin/login/logout'); ?>">登出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            ME
                        </div>
                    </li>
                    <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li class="<?php if($node==$vo['name']): ?>active<?php endif; ?>">
                        <a href="<?php if($vo['type']==1): ?>#<?php else: ?><?php echo url($vo['name']); ?><?php endif; ?>"><i class="<?php echo htmlentities($vo['icon']); ?>"></i> <span class="nav-label"><?php echo htmlentities($vo['title']); ?></span><?php if(isset($vo['child'])): ?><span class="fa arrow"></span><?php endif; ?></a>
                        <?php if(isset($vo['child'])): ?>
                        <ul class="nav nav-second-level collapse">
                            <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
                            <li class="<?php if($node==$vv['name']): ?>active<?php endif; ?>">
                                <a href="<?php echo url($vv['name']); ?>"><i class="<?php echo htmlentities($vv['icon']); ?>"></i> <?php echo htmlentities($vv['title']); ?></a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                    <!-- <li class="active">
                        <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">扩展管理</span><span
                                class="float-right label label-primary"> 暂搁</span></a>
                        <ul class="nav nav-second-level collapse in">
                            <li class="active">
                                <a href="extension-hook.html">钩子管理</a>
                            </li>
                        </ul>
                    </li> -->


                </ul>
            </div>
        </nav>


        <!-- content and header -->
        <div id="page-wrapper" class="gray-bg">
            <!-- wrapper-header -->
                        <!-- wrapper-header -->
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="<?php echo url('admin/index/search'); ?>">
                            <!-- 输入菜单的关键字。即可跳转到菜单某个页面去 -->
                            <div class="form-group">
                                <input type="text" placeholder="请输入搜索菜单名称" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">欢迎来到 <?php echo htmlentities((app('config')->get('web_site_name') ?: 'MEAdmin')); ?></span>
                        </li>
                        <li>
                            <a href="<?php echo url('admin/index/clear'); ?>" title="清理缓存" class="ajax-get">
                                <i class="fa fa-trash-o mr-0"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('admin/login/logout'); ?>" title="注销">
                                <i class="fa fa-sign-out"></i> 注销
                            </a>
                        </li>
                        <li>
                            <a class="right-sidebar-toggle">
                                <i class="fa fa-tasks"></i>
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>


            
<!-- wrapper-content -->
<div class="wrapper wrapper-content animated fadeInRight">

	<div class="row">

		<div class="col-lg-12">
			<div class="tabs-container">
				<ul class="nav nav-tabs" role="tablist">
					<li>
						<a class="nav-link active" data-toggle="tab" href="#tab-1">角色信息</a>
					</li>
					<li>
						<a class="nav-link" data-toggle="tab" href="#tab-2">访问授权</a>
					</li>
				</ul>
				<form name="form-builder" id="form" class="form-horizontal form-builder">
					<input type="hidden" value="<?php echo htmlentities($info['id']); ?>" name="id">
					<div class="tab-content">
						<div role="tabpanel" id="tab-1" class="tab-pane active">
							<div class="panel-body">
								<div class="form-group row"><label class="col-sm-2 col-form-label"><span
											class="text-danger">*</span>所属角色</label>
									<div class="col-md-10">
										<select class="form-control" name="pid">
											<?php if(ADMIN_GID==1): ?>
											<option value="0">顶级角色</option>
											<?php else: ?>
											<option value="<?php echo htmlentities(ADMIN_GID); ?>">顶级角色</option>
											<?php endif; if(is_array($auth_group) || $auth_group instanceof \think\Collection || $auth_group instanceof \think\Paginator): $i = 0; $__LIST__ = $auth_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo htmlentities($vo['id']); ?>" <?php if($vo['id']==$info['pid']): ?>selected<?php endif; ?>><?php echo $vo['title_display']; ?> </option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<span class="form-text m-b-none">非超级管理员，禁止创建与当前角色同级的用户</span>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group row"><label class="col-sm-2 col-form-label font-bold"><span
											class="text-danger">*</span>角色名称</label>
									<div class="col-md-10"><input type="text" name="name" class="form-control"
											placeholder="请输入角色名称" value="<?php echo htmlentities($info['name']); ?>"><span class="form-text m-b-none">当前角色名称</span></div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group row"><label
										class="col-sm-2 col-form-label font-bold">角色描述</label>
									<div class="col-md-10"><textarea class="form-control" id="remark" rows="7"
											name="remark" placeholder="请输入角色描述"><?php echo htmlentities($info['remark']); ?></textarea><span
											class="form-text m-b-none">用于描述当前角色的作用</span></div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group row">
									<div class="col-sm-4 col-sm-offset-2">
										<button class="btn btn-primary btn-lg btn-w-m" type="submit">提交</button>
										<button class="btn btn-default btn-lg" type="button"
											onclick="javascript:history.back(-1);return false;">返回 </button>
									</div>
								</div>

							</div>
						</div>
						<div role="tabpane2" id="tab-2" class="tab-pane">
							<div class="panel-body">
								<div class="row m-b">
									<div class="col-sm-9">
										<div class="toolbar-btn-action">
											<a title="全选" class="btn btn-info" id="check-all" href="javascript:;"><i
													class="fa fa-check-circle-o"></i> 全选</a>
											<a title="取消全选" class="btn btn-danger" id="uncheck-all"
												href="javascript:;"><i class="fa fa-times-circle-o"></i> 取消全选</a>
											<a title="展开所有节点" class="btn btn-success" id="expand-all"
												href="javascript:;"><i class="fa fa-check-circle-o"></i> 展开所有节点</a>
											<a title="收起所有节点" class="btn btn-warning" id="collapse-all"
												href="javascript:;"><i class="fa fa-ban"></i> 收起所有节点</a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="input-group"><input placeholder="请输入搜索内容" type="text"
												id="search-auth" class="form-control form-control-sm"></div>
									</div>
								</div>

								<div class="">
									<ul class="nav nav-tabs nav-tabs-alt" role="tablist" id="menu-tab">
										<?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): $k = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
										<li>
											<a class="nav-link <?php if($k==1): ?>active<?php endif; ?>" data-toggle="tab"
												data-tab="rule<?php echo htmlentities($k); ?>" href="#rule<?php echo htmlentities($k); ?>"><?php echo htmlentities($vo); ?></a>
										</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>

									<div class="tab-content">
										<?php if(is_array($role_rule) || $role_rule instanceof \think\Collection || $role_rule instanceof \think\Paginator): $k = 0; $__LIST__ = $role_rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
										<div role="tabpanel" id="rule<?php echo htmlentities($k); ?>" class="tab-pane <?php if($k==1): ?>active<?php endif; ?>">
											<div class="panel-body">
												<div class="push js-tree" data-tab="rule<?php echo htmlentities($k); ?>">
													<?php echo $vo; ?>
												</div>
											</div>
										</div>
										<?php endforeach; endif; else: echo "" ;endif; ?>

									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group row">
									<div class="col-sm-4 col-sm-offset-2">
										<button class="btn btn-primary btn-lg btn-w-m" type="submit">提交</button>
										<button class="btn btn-default btn-lg" type="button"
											onclick="javascript:history.back(-1);return false;">返回 </button>
									</div>
								</div>

							</div>

						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>




            <!-- wrapper-footer -->
                        <!-- wrapper-footer -->
            <div class="footer">
                <div class="float-right">
                    <!-- <strong><a href="">meetes 扯文艺的猿</a></strong> -->
                    <strong><span class="label label-primary">开开心心过大年 开开心心赚大钱！</span></strong>
                </div>
                <div>
                    <?php echo htmlentities(app('config')->get('web_site_copyright')); ?>
                </div>
            </div>


        </div>
        <!-- sidebar -->
                <!-- sidebar -->
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">
                    <li>
                        <a class="nav-link active" data-toggle="tab" href="#tab-1"> 记录 </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#tab-2"> 名言 </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#tab-3"> 项目 </a>
                    </li>
                </ul>

                <div class="tab-content">

                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3><i class="fa fa-universal-access"></i> 介绍</h3>
                            <div class="small">
                                我相信那个 Lorem Ipsum只是印刷和排版行业的虚拟文字。 排版行业。 Lorem Ipsum自15世纪15年代以来一直是行业的标准虚拟文本。
                                多年来，有时偶然地，有时是目的（注入幽默等）。
                            </div>
                        </div>
                        <div class="sidebar-title">
                            <h3><i class="fa fa-universal-access"></i> 我为自己打广告</h3>
                            <div class="small">
                                我相信那个 Lorem Ipsum只是印刷和排版行业的虚拟文字。 排版行业。 Lorem Ipsum自15世纪15年代以来一直是行业的标准虚拟文本。
                                多年来，有时偶然地，有时是目的（注入幽默等）。
                            </div>
                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> 名人名言</h3>
                            <small><i class="fa fa-tim"></i> 励志名言。时刻提醒自己，要进步。</small>
                        </div>
                        <ul class="sidebar-list">
                            <li>
                                <a href="#">
                                    <span>人在身处逆境时，适应环境的能力实在惊人。人可以忍受不幸，也可以战胜不幸，因为人有着惊人的潜力，只要立志发挥它，就一定能渡过难关。</span>
                                    <h4>—— 卡耐基</h4>
                                    <div class="small">励志度: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>老骥伏枥，志在千里。烈士暮年，壮心不已。</span>
                                    <h4>—— 曹操</h4>
                                    <div class="small">励志度: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div id="tab-3" class="tab-pane">
                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> 全部项目</h3>
                            <small><i class="fa fa-tim"></i> 1个正在开发，6个已经完成开发。</small>
                        </div>
                        <ul class="sidebar-list">
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">已开源</div>
                                    <h4>个人博客 </h4>
                                    就是一个基础的博客系统，可已经看看xxxxxxxxx。
                                    <div class="small">完成度: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small float-right m-t-xs">已开源</div>
                                    <h4>个人博客 </h4>
                                    就是一个基础的博客系统，可已经看看xxxxxxxxxxxx。
                                    <div class="small">完成度: 100%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 100%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>


    </div>

    <!-- Mainly scripts -->
    <script src="/static/admin/js/jquery-3.1.1.min.js"></script>
    <script src="/static/admin/js/popper.min.js"></script>
    <script src="/static/admin/js/bootstrap.js"></script>
    <script src="/static/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/static/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/static/plugins/pace/pace.min.js"></script>
    <!-- bootstrap-notify -->
    <script src="/static/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!-- bootstrap-datepicker -->
    <script src="/static/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/static/plugins/bootstrap-datepicker/bootstrap-datepicker.zh-CN.min.js"></script>
    <!-- Sweet alert -->
    <script src="/static/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- iCheck -->
    <script src="/static/plugins/iCheck/icheck.min.js"></script>

    <!-- Tags Input -->
    <script src="/static/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- Jasny -->
    <script src="/static/plugins/jasny/jasny-bootstrap.min.js"></script>
    <!-- Gallery -->
    <script src="/static/plugins/Gallery/js/jquery.blueimp-gallery.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/static/admin/js/app.js"></script>
    <script src="/static/admin/js/meadmin.js"></script>

    <!-- Toastr -->
    <script src="/static/plugins/toastr/toastr.min.js"></script>

    <!-- Jquery Validate -->
    <script src="/static/plugins/jquery-validation/jquery.validate.min.js"></script>

    <!--页面js-->
    
<!-- jsTree -->
<script src="/static/plugins/jsTree/jstree.min.js"></script>

<script>
	$(document).ready(function () {
		// 表单验证
		$("#form").validate({
			rules: {
				pid: {
					required: true
				},
				name: {
					required: true,
					minlength: 3
				}
			},
			messages: {
				pid: {
					required: "请选择所属角色"
				},
				name: {
					required: "请输入角色名称",
					minlength: "角色名称长度不能小于3个字符"
				}
			}
		});

		const $tree_list = {};
		const $key_auth = {};
		let curr_tab = 'rule1';

		// 切换节点tab
		$('#menu-tab > li > a').click(function () {
			curr_tab = $(this).data('tab');
			$('#search-auth').val($key_auth[curr_tab]);
		});
		// 初始化节点
		$('.js-tree').each(function () {
			const $tree = $(this);
			const tab = $(this).data('tab');

			$key_auth[tab] = '';

			$tree.jstree({
				plugins: ["checkbox", "search"],
				"checkbox": {
					"keep_selected_style": false,
					"three_state": false,
					"cascade": 'down+up'
				},
				"search": {
					'show_only_matches': true,
					'show_only_matches_children': true
				}
			});
			$tree_list[tab] = $tree;
		});

		// 全选
		$('#check-all').click(function () {
			$tree_list[curr_tab].jstree(true).check_all();
		});
		// 取消全选
		$('#uncheck-all').click(function () {
			$tree_list[curr_tab].jstree(true).uncheck_all();
		});
		// 展开所有
		$('#expand-all').click(function () {
			$tree_list[curr_tab].jstree(true).open_all();
		});
		// 收起所有
		$('#collapse-all').click(function () {
			$tree_list[curr_tab].jstree(true).close_all();
		});

		var to = false;
		$('#search-auth').keyup(function (event) {
			if (to) {
				clearTimeout(to);
			}
			to = setTimeout(function () {
				var v = $('#search-auth').val();
				$key_auth[curr_tab] = v;
				$tree_list[curr_tab].jstree(true).search(v);
			}, 250);
		});

		// 提交表单
		$('#form').submit(function () {
			if ($("#form").valid() == false) return false;
			$("button[type=submit]").attr("disabled", true);

			var form_data = $(this).serialize();
			console.log(form_data)
			var auth_node = [];
			$.each($tree_list, function () {
				auth_node.push.apply(auth_node, $(this).jstree(true).get_checked());
			});

			if (auth_node.length) {
				form_data += '&rules=' + auth_node.join(',');
			}
			MEAdmin.ajax({
				url: "<?php echo url('admin/role/edit'); ?>",
				data: form_data,
				dataType: "json",
				type: "post",
				success: function (res) {
					$("button[type=submit]").attr("disabled", false);
					res = JSON.parse(res);
					if (res.url) {
						res.msg += "， 页面即将自动跳转~";
					}

					if (res.status === "success") {
						MEAdmin.notify(res.msg, 'success');

						setTimeout(function () {
							location.href = res.url;
						}, 1500);
					} else {
						MEAdmin.notify(res.msg, 'danger');
					}
				},
				failure: function (res) {
					$("button[type=submit]").attr("disabled", false);
					MEAdmin.notify('500:服务器错误', 'danger');
				}

			});

			return false;
		});
	});
</script>


    <!--主题配置-->
        <!--同步官网模板开始-->
    <div class="theme-config">
        <div class="theme-config-box">
            <div class="spin-icon">
                <i class="fa fa-cogs fa-spin"></i>
            </div>
            <div class="skin-settings">
                <div class="title">
                    配置 <br>
                    <small style="text-transform: none;font-weight: 400">
                        配置框设计用于更好的展示页面效果。
                    </small>
                </div>
                <div class="setings-item">
                    <span>
                        折叠菜单
                    </span>

                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                            <label class="onoffswitch-label" for="collapsemenu">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <span>
                        固定侧边栏
                    </span>

                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="fixedsidebar" class="onoffswitch-checkbox" id="fixedsidebar">
                            <label class="onoffswitch-label" for="fixedsidebar">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <span>
                        顶级导航栏
                    </span>

                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                            <label class="onoffswitch-label" for="fixednavbar">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <span>
                        顶部导航栏V.2
                        <br>
                        <small>*主要布局</small>
                    </span>

                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="fixednavbar2" class="onoffswitch-checkbox" id="fixednavbar2">
                            <label class="onoffswitch-label" for="fixednavbar2">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <span>
                        盒子布局
                    </span>

                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                            <label class="onoffswitch-label" for="boxedlayout">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <span>
                        固定页脚
                    </span>

                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="fixedfooter" class="onoffswitch-checkbox" id="fixedfooter">
                            <label class="onoffswitch-label" for="fixedfooter">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="title">换肤</div>
                <div class="setings-item default-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-0">
                            默认
                        </a>
                    </span>
                </div>
                <div class="setings-item blue-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            蓝色
                        </a>
                    </span>
                </div>
                <div class="setings-item yellow-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            黄色
                        </a>
                    </span>
                </div>
                <div class="setings-item ultra-skin">
                    <span class="skin-name ">
                        <a href="#" class="md-skin">
                            绿色（没用）
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Config box

        // Enable/disable fixed top navbar
        $('#fixednavbar').click(function () {
            if ($('#fixednavbar').is(':checked')) {
                $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
                $("body").removeClass('boxed-layout');
                $("body").addClass('fixed-nav');
                $('#boxedlayout').prop('checked', false);

                if (localStorageSupport) {
                    localStorage.setItem("boxedlayout", 'off');
                }

                if (localStorageSupport) {
                    localStorage.setItem("fixednavbar", 'on');
                }
            } else {
                $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
                $("body").removeClass('fixed-nav');
                $("body").removeClass('fixed-nav-basic');
                $('#fixednavbar2').prop('checked', false);

                if (localStorageSupport) {
                    localStorage.setItem("fixednavbar", 'off');
                }

                if (localStorageSupport) {
                    localStorage.setItem("fixednavbar2", 'off');
                }
            }
        });

        // Enable/disable fixed top navbar
        $('#fixednavbar2').click(function () {
            if ($('#fixednavbar2').is(':checked')) {
                $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
                $("body").removeClass('boxed-layout');
                $("body").addClass('fixed-nav').addClass('fixed-nav-basic');
                $('#boxedlayout').prop('checked', false);

                if (localStorageSupport) {
                    localStorage.setItem("boxedlayout", 'off');
                }

                if (localStorageSupport) {
                    localStorage.setItem("fixednavbar2", 'on');
                }
            } else {
                $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
                $("body").removeClass('fixed-nav').removeClass('fixed-nav-basic');
                $('#fixednavbar').prop('checked', false);

                if (localStorageSupport) {
                    localStorage.setItem("fixednavbar2", 'off');
                }
                if (localStorageSupport) {
                    localStorage.setItem("fixednavbar", 'off');
                }
            }
        });

        // Enable/disable fixed sidebar
        $('#fixedsidebar').click(function () {
            if ($('#fixedsidebar').is(':checked')) {
                $("body").addClass('fixed-sidebar');
                $('.sidebar-collapse').slimScroll({
                    height: '100%',
                    railOpacity: 0.9
                });

                if (localStorageSupport) {
                    localStorage.setItem("fixedsidebar", 'on');
                }
            } else {
                $('.sidebar-collapse').slimscroll({
                    destroy: true
                });
                $('.sidebar-collapse').attr('style', '');
                $("body").removeClass('fixed-sidebar');

                if (localStorageSupport) {
                    localStorage.setItem("fixedsidebar", 'off');
                }
            }
        });

        // Enable/disable collapse menu
        $('#collapsemenu').click(function () {
            if ($('#collapsemenu').is(':checked')) {
                $("body").addClass('mini-navbar');
                SmoothlyMenu();

                if (localStorageSupport) {
                    localStorage.setItem("collapse_menu", 'on');
                }

            } else {
                $("body").removeClass('mini-navbar');
                SmoothlyMenu();

                if (localStorageSupport) {
                    localStorage.setItem("collapse_menu", 'off');
                }
            }
        });

        // Enable/disable boxed layout
        $('#boxedlayout').click(function () {
            if ($('#boxedlayout').is(':checked')) {
                $("body").addClass('boxed-layout');
                $('#fixednavbar').prop('checked', false);
                $('#fixednavbar2').prop('checked', false);
                $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
                $("body").removeClass('fixed-nav');
                $("body").removeClass('fixed-nav-basic');
                $(".footer").removeClass('fixed');
                $('#fixedfooter').prop('checked', false);

                if (localStorageSupport) {
                    localStorage.setItem("fixednavbar", 'off');
                }

                if (localStorageSupport) {
                    localStorage.setItem("fixednavbar2", 'off');
                }

                if (localStorageSupport) {
                    localStorage.setItem("fixedfooter", 'off');
                }

                if (localStorageSupport) {
                    localStorage.setItem("boxedlayout", 'on');
                }
            } else {
                $("body").removeClass('boxed-layout');

                if (localStorageSupport) {
                    localStorage.setItem("boxedlayout", 'off');
                }
            }
        });

        // Enable/disable fixed footer
        $('#fixedfooter').click(function () {
            if ($('#fixedfooter').is(':checked')) {
                $('#boxedlayout').prop('checked', false);
                $("body").removeClass('boxed-layout');
                $(".footer").addClass('fixed');

                if (localStorageSupport) {
                    localStorage.setItem("boxedlayout", 'off');
                }

                if (localStorageSupport) {
                    localStorage.setItem("fixedfooter", 'on');
                }
            } else {
                $(".footer").removeClass('fixed');

                if (localStorageSupport) {
                    localStorage.setItem("fixedfooter", 'off');
                }
            }
        });

        // SKIN Select
        $('.spin-icon').click(function () {
            $(".theme-config-box").toggleClass("show");
        });

        // Default skin
        $('.s-skin-0').click(function () {
            $("body").removeClass("skin-1");
            $("body").removeClass("skin-2");
            $("body").removeClass("skin-3");
        });

        // Blue skin
        $('.s-skin-1').click(function () {
            $("body").removeClass("skin-2");
            $("body").removeClass("skin-3");
            $("body").addClass("skin-1");
        });

        // Inspinia ultra skin
        $('.s-skin-2').click(function () {
            $("body").removeClass("skin-1");
            $("body").removeClass("skin-3");
            $("body").addClass("skin-2");
        });

        // Yellow skin
        $('.s-skin-3').click(function () {
            $("body").removeClass("skin-1");
            $("body").removeClass("skin-2");
            $("body").addClass("skin-3");
        });

        if (localStorageSupport) {
            var collapse = localStorage.getItem("collapse_menu");
            var fixedsidebar = localStorage.getItem("fixedsidebar");
            var fixednavbar = localStorage.getItem("fixednavbar");
            var fixednavbar2 = localStorage.getItem("fixednavbar2");
            var boxedlayout = localStorage.getItem("boxedlayout");
            var fixedfooter = localStorage.getItem("fixedfooter");

            if (collapse == 'on') {
                $('#collapsemenu').prop('checked', 'checked')
            }
            if (fixedsidebar == 'on') {
                $('#fixedsidebar').prop('checked', 'checked')
            }
            if (fixednavbar == 'on') {
                $('#fixednavbar').prop('checked', 'checked')
            }
            if (fixednavbar2 == 'on') {
                $('#fixednavbar2').prop('checked', 'checked')
            }
            if (boxedlayout == 'on') {
                $('#boxedlayout').prop('checked', 'checked')
            }
            if (fixedfooter == 'on') {
                $('#fixedfooter').prop('checked', 'checked')
            }
        }
    </script>
    <!--同步官网模板结束-->


</body>

</html>