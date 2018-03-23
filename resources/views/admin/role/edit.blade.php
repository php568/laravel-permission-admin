@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新角色</div>
    <form action="{{route('admin.role.update',['role'=>$role])}}" method="post" class="layui-form">
        {{method_field('put')}}
        <input type="hidden" name="id" value="{{$role->id}}">
        @include('admin.role._form')
    </form>
@endsection