<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/hqgz3/Public/layui/css/layui.css" media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
    <style>
        .footer {
            position: fixed;
            left: 0px;
            right: 0;
            bottom: 0;
            height: 50px;
            line-height: 44px;
            padding: 0 15px;
            margin-bottom: 0px;
            background-color: #f2f2f2;
            text-align: center;
        }

        .header {
            margin-bottom: 10px;
            padding: 15px;
            line-height: 22px;
            border-radius: 0 2px 2px 0;
            background-color: #55bef1;
            text-align: center;

        }
        .layui-table th {
            text-align: center;
        }
    </style>
</head>
<body>



<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend><?php echo ($result_value['年份']); ?>年<?php echo ($result_value['月份']); ?>月<?php echo ($result_value['姓名']); ?>的薪资明细</legend>
</fieldset>
<div class="layui-row">
    <div class="layui-col-md1 layui-col-md-offset1">
        &nbsp;
    </div>
    <div class="layui-col-xs12 layui-col-sm12 layui-col-md6 layui-col-md-offset1">

        <div class="layui-form" style="
    border-width: 4px;
    border-style: solid;
    border-color: #9c4545;
">
            <table class="layui-table" lay-even="" >
                <?php $num=0;$value_array=array();?>
                <?php if(is_array($result_field)): foreach($result_field as $key=>$field): if(in_array(($field), explode(',',"ID,性别,部门编号,班组编号,班组名称,人员类别,人数,类别名称,审核人,身份证号,卡号,审核标志,分类标志"))): continue; endif; ?>
                    <?php if($key <= 15): if($key == 1): ?><thead>
                            <tr><?php endif; ?>
                        <?php if($key <= 15): ?><th><?php echo $field;?></th>
                            <?php if($key < 15): array_push($value_array,$field);continue;?>
                                <?php else: ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php array_push($value_array,$field); endif; endif; ?>
                        <tr>
                            <?php if(is_array($value_array)): foreach($value_array as $key2=>$field_value): ?><th><?php echo $result_value["$field_value"];?></th><?php endforeach; endif; ?>
                            <?php $value_array=array();?>
                        </tr>
                        
                        <?php else: ?>
                        <?php if($num == 0): ?><tr><?php endif; ?>
                        <?php if(($field == '应发') or ($field == '卡发') ): ?><th style="background: #90d4f5;">
                                <?php echo $field;$num++;array_push($value_array,$field)?>
                                    
                                </th>
                                <?php else: ?>
                                 <th >
                                <?php echo $field;$num++;array_push($value_array,$field)?>
                                    
                                </th><?php endif; ?>
                        <?php if(($num == 6) or ($field == '唯一标识')): ?></tr>
                            <?php $num=0;?>
                            <tr>
                            <?php if(is_array($value_array)): foreach($value_array as $key2=>$field_value): ?><th><?php echo $result_value["$field_value"];?></th><?php endforeach; endif; ?>
                            <?php $value_array=array();?>
                        </tr><?php endif; endif; endforeach; endif; ?>


                </tbody>
            </table>

        </div>

    </div>


<div class="footer">


</div>
<script src="/hqgz3/Public/layui/layui.js"></script>
<script src="/hqgz3/Public/layui/jquery.min.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;       
        form.on('select(dates)', function(data){
            //console.log(data.value); //得到被选中的值
            $('#selectdate').submit();            
        });
    });
    $(document).on('click','#btn',function(){
        window.location.href = "<?php echo U('Index/Loginout');?>";
    });
</script>

</body>
</html>