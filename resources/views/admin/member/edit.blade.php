@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新账号</div>
    <form class="layui-form" action="{{route('admin.member.update',['member'=>$member])}}" method="post">
        <input type="hidden" name="id" value="{{$member->id}}">
        {{method_field('put')}}
        @include('admin.member._form')
    </form>
@endsection

@section('script')
    @include('admin.member._js')
@endsection
