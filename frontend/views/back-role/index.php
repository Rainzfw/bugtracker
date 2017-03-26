<div style="margin-bottom: 10px">
    <?php echo \yii\bootstrap\Html::a('添加角色',['add'],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900']);?>
</div>
<table class="table table-bordered table-hover">
    <tr>
        <th>角色名称</th>
        <th>角色描述</th>
        <th>操作</th>
    </tr>
    <?php foreach($roles as $role):?>
        <tr>
            <td><?=$role->name?></td>
            <td><?=$role->description?></td>
            <td>
                <?=\yii\bootstrap\Html::a("编辑",["edit","name"=>$role->name],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900'])?>
                <?=\yii\bootstrap\Html::a("删除",["delete","name"=>$role->name],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
