@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新部门</div>
    <form class="layui-form" action="{{route('admin.dept.update',['id'=>$dept->id])}}" method="post">
        {{ method_field('put') }}
        @include('admin.dept._form')
    </form>
@endsection