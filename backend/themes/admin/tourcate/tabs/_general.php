<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
?>
<div class="uk-grid">
    <div class="uk-width-1-4">
           <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'alias')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
    </div>
    <div class="uk-width-1-4">
           <div class="control-group">
            <div class="controls">
                <?php 
                  echo $form->field($model,'parent_id')->dropDownList($allcate,array('prompt'=>'-Choose a Category Tour-'));
                ?>
            </div>
         </div> 
          <div class="control-group">
                <div class="controls">
                     <?php echo $form->field($model,'img')->fileInput(); ?>
                      <?php if ($model->img) { ?>
                      <div>
                        <img id="imgmainold" width="90" height="90" src="<?php echo $model->getImg(); ?>"  />                      
                      </div>
                       <div style="padding-left:110px;padding-top:8px;">
                        <span id="delimgmainold" class="glyphicon glyphicon-trash" onclick="DelImgMain(<?php echo $model->id;?>);" style="cursor: pointer;"></span>
                       </div>
                    <?php } ?>
                </div>
            </div>  
            
    </div>
    <div class="uk-width-1-4">
       <div class="control-group">
            <div class="controls" >
                <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
            </div>
        </div>
    </div>
    <div class="uk-width-1-4">
       <div class="control-group">
            <div class="controls">
                <?php echo $form->field($model,'ordering')->textInput(array('class' =>'form-control'));?>
            </div>
        </div>
    </div>   
</div>
<!--
<div class="control-group">
    <div class="controls">
        <?php
          //echo $form->field($model,'country_id')->dropDownList(ArrayHelper::map($country, 'id','name'),array('onchange'=>'selected_country(this.value)','prompt'=>'-Choose a Country-'));
        ?>
    </div>
 </div> 
 -->
<div class="control-group">
        <div class="controls"> 
         <?php  echo $form->field($model,'introtxt')->widget(CKEditor::className(),array( 
                       'options' => array('rows' =>6),
                       'preset' => 'base', //advanced basic standard full
                       'clientOptions' => array(
                            'filebrowserUploadUrl' =>'../site/uploadimg',
                            'extraPlugins' => 'justify,iframe,flash'
                        )
                     ));
           ?> 
        </div>
</div>
<script>
function DelImgMain(id){    
    //idimg = 1,2,3,4 = imgmap
     //var pathimg   = $("#delimgmainold").attr("src");
     var r = confirm("Do you really want to delete that image ?");
      if (r == true) {              
               var Url = "<?php echo Url::to(array('tourcate/deleimgmain'));?>";
               $.ajax({
            			type: "POST",
            			url: Url,
            			data: ({"id":id}),
            			dataType: "html"			
            			}).done(function( data ) {	
                            if(data!=''){  
                                //alert('Ok');
                                $("#imgmainold").hide();
                                $("#delimgmainold").hide();
                           }          				
            	        });
       } else {
            return false;
      }
}
</script>