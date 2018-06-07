@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加标签</div>
    <form class="layui-form" action="{{route('admin.tag.store')}}" method="post">
        @include('admin.tag._form')
    </form>
@endsection