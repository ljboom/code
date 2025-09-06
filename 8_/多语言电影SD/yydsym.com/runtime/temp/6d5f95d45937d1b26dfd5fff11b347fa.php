<?php /*a:1:{s:81:"/www/wwwroot/video-shuadan.timibbs.vip/application/manage/view/bet/task_list.html";i:1646809144;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>项目列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
                                <label class="layui-form-label">发布人</label>
                                <div class="layui-input-inline">
                                    <input class="layui-input" name="username" autocomplete="off">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">任务ID</label>
                                <div class="layui-input-inline">
                                    <input class="layui-input" name="id" autocomplete="off">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">任务链接</label>
                                <div class="layui-input-inline">
                                    <input class="layui-input" name="link_info" autocomplete="off">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-inline">
                                    <input class="layui-input" name="title" autocomplete="off">
                                </div>
                            </div>
                            <!--<div class="layui-inline">
                                <label class="layui-form-label">任务类型</label>
                                <div class="layui-input-inline">
                                    <select name="task_type" lay-verify="required">
                                        <option value="">全部</option>
                                        <option value="1">供应信息</option>
                                        <option value="2">需求信息</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="layui-inline">
                                <label class="layui-form-label">任务分类</label>
                                <div class="layui-input-inline">
                                    <select name="task_class" lay-verify="required">
                                        <option value="">所有</option>
                                        <?php foreach($taskClass as $key=>$value): ?>
                                        <option value="<?php echo htmlentities($value['id']); ?>"><?php echo htmlentities($value['group_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">任务等级</label>
                                <div class="layui-input-inline">
                                    <select name="task_level" lay-verify="required">
                                        <option value="">所有</option>
                                        <?php foreach($gradeClass as $value): ?>
                                        <option value="<?php echo htmlentities($value['grade']); ?>"><?php echo htmlentities($value['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">发布时间</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="datetime_range" class="layui-input" readonly>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">状态</label>
                                <div class="layui-input-inline">
                                    <select name="status" lay-verify="required" lay-search="">
                                        <option value="">全部</option>
                                        <?php foreach(app('config')->get('custom.taskStatus') as $key=>$value): ?>
                                        <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($value); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline" style="text-align: center;">
                                <button type="button" class="layui-btn" data-type="search">搜索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="layui-col-md12">
                <div class="layui-card">
                    <table class="layui-hide" id="taskList" lay-filter="taskList"></table>
                </div>
            </div>
        </div>
    </div>
    <!-- 头部左侧工具栏 -->
    <script type="text/html" id="toolbarDemo">
        <div class="layui-btn-container layui-btn-group">
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="add">
                <i class="layui-icon">&#xe654;</i>
            </button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="del">
                <i class="layui-icon">&#xe640;</i>
            </button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="task-class">任务分类</button>
			<button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="task-tpl-add">从模板添加</button>
        </div>
    </script>
    <!-- 表格右侧操作单元 -->
    <script type="text/html" id="action">
        <div class="layui-btn-group">
            {{# if (d.status == 1) { }}
            <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" lay-event="audit">审核</button>
            {{# } }}
            {{# if (d.revoke == 1) { }}
             <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" lay-event="audit">撤销</button>
            {{# } }}
            <button type="button" class="layui-btn layui-btn-xs" lay-event="edit">
                <i class="layui-icon">&#xe642;</i>
            </button>
            <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">
                <i class="layui-icon">&#xe640;</i>
            </button>
        </div>
    </script>
    <!-- 表单元素 -->

<script src="/resource/layuiadmin/layui/layui.js"></script>
<script src="/resource/js/manage/init_date.js"></script>
<script src="/resource/js/manage/bet.js"></script>
<script>
    layui.use(['layer', 'table'], function(){
        var $ = layui.$
        ,layer = layui.layer
        ,table = layui.table;

        //方法级渲染
        table.render({
            elem: '#taskList'
            ,title: '任务列表'
            ,url: '/manage/bet/taskList'
            ,method: 'post'
            ,cols: [[
                {checkbox: true, fixed: true, totalRowText: '合计'}
                ,{field: 'id', title: '编号', sort: true, fixed: 'left'}
				,{field: 'username', title: '发布人', sort: true, fixed: 'left'}

                ,{field: 'title', title: '标题', sort: true, fixed: 'left'}
                ,{field: 'task_type', title: '任务类型', sort: true, templet: function(d){
                    return d.task_type_str;
                }}
                // ,{field: '', title: '任务级别', sort: true}
                ,{field: 'receive_number', title: '已领/名额', templet: function(d){
                    return d.speed;
                }}
                ,{field: 'task_class', title: '任务分类', sort: true, templet: function(d){
                    return d.group_name;
                }}
                ,{field: 'task_level', title: '任务等级', sort: true, templet: function(d){
                    return 'VIP'+(d.task_level-1);
                }}
                ,{field: 'reward_price', title: '单价', sort: true, totalRow: true}
                ,{field: 'total_price', title: '总价+抽水', templet: function(d){
                    return d.speed_total_price;
                }}
				//,{field: 'pump', title: '抽水比例', sort: true}
                ,{field: 'end_time', title: '截止日期', sort: true, templet: function(d){
                    return d.format_end_time;
                }}
                ,{field: 'status', title: '当前状态', sort: true, templet: function(d){
                    return d.statusStr;
                }}
                ,{field: 'add_time', title: '添加时间', sort: true, templet: function(d){
                    return d.format_add_time;
                }}
                ,{title: '管理操作', width: '20%', toolbar: '#action'}
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
        table.on('sort(taskList)', function(obj){ //注：sort 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
            //尽管我们的 table 自带排序功能，但并没有请求服务端。
            //有些时候，你可能需要根据当前排序的字段，重新向服务端发送请求，从而实现服务端排序，如：
            table.reload('taskList', {
                initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                ,where: { //请求参数（注意：这里面的参数可任意定义，并非下面固定的格式）
                    sortField: obj.field //排序字段
                    ,sortType: obj.type //排序方式
                }
            });
        });
        //监听行双击事件
        table.on('rowDouble(taskList)', function(obj){

        });

        active = {
            search: function(){
                //执行重载
                table.reload('taskList', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,where: {
						id: $("input[name='id']").val()
                        ,link_info: $("input[name='link_info']").val()
						,username: $("input[name='username']").val()
                        ,title: $("input[name='title']").val()
                        ,datetime_range: $("input[name='datetime_range']").val()
                        ,task_type: $("select[name='task_type'] option:selected").val()
                        ,task_class: $("select[name='task_class'] option:selected").val()
						,status: $("select[name='status'] option:selected").val()
						,task_level: $("select[name='task_level'] option:selected").val()
                    }
                }, 'data');
            }
        };

        $('.search .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
		
		 // 头部左侧工具栏事件
		table.on('toolbar(taskList)', function(obj){
			switch(obj.event){
				case 'task-tpl-add':
					layer.open({
						type: 2,
						title: "从模板添加任务",
						area: ['95%','95%'],
						content: "/manage/bet/taskTplAdd"
					});
					break;

				case 'del':
					
					break;

				case 'task-class':
                    layer.open({
                        type: 2,
                        title: "项目类型",
                        area: ['90%','90%'],
                        content: "/manage/bet/TaskClass"
                    });
                    break;
					
					break;
			};
		});
    });
</script>
</body>
</html>