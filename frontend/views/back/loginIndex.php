<h3 align="center">欢迎登录</h3>
<?php
    use \yii\bootstrap\Html;
    $form = \yii\bootstrap\ActiveForm::begin(['action'=>'login.html', 'method'=>'post']);
    echo $form->field($model,'username')->textInput(['placeholder'=>'输入用户名'])->label('用户名');
    echo $form->field($model,'password')->passwordInput(['placeholder'=>'输入密码'])->label('密码');
    echo $form->field($model,'captchaCode')->widget(\yii\captcha\Captcha::className(),['captchaAction'=>'login/captcha'])->label('验证码');
    echo $form->field($model,'remeber_me',['inline'=>true])->checkbox()->label('记住密码一周');
    echo Html::submitButton('登录',['class'=>'btn btn-default','style'=>'font-size:18px;color:#E94E02']);
    \yii\bootstrap\ActiveForm::end();
?>