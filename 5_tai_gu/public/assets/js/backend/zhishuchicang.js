define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'zhishuchicang/index' + location.search,
                    add_url: 'zhishuchicang/add',
                    edit_url: 'zhishuchicang/edit',
                    del_url: 'zhishuchicang/del',
                    multi_url: 'zhishuchicang/multi',
                    import_url: 'zhishuchicang/import',
                    table: 'zhishuchicang',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'order_sn', title: __('Order_sn'), operate: 'LIKE'},
                        {field: 'fangxiang_data', title: __('Fangxiang_data'), searchList: {"0":__('Fangxiang_data 0'),"1":__('Fangxiang_data 1')}, formatter: Table.api.formatter.normal},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'pro_id', title: __('Pro_id')},
                        {field: 'price', title: __('Price'), operate:'BETWEEN'},
                        {field: 'shuliang', title: __('Shuliang')},
                        {field: 'benjin', title: __('Benjin'), operate:'BETWEEN'},
                        {field: 'zhuijiaxinyongjin', title: __('Zhuijiaxinyongjin'), operate:'BETWEEN'},
                        {field: 'yingkui', title: __('Yingkui'), operate:'BETWEEN'},
                        {field: 'sxf_gyf', title: __('Sxf_gyf'), operate:'BETWEEN'},
                        {field: 'shizhi', title: __('Shizhi'), operate:'BETWEEN'},
                        {field: 'status', title: __('Status'), searchList: {"1":__('Status 1'),"2":__('Status 2'),"3":__('Status 3'),"4":__('Status 4'),"5":__('Status 5')}, formatter: Table.api.formatter.status},
                        {field: 'buy_type', title: __('Buy_type'), searchList: {"0":__('Buy_type 0'),"1":__('Buy_type 1')}, formatter: Table.api.formatter.normal},
                        {field: 'buytime', title: __('Buytime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'selltime', title: __('Selltime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'selldata', title: __('Selldata'), searchList: {"0":__('Selldata 0'),"1":__('Selldata 1')}, formatter: Table.api.formatter.normal},
                        {field: 'sellprice', title: __('Sellprice'), operate:'BETWEEN'},
                        {field: 'sellmoney', title: __('Sellmoney'), operate:'BETWEEN'},
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
                        {field: 'zhishu.name', title: __('Zhishu.name'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

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
