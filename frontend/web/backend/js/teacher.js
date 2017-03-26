$(function(){
    //修改在职状态
    $('.is_delete_btn').on('click',function(){
        layer.load(0,{shade:false});
        var is_delete_text = {1:'离职',2:'在职'};
        var is_delete_btn_node = $(this);
        var id = $(this).attr('teacher_id');
        var is_delete = $(this).attr('is_delete');
        $.post("edit-status.html", { "id": id, 'is_delete':is_delete}, function(data){
            layer.closeAll('loading');
            //弹出提示信息
            layer.msg(data.msg, {
                icon: 1,
            });
            if(data.status=='success'){
                is_delete_btn_node.empty();
                is_delete_btn_node.text(is_delete_text[is_delete]);
            }
        }, "json");
    });
});
