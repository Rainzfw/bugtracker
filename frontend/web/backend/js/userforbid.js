$(function(){
    //是否允许用户发言
    $('.is_forbid_btn').on('click',function(){
        layer.load(0,{shade:false});
        var is_forbid_text = {2:'禁言',1:'允许'};
        var is_forbid_btn_node = $(this);
        var user_id = $(this).attr('user_id');
        var is_forbid = $(this).attr('is_forbid');
        $.post("isforbid.html", { "user_id": user_id, 'is_forbid':is_forbid}, function(data){
            layer.closeAll('loading');
            //弹出提示信息
            layer.msg(data.msg, {
                icon: 1,
            });
            if(data.status=='success'){
                is_forbid_btn_node.empty();
                var htmlstr = '<span>'+is_forbid_text[is_forbid]+'</span>'
                is_forbid_btn_node.html(htmlstr);
            }
        }, "json");
    });
});
