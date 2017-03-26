<div class="row clearfix" style="height: 65px;">
    <div class="col-md-12 column">
        <div class="col-md-12 column">
            <form role="form" class="form-inline" style="font-family: '仿宋'">
                <div class="form-group">
                    <label for="sub_status">状态</label>
                    <select id="sub_status" name="status" class="form-control">
                        <option value="0">全部</option>
                        <option value="<?= \common\helper\ConstHelper::SOLVE_NO;?>" <?php if($params['status']==\common\helper\ConstHelper::SOLVE_NO){ echo "selected";}?> >未解决</option>
                        <option value="<?= \common\helper\ConstHelper::SOLVE_YES;?>" <?php if($params['status']==\common\helper\ConstHelper::SOLVE_YES){ echo "selected";}?>>已解决</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="contentKey">关键字</label>
                    <input type="text" name='keyword' class="form-control" id="contentKey"  placeholder='错误内容的关键字!' style="width: 500px;" value="<?php echo $params['keyword'];?>"/>
                </div>
                <button type="submit" class="btn btn-default" style="color: #00CC00;">搜索</button>
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
                <p style="font-family: '方正舒体';"><span style="font-size: 20px;">持之以恒|</span>不积跬步，无以至千里；不积小流，无以成江海</p>
            </div>
            <div class="col-md-12 column">
                <div class="tab-content">
                    <div class="tab-pane" id="panel-383095">
                        <?php if(\yii\helpers\ArrayHelper::getValue($question,'ui')):?>
                            <div class="list-group">
                                <?php foreach($question['ui'] as $que):?>
                                    <a href="/question-set/detail.html?question_id=<?=$que['id']?>&subject=ui" class="list-group-item">
                                        <span class="badge">new</span>
                                        <span class="badge">
                                            <?php if($que['status']==\common\Helper\ConstHelper::SOLVE_NO){echo '未解决';}elseif($que['status']==\common\Helper\ConstHelper::SOLVE_YES){ echo '已解决';}else{ echo '未知';}?>
                                        </span>
                                        <h4 class="list-group-item-heading"><?=$que['ques_title']?></h4>
                                        <p><?=$que['content'];?></p>
                                    </a>
                                <?php endforeach;?>
                            </div>
                            <!--以表格的形式展示-->
                            <?php
                                echo \common\helper\Helper::getPagerHtml($pagers,'ui');
                                else: echo \common\helper\ConstHelper::WARNING_HTML;endif;
                        ?>
                    </div>
                    <div class="tab-pane" id="panel-293650">
                        <?php if(\yii\helpers\ArrayHelper::getValue($question,'web')):?>
                            <div class="list-group">
                                <?php foreach($question['web'] as $que):?>
                                    <a href="/question-set/detail.html?question_id=<?=$que['id']?>&subject=web" class="list-group-item">
                                        <span class="badge">new</span>
                                        <span class="badge">
                                            <?php if($que['status']==\common\Helper\ConstHelper::SOLVE_NO){echo '未解决';}elseif($que['status']==\common\Helper\ConstHelper::SOLVE_YES){ echo '已解决';}else{ echo '未知';}?>
                                        </span>
                                        <h4 class="list-group-item-heading"><?=$que['ques_title']?></h4>
                                        <p><?=$que['content'];?></p>
                                    </a>
                                <?php endforeach;?>
                            </div>
                            <?php
                                echo \common\helper\Helper::getPagerHtml($pagers,'web');
                                else: echo \common\helper\ConstHelper::WARNING_HTML;endif;
                        ?>
                    </div>
                    <div class="tab-pane active" id="panel-293651">
                        <?php if(\yii\helpers\ArrayHelper::getValue($question,'php')):?>
                            <div class="list-group">
                                <?php foreach($question['php'] as $que):?>
                                    <a href="/question-set/detail.html?question_id=<?=$que['id']?>&subject=php" class="list-group-item">
                                        <span class="badge">new</span>
                                        <span class="badge">
                                            <?php if($que['status']==\common\Helper\ConstHelper::SOLVE_NO){echo '未解决';}elseif($que['status']==\common\Helper\ConstHelper::SOLVE_YES){ echo '已解决';}else{ echo '未知';}?>
                                        </span>
                                        <h4 class="list-group-item-heading"><?=$que['ques_title']?></h4>
                                        <p><?=$que['content'];?></p>
                                    </a>

                                <?php endforeach;?>
                            </div>
                        <?php
                            echo \common\helper\Helper::getPagerHtml($pagers,'php');
                            else: echo \common\helper\ConstHelper::WARNING_HTML;endif;?>
                    </div>
                    <div class="tab-pane" id="panel-293654">
                        <?php if(\yii\helpers\ArrayHelper::getValue($question,'java')):?>
                            <div class="list-group">
                                <?php foreach($question['java'] as $que):?>
                                    <a href="/question-set/detail.html?question_id=<?=$que['id']?>&subject=java" class="list-group-item">
                                        <span class="badge">new</span>
                                        <span class="badge">
                                            <?php if($que['status']==\common\Helper\ConstHelper::SOLVE_NO){echo '未解决';}elseif($que['status']==\common\Helper\ConstHelper::SOLVE_YES){ echo '已解决';}else{ echo '未知';}?>
                                        </span>
                                        <h4 class="list-group-item-heading"><?=$que['ques_title']?></h4>
                                        <p><?=$que['content'];?></p>
                                    </a>
                                <?php endforeach;?>
                            </div>
                            <?php
                                echo \common\helper\Helper::getPagerHtml($pagers,'java');
                                else: echo \common\helper\ConstHelper::WARNING_HTML;endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>