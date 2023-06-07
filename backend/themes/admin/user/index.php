<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use app\models\User;
?>
<h1 class="title-page">User Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('user/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    //'filterModel' => $model,
    'id'=>'gridUserlID',// ID to grid wrapper
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',              
            ),
            array(
               'attribute' => 'username',
               'label'=>'Username',
               'format' => 'raw',
               'value'=>function ($data) {
                     return Html::a(Html::encode($data->username),array('id'=>$data->id,'update'));
                },
            ),
            array(
                'attribute' => 'fullname',              
            ),
            array(
                'attribute' => 'email',              
            ),
            array(
                'label'=>'Role',
                'attribute' => 'role', 
                'format'   => 'raw',
                'value'    =>function($data) {
                    return User::getRole($data->role);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
            array(
                'attribute' => 'ip',              
            ),
            array(
                'attribute' => 'last_update',              
            ),
            array(
                'attribute' => 'created',              
            ),   
             array(
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'table table-striped table-bordered'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),
));
?>