<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Booktour;
use common\models\Tourcate;
use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('app','Book Tour Manager');?></h1>
<?php
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridBookTourID',// ID to grid wrapper
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
                'headerOptions' =>array('style'=>'width:20%;'),  
                'filter'=>ArrayHelper::map($catetour,'id','title'),
                'value'=>function ($data) {
                     return Tourcate::getNameTourCate($data->cat_id);
                },         
            ),
            array(                
                'label'=>'Create Date',
                'attribute' =>'create_date',
                'headerOptions' =>array('style'=>'width:15%;'),  
            ),            
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;'), 
                'filter'=>Booktour::getAllStatus(),        
                'value'    =>function($data) {
                    return Booktour::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
            array(
                'attribute' => 'ip',
            ),
            array(
                'label' => 'Device',
                'attribute' => 'is_mobile',
                'value' => function($data) {
                    if($data->is_mobile == 0)
                        return 'Web';
                    else if($data->is_mobile == 1)
                        return 'Mobi';
                    else
                        return 'Tablet';
                }
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
                  'template' => '{delete}',//{update} 
             ),
        ),
         'tableOptions' =>array('class' => 'table table-striped table-bordered'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>