
<script>
    //选择图标
    function chioceIcon(obj) {
        var icon_id = $(obj).data('id');
        $("input[name='icon_id']").val(icon_id);
        $("#icon_box").html('<i class="layui-icon '+$(obj).data('class')+'"></i> '+$(obj).data('name'));
        layer.closeAll();
    }

    //弹出图标
    function showIconsBox() {
        var index = layer.load();
        $.get("{{route('admin.icons')}}",function (res) {
            layer.close(index);
            if (res.code==0 && res.data.length>0){
                var html = '<ul class="site-doc-icon">';
                $.each(res.data,function (index,item) {
                    html += '<li onclick="chioceIcon(this)" data-id="'+item.id+'" data-class="'+item.class+'" data-name="'+item.name+'" >';
                    html += '   <i class="layui-icon '+item.class+'"></i>';
                    html += '   <div class="doc-icon-name">'+item.name+'</div>';
                    html += '   <div class="doc-icon-code"><xmp>'+item.unicode+'</xmp></div>';
                    html += '   <div class="doc-icon-fontclass">'+item.class+'</div>';
                    html += '</li>'
                });
                html += '</ul>';
                layer.open({
                    type:1,
                    title:'选择图标',
                    area : ['1080px','600px'],
                    content:html
                })
            }else {
                layer.msg(res.msg);
            }
        },'json')
    }
</script>