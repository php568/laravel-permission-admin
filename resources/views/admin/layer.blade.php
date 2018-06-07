<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title></title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/static/js/jquery.min.js"  type="text/javascript"></script>
    <script src="/static/layui/layui.all.js"  type="text/javascript"></script>
</head>
<body>
@yield('content')


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var element = layui.element;
    var layer = layui.layer;
    var form = layui.form;
    var table = layui.table;
    var upload = layui.upload;

    form.render();
    element.render();

</script>
@yield('script')
</body>
</html>