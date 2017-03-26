/**
 * 提问表单验证数据的js
 * Created by Administrator on 2017/2/10
 */
//提交，最终验证。
function check(){
    //触发失去焦点事件 验证表单数据是否正确
    $("#quesaddform :input").trigger('blur');
    var numError = $('#quesaddform .err').length;
    if(numError){
        layer.msg('提交的数据有误.');
        //return false;
    }
    //判断问题归属的学科
    if(!$('#sub_id :input[type="radio"]:checked').val()){
        layer.msg('请选择问题归属的学科');
       // return false;
    }
    return true;
}
$(function(){
    //文本框失去焦点后
    $('#quesaddform :input').blur(function(){
        var parentNode = $(this).parent();
        parentNode.find(".formtips").remove();
        //验证问题描述
        if( $(this).is('#ques_title') ){

            if( this.value == "" || this.value.length > 100){
                var errmsg = '问题描述不能为空,并且不超过100个字符.';
                parentNode.append('<div class="help-block formtips err" style="color: #ff0000;text-align: left">'+errmsg+'</div>');
            }else{
                var msg = '输入正确.';
                parentNode.append('<div class="help-block formtips errno" style="color: #ff0000;text-align: left">'+msg+'</div>');
            }
        }
        //验证错误提示
        if( $(this).is('#content') ){

            if(this.value== ""){
                var errmsg = '问题提示不能为空.';
                parentNode.append('<div class="help-block formtips err" style="color: #ff0000;text-align: left">'+errmsg+'</div>');
            }else{
                var msg = '输入正确.';
                parentNode.append('<div class="help-block formtips errno" style="color: #ff0000;text-align: left">'+msg+'</div>');
            }
        }
    }).keyup(function(){
        $(this).triggerHandler("blur");
    }).focus(function(){
        $(this).triggerHandler("blur");
    });//end blur
    //这里是触发点获取教师信息
    $('#sub_id').find('input').click(function(){
        //在这里发送ajax的get请求
        $('#teacher_div').empty();
        $.getJSON('get-teachers.html',{sub_id:this.value},function(data){
            if(data.status=='success'){
                var html = '<label for="teacher_id" class="col-sm-2 control-label">@ANSWER</label>'+
                    '<div class="col-sm-2" style="text-align: left">'+
                    '<select id="teacher_id" name="Question[teacher_id]" class="form-control"> <option value="0">请选择</option>';
                for(var index in data.teachers){
                    html += "<option value ='"+index+"' >"+ data.teachers[index]+"</option> ";
                }
                html += '</select></div><span class="col-sm-8 control-label" style="text-align:left;color:red">非必选</span>';
                $('#teacher_div').append(html);
            }
        });
    });
    //点击上传图片 发送ajax
    $("#upload_file").click(function(){
        //这个意思就是手动点击了 上传图片的隐藏按钮
        $("#in_file").click();
    });
    //给点击事件添加改变事件
    $('#in_file').change(function(){
        var val = $(this).val();
        if(val.length>0){
            layer.load(0,{shade:false});
            //验证图片的格式
            var imgext_regex = /\.(png|jpg|gif)$/;
            if(!imgext_regex.test(val)){
                layer.msg('上传图片格式不正确!');
                layer.closeAll('loading');
                return false;
            }
            $('#up').ajaxSubmit({
                type:"POST",
                dataType:'json',
                url:'/upload/upload-img.html',
                success:function(data){
                    if(data.status == 'success'){
                        //----删除原有图片逻辑开始--------
                        if($('.new_div').length){
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
                            $('.new_div').remove();
                        }
                        //-----删除原有图片逻辑结束-------
                        //追加展示的图片
                        $('#after').after(
                            '<div class="form-group new_div" id="file-imgList"><ul  class="col-sm-offset-2 col-sm-7"><li class="list-group-item" ><img id="img" src="'+data.url+'" alt="" style="width:600px"/>' +
                            '<div><a id="btn-closed" role="button" class="btn">删除图片</a></div></li></ul></div>'
                        );
                        //追加隐藏域 保存图片路径
                        $("#before").before(
                            '<div class="form-group new_div" id="img_up"><div  class="col-sm-offset-2 col-sm-10"><input type = "hidden" name= "Question[img]" value= "'+
                            data.path+'" /></div></div>'
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
                        layer.msg('上传图片成功!',{icon: 6});
                    }else{
                       layer.msg(data.msg);
                    }
                    layer.closeAll('loading');
                },
                error:function(){
                    layer.msg('上传失败',{icon: 5});
                    layer.closeAll('loading');
                },
                async:true
            });
        }
    });
    $('#addsend').click(function(){
        layer.load(0,{shade:false});
        //触发失去焦点事件 验证表单数据是否正确
        $("#quesaddform :input").trigger('blur');
        var numError = $('#quesaddform .err').length;
        if(numError){
            layer.msg('提交的数据有误.', {icon: 5});
            layer.closeAll('loading');
            return false;
        }
        //判断问题归属的学科
        if(!$('#sub_id :input[type="radio"]:checked').val()){
            layer.msg('请选择问题归属的学科', {icon: 5});
            layer.closeAll('loading');
            return false;
        }
        //判断操作
        var question_id = $(this).attr('question_id');
        var url = 'add.html';
        var tips = '添加成功!';
        if(question_id != 0){
            tips = '修改成功!';
            url = 'edit.html?id='+question_id;
        }
        //添加问题 修改问题
        $.post(url, $('#quesaddform').serialize(), function(data){
            //$('#regbody').empty().html('正在加载请求');
            layer.closeAll('loading'); //关闭加载层
            if (data.status == 'success') {
                var tips = '添加成功!';
                layer.msg(tips, {
                    icon: 6,
                    time: 3000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    window.location.href="index.html";
                });
                layer.closeAll('loading');
            } else {
                var tips = data.data;
                tips = '注册失败!'+JSON.stringify(tips);
                layer.msg(tips,{
                    time:3000,
                    icon: 5,
                });
                layer.closeAll('loading');
            }
        },'json');

    });
});
