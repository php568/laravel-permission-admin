@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">添加广告信息</div>
    <form class="layui-form" action="{{route('admin.advert.store')}}" method="post">
        @include('admin.advert._form')
    </form>
@endsection

@section('script')
    @include('admin.advert._js')
@endsection