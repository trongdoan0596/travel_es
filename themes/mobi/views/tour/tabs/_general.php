<?php
use yii\helpers\Html;
use dosamigos\datepicker\DatePicker;
use yii\captcha\Captcha;  
use common\helper\StringHelper;
use common\models\Destination;
?>
<div class="boxitem profile">
    <h1><?php echo Yii::t('app', 'Tu perfil');?></h1>
    <div class="uk-form-row">       
    <?php
         $allprofile = $model->getAllProfile();
         //echo $form->field($model,'profile_id')->radioList($allprofile);
         if(!empty($allprofile)){
            $i=1;                        
            $slccouple = Yii::$app->request->get('slccouple',0); 
            foreach ($allprofile as $key => $value) {           
                $checked="";
                if($i==1) $checked = 'checked="checked"';
                if($i==$slccouple) $checked = 'checked="checked"';
                ?>
                 <div class="radio-item">
                    <input type="radio" data="0" id="ritem<?php echo $key;?>" name="CustomizeForm[profile_id]" value="<?php echo $key;?>" <?php echo $checked;?> />
                    <label for="ritem<?php echo $key;?>"><?php echo $value;?></label>
                 </div>
                <?php
                $i++;
           }                         
        }
    ?>                
    </div> 
</div>
<div class="boxitem profile participants">
   <h1><?php echo Yii::t('app', 'Los participantes');?></h1>
   <div class="uk-form-row">
             <div class="numberadults" style="padding-right:48px;float: left;">
                   <?php echo $form->field($model,'number_adults')->textInput(array('class' =>'uk-form-width-mini','style'=>'margin-left: 10px;'));?>  
             </div>
             <div class="numberchildren">                    
                   <?php echo $form->field($model,'number_children')->textInput(array('class' =>'uk-form-width-mini','style'=>'margin-left: 10px;'));?>  
             </div>  
                
   </div>
</div> 
<div class="boxitem profile">
           <h1><?php echo Yii::t('app', 'Propósito del tour');?></h1>
            <div class="uk-form-row">   
              <?php
                     $rows = $model->getAllPurPoses();                     
                     if(!empty($rows)){
                        $i=1;
                        foreach ($rows as $key => $value) { 
                            $checked="";
                            if($i==1) $checked = 'checked="checked"';
                            if($i<3){
                                ?>
                                 <div class="radio-item">
                                        <input type="radio" id="customizeform-purposes_id<?php echo $key;?>" name="CustomizeForm[purposes_id]" value="<?php echo $key;?>" />
                                        <label for="customizeform-purposes_id<?php echo $key;?>"><?php echo $value;?></label>
                                 </div>                             
                            <?php
                            }else{
                            ?>
                              <div class="radio-item">
                                    <input type="radio" id="customizeform-purposes_id<?php echo $key;?>" name="CustomizeForm[purposes_id]" value="<?php echo $key;?>"  />
                                    <label for="customizeform-purposes_id<?php echo $key;?>"><?php echo $value;?></label>
                                    <input type="text" value="" style="width: 410px;" name="CustomizeForm[purposesothertxt]" placeholder="<?php echo Yii::t('app','Ingresar tu texto aquí');?>" />
                             </div>                            
                            <?php
                            }
                            $i++;
                       }                         
                    }
                ?>                 
            </div>           
