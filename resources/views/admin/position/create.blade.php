@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加广告位</div>
    <form class="layui-form" action="{{route('admin.position.store')}}" method="post">
        @include('admin.position._form')
    </form>
@endsection