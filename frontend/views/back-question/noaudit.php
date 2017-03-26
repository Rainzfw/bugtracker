<div class="row clearfix">
    <div class="col-md-12 column">
        <div class="tabbable" id="tabs-926393">
            <div class="col-md-12 column">
                <ul class="nav nav-tabs">
                    <li>
                        <a href="#panel-34044" data-toggle="tab">UI<?php  echo isset($totalCount)? "<sup style='color: red;'>-{$totalCount['ui']}</sup>":""?></a>
                    </li>
                    <li>
                        <a href="##panel-34045" data-toggle="tab">WEB<?php  echo isset($totalCount)? "<sup style='color: red;'>-{$totalCount['web']}</sup>":""?></a>
                    </li>
                    <li class="active">
                        <a href="##panel-34046" data-toggle="tab">PHP<?php  echo isset($totalCount)? "<sup style='color: red;'>-{$totalCount['php']}</sup>":""?></a>
                    </li>
                    <li>
                        <a href="##panel-38596" data-toggle="tab">JAVA<?php  echo isset($totalCount)? "<sup style='color: red;'>-{$totalCount['java']}</sup>":""?></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12 column">
                <div class="tab-content">
                    <div class="tab-pane" id="panel-34044">
                        <?php if(\yii\helpers\ArrayHelper::getValue($question,'ui')):?>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>问题</th>
                                    <th>问题状态</th>
                                    <th>是否显示</th>
                                    <th>提问时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($question['ui'] as $que):?>
                                    <tr>
                                        <td><?= mb_substr($que['ques_title'],0,10,'UTF-8')?></td>
                                        <td><?=\yii\helpers\ArrayHelper::getValue($statusText,$que['status'],'未知');?></td>
                                        <td>
                                            <a class="btn btn-default is_show_btn" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" is_show="<?=$que['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($showText,$que['is_show'],'未知');?></a>
                                        </td>
                                        <td><?=Yii::$app->formatter->asDatetime($que['add_time'])?></td>
                                        <td>
                                            <a class="btn btn-default" href="detail.html?id=<?=$que['id']?>" role="button">详情</a>
                                            <a class="btn btn-default audit-id" href="javascript:void(0)" role="button" ques_id="<?=$que['id'];?>" status="<?=\common\helper\ConstHelper::SOLVE_NO?>">通过</a>
                                            <a class="btn btn-default audit-id" href="javascript:void(0)"   ques_id="<?=$que['id'];?>" status="<?=\common\helper\ConstHelper::AUDIT_FAIL?>" role="button">不通过</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'ui');
                        else: echo \common\helper\ConstHelper::NOADUIT_DATA;endif;
                        ?>
                    </div>
                    <div class="tab-pane" id="panel-34045">
                        <?php if(\yii\helpers\ArrayHelper::getValue($question,'web')):?>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>问题</th>
                                    <th>问题状态</th>
                                    <th>是否显示</th>
                                    <th>提问时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($question['web'] as $que):?>
                                    <tr>
                                        <td><?= mb_substr($que['ques_title'],0,10,'UTF-8')?></td>
                                        <td><?=\yii\helpers\ArrayHelper::getValue($statusText,$que['status'],'未知');?></td>
                                        <td>
                                            <a class="btn btn-default is_show_btn" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" is_show="<?=$que['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($showText,$que['is_show'],'未知');?></a>
                                        </td>
                                        <td><?=Yii::$app->formatter->asDatetime($que['add_time'])?></td>
                                        <td>
                                            <a class="btn btn-default audit-btn" href="detail.html?id=<?=$que['id']?>" role="button">详情</a>
                                            <a class="btn btn-default audit-id" href="javascript:void(0)" role="button" ques_id="<?=$que['id'];?>" status="<?=\common\helper\ConstHelper::SOLVE_NO?>">通过</a>
                                            <a class="btn btn-default audit-id" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" status="<?=\common\helper\ConstHelper::AUDIT_FAIL?>">不通过</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'web');
                        else: echo \common\helper\ConstHelper::NOADUIT_DATA;endif;
                        ?>
                    </div>
                    <div class="tab-pane active" id="panel-34046">
                        <?php if(\yii\helpers\ArrayHelper::getValue($question,'php')):?>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>问题</th>
                                    <th>问题状态</th>
                                    <th>是否显示</th>
                                    <th>提问时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($question['php'] as $que):?>
                                    <tr>
                                        <td><?= mb_substr($que['ques_title'],0,10,'UTF-8')?></td>
                                        <td><?=\yii\helpers\ArrayHelper::getValue($statusText,$que['status'],'未知');?></td>
                                        <td>
                                            <a class="btn btn-default is_show_btn" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" is_show="<?=$que['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($showText,$que['is_show'],'未知');?></a>
                                        </td>
                                        <td><?=Yii::$app->formatter->asDatetime($que['add_time'])?></td>
                                        <td>
                                            <a class="btn btn-default audit-btn" href="detail.html?id=<?=$que['id']?>" role="button">详情</a>
                                            <a class="btn btn-default audit-id" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" status="<?=\common\helper\ConstHelper::SOLVE_NO?>">通过</a>
                                            <a class="btn btn-default audit-id" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" status="<?=\common\helper\ConstHelper::AUDIT_FAIL?>">不通过</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'php');
                        else: echo \common\helper\ConstHelper::NOADUIT_DATA;endif;?>
                    </div>
                    <div class="tab-pane" id="panel-38596">
                        <?php if(\yii\helpers\ArrayHelper::getValue($question,'java')):?>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>问题</th>
                                    <th>问题状态</th>
                                    <th>是否显示</th>
                                    <th>提问时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($question['java'] as $que):?>
                                    <tr>
                                        <td><?= mb_substr($que['ques_title'],0,10,'UTF-8')?></td>
                                        <td><?=\yii\helpers\ArrayHelper::getValue($statusText,$que['status'],'未知');?></td>
                                        <td>
                                            <a class="btn btn-default is_show_btn" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" is_show="<?=$que['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($showText,$que['is_show'],'未知');?></a>
                                        </td>
                                        <td><?=Yii::$app->formatter->asDatetime($que['add_time'])?></td>
                                        <td>
                                            <a class="btn btn-default" href="detail.html?id=<?=$que['id']?>" role="button">详情</a>
                                            <a class="btn btn-default audit-id" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" status="<?=\common\helper\ConstHelper::SOLVE_NO?>">通过</a>
                                            <a class="btn btn-default audit-id" href="javascript:void(0)" role="button"  ques_id="<?=$que['id'];?>" status="<?=\common\helper\ConstHelper::AUDIT_FAIL?>">不通过</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'java');
                        else: echo \common\helper\ConstHelper::NOADUIT_DATA;endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
\frontend\assets\BackAsset::addScript($this,'@web/backend/js/backQuestion.js');
\frontend\assets\BackAsset::addScript($this,'@web/js/ext/layer.js');
\frontend\assets\BackAsset::addScript($this,'@web/js/ext/layui.js');
?>