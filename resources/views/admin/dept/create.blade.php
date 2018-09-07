@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加部门</div>
    <form class="layui-form" action="{{route('admin.dept.store')}}" method="post">
        @include('admin.dept._form')
    </form>
@endsection