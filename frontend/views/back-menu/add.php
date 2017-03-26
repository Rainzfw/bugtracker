<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,"name")->textInput()->label('菜单名');
echo $form->field($model,'pid')->hiddenInput(['id'=>'pid'])->label(false);//隐藏域 保存父分类id
$menus=\frontend\models\Menu::getAll();//获取所有的菜单
echo \frontend\widgets\ZtreeWidget::widget([
    'setting'=>'{
            data: {
                    simpleData: {
                            enable: true,
                            pIdKey:\'pid\',
                    }
            },
            callback: {
                onClick: function(event,treeId,treeNode){
                    $(\'#pid\').val(treeNode.id);
                }
            }
        }',
    'zNodes'=>$menus,
    'selectNodes'=>['id'=>$model->pid]
]);
echo $form->field($model,"route")->textInput()->label('路由');
echo $form->field($model,"icon")->textInput()->label('图标');
echo $form->field($model,"description")->textarea()->label('描述');
echo \yii\bootstrap\Html::submitInput($model->isNewRecord?"添加":"编辑",["class"=>"btn btn-default"]);
echo "&emsp;".\yii\bootstrap\Html::a("取消",['article/list'],["class"=>"btn btn-danger"]);
\yii\bootstrap\ActiveForm::end();
\frontend\assets\BackAsset::addCss($this,'@web/backend/css/BackAnswerAdd.css');