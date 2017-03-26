<?php
\frontend\assets\FrontendAsset::addCss($this,'@web/css/frontend/image_text.css');
\frontend\assets\FrontendAsset::addScript($this,'@web/js/frontend/image_text.js');
\frontend\assets\FrontendAsset::addScript($this,'@web/js/ext/layer.js');
\frontend\assets\FrontendAsset::addScript($this,'@web/js/ext/layui.js');
$warning =<<<warning
<div class="alert alert-success alert-dismissable" style=' background-color: #F2F2F2;'>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>
        注意!
    </h4><strong>Warning!</strong>没有提问数据显示<a href="#" class="alert-link">alert link</a>
</div>
warning;
?>
<div class="row clearfix">
    <div class="col-md-12 column">
        <div class="row clearfix">
            <!--轮播图开始-->
            <div class="col-md-8 column">
                <div class="carousel slide" id="carousel-583810">
                    <ol class="carousel-indicators">
                        <li class="active" data-slide-to="0" data-target="#carousel-583810">
                        </li>
                        <li data-slide-to="1" data-target="#carousel-583810">
                        </li>
                        <li data-slide-to="2" data-target="#carousel-583810">
                        </li><li data-slide-to="3" data-target="#carousel-583810">
                        </li><li data-slide-to="4" data-target="#carousel-583810">
                        </li>
                    </ol>
                    <div class="carousel-inner">
                        <?php foreach($carouselFigures as $figure):?>
                            <div class="<?php echo $figure['is_select']?'item active':'item'?>" >
                                <img alt="" src="<?= $figure['img']?>"/>
                                <div class="carousel-caption">
                                    <?= $figure['describute']?>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <a class="left carousel-control" href="#carousel-583810" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                     </a>
                    <a class="right carousel-control" href="#carousel-583810" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
            <!--轮播图结束-->
            <div class="col-md-4 column">
                <table class="table" style="text-align: center;font-family: '仿宋';background-color: #f9f9f9">
                    <tr>
                        <td><img alt="140x140" src="/images/touxiang/man.png" style="width: 70px;height: 70px" /></td>
                        <td style="font-size: 20px" colspan="2"><p>hello,</p><span>欢迎成为源码课堂一员</span></span></td>
                    </tr>
                </table>
                <!--这里是右侧的广告图片-->
                <div>
                    <img alt="140x140" src="<?=$rightImg;?>" style="width: 360px;height: 200px;"/>
                </div>
            </div>
        </div>
    </div>
</div>
<!--问题开始的地方-->
<div class="row clearfix">
    <div class="col-md-12 column">
        <h3 style="font-family: '仿宋';font-weight: bold;color: #000">最新提交的问题</h3>
    </div>
    <div class="col-md-12 column">
        <div class="tabbable" id="tabs-843934">
            <div class="col-md-12 column">
                <ul class="nav nav-tabs">
                    <li>
                        <a href="#panel-383095" data-toggle="tab">UI</a>
                    </li>
                    <li>
                        <a href="#panel-293650" data-toggle="tab">WEB</a>
                    </li>
                    <li class="active">
                        <a href="#panel-293651" data-toggle="tab">PHP</a>
                    </li>
                    <li>
                        <a href="#panel-293654" data-toggle="tab">JAVA</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12 column">
                <p style="font-family: '方正舒体';"><span style="font-size: 20px;">成长的阶梯|</span>千淘万漉虽辛苦 吹尽狂沙始到金</p>
            </div>
            <div class="col-md-12 column">
                <div class="tab-content">
                <div class="tab-pane" id="panel-383095">
                    <?php if($ques['ui']):?>
                        <div class="list-group">
                            <?php foreach($ques['ui'] as $que):?>
                                <a href="/question-set/detail.html?question_id=<?=$que['id']?>&subject=ui" class="list-group-item">
                                    <span class="badge">new</span>
                                    <span class="badge"><?php if($que['status']==\common\Helper\ConstHelper::SOLVE_NO){echo '未解决';}elseif($que['status']==\common\Helper\ConstHelper::SOLVE_YES){ echo '已解决';}else{ echo '未知';}?></span>
                                    <h4 class="list-group-item-heading"><?=$que['ques_title']?></h4>
                                    <p><?=$que['content'];?></p>
                                </a>
                            <?php endforeach;?>
                        </div>
                    <?php else: echo $warning;endif;?>
                </div>
                <div class="tab-pane" id="panel-293650">
                    <?php if($ques['web']):?>
                        <div class="list-group">
                            <?php foreach($ques['web'] as $que):?>
                                <a href="/question-set/detail.html?question_id=<?=$que['id']?>&subject=web" class="list-group-item">
                                    <span class="badge">new</span>
                                    <span class="badge"><?php if($que['status']==\common\Helper\ConstHelper::SOLVE_NO){echo '未解决';}elseif($que['status']==\common\Helper\ConstHelper::SOLVE_YES){ echo '已解决';}else{ echo '未知';}?></span>
                                    <h4 class="list-group-item-heading"><?=$que['ques_title']?></h4>
                                    <p><?=$que['content'];?></p>
                                </a>
                            <?php endforeach;?>
                        </div>
                    <?php else: echo $warning;endif;?>
                </div>
                <div class="tab-pane active" id="panel-293651">
                    <?php if($ques['php']):?>
                        <div class="list-group">
                        <?php foreach($ques['php'] as $que):?>
                            <a href="/question-set/detail.html?question_id=<?=$que['id']?>&subject=php" class="list-group-item">
                                <span class="badge">new</span>
                                <span class="badge"><?php if($que['status']==\common\Helper\ConstHelper::SOLVE_NO){echo '未解决';}elseif($que['status']==\common\Helper\ConstHelper::SOLVE_YES){ echo '已解决';}else{ echo '未知';}?></span>
                                <h4 class="list-group-item-heading"><?=$que['ques_title']?></h4>
                                <p><?=$que['content'];?></p>
                            </a>

                        <?php endforeach;?>
                        </div>
                    <?php else: echo $warning;endif;?>
                </div>
                <div class="tab-pane" id="panel-293654">
                    <?php if($ques['java']):?>
                        <div class="list-group">
                            <?php foreach($ques['java'] as $que):?>
                                <a href="/question-set/detail.html?question_id=<?=$que['id']?>&subject=java" class="list-group-item">
                                    <span class="badge">new</span>
                                    <span class="badge"><?php if($que['status']==\common\Helper\ConstHelper::SOLVE_NO){echo '未解决';}elseif($que['status']==\common\Helper\ConstHelper::SOLVE_YES){ echo '已解决';}else{ echo '未知';}?></span>
                                    <h4 class="list-group-item-heading"><?=$que['ques_title']?></h4>
                                    <p><?=$que['content'];?></p>
                                </a>
                            <?php endforeach;?>
                        </div>
                    <?php else: echo $warning;endif;?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!--问题结束的地方-->
<div class="row clearfix">
    <div class="col-md-12 column">
        <h3 style="font-family: '仿宋';font-weight: bold;color: #000">专项提升</h3>
    </div>
    <div class="col-md-12 column">
        <?php if($courses):
            foreach($courses as $course):?>
                <div class="col-md-3 column">
                    <div class="imgshow">
                        <div class="imgshowbox">
                            <p><h5><?=$course['cour_name'];?></h5><?=$course['describute']?></p>
                        </div>
                        <img src="<?=$course['img'];?>" style="width: 260px"/>
                    </div>
                    <span>34536在学习</span>
                    <a class="btn" href="#">View details »</a>
                </div>
            <?php endforeach;?>
        <?php else: echo $warning;endif?>
    </div>
</div>

