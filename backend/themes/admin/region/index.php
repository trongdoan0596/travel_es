<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Region;
use common\models\Country;
use yii\helpers\ArrayHelper;
?>
<h1 class="title-page">Region Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('region/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridRegionID',// ID to grid wrapper
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',
                'headerOptions' =>array('style'=>'width:5%;'),
            ),
            array(
               'attribute' => 'title',
               'label'=>'Name',
               'format' => 'raw',
               'value'=>function ($data) {
                     return Html::a(Html::encode($data->title),array('id'=>$data->id,'update'));
                },
            ),
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;'),
                'filter'=>Region::getAllStatus(),
                'value'    =>function($data) {
                    return Region::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
            array(
                'label'=>'Show Tour',
                'attribute'=>'is_tour',
                'headerOptions' =>array('style'=>'width:10%;'),
                'filter'=>Region::getAllShowtour(),
                'format'   => 'raw',
                'value'    =>function($data) {
                    return Region::getShowtour($data->is_tour);
                },
    	     ), 
            array(
                'label'=>'Country',   
                'attribute' =>'country_id',
                'headerOptions' =>array('style'=>'width:10%;'),
                'format' => 'raw',
                'filter'=>ArrayHelper::map($countrys,'id', 'name'),
                'value'=>function ($data) {
                     return $data->country->name;
                },         
            ),   
             
             array(
                  'class' => 'yii\grid\ActionColumn',
                  'headerOptions' =>array('style'=>'width:3%;text-align: center;'),
                  'template'=>'{delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'uk-table uk-table-hover uk-table-striped uk-table-condensed'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>