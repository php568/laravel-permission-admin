@extends('admin.login.base')

@section('content')
    <form class="layui-form" action="{{route('password.send')}}" method="post">
        {{csrf_field()}}

        <div class="layui-form-item">
            <label for="" class="layui-form-label"><i class="fa fa-key"></i> 邮&nbsp;&nbsp;&nbsp;箱</label>
            <div class="layui-input-block">
                <input type="text" name="email" lay-verify="email" value="{{ old('email') }}" placeholder="请输入邮箱" class="layui-input">
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
