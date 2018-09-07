@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">部门管理</div>
    <div class="layui-btn-group">
    @can('system.dept.create')
        <a class="layui-btn layui-btn-sm" href="{{ route('admin.dept.create') }}">添 加</a>
    @endcan
    </div>
    <table id="dataTable" lay-filter="dataTable"></table>
    <script type="text/html" id="options">
        <div class="layui-btn-group">
        @can('system.dept')
        <a class="layui-btn layui-btn-sm" lay-event="children">子部门</a>
        @endcan
        @can('system.dept.edit')
        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
        @endcan
        @can('system.dept.destroy')
        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
        @endcan
        </div>
    </script>
@endsection

@section('script')
    @can('system.dept')
        <script>
            //用户表格初始化
            var dataTable = table.render({
                elem: '#dataTable'
                ,height: 500
                ,url: "{{ route('admin.dept.data') }}" //数据接口
                ,page: true //开启分页
                ,cols: [[ //表头
                    {checkbox: true,fixed: true}
                    ,{field: 'id', title: 'ID', sort: true,width:80}
                    ,{field: 'dept_name', title: '部门名称'}
                    ,{field: 'sort', title: '排序'}
                    ,{field: 'created_at', title: '创建时间'}
                    ,{field: 'updated_at', title: '更新时间'}
                    ,{fixed: 'right', width: 320, align:'center', toolbar: '#options'}
                ]]
            });

            //监听工具条
            table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data //获得当前行数据
                    ,layEvent = obj.event; //获得 lay-event 对应的值
                if(layEvent === 'del'){
                    layer.confirm('确认删除吗？', function(index){
                        $.post("{{ route('admin.dept.destroy') }}",{_method:'delete',ids:data.id},function (result) {
                            if (result.code==0){
                                obj.del(); //删除对应行（tr）的DOM结构
                            }
                            layer.close(index);
                            layer.msg(result.msg)
                        });
                    });
                } else if(layEvent === 'edit'){
                    location.href = '/admin/dept/'+data.id+'/edit';
                } else if (layEvent === 'children'){
                    dataTable.reload({
                        where:{parent_id:data.id},
                        page:{curr:1}
                    })
                }
            });
        </script>
    @endcan
@endsection