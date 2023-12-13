<?php


use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

$this->title = 'Добавить автомобиль в каршеринг';
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

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'newcar-form',
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'template' => "{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'brand')->textInput(['placeholder' => 'Марка']) ?>
            <?= $form->field($model, 'model')->textInput(['placeholder' => 'Модель']) ?>
            <?= $form->field($model, 'year')->textInput(['placeholder' => 'Год выпуска']) ?>
            <?= $form->field($model, 'plate_number')->textInput(['placeholder' => 'Государственный номер']) ?>
            <?= $form->field($model, 'vin')->textInput(['placeholder' => 'VIN']) ?>
            <?= $form->field($model, 'engine_litre')->input('number', ['placeholder' => 'Рабочий объём', 'step' => 0.1]) ?>
            <?= $form->field($model, 'horse_power')->textInput(['placeholder' => 'Мощность, л.с.']) ?>
            <?= $form->field($model, 'oil_type')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Oil::find()->all(), 'id', 'type')) ?>
            <?= $form->field($model, 'image')->fileInput() ?>
            <?= $form->field($model, 'owner_id')->hiddenInput(['value' => Yii::$app->user->getId()]) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Добавить', ['class' => 'btn btn-send', 'style' => 'padding: 8px;', 'name' => 'newcar-button']) ?>
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
