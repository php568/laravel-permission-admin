@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加角色</div>
    <form action="{{route('admin.role.store')}}" method="post" class="layui-form">
        @include('admin.role._form')
    </form>
@endsection