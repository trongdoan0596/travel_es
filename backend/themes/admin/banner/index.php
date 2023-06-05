<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
//use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
/* echo Breadcrumbs::widget(array(
        'homeLink' => array(
        'label' => 'Home',
        'url' => Yii::$app->getHomeUrl() . 'index.php?r=banner/index'),
        //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : '#', 
    ));
    */
?>
<h1 class="title-page">Quản lý Banner</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('banner/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'columns' => array(
            array(
                'attribute' => 'id',              
            ),
            array(
               'attribute' => 'name',
               'label'=>'Title',
               'format' => 'raw',
               'value'=>function ($data) {
                     return Html::a(Html::encode($data->name),array('id'=>$data->id,'update'));
                },
            ),
             array(
               'attribute' => 'type',
               'label'=>'Kiểu',
               //'filter'=>$model->getAllStatus(), 
            ),
            
             array('class' => 'yii\grid\ActionColumn'),
        ),
         'tableOptions' =>array('class' => 'uk-table uk-table-hover uk-table-striped uk-table-condensed'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>