</div>
<div class="boxitem profile traveldate">
   <h1><?php echo Yii::t('app', 'Tu fecha de viaje');?></h1>
   <div class="uk-form-row">
           <div class="uk-grid" style="padding: 0px;margin: 0px;">
               <div class="uk-width-1-1" style="padding: 0px;margin: 0px;">
                   <div class="radio-itemdate1">                          
                           <label for="customizeform-traveldate_id1"><?php echo Yii::t('app', 'Día de llegada');?></label>   
                            <?php echo DatePicker::widget(array(
                                    'model' =>$model,
                                    'attribute' =>'arrivaldatetxt',
                                    'template' => '{input}{addon}',
                                    'clientOptions' => array(                               
                                            'autoclose' => true,
                                            'format' => 'dd M yyyy'
                                        )
                                ));
                            ?>   
                    </div>
               </div>                             
          </div>    
          <div class="uk-width-1-1" style="margin-left: 0px;padding-top: 20px;">
                        <div class="radio-itemdate1" style="width: 315px;padding-left: 0px !important;margin-left: 0px !important; float: left; white-space: nowrap;display: block;">                          
                            <label for="customizeform-traveldate_id2" style="text-align: left; margin-left: 0px !important; padding-left: 0px !important;"><?php echo Yii::t('app', 'Si no, ¿Qué mes prefieres ?');?></label>                       
                        </div>
                        <select name="CustomizeForm[arrivaldate_other_m]">
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
                        <select name="CustomizeForm[arrivaldate_other_y]">
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
               </div>  
        <!--  <div class="serviceyesno">    
                <div class="radio-item">
                       <?php //echo Yii::t('app','Have you booked your international flight(We do not offer this service)');?>
                       <div class="radio-item">
                            <input type="radio" id="customizeform-flight_idyes" name="CustomizeForm[flight_id]" value="1" checked="checked"   />
                            <label for="customizeform-flight_idyes"><?php //echo Yii::t('app','Yes');?></label> 
                        </div>
                        <div class="radio-item">
                                <input type="radio" id="customizeform-flight_idno" name="CustomizeForm[flight_id]" value="2" />
                                <label for="customizeform-flight_idno"><?php //echo Yii::t('app','No');?></label>  
                      </div>                       
                  </div>
          </div>
          -->
          <div class="locallynight" style="padding-top: 10px;">
                 <div class="radio-item1">
                       <label for="customizeform-number_nights" style="float: left !important;padding-right: 14px;"><?php echo Yii::t('app','Duración de tu viaje');?></label>  
                        <?php echo $form->field($model,'number_nights')->textInput(array('class' =>'uk-form-width-mini','style'=>'margin-left:0px;margin-right:12px;'))->label(false);?>
                        <label class="nights"><?php echo Yii::t('app', 'Noches');?></label>
                  </div>
          </div>
          
   </div>
</div> 
<div class="boxitem profile">
         <h1><?php echo Yii::t('app', 'Tus tipos de alojamiento');?> <span>(<?php echo Yii::t('app','Varias opciones');?>)</span></h1>
       <div class="uk-form-row">       
             <?php
                     $allacc = $model->getAllAccType();
                    // asort($allacc);
                     ksort($allacc);
                     //echo $form->field($model,'profile_id')->radioList($allprofile);
                     if(!empty($allacc)){
                        $i=1;
                         foreach ($allacc as $key => $value) {                       
                          //  $checked="";
                           // if($i==1) $checked = 'checked="checked"';
                            ?>
                             <div class="radio-item itemprofile">
                                <input data-id="0" onclick="ChangeTypeAcc(<?php echo $key;?>,'typeacc');" type="radio" id="customizeform-typeacc<?php echo $key;?>" name="CustomizeForm[typeacc<?php echo $key;?>]" value="<?php echo $key;?>" />
                                <label for="customizeform-typeacc<?php echo $key;?>"><?php echo $value;?></label>
                             </div>
                            <?php
                            $i++;
                       }                         
                    }
                ?> 
    </div>
</div>

<div class="boxitem">
    <h1><?php echo Yii::t('app', 'Tipo de tour');?><span>(<?php echo Yii::t('app','Varias opciones');?>)</span></h1>
    <ul class="tourtype">
                <?php
                     $rows = $model->getAllType();                     
                     if(!empty($rows)){
                        $i=1;
                        foreach ($rows as $key => $value) {                        
                            $checked="";
                            if($i==1) $checked = 'checked="checked"';                           
                            ?>
                             <li>
                                 <div class="radio-item">
                                    <input data-id="0" onclick="ChangeTypeAcc(<?php echo $key;?>,'typetour');" type="radio" id="customizeform-typetour<?php echo $key;?>" name="CustomizeForm[typetour<?php echo $key;?>]" value="<?php echo $key;?>" />
                                    <label for="customizeform-typetour<?php echo $key;?>"><?php echo $value;?></label>
                                 </div> 
                               </li>                          
                            <?php                           
                            $i++;
                       }                         
                    }
                ?>  
    </ul>
</div>
<div class="boxitem profile">
   <h1><?php echo Yii::t('app', 'Tus actividades favoritas');?><span>(<?php echo Yii::t('app','Varias opciones');?>)</span></h1>
   <div class="notetxt">
   <?php echo Yii::t('app', 'Para una mejor propuesta que coincida con tu deseo, marcar según tus preferencias de actividades, - lo menos interesado y ++ lo más interesado');?>
   </div>
   <div class="uk-form-row boxgowith">
       <ul class="uk-list">    
            <?php
                 $rows = $model->getAllGoWith();                     
                 if(!empty($rows)){
                    $j=1;
                     foreach ($rows as $key => $value) {
                        $checked="";
                        if($j==1) $checked = 'checked="checked"';                           
                        ?>    
                        <li>                          
                                 <div class="boxitemgo">
                                    <label for="customizeform-gowith<?php echo $key;?>"  style="white-space: nowrap;"><?php echo $value;?></label>
                                    <?php
                                    $arr = $model->getAllGoWithLabel();
                                    for($i=1;$i<=4;$i++){
                                        ?>
                                         <div class="radio-item">
                                            <input id="customizeform-gowith<?php echo $i.$key;?>" name="CustomizeForm[gowith<?php echo $key;?>]" value="<?php echo $i;?>" type="radio" />
                                            <label for="customizeform-gowith<?php echo $i.$key;?>"><?php echo $arr[$i];?></label>
                                         </div> 
                                        <?php
                                    }
                                    ?>                                    
                                 </div> 
                          </li>                                                
                        <?php                           
                        $j++;
                   }                         
                }
            ?>    
         </ul>           
   </div>
   
   
