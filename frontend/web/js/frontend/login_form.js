/**
 * Created by Administrator on 2017/1/18.
 */
/**
 * 登录表单提交需要的执行的代码
 * Created by Administrator on 2017/1/16.
 */

$(function(){
    //文本框失去焦点后
    $('#loginform :input').blur(function(){
        if($(this).is('#username') ||  $(this).is('#password') ){
            var parentNode = $(this).parent();
            parentNode.find(".formtips").remove();
        }
        //验证用户名
        if( $(this).is('#username') ){

            if( this.value == "" || this.value.length > 15 || !/^([\u4e00-\u9fa5]|[A-Za-z])+\w*$/.test(this.value)){
                var errmsg = '用户名由字母数字下划线组成,且以字母开头,不能超过15个字符.';
                parentNode.append('<div class="help-block formtips err" style="color: #ff0000;text-align: left">'+errmsg+'</div>');
            }else{
                var msg = '输入正确.';
                parentNode.append('<div class="help-block formtips errno" style="color: #ff0000;text-align: left">'+msg+'</div>');
            }
        }
        //密码
        if( $(this).is('#password') ){

            if( this.value== "" || this.value.length < 5 || this.value.length >18 ){
                var errmsg = '密码需为6-18为的字符';
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
    //提交，最终验证。
    $('#loginsend').click(function(){
        //触发失去焦点事件
        $("#loginform :input").trigger('blur');
        var numError = $('#loginform .err').length;
        if(numError){
            return false;
        }
        var index = layer.load(0, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
        //提交表单
        $.post('/login/login.html', $('#loginform').serialize(), function(data){
            //$('#regbody').empty().html('正在加载请求');
            layer.closeAll('loading'); //关闭加载层
            if (data.status == 'success') {
                var tips = '登录成功!';
                layer.msg(tips, {
                    icon: 1,
                    time: 3000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    window.location.href="/home/index.html";
                });
            } else {
                var tips = data.data;
                tips = '登录失败!'+JSON.stringify(tips);
                layer.msg(tips,{
                        time:3000,
                        icon:2
                    }
                );
            }
        },'json');
    });
});
