<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台管理</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/static/js/jquery.min.js" type="text/javascript"></script>
    <script src="/static/layui/layui.all.js" type="text/javascript"></script>
    <script src="/static/js/socket.io.js" type="text/javascript"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo" style="color: #fff;font-size: 28px">后台管理</div>
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="{{ route('admin.index') }}"><i class="layui-icon">&#xe68e;</i> 后台首页</a>
            </li>
            <li class="layui-nav-item">
                <a href="{{route('admin.message.mine')}}">我的消息<span class="layui-badge"
                                                                    id="unreadMessage">{{$unreadMessage}}</span></a>
                {{--<dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>--}}
            </li>
            <li class="layui-nav-item">
                <a href="{{route('admin.logs')}}">日志记录</a>
            </li>

        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">{{auth()->user()->name}}</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{ route('admin.user.edit',['id'=>auth()->id()]) }}">基本资料</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="{{ route('logout') }}">退出</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree" lay-filter="nav">
                @foreach($menus as $menu)
                    @can($menu->name)
                        <li class="layui-nav-item">
                            <a href="javascript:;"><i
                                        class="layui-icon {{$menu->icon->class??''}}"></i> {{$menu->display_name}}</a>
                            @if(!$menu->childs->isEmpty())
                                <dl class="layui-nav-child">
                                    @foreach($menu->childs as $subMenu)
                                        @can($subMenu->name)
                                            <dd><a href="{{ route($subMenu->route) }}"><i
                                                            class="layui-icon {{$subMenu->icon->class}}"></i> {{$subMenu->display_name}}
                                                </a></dd>
                                        @endcan
                                    @endforeach
                                </dl>
                            @endif
                        </li>
                    @endcan
                @endforeach
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <div class="layui-fluid" style="padding-top:15px;">
            @yield('content')
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © 底部固定区域
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("ul[lay-filter='nav'] .layui-nav-child dd a").each(function () {
            var href = $(this).attr('href');
            var url = window.location.href;
            var flag = url.indexOf(href);
            if (flag == 0) {
                $(this).parents('.layui-nav-item').addClass('layui-nav-itemed');
                $(this).parent().addClass('layui-this');
                $(this).siblings().removeClass('layui-nav-itemed');
            }
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var element = layui.element;
    var layer = layui.layer;
    var form = layui.form;
    var table = layui.table;
    var upload = layui.upload;
    var laydate = layui.laydate;

    form.render();
    element.render();

    //统一错误提示信息
            @if(count($errors)>0)
    var errorStr = '';
    @foreach($errors->all() as $error)
        errorStr += "{{$error}}<br />";
    @endforeach
    layer.msg(errorStr);
    @endif

    @if(session('status'))
    layer.msg("{{session('status')}}");
    @endif

    //删除确认
    function delConfirm(url) {
        layer.confirm('真的删除行么', function (index) {
            layer.close(index);
            $.post(url, {_method: "delete"}, function (data) {
                layer.msg(data.msg, {time: 1000}, function () {
                    if (data.code == 0) {
                        location.reload()
                    }
                });
            })
        });
    }

    //监听消息推送
    $(document).ready(function () {
        // 连接服务端
        var socket = io("{{env('PUSH_MESSAGE_LOGIN')}}");
        // 连接后登录
        socket.on('connect', function () {
            socket.emit('login', "{{auth()->user()->uuid}}");
        });
        // 后端推送来消息时
        socket.on('new_msg', function (title, content) {
            //弹框提示
            layer.open({
                title: title,
                content: content,
                offset: 'rb',
                anim: 1,
                time: 5000
            })
            //更新未读消息数目
            var currNum = $("#unreadMessage").text();
            $("#unreadMessage").text(parseInt(currNum) + 1);
        });
    });
</script>
@yield('script')
</body>
</html>