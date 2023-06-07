<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Article;
//use yii\helpers\ArrayHelper;
?>
<h1 class="title-page"><?php echo Yii::t('app','Article Manager');?></h1>
<?php
echo Menu::widget(array(
    'items'=>array(     
               array('label' => 'Add new', 'url' => array('article/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs tabnew'),
));
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridArticleID',// ID to grid wrapper   
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
                'label'=>'Category',
                'attribute' =>'cat_id',     
                'format' => 'raw',
                'headerOptions' =>array('style'=>'width:25%;'),    
                'filter'=>$cate,//ArrayHelper::map($cate,'id','title'),
                'value'=>function ($data) {
                    if(!empty($data->category)){
                        return $data->category->title;
                    }else{
                        return '--No--';
                    }
                     
                },         
            ),
             array(
                'label'=>'Status',
                'attribute' => 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:6%;'),    
                'filter'=>Article::getAllStatus(),
                'value'    =>function($data) {
                    return Article::getStatus($data->status);
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