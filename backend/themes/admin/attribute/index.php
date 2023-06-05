<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Attribute;
?>
<h1 class="title-page">Attribute Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('attribute/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridAttributelID',// ID to grid wrapper
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',              
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
                'label'=>'Code',
                'attribute' => 'code',              
            ),
            array(
                'label'=>'Frontend input',
                'attribute' => 'frontend_input',              
            ),
            array(
                'label'=>'Default value',
                'attribute' => 'default_value',              
            ),
            array(
                'label'=>'Type',
                'attribute' => 'type', 
                'format'   => 'raw',
                'filter'=>Attribute::getAllType(),
                'value'    =>function($data) {
                   return Attribute::getType($data->type);
                }, 
            ),
          
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'filter'=>Attribute::getAllStatus(),  
                'value'    =>function($data) {
                   return Attribute::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
               
             array(
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{update} {delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'uk-table uk-table-hover uk-table-striped uk-table-condensed'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>