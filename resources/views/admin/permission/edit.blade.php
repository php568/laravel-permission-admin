@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新权限</div>
    <form class="layui-form" action="{{route('admin.permission.update',['permission'=>$permission])}}" method="post">
        {{method_field('put')}}
        <input type="hidden" name="id" value="{{ $permission->id }}">
        @include('admin.permission._from')
    </form>
@endsection

@section('script')
    @include('admin.permission._js')
@endsection