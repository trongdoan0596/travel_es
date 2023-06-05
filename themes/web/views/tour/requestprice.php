<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use app\widgets\traveller\travellerreview\Travellerreview;
use app\widgets\page\servicework\Servicework;
use common\models\Tourcate;
use app\widgets\tour\othertour\Othertour;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;  
use dosamigos\datepicker\DatePicker;
use common\helper\StringHelper;
$slccouple  = Yii::$app->request->get('slccouple',0);
$slcyear    = Yii::$app->request->get('slcyear','');
$class_ex ='';
if(!empty($model)){
    $class_ex ='slidesubbg_cate'.$model->cat_id;
}
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>$class_ex));?>
<div id="main" class="main-content"> 
      <div class="boxcontryside">     
          <div class="uk-container uk-container-center">    
            <?php    
            if(!empty($model)){
                    $cat_id = $model->cat_id;
                    $infocate = Tourcate::getDetailTourCate($cat_id);
                    $url_cate = Tourcate::createUrl($infocate);
                    echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>$infocate->title,
                                    'url' =>$url_cate,
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),
                                array('label' =>$model->title,
                                      //'url' =>array('post/edit', 'id' => 1)
                                      ),
                                
                            ),
                         ));
                     //echo $this->render('_map',array('model'=>$model,'details'=>$details));   
                     ?>
                     <?php        
                    }else{
                        echo 'Updating!';
                    }   
                ?>                      
          </div>
      </div>
