<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContactForm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contact-form-form w-50">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Создать'), ['class' => 'btn btn-send']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