</div>
<div class="boxitem profile boxmeals">       
            <h1><?php echo Yii::t('app', 'Comidas');?><span>(<?php echo Yii::t('app','Varias opciones');?>)</span></h1>
            <div class="uk-form-row">      
               <?php
                     $rows = $model->getAllMeals();                     
                     if(!empty($rows)){
                        $i=1;
                         foreach ($rows as $key => $value) {
                            $checked="";
                            if($i==1) $checked = 'checked="checked"';                           
                            ?>                            
                             <div class="radio-item itemgowwith<?php echo $i;?>">
                                <input type="radio" data-id="0" onclick="ChangeTypeAcc(<?php echo $key;?>,'meals');" id="customizeform-meals<?php echo $key;?>" name="CustomizeForm[meals<?php echo $key;?>]" value="<?php echo $key;?>" />
                                <label for="customizeform-meals<?php echo $key;?>"><?php echo $value;?></label>
                             </div>                                                        
                            <?php                           
                            $i++;
                       }                         
                    }
                ?> 
        </div>
</div>
    
<div class="boxitem">
    <h1><?php echo Yii::t('app', 'Tu presupuesto');?></h1>
     <ul class="yourbudget">
       <li>
        <?php echo $form->field($model,'budgettxt')->textInput(array('class' =>'uk-form-width-small'));?>&nbsp;&nbsp;<?php echo Yii::t('app', '$ por persona (Excluidos vuelos internacionales');?> 
        </li>
    </ul>
</div>
<div class="boxitem">
    <h1><?php echo Yii::t('app', 'Descripciones de viaje');?></h1>
    <div class="yourdescription">
     <?php 
       echo $form->field($model,'descriptiontxt')->textarea(array("rows"=>"4","style"=>"100%","placeholder"=>"Para ayudar a nuestros consultores a crear la primera propuesta lo más cerca posible a tus expectativas, por favor especificar tus deseos, solicitar sobre el itinerario, actividades culturales, actividades deportivas..."))->label(false);
       ?>    
    </div>
</div>
<div class="boxitem profile">
    <h1><?php echo Yii::t('app', '¿Cómo nos encontrabas?');?></h1>  
    <div class="uk-form-row"> 
               <?php
                     $rows = $model->getAllHowDidUs();                     
                     if(!empty($rows)){
                        $i=1;
                         foreach ($rows as $key => $value) {
                            $checked="";
                            if($i==1) $checked = 'checked="checked"';                           
                            ?>                            
                             <div class="radio-item">
                                <input type="radio" id="customizeform-how_did_id<?php echo $key;?>" onclick="ChangeHowDid(<?php echo $key;?>);" name="CustomizeForm[how_did_id]" value="<?php echo $key;?>" />
                                <label for="customizeform-how_did_id<?php echo $key;?>"><?php echo $value;?></label>
                             </div>                                                        
                            <?php                           
                            $i++;
                       }                         
                    }
                ?> 
    </div>  
    <div class="uk-form-row"> 
    <?php 
     echo $form->field($model,'howdidtxt')->textarea(array("rows"=>"2","style"=>"100%","placeholder"=>Yii::t('app','Por favor cuéntanos ¿cómo nos conoces?Desde recomendaciones de tus amigos /Busqueda de internet / Si es así, ¿cuál es la palabra clave? ¿Redes sociales? Foros? Si así, cuál es?')))->label(false);
    ?>
    </div>
