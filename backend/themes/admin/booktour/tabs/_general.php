<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
?>
<div class="uk-grid">
    <div class="uk-width-1-4">
        <div class="control-group">
            <div class="controls">
                <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
            </div>
        </div>
    </div>
    <div class="uk-width-1-4">
        <div class="control-group">
            <div class="controls">
                <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
            </div>
        </div>
    </div>
</div>

<div class="control-group">
        <div class="controls">
           <?php  echo $form->field($model,'requesttxt')->widget(CKEditor::className(),array( 
                       'options' => array('rows' =>2),
                       'preset' => 'basic', //advanced basic standard full
                       'clientOptions' => array(
                            'filebrowserUploadUrl' =>'../site/uploadimg'
                        )
                     ));
              ?>
        </div>
</div>