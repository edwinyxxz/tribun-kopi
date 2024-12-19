<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Kasir $model */

$this->title = 'Create Kasir';
$this->params['breadcrumbs'][] = ['label' => 'Kasirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kasir-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
