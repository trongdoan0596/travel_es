<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Video;
//use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('app','Video Manager');?></h1>
<?php
echo Menu::widget(array(
    'items'=>array(     
               array('label' => 'Add new', 'url' => array('video/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs tabnew'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridVideoID',// ID to grid wrapper   
    //'showFooter' => true,  
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
               'label'=>'Url',
               'format' => 'raw',
               'value'=>function ($data) {
                     return Html::a(Html::encode($data->url),array('id'=>$data->id,'update'));
                },
            ),
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;'),    
                'filter'=>Video::getAllStatus(),
                'value'    =>function($data) {
                    return Video::getStatus($data->status);
                },                           
            ),    
            array(
                'attribute' => 'position',
                'label'=>'Position show home',
                'format' => 'raw',
                'value'=>function ($data) {
                      return Html::a(Html::encode($data->position != 9999 ? $data->position : null),array('id'=>$data->id,'update'));
                 },
             ),
            array(
                 'class' => 'yii\grid\ActionColumn',
                 'headerOptions' =>array('style'=>'width:3%;text-align: center;'),
                 'template' =>'{delete}',
             ), 
        ),
     'tableOptions' =>array('class' => 'table table-striped table-bordered'),
     'pager' =>array(
        //'firstPageLabel' => 'first',
        //'lastPageLabel' => 'last',
       // 'prevPageLabel' => 'previous',
       // 'nextPageLabel' => 'next',
       // 'maxButtonCount' => 3,
        //'linkOptions' => array('class' => 'mylink'),
        //'activePageCssClass' => 'myactive',
        //'disabledPageCssClass' => 'mydisable',      
        //'prevPageCssClass' => 'mypre',
       // 'nextPageCssClass' => 'mynext',
       // 'firstPageCssClass' => 'myfirst',
       // 'lastPageCssClass' => 'mylast',
          'options' =>array(//'tag' => 'div',
                'class' => 'uk-pagination',
               // 'id' => 'pager-container',
            ),
     ),

));
?>