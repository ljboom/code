<?php /*a:1:{s:88:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/bank/recharge_record.html";i:1657899508;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>充值记录</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/resource/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/mylay.css">
</head>
<body>
<div style="padding: 20px; background-color: #F2F2F2;">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card" style="padding: 10px;">
                <form class="layui-form search">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">更新</label>
                            <div class="layui-input-inline">
                                <select class="recharge-withdraw-reload" lay-filter="recharge-withdraw-reload"
                                        data-reloadType="recharge_record">
                                    <option value="0">暂停</option>
                                    <option value="15">15秒</option>
                                    <option value="30">30秒</option>
                                    <option value="60">60秒</option>
                                </select>
                            </div>
                        </div>

                        <div class="layui-inline">
                            <label class="layui-form-label">账号类型</label>
                            <div class="layui-input-inline">
                                <select name="user_type" class="recharge-withdraw-reload"
                                        lay-filter="recharge-withdraw-reload" data-reloadType="recharge_record">
                                    <option value="0">全部</option>
                                    <option value="1">代理</option>
                                    <option value="2">会员</option>
                                    <option value="3">测试</option>

                                </select>
                            </div>
                        </div>


                        <div class="layui-inline">
                            <label class="layui-form-label">账号</label>
                            <div class="layui-input-inline">
                                <input class="layui-input" name="username" autocomplete="off">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-inline">
                                <select name="state" lay-search="">
                                    <option value="">全部</option>
                                    <option value="1">成功</option>
                                    <option value="2">失败</option>
                                    <option value="3">处理中</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">时间</label>
                            <div class="layui-input-inline">
                                <input type="text" name="datetime_range" class="layui-input" readonly>
                            </div>
                        </div>
                        <div class="layui-block" style="text-align: center;">
                            <button type="button" class="layui-btn" data-type="search">搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <table class="layui-hide" id="recharge_record" lay-filter="recharge_record"></table>
            </div>
        </div>
    </div>
</div>

<!-- 表单元素 -->
<script type="text/html" id="action">
    <div class="layui-btn-group">
        {{# if (d.state == 3) { }}
        <button type="button" class="layui-btn layui-btn-normal layui-btn-xs" lay-event="rechargeDispose">审核</button>
        {{# } else { }}
        <button type="button" class="layui-btn layui-btn-xs" lay-event="rechargeDetail">详情</button>
        {{# } }}
    </div>
</script>
<!-- 音频 -->
<audio id="myaudio" src="/resource/media/recharge_record.mp3" hidden="true">

    <script src="/resource/layuiadmin/layui/layui.js"></script>
    <script src="/resource/js/manage/init_date.js"></script>
    <script src="/resource/js/manage/bank.js?time="+Date.parse( new Date())></script>
    <script>
        layui.use(['table'], function () {
            var $ = layui.$
                , table = layui.table;

            //方法级渲染
            table.render({
                elem: '#recharge_record'
                , title: '充值记录'
                , url: '/manage/bank/recharge_record'
                , method: 'post'
                , cols: [[
                    {checkbox: true, fixed: true, totalRowText: '合计'}
                    , {field: 'order_number', title: '订单号', sort: true, fixed: 'left', width: 230}
                    , {field: 'dailixian', title: '代理线', totalRow: true}
                    , {field: 'usdt_money', title: '充值金额[USDT]', sort: true, totalRow: true, width: 150}
                    , {field: 'money', title: '充值金额', sort: true, totalRow: true, width: 150}
                    , {field: 'daozhang_money', title: '到账金额', sort: true, totalRow: true, width: 150}
                    , {field: 'fee', title: '手续费', sort: true, totalRow: true}
                    , {field: 'username', title: '充值用户', sort: true, width: 180}
                    , {field: 'name', title: '收款账户', sort: true, width: 150}
                    , {field: 'hash', title:'hash/txid'}
                    , {field: 'postscript', title: '附言', sort: true, width: 150}
                    , {field: 'add_time', title: '充值时间', sort: true, width: 180}
                    , {
                        field: 'state', title: '状态', sort: true, templet: function (d) {
                            return d.statusStr;
                        }, width: 100
                    }
                    , {field: 'dispose_time', title: '处理时间', sort: true, width: 180}
                    , {title: '操作', width: 100, toolbar: '#action', fixed: 'right'}
                ]]
                , cellMinWidth: 100
                , toolbar: '#toolbarDemo'
                , defaultToolbar: ['filter', 'print', 'exports']
                , totalRow: true
                , page: {
                    layout: ['count', 'prev', 'page', 'next', 'limit', 'refresh', 'skip']
                }
                , skin: 'row' //行边框风格
                , even: true //开启隔行背景
            });

            //监听排序事件
            table.on('sort(recharge_record)', function (obj) { //注：sort 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                //尽管我们的 table 自带排序功能，但并没有请求服务端。
                //有些时候，你可能需要根据当前排序的字段，重新向服务端发送请求，从而实现服务端排序，如：
                table.reload('recharge_record', {
                    initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                    , where: { //请求参数（注意：这里面的参数可任意定义，并非下面固定的格式）
                        sortField: obj.field //排序字段
                        , sortType: obj.type //排序方式
                    }
                });
            });

            active = {
                search: function () {
                    //执行重载
                    table.reload('recharge_record', {
                        page: {
                            curr: 1 //重新从第 1 页开始
                        }
                        , where: {
                            username: $("input[name='username']").val()
                            , state: $("select[name='state'] option:selected").val()
                            , datetime_range: $("input[name='datetime_range']").val(),
                            user_type: $('select[name=user_type] option:selected').val()
                        }
                        , done: function (res, curr, count) {
                            for (var i = 0; i < res.data.length; i++) {
                                if (res.data[i].statusStr == '处理中' || res.data[i].statusStr == '审核中' || res.data[i].statusStr == 'Reviewing') {
                                    $("#myaudio")[0].play();
                                    return false;
                                }
                            }
                        }
                    }, 'data');
                }
            };

            $('.search .layui-btn').on('click', function () {
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });
        });
    </script>
    <script src="/resource/js/manage/media.js?time="+Date.parse( new Date())></script>
</body>
</html>