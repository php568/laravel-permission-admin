@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加用户</div>
    <form class="layui-form" action="{{route('admin.user.store')}}" method="post">
    @include('admin.user._form')
    </form>
@endsection


