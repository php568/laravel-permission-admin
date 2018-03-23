@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新用户</div>
    <form class="layui-form" action="{{route('admin.user.update',['user'=>$user])}}" method="post">
        <input type="hidden" name="id" value="{{$user->id}}">
        {{method_field('put')}}
        @include('admin.user._form')
    </form>
@endsection


