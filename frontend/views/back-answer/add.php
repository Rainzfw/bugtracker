<div class="row clearfix">
    <div class="col-md-12 column">
        <?=\yii\bootstrap\Html::beginForm('/back-answer/add.html','POST',['role'=>'form','class'=>'form-horizontal'])?>
        <div class="form-group">
            <div class="col-sm-4">
                <?=\yii\bootstrap\Html::activeTextInput($model,'id',['class'=>'form-control','id'=>'id','placeholder'=>'请输入问题ID','style'=>'border-radius:8px'])?>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-default">查询问题</button>
            </div>
        </div>
        <?=\yii\bootstrap\Html::endForm()?>
    </div>
</div>
