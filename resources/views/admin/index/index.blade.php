@extends('admin.base')

@section('content')
    <div class="layui-elem-quote">后台主页内容</div>
    <div class="layui-row layui-col-space30">
        <div class="layui-col-lg3">
            <div class="pannel layui-bg-blue">
                <p>今日订单数</p>
                <p id="order_count">0</p>
            </div>
        </div>
        <div class="layui-col-lg3">
            <div class="pannel layui-bg-green">
                <p>今日销售总额(万元)</p>
                <p id="total_day">0</p>
            </div>
        </div>
        <div class="layui-col-lg3">
            <div class="pannel layui-bg-gray">
                <p>当月销售总额(万元)</p>
                <p id="total_month">0</p>
            </div>
        </div>
        <div class="layui-col-lg3">
            <div class="pannel layui-bg-cyan">
                <p>用户总数</p>
                <p id="member_count">0</p>
            </div>
        </div>
    </div>
@endsection