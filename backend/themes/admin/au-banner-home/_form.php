<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AuBannerHome */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="au-banner-home-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="group_form">
        <?= $form->field($model, 'status')->dropDownList([
                '' => 'Chọn trạng thái', 
                1 => 'Hiển thị', 
                2 => 'Ẩn'
            ]); ?>
        <?= $form->field($model, 'position')->textInput(['placeholder' => 'Vị trí hiển thị']); ?>

        <?php if($model->isNewRecord) {?>
            <?= $form->field($model, 'path')->fileInput(['maxlength' => true]) ?>
        <?php } ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .form-control{
        height: auto;
    }
    .group_form{
        display: flex;
        gap: 20px;
    }
</style>