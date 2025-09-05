/*
 *  Document   : ajax_encryption.js
 *  Author     : meadmin
 */

var Encryption = function () {
	const APPID = '530630f9980c570a5faf1c4a2a0a9c53';
	const KEY = 'e0ec9dd0a553cab62130a4deec68f64e';
	const VERSION = '1.0.0';
	const GET_TOKEN = 'http://192.168.101.47/api/api_access_auth/accessToken';
	const GET_TICKET = 'http://192.168.101.47/api/api_access_auth/getToken';

	/**
	 * 获取token
	 */
	var getToken = function () {
		$.ajax({
			url: GET_TOKEN,
			async: false,
			data: {
				'appid': APPID
			},
			type: 'post',
			dataType: 'json',
			success: function (res, status, xhr) {
				$.cookie('access_token', res.data); //设置一个值为'dumplings'的cookie
			}
		});
	}


	/**
	 * 获取临时票据
	 */
	var getJsapiTicket = function (sub, jti) {
		$.ajax({
			url: GET_TICKET,
			async: false,
			data: {
				'sub': sub,
				'jti': jti
			},
			type: 'post',
			dataType: 'json',
			success: function (res, status, xhr) {
				console.log(res)
				$.cookie('jsapi_ticket', res.data); //设置一个值为'dumplings'的cookie
			}
		});
	}

	/**
	 * 生成签名
	 */
	var getSign = function (data) {
		// 排序
		let tempJsonObj = {};
		let sdic = Object.keys(data).sort();
		sdic.map((item, index) => {
			tempJsonObj[item] = data[sdic[index]]
		})

		data = tempJsonObj;
		//生成以&符链接的key=value形式的字符串
		var paramString = '';
		for (var v in data) {
			//alert(v + " " + data[v]);
			paramString += v + '=' + data[v] + '&';
		}
		paramString += 'key=' + KEY;
		// paramString = paramString.substr(0, paramString.length - 1);  
		var sign = md5(paramString).toUpperCase();
		return sign;
	}


	/**
	 * ajaxEncryption 操作
	 */
	var ajaxEncryption = function (data) {
		//data={data:"",dataType:"xml/json",type:"get/post"，url:"",asyn:"true/false",success:function(){},failure:function(){}}

		var type = data.type == 'get' ? 'get' : 'post';
		var dataType = data.dataType == '' ? 'json' : data.dataType;
		var url = '';
		if (data.url) {
			url = data.url;
			if (type == 'get') {
				url += "?" + data.data + "&_t=" + new Date().getTime();
			}
		}

		// 1.获取token，存到cookie中
		if (!$.cookie('access_token')) {
			getToken();
		}

		// 2.利用token获取 临时票据 
		if (!$.cookie('jsapi_ticket')) {
			getJsapiTicket('web', $.cookie('access_token'));
		}

		// 3.生成签名 发送数据
		data.data.access_token = $.cookie('access_token');
		data.data.jsapi_ticket = $.cookie('jsapi_ticket');
		data.data.appid = APPID;
		data.data.version = APPID;
		data.data.noncestr = Math.round(Math.random() * 10000000000);
		data.data.timestamp = Math.round(new Date().getTime() / 1000).toString();
		data.data.signature = getSign(data.data);

		$.ajax({
			url: url,
			dataType: dataType,
			data: data.data,
			type: type,
			success: function (res, status, xhr) {
				data.success(res);
			},
			error: function (res, status, xhr) {
				//服务器内部错误~
				data.failure(res);
			}
		});
	}


	return {
		// 初始化
		init: function () {

		},
		// 处理jq ajax加密方式的操作
		ajax: function (data) {
			ajaxEncryption(data);
		},
	};

}();

// Initialize app when page loads
jQuery(function () {
	Encryption.init();
});