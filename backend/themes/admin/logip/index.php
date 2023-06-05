<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\Blog;
//use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('app','Log IP Manager');?></h1>
<?php Pjax::begin(); ?>
<?php
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridLogIPID',// ID to grid wrapper   
    //'showFooter' => true,  
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',  
                'headerOptions' =>array('style'=>'width:5%;'),            
            ),            
            array(
                'attribute' => 'ip',  
                'format'   => 'raw',
                'value'    =>function($data) {
                    return '<a href="https://db-ip.com/'.$data->ip.'" target="_blank">'.$data->ip.'</a>';
                 },           
            ),  
            array(
                'attribute' => 'remoteip',  
                'headerOptions' =>array('style'=>'width:20%;'),  
                'format'   => 'raw',
                'value'    =>function($data) {
                    return '<a href="https://db-ip.com/'.$data->remoteip.'" target="_blank">'.$data->remoteip.'</a>';
                 },           
            ),   
             array(
                'attribute' => 'user_agent',  
                'format'   => 'raw',                       
            ),        
            array(
                'attribute' => 'created_at',  
                'headerOptions' =>array('style'=>'width:15%;'),            
            ),
            array(
                  'class'=>'yii\grid\ActionColumn',
                  'headerOptions' =>array('style'=>'width:3%;text-align: center;'),
                  'template'=>'{delete}',
             ), 
        ),
     'tableOptions' =>array('class' => 'uk-table uk-table-hover uk-table-striped uk-table-condensed'),
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
<?php Pjax::end(); ?>