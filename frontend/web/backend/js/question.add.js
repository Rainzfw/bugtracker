$(function(){
    //点击上传图片 发送ajax
    $("#imgbtn").click(function(){
        //这个意思就是手动点击了 上传图片的隐藏按钮
        $("#imgFile").click();
    });
    $('#imgFile').change(function(){
        $('#imgForm').ajaxSubmit({
            type:"POST",
            dataType:'json',
            url:'/upload/upload-img.html',
            success:function(data){
                if(data.status == 'success'){
                    if($('.new_div').length){
                        //发送请求删除图片
                        var filepath = $('#img').attr('src');
                        $.ajax({
                            type:'POST',
                            dataType:'json',
                            url:'/upload/delete.html',
                            data:{filepath:filepath},
                            success:function(){
                                layer.msg('更改图片成功!',{icon: 6});
                            }
                        });
                    }
                    $('.new_div').remove();
                    //追加展示的图片
                    $('.field-question-is_show').before(
                        '<div class="form-group new_div" id="file-imgList"><ul><li class="list-group-item" ><img id="img" src="'+data.url + '" alt="" style="width:600px"/><div><a id="btn-closed" role="button" class="btn">删除图片</a></div></li></ul></div>'
                    );
                    //追加隐藏域 保存图片路径
                    $(".field-question-is_show").after(
                        '<div class="form-group new_div" id="img_up"><input type = "hidden" name= "Question[img]" value= "'+ data.path+'" /></div>'
                    );
                    //绑定图片的删除事件
                    $("#btn-closed").click(function(){

                        //发送请求删除图片
                        var filepath = $('#img').attr('src');
                        $.ajax({
                            type:'POST',
                            dataType:'json',
                            url:'/upload/delete.html',
                            data:{filepath:filepath},
                            success:function(){
                                layer.msg('删除图片成功!',{icon: 6});
                            }
                        });
                        //删除节点
                        $('.new_div').remove();

                    });
                    layer.msg('上传图片成功!', {icon: 6});
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
                layer.closeAll('loading');
            },
            error:function(){
                layer.msg('上传图片失败!', {icon: 5});
                layer.closeAll('loading');
            },
            async:true
        });
    });
});
