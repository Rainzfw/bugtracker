<h4 style="text-align: center">欢迎加入源码课堂</h4>
<?php
    $form = \yii\bootstrap\ActiveForm::begin(['action'=>'register.html','method'=>'POST']);
    echo $form->field($model,'username')->textInput(['placeholder'=>'用户名由字母数字下划线组成,且以字母开头,不能超过15个字符.'])->label('用户名');
    echo $form->field($model,'password')->passwordInput(['placeholder'=>'密码为6-18为的字符'])->label('密码');
    echo $form->field($model,'sex',['inline'=>true])->radioList([\common\helper\ConstHelper::MALE=>'男',\common\helper\ConstHelper::FEMALE=>'女'])->label('性别');
    echo $form->field($model,'email')->textInput(['placeholder'=>'请输入邮箱'])->label('邮箱');
    echo $form->field($model,'sub_id',['inline'=>true])->checkboxList([\common\helper\ConstHelper::UI=>'UI',\common\helper\ConstHelper::WEB=>'WEB',\common\helper\ConstHelper::PHP=>'PHP',\common\helper\ConstHelper::JAVA=>'JAVA'])->label('感兴趣的学科');
    echo  $form->field($model,'captchaCode')->widget(\yii\captcha\Captcha::className(),['captchaAction'=>'login/captcha'])->label('验证码');
    echo \yii\bootstrap\Html::submitButton('注册',['class'=>'btn btn-default','style'=>'background-color:#fff;color:#00cc00;font-size:18px']);
    \yii\bootstrap\ActiveForm::end();
?>
