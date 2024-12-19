<?php  

use yii\helpers\Html;  
use yii\widgets\ActiveForm;  

/** @var yii\web\View $this */  
/** @var app\models\Orders $model */  
/** @var yii\widgets\ActiveForm $form */  
?>  

<div class="orders-form">  

    <?php $form = ActiveForm::begin(); ?>  

    <?= $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>  

    <!-- <?= $form->field($model, 'tanggal')->textInput() ?> -->  

    <!-- <?= $form->field($model, 'subtotal')->textInput() ?> -->  

    <div class="form-row">  
        <div class="form-group col-md-6">  
            <?= $form->field($model, 'id_menu')->textInput(['maxlength' => true]) ?>  
        </div>  
        <div class="form-group col-md-6">  
            <?= $form->field($model, 'jumlah')->textInput() ?>  
        </div>  
    </div>  

    <?= $form->field($model, 'id_kasir')->textInput() ?>  

    <?= $form->field($model, 'id_customer')->textInput() ?>  

    <div class="form-group">  
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>  
    </div>  

    <?php ActiveForm::end(); ?>  

</div>  

<style>  
.form-row {  
    display: flex;  
    justify-content: space-between;  
    margin-bottom: 20px; /* Jarak antar baris jika perlu */  
}  
.form-group {  
    flex: 1;  
    margin-right: 10px; /* Jarak antar kolom */  
}  
.form-group:last-child {  
    margin-right: 0; /* Menghapus margin pada kolom terakhir */  
}  
</style>