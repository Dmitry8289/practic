<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

//AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="../web/css/style.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/latest/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;900&family=Open+Sans:wght@500;700;800&display=swap"
            rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<nav>
    <div class="header" style='background-image: url("../web/img/image_bg.jpg")'>
        <div class="header-bg"></div>
        <div class="navigation">
            <div class="logo">
                <a href="<?php echo Url::toRoute('index') ?>"><img src="../web/img/WheelDrive.svg"></a>
            </div>
            <div class="menu">
                <?php NavBar::begin([
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => ['class' => 'navbar-expand-lg']
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-menu', 'style' => 'background-color: unset!important;'],
                    'items' => [
                        ['label' => 'Главная', 'url' => ['/site/index']],
                        ['label' => 'Каталог', 'url' => ['/site/catalog']],
                        Yii::$app->user->isGuest ? ['label' => 'Регистрация', 'url' => ['/site/register']] : '',
                        Yii::$app->user->isGuest ? ('') : (Yii::$app->user->identity->isAdmin() ? (['label' => 'Профиль', 'url' => ['/admin']]) :
                            (['label' => 'Профиль', 'url' => ['/site/account']])),
                        Yii::$app->user->isGuest
                            ? ['label' => 'Войти', 'url' => ['/site/login']]
                            : '<li class="nav-item">'
                            . Html::beginForm(['/site/logout'])
                            . Html::submitButton(
                                'ВЫЙТИ (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'nav-link logout', 'style' => 'color: white!important; margin-top: 25px!important;']
                            )
                            . Html::endForm()
                            . '</li>'
                    ]
                ]);
                NavBar::end();
                ?>
            </div>
        </div>
        <div class="header-title">
            <h1>доступный каршеринг</h1>
            <p>Выберите свой автомобиль, который будет Вам по душе</p>
            <div class="header-buttons">
                <a href="<?php echo Url::toRoute('/site/catalog') ?>" class="btn"
                   style="background-color: red; border-radius: 30px;">
                    <p class="text-white">просмотреть</p>
                </a>
                <a href="<?php echo Url::toRoute('/site/newcar') ?>" class="btn"
                   style="background-color: white; border-radius: 30px;">
                    <p style="color: red;">опубликовать</p>
                </a>
            </div>
        </div>
    </div>
</nav>
<main id="main" class="flex-shrink-0" role="main">
    <?php if (!empty($this->params['breadcrumbs'])): ?>
        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <?php endif ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</main>
<footer>
    <div class="d-flex justify-content-center align-items-center align-content-center" style="height: 100%!important;">
        <div class="d-flex flex-row w-75 align-items-center align-content-center justify-content-around">
            <div class="logo logo-footer">
                <img src="../web/img/WheelDrive.svg">
            </div>
            <div class="d-flex" style="height: 130px!important;">
                <div class="vr"
                     style="border: 2px solid white!important; border-radius: 10px!important; opacity: unset!important;"></div>
            </div>
            <div class="footer-links">
                <div class="column1 w-100 d-flex justify-content-around" style="height: 100px!important;">
                    <a href="#Contact">Связаться с нами</a>
                    <a href="<?php echo Url::toRoute('catalog') ?>">Каталог</a>
                    <a href="#Interest">Это интересно</a>
                </div>
            </div>
            <p class="text-white">&copy; Copyright 2023</p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
