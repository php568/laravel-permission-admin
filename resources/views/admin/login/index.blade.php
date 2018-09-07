@extends('admin.login.base')

@section('content')
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
            <div class="layui-input-inline" style="width:150px;">
                <input type="text" name="captcha" maxlength="4" lay-verify="required" placeholder="验证码" class="layui-input">
            </div>
            <div style="float: right;padding:0;">
                <img src="{{ captcha_src() }}" onclick="changeCaptcha(this);" title="点击切换" height="39">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" >确认登陆</button>
                <button type="reset" class="layui-btn" lay-submit="" >重 置</button>
                <a href="{{route('password.email')}}" type="button" class="layui-btn" >找回密码</a>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        function changeCaptcha(obj) {
            $(obj).attr("src","{{ captcha_src() }}?t="+Math.random())
        }
    </script>
@endsection