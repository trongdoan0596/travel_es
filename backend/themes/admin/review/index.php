<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Review;
use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('app','Review Manager');?></h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('review/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs tabnew'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridReviewID',// ID to grid wrapper
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
                'label'=>'User',
                'attribute' => 'user_id',     
                'headerOptions' =>array('style'=>'width:15%;'),  
                'format' => 'raw',
                'value'=>function ($data) {
                    if(!empty($data->account)){                        
                        return Html::a(Html::encode($data->account->first_name.' '.$data->account->last_name),array('id'=>$data->user_id,'account/update'),array('target'=>'_blank'));
                    }else{
                        return "--No--";
                    }
                },  
            ),
            array(
                'attribute' => 'last_update',     
                'headerOptions' =>array('style'=>'width:15%;'),          
            ),
            array(
                'attribute' => 'create_date',     
                'headerOptions' =>array('style'=>'width:15%;'),          
            ),
             array(
                'label'=>'Status',
                'attribute'=> 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;'), 
                'filter'   => Review::getAllStatus(),        
                'value'    =>function($data) {
                    return Review::getStatus($data->status);
                },
            ),            
             array(
                  'class' => 'yii\grid\ActionColumn',
                  'headerOptions' =>array('style'=>'width:3%;'), 
                  'template' => '{delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'uk-table uk-table-hover uk-table-striped uk-table-condensed'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>