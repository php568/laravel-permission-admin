@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新文章</div>
    <form class="layui-form" action="{{route('admin.article.update',['id'=>$article->id])}}" method="post">
        {{ method_field('put') }}
        @include('admin.article._form')
    </form>
@endsection

@section('script')
    @include('admin.article._js')
@endsection
