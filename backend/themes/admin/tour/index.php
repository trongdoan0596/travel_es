<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Tour;
use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('appbk','Tour Manager');?></h1>
<?php Pjax::begin(); ?>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('tour/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridHotelID',// ID to grid wrapper
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
                'label'=>'Category Tour',
                'attribute' =>'cat_id',     
                'format' => 'raw',
                'filter'=>ArrayHelper::map($catetour,'id','title'),
                'headerOptions' =>array('style'=>'width:15%;'),
                'value'=>function ($data) {
                    if(!empty($data->tourcate)){
                        return $data->tourcate->title;
                    }else{
                        return '-No-';
                    }

                },         
            ),
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:5%;'),
                'filter'=>Tour::getAllStatus(),        
                'value'    =>function($data) {
                    return Tour::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
           /* array(
                'label'=>'Show Tour',
                'attribute'=>'is_tour',
                //'filter'=>array("ID1"=>"Name1","ID2"=>"Name2"),
                //'filter'=>ArrayHelper::map(Country::find()->asArray()->all(), 'ID', 'Name'),
                'filter' => true,
                'format'   => 'raw',
                'value'    =>function($data) {
                    return Country::getShowtour($data->is_tour);
                },                
    	     ), 
             */           
             array(
                  'class' => 'yii\grid\ActionColumn',
                  'headerOptions' =>array('style'=>'width:3%;text-align: center;'),
                  'template' => '{delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'table table-striped table-bordered'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>
<?php Pjax::end(); ?>