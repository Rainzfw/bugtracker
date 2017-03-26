<div style="margin-bottom: 10px">
    <?php echo \yii\bootstrap\Html::a('添加菜单',['add'],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900']);?>
</div>

<table class="table table-bordered table-hover">
    <tr>
        <th>菜单名称</th>
        <th>路由</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    <?php foreach($model as $item):?>
        <tr>
            <td><?=$item->name?></td>
            <td><?=$item->route?></td>
            <td><?=$item->description?></td>
            <td>
                <?=\yii\bootstrap\Html::a("编辑",["edit","id"=>$item->id],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900'])?>
                <?=\yii\bootstrap\Html::a("删除",["delete","id"=>$item->id],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900'])?>
            </td>
        </tr>
        <!--循环子菜单-->
        <?php foreach($item->submenus as $sunmenu): ?>
            <tr>
                <td><?php echo '&emsp;---'.$sunmenu->name?></td>
                <td><?=$sunmenu->route?></td>
                <td><?=$sunmenu->description?></td>

                <td>
                    <?=\yii\bootstrap\Html::a("编辑",["edit","id"=>$sunmenu->id],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900'])?>
                    <?=\yii\bootstrap\Html::a("删除",["delete","id"=>$sunmenu->id],['class'=>'btn btn-default','role'=>'btn','style'=>'color:#FF9900'])?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endforeach;?>
</table>