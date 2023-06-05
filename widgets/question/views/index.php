<?php
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm; 
$form = ActiveForm::begin(array(
    'id' => 'frmquestion',
    'enableClientValidation'=>true,
    'validateOnSubmit' => true, // this is redundant because it's true by default
    'options' =>array(
                    'class' => 'uk-form',
                   // 'enctype' => 'multipart/form-data'
      )
));
?>
<?php if(Yii::$app->session->getFlash('msg')):?>                    
    <div class="uk-alert uk-alert-success" data-uk-alert="">
        <a class="uk-alert-close uk-close"></a>
        <p><?php echo Yii::$app->session->getFlash('msg'); ?></p>
    </div>                        
<?php endif; ?>
<div class="boxquestion">
    <h3><?php echo Yii::t('app', 'Enviar tu pregunta');?></h3>
    <div class="uk-grid">
        <div class="uk-width-1-2">
              <div class="uk-form-row">
                  <?php echo $form->field($model,'title')->dropDownList(['Sr'=>'Sr.','Sra'=>'Sra.'],['class' =>'uk-form-width-mini']);?>
               </div>
               <div class="uk-form-row">
                  <?php echo $form->field($model,'name')->textInput(['class' =>'uk-form-width-medium']);?>
              </div>
               <div class="uk-form-row">
                  <?php echo $form->field($model,'country')->textInput(['class' =>'uk-form-width-medium']);?>
              </div>
               <div class="uk-form-row">
                  <?php echo $form->field($model,'phone')->textInput(['class' =>'uk-form-width-medium']);?>
              </div>
               <div class="uk-form-row">
                  <?php echo $form->field($model,'email')->textInput(['class' =>'uk-form-width-medium']);?>
              </div>
               <div class="uk-form-row">
                  <?php echo $form->field($model,'confirmemail')->textInput(['class' =>'uk-form-width-medium']);?>
              </div>
              <div class="uk-form-row">
                  <?php echo $form->field($model,'verifyCode')->widget(Captcha::className(),['imageOptions'=>['alt'=>'Captcha'],'template' =>'<div class="captchacode"><div class="col-code">{input}</div><div class="col-img">{image}</div></div>']); ?>
              </div>
              <div class="uk-form-row">
                  <?php
                   $model->cat_id = $cat_id;
                   echo $form->field($model,'cat_id')->hiddenInput()->label(false);?>
              </div>              
        </div>
        <div class="uk-width-1-2">
          <?php 
           echo $form->field($model,'mess')->textarea(array("rows"=>"13","style"=>"100%","placeholder"=>"Ingresar tu pregunta aquí."));
           ?>
        </div>
    </div>    
    <div class="control-group">
        <div class="controls" style="text-align: center !important;">
           <?php echo Html::submitButton(Yii::t('app', 'Enviar').' <i class="uk-icon-angle-double-right"></i>',array('class' =>'uk-button sendcontact', 'name' => 'sendquestion')) ?>
        </div>
    </div>
    <br />
</div>
<?php
ActiveForm::end();
?>  