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
                'attribute' => '昵称',
                'content' => function($dataProvider){
                    return $dataProvider['username'];
                },
            ],
            [
                'attribute' => '邮箱',
                'content' => function($dataProvider){
                    return $dataProvider['email'];
                },
            ],
            [
                'attribute' => '创建时间',
                'content' => function($dataProvider){
                    return date('Y-m-d H:s:m',$dataProvider['create_time']);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{isforbid}',
                'headerOptions' => ['width' => '128', 'class' => 'padding-left-5px',],
                'contentOptions' => ['class' => 'padding-left-5px'],
                'buttons' => [
                    'isforbid' => function ($url, $model, $key) {
                        $isforbidText = [
                            \common\helper\ConstHelper::STATUS_ACTIVE=>'禁言',
                            \common\helper\ConstHelper::STATUS_DELETED=>'允许'
                        ];
                        return \yii\bootstrap\Html::a('<span>'.\yii\helpers\ArrayHelper::getValue($isforbidText,$model->is_forbid).'</span>', 'javascript:;', [
                            'is_forbid' => $model->is_forbid,
                            'user_id' => $model->id,
                            'class'=>'is_forbid_btn'
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
    \frontend\assets\BackAsset::addScript($this,'@web/backend/js/userforbid.js');
?>