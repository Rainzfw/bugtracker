<?php
    $form=\yii\bootstrap\ActiveForm::begin();
    //编辑角色的时候 不需要编辑角色名称
    if($model->scenario=='add'){
        echo $form->field($model,'name')->textInput();
    }else{
        echo $form->field($model,'name')->textInput(['disabled'=>true]);
    }

    echo $form->field($model,'description')->textarea();
    //添加权限
    echo $form->field($model,'permissions',['inline'=>true])->checkboxList($model->getAllPermissions());//获取所有的权限
    echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-default','style'=>'background-color:#fff;color:#FF9900;font-size:18px']);
    \yii\bootstrap\ActiveForm::end();
    \frontend\assets\BackAsset::addCss($this,'@web/backend/css/backTeacherIndex.css');
?>