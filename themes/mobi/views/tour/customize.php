<?php
//use yii\helpers\Html;
//use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm; 
use yii\bootstrap\Tabs;
$form = ActiveForm::begin(array(
        'id' =>'customizefrm',
        'enableClientValidation'=>true,
        'validateOnSubmit' => true, // this is redundant because it's true by default
        'options' =>array(
                        'class' => 'uk-form',
                       // 'enctype' => 'multipart/form-data'
        )
));
?>
<div id="main" class="main-content"> 
 <div class="boxcustomize">  
       <?php
           echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>'Nuestras inspiraciones',
                                    'url' =>'paquetes-de-viaje',
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),
                               //array('label' =>'Home',
                              //         'url' =>'#'
                              //      ),
                                
                            ),
                         ));
               //echo $this->render('_mapcustomize',array());           
           echo $form->errorSummary($model,array("id"=>"errorid","class"=>"uk-container-center errorsummary")).'<br />';     
         ?>
      <!--Tab detail -->
      <div class="tabdetailtour">
             <?php
              echo $this->render('tabs/_general', array('form'=>$form,'model'=>$model,'slccouple'=>$slccouple,'slcyear'=>$slcyear));                 
              ?>
      </div>
      <!--End Tab detail -->
  </div>    
</div>       
<?php
ActiveForm::end();
?>  
<script language="javascript">
$('#customizefrm').on('afterValidate', function (event, messages) {
   if(typeof $('.has-error').first().offset() !== 'undefined') {
     $("#errorid").show();
     $('html, body').animate({scrollTop: $("#errorid").offset().top - 100},1000);
   }
});
</script> 