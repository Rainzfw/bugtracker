/**
 * 表单提交需要的执行的代码
 * Created by Administrator on 2017/1/16.
 */

$(function(){
    //文本框失去焦点后
    $('#registerform :input').blur(function(){
        var parentNode = $(this).parent();
        parentNode.find(".formtips").remove();
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
        //验证邮件
        if( $(this).is('#email') ){

            if( this.value=="" || !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value)){
                var errmsg = '请输入正确的E-Mail地址.';
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
    $('#regsend').click(function(){
        //触发失去焦点事件
        $("#registerform :input").trigger('blur');
        var numError = $('#registerform .err').length;
        if(numError){
            return false;
        }
        //判断爱好和性别有没有选则
        if(!$('#registerform :input[type="radio"]:checked').val()){
            layer.msg('请告诉我们你的性别,反串我们也不介意,你高兴就好!');
            return false;
        }
        var subIds =[];
        $('#registerform :input[type="checkbox"]:checked').each(function(){
            subIds.push($(this).value);
        });
        if(subIds.length==0 || subIds.length>2){
            layer.msg('选择1-2门你感兴趣的学科');
            return false;
        }
        //var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        var index = layer.load(0, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
        //提交表单
        $.post('/register/regis.html', $('#registerform').serialize(), function(data){
            //$('#regbody').empty().html('正在加载请求');
            layer.closeAll('loading'); //关闭加载层
            if (data.status == 'success') {
                var tips = '注册成功!';
                layer.msg(tips, {
                    icon: 1,
                    time: 3000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    window.location.href="/home/index.html";
                });
            } else {
                var tips = data.data;
                tips = '注册失败!'+JSON.stringify(tips);
                layer.msg(tips,{
                    time:3000,
                    icon: 2,
                });
            }
        },'json');
    });
});

