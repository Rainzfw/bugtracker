<?php
    \frontend\assets\BackAsset::addCss($this,'@web/backend/css/BackAnswerAdd.css');
    $form = \yii\bootstrap\ActiveForm::begin(['id'=>'answerform','fieldConfig' => ['inputOptions' => ['class' => 'form-control']]]);
    echo $form->field($question,'content')->textarea(['readonly'=>'readonly'])->label('问题描述');
    echo $form->field($answerModel,'translate_error')->textarea(['placeholder'=>'错误提示翻译'])->label('汉语翻译');
    echo $form->field($answerModel,'answer_des')->widget(\kucha\ueditor\UEditor::className(),[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '100',
            'initialFrameWeight' => '200',
            //设置访问的地址
            'serverUrl'=>['/ueditor/upload.html'],
            //设置语言
            'lang' =>'en', //中文为 zh-cn
            //定制菜单
            'toolbars' => [
                [
                    'fullscreen', 'source', 'undo', 'redo', '|',
                    'fontsize',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                    'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                    'forecolor', 'backcolor', '|',
                    'lineheight', '|',
                    'indent', '|'
                ],
            ]
        ]
    ])->label('解答描述');
    echo $form->field($answerModel,'video_id')->textInput(['placeholder'=>'解答视频的ID'])->label('视频ID');
    echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-default','id'=>'answeradd']);
    \yii\bootstrap\ActiveForm::end();
?>
<div class="row clearfix"></div>
