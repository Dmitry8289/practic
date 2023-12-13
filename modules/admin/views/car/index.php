<?php

use app\models\Car;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Админ-панель | Автомобили');
?>
<div class="car-index p-3 d-flex flex-column align-items-center">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить машину'), ['create'], ['class' => 'btn btn-send p-2']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'brand',
            'model',
            'year',
            'plate_number',
            //'vin',
            //'user_id',
            //'owner_id',
            //'engine_litre',
            //'oil_type',
            //'horse_power',
            //'status',
            //'image',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Car $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
