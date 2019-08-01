<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>开启头部工具栏 - 数据表格</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/style/admin.css" media="all">
</head>
<body>


<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">开启头部工具栏</div>

                <div class="layui-card-body">
                    <div class="layui-form">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">部门选择</label>
                                <div class="layui-input-inline">
                                    <select name="dept">
                                        <option value="0" selected="">全部</option>
                                        <option value="1" >经济部</option>
                                        <option value="2">信息办</option>
                                        <option value="3">综合办</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">选择时间</label>
                                <div class="layui-input-inline">
                                    <select name="dates">
                                        <option value="201907" selected="">2019年07月</option>
                                        <option value="201906" >2019年06月</option>
                                        <option value="201905">2019年05月</option>
                                        <option value="201904">2019年04月</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">姓名搜索</label>
                                <div class="layui-input-inline">
                                    <input type="tel" name="username" lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-input-inline">
                                <button class="layui-btn" lay-submit lay-filter="LAY-user-front-search">
                                    查询
                                </button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <table class="layui-hide" id="test-table-toolbar" lay-filter="test-table-toolbar"></table>
                    <script type="text/html" id="test-table-toolbar-toolbarDemo">
                        <div >
                            当前选择为"全部"职工"2019年07月"薪资
                        </div>
                    </script>
                    <script type="text/html" id="test-table-toolbar-barDemo">
                        <a class="layui-btn layui-btn-xs" lay-event="edit">查看详请</a>

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/hqgz3/Public/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/hqgz3/Public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'table'], function(){
        var admin = layui.admin
            ,table = layui.table;

        table.render({
            elem: '#test-table-toolbar'
            ,url: layui.setter.base + 'json/table/demo.js'
            ,toolbar: '#test-table-toolbar-toolbarDemo'
            ,title: '用户数据表'
            ,cols: [[
                {field:'username', title:'用户名', width:120,fixed: 'left', unresize: true, sort: true}
                ,{field:'year', title:'年月', width:80, sort: true}
                ,{field:'dept', title:'部门', width:100}
                ,{field:'level', title:'岗级', width:100,sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{field:'sign', title:'工资',width:100, sort: true}
                ,{fixed: 'right', title:'操作', toolbar: '#test-table-toolbar-barDemo', width:150}
            ]]
            ,page: true
            ,limit: 40
            ,height: 'full-220'
            ,text: '对不起，加载出现异常！'
        });

        //头工具栏事件
        table.on('toolbar(test-table-toolbar)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            switch(obj.event){
                case 'getCheckData':
                    var data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                    break;
                case 'getCheckLength':
                    var data = checkStatus.data;
                    layer.msg('选中了：'+ data.length + ' 个');
                    break;
                case 'isAll':
                    layer.msg(checkStatus.isAll ? '全选': '未全选');
                    break;
            };
        });

        //监听行工具事件
        table.on('tool(test-table-toolbar)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('真的删除行么', function(index){
                    obj.del();
                    layer.close(index);
                });
            } else if(obj.event === 'edit'){
                layer.prompt({
                    formType: 2
                    ,value: data.email
                }, function(value, index){
                    obj.update({
                        email: value
                    });
                    layer.close(index);
                });
            }
        });

    });
</script>
</body>
</html>