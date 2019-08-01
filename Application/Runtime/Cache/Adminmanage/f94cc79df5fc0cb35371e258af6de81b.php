<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 主页示例模板二</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/style/admin.css" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            发放薪资统计人次
            <span class="layui-badge layui-bg-orange layuiadmin-badge">全</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">

            <p class="layuiadmin-big-font">66,666人次</p>
            <p>
              2019年6月起
              <span class="layuiadmin-span-color"><i class="layui-inline layui-icon layui-icon-user"></i></span>
            </p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            薪资发放总计
            <span class="layui-badge layui-bg-green layuiadmin-badge">全</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">

            <p class="layuiadmin-big-font">999,666元</p>
            <p>
              统计应发
              <span class="layuiadmin-span-color"><i class="layui-inline layui-icon layui-icon-dollar"></i></span>
            </p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            访问量
            <span class="layui-badge layui-bg-blue layuiadmin-badge">全</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p class="layuiadmin-big-font">9,999,666次</p>
            <p>
              总计访问量 
              <span class="layuiadmin-span-color"><i class="layui-inline layui-icon layui-icon-flag"></i></span>
            </p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            最近的薪资数据
            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p class="layuiadmin-big-font">2019年7月</p>
            <p>
              导入的最近月份
              <span class="layuiadmin-span-color"> <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
            </p>
          </div>
        </div>
      </div>


      <div class="layui-col-sm12">
        <div class="layui-card">

          <div class="layui-card-body">
            <div class="layui-row">
              <div class="layui-col-sm12">
                  <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-pagetwo">
                    <div carousel-item id="LAY-index-pagetwo">
                      <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                    </div>
                  </div>
              </div>

            </div>
          </div>
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
  }).use(['index', 'sample']);
  </script>
</body>
</html>