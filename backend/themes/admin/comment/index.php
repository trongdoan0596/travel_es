<?php
use yii\grid\GridView;
//use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\helpers\Html;
use common\models\Comment;
use yii\helpers\ArrayHelper;
?>
<h1 class="title-page">Comment Manager</h1>
<?php
echo Menu::widget(array(
    'items'=>array(  
                array('label' => 'Add new', 'url' => array('comment/create')),
               //array('label' => 'Login', 'url' =>array('site/login'), 'visible' => Yii::$app->user->isGuest),
    ),
    'options'=>array('class'=>'nav nav-tabs'),
));
?>

<button class="btn btn-danger delete_list_cm my-3" style="width: max-content">Delete</button>

<?php
echo GridView::widget(array(
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'id'=>'gridComment',// ID to grid wrapper
    'columns' => array(    
            //array('class' => 'yii\grid\SerialColumn'),
            ['class' => 'yii\grid\CheckboxColumn'],
            array(
                'attribute' => 'id',  
                'headerOptions' =>array('style'=>'width:6%;text-align:center;'),
            ),  
            array(
                 'attribute' => 'title',  
                 'label'=>'Title',
                 'headerOptions' =>array('style'=>'text-align:center;'),
                 'format' => 'raw',
                 'value'=>function ($data) {
                     return Html::a(Html::encode($data->title),array('id'=>$data->id,'update'));
                },
            ),           
            array(
                 'attribute' => 'type',  
                 'label'=>'Type',
                 'headerOptions' =>array('style'=>'width:5%;text-align:center;'),
                 'format' => 'raw',
            ),
            array(
                 'attribute' => 'ext_id',  
                 'label'=>'Ext ID',
                 'headerOptions' =>array('style'=>'width:10%;text-align:center;'),
                 'format' => 'raw',
            ), 
             array(
                 'attribute' => 'comment_id',  
                 'label'=>'Comment ID',
                 'headerOptions' =>array('style'=>'width:10%;text-align:center;'),
                 'format' => 'raw',
            ),       
             array(
                 'attribute' => 'ip',  
                 'label'=>'IP',
                 'headerOptions' =>array('style'=>'width:10%;text-align:center;'),
                
            ),   
             array(
                 'attribute' => 'create_date',  
                 'label'=>'Create Date',
                 'headerOptions' =>array('style'=>'width:15%;text-align:center;'),
                 'format' => 'raw',
            ),            
            array(
                'label'=>'Status',
                'attribute'=> 'status', 
                'format'   => 'raw',
                'headerOptions' =>array('style'=>'width:10%;text-align:center;'),
                'filter'   =>Comment::getAllStatus(),
                'value'    =>function($data) {
                    return Comment::getStatus($data->status);
                }, 
               // 'filter'=>array("0"=>"No","1"=>"Yes"),            
            ),
             array(
                   'headerOptions' =>array('style'=>'width:6%;'),
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{delete}',
             ),
        ),
         'tableOptions' =>array('class' => 'table table-striped table-bordered'),
         'pager' =>array('options' =>array('class' => 'uk-pagination')),        
));
?>

<script>
    $(document).ready(function(){
        $(document).on('click','.delete_list_cm', function(){
            var list_id = $('#gridComment').yiiGridView('getSelectedRows');
            console.log(list_id.length)
            if(list_id.length > 0){
                if(confirm("Bạn có trắc chắn muốn xóa comment?")){
                    $.ajax({
                        url: '/backend/comment/index',
                        type: 'post',
                        data: {delete_list_id:list_id},
                        success: function(data) {                 
                            if(data == 1){
                                location.reload();
                            }else{
                                alert('Có lỗi vui lòng thử lại!')
                            }
                        }
                });
                }
                else{
                    return false;
                }
            }else{
                alert('Bạn chưa chọn comment!')
            }
            console.log(list_id)
        });
    });
</script>