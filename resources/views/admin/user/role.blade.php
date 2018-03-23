@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">用户【{{$user->name}}】分配角色</div>
    <style>
        .layui-form-checkbox span{width: 100px}
    </style>
    <form class="layui-form" action="{{route('admin.user.assignRole',['user'=>$user])}}" method="post">
        {{csrf_field()}}
        {{method_field('put')}}
        <div class="layui-form-item">
            <label for="" class="layui-form-label">角色</label>
            <div class="layui-input-block">
                @forelse($roles as $role)
                <input type="checkbox" name="roles[]" value="{{$role->id}}" title="{{$role->display_name}}" {{ $role->own ? 'checked' : ''  }} >
                @empty
                    <div class="layui-form-mid layui-word-aux">还没有角色</div>
                @endforelse
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                <a class="layui-btn" href="{{route('admin.user')}}" >返 回</a>
            </div>
        </div>
    </form>
@endsection


