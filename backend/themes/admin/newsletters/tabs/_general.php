<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;
use dosamigos\datepicker\DatePicker;
?>
<div class="uk-grid">
    <div class="uk-width-1-3">
        <div class="controls">
           <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
        </div>                  
    </div>
    <div class="uk-width-1-3">              
        <div class="controls" >
           <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
        </div> 
    </div>
     <div class="uk-width-1-3">
       <div class="controls" >
           <?php echo $form->field($model,'ordering')->textInput(array('class' => 'form-control')); ?>
        </div>
     </div>
</div>
<div class="controls">
    <?php     
     $model->destination_ids = explode(",",$model->destination_ids); 
     echo $form->field($model,'destination_ids')->checkboxList(ArrayHelper::map($destination, 'id','title'));
    ?>
</div> 
<div class="control-group">
        <div class="controls">
           <?php echo $form->field($model,'introtxt')->textarea();?>
        </div>
</div>
<div class="control-group">
    <div class="controls">
       <?php  
        $urlpath  = Url::base();       
        $urlpath  = str_replace("backend", "",$urlpath);
        echo $form->field($model,'fulltxt')->widget(CKEditor::className(),array( 
                   'options' => array('rows' =>6),
                   'preset' => 'full', //advanced basic standard full
                   'clientOptions' => array(
                        'filebrowserUploadUrl' =>'../site/uploadimg',
                        'extraPlugins'=>'imgbrowse',//lineutils,image2
		                'filebrowserImageBrowseUrl'=>$urlpath.'vendor/2amigos/yii2-ckeditor-widget/src/assets/ckeditor/plugins/imgbrowse/imgbrowse.html?imgroot='.$urlpath.'media/itemimgs',
                   )
                 ));
       ?> 
    </div>
</div>
<?php echo $form->field($model,'id')->hiddenInput()->label(false);?>