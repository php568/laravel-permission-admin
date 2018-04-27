@extends('admin.login.base')

@section('content')
    <form class="layui-form" action="{{route('password.update')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-key"></i> 邮&nbsp;&nbsp;&nbsp;箱</label>
            <div class="layui-input-block">
                <input type="text" name="email" lay-verify="email" value="{{ old('email') }}" placeholder="请输入邮箱" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-key"></i> 密&nbsp;&nbsp;&nbsp;码</label>
            <div class="layui-input-block">
                <input type="password" name="password" lay-verify="required" class="layui-input" placeholder="请输入新密码">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-key"></i> 确认密码</label>
            <div class="layui-input-block">
                <input type="password" name="password_confirmation" lay-verify="required" class="layui-input" placeholder="请确认新密码">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" >确认</button>
                <a href="{{route('login')}}" type="submit" class="layui-btn" >返回登录</a>
            </div>
        </div>
    </form>
@endsection
