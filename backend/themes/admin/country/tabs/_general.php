<?php
use dosamigos\ckeditor\CKEditor;
?>
<div class="uk-grid">
    <div class="uk-width-1-3">  
        <div class="controls">
            <?php echo $form->field($model,'name')->textInput(array('class' =>'form-control'));?>       
        </div>
    </div>
     <div class="uk-width-1-3">  
        <div class="controls" >
        <?php echo $form->field($model,'is_tour')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
       
    </div>
    </div>
     <div class="uk-width-1-3">  
        <div class="controls">
             <?php echo $form->field($model,'ordering')->textInput(array('class' =>'form-control'));?>     
        </div>
    </div>
</div>    
   <div class="controls" >
        <?php echo $form->field($model,'introtxt')->textarea(array('maxlength' => 300, 'rows' => 5, 'cols' =>60));?>
    </div>
<script>CKEDITOR.config.extraPlugins = 'spoiler';</script>
 
    <div class="controls" >
 <?php  echo $form->field($model,'fulltxt')->widget(CKEditor::className(),array( 
           'options' => array('rows' =>6),
           'preset' => 'full', //advanced basic standard full
           'clientOptions' => array(
                'filebrowserUploadUrl' =>'../site/uploadimg'
            )
         ));
  ?>
</div>

