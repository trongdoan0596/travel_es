<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
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
                <?php echo $form->field($model,'possitionsname')->textInput();?>
                </div>
            </div>  
    </div>
    <div class="uk-width-1-3">
            <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls" >
                    <?php 
                     echo $form->field($model,'country_id')->dropDownList(ArrayHelper::map($allcountry, 'id', 'name'),array('prompt'=>'---Choose a Country---'));
                    ?>
                </div>
            </div>
    </div>
     <div class="uk-width-1-3">
        <div class="control-group">         
              <div class="controls">
                 <?php echo $form->field($model,'img')->fileInput(); ?>
                  <?php if ($model->img) { ?>
                    <img src="<?php echo $model->getImg(); ?>" width="90" height="90"  />
                <?php } ?>
            </div>
       </div>
    </div>
</div>
<div class="control-group">
      <div class="controls">
       <?php
                  echo $form->field($model,'introtxt')->widget(CKEditor::className(),array( 
                   'options' => array('rows' =>4),
                   'preset' => 'base', //advanced basic standard full
                   'clientOptions' => array(
                        'filebrowserUploadUrl' =>'../site/uploadimg'
                    )));        
               ?> 
   </div>
 </div>