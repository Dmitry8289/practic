<?php

/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'WheelDrive | Выбери свою машину';

?>
<style>
    .blog-boxes {
        display: flex;
        justify-content: center;
        align-items: baseline;
        max-width: 1080px;
    }

</style>
<div>
    <section class="blog" id="Interest">
        <div class="blog-title">
            <h2 class="fs-2"><b>это интересно</b></h2>
        </div>
        <div class="blog-boxes">
            <div class="box"><img src="../web/img/photo1.png">
                <h3 class="fs-4"><b>Коробка передач</b></h3>
                <p>Коробка передач автомобиля может иметь до 6 скоростей, что позволяет водителю выбрать оптимальную передачу для различных условий дороги и скорости движения</p>
<!--                <button class="btn-box">-->
<!--                    <p>read more</p>-->
<!--                </button>-->
            </div>

            <div class="box"><img src="../web/img/photo2.png">
                <h3 class="fs-4"><b>Самая популярная марка</b></h3>
                <p>Toyota является самой популярной маркой автомобиля в мире благодаря своему надежному качеству, инновационным технологиям и широкому модельному ряду, удовлетворяющему различные потребности покупателей</p>
            </div>

            <div class="box"><img src="../web/img/photo3.png">
                <h3 class="fs-4"><b>В чём отличие?</b></h3>
                <p>Отличие карбюратора от инжектора заключается в способе подачи топлива в двигатель: карбюратор смешивает топливо с воздухом перед поступлением в цилиндры, в то время как инжектор подает топливо непосредственно в цилиндры через форсунки</p>
            </div>

        </div>

    </section>

    <section class="contact" id="Contact">
        <div class="blog-title">
            <h2 class="fs-2"><b>связаться с нами</b></h2>
        </div>
        <div class="contact-box">
            <img src="../web/img/photo4.png" style="width: 400px!important; height: fit-content!important;">
            <div class="form-box">
                <?php $form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'fieldConfig' => [
                        'template' => "{input}\n{error}",
                        'inputOptions' => ['class' => 'col-lg-3 form-control', 'style' => 'width: 71%;'],
                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]); ?>

                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя']) ?>

                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Ваш email']) ?>
                <?= $form->field($model, 'message')->textarea(['placeholder' => 'Ваше сообщение', 'rows' => 8, 'maxlength' => 4000, 'minlength' => 40]) ?>

                <?= $form->field($model, 'rules')->checkbox([
                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>

                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-send p-2', 'name' => 'send-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
    <div style="width: 100%!important; height: 35px!important;"></div>
</div>
