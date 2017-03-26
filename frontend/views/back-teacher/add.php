
<?php
    $form = \yii\bootstrap\ActiveForm::begin();
    echo $form->field($model,'alias_name',['inline'=>true])->textInput(['placeholder'=>'请输入你的昵称,默认是名字.'])->label('昵称');
    echo $form->field($model,'real_name')->textInput(['placeholder'=>'请输入你的名字.'])->label('名字');
    echo $form->field($model,'tel')->textInput(['placeholder'=>'请输入联系电话.'])->label('联系电话');
    echo $form->field($model,'sub_id',['inline'=>true])->radioList([
        \common\helper\ConstHelper::UI=>'UI',
        \common\helper\ConstHelper::WEB=>'WEB',
        \common\helper\ConstHelper::PHP=>'PHP',
        \common\helper\ConstHelper::JAVA=>'JAVA',
        ],['style'=>'background-color:#fff;border-radius:6px'])->label('学科');
    echo $form->field($model,'sex',['inline'=>true])->radioList([\common\helper\ConstHelper::FEMALE=>'女',\common\helper\ConstHelper::MALE=>'男'],['style'=>'background-color:#fff;border-radius:6px'])->label('性别');
    echo \yii\bootstrap\Html::submitButton($model->isNewRecord? '添加':'编辑',['class'=>'btn btn-default','style'=>'font-size:18px']);
    \yii\bootstrap\ActiveForm::end();
    \frontend\assets\BackAsset::addCss($this,'@web/backend/css/backTeacherIndex.css');
?>