<!--requestprice-->
<?php 
if($msg !=''){
    ?> 
     <div class="uk-container uk-container-center">    
        <div class="uk-alert uk-alert-success" data-uk-alert="" style="text-align: center;padding: 20px;"> 
             <a class="uk-alert-close uk-close"></a>
             <p><?php echo $msg;?></p>
        </div>
    </div>
    <?php
}
if(!empty($model)){    
    $url_tour  = $model->createUrl($model);
    $form = ActiveForm::begin(
                              array('id' => 'requestfrm',
                                    'enableClientValidation'=>true,
                                    'validateOnSubmit' => true,
                                    'options' =>array(
                                        'class' => 'uk-form'
                                     )
                                   )
                             ); 
       echo $form->errorSummary($model,array("id"=>"errorid","class"=>"uk-container-center errorsummary")).'<br />';                 
      ?>     
    <div class="requestprice">
        <div class="uk-container uk-container-center">    
             <h3><?php echo Yii::t('app','Solicitar precio');?></h3>
             <div class="boxprice">             
                <div class="shorttxt"><?php echo Yii::t('app','¿Deseas tener precio del viaje');?> : <b><?php echo $model->title;?> ?</b> <?php echo Yii::t('app', 'Simplemente completa este formulario y te responderemos lo antes posible.');?></div>
                <ul class="uk-list">
                        <li>
                        <label><?php echo Yii::t('app', 'Género');?></label>
                            <select name="RequestpriceForm[title]">
                                 <option value="<?php echo Yii::t('app', 'Sr.');?>"><?php echo Yii::t('app', 'Sr.');?></option>
                                 <option value="<?php echo Yii::t('app', 'Sra.');?>"><?php echo Yii::t('app', 'Sra.');?></option>                                
                            </select> 
                        </li>      
                       <li>     
                         <?php echo $form->field($modelform,'name')->textInput(array('class' =>'uk-form-width-medium'))->label(Yii::t('app','Nombre').' *');?>
                        </li>
                        <li>
                           <?php echo $form->field($modelform,'address')->textInput(array('class' =>'uk-form-width-large'));?>
                        </li> 
                        <li>
                           <?php echo $form->field($modelform,'nationality')->textInput(array('class' =>'uk-form-width-medium'));?>           
                        </li>                         
                        <li>
                          <?php echo $form->field($modelform,'phone')->textInput(array('class' =>'uk-form-width-medium'))->label(Yii::t('app','Teléfono').' *');?>          
                        </li>                        
                        <li>
                           <?php echo $form->field($modelform,'email')->textInput(array('class' =>'uk-form-width-medium'))->label(Yii::t('app','Email').' *');?>         
                        </li>
                         <li>
                          <?php echo $form->field($modelform,'confirmemail')->textInput(array('class' =>'uk-form-width-medium'))->label(Yii::t('app','Confirmar email').' *');?>         
                        </li> 
                        <li>
                           <?php echo $form->field($modelform,'skype')->textInput(array('class' =>'uk-form-width-medium'));?>          
                        </li>
                        <li>
                           <?php echo $form->field($modelform,'whatsapp')->textInput(array('class' =>'uk-form-width-medium'));?>          
                        </li>
                        <li>
                           <?php echo $form->field($modelform,'viber')->textInput(array('class' =>'uk-form-width-medium'));?>          
                        </li>
                         <li class="uk-display-inline-block contactmuti">                          
                             <label class="control-label" for="requestpriceform-contact-title"><?php echo Yii::t('app', '¿Qué manera de comunicación prefieres ?');?></label> 
                             <div class="uk-form-row" style="float: right;">       
                             <?php
                                     $allcontact = $modelform->getAllContact();
                                     if(!empty($allcontact)){
                                        $i=1;
                                        foreach ($allcontact as $key => $value) {                                      
                                          //  $checked="";
                                           // if($i==1) $checked = 'checked="checked"';
                                            ?>
                                             <div class="radio-item">
                                                <input data-id="0" onclick="ChangeSlc(<?php echo $key;?>,'contact');" type="radio" id="requestpriceform-contact<?php echo $key;?>" name="RequestpriceForm[contact<?php echo $key;?>]" value="<?php echo $key;?>" />
                                                <label for="requestpriceform-contact<?php echo $key;?>"><?php echo $value;?></label>
                                             </div>
                                            <?php
                                            $i++;
                                       }                         
                                    }
                              ?> 
                              </div>                                        
                        </li>    
                       <li>
                          <?php echo $form->field($modelform,'contacttxt')->textarea(array('class' =>'uk-form-width-large','rows'=>2,'placeholder'=>Yii::t('app','Mejor momento para teléfono o skype')));?>          
                        </li>                      
                        <li class="uk-display-inline-block">
                          <div class="uk-grid uk-display-inline-block uk-position-relative uk-width-1-1" style="width: 100%;">
                           <?php echo $form->field($modelform,'adult')->textInput(array('class' =>'uk-form-width-medium'))->label(Yii::t('app','Número de participantes').' *');?>
                           <label style="width: 90px !important;padding-left: 0px;padding-right: 0px;">
                           <?php echo Yii::t('app', 'Adulto(s) y');?> </label>
                           <?php echo $form->field($modelform,'children')->textInput(array('class' =>'uk-form-width-medium'))->label(false);?>
                           <span style="float: right;margin-top: -30px;"><?php echo Yii::t('app', 'Niños menos de 12 años');?> </span>
                       </div> 
                        </li>
                          <li class="uk-display-inline-block">                          
                             <label class="control-label" for="requestpriceform-hotel"><?php echo Yii::t('app', 'Edad');?></label> 
                             <div class="uk-form-row" style="float: right;">       
                             <?php
                                     $allage = $modelform->getAllAge();
                                     if(!empty($allage)){
                                        $i=1;
                                        foreach ($allage as $key => $value) {                                       
                                          //  $checked="";
                                           // if($i==1) $checked = 'checked="checked"';
                                            ?>
                                             <div class="radio-item">
                                                <input data-id="0" onclick="ChangeSlc(<?php echo $key;?>,'age');" type="radio" id="requestpriceform-age<?php echo $key;?>" name="RequestpriceForm[age<?php echo $key;?>]" value="<?php echo $key;?>" />
                                                <label for="requestpriceform-age<?php echo $key;?>"><?php echo $value;?></label>
                                             </div>
                                            <?php
                                            $i++;
                                       }                         
                                    }
                              ?> 
                              </div>
                                        
                        </li>    
                       <li class="uk-display-inline-block"> 
                           <label class="control-label" for="requestpriceform-traveldate_id1" style="cursor: pointer;"><?php echo Yii::t('app', 'Fecha de llegada');?></label>                        
                              
                            <?php echo DatePicker::widget(array(
                                    'model' =>$modelform,
                                    'attribute' =>'depart',
                                    'template' => '{input}{addon}',
                                    'clientOptions' => array(                               
                                            'autoclose' => true,
                                            'format' => 'dd M yyyy'
                                        )
                                ));
                            ?>
                        </li>
                      
                         <li>                                                       
                                <label class="control-label" for="requestpriceform-traveldate_id2" style="cursor: pointer;"><?php echo Yii::t('app', 'Si no, ¿ En qué mes prefieres ?');?></label>                       
                           
                        <select name="RequestpriceForm[arrivaldate_other_m]">
                               <?php  
                               $tmp= array();
                               if($slcyear!=''){
                                //Novembre+2016
                                 $tmp =  explode(" ",$slcyear);                                
                               }
                                $arr = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");                               
                                foreach ($arr as $key => $value) {
                                        $v = $value;
                                        if(count($tmp)>0 && $tmp[0] == $v){
                                             echo '<option selected="selected" value="'.$v.'">'.$v.'</option>';
                                        }else{
                                             echo '<option value="'.$v.'">'.$v.'</option>';
                                        }
                                       
                                  }
                                ?>  
                          
                        </select>&nbsp;&nbsp;
                        <select name="RequestpriceForm[arrivaldate_other_y]">
                              <?php                             
                                  $n = 2;
                                  for ($i = 0; $i <= $n; $i++) {                                        
                                        $v = date("Y");
                                        if(count($tmp)>0 && (int)$tmp[1] == (int)($v+$i)){
                                            echo '<option value="'.($v+$i).'" selected="selected">'.($v+$i).'</option>';
                                        }else{
                                            echo '<option value="'.($v+$i).'">'.($v+$i).'</option>'; 
                                        }
                                        
                                    }
                                  ?> 
                        </select>
             
               </li>  
          
                      <li class="uk-display-inline-block" style="display: block;">                          
                             <label class="control-label" for="requestpriceform-hotel"><?php echo Yii::t('app', 'Comidas');?></label> 
                             <div class="uk-form-row boxmeals" style="float: right;">       
                             <?php
                                     $allage = $modelform->getAllMeals();
                                     if(!empty($allage)){
                                        $i=1;
                                        foreach ($allage as $key => $value) {                                       
                                            ?>
                                             <div class="radio-item">
                                                <input data-id="0" onclick="ChangeSlc(<?php echo $key;?>,'meals');" type="radio" id="requestpriceform-meals<?php echo $key;?>" name="RequestpriceForm[meals<?php echo $key;?>]" value="<?php echo $key;?>" />
                                                <label for="requestpriceform-meals<?php echo $key;?>"><?php echo $value;?></label>
                                             </div>
                                             <br />
                                            <?php
                                            $i++;
                                       }                         
                                    }
                              ?> 
                              </div>                                        
                        </li> 
                        <br />
                       <li class="uk-display-inline-block">
                             <label class="control-label" for="requestpriceform-hotel"><?php echo Yii::t('app', 'Hotel');?></label> 
                             <div class="uk-form-row boxhotel" style="float: right;">       
                             <?php
                                     $allhotel = $modelform->getAllHotelType();
                                     if(!empty($allhotel)){
                                        $i=1;
                                        foreach ($allhotel as $key => $value) { 
                                          //  $checked="";
                                           // if($i==1) $checked = 'checked="checked"';
                                            ?>
                                             <div class="radio-item radioitem<?php echo $i;?>" style="margin-right: 10px;">
                                                <input data-id="0" onclick="ChangeSlc(<?php echo $key;?>,'hotel');" type="radio" id="requestpriceform-hotel<?php echo $key;?>" name="RequestpriceForm[hotel<?php echo $key;?>]" value="<?php echo $key;?>" />
                                                <label for="requestpriceform-hotel<?php echo $key;?>"><?php echo $value;?></label>
                                             </div>
                                             <br />
                                            <?php
                                            $i++;
                                       }                         
                                    }
                              ?> 
                              </div>
              
                        </li>
               
                         <li>
                          <?php echo $form->field($modelform,'mess')->textarea(array('class' =>'uk-display-inline-block','rows' =>6,'cols' =>50,'placeholder'=>Yii::t('app','Para ayudar a nuestros consultores a crear la primera propuesta lo más cerca posible a tus expectativas, por favor especificar tus deseos, solicitar sobre el itinerario, actividades culturales, actividades deportivas').' ... '));?>
                         </li>
                         <li class="uk-display-inline-block">
                             <label class="control-label" for="requestpriceform-how_did_id"><?php echo Yii::t('app', '¿Cómo nos encontrabas?');?></label> 
                             <div class="uk-form-row boxhotel" style="float: right;">       
                             
                             <?php
                                     $allhowdid = $modelform->getAllHowDidUs();
                                     if(!empty($allhowdid)){
                                        $i=1;
                                        foreach ($allhowdid as $key => $value) {                                                                                  
                                            ?>   
                                              <div class="radio-item" style="width:170px !important;">
                                                <input data-id="0" onclick="ChangeHowDid(<?php echo $key;?>);" type="radio" id="requestpriceform-how_did_id<?php echo $key;?>" name="RequestpriceForm[how_did_id]" value="<?php echo $key;?>" />
                                                <label for="requestpriceform-how_did_id<?php echo $key;?>" style="text-align: left;"><?php echo $value;?></label>
                                             </div>                                             
                                            <?php
                                            if($i==3) echo '<br />';
                                            $i++;
                                       }                         
                                    }
                              ?>
                               <div style="padding-top: 14px;" > 
                                    <?php echo $form->field($modelform,'howdidtxt')->textarea(array('class' =>'uk-display-inline-block','rows' =>2,'cols' =>58,'placeholder'=>Yii::t('app','Por favor cuéntanos ¿cómo nos conoces?Desde recomendaciones de tus amigos /Busqueda de internet / Si es así, ¿cuál es la palabra clave? ¿Redes sociales? Foros? Si así, cuál es?')))->label(false);?>
                                </div>
                              </div>              
                        </li>
                         <li style="vertical-align: top;">
                          <?php echo $form->field($modelform,'verifyCode')->widget(Captcha::className(),array('imageOptions'=>array('alt'=>'Captcha'),'template' =>'<div class="captchacode"><div class="col-code">{input}</div><div class="col-img">{image}<br /><div style="white-space: nowrap;">'.Yii::t('app','Tienes que escribir los caracteres de la imagen en el cuadro de texto').'</div></div></div>',)); ?>
                         </li>                        
                        <?php 
                        $modelform->tour_id = $model->id;
                        echo $form->field($modelform,'tour_id')->hiddenInput()->label(false);
                        $modelform->title_tour = $model->title;
                        echo $form->field($modelform,'title_tour')->hiddenInput()->label(false);
                        
                        ?>
                  </ul>                   
             </div>
             <div style="text-align: center !important;padding-top: 20px;padding-bottom: 20px;">
                  <a class="btn btn-warning clsback" href="<?php echo $url_tour;?>"><i class="uk-icon-arrow-left"></i> <?php echo Yii::t('app','Atrás');?></a>
                  &nbsp&nbsp&nbsp <?php echo Html::submitButton(Yii::t('app','Enviar').'  <i class="uk-icon-angle-double-right"></i>',array('id'=>'idrequest','class' =>'btn btn-warning clsback', 'name' => 'sendrequest')) ?>
             </div>
        </div>
    </div>  
    <?php ActiveForm::end(); ?>       
 <?php
}
?>    
<!--End requestprice-->
<!--begin Service-->
<div class="boxserviceinclude">     
      <div class="uk-container uk-container-center">           
            <div class="uk-grid">
                 <div class="uk-width-1-2">
                     <div class="serviceinclude">
                          <h5><?php echo Yii::t('app','Servicios incluidos');?></h5>
                          <div class="content">
                           <?php echo HtmlPurifier::process($model->price_include);?>    
                           </div>
                     </div>
                </div>
                <div class="uk-width-1-2">
                    <div class="notserviceinclude">
                          <h5><?php echo Yii::t('app','Servicios excluidos');?></h5>
                          <div class="content">
                          <?php echo HtmlPurifier::process($model->price_not_include);?>
                         </div>
                    </div>
                 </div>
             </div>  
      </div>
