<script>
    //普通图片上传
    var uploadInst = upload.render({
        elem: '#uploadPic'
        ,url: '{{ route("uploadImg") }}'
        ,multiple: false
        ,data:{"_token":"{{ csrf_token() }}"}
        ,before: function(obj){
            //预读本地文件示例，不支持ie8
            /*obj.preview(function(index, file, result){
             $('#layui-upload-box').append('<li><img src="'+result+'" /><p>待上传</p></li>')
             });*/
            obj.preview(function(index, file, result){
                $('#layui-upload-box').html('<li><img src="'+result+'" /><p>上传中</p></li>')
            });

        }
        ,done: function(res){
            //如果上传失败
            if(res.code == 0){
                $("#thumb").val(res.url);
                $('#layui-upload-box li p').text('上传成功');
                return layer.msg(res.msg);
            }
            return layer.msg(res.msg);
        }
    });
</script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
    });
</script>