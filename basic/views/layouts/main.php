<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

\app\assets\MyClassAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--<div class="wrap">-->
<!--    --><?php
//    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
//        ],
//    ]);
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
//            ['label' => 'Calendar', 'url' => ['/site/calendar']],
//            ['label' => 'Profile', 'url' => ['/site/profile']],
//
//            Yii::$app->user->isGuest ? (
//                ['label' => 'Login', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
//        ],
//    ]);
//    NavBar::end();
//    ?>
<!---->
<!--    <div class="container">-->
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
<!--        --><?//= Alert::widget() ?>
<!--        --><?//= $content ?>
<!--    </div>-->
<!--</div>-->
<!---->
<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->



<div class="wrapper">
    <div class="main-header">
        <div class="logo-header">
            <a href="index.html" class="logo">
                WorkShop
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
        </div>
        <nav class="navbar navbar-header navbar-expand-lg">
            <div class="container-fluid">
                <form class="navbar-left navbar-form nav-search mr-md-3" action="" >
                    <div class="input-group"  style="height: 35px;">
                        <input type="text" placeholder="Search ..." class="form-control"  style="height: 35px;">
                        <div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-envelope"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-bell"></i>
                            <span class="notification">3</span>
                        </a>
                        <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                            <li>
                                <div class="dropdown-title">You have 4 new notification</div>
                            </li>
                            <li>
                                <div class="notif-center">
                                    <a href="#">
                                        <div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
                                        <div class="notif-content">
												<span class="block">
													New user registered
												</span>
                                            <span class="time">5 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
                                        <div class="notif-content">
												<span class="block">
													Rahmad commented on Admin
												</span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img">
                                            <?php if(Yii::$app->user->identity->image!=''){?> <img src="/basic/web/uploads/<?=Yii::$app->user->identity->image?>" alt="Img Profile"><? } ?>
                                        </div>
                                        <div class="notif-content">
												<span class="block">
													Reza send messages to you
												</span>
                                            <span class="time">12 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
                                        <div class="notif-content">
												<span class="block">
													Farrah liked Admin
												</span>
                                            <span class="time">17 minutes ago</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"><?php if(Yii::$app->user->identity->image!=''){?> <img src="/basic/web/uploads/<?=Yii::$app->user->identity->image?>" alt="user-img" width="36" class="img-circle"><? }?><span ><?=Yii::$app->user->identity->username?></span></span> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <div class="user-box">
                                    <div class="u-img"><?php if(Yii::$app->user->identity->image!=''){?><img src="/basic/web/uploads/<?=Yii::$app->user->identity->image?>" alt="user"><? }?></div>
                                    <div class="u-text">
                                        <h4><?=Yii::$app->user->identity->username?></h4>
                                        <p class="text-muted"><?=Yii::$app->user->identity->email?></p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                </div>
                            </li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
                            <a class="dropdown-item" href="#"></i> My Balance</a>
                            <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?=Url::to(['auth/editprof'])?>"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" id="logout"><i class="fa fa-power-off"></i> Logout</a>
<!--                            --><?//
//                            echo Html::beginForm(['/site/logout'], 'post')
//                                . Html::a(
//                                    'Logout',
//                                    ['class' => 'dropdown-item'],
//                                            ['class' => 'dropdown-item']
//                                )
//                                . Html::endForm();
//                            ?>

<!--                            --><?//
//                            echo Nav::widget([
//                                'options' => ['class' => 'navbar-nav navbar-left'],
//                                'items' => [
//                                    Yii::$app->user->isGuest ? (
//                                    ['label' => 'Login', 'url' => ['/site/login']]
//                                    ) : (
//                                        '<li>'
//                                        . Html::beginForm(['/site/logout'], 'post')
//                                        . Html::submitButton(
//                                            'Logout (' . Yii::$app->user->identity->username . ')',
//                                            ['class' => 'btn btn-link logout']
//                                        )
//                                        . Html::endForm()
//                                        . '</li>'
//                                    )
//                                ],
//                            ]);
//                            ?>

                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="sidebar">
        <div class="scrollbar-inner sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <?php if(Yii::$app->user->identity->image!=''){?><img src="/basic/web/uploads/<?=Yii::$app->user->identity->image?>"><? }?>
                </div>
                <div class="info">
                    <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?=Yii::$app->user->identity->username?>
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                        <ul class="nav">
                            <li>
                                <a href="<?=Url::to(['site/ownprof', 'id_pr'=>Yii::$app->user->identity->id])?>">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=Url::to(['auth/editprof'])?>">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">

                <li class="nav-item">
                    <a href="<?=Url::to(['site/ownprof', 'id_pr'=>Yii::$app->user->identity->id])?>">
                        <i class="la la-dashboard"></i>
                        <p>Мой профиль</p>
                        <span class="badge badge-count">5</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=Url::to(['site/profile'])?>">
                        <i class="la la-table"></i>
                        <p>Задачи</p>
                        <span class="badge badge-count">14</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="<?=Url::to(['site/news'])?>">
                        <i class="la la-keyboard-o"></i>
                        <p>Новости</p>
                        <span class="badge badge-count">50</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?=Url::to(['site/rating'])?>">
                        <i class="la la-th"></i>
                        <p>Рейтинг</p>
                        <span class="badge badge-count">6</span>
                    </a>
                </li>
                <?php if(Yii::$app->user->identity->idAdmin==1){?>
                    <li class="nav-item">
                        <a href="<?=Yii::$app->user->identity->id_company==0?Url::to(['auth/regcompany']):Url::to(['site/company'])?>">
                            <i class="la la-dashboard"></i>
                            <p>Компания</p>
                            <span class="badge badge-count">5</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <div class="content">

                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>

        </div>

    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
                <p>
                    <b>We'll let you know when it's done</b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#displayNotif').on('click', function(){
        var placementFrom = $('#notify_placement_from option:selected').val();
        var placementAlign = $('#notify_placement_align option:selected').val();
        var state = $('#notify_state option:selected').val();
        var style = $('#notify_style option:selected').val();
        var content = {};

        content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
        content.title = 'Bootstrap notify';
        if (style == "withicon") {
            content.icon = 'la la-bell';
        } else {
            content.icon = 'none';
        }
        content.url = 'index.html';
        content.target = '_blank';

        $.notify(content,{
            type: state,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            time: 1000,
        });
    });

    $(document).ready(function(){
        $('.sidebar .nav li').click(function() {
            $(this).siblings('li').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
<style>
    .nav li { cursor:pointer; }
</style>


<?php

$js=<<<JS
    $('#logout').on('click', function(){
       var data = $(this).serialize();
        $.ajax({
            url: 'index.php?r=site/logout',
            type: 'POST',
            data: 'do=logout',
            success: function(res){
                location.replace("http://yii2frame/basic/web/")
            },
            error: function(){
                location.replace("http://yii2frame/basic/web/")
            }
        });
        return false;
    });


JS;

$this->registerJs($js);

?>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
