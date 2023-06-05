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
    <div id="errorcomment" class="uk-alert" style="display: none;"></div>
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
                        <div class="uk-width-1-2">
                                <div class="uk-form-row">
                                <?php echo $form->field($model,'message')->textarea(array('rows' =>8,'cols' =>50,'placeholder'=>Yii::t('app','Write message here').' ... '));?>
                                </div>
                        
                        </div>
                        <div class="uk-width-1-2">
                                 <div class="uk-form-row">
                                        <?php echo $form->field($model,'fullname')->textInput(array('class' =>'form-control','placeholder'=>Yii::t('app','Full name')));?>
                                 </div>
                                 <div class="form-group">
                                        <?php echo $form->field($model,'youremail')->textInput(array('class' =>'form-control','placeholder'=>Yii::t('app','Your e-mail')));?>
                                 </div>
                                 <div class="uk-form-row">  
                                  <?php echo $form->field($model,'verifyCode')->widget(Captcha::className(),array('template' =>'<div class="captchacode"><div class="col-code">{input}</div><div class="col-img">{image}<br /><div style="white-space: nowrap;">'.Yii::t('app','You must type the characters of the image in the text box').'</div></div></div>')); ?>
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
                      <div align="left">
                      <?php
                     // echo Html::submitButton('<i class="uk-icon-edit"></i> '.Yii::t('app','Add Comment'),array('class' =>'btn btn-warning btncomment','name' =>'sendcomment')); 
                      echo Html::Button('<i class="uk-icon-edit"></i> '.Yii::t('app','Add Comment'),array('class' =>'btn btn-warning btncomment','name' =>'sendcomment','id' =>'sendcomment'));
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