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
                    <?php 
                      echo $form->field($model,'cat_id')->dropDownList($catetour,array('prompt'=>'-Choose a Category-'));
                    ?>
                </div>
             </div>             
             <div class="control-group">
                <div class="controls">
                    <?php
                      echo $form->field($model,'start')->dropDownList(ArrayHelper::map($allcity, 'id','title'),array('prompt'=>'-Choose a Country-'));
                    ?>
                </div>
             </div>     
             <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'shorttxt')->textarea();?>         
                </div>
            </div>  
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'code')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
    
    </div>
    <div class="uk-width-1-4">
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'alias')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'num_day')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>           
           <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'featured')->dropDownList(array(0 => 'No',1 => 'Yes'));?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
                </div>
            </div>   
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'ordering')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
           
             <div class="control-group">
                <div class="controls">
                    <?php
                      $model->country_ids = explode(",", $model->country_ids);
                      echo $form->field($model,'country_ids')->checkboxList(ArrayHelper::map($country, 'id','name'));
                    ?>
                </div>
             </div> 
    
    </div>
    <div class="uk-width-1-4">
           <div class="control-group"> 
                <div class="controls">
                     <?php echo $form->field($model,'pdf')->fileInput(); ?>
                     <?php if ($model->pdf) {echo $model->pdf;} ?>
                </div>  
            </div>
            <div class="control-group">
                <div class="controls">
                      <?php echo $form->field($model,'imgmap')->fileInput(); ?>
                      <?php if ($model->imgmap) { ?>
                         <div>
                            <img id="imgmainold4" width="120" height="120" src="<?php echo $model->getImgmap($model);?>"  />
                         </div>
                         <div style="padding-left:110px;padding-top:8px;">
                            <span id="delimgmainold4" class="glyphicon glyphicon-trash" onclick="DelImgMain(<?php echo $model->id;?>,4);" style="cursor: pointer;"></span>
                         </div>
                    <?php } ?>
                </div>
            </div> 
              <div class="control-group">
                <div class="controls">
                     <?php echo $form->field($model,'img')->fileInput(); ?>
                      <?php if ($model->img) { ?>
                      <div>
                        <img id="imgmainold" width="240" height="120" src="<?php echo $model->getImg($model); ?>"  />                      
                      </div>
                       <div style="padding-left:110px;padding-top:8px;">
                        <span id="delimgmainold" class="glyphicon glyphicon-trash" onclick="DelImgMain(<?php echo $model->id;?>,'');" style="cursor: pointer;"></span>
                        </div>
                    <?php } ?>
                </div>
            </div>  
            
              
            
    </div>
    <div class="uk-width-1-4">
          <div class="control-group">
                    <div class="controls">
                         <?php echo $form->field($model,'img1')->fileInput(); ?>
                          <?php if ($model->img1) { ?>
                          <div>
                            <img id="imgmainold1" width="60" height="30" src="<?php echo $model->getImg($model,'img1',340,270); ?>"  />                      
                          </div>
                           <div style="padding-left:110px;padding-top:8px;">
                            <span id="delimgmainold1" class="glyphicon glyphicon-trash" onclick="DelImgMain(<?php echo $model->id;?>,1);" style="cursor: pointer;"></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>  
                 <div class="control-group">
                    <div class="controls">
                         <?php echo $form->field($model,'img2')->fileInput(); ?>
                          <?php if ($model->img2) { ?>
                          <div>
                            <img id="imgmainold2" width="60" height="30" src="<?php echo $model->getImg($model,'img2',430,270); ?>"  />                      
                          </div>
                           <div style="padding-left:110px;padding-top:8px;">
                            <span id="delimgmainold2" class="glyphicon glyphicon-trash" onclick="DelImgMain(<?php echo $model->id;?>,2);" style="cursor: pointer;"></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>  
                 <div class="control-group">
                    <div class="controls">
                         <?php echo $form->field($model,'img3')->fileInput(); ?>
                          <?php if ($model->img3) { ?>
                          <div>
                            <img id="imgmainold3" width="60" height="30" src="<?php echo $model->getImg($model,'img3',610,270); ?>"  />                      
                          </div>
                           <div style="padding-left:110px;padding-top:8px;">
                            <span id="delimgmainold3" class="glyphicon glyphicon-trash" onclick="DelImgMain(<?php echo $model->id;?>,3);" style="cursor: pointer;"></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
     </div>
</div>
 <div class="control-group">
        <div class="controls">
            <?php
              $model->destination_ids = explode(",",$model->destination_ids);
              echo $form->field($model,'destination_ids')->checkboxList(ArrayHelper::map($destination, 'id','title'));
            ?>
        </div>
</div> 
<div class="control-group">
        <div class="controls">
          <?php 
           echo $form->field($model,'introtxt')->widget(CKEditor::className(),array( 
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
function DelImgMain(tour_id,idimg){    
    //idimg = 1,2,3,4 = imgmap
     var pathimg   = $("#delimgmainold").attr("src");
     var r = confirm("Do you really want to delete that image ?");
      if (r == true && pathimg!='') {              
               var Url = "<?php echo Url::to(array('tour/deleimgmain'));?>";
               $.ajax({
            			type: "POST",
            			url: Url,
            			data: ({"tour_id":tour_id,"idimg":idimg}),
            			dataType: "html"			
            			}).done(function( data ) {	
                            if(data!=''){  
                                $("#imgmainold"+idimg).hide();
                                $("#delimgmainold"+idimg).hide();                    
                           }            				
            	        });
       } else {
            return false;
      }
}
</script>