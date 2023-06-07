<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Cotravel;
use yii\helpers\ArrayHelper;
?>
<h1 class="title-page">Cotravel Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('cotravel/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));

echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridCotravel',// ID to grid wrapper
    'columns' => array(    
            //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',  
                'headerOptions' =>array('style'=>'width:6%;text-align:center;'),
            ),
            array(
               'attribute' => 'title',
               'label'=>'Title',
               'format' => 'raw',
               'value'=>function ($data) {
                     return Html::a(Html::encode($data->title),array('id'=>$data->id,'update'));
                },
            ),
            array(
                'attribute' => 'numday_min',  
                 'label'=>'From',
                 'headerOptions' =>array('style'=>'width:15%;text-align:center;'),
                 'format' => 'raw',
            ),
            array(
                'attribute' => 'numday_max',  
                'label'=>'To',
                'headerOptions' =>array('style'=>'width:15%;text-align:center;'),
                'format' => 'raw',
            ),
            array(
                'label'=>'Start date',
                'attribute' => 'start_date', 
                'headerOptions' =>array('style'=>'width:15%;text-align:center;'), 
                'format' => 'raw',
            ),
             array(
                'label'=>'Status',
                'attribute'=> 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;text-align:center;'),
                'filter'   =>Cotravel::getAllStatus(),
                'value'    =>function($data) {
                    return Cotravel::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
             array(
                   'headerOptions' =>array('style'=>'width:6%;'),
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{update}  {delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'table table-striped table-bordered'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>