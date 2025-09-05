/*
 *  Document   : meadmin.js
 *  Author     : meadmin
 */

var Component = function() {

	/**
	 * 日期组件(初始化日期组件)
	 */
	var infoDateComponent = function(){
		$('.input-daterange input').each(function() {
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
		init: function() {
			infoDateComponent();	// 日期组件(初始化日期组件)
		},
	};

}();

// Initialize app when page loads
jQuery(function() {
	Component.init();
});