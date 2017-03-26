<?php
\frontend\assets\FrontendAsset::addScript($this,'@web/js/ext/layer.js');
\frontend\assets\FrontendAsset::addScript($this,'@web/js/ext/layui.js');
\frontend\assets\FrontendAsset::addScript($this,'@web/js/frontend/question_add.js');
\frontend\assets\FrontendAsset::addScript($this,'@web/js/ext/jquery-form.js');
?>
<div class="row clearfix">
    <div class="col-md-12 column">
        <?=\yii\bootstrap\Html::beginForm('','post',['id'=>'quesaddform','role'=>'form','class'=>'form-horizontal','onsubmit'=>"return check()"])?>
            <div class="form-group">
                <label for="ques_title" class="col-sm-2 control-label">问题描述</label>
                <div class="col-sm-8">
                    <?=\yii\bootstrap\Html::activeTextarea($model,'ques_title',['class'=>'form-control','id'=>'ques_title','placeholder'=>'问题描述,字数限制0-100字符'])?>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">错误提示</label>
                <div class="col-sm-8">
                    <?=\yii\bootstrap\Html::activeTextarea($model,'content',['class'=>'form-control','id'=>'content','placeholder'=>'错误提示'])?>
                </div>
            </div>
            <div class="form-group" id="after">
                <label for="upload_file" class="col-sm-2 control-label">错误截图</label>
                <div class="col-sm-3">
                    <button class="btn btn-default" type="button" id="upload_file">选择文件</button>
                </div>
                <span class="col-sm-7" style="text-align: left;color: red">提示：非必传 图片格式[jpg,gif,png] 大小在1M以内</span>
            </div>
            <div class="form-group" id="before">
                <label for="sub_id" class="col-sm-2 control-label">归属学科</label>
                <div class="col-sm-10 radio" style="text-align: left">
                    <?= \yii\helpers\Html::activeRadioList($model, 'sub_id',[
                        \common\helper\ConstHelper::UI=>'UI',
                        \common\helper\ConstHelper::WEB=>'WEB',
                        \common\helper\ConstHelper::PHP=>'PHP',
                        \common\helper\ConstHelper::JAVA=>'JAVA',
                    ],['id'=>'sub_id'])?>
                </div>
            </div>
            <div class="form-group" id="teacher_div"></div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-success" id="addsend" question_id="<?php echo $model->isNewRecord?  0 : $model->id?>">提交</button>
                </div>
            </div>
        <?=\yii\bootstrap\Html::endForm()?>
            <!--创建图片上传的form表单-->
        <?=\yii\bootstrap\Html::beginForm('/question-set/upload-img.html','post',['enctype'=>'multipart/form-data','id'=>'up'])?>
                <input type="file" id="in_file" name="imgFile" style="display: none">
        <?=\yii\bootstrap\Html::endForm()?>
    </div>
</div>