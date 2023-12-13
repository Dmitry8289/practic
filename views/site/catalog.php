<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

$this->title = 'Каталог';
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
    <div class="navigation" style="background-color: #28272c;">
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
    <h1 class="text-center m-3 p-1 fw-bold">Каталог автомобилей</h1>
    <div class="container">
        <div class="d-flex justify-content-center row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($provider->getModels() as $item): ?>
                <div class="col">
                    <div class="card">
                        <img src="img/<?php if ($item->image) {
                            echo $item->image;
                        } else {
                            echo 'default.png';
                        } ?>" class="card-img-top" style="width: 414px!important; height: 276px!important;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item->brand . ' ' . $item->model ?></h5>
                            <p class="card-text">Год выпуска: <b><?php echo $item->year ?></b></p>
                            <p class="card-text">Тип топлива: <b><?php echo $item->oilType->type ?></b></p>
                            <p class="card-text">Рабочий объём: <b><?php echo $item->engine_litre ?></b> л.</p>
                            <p class="card-text">Лошадинные силы: <b><?php echo $item->horse_power ?></b></p>
                            <a href="<?php echo Url::toRoute(['/site/reservation', 'car_id' => $item['id']]) ?>" class="btn btn-send m-1 p-2">Забронировать</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
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
                        <a href="../web/#Contact">Связаться с нами</a>
                        <a href="<?php echo Url::toRoute('catalog') ?>">Каталог</a>
                        <a href="../web/#Interest">Это интересно</a>
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
