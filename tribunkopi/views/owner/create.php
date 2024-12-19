<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Owner $model */

$this->title = 'Create Owner';
$this->params['breadcrumbs'][] = ['label' => 'Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="owner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
