<?php

use app\models\Kasir;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\KasirSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kasirs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kasir-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Kasir', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_kasir',
            'namaKasir',
            'alamat',
            'noTelp',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Kasir $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_kasir' => $model->id_kasir]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
