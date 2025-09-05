define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/info/index' + location.search,
                    add_url: 'user/info/add',
                    edit_url: 'user/info/edit',
                    del_url: 'user/info/del',
                    multi_url: 'user/info/multi',
                    import_url: 'user/info/import',
                    table: 'user_info',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'user_id',
                sortName: 'user_id',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'parent_id', title: __('Parent_id')},
                        {field: 'real_name', title: __('Real_name'), operate: 'LIKE'},
                        {field: 'paypassword', title: __('Paypassword'), operate: 'LIKE'},
                        {field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'dongjie', title: __('Dongjie'), operate:'BETWEEN'},
                        {field: 'hongbao', title: __('Hongbao'), operate:'BETWEEN'},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'login_data', title: __('Login_data'), searchList: {"0":__('Login_data 0'),"1":__('Login_data 1')}, formatter: Table.api.formatter.normal},
                        {field: 'trans_data', title: __('Trans_data'), searchList: {"0":__('Trans_data 0'),"1":__('Trans_data 1')}, formatter: Table.api.formatter.normal},
                        {field: 'liangrong_data', title: __('Liangrong_data'), searchList: {"0":__('Liangrong_data 0'),"1":__('Liangrong_data 1')}, formatter: Table.api.formatter.normal},
                        {field: 'peizi_data', title: __('Peizi_data'), searchList: {"0":__('Peizi_data 0'),"1":__('Peizi_data 1')}, formatter: Table.api.formatter.normal},
                        {field: 'dongjie_content', title: __('Dongjie_content'), operate: 'LIKE'},
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
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
