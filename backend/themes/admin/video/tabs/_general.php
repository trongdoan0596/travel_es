<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;
?>
<div class="uk-grid">
    <div class="uk-width-1-3">
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
               <div class="control-group">
                    <div class="controls" >
                        <?php echo $form->field($model,'featured')->dropDownList(array(0 => 'No',1 => 'Yes'));?>
                    </div>
                </div>
                
    </div>
    <div class="uk-width-1-3">
                <div class="control-group">
                        <div class="controls">
                            <?php echo $form->field($model,'url')->textInput(array('class' =>'form-control'));?>
                        </div>
               </div>
                <div class="control-group">
                    <div class="controls" >
                        <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
                    </div>
                </div>
               <div class="control-group">
                    <div class="controls" >
                        <?php echo $form->field($model,'ordering')->textInput(array('class' => 'form-control')); ?>
                    </div>
                </div>  
                     
    </div>
     <div class="uk-width-1-3">
           <div class="control-group">
                         <div class="controls">
                         <?php echo $form->field($model,'img')->fileInput(); ?>
                          <?php if ($model->img) { ?>
                            <img width="75" height="75" src="<?php echo $model->getImg($model); ?>"  />
                        <?php } ?>
                      </div>
            </div>   
            <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'position')->textInput(array('class' => 'form-control')); ?>
                </div>
            </div>  
     </div>
</div>
<div class="control-group">
        <div class="controls">
           <?php echo $form->field($model,'embedcode')->textarea();?>
        </div>
</div>
