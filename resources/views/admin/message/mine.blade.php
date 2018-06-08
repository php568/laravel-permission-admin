@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">我的消息</div>
    <div class="layui-btn-group ">
        <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删除</button>
        <a class="layui-btn layui-btn-sm" href="{{ route('admin.message.create') }}">添加</a>
        <a class="layui-btn layui-btn-sm layui-btn-normal" id="searchBtn">搜索</a>
    </div>
    <div class="layui-form layui-form-pane" style="padding-top:15px" pane>
        <div class="layui-form-item">
            <label class="layui-form-label">筛选状态</label>
            <div class="layui-input-inline">
                <select name="audit_status" id="audit_status">
                    <option value="">阅读状态</option>
                    @foreach($read_status as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>
    <table id="dataTable" lay-filter="dataTable"></table>
    <script type="text/html" id="options">
        <div class="layui-btn-group">
            <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
        </div>
    </script>
@endsection

@section('script')
        <script type="text/javascript">
            //用户表格初始化
            var dataTable = table.render({
                elem: '#dataTable'
                , height: 500
                , url: "{{ route('admin.message.mine.data') }}" //数据接口
                , page: true //开启分页
                , cols: [[ //表头
                    {checkbox: true, fixed: true}
                    , {field: 'id', title: 'ID', sort: true}
                    , {field: 'title', title: '标题'}
                    , {field: 'content', title: '内容'}
                    , {field: 'send_uuid', title: '发送人'}
                    , {field: 'accept_uuid', title: '接收人'}
                    , {field: 'read', title: '是否已读'}
                    , {field: 'created_at', title: '创建时间'}
                    , {fixed: 'right', width: 220, align: 'center', toolbar: '#options'}
                ]]
            });

            //监听工具条
            table.on('tool(dataTable)', function (obj) { //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data //获得当前行数据
                    , layEvent = obj.event; //获得 lay-event 对应的值
                if (layEvent === 'del') {
                    layer.confirm('确认删除吗？', function (index) {
                        $.post("{{ route('admin.message.destroy') }}", {
                            _method: 'delete',
                            ids: [data.id]
                        }, function (result) {
                            if (result.code == 0) {
                                obj.del(); //删除对应行（tr）的DOM结构
                            }
                            layer.close(index);
                            layer.msg(result.msg)
                        });
                    });
                } else if (layEvent === 'edit') {
                    location.href = '/admin/message/' + data.id + '/edit';
                }
            });

            //按钮批量删除
            $("#listDelete").click(function () {
                var ids = []
                var hasCheck = table.checkStatus('dataTable')
                var hasCheckData = hasCheck.data
                if (hasCheckData.length > 0) {
                    $.each(hasCheckData, function (index, element) {
                        ids.push(element.id)
                    })
                }
                if (ids.length > 0) {
                    layer.confirm('确认删除吗？', function (index) {
                        $.post("{{ route('admin.message.destroy') }}", {
                            _method: 'delete',
                            ids: ids
                        }, function (result) {
                            if (result.code == 0) {
                                dataTable.reload()
                            }
                            layer.close(index);
                            layer.msg(result.msg,)
                        });
                    })
                } else {
                    layer.msg('请选择删除项')
                }
            })
    </script>
@endsection