</div>    
 <!--End begin Service--> 
 <!--Recomment-->
 <div class="boxrecomment">     
      <div class="uk-container uk-container-center">   
            <?php
            if(!empty($model)){
                echo Othertour::widget(array('cat_id'=>$model->cat_id,'tour_id' =>$model->id));
             }
            ?>
           <div class="boxbottom">            
               <ul class="uk-list">
                   <li>  
                     <?php echo Yii::t('app','Crear tu propio viaje o ver otras ideas de viaje');?>  
                   </li>
                    <li>  
                    <?php echo Html::a(Yii::t('app','Diseñar tu plan de viaje'),array('customize'), array('class' => 'btn btn-warning btnplan')) ?>
                     &nbsp;&nbsp; o &nbsp;&nbsp; 
                     <?php echo Html::a(Yii::t('app','Ver todos tours'),array('alltour'), array('class' => 'btn btn-warning btnalltour')) ?>
                   </li>
               </ul>
           </div>   
      </div>
</div>    
 <!--End Recomment-->
 <?php echo Servicework::widget(array('view' =>'tour'));?>
 <?php echo Travellerreview::widget(array('view' =>'detailtour'));?>
 </div>
<script language="javascript">
function ChangeSlc(id,name){
   var dataid = $("#requestpriceform-"+name+id).attr("data-id");
   if(dataid==0){
       $("#requestpriceform-"+name+id).attr("data-id","1");
       $("#requestpriceform-"+name+id).attr("checked");
   }else{
       $("#requestpriceform-"+name+id).attr("data-id","0");
       $("#requestpriceform-"+name+id).removeAttr("checked");
   }     
}
function ChangeHowDid(id){ 
          switch(id){
                case 1:
                     $("#requestpriceform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','¿Por favor dinos cómo nos conoces?');?>");                
                    break;
                case 2:
                    $("#requestpriceform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','¿Por favor dinos cómo nos conoces?');?>");   
                    break;
               case 3:
                     $("#requestpriceform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','¿Por favor dinos cómo nos conoces?');?>");   
                    break;
               case 4:
                     $("#requestpriceform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','¿Por favor dinos cómo nos conoces?');?>");   
                    break;
                case 4:
                     $("#requestpriceform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','Escribir el texto aquí');?>");  
                    break;     
        }
}
$('#idrequest').on('click', function(e) { 
    $("#idrequest").hide().delay(3000).fadeIn();
    //e.preventDefault();
});
$('#requestfrm').on('afterValidate', function (event, messages) {
   if(typeof $('.has-error').first().offset() !== 'undefined') {
     $("#errorid").show();
     $('html, body').animate({scrollTop: $("#errorid").offset().top - 100},1000);
   }
});
</script>   