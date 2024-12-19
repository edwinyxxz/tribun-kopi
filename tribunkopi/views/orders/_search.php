<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OrdersSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_transaksi') ?>

    <?= $form->field($model, 'payment') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'subtotal') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'id_menu') ?>

    <?php // echo $form->field($model, 'id_kasir') ?>

    <?php // echo $form->field($model, 'id_customer') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
