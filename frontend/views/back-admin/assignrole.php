<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'roles',['inline'=>true])->checkboxList( \common\helper\Helper::getService('AuthManager')->getRolesItem());
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-default','style'=>'background-color:#fff;color:#FF9900;font-size:18px']);
\yii\bootstrap\ActiveForm::end();