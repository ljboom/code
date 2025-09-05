define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'xingu/index' + location.search,
                    add_url: 'xingu/add',
                    edit_url: 'xingu/edit',
                    del_url: 'xingu/del',
                    multi_url: 'xingu/multi',
                    import_url: 'xingu/import',
                    table: 'xingu',
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
                        {field: 'shuzidaima', title: __('Shuzidaima'), operate: 'LIKE'},
                        {field: 'shijia', title: __('Shijia'), operate:'BETWEEN'},
                        {field: 'chengxiaojia', title: __('Chengxiaojia'), operate:'BETWEEN'},
                        {field: 'zongshengou', title: __('Zongshengou')},
                        {field: 'yishengou', title: __('Yishengou')},
                        {field: 'chouqiandate', title: __('Chouqiandate'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'kaifangdate', title: __('Kaifangdate'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'jiezhidate', title: __('Jiezhidate'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'faquan_date', title: __('Faquan_date'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'shichanglist', title: __('Shichanglist'), searchList: {"1":__('Shichanglist 1'),"2":__('Shichanglist 2')}, formatter: Table.api.formatter.normal},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'weigh', title: __('Weigh'), operate: false},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2')}, formatter: Table.api.formatter.status},
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
