<?php
use yii\helpers\Html;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
//$this->clear();
//这个地方引入js和css
\frontend\assets\BackAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title).'Bug-Tracker-backend'?></title>
    <?php $this->head() ?>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>
<body class="cbp-spmenu-push">
<?php $this->beginBody() ?>
<div class="main-content">
    <!--left-fixed -navigation-->
    <?php echo \frontend\widgets\BackMenuWidget::widget()?>
    <!--left-fixed -navigation-->
    <!-- header-starts -->
    <div class="sticky-header header-section ">
        <div class="header-left">
            <!--toggle button start-->
            <button id="showLeftPush"><i class="fa fa-bars"></i></button>
            <!--toggle button end-->
            <!--logo -->
            <div class="logo" style="width: 229px;height: 78px;text-align: center">
                <a href="index.html" style="text-align: center">
                    <img src="/images/logo/logo.png" alt="源码时代"/>
                </a>
            </div>
            <!--//logo-->
            <!--search-box-->
            <div class="search-box">
                <form class="input">
                    <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
                    <label class="input__label" for="input-31">
                        <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                        </svg>
                    </label>
                </form>
            </div>
            <!--//end-search-box-->
            <div class="clearfix"> </div>
        </div>
        <!--这里写判断 若是未登录的话显示登录图标-->
        <div class="header-right">
            <div class="profile_details_left"><!--notifications of menu start -->
                <ul class="nofitications-dropdown">
                    <li class="dropdown head-dpdn">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="notification_header">
                                    <h3>You have 3 new notification</h3>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="user_img"><img src="/backend/images/2.png" alt=""></div>
                                    <div class="notification_desc">
                                        <p>Lorem ipsum dolor amet</p>
                                        <p><span>1 hour ago</span></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                            <li class="odd"><a href="#">
                                    <div class="user_img"><img src="/backend/images/1.png" alt=""></div>
                                    <div class="notification_desc">
                                        <p>Lorem ipsum dolor amet </p>
                                        <p><span>1 hour ago</span></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </a></li>
                            <li><a href="#">
                                    <div class="user_img"><img src="/backend/images/3.png" alt=""></div>
                                    <div class="notification_desc">
                                        <p>Lorem ipsum dolor amet </p>
                                        <p><span>1 hour ago</span></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </a></li>
                            <li>
                                <div class="notification_bottom">
                                    <a href="#">See all notifications</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="clearfix"> </div>
            </div>
            <!--notification menu end -->
            <div class="profile_details">
                <?php if(!Yii::$app->user->isGuest):?>
                <ul>
                    <li class="dropdown profile_details_drop">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <div class="profile_img">
                                <div class="user-name">
                                    <p><?php echo Yii::$app->user->identity->username; ?></p>
                                    <span>
                                        <?php
                                            $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id);
                                            foreach($roles as $role){
                                                echo $role->description;
                                                break;
                                            }
                                        ?>
                                    </span>
                                </div>
                                <i class="fa fa-angle-down lnr"></i>
                                <i class="fa fa-angle-up lnr"></i>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu drp-mnu">
                            <li> <a href="#"><i class="fa fa-cog"></i>设置</a> </li>
                            <li> <a href="back-login/logout.html"><i class="fa fa-sign-out"></i>退出</a></li>
                        </ul>
                    </li>
                </ul>
                <?php else:?>
                    <ul>
                        <li>
                            <a href="<?php echo  \yii\helpers\Url::to(\Yii::$app->user->loginUrl); ?>" style="font-size: 20px">
                                <div class="user-name">
                                    <p><span class="glyphicon glyphicon-log-in" style="color: #FF9900"></span></p>
                                    <span style="color: #FF9900">登录</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                <?php endif;?>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!--写判断即可-->
        <div class="clearfix"> </div>
    </div>
    <!-- //header-ends -->
    <!-- main content start-->
    <div id="page-wrapper">
        <?=Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]);?>
        <?=Alert::widget() ?>
        <div class="main-page">
            <?= $content ?>
        </div>
    </div>
    <!--footer-->
    <div class="footer">
        <p>
            <span><a href="http://www.itsource.cn/systemSettingsWeb.htm?cmd=aboutThisSite">源码时代官网</a>  |
                <a target="_blank" href="http://www.itsource.cn/special/20150831100327576/index.html">人才招聘</a>  |
                <a href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&key=XzkzODAyMzUzNV8yNjk1NTVfNDAwODA4Njg0MF8yXw" target="_blank">联系我们</a>   |
            </span>
            <span style="color: #00CC00">专业Java培训、PHP培训、UI培训、Web前端培训</span>
        </p>
    </div>
    <!--//footer-->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

