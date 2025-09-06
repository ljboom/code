<?php /*a:1:{s:83:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/base/slide_list.html";i:1645733800;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>幻灯片管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/resource/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>
    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <table class="layui-hide" id="slideList" lay-filter="slideList"></table>
                </div>
            </div>
        </div>
    </div>
    <!-- 头部左侧工具栏 -->
    <script type="text/html" id="toolbarDemo">
        <div class="layui-btn-container layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="add">
                <i class="layui-icon">&#xe654;</i>
            </button>
        </div>
    </script>
    <!-- 表单元素 -->
    <script type="text/html" id="bannerdisabled">
        <input type="checkbox" name="status" value="{{d.id}}" lay-skin="switch" lay-text="启用|隐藏" lay-filter="banner-status" {{ d.status == 1 ? 'checked' : '' }}>
    </script>
    <script type="text/html" id="action">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">
                <i class="layui-icon">&#xe640;</i>
            </button>
        </div>
    </script>

<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/base.js"></script>
<script>
    layui.use(['table','layer'], function(){
        var $ = layui.$
        ,layer = layui.layer
        ,table = layui.table;

        //方法级渲染
        table.render({
            elem: '#slideList'
            ,title: '幻灯片管理'
            ,url: '/manage/base/slideList'
            ,method: 'post'
            ,cols: [[
                {checkbox: true, fixed: true}
                ,{field:'lang', title: '语言', sort: true}
                ,{field:'img_path', title: '图片路径', sort: true}
                ,{title: '预览', templet: function(d){
                    return '<img src="'+d.img_path+'" alt="" class="preview-slide-img" style="height: 40px;">';
                }}
                ,{field: 'status', title: '状态', sort: true, templet: '#bannerdisabled', unresize: true}
                ,{title: '操作', width: '20%', toolbar: '#action'}
            ]]
            ,cellMinWidth: 100
            ,toolbar: '#toolbarDemo'
            ,defaultToolbar: ['filter', 'print', 'exports']
            ,totalRow: true
            ,page: {
                layout: ['count', 'prev', 'page', 'next', 'limit', 'refresh', 'skip']
            }
            ,skin: 'row' //行边框风格
            ,even: true //开启隔行背景
        });

        //监听排序事件
        table.on('sort(slideList)', function(obj){ //注：sort 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
            //尽管我们的 table 自带排序功能，但并没有请求服务端。
            //有些时候，你可能需要根据当前排序的字段，重新向服务端发送请求，从而实现服务端排序，如：
            table.reload('slideList', {
                initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                ,where: { //请求参数（注意：这里面的参数可任意定义，并非下面固定的格式）
                    sortField: obj.field //排序字段
                    ,sortType: obj.type //排序方式
                }
            });
        });

        active = {
            search: function(){
                //执行重载
                table.reload('slideList', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,where: {
                        username: $("input[name='username']").val()
                        ,ip: $("input[name='ip']").val()
                        ,datetime_range: $("input[name='datetime_range']").val()
                    }
                }, 'data');
            }
        };
        $('.search .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        $(document).on("mouseover", ".preview-slide-img", function(){
            var src = $(this).attr("src");
            layer.tips('<img src="'+src+'" style="width: 300px;">', this, {tips: 2, time: 0, area: '330px', shade: 0});
        });
        $(document).on("mouseout", ".preview-slide-img", function(){
            layer.closeAll('tips');
        });
    });
</script>
</body>
</html>