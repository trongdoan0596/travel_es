<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\ContactForm;     
use yii\captcha\Captcha;  
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_contact'));?>
<div id="main" class="main-content">
      <div class="boxcontactus">  
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
         <div class="introtxt">
         <?php echo Yii::t('app', 'Si tienes alguna pregunta o información adicional, por favor que nos envíes un email a');?>: <b><a href="mailto:es@authentiktravel.com" class="fixhover">es@authentiktravel.com</a></b>, <?php echo Yii::t('app', 'o simplemente completa el siguiente formulario. Tu solicitud será procesada lo antes posible');?>.
<?php echo Yii::t('app','En caso de requerir la propuesta hecha a medida, por favor hagas');?> <a href="https://authentiktravel.es/proponer-tu-plan-de-viaje" class="fixhover"><b>clik aquí</b></a>
          </div>       
        <div class="boxaddress">
            <h2>Authentik Travel</h2>
            <font class="title"><?php echo Yii::t('app','Dirección');?>: </font><?php echo Yii::t('app','3 Phan Huy Ich, Nguyen Trung Truc, Distrito Ba Dinh, Ha Noi, Vietnam (4ª planta)');?>. 
              <br />
            <font class="title"><?php echo Yii::t('app','Tel');?>  : </font>+84 (0) 24 39 27 11 99 <br />+84 (0) 24 62 90 55 99<br />
            <font class="title"><?php echo Yii::t('app','Cell');?>  : </font>+84 (0) 98 6 51 76 39 (Whatsapp/viber)<br />
            <font class="title"><?php echo Yii::t('app','Skype');?>  : </font><a href="skype:sales@authentiktravel.com?call">sales@authentiktravel.com</a> <br />
            <font class="title"><?php echo Yii::t('app','Email');?>  : </font><a href="mailto:sales@authentiktravel.com">sales@authentiktravel.com</a><br />
            <font class="title"><?php echo Yii::t('app','Website');?>: </font><a href="https://authentiktravel.com">authentiktravel.com</a>
         </div>
         <div class="boxaddress" style="padding-top:20px;">
              <h2><?php echo Yii::t('app','Hora de trabajo');?>:</h2>
               <font class="title"><?php echo Yii::t('app','Lunes a Viernes');?>:</font> 	8h30 AM a 6 PM <br />
               <font class="title"><?php echo Yii::t('app','Sábado');?>: </font>	8h30 AM a 12 PM
         </div>  
         <hr />
          <div style="text-align: left; padding-bottom: 20px;color:#8a8a8a;">
          * <?php echo Yii::t('app','Campos obligatorios');?> 
          </div> 
        
        <div class="infomation">
                    <h2><?php echo Yii::t('app','Tu información');?></h2>
                    <?php if(Yii::$app->session->getFlash('msg')):?>                    
                            <div class="uk-alert uk-alert-success" data-uk-alert="">
                                <a class="uk-alert-close uk-close"></a>
                                <p><?php echo Yii::$app->session->getFlash('msg'); ?></p>
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
                    <div class="uk-form-row" style="text-align: left;">
                        <select name="ContactForm[slcgender]" id="contactform-slcgender">
                             <option value="">---<?php echo Yii::t('app', 'Género');?>---</option>
                             <option value="<?php echo Yii::t('app', 'Sr.');?>"><?php echo Yii::t('app', 'Sr.');?></option>
                             <option value="<?php echo Yii::t('app', 'Sra.');?>"><?php echo Yii::t('app', 'Sra.');?></option>
                        </select>
                    </div>                         
                      <div class="uk-form-row">
                                <?php echo $form->field($model,'title')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Nombre completo')))->label(false);?>
                      </div>
                       <div class="uk-form-row">
                                <?php echo $form->field($model,'nationality')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Tu nacionalidad')))->label(false);?>
                      </div>
                      <div class="uk-form-row">
                                <?php echo $form->field($model,'phone')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Tu número de teléfono')))->label(false);?>
                      </div>
                      <div class="uk-form-row">
                                <?php echo $form->field($model,'email')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Email')))->label(false);?>
                      </div>
                      <div class="uk-form-row">
                                <?php echo $form->field($model,'confirmemail')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Confirmar email')))->label(false);?>
                      </div>
                      <div class="uk-form-row">
                                <?php echo $form->field($model,'skype')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Cuenta de Skype')))->label(false);?>
                      </div>
                       <div class="uk-form-row">
                                <?php echo $form->field($model,'whatsapp')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Tu Whatsap')))->label(false);?>
                      </div>
                      <div class="uk-form-row">
                                <?php echo $form->field($model,'viber')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Tu viber')))->label(false);?>
                      </div>
                      <div class="uk-form-row" style="text-align: left;">
                               <label class="control-label" for="contactform-contact-title"><?php echo Yii::t('app', '¿Qué manera de comunicación prefieres ?');?></label><br />
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
                                <?php echo $form->field($model,'contacttxt')->textarea(array('class' =>'uk-form-width-medium','rows' =>2,'placeholder'=>Yii::t('app','Tu disponibilidad para conversar con nosostros via Skype/teléfono')))->label(false);?>
                      </div>
                      <div class="uk-form-row">
                             <?php echo $form->field($model,'subject')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Sujeto')))->label(false);?>
                        </div>
                      <div class="uk-form-row">
                               <?php echo $form->field($model,'mess')->textarea(array('class' =>'uk-form-width-medium','rows' =>6,'placeholder'=>Yii::t('app','Ingresar tu texto aquí').' ... '))->label(false);?>
                      </div>
                      <div class="uk-form-row" style="text-align: left;padding-left: 0px;margin-left: -14px;">
                               <?php echo $form->field($model,'verifyCode')->widget(Captcha::className(),array('imageOptions'=>array('alt'=>'Captcha'),'template' =>'<div class="captchacode" align="center"><div class="col-lg">{input}</div><div class="col-lg">{image}</div></div>'))->label(false); ?>
                     <div style="white-space: nowrap;padding-left:10px;padding-right: 5px;margin-top:0px;"><?php echo Yii::t('app','Tienes que escribir los caracteres de la imagen en el cuadro de texto');?></div>
                      </div>
                      <div class="uk-form-row">
                               <?php echo Html::submitButton(Yii::t('app','Enviar').'  <i class="uk-icon-angle-double-right"></i>',array('class' =>'uk-button sendcontact', 'name' => 'sendcontact')) ?>
                      </div>                                                              
              <?php ActiveForm::end(); ?>
           </div>
           <br />
         <div class="mapcontact" style="text-align: center !important;">
                 <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" height="320" src="https://maps.google.com/maps?hl=vi&q=Số 3 Phan Huy Ích, Nguyễn Trung Trực, Ba Đình, Hà Nội&ie=UTF8&t=roadmap&z=15&iwloc=B&output=embed"></iframe>
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