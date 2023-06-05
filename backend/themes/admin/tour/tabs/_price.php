<?php
use dosamigos\ckeditor\CKEditor;
?>
<div class="uk-grid" style="padding-top: 10px;">
    <div class="uk-width-1-4">
        <div class="controls">
            <?php echo $form->field($model,'price_from')->textInput(array('class' =>'form-control'));?>
        </div>
    </div>
</div>
<div class="uk-grid" style="padding-top: 0px !important; margin-top: 0px !important;">
    <div class="uk-width-1-6">
        <div class="controls">
            <?php echo $form->field($model,'pax1')->textInput(array('class' =>'form-control'));?>
        </div>
    </div>
    <div class="uk-width-1-6">
        <div class="controls">
            <?php echo $form->field($model,'pax2')->textInput(array('class' =>'form-control'));?>
        </div>
    </div>
    <div class="uk-width-1-6">
        <div class="controls">
            <?php echo $form->field($model,'pax3')->textInput(array('class' =>'form-control'));?>
        </div>
    </div>
    <div class="uk-width-1-6">
        <div class="controls">
            <?php echo $form->field($model,'pax4')->textInput(array('class' =>'form-control'));?>
        </div>
    </div>
    <div class="uk-width-1-6">
        <div class="controls">
            <?php echo $form->field($model,'pax5')->textInput(array('class' =>'form-control'));?>
        </div>
    </div>
    <div class="uk-width-1-6">
        <div class="controls">
            <?php echo $form->field($model,'pax_single')->textInput(array('class' =>'form-control'));?>
        </div>
    </div>
</div>
<div class="controls">
  <?php 
   echo $form->field($model,'price_include')->widget(CKEditor::className(),array( 
               'options' => array('rows' =>6),
               'preset' => 'full', //advanced basic standard full
               'clientOptions' => array(
                    'extraPlugins' => 'justify,iframe,flash',
                    'filebrowserUploadUrl' =>'../site/uploadimg'
                )
             ));
   ?> 
</div>

<div class="controls">
  <?php 
   echo $form->field($model,'price_not_include')->widget(CKEditor::className(),array( 
               'options' => array('rows' =>6),
               'preset' => 'full', //advanced basic standard full
               'clientOptions' => array(
                    'extraPlugins' => 'justify,iframe,flash',
                    'filebrowserUploadUrl' =>'../site/uploadimg'
                )
             ));
   ?> 
</div>
