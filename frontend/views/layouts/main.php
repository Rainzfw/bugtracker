<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\FrontendAsset;
use common\widgets\Alert;
FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title).'Itsource-Bug-Tracker'?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin(['brandLabel' => \yii\bootstrap\Html::img('/images/logo/logo.png',['alt'=>'源码时代','style'=>'width:99.7px;height:28px']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItemsLeft = [
        ['label' => '首页', 'url' => ['/home/index']],
        ['label' => '错误集', 'url' => ['/question-set/index']],
        ['label' => '知识聚焦', 'url' => ['/knowledge-set/index']],
        ['label' => '我要提问', 'url' => ['/question-set/add']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItemsLeft,
    ]);
    //TODO 这里不用yii的身份验证
    //Yii::$app->user->isGuest;
    if (empty(\common\helper\Helper::getSess('userInfo',null))):?>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span style="color:#00CC00;font-size: 20px;font-size: 18px">
                    <span class="glyphicon glyphicon-qrcode"></span>
                </span>
            </a>
            <ul class="dropdown-menu" style="font-weight: bold;font-family:'方正舒体';font-size: 16px">
                <li>源码时代官方微信</li>
                <li class="divider"></li>
                <li><img src="/images/logo/weixin.png" style="height: 100px;width: 100px;"></li>
                <li class="divider"></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span style="color:#00CC00;font-size: 20px;font-size: 18px">
                    <span class="glyphicon glyphicon-user"></span>
                </span>
            </a>
            <ul class="dropdown-menu" style="font-weight: bold;font-family:'方正舒体';font-size: 16px">
                <li><a href="/register/index.html"><span class="glyphicon glyphicon-edit"></span><label style="width: 10px;"></label>注册</a></li>
                <li class="divider"></li>
                <li><a href="/login/index.html"><span class="glyphicon glyphicon-log-in"></span><label style="width: 10px;"></label>登录</a></li>
            </ul>
        </li>
    </ul>
    <?php else:?>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="/home/notice">
                <span class="glyphicon glyphicon-bell" style="color:#00CC00;font-size: 18px"></span>
            </a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span style="color:#00CC00;font-size: 20px;font-size: 18px">
                    <span class="glyphicon glyphicon-user"></span>
                    <?=\common\helper\Helper::getSess('userInfo')->username;?>
                </span>
            </a>
            <ul class="dropdown-menu" style="font-weight: bold;font-family:'方正舒体';font-size: 16px">
                <li>
                    <a href="/user/index"><span class="glyphicon glyphicon-user"></span><label style="width: 10px;"></label>个人主页</a>
                </li>
                <li class="divider">
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-cog"></span><label style="width: 10px;"></label>账户设置</a>
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-question-sign"></span><label style="width: 10px;"></label>我的提问</a>
                </li>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-star"></span><label style="width: 10px;"></label>我的收藏</a>
                </li>
                <li class="divider">
                </li>
                <li>
                    <a href="/login/logout.html"><span class="glyphicon glyphicon-log-out"></span><label style="width: 10px;"></label>退出登录</a>
                </li>
            </ul>
        </li>
    </ul>
    <?php endif; NavBar::end(); ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])?>
        <?= Alert::widget() ?>
        <?= $content ?>
</div>
</div>
<br/>
<footer class="footer">
    <p>
        <span>
            <a href="http://www.itsource.cn/systemSettingsWeb.htm?cmd=aboutThisSite">源码时代官网</a>  |
            <a target="_blank" href="http://www.itsource.cn/special/20150831100327576/index.html">人才招聘</a>  |
            <a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODAyMzUzNV8yNjk1NTVfNDAwODA4Njg0MF8yXw" target="_blank">联系我们</a>   |
        </span>
        <span style="color: #00CC00">专业Java培训、PHP培训、UI培训、Web前端培训</span>
    </p>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>