<?php
use dosamigos\ckeditor\CKEditor;
?>
<div class="control-group">
        <div class="controls">
          <label for="city-title" class="control-label">Photo</label>
           <?php
            $languages = Yii::$app->params['languages'];
            while (list($k, $v) = each ($languages)){ 
                 if ($k === 'en')
                        $suffix = '';
                    else
                        $suffix = '_' . $k;
              ?>
               <label><?php echo $v; ?></label> 
                <?php  echo $form->field($model,'photo'.$suffix)->widget(CKEditor::className(),array( 
                       'options' => array('rows' =>6),
                       'preset' => 'base', //advanced basic standard full
                       'clientOptions' => array(
                            'filebrowserUploadUrl' =>'../site/uploadimg'
                        )
                     ))->label(false);
            
            }
           ?> 
        </div>
</div>