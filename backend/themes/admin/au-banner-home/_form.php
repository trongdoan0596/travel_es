<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AuBannerHome */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="au-banner-home-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->radioList([
            1 => 'Hiển thị', 
            2 => 'Ẩn'
        ]); ?>

    <?= $form->field($model, 'path')->fileInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
