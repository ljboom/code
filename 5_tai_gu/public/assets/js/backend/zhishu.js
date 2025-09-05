define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'zhishu/index' + location.search,
                    add_url: 'zhishu/add',
                    edit_url: 'zhishu/edit',
                    del_url: 'zhishu/del',
                    multi_url: 'zhishu/multi',
                    import_url: 'zhishu/import',
                    table: 'zhishu',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'weigh',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'zimudaima', title: __('Zimudaima'), operate: 'LIKE'},
                        {field: 'price', title: __('Price'), operate:'BETWEEN'},
                        {field: 'zhangdieshu', title: __('Zhangdieshu'), operate:'BETWEEN'},
                        {field: 'zhangdiebaifenbi', title: __('Zhangdiebaifenbi'), operate:'BETWEEN'},
                        {field: 'open', title: __('Open'), operate:'BETWEEN'},
                        {field: 'close', title: __('Close'), operate:'BETWEEN'},
                        {field: 'high', title: __('High'), operate:'BETWEEN'},
                        {field: 'low', title: __('Low'), operate:'BETWEEN'},
                        {field: 'vol', title: __('Vol')},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'weigh', title: __('Weigh'), operate: false},
                        {field: 'show_switch', title: __('Show_switch'), searchList: {"1":__('Yes'),"0":__('No')}, table: table, formatter: Table.api.formatter.toggle},
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
