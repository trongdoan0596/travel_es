<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Category;
?>
<h1 class="title-page">Category Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(     
                array('label' => 'Add new', 'url' => array('category/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs tabnew'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridCateID',// ID to grid wrapper   
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
                'label'=>'Parent',
                'attribute' => 'parent_id',
                'headerOptions' =>array('style'=>'width:20%;'),
                'filter'=>$allcate,
                'value' =>function($data) {
                    return $data->getNameCate($data->parent_id);
                },
            ),
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:8%;'),
                'value'    =>function($data) {
                   return Category::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),    
            array(
                  'class' => 'yii\grid\ActionColumn',
                  'headerOptions' =>array('style'=>'width:3%;text-align: center;'),
                  'template' => '{delete}',
             ), 
        ),
       'tableOptions' =>array('class' => 'uk-table uk-table-hover uk-table-striped uk-table-condensed'),
       'pager' =>array(       
          'options' =>array(//'tag' => 'div',
                'class' => 'uk-pagination',
               // 'id' => 'pager-container',
            ),
     ),
));
?>