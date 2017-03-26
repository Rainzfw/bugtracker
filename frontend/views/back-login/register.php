<h4 style="text-align: center;font-size: 18px;color: #FF9900">欢迎注册</h4>
<?php
    $form = \yii\bootstrap\ActiveForm::begin(['action'=>'register.html','method'=>'post']);
    echo $form->field($model,'username')->textInput(['placeholder'=>'请输入名字'])->label('名字');
    echo $form->field($model,'password')->passwordInput(['placeholder'=>'请输入密码'])->label('密码');
    echo $form->field($model,'captchaCode')->widget(\yii\captcha\Captcha::className(),['captchaAction'=>'back-login/captcha'])->label('验证码');
    echo \yii\bootstrap\Html::submitButton('登录',['class'=>'btn btn-default','style' =>'background-color:#fff;color:#FF9900;font-size:18px']);
    \yii\bootstrap\ActiveForm::end();
    \frontend\assets\BackAsset::addCss($this,'@web/backend/css/BackAnswerAdd.css');
?>