</div>
<div class="boxitem">
    <h1><?php echo Yii::t('app', 'Tus detalles');?></h1>
     <ul class="uk-list yourdetail">
       <li>
       <label>* Campos obligatorios </label>
       </li>
       <li style="padding-top: 15px;">
        <!--<label><?php //echo Yii::t('app', 'Sex');?></label>-->
            <select name="CustomizeForm[slcgender]" id="customizeform-slcgender">
                 <option value="<?php echo Yii::t('app','Sr.');?>"><?php echo Yii::t('app','Sr.');?></option>
                 <option value="<?php echo Yii::t('app','Sra.');?>"><?php echo Yii::t('app','Sra.');?></option>
            </select> 
        </li>
       <li>     
         <?php echo $form->field($model,'firstname')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Nombre').'*'))->label(false);?>
        </li>
          <li>     
         <?php echo $form->field($model,'lastname')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Apellido ').'*'))->label(false);?>
        </li>
        <li>
           <?php echo $form->field($model,'nationality')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Nacionalidad')))->label(false);?>        
        </li>
        <li>
           <?php echo $form->field($model,'address')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Dirección')))->label(false);?>
        </li>  
        <li>
          <?php echo $form->field($model,'phone')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Teléfono').'*'))->label(false);?>        
        </li>
        
        <li>
           <?php echo $form->field($model,'email')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Email').'*'))->label(false);?>         
        </li>
         <li>
          <?php echo $form->field($model,'confirmemail')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Confirmar email').'*'))->label(false);?>        
        </li>
        <li>
          <?php echo $form->field($model,'skype')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Cuenta de Skype')))->label(false);?>        
        </li>
         <li>
          <?php echo $form->field($model,'whatsapp')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Tu Whatsapp')))->label(false);?>        
        </li>
         <li>
          <?php echo $form->field($model,'viber')->textInput(array('class' =>'uk-form-width-medium','placeholder'=>Yii::t('app','Tu Viber')))->label(false);?>        
        </li>      
        <li>
             <label class="control-label" for="customizeform-contact-title"><?php echo Yii::t('app', '¿Qué manera de comunicación prefieres ?');?></label><br />
                                       <?php
                                          $allcontact = $model->getAllContact();
                                             if(!empty($allcontact)){
                                                $i=1;
                                                 foreach ($allcontact as $key => $value) {                                                
                                                    ?>
                                                     <div class="radio-item muticontact">
                                                        <input data-id="0" onclick="ChangeTypeAcc(<?php echo $key;?>,'contact');" type="radio" id="customizeform-contact<?php echo $key;?>" name="CustomizeForm[contact<?php echo $key;?>]" value="<?php echo $key;?>" />
                                                        <label for="customizeform-contact<?php echo $key;?>"><?php echo $value;?></label>
                                                     </div>
                                                    <?php
                                                    $i++;
                                               }                         
                                            }
                                      ?> 
        </li>
        <li>
        <?php echo $form->field($model,'contacttxt')->textarea(array('class' =>'uk-form-width-large','rows' =>2,'placeholder'=>Yii::t('app','El mejor momento para teléfono o skype')))->label(false);?>
        </li>
         <li style="padding-top: 15px;">
          <?php echo $form->field($model,'verifyCode')->widget(Captcha::className(),array('imageOptions'=>array('alt'=>'Captcha'),'template' =>'<div class="captchacode" align="center"><div class="col-lg">{input}</div><div class="col-lg">{image}</div></div>'))->label(false); ?>
          <?php echo Yii::t('app','Tienes que escribir los caracteres de la imagen en el cuadro de texto');?>       
        </li>
         <?php echo $form->field($model,'postalcode')->hiddenInput(array('class' =>'uk-form-width-medium'))->label(false);?>      
         <?php echo $form->field($model,'city')->hiddenInput(array('class' =>'uk-form-width-medium'))->label(false);?>
    </ul> 
</div>     
<div class="control-group">
    <div class="controls" style="text-align: center !important;">
       <?php echo Html::submitButton(Yii::t('app','Enviar').'  <i class="uk-icon-angle-double-right"></i>',array('class' =>'uk-button sendcontact', 'name' => 'sendcontact')) ?>
    </div>
