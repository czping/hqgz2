<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/style/admin.css" media="all">
</head>
<body>


<div class="layui-fluid" id="LAY-component-timeline">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">导入薪资数据</div>
                <div class="layui-card-body">

                    <ul class="layui-timeline">
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis"></i>
                            <div class="layui-timeline-content layui-text">
                                <h3 class="layui-timeline-title">第一步：下载导入模板</h3>
                                <button class="layui-btn">管理岗薪资模板</button>
                                <button class="layui-btn">工勤薪资模板</button>
                            </div>
                        </li>
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis"></i>
                            <div class="layui-timeline-content layui-text">
                                <h3 class="layui-timeline-title">第二步：导入带有数据的模板文件</h3>
                                <button class="layui-btn">导入管理岗薪资</button>
                                <button class="layui-btn">导入工勤薪资</button>
                            </div>
                        </li>
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis"></i>
                            <div class="layui-timeline-content layui-text">
                                <h3 class="layui-timeline-title">第三步：等待系统反馈导入结果</h3>
                                <blockquote class="layui-elem-quote">。。。。。。</blockquote>
                            </div>
                        </li>
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis"></i>
                            <div class="layui-timeline-content layui-text">
                                <div class="layui-timeline-title">完成</div>
                            </div>
                        </li>
                    </ul>

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
    }).use(['index']);
</script>
</body>
</html>