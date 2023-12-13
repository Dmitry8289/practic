<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContactForm $model */

$this->title = Yii::t('app', 'Создать новую заявку');
?>
<div class="contact-form-create p-3 d-flex flex-column align-items-center">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
