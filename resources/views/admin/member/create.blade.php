@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加用户</div>
    <form class="layui-form" action="{{route('admin.member.store')}}" method="post">
    @include('admin.member._form')
    </form>
@endsection
@section('script')
    @include('admin.member._js')
@endsection
