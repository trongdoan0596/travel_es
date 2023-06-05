<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
?>
<div class="uk-grid">
    <div class="uk-width-1-2">
                   <div class="control-group">
                        <div class="controls">
                            <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
                        </div>
                    </div>
                     <div class="control-group">
                        <div class="controls">
                            <?php echo $form->field($model,'alias')->textInput(array('class' =>'form-control'));?>
                        </div>
                    </div>
            
                     <div class="control-group">
                    <div class="controls" >
                        <?php echo $form->field($model,'featured')->dropDownList(array(0 => 'No',1 => 'Yes'));?>
                    </div>
                </div>
                    <div class="control-group">
                         <div class="controls">
                         <?php echo $form->field($model,'img')->fileInput(); ?>
                          <?php if ($model->img) { ?>
                            <img width="75" height="75" src="<?php echo $model->getImg($model); ?>"  />
                        <?php } ?>
                      </div>
            </div>   
    </div>
    <div class="uk-width-1-2">
              <div class="control-group" id="cityid">
            		  <div class="controls">
                      <?php
                       echo $form->field($model,'cat_id')->dropDownList($allcate,array('prompt'=>'-Choose a Category-'));
                      ?>
            		  </div>
                </div>
                <div class="control-group">
                    <div class="controls" >
                        <?php echo $form->field($model,'status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
                    </div>
                </div>
                 <div class="control-group">
                    <div class="controls" >
                        <?php echo $form->field($model,'ordering')->textInput(array('class' => 'form-control')); ?>
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
       <?php  echo $form->field($model,'fulltxt')->widget(CKEditor::className(),array( 
                   'options' => array('rows' =>6),
                   'preset' => 'full', //advanced basic standard full
                   'clientOptions' => array(
                        'filebrowserUploadUrl' =>'../site/uploadimg',
                        'extraPlugins' => 'justify,iframe,flash'
                    )
                 ));
       ?> 
    </div>
</div>