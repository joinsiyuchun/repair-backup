<?php /*a:2:{s:78:"/Applications/MAMP/htdocs/operator/application/index/view/settlement/edit.html";i:1583549292;s:82:"/Applications/MAMP/htdocs/operator/application/index/view/public/layer_layout.html";i:1582010668;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:"一键修设备维修管理系统")); ?></title>
    
    <link rel="stylesheet" type="text/css" href="/static/css/public/public.css" />
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/layuimini.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/iconfont/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/admin.css" />
    
</head>
<body id="layer">
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body">
                    
<form class="layui-form" id="form1" lay-filter="component-form-element">
    <div class="layui-row layui-col-space10 layui-form-item">
        <div class="layui-form-item">
            <label class="layui-form-label">结算主体：</label>
            <div class="layui-input-block">
               <?php echo htmlentities($settlementInfo['org']['name']); ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否取消：</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="有效" lay-verify="required" <?php if($settlementInfo['status'] == '1'): ?>checked<?php endif; ?>>
                <input type="radio" name="status" value="0" title="取消" lay-verify="required" <?php if($settlementInfo['status'] == '0'): ?>checked<?php endif; ?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">结算金额：</label>
            <div class="layui-input-block">
                <input type="text" name="amount" lay-verify="required" lay-reqText="结算金额不能为空" placeholder="请输入结算金额" autocomplete="off" class="layui-input" value="<?php echo htmlentities($settlementInfo['amount']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">结算方式：</label>
            <div class="layui-input-block">
                <input type="radio" name="settle_type" value="1" title="保内" lay-verify="required" <?php if($settlementInfo['settle_type'] == '1'): ?>checked<?php endif; ?>>
                <input type="radio" name="settle_type" value="0" title="保外" lay-verify="required" <?php if($settlementInfo['settle_type'] == '0'): ?>checked<?php endif; ?>>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo htmlentities($settlementInfo['id']); ?>">

        <div class="layui-form-item layui-hide">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" id="submit" lay-submit lay-filter="submit">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary" id="reset">重置</button>
            </div>
        </div>
</form>

                </div>
            </div>
        </div>
    </div>

    
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <script type="text/javascript" src="/static/js/admin/layout.js"></script>
    

    
    
    
    <script>
        layui.use(['element', 'layer', 'layuimini'], function () {
            var $ = layui.jquery,
                element = layui.element,
                layer = layui.layer;
            layuimini.init('');
        });
        function editPwd() {
            layer.open({
                type: 2,
                title: '修改密码',
                shade: 0.6,
                area: ['40%', '50%'],
                content: '<?php echo url("index/editPwd"); ?>'
            });
        }
    </script>
    
    
<script>
    layui.use(['form', 'jquery'], function () {
        var form = layui.form,
            $ = layui.$;

        form.on('submit(submit)',function(data){
            // 加载层
            var loading = layer.msg('处理中，请稍后...', {
                icon: 16,
                shade: 0.2
            });
            $.ajax({
                url: '<?php echo url("doEdit"); ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#form1').serialize(),
                beforeSend: function(){},
                success: function(data){
                    layer.close(loading);
                    if (data.status == 1) {
                        layer.msg(data.message, {
                            time: 1500
                        },function(){
                            parent.window.location.reload();
                            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                            parent.layer.close(index);
                        });
                    } else if (data.status == -1) {
                        layer.alert(data.message, {
                            icon: 0,
                            skin: 'layer-ext-moon'
                        }, function() {
                            window.location.reload();
                        });
                    } else if (data.status == 0) {
                        layer.alert(data.message, {
                            icon: 2,
                            skin: 'layer-ext-moon'
                        },function(){
                            window.location.reload();
                        });
                    }
                }
            });
            return false;
        });
    });
</script>

</body>
</html>