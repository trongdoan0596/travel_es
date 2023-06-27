<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AuBannerHome */

$this->title = Yii::t('app', 'Create Au Banner Home');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Au Banner Homes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="au-banner-home-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
