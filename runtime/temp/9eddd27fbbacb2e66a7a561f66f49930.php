<?php /*a:2:{s:78:"/Applications/MAMP/htdocs/operator/application/index/view/dicominfo/index.html";i:1598795866;s:76:"/Applications/MAMP/htdocs/operator/application/index/view/public/layout.html";i:1582011447;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="/static/css/iconfont/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/admin/admin.css" />
    
    
</head>
<body class="layui-layout-body">
    <div class="layui-card">
        <div class="layui-card-header">
            <i class="iconfont">&#xe755;</i> <?php echo htmlentities($title); ?></i>
        </div>
        <div class="layui-card-body">
            

<table class="layui-hide" id="dataTable" lay-filter="dataTable"></table>

<script type="text/html" id="toolbar">
    <div class="dataToolbar">
        <div class="layui-inline">
            <input class="layui-input" name="keywords" id="keywords" value="<?php echo input('keywords'); ?>" autocomplete="on" placeholder="请输入设备ID">
        </div>
        <button class="layui-btn search-btn" data-type="reload"><i class="iconfont">&#xe679;</i> 查询</button>

    </div>
</script>


<script type="text/html" id="barTool">
    <?php if((buttonCheck('index/dicominfo/del'))): ?>

    <a href='javascript:;' lay-event="del" class="layui-btn layui-btn-danger layui-btn-xs"><i class="iconfont">&#xe6b4;</i> 删除</a>

    <?php endif; ?>

</script>



        </div>
    </div>

    
    <script type="text/javascript" src="/static/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>

    
    
    
<script>
    layui.use(['jquery', 'layer', 'form', 'table'], function () {
        var $ = layui.$,
            layer = layui.layer,
            form = layui.form,
            table = layui.table;

        // 渲染数据表格
        table.render({
            elem : '#dataTable'
            ,url : '<?php echo url("dicominfoList"); ?>'
            ,cellMinWidth: 80
            ,page: {
                prev: '上一页',
                next: '下一页',
                layout: ['prev', 'page', 'next', 'skip', 'count', 'limit']
            }
            // ,toolbar: 'default'  // 开启顶部工具栏（默认模板）
            ,toolbar: '#toolbar' // 指定顶部工具栏模板
            // ,even: true  // 隔行背景
            ,title: 'DICOM信息表'  // 表格标题，用户导出数据文件名
            ,text: {  // 指定无数据或数据异常时的提示文本
                none: '暂无相关数据' //默认：无数据。注：该属性为 layui 2.2.5 开始新增
            }
            ,id: 'dataTable'
            ,cols: [[  // 表格列标题及数据
                {field: 'id', width: 200, title: 'ID', sort: true, align: 'center'}
                ,{field: 'deviceId', width: 200, title: '设备ID', align: 'center'}
                ,{field: 'studyInstanceUid', width: 200, title: '检查实例ID', sort: true,  align: 'center'}
                ,{field: 'studyId', width: 200, title: '检查ID', sort: true,  align: 'center'}
                ,{field: 'patientId', width: 200, title: '病人ID', sort: true,  align: 'center'}
                ,{field: 'studyDate', width: 200, title: '检查日期', sort: true,  align: 'center'}
                ,{field: 'studyTime', width: 80, title: '检查时间',align: 'center', sort: true, templet: '#status'}
                ,{field: 'studyDescription', width: 200, title: '检查描述', sort: true,  align: 'center'}
                ,{field: 'modalitiesInStudy', width: 200, title: '设备类型', sort: true,  align: 'center'}
                ,{field: 'accessionNumber', width: 200, title: '影像号', sort: true,  align: 'center'}
                ,{field: 'bodyPartExamined', width: 200, title: '检查部位', sort: true,  align: 'center'}
                ,{field: 'requestedProcedureDescription', width: 200, title: '检查步骤描述', sort: true,  align: 'center'}
                ,{field: 'create_time', width: 200, title: '报告时间', sort: true,  align: 'center'}
                ,{fixed: 'right', width: 250, title: '操作', align:'center', toolbar: '#barTool'}
            ]], done() {
                // 搜索功能
                var $ = layui.$, active = {
                    reload: function(){
                        var keywords = $('#keywords');
                        //执行重载
                        table.reload('dataTable', {
                            page: {
                                curr: 1 //重新从第 1 页开始
                            }
                            ,where: {
                                keywords: keywords.val()
                            }
                        }, 'data');
                    }
                };
                $('.search-btn').on('click', function(){
                    var type = $(this).data('type');
                    active[type] ? active[type].call(this) : '';
                });
            }
        });

        // 监听行内工具栏
        table.on('tool(dataTable)', function (obj) {
            var e = obj.event;
            var data = obj.data;

            if ( e === 'del') {
                layer.confirm('您确定要删除吗？', {
                    icon: 3
                },function(index){
                    // 加载层
                    var loading = layer.msg('处理中，请稍后...', {
                        icon: 16,
                        shade: 0.5
                    });
                    $.ajax({
                        url: '<?php echo url("Dicominfo/del"); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id : data.id
                        },
                        beforeSend: function(){},
                        success: function(data){
                            layer.close(loading);
                            if (data.status == 1) {
                                layer.msg(data.message, {
                                    time: 1500
                                },function(){
                                    window.location.reload();
                                });
                            } else if ( data.status == -1 ) {
                                layer.alert(data.message, {
                                    icon: 2
                                },function(){
                                    window.location.reload();
                                });
                            } else {
                                layer.alert(data.message, {
                                    icon: 2
                                },function(){
                                    window.location.reload();
                                });
                            }
                        }
                    });
                });
            }
        });

    });


</script>

</body>
</html>