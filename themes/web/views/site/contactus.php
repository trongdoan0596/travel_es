<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\ContactForm;     
use yii\captcha\Captcha;  
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_contact'));?>
<div id="main" class="main-content"> 
      <div class="boxcontactus">     
          <div class="uk-container uk-container-center">  
          <?php
           echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>Yii::t('app','Contactar con nosotros'),
                                    'url' => array('site/contactus'),//, 'id' => 10
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),  
                            ),
                   ));       
           ?>        
          <h1><?php echo Yii::t('app','Contactar con nosotros');?></h1>          
          <div class="uk-grid">
                <div class="uk-width-2-3">  
                  <div class="infomation">
                    <div class="introtxt">
                    <?php echo Yii::t('app', 'Si tienes alguna pregunta o información adicional, por favor que nos envíes un email a');?>: <b><a href="mailto:es@authentiktravel.com" class="fixhover">es@authentiktravel.com</a></b> <?php echo Yii::t('app', 'o simplemente completa el siguiente formulario. Tu solicitud será procesada lo antes posible');?>.
<?php echo Yii::t('app','En caso de requerir la propuesta hecha a medida, por favor hagas');?> <a href="https://authentiktravel.es/proponer-tu-plan-de-viaje" class="fixhover"><b>clik aquí</b></a>
          </div>
          <hr />
          <div style="text-align: left; padding-bottom: 20px;color:#8a8a8a;">
          * <?php echo Yii::t('app','Campos obligatorios');?> 
          </div>
                    <?php if(Yii::$app->session->getFlash('msg')):?>                    
                            <div class="uk-alert uk-alert-success" data-uk-alert="">
                                <a class="uk-alert-close uk-close"></a>
                                <p><?php echo Yii::$app->session->getFlash('msg');?></p>
                            </div>                        
                      <?php endif; ?>
                     <?php $form = ActiveForm::begin(
                              array('id' => 'contactfrm',                                   
                                    'enableClientValidation'=>true,
                                    'validateOnSubmit' => true,
                                    'options' =>array(
                                        'class' => 'uk-form'
                                     )
                                   )
                             ); 
                      $model = new ContactForm();
                      ?>                 
                      <?php echo $form->errorSummary($model,array("id"=>"errorctid","class"=>"uk-container-center errorsummary"));?> 
                      <div class="uk-form-row">
                              <label style="padding-right: 10px;color: #4a4a4a;"><?php echo Yii::t('app', 'Género');?></label>
                                 <select name="ContactForm[slcgender]" id="contactform-slcgender">
                                    <option value="<?php echo Yii::t('app', 'Sr.');?>"><?php echo Yii::t('app', 'Sr.');?></option>
                                     <option value="<?php echo Yii::t('app', 'Sra.');?>"><?php echo Yii::t('app', 'Sra.');?></option>
                               </select>
                         </div>
                         <div class="uk-form-row">                                
                             <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control','placeholder'=>''));?> 
                         </div> 
                         <div class="uk-form-row">
                             <?php echo $form->field($model,'nationality')->textInput(array('class' =>'form-control','placeholder'=>''));?>
                         </div>
                         <div class="uk-form-row">
                              <?php echo $form->field($model,'phone')->textInput(array('class' =>'form-control'));?>
                         </div>
                         <div class="uk-form-row">
                              <?php echo $form->field($model,'email')->textInput(array('class' =>'form-control'));?>
                         </div>
                         <div class="uk-form-row">
                             <?php echo $form->field($model,'confirmemail')->textInput(array('class' =>'form-control'));?>
                         </div>
                          <div class="uk-form-row">
                             <?php echo $form->field($model,'skype')->textInput(array('class' =>'form-control'));?>
                         </div>
                         <div class="uk-form-row">
                             <?php echo $form->field($model,'whatsapp')->textInput(array('class' =>'form-control'));?>
                         </div>
                         <div class="uk-form-row">
                             <?php echo $form->field($model,'viber')->textInput(array('class' =>'form-control'));?>
                         </div>
                         <div class="uk-form-row">
                             <label class="control-label" for="contactform-contact-title"><?php echo Yii::t('app', '¿Qué manera de comunicación prefieres ?');?></label> 
                                       <?php
                                          $allcontact = $model->getAllContact();
                                             if(!empty($allcontact)){
                                                $i=1;
                                                foreach ($allcontact as $key => $value) {                                               
                                                  //  $checked="";
                                                   // if($i==1) $checked = 'checked="checked"';
                                                    ?>
                                                     <div class="radio-item muticontact">
                                                        <input data-id="0" onclick="ChangeSlc(<?php echo $key;?>,'contact');" type="radio" id="contactform-contact<?php echo $key;?>" name="ContactForm[contact<?php echo $key;?>]" value="<?php echo $key;?>" />
                                                        <label for="contactform-contact<?php echo $key;?>"><?php echo $value;?></label>
                                                     </div>
                                                    <?php
                                                    $i++;
                                               }                         
                                            }
                                      ?> 
                         </div>    
                          <div class="uk-form-row">
                              <?php echo $form->field($model,'contacttxt')->textarea(array('rows' =>2,'cols' =>50,'placeholder'=>Yii::t('app','Tu disponibilidad para conversar con nosostros via Skype/teléfono')));?>
                         </div>
                          <div class="uk-form-row">
                              <?php echo $form->field($model,'subject')->textInput(array('class' =>'form-control'));?>
                         </div>   
                         <div class="uk-form-row"> 
                         <?php echo $form->field($model,'mess')->textarea(array('rows' =>10,'cols' =>50,'placeholder'=>Yii::t('app','Ingresar tu texto aquí').' ... '));?>
                         </div>     
                         <div class="uk-form-row">  
                          <?php echo $form->field($model,'verifyCode')->widget(Captcha::className(),array('imageOptions'=>array('alt'=>'Captcha'),'template' =>'<div class="captchacode"><div class="col-code">{input}</div><div class="col-img">{image}<br /><div style="white-space: nowrap;">'.Yii::t('app','Tienes que escribir los caracteres de la imagen en el cuadro de texto').'</div></div></div>')); ?>
                         </div>   
                         <div class="control-group">
                            <div class="controls" style="text-align: center !important;">
                               <?php echo Html::submitButton(Yii::t('app','Enviar').'  <i class="uk-icon-angle-double-right"></i>',array('id' =>'idcontact','class' =>'uk-button sendcontact', 'name' => 'sendcontact')) ?>
                            </div>
                        </div>
                                           
              <?php ActiveForm::end(); ?>
                   </div>                
                 
                </div>
                <div class="uk-width-1-3" style="padding-left: 15px;">                     
                   <div class="mapcontact">
                     <div class="uk-width-1-1" style="padding: 15px;">
                        <h2>Authentik Vietnam Co.,Ltd</h2>
                         <ul class="uk-grid contactbox">
                              <li class="address-footer"><label><i class="uk-icon-home uk-icon-small"></i></label><font style="padding-left:0px;margin-top: -30px;">62 Yen Phu road, Nguyen Trung Truc ward, <br> Ba Dinh district, Ha Noi, Vietnam.</font></li>   
                              <li><label><i class="uk-icon-phone uk-icon-small"></i></label>+84 (0) 24 39 27 11 99 / <font style="padding-bottom: 10px;">+84 (0) 24 62 90 55 99</font></li> 
                              <li><label><i class="uk-icon-mobile-phone uk-icon-small"></i></label>+84912121091 (Whatsapp/viber) </li>                   
                              <li><label><a href="skype:sales@authentiktravel.com?call"><i class="uk-icon-skype uk-icon-small"></i></label>sales@authentiktravel.com</a></li>
                              <li><label><a href="mailto:es@authentiktravel.com"><i class="uk-icon-envelope-o"></i></label>es@authentiktravel.com</a></li>
                              <li><label style="float: left;"><a href="https://authentiktravel.es"><i class="internet"></i></label>www.authentiktravel.es</a></li>                            
                        </ul>                      
                     </div>
                      <div class="uk-width-1-1" style="padding: 15px;">
                      <h2><?php echo Yii::t('app','Hora de trabajo');?>:</h2>
                       <font class="title titleoffice"><?php echo Yii::t('app','Lunes a Viernes');?>:</font> 8h30 AM a 6 PM <br />
                       <font class="title titleoffice"><?php echo Yii::t('app','Sábado');?>: </font> 8h30 AM a 12 PM
                     </div> 
                     <div class="mapright">
                         <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="348"  height="344" src="https://maps.google.com/maps?hl=vi&q=Số 62 Yen Phu road, Nguyen Trung Truc ward, Ba Dinh district, Ha Noi, Vietnam&ie=UTF8&t=roadmap&z=15&iwloc=B&output=embed"></iframe>
                      </div>
                   </div>
                </div>
            </div>
          </div>
      </div>
</div>
<script language="javascript">
function ChangeSlc(id,name){
   var dataid = $("#contactform-"+name+id).attr("data-id");
   if(dataid==0){
       $("#contactform-"+name+id).attr("data-id","1");
       $("#contactform-"+name+id).attr("checked");
   }else{
       $("#contactform-"+name+id).attr("data-id","0");
       $("#contactform-"+name+id).removeAttr("checked");
   } 
}
$('#idcontact').on('click', function(e) { 
    $("#idcontact").hide().delay(3000).fadeIn();
    //e.preventDefault();
});
$('#contactfrm').on('afterValidate', function (event, messages) {
   if(typeof $('.has-error').first().offset() !== 'undefined') {        
     $("#errorctid").show();
     $('html, body').animate({scrollTop: $("#errorctid").offset().top - 100},1000);
   }
});
</script>             