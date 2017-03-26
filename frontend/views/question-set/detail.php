<div class="row clearfix">
    <?php if($question['status'] != \common\helper\ConstHelper::SOLVE_YES && $flag):?>
        <div class="col-md-12 column panel panel-default" style="border: none">
            <a class="btn btn-default" href="/question-set/edit.html?id=<?=$question['id'];?>" role="button" style="color:#FF9900">编辑</a>
        </div>
    <?php endif;?>
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #00CC00">错误描述</h3>
            </div>
            <div class="panel-body">
                <?=$question['ques_title']?>
            </div>
        </div>
    </div>
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #00CC00">错误提示</h3>
            </div>
            <div class="panel-body">
                <?=$question['content']?>
            </div>
        </div>
    </div>
    <?php if(!empty($answer['translate_error'])):?>
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #00CC00">汉语解释</h3>
            </div>
            <div class="panel-body">
                <?=$answer['translate_error'];?>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="color: #00CC00">视频+概述</h3>
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