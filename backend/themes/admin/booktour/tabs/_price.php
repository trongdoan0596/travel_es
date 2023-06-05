<?php
use dosamigos\ckeditor\CKEditor;
?>
<div class="control-group">
        <div class="controls">
          <?php 
           echo $form->field($model,'price_include')->widget(CKEditor::className(),array( 
                       'options' => array('rows' =>6),
                       'preset' => 'base', //advanced basic standard full
                       'clientOptions' => array(
                            'filebrowserUploadUrl' =>'../site/uploadimg'
                        )
                     ));
           ?> 
        </div>
</div>
<div class="control-group">
        <div class="controls">
          <?php 
           echo $form->field($model,'price_not_include')->widget(CKEditor::className(),array( 
                       'options' => array('rows' =>6),
                       'preset' => 'base', //advanced basic standard full
                       'clientOptions' => array(
                            'filebrowserUploadUrl' =>'../site/uploadimg'
                        )
                     ));
           ?> 
        </div>
</div>