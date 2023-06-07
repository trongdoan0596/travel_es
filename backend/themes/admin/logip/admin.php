<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Blog;
//use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('app','Log Manager');?></h1>
<?php
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridLogID',// ID to grid wrapper   
    //'showFooter' => true,  
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',  
                'headerOptions' =>array('style'=>'width:5%;'),            
            ),
            array(
               'attribute' => 'username',
               'label'=>'Username',
              /// 'format' => 'raw',
             //  'value'=>function ($data) {
               //      return Html::a(Html::encode($data->username),array('id'=>$data->id,'update'));
              //  },
            ),
            array(
                'attribute' => 'type',  
                'headerOptions' =>array('style'=>'width:6%;'),            
            ),
            array(
                'attribute' => 'id_ext',  
                'headerOptions' =>array('style'=>'width:8%;'),            
            ),
            array(
                'attribute' => 'item_id',  
                'headerOptions' =>array('style'=>'width:5%;'),            
            ),
             array(
                'attribute' => 'action',  
                'headerOptions' =>array('style'=>'width:8%;'),            
            ),
             array(
                'attribute' => 'controller',  
                'headerOptions' =>array('style'=>'width:8%;'),            
            ),
           array(
                'attribute' => 'data',  
                'headerOptions' =>array('style'=>'width:15%;'),            
            ),
            array(
                'attribute' => 'ip',  
                'headerOptions' =>array('style'=>'width:8%;'),            
            ),
            array(
                'attribute' => 'created_at',  
                'headerOptions' =>array('style'=>'width:10%;'),            
            ),
            array(
                  'class' => 'yii\grid\ActionColumn',
                   'headerOptions' =>array('style'=>'width:3%;text-align: center;'),
                  'template' => '{delete}',
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