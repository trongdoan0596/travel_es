<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Country;
//use yii\helpers\ArrayHelper;
?>
<h1 class="title-page">Country Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('country/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridCountryID',// ID to grid wrapper
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',
                'headerOptions' =>array('style'=>'width:5%;'),
            ),
            array(
               'attribute' => 'name',
               'label'=>'Name',
               'format' => 'raw',
               'value'=>function ($data) {
                     return Html::a(Html::encode($data->name),array('id'=>$data->id,'update'));
                },
            ),
            array(
                'label'=>'Show Tour',
                'attribute'=>'is_tour',
                'filter'=>array("0"=>"Hide","1"=>"Show"),
                'headerOptions' =>array('style'=>'width:10%;'),
                'format'   => 'raw',
                'value'    =>function($data) {
                    return Country::getShowtour($data->is_tour);
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