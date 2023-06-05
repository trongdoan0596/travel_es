<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Products;
//use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('app','Alias Url Manager');?></h1>
<?php
echo GridView::widget(array(
    'dataProvider' => $data,
    'filterModel' => $model,
    'id'=>'gridAliasUrlID',
    //'showFooter' => true,  
    'columns' => array(    
           //array('class' => 'yii\grid\SerialColumn'),
            array(
                'attribute' => 'id',  
                'headerOptions' =>array('style'=>'width:5%;'),            
            ),
            array(
               'attribute' => 'alias',
               'label'=>'Alias',
               'format' => 'raw',
               'value'=>function ($data) {
                     return Html::a(Html::encode($data->alias),array('id'=>$data->id,'update'));
                },
            ),
        array(
            'attribute' => 'controller',
            'headerOptions' =>array('style'=>'width:10%;'),
        ),
        array(
            'attribute' => 'action',
            'headerOptions' =>array('style'=>'width:10%;'),
        ),
        array(
            'attribute' => 'ext_id',
            'headerOptions' =>array('style'=>'width:10%;'),
        ),
        array(
            'attribute' => 'type',
            'headerOptions' =>array('style'=>'width:10%;'),
        ),
        array(
              'class' => 'yii\grid\ActionColumn',
               'headerOptions' =>array('style'=>'width:3%;text-align: center;'),
              'template' => '{delete}',
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