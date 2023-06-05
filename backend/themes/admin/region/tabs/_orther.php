<?php
use dosamigos\ckeditor\CKEditor;
?>
<div class="controls">
     <?php echo $form->field($model,'introtxt')->textarea();?>   
 </div>
 <div class="controls">
  <?php
      echo $form->field($model,'fulltxt')->widget(CKEditor::className(),array( 
       'options' => array('rows' =>8),
       'preset' => 'fulltxt', //advanced basic standard full
       'clientOptions' => array(
            'filebrowserUploadUrl' =>'../site/uploadimg'
        )));        
   ?>           
 </div>

