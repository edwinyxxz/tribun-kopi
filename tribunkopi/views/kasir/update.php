<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Kasir $model */

$this->title = 'Update Kasir: ' . $model->id_kasir;
$this->params['breadcrumbs'][] = ['label' => 'Kasirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kasir, 'url' => ['view', 'id_kasir' => $model->id_kasir]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kasir-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
