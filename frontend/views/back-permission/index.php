<div style="margin-bottom: 10px">
    <?php echo \yii\bootstrap\Html::a('添加权限',['add'],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900']);?>
</div>
<table class="table table-bordered table-hover">
    <tr>
        <th>权限名称</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
    <?php foreach($permissions as $permission):?>
        <tr>
            <td><?=$permission->name?></td>
            <td><?=$permission->description?></td>
            <td>
                <?=\yii\bootstrap\Html::a("删除",["delete","name"=>$permission->name],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
