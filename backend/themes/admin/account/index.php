<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use app\models\Account;
?>
<h1 class="title-page">Account Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('account/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));

echo $this->render('_search', ['model' => $dataProvider->getModels()]); 

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
                'attribute' => 'first_name',              
            ),
             array(
                'attribute' => 'last_name',              
            ),
            array(
                'attribute' => 'email',                  
                'label'=>'E-mail',
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->email!=''){
                        return Html::mailto($data->email,$data->email);
                    }else{
                        return '-No-';
                    }
                     
                },            
            ),
            array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'value'    =>function($data) {
                    return Account::getStatus($data->status);
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
                'attribute' => 'created',              
              ), 
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