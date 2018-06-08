@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">推送消息</div>
    <form class="layui-form" action="{{route('admin.message.store')}}" method="post">
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="" class="layui-form-label">标题</label>
            <div class="layui-input-inline">
                <input type="text" name="title" value="{{ old('title') }}" lay-verify="required" placeholder="请输入标题" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label">内容</label>
            <div class="layui-input-inline">
                <textarea name="content" class="layui-textarea" cols="30" rows="6" lay-verify="required" placeholder="请输入内容">{{old('content')}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="" class="layui-form-label">接收人</label>
            <div class="layui-form-mid layui-word-aux" style="float: none">
                <button class="layui-btn layui-bg-green layui-btn-xs"></button>-后台用户
                <button class="layui-btn layui-bg-black layui-btn-xs"></button>-前台用户
                <button type="button" class="layui-btn layui-btn-xs" onclick="getUser()">点击选择</button>
            </div>
            <div class="layui-input-block">
                <ul class="userBox layui-clear userBox2"></ul>
                <ul class="userBox layui-clear userBox3"></ul>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                <a  class="layui-btn" href="{{route('admin.message')}}" >返 回</a>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        function getUser() {
            layer.open({
                type:2,
                title:'选择用户',
                area : ['630px','430px'],
                content:"{{route('admin.message.getUser')}}"
            })
        }
        function removeLi(obj) {
            $(obj).parent('li').remove();
        }
    </script>
@endsection