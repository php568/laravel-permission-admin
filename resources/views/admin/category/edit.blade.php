@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新分类</div>
    <form class="layui-form" action="{{route('admin.category.update',['id'=>$category->id])}}" method="post">
        {{ method_field('put') }}
        @include('admin.category._form')
    </form>
@endsection