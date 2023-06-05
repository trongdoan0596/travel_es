<?php
//use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Review;
?>
<table width="100%">
   <tr>
      <td  width="40%" valign="top">
            <div class="control-group">
                <div class="controls">
                 <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control','style'=>"width:460px !important;"));?>
                </div>
            </div>   
             <div class="controls">
                 <?php echo $form->field($model,'alias')->textInput(array('class' =>'form-control','style'=>"width:460px !important;"));?>
                </div>
      </td>
      <td  width="20%" valign="top">  
    		  <div class="controls" id="accountid">
              <?php
               echo $form->field($model,'user_id')->dropDownList($account,array('prompt'=>'-Choose a Username-'));
              ?>
    		  </div>
          </div>
           <div class="controls" style="width:150px !important;" >
                    <?php echo $form->field($model,'vote')->dropDownList(Review::getAllVote());?>
           </div>
       </td>
      <td valign="top" style="padding-left: 50px;">             
            <div class="control-group">
                <div class="controls" style="width:150px !important;" >
                    <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
                </div>
            </div>
      </td>
      <td  width="20%" valign="top">
          <div class="controls" style="padding-bottom: 14px;width:220px !important;">
                <label for="booktourform-start_date" class="control-label">Last update</label>
                 <?php echo DatePicker::widget(array(
                        'model' =>$model,
                        'attribute' =>'last_update',
                        'template' => '{input}{addon}',
                            'clientOptions' => array(
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            )
                    ));
                    ?>
          </div>          
      </td>
   </tr>
</table>
<div class="control-group">
    <div class="controls">
        <?php echo $form->field($model,'img[]')->fileInput(array('multiple'=>'multiple')); ?>        
       <table>
       <tr>   
        <?php
        if(!empty($itemimg)){
              foreach($itemimg as $row){                          
                  //$img = $row->img;
                  echo '<td  align="center" id="itemimg'.$row->id.'">';
                  echo Html::img('../../media/itemimgs/250_160/'.$row->img,array('style'=>'width:150px;height:120px;padding: 10px;'));
                  echo '<br /><a href="#" onclick="delItemimg('.$row->id.');" >Delete</a>';
                  echo '</td>';                
              }           
        }
        ?>
          </tr>
       </table>
    </div>
</div>  
<div class="control-group">
    <div class="controls">
     <?php echo $form->field($model,'introtxt')->textarea();?>   
    </div>
</div>
<div class="control-group">
      <div class="controls">
       <?php
                  echo $form->field($model,'fulltxt')->widget(CKEditor::className(),array( 
                   'options' => array('rows' =>8),
                   'preset' => 'full', //advanced basic standard full
                   'clientOptions' => array(
                        'filebrowserUploadUrl' =>'../site/uploadimg',
                        'extraPlugins' => 'justify,iframe,flash'
                    )));        
       ?> 
   </div>
 </div>
 <script>
 function delItemimg(item_id) {
        var url    = "<?php echo Url::to(array('review/delitemmg'));?>";
        var ext_id = '<?php echo $model->id;?>';     
        var r = confirm("Do you really want to delete that record ?");
        if (r == true) {       
        		$.ajax({
        				type: "POST",
        				url:url,
        				data: ({"item_id":item_id,"ext_id":ext_id}),
        				dataType: "json"			
        				}).done(function( data ) {                                            
                               if(data['error']==1){
                                  $("#itemimg"+item_id).hide();
                               }                                
                              			
        				});
       }
}
function SetImgDefault(item_id){    
   $("#imgdefault>img").removeClass("slced");
   $("#itemid_"+item_id).addClass("slced");    
   $("#review-img_default").val(item_id);
}
 </script>