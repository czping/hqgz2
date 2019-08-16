<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/hqgz3/Public/layuiadmin/style/admin.css" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">

        <div class="layui-form layui-card-header layuiadmin-card-header-auto">

            <div class="layui-form-item">
                <div class="layui-col-md-offset1 layui-col-md11" style="text-align:right">
                    <div class="layui-inline">
                        <label class="layui-form-label">部门</label>
                        <div class="layui-input-block">
                            <select name="dept" lay-verify="" id="dept" lay-filter="dept">
                                <option value="all" selected>所有账号</option>
                                <?php if(is_array($depts)): $i = 0; $__LIST__ = $depts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$deptname): $mod = ($i % 2 );++$i;?><option value="<?php echo ($deptname["部门名称"]); ?>"><?php echo ($deptname["部门名称"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-block">
                            <input type="text" name="username" id="username" placeholder="请输入" autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">身份证号码</label>
                        <div class="layui-input-block">
                            <input type="text" name="idcard" id="idcard" placeholder="请输入" autocomplete="off"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-useradmin" id="LAY-user-front-search">
                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="layui-card-body">


            <table id="LAY-user-manage" lay-filter="LAY-user-manage" lay-data="{id: 'idTest'}"></table>
            <!--        <script type="text/html" id="imgTpl">
                      <img style="display: inline-block; width: 50%; height: 100%;" src= {{ d.avatar }}>
                    </script> -->
            <script type="text/html" id="table-useradmin-webuser">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                        class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                        class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
        </div>
    </div>
</div>
<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="add"><i class="layui-icon layui-icon-username"></i> 添加
        </button>
    </div>
</script>
<script src="/hqgz3/Public/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/hqgz3/Public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['layer', 'index', 'table'], function () {
        var $ = layui.$
            , form = layui.form
            , table = layui.table
            , layer = layui.layer;

        //用户管理
        var tableIns = table.render({
            id: 'idTest',
            elem: '#LAY-user-manage'
            , url: "<?php echo U('Adminmanage/Management/Accountlist');?>"//layui.setter.base + 'json/useradmin/webuser.js' //模拟接口
            , cols: [[
                {field: 'aid', title: 'ID', width: 80,sort: true}
                ,{field: '姓名', title: '姓名', minWidth: 100,sort: true}
                , {field: '部门名称', title: '部门'}
                , {field: '身份证号', title: '身份证号',sort: true}
                , {field: 'aliasname', width: 80, title: '类别'}
                , {field: 'authname', title: '权限'}
                , {field: 'lasttime', title: '最近登录时间', sort: true}
                , {title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-useradmin-webuser'}
            ]]
            , page: true
            , limit: 30
            , toolbar: '#toolbarDemo'
            , height: 'full-160'
            , loading: true
            , title: '账号管理表'
            , text: '加载出现异常！'
            , where: {dept: 'all'}

        });
        var checkStatus = table.checkStatus('idTest');
        console.log(checkStatus.data.length); //获取选中行的数据
        //监听查询按钮
        $(document).on('click', '#LAY-user-front-search', function () {
            //重载数据窗口
            tableIns.reload({
                where: { //设定异步数据接口的额外参数，任意设
                    dept: $('#dept').val()
                    , username: $('#username').val()
                    , idcard: $('#idcard').val()
                }
                , page: {
                    curr: 1 //重新从第 1 页开始
                }
            });
        });
        //监听toolbar中的添加新用户事件
        table.on('toolbar(LAY-user-manage)', function (obj) {
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'add':
                    layer.open({
                        type: 2
                        , title: '添加用户'
                        , content: "<?php echo U('Adminmanage/Management/Adduser');?>"
                        , maxmin: true
                        , area: ['460px', '480px']
                        , btn: ['确定', '取消']
                        , yes: function (index, layero) {
                            var iframeWindow = window['layui-layer-iframe' + index]
                                , submitID = 'LAY-user-front-submit'
                                , submit = layero.find('iframe').contents().find('#' + submitID);

                            //监听提交
                            iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                                var field = data.field; //获取提交的字段
                                //提交 Ajax 成功后，静态更新表格中的数据
                                $.ajax({
                                    type: 'POST',
                                    url: "<?php echo U('Adminmanage/Management/Addusersubmit');?>",
                                    data: field,
                                    success: function (data) {
                                        layer.msg(data);
                                    },
                                    error: function (jqXHR) {
                                        layer.msg('添加失败', {icon: 5});
                                    }

                                });
                                tableIns.reload('LAY-user-front-submit'); //数据刷新
                                layer.close(index); //关闭弹层
                            });

                            submit.trigger('click');
                        }
                    });
                    break;
            }
            ;
        });
        //监听表格内的删除和编辑按钮
        table.on('tool(LAY-user-manage)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.prompt({
                    formType: 1
                    ,title: '敏感操作，请验证口令'
                }, function(value, index){
                    layer.close(index);

                    layer.confirm('真的删除行么', function(index){
                        obj.del();
                        layer.close(index);
                    });
                });
            } else if(obj.event === 'edit'){
                var tr = $(obj.tr);

                layer.open({
                    type: 2
                    ,title: '编辑用户'
                    ,content: "<?php echo U('Adminmanage/Management/Edituser');?>"
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
                    ,success: function(layero, index){

                    }
                });
            }
        });

/*        $('.layui-btn.layuiadmin-btn-useradmin').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });*/
    });
</script>
</body>
</html>