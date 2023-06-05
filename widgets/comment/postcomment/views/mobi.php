<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use common\models\CommentForm;
$model = new CommentForm();
$request = Yii::$app->request;
?>
<div class="boxcoment">
    <h2 class="title"> <?php echo Yii::t('app','Comentarios');?></h2>
    <div id="errorcomment" class="uk-alert uk-text-center" style="display: none;"><i class="uk-icon-spinner uk-icon-spin uk-icon-medium" style="color:#009349;"></i></div>
            <?php $form  = ActiveForm::begin(
                              array(
                                'id' => 'commentfrm',
                                'action' =>Url::toRoute(array('comment/savecm')),
                                'method'=>'post',
                                //'enableAjaxValidation'=>true,
                                'enableClientValidation'=>true,
                                'validateOnSubmit' => true,
                                //'validationUrl'  => Url::toRoute(array('validateform')),
                                'options' =>array(
                                        'class' => 'uk-form'
                                 )
                               )
                     ); 
               ?>
               <div class="uk-grid">
                        <div class="uk-width-1-1">
                                <div class="uk-form-row">
                                <?php echo $form->field($model,'message')->textarea(array('style' =>'width: 100%;','rows' =>8,'placeholder'=>Yii::t('app','Escribir tu mensaje aquí').' ... '));?>
                                </div>                        
                        </div>
                        <div class="uk-width-1-1">
                                 <div class="uk-form-row">
                                        <?php echo $form->field($model,'fullname')->textInput(array('class' =>'uk-form-large','placeholder'=>Yii::t('app','Nombre completo')));?>
                                 </div>
                                 <div class="form-group">
                                        <?php echo $form->field($model,'youremail')->textInput(array('class' =>'uk-form-large','placeholder'=>Yii::t('app','Tu email')));?>
                                 </div>
                                 <div class="uk-form-row">  
                                  <?php echo $form->field($model,'verifyCode')->widget(Captcha::className(),array('imageOptions'=>array('alt'=>'Captcha'),'template' =>'<div class="captchacode" align="center"><div class="col-lg">{input}</div><div class="col-lg">{image}</div></div>')); ?>
                                  <div style="margin-top:-10px;"><?php echo Yii::t('app','Debes escribir los caracteres de la imagen en el cuadro de texto');?></div>
                                 </div>  
                        </div>                   
                </div>
                  <?php
                      $model->ext_id = $ext_id;
                      $model->type   = $type;
                      $model->url    = substr($request->url, 1);
                      echo $form->field($model,'type')->hiddenInput()->label(false);
                      echo $form->field($model,'ext_id')->hiddenInput()->label(false);
                      echo $form->field($model,'url')->hiddenInput()->label(false);
                      ?>
                      <div align="center">
                      <?php
                       echo Html::Button('<i class="uk-icon-edit"></i> '.Yii::t('app','Añadir comentarios'),array('class' =>'btn btn-warning btncomment','name' =>'sendcomment','id' =>'sendcomment'));
                      ?>
                      </div>
           <?php ActiveForm::end(); ?>  
</div> 
<script>
$("#sendcomment").click(function() {
        var form = $("#commentfrm");
        if(form.find('.has-error').length) {
              return false;
        }
        $("#errorcomment").show();
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(data) {                 
                 if(data['error']==0){
                    //error                  
                     var rows = JSON.parse(JSON.stringify(data['data']));
                     var str ='';
                     for (var i in rows){                        
                       str +='<br />'+rows[i];
                     }                         
                     $("#errorcomment").addClass("uk-alert-danger");     
                     $("#errorcomment").html(str).show();                     
                 }else{
                     $("#commentform-message").val("");
                     $("#commentform-fullname").val("");
                     $("#commentform-youremail").val("");
                     $("#commentform-verifycode").val("");
                     $("#errorcomment").removeClass("uk-alert-danger");
                     $("#errorcomment").addClass("uk-alert-success");     
                     $("#errorcomment").html(data['msg']).show();
                 }
                   
            }
    });
    //alert( "Handler for .click() called." );
});
</script>