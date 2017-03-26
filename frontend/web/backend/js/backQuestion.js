$(function(){
    //绑定点击事件
    $('.audit-id').click(function(){
        var ques_id = $(this).attr('ques_id');
        var status = $(this).attr('status');
        layer.load(0,{shade:false});
        $.post('audit-question.html',{'id':ques_id,'status':status}, function(data){
            if (data.status == 'success') {
                var tips = '操作成功!';
                layer.msg(tips, {
                    icon: 1,
                    time: 3000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    window.location.href="index.html";
                });
            } else {
                layer.msg(data.msg,{
                    time:3000,
                    icon: 2,
                });
            }
            layer.closeAll('loading');
        },'json');

    });
    //绑定点击事件 修改是否显示
    $('.is_show_btn').click(function(){
        var ques_id = $(this).attr('ques_id');
        var is_show =  $(this).attr('is_show');
        layer.load(0,{shade:false});
        $.post('editshow.html',{'id':ques_id,'is_show':is_show}, function(data){
            if (data.status == 'success') {
                var tips = '操作成功!';
                layer.msg(tips, {
                    icon: 1,
                    time: 3000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    window.location.reload();
                });
            } else {
                layer.msg(data.msg,{
                    time:3000,
                    icon: 2,
                });
            }
            layer.closeAll('loading');
        },'json');
    });
    //修改答案是否显示
    $('.is_show_answer').click(function(){
        var answer_id = $(this).attr('answer_id');
        var is_show =  $(this).attr('is_show');
        layer.load(0,{shade:false});
        $.post('back-answer/editshow.html',{'id':answer_id,'is_show':is_show}, function(data){
            if (data.status == 'success') {
                var tips = '操作成功!';
                layer.msg(tips, {
                    icon: 1,
                    time: 3000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    window.location.reload();
                });
            } else {
                layer.msg(data.msg,{
                    time:3000,
                    icon: 2,
                });
            }
            layer.closeAll('loading');
        },'json');

    });
});













