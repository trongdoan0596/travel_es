<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\District;
use common\models\Region;
use yii\helpers\ArrayHelper;
?>
<h1 class="title-page">District Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('district/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridDistrictID',// ID to grid wrapper
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',
                'headerOptions' =>array('style'=>'width:3%;'),
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
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                 'headerOptions' =>array('style'=>'width:10%;'),
                'filter'=>District::getAllStatus(),
                'value'    =>function($data) {
                    return District::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
           
            array(
                'label'=>'Region',   
                'attribute' =>'region_id',  
                'format' => 'raw',
                'headerOptions' =>array('style'=>'width:20%;'),
                'filter'=>ArrayHelper::map($regions,'id', 'title'),
                'value'=>function ($data) {
                     return $data->region->title;
                },         
            ),   
             
             array(
                  'class' => 'yii\grid\ActionColumn',
                  'headerOptions' =>array('style'=>'width:3%;'),
                  'template' =>'{delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'uk-table uk-table-hover uk-table-striped uk-table-condensed'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>