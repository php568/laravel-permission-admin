@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">更新广告信息</div>
    <form class="layui-form" action="{{route('admin.advert.update',['id'=>$advert->id])}}" method="post">
        {{ method_field('put') }}
        @include('admin.advert._form')
    </form>
@endsection

@section('script')
    @include('admin.advert._js')
@endsection