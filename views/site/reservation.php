<?php


use kartik\date\DatePicker;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

$this->title = 'Оформить каршеринг';
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
<div style="padding: 3%;">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля для регистрации:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'reservation-form',
                'fieldConfig' => [
                    'template' => "{input}\n{error}",
                    'labelOptions' => ['class' => 'col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'start_date')->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Дата начала аренды'], 'pluginOptions' => ['autoclose' => true]])->label('Дата начала аренды') ?>
            <?= $form->field($model, 'end_date')->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Дата окончания аренды'], 'pluginOptions' => ['autoclose' => true]])->label('Дата окончания аренды') ?>
            <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->getId()]) ?>
            <?= $form->field($model, 'car_id')->hiddenInput(['value' => $_GET['car_id']]) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Забронировать', ['class' => 'btn btn-send', 'style' => 'padding: 8px;', 'name' => 'reservation-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
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
