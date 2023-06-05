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
      <div class="uk-form-row">
          <?php echo $form->field($model,'title')->dropDownList(array(''=>'-Título-','Sr.'=>'Sr.','Sra.'=>'Sra.'),array('class' =>'uk-form-width-medium'))->label(false);?>
       </div>
       <div class="uk-form-row">
          <?php echo $form->field($model,'name')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Nombre')))->label(false);?>
      </div>
       <div class="uk-form-row">
          <?php echo $form->field($model,'country')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','País')))->label(false);?>
      </div>
       <div class="uk-form-row">
          <?php echo $form->field($model,'phone')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Teléfono')))->label(false);?>
      </div>
       <div class="uk-form-row">
          <?php echo $form->field($model,'email')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Email')))->label(false);?>
      </div>
       <div class="uk-form-row">
          <?php echo $form->field($model,'confirmemail')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Confirmar email')))->label(false); ?>
      </div> 
     <div class="uk-form-row">
      <?php 
       echo $form->field($model,'mess')->textarea(array("class"=>"uk-form-width-medium","rows"=>"13","placeholder"=>"Ingresar tu pregunta aquí."))->label(false);
       ?>
    </div>
    <div class="uk-form-row uk-container-center">
          <?php echo $form->field($model,'verifyCode')->widget(Captcha::className(),array('imageOptions'=>['alt'=>'Captcha'],'template' =>'<div class="captchacode"><div class="col-lg">{input}</div><div class="col-lg">{image}</div></div>'))->label(false); ?>
     </div>
     <?php $model->cat_id = $cat_id;
           echo $form->field($model,'cat_id')->hiddenInput()->label(false);?>
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