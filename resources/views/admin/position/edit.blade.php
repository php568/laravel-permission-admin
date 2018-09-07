@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新广告位</div>
    <form class="layui-form" action="{{route('admin.position.update',['id'=>$position->id])}}" method="post">
        {{ method_field('put') }}
        @include('admin.position._form')
    </form>
@endsection