/*
 *  Document   : meadmin.js
 *  Author     : meadmin
 */

var MEAdmin = function () {

	/**
	 * 处理原生ajax方式的操作（通用）
	 * @param data 		发送到服务器的数据
	 * @param dataType 	预期服务器返回的数据类型
	 * @param type 		请求方式 ("POST" 或 "GET")
	 * @param url 		发送请求的地址。
	 * @param async 	是否异步请求
	 * @param success 	请求成功后的回调函数。
	 * @param failure 	请求失败后的回调函数。
	 */
	var ajaxNative = function (data) {
		//data={data:"",dataType:"xml/json",type:"get/post"，url:"",asyn:"true/false",success:function(){},failure:function(){}}

		//第一步：创建xhr对象
		var xhr = null;
		if (window.XMLHttpRequest) {//标准的浏览器
			xhr = new XMLHttpRequest();
		} else {
			xhr = new ActiveXObject('Microsoft.XMLHTTP');
		}
		//第二步：准备发送前的一些配置参数
		var type = data.type == 'get' ? 'get' : 'post';
		var url = '';
		if (data.url) {
			url = data.url;
			if (type == 'get') {
				url += "?" + data.data + "&_t=" + new Date().getTime();
			}
		}
		var flag = data.asyn == 'true' ? 'true' : 'false';
		xhr.open(type, url, flag);


		//第三步：执行发送的动作
		if (type == 'get') {
			xhr.send(null);
		} else if (type == 'post') {
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send(data.data);
		}


		//第四步：指定回调函数
		xhr.onreadystatechange = function () {
			if (this.readyState == 4) {
				if (this.status == 200) {
					if (typeof data.success == 'function') {
						var d = data.dataType == 'xml' ? xhr.responseXML : xhr.responseText;
						data.success(d);
					}
				} else {
					if (typeof data.failure == 'function') {
						data.failure();
					}
				}
			}
		}
	}

	/**
	 * 处理ajax方式的post提交
	 */
	var ajaxPost = function () {
		jQuery(document).delegate('.ajax-post', 'click', function () {
			var msg, self = jQuery(this),
				ajax_url = self.attr("href") || self.data("url");
			var target_form = self.attr("target-form");
			var text = self.data('tips');
			var title = self.data('title') || '确定要执行该操作吗？';
			var confirm_btn = self.data('confirm') || '确定';
			var cancel_btn = self.data('cancel') || '取消';
			var form = jQuery('form[name=' + target_form + ']');

			if (form.length === 0) {
				form = jQuery('.' + target_form);
			}
			var form_data = form.serialize();
			if ("submit" === self.attr("type") || ajax_url) {
				// 不存在“.target-form”元素则返回false
				if (undefined === form.get(0)) return false;

				// 节点标签名为FORM表单
				if ("FORM" === form.get(0).nodeName) {

					ajax_url = ajax_url || form.get(0).getAttribute('action');

					// 验证是否有 validate 插件进行验证，如果有那么先验证是否全部通过。
					if (form.get(0).id) {
						if (jQuery(form.get(0)).valid() == false) return false;
					}
					// 提交确认
					if (self.hasClass('confirm')) {
						swal({
							title: title,
							text: text || '',
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#d26a5c',
							confirmButtonText: confirm_btn,
							cancelButtonText: cancel_btn,
							closeOnConfirm: true,
							html: false
						}, function () {
							pageLoader();
							self.attr("autocomplete", "off").prop("disabled", true);

							// 发送ajax请求
							$.ajax({
								url: ajax_url,
								dataType: "json",
								data: form_data,
								type: "POST",
								success: function (res, status, xhr) {
									//请求成功时处理
									pageLoader('hide');
									msg = res.msg;

									if (res.status == "success") {
										if (res.url && !self.hasClass("no-refresh")) {
											msg += "， 页面即将自动跳转~";
										}
										tips(msg, 'success');
										setTimeout(function () {
											self.attr("autocomplete", "on").prop("disabled", false);
											// 刷新父窗口
											if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
												res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
												return false;
											}
											// 关闭弹出框
											if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
												var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
												parent.layer.close(index);
												return false;
											}
											// 新窗口打开
											if (res.data && (res.data === '_blank' || res.data._blank)) {
												window.open(res.url === '' ? location.href : res.url);
												return false;
											}
											return self.hasClass("no-refresh") ? false : void (res.url && !self.hasClass("no-forward") ? location.href = res.url : location.reload());
										}, 1500);
									} else {
										jQuery(".reload-verify").length > 0 && jQuery(".reload-verify").click();
										tips(msg, 'danger');

										setTimeout(function () {
											// 刷新父窗口
											if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
												res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
												return false;
											}
											// 关闭弹出框
											if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
												var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
												parent.layer.close(index);
												return false;
											}
											// 新窗口打开
											if (res.data && (res.data === '_blank' || res.data._blank)) {
												window.open(res.url === '' ? location.href : res.url);
												return false;
											}
											self.attr("autocomplete", "on").prop("disabled", false);
										}, 2000);
									}
								}, error: function (res, status, xhr) {
									//请求出错处理
									pageLoader('hide');
									tips($(res.responseText).find('h1').text() || '服务器内部错误~', 'danger');
									self.attr("autocomplete", "on").prop("disabled", false);
								}
							});
						});
						return false;
					} else {
						self.attr("autocomplete", "off").prop("disabled", true);
					}
				} else if ("INPUT" === form.get(0).nodeName || "SELECT" === form.get(0).nodeName || "TEXTAREA" === form.get(0).nodeName) {
					// 如果是多选，则检查是否选择
					if (form.get(0).type === 'checkbox' && form_data === '') {
						MEAdmin.notify('请选择要操作的数据', 'warning');
						return false;
					}
					// 如果是排序的并且是input表单的。则同时获取id参数
					if (target_form === "sort" && "INPUT" === form.get(0).nodeName) {
						var target_form2 = self.attr("target-form2");
						var form2 = jQuery('form[name=' + target_form2 + ']');
						if (form2.length === 0) {
							form2 = jQuery('.' + target_form2);
						}
						var form_data2 = form2.serialize();
						// id与排序进行拼接
						form_data = form_data + '&' + form_data2

					}

					// 提交确认
					if (self.hasClass('confirm')) {
						swal({
							title: title,
							text: text || '',
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#d26a5c',
							confirmButtonText: confirm_btn,
							cancelButtonText: cancel_btn,
							closeOnConfirm: true,
							html: false
						}, function () {
							pageLoader();
							self.attr("autocomplete", "off").prop("disabled", true);

							// 发送ajax请求
							$.ajax({
								url: ajax_url,
								dataType: "json",
								data: form_data,
								type: "POST",
								success: function (res, status, xhr) {
									//请求成功时处理
									pageLoader('hide');
									msg = res.msg;

									if (res.status == "success") {
										if (res.url && !self.hasClass("no-refresh")) {
											msg += "， 页面即将自动跳转~";
										}
										tips(msg, 'success');
										setTimeout(function () {
											self.attr("autocomplete", "on").prop("disabled", false);
											// 刷新父窗口
											if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
												res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
												return false;
											}
											// 关闭弹出框
											if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
												var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
												parent.layer.close(index);
												return false;
											}
											// 新窗口打开
											if (res.data && (res.data === '_blank' || res.data._blank)) {
												window.open(res.url === '' ? location.href : res.url);
												return false;
											}
											return self.hasClass("no-refresh") ? false : void (res.url && !self.hasClass("no-forward") ? location.href = res.url : location.reload());
										}, 1500);
									} else {
										jQuery(".reload-verify").length > 0 && jQuery(".reload-verify").click();
										tips(msg, 'danger');

										setTimeout(function () {
											// 刷新父窗口
											if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
												res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
												return false;
											}
											// 关闭弹出框
											if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
												var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
												parent.layer.close(index);
												return false;
											}
											// 新窗口打开
											if (res.data && (res.data === '_blank' || res.data._blank)) {
												window.open(res.url === '' ? location.href : res.url);
												return false;
											}
											self.attr("autocomplete", "on").prop("disabled", false);
										}, 2000);
									}
								}, error: function (res, status, xhr) {
									//请求出错处理
									pageLoader('hide');
									tips($(res.responseText).find('h1').text() || '服务器内部错误~', 'danger');
									self.attr("autocomplete", "on").prop("disabled", false);
								}
							});

						});
						return false;
					} else {
						self.attr("autocomplete", "off").prop("disabled", true);
					}
				} else {
					if (self.hasClass("confirm")) {
						swal({
							title: title,
							text: text || '',
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#d26a5c',
							confirmButtonText: confirm_btn,
							cancelButtonText: cancel_btn,
							closeOnConfirm: true,
							html: false
						}, function () {
							pageLoader();
							self.attr("autocomplete", "off").prop("disabled", true);
							form_data = form.find("input,select,textarea").serialize();

							// 发送ajax请求
							$.ajax({
								url: ajax_url,
								dataType: "json",
								data: form_data,
								type: "POST",
								success: function (res, status, xhr) {
									//请求成功时处理
									pageLoader('hide');
									msg = res.msg;

									if (res.status == "success") {
										if (res.url && !self.hasClass("no-refresh")) {
											msg += "， 页面即将自动跳转~";
										}
										tips(msg, 'success');
										setTimeout(function () {
											self.attr("autocomplete", "on").prop("disabled", false);
											// 刷新父窗口
											if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
												res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
												return false;
											}
											// 关闭弹出框
											if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
												var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
												parent.layer.close(index);
												return false;
											}
											// 新窗口打开
											if (res.data && (res.data === '_blank' || res.data._blank)) {
												window.open(res.url === '' ? location.href : res.url);
												return false;
											}
											return self.hasClass("no-refresh") ? false : void (res.url && !self.hasClass("no-forward") ? location.href = res.url : location.reload());
										}, 1500);
									} else {
										jQuery(".reload-verify").length > 0 && jQuery(".reload-verify").click();
										tips(msg, 'danger');

										setTimeout(function () {
											// 刷新父窗口
											if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
												res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
												return false;
											}
											// 关闭弹出框
											if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
												var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
												parent.layer.close(index);
												return false;
											}
											// 新窗口打开
											if (res.data && (res.data === '_blank' || res.data._blank)) {
												window.open(res.url === '' ? location.href : res.url);
												return false;
											}
											self.attr("autocomplete", "on").prop("disabled", false);
										}, 2000);
									}

								}, error: function (res, status, xhr) {
									//请求出错处理
									pageLoader('hide');
									tips($(res.responseText).find('h1').text() || '服务器内部错误~', 'danger');
									self.attr("autocomplete", "on").prop("disabled", false);
								}
							});
						});
						return false;
					} else {
						form_data = form.find("input,select,textarea").serialize();
						self.attr("autocomplete", "off").prop("disabled", true);
					}
				}

				// 直接发送ajax请求
				pageLoader();
				$.ajax({
					url: ajax_url,
					dataType: "json",
					data: form_data,
					type: "POST",
					success: function (res, status, xhr) {
						//请求成功时处理
						pageLoader('hide');
						msg = res.msg;
						if (res.status == "success") {
							if (res.url && !self.hasClass("no-refresh")) {
								msg += "， 页面即将自动跳转~";
							}
							tips(msg, 'success');
							setTimeout(function () {
								self.attr("autocomplete", "on").prop("disabled", false);
								// 刷新父窗口
								if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
									res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
									return false;
								}
								// 关闭弹出框
								if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
									var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
									parent.layer.close(index);
									return false;
								}
								// 新窗口打开
								if (res.data && (res.data === '_blank' || res.data._blank)) {
									window.open(res.url === '' ? location.href : res.url);
									return false;
								}
								return self.hasClass("no-refresh") ? false : void (res.url && !self.hasClass("no-forward") ? location.href = res.url : location.reload());
							}, 1500);
						} else {
							jQuery(".reload-verify").length > 0 && jQuery(".reload-verify").click();
							tips(msg, 'danger');

							setTimeout(function () {
								// 刷新父窗口
								if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
									res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
									return false;
								}
								// 关闭弹出框
								if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
									var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
									parent.layer.close(index);
									return false;
								}
								// 新窗口打开
								if (res.data && (res.data === '_blank' || res.data._blank)) {
									window.open(res.url === '' ? location.href : res.url);
									return false;
								}
								self.attr("autocomplete", "on").prop("disabled", false);
							}, 2000);
						}

					}, error: function (res, status, xhr) {
						//请求出错处理
						pageLoader('hide');
						tips($(res.responseText).find('h1').text() || '服务器内部错误~', 'danger');
						self.attr("autocomplete", "on").prop("disabled", false);
					}
				});
			}

			return false;
		});
	};

	/**
	 * 处理ajax方式的get提交
	 */
	var ajaxGet = function () {
		jQuery(document).delegate('.ajax-get', 'click', function () {
			var msg, self = $(this),
				text = self.data('tips'),
				ajax_url = self.attr("href") || self.data("url");
			var title = self.data('title') || '确定要执行该操作吗？';
			var confirm_btn = self.data('confirm') || '确定';
			var cancel_btn = self.data('cancel') || '取消';
			// 执行确认
			if (self.hasClass('confirm')) {
				swal({
					title: title,
					text: text || '',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d26a5c',
					confirmButtonText: confirm_btn,
					cancelButtonText: cancel_btn,
					closeOnConfirm: true,
					html: false
				}, function () {
					pageLoader();
					self.attr("autocomplete", "off").prop("disabled", true);

					// 发送ajax请求
					$.ajax({
						url: ajax_url,
						dataType: "json",
						type: "GET",
						success: function (res, status, xhr) {
							//请求成功时处理
							pageLoader('hide');
							msg = res.msg;

							if (res.status == "success") {
								if (res.url && !self.hasClass("no-refresh")) {
									msg += "， 页面即将自动跳转~";
								}
								tips(msg, 'success');
								setTimeout(function () {
									self.attr("autocomplete", "on").prop("disabled", false);
									// 刷新父窗口
									if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
										res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
										return false;
									}
									// 关闭弹出框
									if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
										var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
										parent.layer.close(index);
										return false;
									}
									// 新窗口打开
									if (res.data && (res.data === '_blank' || res.data._blank)) {
										window.open(res.url === '' ? location.href : res.url);
										return false;
									}
									return self.hasClass("no-refresh") ? false : void (res.url && !self.hasClass("no-forward") ? location.href = res.url : location.reload());
								}, 1500);
							} else {
								tips(msg, 'danger');

								setTimeout(function () {
									// 刷新父窗口
									if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
										res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
										return false;
									}
									// 关闭弹出框
									if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
										var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
										parent.layer.close(index);
										return false;
									}
									// 新窗口打开
									if (res.data && (res.data === '_blank' || res.data._blank)) {
										window.open(res.url === '' ? location.href : res.url);
										return false;
									}
									self.attr("autocomplete", "on").prop("disabled", false);
								}, 2000);
							}
						}, error: function (res, status, xhr) {
							//请求出错处理
							pageLoader('hide');
							tips($(res.responseText).find('h1').text() || '服务器内部错误~', 'danger');
							self.attr("autocomplete", "on").prop("disabled", false);
						}
					});

				});
			} else {
				pageLoader();
				self.attr("autocomplete", "off").prop("disabled", true);

				// 发送ajax请求
				$.ajax({
					url: ajax_url,
					dataType: "json",
					type: "GET",
					success: function (res, status, xhr) {
						//请求成功时处理
						pageLoader('hide');
						msg = res.msg;

						if (res.status == "success") {
							if (res.url && !self.hasClass("no-refresh")) {
								msg += "， 页面即将自动跳转~";
							}
							tips(msg, 'success');
							setTimeout(function () {
								self.attr("autocomplete", "on").prop("disabled", false);
								// 刷新父窗口
								if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
									res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
									return false;
								}
								// 关闭弹出框
								if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
									var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
									parent.layer.close(index);
									return false;
								}
								// 新窗口打开
								if (res.data && (res.data === '_blank' || res.data._blank)) {
									window.open(res.url === '' ? location.href : res.url);
									return false;
								}
								return self.hasClass("no-refresh") ? false : void (res.url && !self.hasClass("no-forward") ? location.href = res.url : location.reload());
							}, 1500);
						} else {
							tips(msg, 'danger');

							setTimeout(function () {
								// 刷新父窗口
								if (res.data && (res.data === '_parent_reload' || res.data._parent_reload)) {
									res.url === '' || res.url === location.href ? parent.location.reload() : parent.location.href = res.url;
									return false;
								}
								// 关闭弹出框
								if (res.data && (res.data === '_close_pop' || res.data._close_pop)) {
									var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
									parent.layer.close(index);
									return false;
								}
								// 新窗口打开
								if (res.data && (res.data === '_blank' || res.data._blank)) {
									window.open(res.url === '' ? location.href : res.url);
									return false;
								}
								self.attr("autocomplete", "on").prop("disabled", false);
							}, 2000);
						}
					}, error: function (res, status, xhr) {
						//请求出错处理
						pageLoader('hide');
						tips($(res.responseText).find('h1').text() || '服务器内部错误~', 'danger');
						self.attr("autocomplete", "on").prop("disabled", false);
					}
				});

			}

			return false;
		});
	};

	/**
	 * 页面小提示
	 * @param $msg 提示信息
	 * @param $type 提示类型:'info', 'success', 'warning', 'danger'
	 * @param $icon 图标，例如：'fa fa-user' 或 'glyphicon glyphicon-warning-sign'
	 * @param $from 'top' 或 'bottom'
	 * @param $align 'left', 'right', 'center'
	 */
	var tips = function ($msg, $type, $icon, $from, $align) {
		$type = $type || 'info';
		$from = $from || 'top';
		$align = $align || 'center';
		$enter = $type === 'success' ? 'animated fadeInUp' : 'animated shake';
		jQuery.notify({
			icon: $icon,
			message: $msg
		}, {
			element: 'body',
			type: $type,
			allow_dismiss: true,
			newest_on_top: true,
			showProgressbar: false,
			placement: {
				from: $from,
				align: $align
			},
			offset: 20,
			spacing: 10,
			z_index: 10800,
			delay: 3000,
			timer: 1000,
			animate: {
				enter: $enter,
				exit: 'animated fadeOutDown'
			}
		});
	};

	/**
	 * 页面小提示2
	 * @param $msgTitle 提示信息-标题（必填）
	 * @param $msgDesc 提示信息-描述（选填）
	 * @param $type 提示类型:'info', 'success', 'warning', 'error'
	 * @param $closeButton 是否显示关闭按钮
	 * @param progressBar 是否显示进度条
	 * @param $align 'toast-top-right', 'toast-bottom-right', 'toast-bottom-left', 'toast-top-left', 'toast-top-full-width', 'toast-bottom-full-width', 'toast-top-center', 'toast-bottom-center'
	 */
	var tips2 = function ($msgTitle, $msgDesc, $type, $closeButton, $progressBar, $align) {
		$msgTitle = $msgTitle || '嗨，欢迎来到MEAdmin！';
		$msgDesc = $msgDesc || '';
		$type = $type || 'info';
		$closeButton = $closeButton || false;
		$progressBar = $progressBar || false;
		$align = $align || 'toast-top-right';

		//参数设置，若用默认值可以省略以下面代
		toastr.options = {
			"closeButton": $closeButton, //是否显示关闭按钮
			"debug": false, //是否使用debug模式
			"progressBar": $progressBar, //是否显示进度条
			"positionClass": $align,//弹出窗的位置
			"showDuration": "300",//显示的动画时间
			"hideDuration": "1000",//消失的动画时间
			"timeOut": "4000", //展现时间
			"extendedTimeOut": "1000",//加长展示时间
			"showEasing": "swing",//显示时的动画缓冲方式
			"hideEasing": "linear",//消失时的动画缓冲方式
			"showMethod": "fadeIn",//显示时的动画方式
			"hideMethod": "fadeOut" //消失时的动画方式
		}

		switch ($type) {
			case "success":
				//成功提示绑定
				toastr.success($msgTitle, $msgDesc);
				break;
			case "info":
				//信息提示绑定
				toastr.info($msgTitle, $msgDesc);
				break;
			case "warning":
				//警告提示绑定
				toastr.warning($msgTitle, $msgDesc);
				break;
			case "error":
				//错语提示绑定
				toastr.error($msgTitle, $msgDesc);
				break;
			default:
				//清除窗口绑定
				//toastr.clear();
				break;
		}
	};

	/**
	 * 页面加载提示
	 * @param $mode 'show', 'hide'
	 */
	var pageLoader = function ($mode) {
		var $loadingEl = jQuery('#loading');
		$mode = $mode || 'show';

		if ($mode === 'show') {
			if ($loadingEl.length) {
				$loadingEl.fadeIn(250);
			} else {
				jQuery('body').prepend('<div id="loading" class="ibox-content sk-loading" style=""><div class="sk-spinner sk-spinner-double-bounce"><div class="sk-double-bounce1"></div><div class="sk-double-bounce2"></div></div></div>');
			}
		} else if ($mode === 'hide') {
			if ($loadingEl.length) {
				$loadingEl.fadeOut(250);
			}
		}

		return false;
	};

	/**
	 * 刷新页面
	 */
	var pageReloadLoader = function () {
		// 刷新页面
		$('.page-reload').click(function () {
			location.reload();
		});
	};

	/**
	 * 搜索下拉选中器
	 */
	var searchDropdown = function () {
		// 刷新页面
		$('.search-dropdown').click(function () {
			let value = $(this).data("value");
			let name = $(this).data("name");
			let title = $(this).text();
			$("input[name=" + name + "]").val(value);
			$(this).parent().parent().parent().find("button").text(title);
		});
	};


	/**
	 * 清楚缓存
	 */
	var clearCache = function () {

		jQuery(document).delegate('.clear-cache', 'click', function () {
			console.log("缓存已清理");
			tips2('缓存已清理!', '清理缓存', 'success', true, true);
		});
	};

	/**
	 * 激活iCheck js插件
	 */
	var initiCheck = function () {
		// 激活 iCheck
		$('input[type=checkbox].i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green', // 可以更改red换颜色
			radioClass: 'iradio_square-green',
			increaseArea: '20%' // optional
		});
		_checkboxMaster = $(".checkbox-master");
		_checkbox = $("tbody").find("[type='checkbox']").not("[disabled]");
		_checkboxMaster.on("ifClicked", function (e) {
			// 当前状态已选中，点击后应取消选择
			if (e.target.checked) {
				_checkbox.iCheck("uncheck");
			}

			// 当前状态未选中，点击后应全选
			else {
				_checkbox.iCheck("check");
			}
		});
	}

	/**
	 * 日期组件(初始化日期组件)
	 */
	var infoDateComponent = function () {
		$('.input-daterange input').each(function () {
			$(this).datepicker({
				language: 'zh-CN', //语言
				autoclose: true, //选择后自动关闭
				clearBtn: true, //清除按钮
				format: "yyyy-mm-dd" //日期格式
			});
		});
	}

	return {
		// 初始化
		init: function () {
			ajaxPost();
			ajaxGet();
			clearCache();
			pageReloadLoader();
			searchDropdown();
			initiCheck();			// 激活iCheck组件
			infoDateComponent();	// 日期组件(初始化日期组件)
		},
		// 页面加载提示
		loading: function ($mode) {
			pageLoader($mode);
		},
		// 页面小提示
		notify: function ($msg, $type, $icon, $from, $align) {
			tips($msg, $type, $icon, $from, $align);
		},
		// 页面小提示2
		notify2: function ($msg, $msgDesc, $type, $icon, $from, $align) {
			tips2($msg, $msgDesc, $type, $icon, $from, $align);
		},
		// 处理原生ajax方式的操作（通用）
		ajax: function (data) {
			ajaxNative(data);
		}
	};

}();

// Initialize app when page loads
jQuery(function () {
	MEAdmin.init();
});