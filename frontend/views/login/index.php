<h4 style="text-align: center">欢迎加入源码课堂</h4>
<?php
    $form = \yii\bootstrap\ActiveForm::begin(['action'=>'login.html','method'=>'post']);
    echo $form->field($model,'username')->textInput(['placeholder'=>'请输入用户名'])->label('用户名');
    echo $form->field($model,'password')->passwordInput(['placeholder'=>'请输入用密码'])->label('密码');
    echo $form->field($model, 'captchaCode')->widget(\yii\captcha\Captcha::className(),['captchaAction'=>'login/captcha'])->label('验证码');
    echo \yii\bootstrap\Html::submitButton('登录',['class'=>'btn btn-default','style' =>'background-color:#fff;color:#00cc00;font-size:18px']);
    \yii\bootstrap\ActiveForm::end();
?>