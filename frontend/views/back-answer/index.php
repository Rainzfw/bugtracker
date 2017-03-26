<?php
    \frontend\assets\BackAsset::addCss($this,'@web/backend/css/BackAnswerIndex.css');
?>
<div class="row clearfix" style="height: 65px;" xmlns="http://www.w3.org/1999/html">
    <div class="col-md-12 column">
        <div class="col-md-12 column">
            <form role="form" class="form-inline" style="font-family: '仿宋'">
                <div class="form-group">
                    <label>解答人</label>
                    <select name="teacher_id" class="form-control" style='border-radius:8px'>
                        <option value="0">全部</option>
                        <?php
                            foreach($teachers as $teacherId=>$teacherName){
                                $optionStr = '<option value="'.$teacherId.'" ';
                                if($params["teacher_id"]== $teacherId){
                                    $optionStr .=  ' selected ';
                                }
                                $optionStr.='>'.$teacherName.'</option>';
                                echo $optionStr;
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_show">否已关闭</label>
                    <select id="is_show" name="is_show" class="form-control" style='border-radius:8px'>
                        <option value="0">全部</option>
                        <option value="<?= \common\helper\ConstHelper::ISSHOW_NO;?>" <?php if($params['is_show']==\common\helper\ConstHelper::ISSHOW_NO){ echo "selected";}?> >关闭</option>
                        <option value="<?= \common\helper\ConstHelper::ISSHOW_YES;?>" <?php if($params['is_show']==\common\helper\ConstHelper::ISSHOW_YES){ echo "selected";}?>>显示</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keyword">关键字</label>
                    <textarea style='border-radius:8px' name='keyword' class="form-control" id="keyword"  placeholder='错误内容的关键字!' value="<?php echo $params['keyword'];?>"/></textarea>
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12 column">
        <div class="tabbable" id="tabs-843934">
            <div class="col-md-12 column">
                <ul class="nav nav-tabs">
                    <li>
                        <a href="#panel-383095" data-toggle="tab">UI<?php  echo isset($totalCount)? "<sup style='color: red;'>-{$totalCount['ui']}</sup>":""?></a>
                    </li>
                    <li>
                        <a href="#panel-293650" data-toggle="tab">WEB<?php  echo isset($totalCount)? "<sup style='color: red;'>-{$totalCount['web']}</sup>":""?></a>
                    </li>
                    <li class="active">
                        <a href="#panel-293651" data-toggle="tab">PHP<?php  echo isset($totalCount)? "<sup style='color: red;'>-{$totalCount['php']}</sup>":""?></a>
                    </li>
                    <li>
                        <a href="#panel-293654" data-toggle="tab">JAVA<?php  echo isset($totalCount)? "<sup style='color: red;'>-{$totalCount['java']}</sup>":""?></a>
                    </li>
                </ul>
            </div>

            <div class="col-md-12 column">
                <div class="tab-content">
                    <div class="tab-pane" id="panel-383095">
                        <?php if(\yii\helpers\ArrayHelper::getValue($answers,'ui')):?>
                            <div class="list-group">
                                <?php foreach($answers['ui'] as $answer):?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title" style="color: #6164C1">解答描述</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?=$answer['answer_des']?>
                                        </div>
                                        <div class="panel-body">
                                            <a class="btn btn-default" href="/back-answer/detail.html?id=<?=$answer['id']?>" role="button" style="color:#FF9900">详情</a>
                                            <a class="btn btn-default" href="/back-answer/edit.html?id=<?=$answer['id']?>" role="button" style="color:#FF9900">编辑回答</a>
                                            <a class="btn btn-default is_show_answer" href="javascript:void(0)" role="button" style="color:#FF9900" answer_id="<?=$answer['id'];?>" is_show="<?=$answer['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($answerShowText,$answer['is_show'],'未知');?></a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'ui');
                        else: echo \common\helper\ConstHelper::ANSWER_DATA;endif;
                        ?>
                    </div>
                    <div class="tab-pane" id="panel-293650">
                        <?php if(\yii\helpers\ArrayHelper::getValue($answers,'web')):?>
                            <div class="list-group">
                                <?php foreach($answers['web'] as $answer):?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title" style="color: #6164C1">解答描述</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?=$answer['answer_des']?>
                                        </div>
                                        <div class="panel-body">
                                            <a class="btn btn-default" href="/back-answer/detail.html?id=<?=$answer['id']?>" role="button" style="color:#FF9900">详情</a>
                                            <a class="btn btn-default" href="/back-answer/edit.html?id=<?=$answer['id']?>" role="button" style="color:#FF9900">编辑回答</a>
                                            <a class="btn btn-default is_show_answer" href="javascript:void(0)" role="button" style="color:#FF9900" answer_id="<?=$answer['id'];?>" is_show="<?=$answer['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($answerShowText,$answer['is_show'],'未知');?></a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'web');
                        else: echo \common\helper\ConstHelper::ANSWER_DATA;endif;
                        ?>
                    </div>
                    <div class="tab-pane active" id="panel-293651">
                        <?php if(\yii\helpers\ArrayHelper::getValue($answers,'php')):?>
                            <div class="list-group">
                                <?php foreach($answers['php'] as $answer):?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title" style="color: #6164C1">解答描述</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?=$answer['answer_des']?>
                                        </div>
                                        <div class="panel-body">
                                            <a class="btn btn-default" href="/back-answer/detail.html?id=<?=$answer['id']?>" role="button" style="color:#FF9900">详情</a>
                                            <a class="btn btn-default" href="/back-answer/edit.html?id=<?=$answer['id']?>" role="button" style="color:#FF9900">编辑回答</a>
                                            <a class="btn btn-default is_show_answer" href="javascript:void(0)" role="button" style="color:#FF9900" answer_id="<?=$answer['id'];?>" is_show="<?=$answer['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($answerShowText,$answer['is_show'],'未知');?></a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'php');
                        else: echo \common\helper\ConstHelper::ANSWER_DATA;endif;?>
                    </div>
                    <div class="tab-pane" id="panel-293654">
                        <?php if(\yii\helpers\ArrayHelper::getValue($answers,'java')):?>
                            <div class="list-group">
                                <?php foreach($answers['java'] as $answer):?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title" style="color: #6164C1">解答描述</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?=$answer['answer_des']?>
                                        </div>
                                        <div class="panel-body">
                                            <a class="btn btn-default" href="/back-question/detail.html?id=<?=$answer['ques_id']?>" role="button" style="color:#FF9900">详情</a>
                                            <a class="btn btn-default" href="/back-answer/edit.html?id=<?=$answer['id']?>" role="button" style="color:#FF9900">编辑回答</a>
                                            <a class="btn btn-default is_show_answer" href="javascript:void(0)" role="button" style="color:#FF9900" answer_id="<?=$answer['id'];?>" is_show="<?=$answer['is_show']?>"><?=\yii\helpers\ArrayHelper::getValue($answerShowText,$answer['is_show'],'未知');?></a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'java');
                        else: echo \common\helper\ConstHelper::ANSWER_DATA;endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/layer.js');
    \frontend\assets\BackAsset::addScript($this,'@web/js/ext/layui.js');
    \frontend\assets\BackAsset::addScript($this,'@web/backend/js/BackQuestion.js');
?>
