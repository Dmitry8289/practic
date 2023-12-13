<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\RegisterForm $model */

use app\assets\AppAsset;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

$this->title = 'Регистрация';

AppAsset::register($this);

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
                    'id' => 'register-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]); ?>

                <?= $form->field($model, 'name')->textInput() ?>
                <?= $form->field($model, 'surname')->textInput() ?>
                <?= $form->field($model, 'patronymic')->textInput() ?>
                <?= $form->field($model, 'email')->textInput() ?>
                <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, ['mask' => '+7 (999) 999-99-99']) ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                <?= $form->field($model, 'passport_number')->textInput(['placeholder' => 'В формате 00 00 000000']) ?>

                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-send', 'style' => 'padding: 8px;', 'name' => 'login-button']) ?>
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