<?php
    $form=\yii\bootstrap\ActiveForm::begin();
    echo $form->field($model,'name')->textInput();
    echo $form->field($model,'description')->textarea();
    echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-default','style'=>'background-color:#fff;color:#FF9900;font-size:18px']);
    \yii\bootstrap\ActiveForm::end();
    \frontend\assets\BackAsset::addCss($this,'@web/backend/css/backTeacherIndex.css');
?>
