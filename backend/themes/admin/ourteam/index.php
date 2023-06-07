<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Ourteam;
use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('app','Ourteam Manager');?></h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('ourteam/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridOurteamID',// ID to grid wrapper
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
                'label'=>'Ordering',
                'attribute' => 'ordering',                
                'headerOptions' =>array('style'=>'width:5%;')
            ), 
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;'), 
                'filter'=>$model->getAllStatus(),        
                'value'    =>function($data) {
                    return $data->getStatus($data->status);
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