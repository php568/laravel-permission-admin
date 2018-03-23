<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="/static/css/login.css" />
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <style>
        body {
            height: 100%;
            background: #16a085;
            overflow: hidden;
        }
        canvas {
            z-index: -1;
            position: absolute;
        }
    </style>
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/layui/layui.all.js"></script>
    <script src="/static/js/verificationnumbers.js" ></script>
    <script src="/static/js/particleground.js" ></script>
</head>
<body>
<div class="admin_login">
    <div class="ext_info">
        <strong>Laravel5.5后台管理</strong>
        <em>初心易得，始终难守</em>
    </div>

    <form class="layui-form" action="{{route('admin.login')}}" method="post">
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-user"></i> 用户名</label>
            <div class="layui-input-block">
                <input type="text" name="name" value="{{old('name')}}" lay-verify="required" placeholder="用户名" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-key"></i> 密&nbsp;&nbsp;&nbsp;码</label>
            <div class="layui-input-block">
                <input type="password" name="password" lay-verify="required" placeholder="密码" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="" class="layui-form-label">验证码</label>
            <div class="layui-input-block">
                {!! Geetest::render('popup') !!}
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" >确认登陆</button>
                <button type="reset" class="layui-btn" lay-submit="" >重 置</button>
            </div>
        </div>
    </form>

    <div class="ext_info">
        <p>© 2015-2016 Layui 版权所有</p>
        <p>备案号：8888888</p>
    </div>

</div>
</body>
<script>

        var layer = layui.layer;
        var form = layui.form;
        var element = layui.element;

        form.render();

        $(document).ready(function () {
            //粒子背景特效
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
        });

        @if(count($errors)>0)
        var errorStr = '';
        @foreach($errors->all() as $error)
            errorStr += "{{$error}}<br />";
        @endforeach
        layer.msg(errorStr);
        @endif

</script>
</html>
