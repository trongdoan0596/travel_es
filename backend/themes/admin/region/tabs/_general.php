<?php
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
?>
<div class="uk-grid">
    <div class="uk-width-1-4">  
                <div class="controls">
                    <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
                </div>   
                <div class="controls" >
                    <?php echo $form->field($model,'is_filter')->dropDownList(array(0 => 'No',1 => 'Yes'));?>       
                </div>         
    
    </div>
    <div class="uk-width-1-4">
        <div class="controls">
            <?php
            echo $form->field($model,'country_id')->dropDownList(ArrayHelper::map($country, 'id', 'name'),array('prompt'=>'-Choose a Country-'));
             ?>
         </div>         
       <div class="controls">
                     <?php echo $form->field($model,'img')->fileInput(); ?>
                      <?php if ($model->img!='') { ?>
                        <img width="180" height="180" src="<?php echo $model->getImg($model); ?>"  />
                    <?php } ?>
        </div>
    </div>
  <div class="uk-width-1-4">
      <div class="controls" >
           <?php echo $form->field($model,'is_tour')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>                    
      </div>
  </div> 
  <div class="uk-width-1-4">
      <div class="controls" >
         <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
     </div>
  </div> 
</div>
