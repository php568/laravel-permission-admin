@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加文章</div>
    <form class="layui-form" action="{{route('admin.article.store')}}" method="post">
    @include('admin.article._form')
    </form>
@endsection

@section('script')
    @include('admin.article._js')
@endsection
