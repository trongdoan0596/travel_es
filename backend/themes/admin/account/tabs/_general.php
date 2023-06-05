<?php
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
?>
<div class="uk-grid">
    <div class="uk-width-1-3">
     <div class="control-group">
             <div class="controls">
               <?php 
              // if($model->id>0){
                //  echo $form->field($model,'username')->textInput(array('disabled'=>"",'class' =>'form-control'));
              // }else{
                  echo $form->field($model,'username')->textInput(array('class' =>'form-control'));
              // }
               ?>
             </div>
        </div>

         <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'password_hash')->passwordInput(array('class' =>'form-control'));?>
                </div>
        </div>
         <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'first_name')->textInput(array('class' =>'form-control'));?>
                </div>
        </div>
         <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'last_name')->textInput(array('class' =>'form-control'));?>
                </div>
        </div>
           <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'phone')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
             <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'email')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
             <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'gender')->dropDownList($model->getAllGender());?>
                </div>
            </div>
    </div>
    <div class="uk-width-1-3">
       <div class="control-group">
                    <div class="controls" style="width: 300px;">
                    <label for="account-address" class="control-label">Birtday</label>
                      <?php 
                        echo DatePicker::widget(array(
                            'model' => $model,
                            'attribute' => 'birtday',
                            'template' => '{input}{addon}',
                            //'language' => 'fr',
                            'clientOptions' =>array(
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            )
                        ));
                     ?>
                    </div>
              </div>
             <div class="control-group">
                <div class="controls">
                    <?php
                      echo $form->field($model,'country_id')->dropDownList(ArrayHelper::map($country, 'id','name'),array('onchange'=>'selected_country(this.value)','prompt'=>'-Choose a Country-'));
                    ?>
                </div>
            </div>
            <div class="control-group" id="regionid">
				  <div class="controls">
                   <?php
                      echo $form->field($model,'region_id')->dropDownList(ArrayHelper::map($regionarray, 'id','title'),array('prompt'=>'-Choose a Region-'));
                    ?>                   
				  </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'address')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'code_postal')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
             <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'passport')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'gender_ext')->dropDownList($model->getAllGenderExt(),array('prompt'=>'-Choose a Gender Ext-'));?>
                </div>
            </div>
    </div>
     <div class="uk-width-1-3">
        <div class="control-group">
                <div class="controls">
                    <?php
                      echo $form->field($model,'live_country_id')->dropDownList(ArrayHelper::map($country, 'id','name'),array('onchange'=>'selected_livecountry(this.value)','prompt'=>'-Choose a Country-'));
                    ?>
                </div>
            </div>
            <div class="control-group" id="regionid">
				  <div class="controls">
                   <?php
                      echo $form->field($model,'live_region_id')->dropDownList(ArrayHelper::map($regionarray, 'id','title'),array('prompt'=>'-Choose a Region-'));
                    ?>                   
				  </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'live_address')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
             <div class="control-group">
                <div class="controls" id="avataimg">
                     <?php echo $form->field($model,'img')->fileInput(); ?>
                      <?php if ($model->img) { ?>
                        <img width="75" height="75" src="<?php echo $model->getImg($model); ?>"  /><br /><br />
                       <span style="cursor: pointer;text-align: center;padding-left:30px;" onclick="DeleAvatar(<?php echo $model->id;?>);" class="glyphicon glyphicon-trash"></span>
                    <?php } ?>
                </div>
            </div>
    </div>
</div>
<script type="text/javascript">
    var region_id ='<?php echo $model->region_id?>';
    var live_region_id ='<?php echo $model->live_region_id?>';
    var list='<?php echo addslashes(json_encode($regionarray));?>';
    list=eval('('+list+')');
    function selected_country(value){       
        var select = document.getElementById("account-region_id");
        if(value>0){
           var str = '<option value="0" selected="selected">-- Select Region--</option>';
            for(var i in list[value]){	 
			   if(region_id== i){				 		
			     str = str + '<option value="'+i+'" selected="selected">'+list[value][i]+'</option>';
				 }else{
                 str = str + '<option value="'+i+'">'+list[value][i]+'</option>';
				}
             
            }
            select.innerHTML=str;
        }else{
            alert('You must Select country name!');
            return false;
        }
    }
    <?php if($model->country_id>0){
       ?>
        selected_country(<?php echo $model->country_id;?>);				   
   <?php
   }		   
   ?>
   function selected_livecountry(value){       
        var select = document.getElementById("account-live_region_id");
        if(value>0){
           var str = '<option value="0" selected="selected">-- Select Region--</option>';
            for(var i in list[value]){	 
			   if(live_region_id== i){				 		
			     str = str + '<option value="'+i+'" selected="selected">'+list[value][i]+'</option>';
				 }else{
                 str = str + '<option value="'+i+'">'+list[value][i]+'</option>';
				}
             
            }
            select.innerHTML=str;
        }else{
            alert('You must Select country name!');
            return false;
        }
    }
    <?php if($model->live_country_id>0){
       ?>
        selected_livecountry(<?php echo $model->live_country_id;?>);				   
   <?php
   }
   		   
   ?>
function DeleAvatar(id){
     if(id<=0){
          alert('Error ID!');
          return false;          
      }
      var r = confirm("Do you really want to delete that avatar ?");
      if (r == true) {              
               var Url = "<?php echo Url::to(array('account/delavatar'));?>";
               $.ajax({
            			type: "POST",
            			url: Url,
            			data: ({"id":id}),
            			dataType: "json"			
            			}).done(function( data ) {	
                            if(data['error'] ==1){
                                //$("#day_"+id).hide();  
                                $("#avataimg").html('');
                            }
            				
            	        });
       } else {
            return false;
      }
}   
 </script>    