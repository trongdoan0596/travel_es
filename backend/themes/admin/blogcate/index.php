<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Blogcate;
?>
<h1 class="title-page">Blog Category Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(     
                array('label' => 'Add new', 'url' => array('blogcate/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs tabnew'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridBlogcateID',// ID to grid wrapper   
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
                'headerOptions' =>array('style'=>'width:15%;'),    
                'filter'=>$allcate,
                'value' =>function($data) {                   
                        return $data->getCatBlog($data->parent_id);                  
                },       
            ),  
             array(
                'label'=>'Path',
                'attribute' => 'path', 
                'headerOptions' =>array('style'=>'width:15%;'), 
            ),               
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;'),           
                'value'    =>function($data) {
                   return Blogcate::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),    
            array(
                  'class' => 'yii\grid\ActionColumn',
                   'headerOptions' =>array('style'=>'width:3%;text-align: center;'),
                  'template' => '{delete}',
             ), 
        ),
       'tableOptions' =>array('class' => 'table table-striped table-bordered'),
       'pager' =>array(       
          'options' =>array(//'tag' => 'div',
                'class' => 'uk-pagination',
               // 'id' => 'pager-container',
            ),
     ),
));
?>