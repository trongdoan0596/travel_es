<?php
//use yii\helpers\Html;
//use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm; 
use yii\bootstrap\Tabs;
$form = ActiveForm::begin(array(
    'id' => 'customizefrm',
    'enableClientValidation'=>true,
    'scrollToError'=>false, // this is redundant because it's true by default  
   // 'scrollToError'=>false, 
   // 'focus'=>($model->hasErrors()) ? '.error:first' : array($model, ''),
    'options' =>array(
                    'class' => 'uk-form',
                   // 'enctype' => 'multipart/form-data'
      )
));
?>
<div id="main" class="main-content"> 
      <div class="main-customize">     
          <div class="boxcustomize">
              <div class="uk-container uk-container-center" style="padding-top:0px;">   
               <?php
                echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>'Nuestras inspiraciones',
                                    'url' =>'paquetes-de-viaje',
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),
                               //array('label' =>'Home','url' =>'#'),
                                
                            ),
                         ));                   
                 echo $form->errorSummary($model,array("id"=>"errorid","class"=>"uk-container-center errorsummary"));
                 echo $this->render('_mapcustomize',array());   
              ?>             
              </div>
          </div>
      </div>      
      <!--Tab detail -->
      <div class="tabdetailtour">
             <div class="uk-container uk-container-center">   
                 <?php
                  echo $this->render('tabs/_general', array('form'=>$form,'model'=>$model,'slccouple'=>$slccouple,'slcyear'=>$slcyear));                 
                  ?>
            </div>  
      </div>
      <!--End Tab detail -->
      
      
</div>       
<?php
ActiveForm::end();
?>
<script language="javascript">
$('#customizefrm').on('afterValidate', function (event, messages) {
   if(typeof $('.has-error').first().offset() !== 'undefined') {
     //$('html, body').animate({scrollTop: $('.has-error').first().offset().top},1000); 
     //$(window).scrollTop(top);     
     $("#errorid").show();
     $('html, body').animate({scrollTop: $("#errorid").offset().top - 100},1000);
   }
});
</script>