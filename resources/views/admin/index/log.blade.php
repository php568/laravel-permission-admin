@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">操作日志</div>
    <div class="layui-form" style="padding-top:15px">
        <div class="layui-input-inline">
            <input type="text" id="keyword" placeholder='操作员/路由/类型/名称' class="layui-input"
                   style="width: 300px;">
        </div>
        <button class="layui-btn" id="Search">搜索</button>
    </div>
    <table id="dataTable" lay-filter="dataTable"></table>


@endsection

@section('script')
    <script>
        //用户表格初始化
        var dataTable = table.render({
            elem: '#dataTable'
            , height: 500
            , url: "{{ route('admin.logs.data') }}" //数据接口
            , page: true //开启分页
            , cols: [[ //表头
                {checkbox: true, fixed: true}
                , {field: 'id', title: 'ID', sort: true,width:80}
                , {field: 'user_name', title: '操作人'}
                , {field: 'route', title: '访问地址'}
                , {field: 'name', title: '模块名称'}
                , {field: 'type', title: '访问类型'}
                , {field: 'parameter', title: '访问参数'}
                , {field: 'created_at', title: '创建时间'}
            ]]
        });
        $('#Search').click(function () {
            dataTable.reload({
                where: {keyword: $('#keyword').val()},
                page: {curr: 1}
            });
        });
    </script>
@endsection



