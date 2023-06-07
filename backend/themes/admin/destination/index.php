<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Destination;
use yii\helpers\ArrayHelper;
use common\models\Country;
?>
<h1 class="title-page"><?php echo Yii::t('app','Destination Manager');?></h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('destination/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridDestinationID',// ID to grid wrapper
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',     
                'headerOptions' =>array('style'=>'width:5%;'),          
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
               'attribute' => 'possitionsname',
               'label'=>'Possitions name',
               'format' => 'raw',
               'headerOptions' =>array('style'=>'width:15%;'), 
               'value'=>function ($data) {
                     return $data->possitionsname;
                },
            ),
              array(
               'attribute' => 'country_id',
               'label'=>'Country ID',
               'format' => 'raw',
               'headerOptions' =>array('style'=>'width:15%;'), 
               'value'=>function ($data) {
                     return Country::getName($data->country_id);
                },
            ),
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;'), 
                'filter'=>Destination::getAllStatus(),        
                'value'    =>function($data) {
                    return Destination::getStatus($data->status);
                },
            ),            
             array(
                  'class' => 'yii\grid\ActionColumn',
                  'headerOptions' =>array('style'=>'width:3%;'), 
                  'template' => '{delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'table table-striped table-bordered'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>