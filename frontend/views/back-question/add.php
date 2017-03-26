<?php
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/jquery-form.js');
    \frontend\assets\BackAsset::addCss($this,'@web/backend/css/BackAnswerAdd.css');
    \frontend\assets\BackAsset::addScript($this,'@web/backend/js/question.add.js');
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/layer.js');
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/layui.js');
    $form = \yii\bootstrap\ActiveForm::begin(['id'=>'answerform','fieldConfig' => ['inputOptions' => ['class' => 'form-control']]]);
    echo $form->field($model,'ques_title')->textarea()->label('问题概要');
    echo $form->field($model,'sub_id',['inline'=>true])->radioList($subject,['style'=>'background-color:#fff;border-radius:6px'])->label('所属学科');
    echo $form->field($model,'content')->widget(\kucha\ueditor\UEditor::className(),[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '100',
            'initialFrameWeight' => '200',
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
    ])->label('错误提示');
    echo \yii\bootstrap\Html::label('错误截图','imgbtn',['style'=>'display:block;']);
    echo \yii\bootstrap\Html::button('选择文件',['class'=>'btn btn-default','style'=>'background-color:#fff','id'=>'imgbtn']);
    echo $form->field($model,'is_show',['inline'=>true])->radioList([\common\helper\ConstHelper::ISSHOW_NO=>'关闭',\common\helper\ConstHelper::ISSHOW_YES=>'显示'],['style'=>'background-color:#fff;border-radius:6px'])->label('是否显示');
    echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-default','style'=>'background-color:#fff;color:#FF9900;font-size:18px']);
    \yii\bootstrap\ActiveForm::end();
    $formImg= \yii\bootstrap\ActiveForm::begin(['id'=>'imgForm','method'=>'post']);
    echo $formImg->field($imgModel,'imgFile')->fileInput(['style'=>'display: none','id'=>'imgFile'])->label(false);
    echo $formImg->field($imgModel,'isImgFile')->hiddenInput()->label(false);
    \yii\bootstrap\ActiveForm::end();
?>
<div class="row clearfix"></div>
