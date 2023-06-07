<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Itemimg;
?>
<h1 class="title-page">Image Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('itemimg/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridItemimglID',// ID to grid wrapper
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',           
                'headerOptions' =>array('style'=>'width:5%;'),       
            ),
            array(
               'attribute' => 'img',
               'label'=>'Image',
               'format' => 'raw',
               'value'=>function ($data) {                    
                    return Html::img('../../media/itemimgs/250_160/'.$data->img,array('style'=>'width: 180;height: 120;'));
                    // return Html::a(Html::encode('<img src= />',array('id'=>$data->id,'update'));
                },
            ),
            array(
                'attribute' => 'title',      
                'headerOptions' =>array('style'=>'width:25%;'),        
            ),
             array(
                'attribute' => 'type',      
                'headerOptions' =>array('style'=>'width:10%;'),  
                'format'   => 'raw', 
                'filter'=>Itemimg::getAllType(),
                'value'   =>function($data) {
                    return Itemimg::getType($data->type);
                },      
            ), 
            array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:6%;'),
                'filter'=>Itemimg::getAllStatus(),
                'value'    =>function($data) {
                    return Itemimg::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
           array(
                  'class' => 'yii\grid\ActionColumn',
                  'headerOptions' =>array('style'=>'width:3%;'),
                  'template' => '{update}   {delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'table table-striped table-bordered'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>