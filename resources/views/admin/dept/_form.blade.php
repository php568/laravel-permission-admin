{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">上级部门</label>
    <div class="layui-input-block">
        <select name="parent_id" lay-search  lay-filter="parent_id">
            <option value="0">无上级部门</option>
            @foreach($depts as $first)
                <option value="{{ $first['id'] }}" @if(isset($dept->parent_id)&&$dept->parent_id==$first['id']) selected @endif>{{ $first['dept_name'] }}</option>
                @if(isset($first['_child']))
                    @foreach($first['_child'] as $second)
                        <option value="{{$second['id']}}" {{ isset($dept->id) && $dept->parent_id==$second['id'] ? 'selected' : '' }} >┗━━{{$second['dept_name']}}</option>
                        @if(isset($second['_child']))
                            @foreach($second['_child'] as $third)
                                <option value="{{$third['id']}}" {{ isset($dept->id) && $dept->parent_id==$third['id'] ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;┗━━━━{{$third['dept_name']}}</option>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        </select>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">部门名称</label>
    <div class="layui-input-block">
        <input type="text" name="dept_name" value="{{ $dept->dept_name ?? old('dept_name') }}" lay-verify="required" placeholder="请输入部门名称" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">排序</label>
    <div class="layui-input-block">
        <input type="text" name="sort" value="{{ $dept->sort ?? 0 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.dept')}}" >返 回</a>
    </div>
</div>