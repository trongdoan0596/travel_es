<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use dosamigos\datepicker\DatePicker;
?>
<div class="uk-grid">
    <div class="uk-width-1-3">
           <div class="control-group">
                <div class="controls">
                 <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>  
            <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
                </div>
            </div>
             <div class="control-group">
                <div class="controls">
                    <?php
                      echo $form->field($model,'country_id')->dropDownList(ArrayHelper::map($country, 'id','name'),array('onchange'=>'selected_country(this.value)','prompt'=>'-Choose a Country-'));
                    ?>
                </div>
            </div>
    </div>
    <div class="uk-width-1-3">
           <div class="control-group">
                <div class="controls">
                 <?php echo $form->field($model,'profession')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>   
             <div class="control-group">
                    <div class="controls" style="width: 300px;">
                    <label for="account-address" class="control-label">Birtday</label>
                      <?php 
                        echo DatePicker::widget(array(
                            'model' => $model,
                            'attribute' => 'birtday',
                            'template' => '{input}{addon}',
                            //'language' => 'fr',
                            'clientOptions' =>array(
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            )
                        ));
                     ?>
                    </div>
              </div>
    </div>
    <div class="uk-width-1-3">
      <div class="control-group">
                <div class="controls">
                 <?php echo $form->field($model,'ordering')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>  
            <div class="control-group">         
                  <div class="controls">
                     <?php echo $form->field($model,'img')->fileInput(); ?>
                      <?php if ($model->img) { ?>
                        <img src="<?php echo $model->getImg($model); ?>" width="65" height="65"  />
                    <?php } ?>
                </div>
           </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
     <?php echo $form->field($model,'introtxt')->textarea();?>   
    </div>
</div>
<div class="control-group">
      <div class="controls">
       <?php
                  echo $form->field($model,'fulltxt')->widget(CKEditor::className(),array( 
                   'options' => array('rows' =>6),
                   'preset' => 'base', //advanced basic standard full
                   'clientOptions' => array(
                        'filebrowserUploadUrl' =>'../site/uploadimg'
                    )));        
               ?> 
   </div>
 </div>