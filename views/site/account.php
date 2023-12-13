<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

$this->title = 'Мой профиль';

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
</nav>
<div class="p-2">
    <h2 class="text-center">Использующиеся машины:</h2>
    <?php if (empty($cars)): ?>
        <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
            <p class="text-monospace fs-5"><i>Вы пока не пользуетесь услугами каршеринга. Добавьте машину!</i></p>
        </div>
    <?php else: ?>
        <div class="d-flex justify-content-center row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($cars as $item): ?>
                <div class="col">
                    <div class="border border-2 border-secondary p-2 d-flex flex-column card">
                        <h3 class="text-center"><?php echo $item->brand . ' ' . $item->model ?></h3>
                        <?php if ($item->image) { ?>
                            <div class="d-flex flex-column justify-content-center">
                                <img src="img/<?php echo $item->image ?>"
                                     alt="<?php echo $item->brand . ' ' . $item->model ?>"
                                     title="<?php echo $item->brand . ' ' . $item->model ?>">
                            </div>
                        <?php } else { ?>
                            <h5 class="text-center p-1">Автомобиль без фотографии</h5>
                        <?php } ?>
                        <h5 class="text-center p-1">Характеристики:</h5>
                        <ul>
                            <li>Год выпуска: <b><?php echo $item->year ?></b></li>
                            <li>Госномер: <b><?php echo $item->plate_number ?></b></li>
                            <li>VIN: <b><?php echo $item->vin ?></b><i class="bi bi-clipboard"></i></li>
                            <?php if ($item->oilType->type == 'Электро') { ?>
                            <?php } else { ?>
                                <li>Рабочий объём двигателя: <?php echo $item->engine_litre ?> л.</li>
                            <?php } ?>
                            <li>Тип топлива: <?php echo $item->oilType->type ?></li>
                            <li>Лошадинные силы: <?php echo $item->horse_power ?></li>
                        </ul>
                        <div class="p-2">
                            <h5 class="text-center p-1">Данные владельца:</h5>
                            <p>Имя пользователя: <?php echo $item->owner->username ?></p>
                            <p>Телефон для связи: <?php echo $item->owner->phone ?></p>
                            <p>Эл.почта для связи: <?php echo $item->owner->email ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div style="width: 100%; height: 25px;"></div>
    <?php if ($carsharing_cars): ?>
        <h2 class="text-center">Автомобили, предоставленные в каршеринг:</h2>
        <div class="p-1">
            <div class="d-flex justify-content-center row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($carsharing_cars as $item): ?>
                    <div class="col">
                        <div class="border border-2 border-secondary p-2 card">
                            <h3 class="text-center"><?php echo $item->brand . ' ' . $item->model ?></h3>
                            <?php if ($item->image) { ?>
                                <div class="d-flex flex-column justify-content-center">
                                    <img src="img/<?php echo $item->image ?>"
                                         alt="<?php echo $item->brand . ' ' . $item->model ?>"
                                         title="<?php echo $item->brand . ' ' . $item->model ?>"
                                         style="">
                                </div>
                            <?php } else { ?>
                                <h5 class="text-center p-1">Автомобиль без фотографии</h5>
                            <?php } ?>
                            <h5 class="text-center p-1">Характеристики:</h5>
                            <ul>
                                <li>Год выпуска: <b><?php echo $item->year ?></b></li>
                                <li>Госномер: <b><?php echo $item->plate_number ?></b></li>
                                <li>VIN: <b><?php echo $item->vin ?></b><i class="bi bi-clipboard"></i></li>
                                <?php if ($item->oilType->type == 'Электро') { ?>
                                <?php } else { ?>
                                    <li>Рабочий объём двигателя: <?php echo $item->engine_litre ?> л.</li>
                                <?php } ?>
                                <li>Тип топлива: <?php echo $item->oilType->type ?></li>
                                <li>Лошадинные силы: <?php echo $item->horse_power ?></li>
                            </ul>
                            <?php if ($item->user) { ?>
                                <div class="p-2">
                                    <h5 class="text-center p-1">Данные временного владельца:</h5>
                                    <p>Имя пользователя: <?php echo $item->user->username ?></p>
                                    <p>Телефон для связи: <?php echo $item->user->phone ?></p>
                                    <p>Эл.почта для связи: <?php echo $item->user->email ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <div style="width: 100%; height: 25px;"></div>
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
