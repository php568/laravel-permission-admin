@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加分类</div>
    <form class="layui-form" action="{{route('admin.category.store')}}" method="post">
        @include('admin.category._form')
    </form>
@endsection