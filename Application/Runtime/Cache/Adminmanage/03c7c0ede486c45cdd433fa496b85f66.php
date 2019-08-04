<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/style/admin.css" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-card">

      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">
          <div class="layui-col-md1">
            <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>
          </div>
          <div class="layui-col-md11" style="text-align:right">
            <div class="layui-inline">
              <label class="layui-form-label">部门</label>
              <div class="layui-input-block">
                <select name="dept" lay-verify="">
                  <option value="">所有账号</option>
                  <?php if(is_array($depts)): $i = 0; $__LIST__ = $depts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$deptname): $mod = ($i % 2 );++$i;?><option value="<?php echo ($deptname["部门名称"]); ?>"><?php echo ($deptname["部门名称"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>
          <div class="layui-inline">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-block">
              <input type="text" name="username" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">身份证号码</label>
            <div class="layui-input-block">
              <input type="text" name="email" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-user-front-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
          </div></div>
        </div>
      </div>
      
      <div class="layui-card-body">

        
        <table id="LAY-user-manage" lay-filter="LAY-user-manage"></table>
        <script type="text/html" id="imgTpl"> 
          <img style="display: inline-block; width: 50%; height: 100%;" src= {{ d.avatar }}>
        </script> 
        <script type="text/html" id="table-useradmin-webuser">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
          <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>
      </div>
    </div>
  </div>

  <script src="/hqgz3/Public/layuiadmin/layui/layui.js"></script>
  <script>
  layui.config({
    base: '/hqgz3/Public/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index',  'table'], function(){
    var $ = layui.$
    ,form = layui.form
    ,table = layui.table;

    //用户管理
    table.render({
      elem: '#LAY-user-manage'
      ,url: "<?php echo U('Adminmanage/Management/Accountlist');?>"//layui.setter.base + 'json/useradmin/webuser.js' //模拟接口
      ,cols: [[
       {field: '姓名', title: '姓名', minWidth: 100}
        ,{field: '部门名称', title: '部门'}
        ,{field: '身份证号', title: '身份证号'}
        ,{field: '类别', width: 80, title: '类别'}
        ,{field: '权限', title: '权限'}
        ,{field: 'lasttime', title: '最近登录时间', sort: true}
        ,{title: '操作', width: 150, align:'center', fixed: 'right', toolbar: '#table-useradmin-webuser'}
      ]]
      ,page: true
      ,limit: 50
      ,height: 'full-220'
      ,text: '加载出现异常！'
    });
    //监听搜索
    form.on('submit(LAY-user-front-search)', function(data){
      var field = data.field;

      //执行重载
      table.reload('LAY-user-manage', {
        where: field
      });
    });
  
    //事件
    var active = {
      batchdel: function(){
        var checkStatus = table.checkStatus('LAY-user-manage')
        ,checkData = checkStatus.data; //得到选中的数据

        if(checkData.length === 0){
          return layer.msg('请选择数据');
        }
        
        layer.prompt({
          formType: 1
          ,title: '敏感操作，请验证口令'
        }, function(value, index){
          layer.close(index);
          
          layer.confirm('确定删除吗？', function(index) {
            
            //执行 Ajax 后重载
            /*
            admin.req({
              url: 'xxx'
              //,……
            });
            */
            table.reload('LAY-user-manage');
            layer.msg('已删除');
          });
        });
      }
      ,add: function(){
        layer.open({
          type: 2
          ,title: '添加用户'
          ,content: 'userform.html'
          ,maxmin: true
          ,area: ['500px', '450px']
          ,btn: ['确定', '取消']
          ,yes: function(index, layero){
            var iframeWindow = window['layui-layer-iframe'+ index]
            ,submitID = 'LAY-user-front-submit'
            ,submit = layero.find('iframe').contents().find('#'+ submitID);

            //监听提交
            iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
              var field = data.field; //获取提交的字段
              
              //提交 Ajax 成功后，静态更新表格中的数据
              //$.ajax({});
              table.reload('LAY-user-front-submit'); //数据刷新
              layer.close(index); //关闭弹层
            });  
            
            submit.trigger('click');
          }
        }); 
      }
    };
    
    $('.layui-btn.layuiadmin-btn-useradmin').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });
  });
  </script>
</body>
</html>