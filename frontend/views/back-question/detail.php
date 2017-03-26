<div class="row clearfix">
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #6164C1">操作</h3>
            </div>
            <div class="panel-body">
                <a class="btn btn-default" href="edit.html?id=<?=$question['id'];?>" role="button" style="color:#FF9900">编辑问题</a>
                <a class="btn btn-default is_show_btn" href="javascript:void(0)" role="button" style="color:#FF9900" ques_id="<?=$question['id'];?>" is_show="<?=$question['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($questionShowText,$question['is_show'],'未知');?></a>
                <?php if(empty($answer)):?>
                    <a class="btn btn-default" href="/back-answer/add.html?id=<?=$question['id'];?>&from=detail" role="button" style="color:#FF9900">添加回答</a>
                <?php else: ?>
                    <a class="btn btn-default" href="/back-answer/edit.html?id=<?=$answer['id']?>" role="button" style="color:#FF9900">编辑回答</a>
                    <a class="btn btn-default is_show_answer" href="javascript:void(0)" role="button" style="color:#FF9900" answer_id="<?=$answer['id'];?>" is_show="<?=$answer['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($answerShowText,$answer['is_show'],'未知');?></a>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #6164C1">错误描述</h3>
            </div>
            <div class="panel-body">
                <?=$question['ques_title']?>
            </div>
        </div>
    </div>
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #6164C1">错误提示</h3>
            </div>
            <div class="panel-body">
                <?=$question['content']?>
            </div>
        </div>
    </div>
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #6164C1">汉语解释</h3>
            </div>
            <?php if(!empty($answer)):?>
                <div class="panel-body">
                    <?=$answer['translate_error'];?>
                </div>
            <?php else:?>
                <div class="panel-body">
                    此问题还未解答!!!;
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #6164C1">视频+概述</h3>
            </div>
            <?php if(!empty($answer)):?>
                <div class="panel-body">
                    <?= \frontend\widgets\PlayerVideoWidget::widget([
                        'styleid'=>\common\helper\ConstHelper::STYLEID,
                        'client_id'=>\common\helper\ConstHelper::CLIENT_ID,
                        'vid'=>$answer['video_id']
                    ]);?>
                </div>
                <div class="panel-body">
                    <?=$answer['answer_des']?>
                </div>
            <?php else:?>
                <div class="panel-body">
                    此问题还未解答!!!;
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
<?php
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/layer.js');
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/layui.js');
    \frontend\assets\BackAsset::addScript($this,'@web/backend/js/BackQuestion.js');
?>