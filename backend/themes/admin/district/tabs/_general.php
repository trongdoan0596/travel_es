<?php
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
?>
<table width="100%">
    <tr>
        <td width="50%" valign="top">
          
<div class="control-group">
    <?php //$form->field($model,'title')->textInput()->label('title'); ?>
    <div class="controls">
        <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
        <?php //echo $form->error($model, 'name', array('class' => 'alert alert-error')); ?>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <?php
        echo $form->field($model,'region_id')->dropDownList(ArrayHelper::map($regions, 'id', 'title'),array('prompt'=>'-Choose a Region-'));
       ?>
    </div>
 </div> 
<div class="control-group">
    <div class="controls" >
        <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
    </div>
</div>
 </td>
 <td width="50%" valign="top">
       
         
        </td>
    </tr>
</table>     