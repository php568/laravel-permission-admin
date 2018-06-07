@extends('admin.layer')

@section('content')
    <div style="padding:0 10px;">
        <div class="layui-form" style="padding-top:15px">
            <div class="layui-input-inline">
                <select name="user_type" lay-verify="required">
                    <option value="2">后台用户</option>
                    <option value="3">前台用户</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <input type="text" name="keywords" placeholder="请输入用户名或手机号码" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn">搜索</button>
                <button type="button" class="layui-btn">确定</button>
            </div>
        </div>
        <table id="dataTable" lay-filter="dataTable"></table>
    </div>
@endsection

@section('script')
    <script>
        //用户表格初始化
        var dataTable = table.render({
            elem: '#dataTable'
            ,height: 300
            ,url: "{{route('admin.message.getUser')}}" //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {checkbox: true,fixed: true}
                ,{field: 'id', title: 'ID', sort: true,width:80}
                ,{field: 'name', title: '用户名'}
                ,{field: 'phone', title: '电话'}
            ]]
        });
    </script>
@endsection