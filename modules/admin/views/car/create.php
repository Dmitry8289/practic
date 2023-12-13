<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Car $model */

$this->title = Yii::t('app', 'Добавить машину');
?>
<div class="car-create p-3 d-flex flex-column align-items-center">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
