<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>设置我的资料</title>
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
          <div class="layui-card-header">我的资料</div>
          <div class="layui-card-body" pad15>
            
            <div class="layui-form" lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">我的角色</label>
                <div class="layui-input-inline">
                  <input type="text" name="auth" value="管理员" readonly class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">当前角色不可更改为其它角色</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">身份证号码</label>
                <div class="layui-input-inline">
                  <input type="text" name="idcard" value="321111198004142919" readonly class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">不可修改。一般用于后台登入名</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-inline">
                  <input type="text" name="name" value="张平" readonly class="layui-input" >
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
  }).use(['index', 'set']);
  </script>
</body>
</html>