</div>
<script language="javascript">
function ChangeDest(txtdes,id,country_id){
   var dataid = $("#ritemdest"+id).attr("data-id");
   if(dataid==0){
       $("#ritemdest"+id).attr("data-id","1");
       $("#ritemdest"+id).attr("checked");
       switch (country_id) {
              case 232://vn
                    var vietnammap = $('#customizeform-vietnammap').val();
                    if(vietnammap!=''){
                         var arr = vietnammap.split('[-|-]');
                         var tmp = arr.indexOf(txtdes); 
                         if(tmp==-1){                            
                            //chua co trong mang
                             var vietnamid = parseInt($('#vietnamid').val())+1; 
                             $('#vietnamid').val(vietnamid);                             
                             $('#customizeform-vietnammap').val(vietnammap+'[-|-]'+txtdes);
                         }                       
                    }else{
                         var vietnamid = parseInt($('#vietnamid').val())+1; 
                         $('#vietnamid').val(vietnamid);
                         $('#customizeform-vietnammap').val(txtdes);
                    }
                    
                 break;
              case 116://laos
                    var laosmap = $('#customizeform-laosmap').val();
                    if(laosmap!=''){
                         var arr = laosmap.split('[-|-]');
                         var tmp = arr.indexOf(txtdes); 
                         if(tmp==-1){                            
                            //chua co trong mang
                             var laosid = parseInt($('#laosid').val())+1; 
                             $('#laosid').val(laosid);
                             $('#customizeform-laosmap').val(laosmap+'[-|-]'+txtdes);
                         }else{
                             alert('Désolé, cet élément existe déjà!');
                         }
                    }else{
                        $('#customizeform-laosmap').val(txtdes);
                        var laosid = parseInt($('#laosid').val())+1; 
                        $('#laosid').val(laosid);                         
                    }           
                 break;
              case 36://cambodia
                    var cambodiamap = $('#customizeform-cambodiamap').val();
                    if(cambodiamap!=''){
                         var arr = cambodiamap.split('[-|-]');
                         var tmp = arr.indexOf(txtdes); 
                         if(tmp==-1){                            
                            //chua co trong mang
                             var cambodiaid = parseInt($('#cambodiaid').val())+1;                    
                             $('#cambodiaid').val(cambodiaid);                            
                             $('#customizeform-cambodiamap').val(cambodiamap+'[-|-]'+txtdes);
                        }else{
                             alert('Désolé, cet élément existe déjà!');
                         }                        
                    }else{
                        $('#customizeform-cambodiamap').val(txtdes);
                        var cambodiaid = parseInt($('#cambodiaid').val())+1;                    
                        $('#cambodiaid').val(cambodiaid);                         
                    }
                 break;    
                    
         }        
   }else{
       //remove 
       $("#ritemdest"+id).attr("data-id","0");
       $("#ritemdest"+id).removeAttr("checked");
       switch (country_id) {
              case 232://vn                    
                      var vietnamtxt = $("#customizeform-vietnammap").val(); 
                      if(vietnamtxt!=''){
                         var arr = vietnamtxt.split('[-|-]');      
                         for (var i in arr){                              
                               if(arr[i] == txtdes) {
                                  delete arr[i];
                               }
                         }                        
                         var txtnew =  arr.join('[-|-]');
                         $('#customizeform-vietnammap').val(txtnew);                         
                     }
              break;
              case 116://laos
                      var laostxt = $("#customizeform-laosmap").val();                 
                      if(laostxt!=''){
                         var arr = laostxt.split('[-|-]');   
                         for (var i in arr){                              
                               if(arr[i] == txtdes) {
                                   delete arr[id];
                               }
                         }
                         var txtnew =  arr.join('[-|-]');
                         $('#customizeform-laosmap').val(txtnew);
                      }
              break;
              case 36://cambodia
                      var cambodiatxt = $("#customizeform-cambodiamap").val();
                      if(cambodiatxt!=''){
                         var arr = cambodiatxt.split('[-|-]');    
                         for (var i in arr){                              
                               if(arr[i] == txtdes) {
                                   delete arr[id];
                               }
                         }  
                         var txtnew =  arr.join('[-|-]');
                         $('#customizeform-cambodiamap').val(txtnew);                         
                      }
              break;
       }       
   }  
}
function ChangeTypeAcc(id,name){
   var dataid = $("#customizeform-"+name+id).attr("data-id");
   if(dataid==0){
       $("#customizeform-"+name+id).attr("data-id","1");
       $("#customizeform-"+name+id).attr("checked");
   }else{
       $("#customizeform-"+name+id).attr("data-id","0");
       $("#customizeform-"+name+id).removeAttr("checked");
   }     
}
function ChangeHowDid(id){ 
          switch(id){
                case 1:
                     $("#customizeform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','Enter you text here');?>");                
                    break;
                case 2:
                    $("#customizeform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','Enter you text here');?>");   
                    break;
               case 3:
                     $("#customizeform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','Enter you text here');?>");   
                    break;
               case 4:
                     $("#customizeform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','Enter you text here');?>");   
                    break;
                case 4:
                     $("#customizeform-howdidtxt").attr("placeholder","<?php echo Yii::t('app','Enter you text here');?>");  
                    break;     
        }
}
$('#idcustomize').on('click', function(e) { 
    $("#idcustomize").hide().delay(3000).fadeIn();
});
</script>