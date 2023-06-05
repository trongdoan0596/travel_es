<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Category;
?>
<h1 class="title-page">Menu Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('menu/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
//$a = $allmenu;
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' =>$model,
    'id'=>'gridMenuAdminID',// ID to grid wrapper
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
                'attribute' => 'url', 
                'headerOptions' =>array('style'=>'width:15%;'),                 
            ),
             array(
                'label'=>'Status',
                'attribute' =>'status', 
                'filter'=>array("0"=>"Hide","1"=>"Show"),
                //'filter'=>ArrayHelper::map(Model::find()->asArray()->all(), 'ID', 'Name'),
                'format'   => 'raw',
                'value'    =>function($data) {
                   $type_tmp = array(0 => 'Hide',1 => 'Show');
                   return $type_tmp[$data->status];
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
             array(
                'label'=>'Type',
                'attribute' => 'type', 
                'format'   => 'raw',
                'filter'=>array('1'=>'Article','2'=> 'Article Category','3'=> 'Tour','4'=> 'Tour Category','5'=>'Blog Category'),
                'value'    =>function($data) {
                    $type_tmp =array(''=>'No Type','1'=>'Article','2'=>'Article Category','3'=>'Tour','4'=>'Tour Category','5'=>'Blog Category');
                   return $type_tmp[$data->type];
                }, 
            ),
           array(
                'label'=>'Menu',
                'attribute' =>'cate_id', 
                'format'   => 'raw',
                'filter'=>array('1'=>'Menu Top','2'=>'Menu Left','3'=>'Menu Right','4'=>'Menu Footer','5'=>'Blog'),
                'value'    =>function($data) {
                    $type_tmp = array(''=>'No position','1'=>'Menu Top','2'=>'Menu Left','3'=>'Menu Right','4'=>'Menu Footer','5'=>'Blog');
                   return $type_tmp[$data->cate_id];
                }, 
            ),          
            array(
                'label'=>'Parent',
                'attribute' => 'parent_id',     
                'filter'=>$allmenu,
                'value'   =>function($data) {                   
                       return $data->getNameMenu($data->parent_id);
                },       
            ),       
             array(
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'uk-table uk-table-hover uk-table-striped uk-table-condensed'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>