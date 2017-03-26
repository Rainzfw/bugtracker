<?php
use yii\grid\GridView;
echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
]);
//一、表格列
//表格的列是通过 GridView 配置项中的 yii\grid\GridView::columns 属性配置的.

//use yii\grid\GridView;
echo GridView::widget([
    'dataProvider' => $dataProvider,

    //表格列值搜索功能，注意一定要配合attribute才会显示
    //$searchModel = new ArticleSearch();
    'filterModel' => $searchModel,

    //重新定义分页样式
    'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
    'pager'=>[
        //'options'=>['class'=>'hidden']//关闭分页
        'firstPageLabel'=>"First",
        'prevPageLabel'=>'Prev',
        'nextPageLabel'=>'Next',
        'lastPageLabel'=>'Last',
    ],

    'columns' => [
    ['class' => 'yii\grid\SerialColumn'],//序列号从1自增长

    // 数据提供者中所含数据所定义的简单的列
    // 使用的是模型的列的数据
    'id',
    'username',

    // 更复杂的列数据
    [
        'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
        'value' => function ($data) {
            return $data->name;
            // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
            },
    ],

    ['label'=>'标题','value' => 'title'],

    ['label'=>'文章内容','format' => 'html','value' => 'content'],

    [
        'label'=>'文章类别',
        /*'attribute' => 'cid',产生一个a标签,点击可排序*/
        'value' => 'cate.cname' //关联表
    ],

    [
        //动作列yii\grid\ActionColumn
        //用于显示一些动作按钮，如每一行的更新、删除操作。
        'class' => 'yii\grid\ActionColumn',
        'header' => '操作',
        'template' => '{delete} {update}',//只需要展示删除和更新
        'headerOptions' => ['width' => '240'],
        'buttons' => [
            'delete' => function($url, $model, $key){
                return Html::a('<i class="fa fa-ban"></i> 删除',
                    ['del', 'id' => $key],
                    [
                        'class' => 'btn btn-default btn-xs',
                        'data' => ['confirm' => '你确定要删除文章吗？',]
                    ]
                );
            },
        ],
    ],

],
]);
?>
<?php
//1. 处理时间
//数据列的主要配置项是 yii\grid\DataColumn::format 属性。它的值默认是使用 \yii\i18n\Formatter 应用组件。
[
'label'=>'更新日期',
'format' => ['date', 'php:Y-m-d'],
'value' => 'updated_at'
],

//or
[
//'attribute' => 'created_at',
'label'=>'更新时间',
'value'=>function($model){
return  date('Y-m-d H:i:s',$model->created_at);
},
'headerOptions' => ['width' => '170'],
],
2. 处理图片
[
'label'=>'封面图',
'format'=>'raw',
'value'=>function($m){
return Html::img($m->cover,
['class' => 'img-circle',
'width' => 30]
);
}
],
3. 数据列有链接
[
'attribute' => 'title',
'value' => function ($model, $key, $index, $column) {
return Html::a($model->title,
['article/view', 'id' => $key]);
},
'format' => 'raw',
],
4. 数据列显示枚举值(男/女）
[
'attribute' => 'sex',
'value'=>function ($model,$key,$index,$column){
return $model->sex==1?'男':'女';
}，

//在搜索条件（过滤条件）中使用下拉框来搜索
'filter' => ['1'=>'男','0'=>'女'],
//or
'filter' => Html::activeDropDownList($searchModel,
'sex',['1'=>'男','0'=>'女'],
['prompt'=>'全部']
)
],
[
'label'=>'产品状态',
'attribute' => 'pro_name',
'value' => function ($model) {
$state = [
'0' => '未发货',
'1' => '已发货',
'9' => '退货，已处理',
];
return $state[$model->pro_name];
},
'headerOptions' => ['width' => '120']
]
?>