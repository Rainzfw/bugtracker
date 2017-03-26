<div class="row clearfix">
    <?=\yii\bootstrap\Html::beginForm('','get',['class'=>'form-inline','role'=>'form','style'=>"font-family: '仿宋'"]); ?>
    <div class="form-group">
        <label for="real_name" >名字</label>
        <?= \yii\bootstrap\Html::activeTextInput($searchModel, 'real_name', ['class'=>'form-control', 'id'=>'real_name', 'placeholder'=>'搜索名字'])?>
    </div>
    <div class="form-group">
        <label>状态</label>
        <?=\yii\bootstrap\Html::activeDropDownList($searchModel,'is_delete',$isDeleteItems,['class'=>'form-control'])?>
    </div>
    <div class="form-group">
        <label>学科</label>
        <?=\yii\bootstrap\Html::activeDropDownList($searchModel,'sub_id',$subjectItems,['class'=>'form-control'])?>
    </div>
    <?php
        echo \yii\bootstrap\Html::submitButton('search',['class'=>'btn btn-default']);
        \yii\bootstrap\Html::endForm();
    ?>
</div>
<div class="row clearfix">
    <?=yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel'=>$searchModel,
        //分页条样式
        //'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
        'pager'=>[
            //'options'=>['class'=>'hidden']//关闭自带分页
            //'firstPageLabel'=>"First",
            'prevPageLabel'=>'Prev',
            'nextPageLabel'=>'Next',
            //'lastPageLabel'=>'Last',
        ],
        'columns' => [
            [
                'attribute' => 'ID',
                'content' => function($dataProvider){
                    return $dataProvider['id'];
                },
            ],
            [
                'attribute' => '名字',
                'content' => function($dataProvider){
                    return $dataProvider['real_name'];
                },
            ],
            [
                'attribute' => '昵称',
                'content' => function($dataProvider){
                    return $dataProvider['alias_name'];
                },
            ],
            [
                'attribute' => '所属学科',
                'content' => function($dataProvider){
                    $subject=[
                        \common\helper\ConstHelper::UI=>'UI',
                        \common\helper\ConstHelper::WEB=>'WEB',
                        \common\helper\ConstHelper::PHP=>'PHP',
                        \common\helper\ConstHelper::JAVA=>'JAVA',
                    ];
                    return $subject[$dataProvider['sub_id']];
                },
            ],
            [
                'attribute' => '状态',
                'content' => function($dataProvider){
                    $isDeleteItems = [
                        \common\helper\ConstHelper::STATUS_ACTIVE=>'在职',
                        \common\helper\ConstHelper::STATUS_DELETED =>'离职'
                    ];
                    $isDeleteText = \yii\helpers\ArrayHelper::getValue($isDeleteItems,$dataProvider['is_delete'],'');
                    return "<a class='btn btn-default is_delete_btn' href='javascript:void(0)' role='button'  teacher_id='{$dataProvider["id"]}' is_delete='{$dataProvider["is_delete"]}'>$isDeleteText</a>";
                },
            ],
            [
                'attribute' => '电话',
                'content' => function($dataProvider){
                    return $dataProvider['tel'];
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{detail}{edit}',
                'headerOptions' => ['width' => '128', 'class' => 'padding-left-5px',],
                'contentOptions' => ['class' => 'padding-left-5px'],
                'buttons' => [
                    'detail' => function ($url, $model, $key) {
                        return \yii\bootstrap\Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => '查看',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                    'edit' => function ($url, $model, $key) {
                        return \yii\bootstrap\Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                            'title' => '修改',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
<?php
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/layer.js');
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/layui.js');
    \frontend\assets\BackAsset::addCss($this,'@web/backend/css/backTeacherIndex.css');
    \frontend\assets\BackAsset::addScript($this,'@web/backend/js/teacher.js');
?>
