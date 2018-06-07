@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新标签</div>
    <form class="layui-form" action="{{route('admin.tag.update',['id'=>$tag->id])}}" method="post">
        {{ method_field('put') }}
        @include('admin.tag._form')
    </form>
@endsection