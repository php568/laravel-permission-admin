@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">工具日志管理</div>
    <div class="layui-btn-group ">
        @can('system.toolslog.destroy')
            <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删除</button>
        @endcan
        @can('system.toolslog.create')
            <a class="layui-btn layui-btn-sm" href="{{ route('admin.toolslog.create') }}">添加</a>
        @endcan
            <button type="button" class="layui-btn layui-btn-sm" id="searchBtn">搜索</button>
    </div>
    <div class="layui-form" style="padding-top:15px">
        <div class="layui-input-inline">
            <input type="text" class="layui-input" placeholder="创建开始时间" name="start_time" id="start_time">
        </div>
        <div class="layui-form-mid layui-word-aux" style="float:none;display: inline;margin-right: 0">-</div>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" placeholder="创建结束时间" name="end_time" id="end_time">
        </div>
        <div class="layui-input-inline">
            <input type="text" name="file_name" id="file_name" placeholder="请输入文件名称" class="layui-input" >
        </div>
    </div>
    <table id="dataTable" lay-filter="dataTable"></table>
    <script type="text/html" id="options">
        <div class="layui-btn-group">
        @can('system.toolslog.destroy')
        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
        @endcan
        </div>
    </script>
@endsection

@section('script')
    @can('system.toolslog')
        <script>
            //用户表格初始化
            var dataTable = table.render({
                elem: '#dataTable'
                ,height: 500
                ,url: "{{ route('admin.toolslog.data') }}" //数据接口
                ,page: true //开启分页
                ,cols: [[ //表头
                    {checkbox: true,fixed: true}
                    ,{field: 'id', title: 'ID', sort: true,width:80}
                    ,{field: 'file_name', title: '文件名称'}
                    ,{field: 'file_code', title: '文件编码'}
                    ,{field: 'operate_type', title: '操作类型'}
                    ,{field: 'modifier', title: '修改人'}
                    ,{field: 'created_at', title: '修改时间'}
                    ,{field: 'change_item', title: '变更项'}
                ]]
            });

            //监听工具条
            table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data //获得当前行数据
                    ,layEvent = obj.event; //获得 lay-event 对应的值
                if(layEvent === 'del'){
                    layer.confirm('确认删除吗？', function(index){
                        $.post("{{ route('admin.toolslog.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                            if (result.code==0){
                                obj.del(); //删除对应行（tr）的DOM结构
                            }
                            layer.close(index);
                            layer.msg(result.msg)
                        });
                    });
                } else if(layEvent === 'edit'){
                    location.href = '/admin/toolslog/'+data.id+'/edit';
                }
            });

            //按钮批量删除
            $("#listDelete").click(function () {
                var ids = []
                var hasCheck = table.checkStatus('dataTable')
                var hasCheckData = hasCheck.data
                if (hasCheckData.length>0){
                    $.each(hasCheckData,function (index,element) {
                        ids.push(element.id)
                    })
                }
                if (ids.length>0){
                    layer.confirm('确认删除吗？', function(index){
                        $.post("{{ route('admin.toolslog.destroy') }}",{_method:'delete',ids:ids},function (result) {
                            if (result.code==0){
                                dataTable.reload()
                            }
                            layer.close(index);
                            //layer.msg(result.msg,)
                        });
                    })
                }else {
                    layer.msg('请选择删除项')
                }
            });
            
            //搜索
            laydate.render({
                elem: "#start_time",
            });
            laydate.render({
                elem: "#end_time",
            });
            $("#searchBtn").click(function () {
                var start_time = $("#start_time").val()
                var end_time = $("#end_time").val();
                var file_name = $("#file_name").val();
                dataTable.reload({
                    where:{start_time:start_time,end_time:end_time,file_name},
                    page:{curr:1}
                })
            })
            
        </script>
    @endcan
@endsection