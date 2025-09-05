define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {
	
    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'yaoqingma/index' + location.search,
                    add_url: 'yaoqingma/add',
                    edit_url: 'yaoqingma/edit',
                    del_url: 'yaoqingma/del',
                    multi_url: 'yaoqingma/multi',
                    import_url: 'yaoqingma/import',
                    table: 'yaoqingma',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'daili_id', title: __('Daili_id')},
                        {field: 'code', title: __('Code'), operate: 'LIKE'},
                        {field: 'available_num', title: __('可用次数'), operate: 'BETWEEN'},
                        {field: 'use_num', title: __('已使用次数'), operate: 'BETWEEN'},
                        {field: 'status', title: __('Status'),formatter: Table.api.formatter.status, searchList: {0: __('可使用'), 1: __('使用完毕')}},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'usetime_text', title: __('Usetime')},
                        {field: 'admin.username', title: __('Admin.username'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });
			
			$(function(){
				$("#shengcheng").click(function(){
				    Layer.prompt({
                        title: "可用次数",
                        success: function (layero) {
                            $("input", layero).prop("placeholder", "请填写可使用次数");
                        }
                    }, function (value) {
                        loading_index=layer.load(0);
    					$.ajax({
    						 type: "GET",
    						 async:false,
    						 url: "yaoqingma/shengcheng",
    						 data:{
    						     available_num:value
    						 },
    						 success: function(res){
    							console.log(res);//控制输出回调数据
    							layer.close(loading_index);
    							if(res.code==1){
    								layer.msg(res.msg,{icon:6});
    								$(".btn-refresh").trigger("click");//刷新当前页面的数据
    								layer.closeAll();
    							}else{
    								layer.msg(res.msg,{icon:5});
    							}
    							
    						 }
					    });
                    });
				    
				});
			})
			
            // 为表格绑定事件
            Table.api.bindevent(table);
			
			
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});