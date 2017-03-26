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
                'attribute' => '管理员',
                'content' => function($dataProvider){
                    return $dataProvider['username'];
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
                'template' => '{delete}{assignrole}',
                'headerOptions' => ['width' => '128', 'class' => 'padding-left-5px',],
                'contentOptions' => ['class' => 'padding-left-5px'],
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return \yii\bootstrap\Html::a('<span style="color: #FF9900" class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => '删除',
                            'data-pjax' => '0',
                        ]);
                    },
                    'assignrole' => function ($url, $model, $key) {
                        return \yii\bootstrap\Html::a('<span style="color: #FF9900" class="glyphicon glyphicon-user"></span>', $url, [
                            'title' => '分配角色',
                            'data-pjax' => '0',
                        ]);
                    },

                ],
            ],
        ],
    ]);
    ?>
</div>
