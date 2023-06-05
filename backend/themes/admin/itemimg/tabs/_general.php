<?php
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
?>
<div class="uk-width-1-2">
    <div class="control-group">
         <div class="controls">
           <?php            
              echo $form->field($model,'title')->textInput(array('class' =>'form-control'));            
           ?>
         </div>
    </div>  
     <div class="control-group">
         <div class="controls" >
            <?php echo $form->field($model,'type')->dropDownList($model->getAllType());?>
        </div>
    </div>     
     <div class="control-group">
         <div class="controls" >
            <?php echo $form->field($model,'status')->dropDownList($model->getAllStatus());?>
        </div>
    </div>   
    <div class="control-group">
            <div class="controls">
                <?php echo $form->field($model,'img[]')->fileInput(array('class' =>'form-control','multiple'=>'multiple')); ?>
            </div>
    </div>       
 </div>