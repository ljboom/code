define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'xingushengou/index' + location.search,
                    add_url: 'xingushengou/add',
                    edit_url: 'xingushengou/edit',
                    del_url: 'xingushengou/del',
                    multi_url: 'xingushengou/multi',
                    import_url: 'xingushengou/import',
                    table: 'xingushengou',
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
                        {field: 'user_parent_id', title: __('User_parent_id')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'pro_id', title: __('Pro_id')},
                        {field: 'price', title: __('Price'), operate:'BETWEEN'},
                        {field: 'shengoushuliang', title: __('Shengoushuliang')},
                        {field: 'zhongqianshu', title: __('Zhongqianshu')},
                        {field: 'xurenjiao', title: __('Xurenjiao'), operate:'BETWEEN'},
                        {field: 'yingrenjiao', title: __('Yingrenjiao'), operate:'BETWEEN'},
                        {field: 'yirenjiao', title: __('Yirenjiao'), operate:'BETWEEN'},
                        {field: 'renjiaocishu', title: __('Renjiaocishu')},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2')}, formatter: Table.api.formatter.status},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
                        {field: 'xingu.name', title: __('Xingu.name'), operate: 'LIKE'},
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
