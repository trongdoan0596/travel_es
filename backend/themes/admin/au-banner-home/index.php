<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Au Banner Homes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="au-banner-home-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Au Banner Home'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'status',
                'value' => function ($data){
                    return $data->status == 1 ? 'Hiển thị' : 'Ẩn';
                },
            ],
            // 'type',
            [

                'attribute' => 'path',
    
                'format' => 'html',
    
                'label' => 'image/video',
    
                'value' => function ($data) {
                    // echo '<pre>';
                    // print_r($data->path);
                    // echo '</pre>';die;
                    return Html::img($data->path,array('style'=>'width: 180px;height: 120;'));

    
                },
    
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
