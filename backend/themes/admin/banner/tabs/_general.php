<?php
use yii\widgets\ActiveForm;
?>
<div class="control-group">
    <?php //echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->field($model,'name')->textInput(array('class' => 'form-control'));?>
        <?php //echo $form->error($model, 'name', array('class' => 'alert alert-error')); ?>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <?php echo $form->field($model,'url')->textInput(array('class' => 'form-control'));?>
    </div>
</div>

<div class="control-group">
        <div class="controls" >
            <?php echo $form->field($model,'type')->dropDownList(array('normal' =>'Bình thường','slide'=>'Slide'));?>
        </div>
 </div>
<div class="control-group">
        <div class="controls" >
            <?php echo $form->field($model,'status')->dropDownList($model->getAllStatus());?>
        </div>
 </div>
 <div class="control-group">
        <div class="controls" >
            <?php echo $form->field($model,'target')->dropDownList($model->getAllTarget());?>
        </div>
 </div>
 <div class="control-group">    
    <div class="controls">
        <?php echo $form->field($model,'ordering')->textInput(array('class' => 'form-control')); ?>       
    </div>
</div>
<div class="control-group">
    <?php //echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
    <div class="controls">
         <?php echo $form->field($model,'img')->fileInput() ?>
          <?php if ($model->img) { ?>
            <img src="<?php echo $model->getImg(); ?>"  />
        <?php } ?>
    </div>
</div>