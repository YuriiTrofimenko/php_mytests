<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\modules\tests\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-green-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
    <!--Main menu-->
    <nav>
        <div class="nav-wrapper container">
            <a id="logo-container" href="#" class="brand-logo">MyTests</a>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#home" class="">Главная</a></li>
                <li><a href="#tests">Тесты</a></li>
                <?php
                    if (Yii::$app->user->isGuest) {
                        echo "<li><a href='".Url::toRoute(['default/signup'])."#void'>Signup</a></li>";
                        echo "<li><a href='".Url::toRoute(['default/login'])."#void'>Login</a></li>";
                    } else {
                        echo "<li><a href='".Url::toRoute(['default/logout'])."' data-method='post'>Logout (". Yii::$app->user->identity->username .")</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>

    <!--Main menu mobile-->
    <ul id="nav-mobile" class="sidenav">
        <li><a href="#home" class="">Главная</a></li>
        <li><a href="#tests">Тесты</a></li>
        <?php
            if (Yii::$app->user->isGuest) {
                echo "<li><a href='".Url::toRoute(['default/signup'])."'>Signup</a></li>";
                echo "<li><a href='".Url::toRoute(['default/login'])."'>Login</a></li>";
            } else {
                echo "<li><a href='".Url::toRoute(['default/logout'])."' data-method='post'>Logout (". Yii::$app->user->identity->username .")</a></li>";
            }
        ?>
    </ul>

    <!--Main content-->
    <div class="container">
        <?= $content ?>
    </div>

    <footer class="page-footer teal">
        <div class="container">
            <div class="row">
                
            </div>
            <div class="footer-copyright">
                <div class="container">
                    <p class="pull-left">&copy; Тесты <?= date('Y') ?></p>
                    <p class="pull-right"><?= Yii::powered() ?></p>
                </div>
            </div>            
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
