<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use dosamigos\datepicker\DatePicker;
?>
<div class="uk-grid">
    <div class="uk-width-1-3">
            <div class="controls" >
                <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
            </div>          
    </div>
    <div class="uk-width-1-3">           
            <div class="controls" >
                <?php echo $form->field($model,'send_mail')->dropDownList(array(0 => 'No',1 => 'Yes'));?>
            </div>           
    </div> 
     <div class="uk-width-1-3">         
            <div class="controls" >
               <?php echo $form->field($model, 'create_date')->widget(DatePicker::className(),[
                                 'options' =>['placeholder' => 'Trouble date'],
                                 'template' => '{input}{addon}',
                                                        'clientOptions' =>[
                                                            'autoclose' => true,
                                                            'format' =>'yyyy-mm-dd',//2017-09-01 19:04:50
                                                            'todayHighlight' => true,
                                                            'todayBtn' => true,
                                                        ]
                     ]) ;?>   
            </div>          
    </div>   
</div>    
<div class="control-group">
    <div class="controls">
       <?php  echo $form->field($model,'message')->widget(CKEditor::className(),array( 
                   'options' => array('rows' =>6),
                   'preset' => 'base', //advanced basic standard full
                   'clientOptions' => array(
                        'filebrowserUploadUrl' =>'../site/uploadimg'
                    )
                 ));
       ?> 
    </div>
</div>