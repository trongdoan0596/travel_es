<style>
.boxitem{
    border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;
}
.boxitemh1{
    font-size: 16px;font-weight: bold;background: #e9ebee;
}
</style>
<?php
if($admin==1){
    ?>
    Hi Administrator,<br />
    <?php echo Yii::t('app', 'You received email request as below:');?>  <br />
    Full name : <?php echo $model->firstname;?> <?php echo $model->lastname;?><br />
    E-mail: <?php echo $model->email;?><br />
    Booking_id : <?php echo $booktour->id;?><br />
    IP : <?php echo Yii::$app->getRequest()->getUserIP();?><br /><br />
    <?php
}else{
    ?>
    <div style="text-align: center;">
     <?php echo Yii::t('app', '¡Muchas gracias por mandar tu petición a Authentik Travel!');?><br />
     <?php echo Yii::t('app', 'Este es un email de respuesta automática y nuestro equipo te comunicará dentro de 24 horas.');?><br />
     <?php echo Yii::t('app', 'Nos gustaría reconfirmar tu información a continuación:');?><br /><br />
    </div>
    <?php
}
?>

<div style="border:1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
        <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app','Lugares interesantes');?></h1>
        <div>   
            <?php
             if($model->vietnammap!=''){
                echo '<br /><strong style="font-size: 16px;padding-right: 8px;">'.Yii::t('app', 'Vietnam').':</strong> '.$model->vietnammap;
             }
             //lao
             if($model->laosmap!=''){    
                echo  '<br /><strong style="font-size: 16px;padding-right: 8px;">'.Yii::t('app', 'Laos').':</strong> '.str_replace(","," - ",$model->laosmap);
             }
             //cambodia
              if($model->cambodiamap!=''){    
                 echo '<br /><strong style="font-size: 16px;padding-right: 8px;">'.Yii::t('app', 'Camboya').':</strong>'.str_replace(","," - ",$model->cambodiamap);
             }
             //other
             if($model->mapother!=''){    
                echo '<br /><strong style="font-size: 16px;padding-right: 8px;">'.Yii::t('app', 'Otros destinos').':</strong> '.str_replace(","," - ",$model->mapother);
             }           
            ?>
        </div> 
</div>
<div style="border:1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
        <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app','Tu perfil');?></h1>
        <div>   
                <?php
                echo $model->getProfile($model->profile_id);
                ?>
        </div> 
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
   <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Los participantes');?></h1>
   <div>
   <?php
           if($model->number_adults !=''){
               echo Yii::t('app', 'Número de Adultos').': '.intval($model->number_adults);
           }
           if($model->number_children !=''){
              echo '<br /> '.Yii::t('app', 'Número de niños (1-12 años)').': '.intval($model->number_children);
           }  
            ?>               
   </div>
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
           <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Propósito del tour');?></h1>
           <div>   
                <?php 
                 if($model->purposes_id>0){
                      echo ' - '.$model->getPurPoses($model->purposes_id).'<br />';    
                  }
                  if($model->purposesothertxt !=''){
                      echo '<br /> - '.$model->purposesothertxt;    
                    } 
               ?>                     
           </div>        
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Tu fecha de viaje');?></h1>
    <div>
     <?php
            if($model->arrivaldatetxt !=''){
                echo Yii::t('app', 'Día de llegada').': '.date("d M Y, g:i a",strtotime($model->arrivaldatetxt)).'<br />';
             }
            if($model->arrivaldate_other_m !='' && $model->arrivaldate_other_y !=''){
                echo Yii::t('app', 'Si no, ¿Qué mes prefieres ?').': '.$model->arrivaldate_other_m.'/'.$model->arrivaldate_other_y.'<br />';
            }            
             if($model->flight_id==1){
                echo Yii::t('app', 'Have you booked your international flight(We do not offer this service)').' : Yes<br />';
             }else if($model->flight_id==2){
                echo Yii::t('app', 'Have you booked your international flight(We do not offer this service)').' : No<br />';
             } 
              if($model->number_nights!=''){              
               echo Yii::t('app', 'Duración de tu viaje: {numbernights} Noches', array('numbernights' => $model->number_nights));   
             } 
         ?>          
   </div>
</div>   
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
        <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Tus tipos de alojamiento');?></h1>
        <div>    
              <?php
              if($model->typeacc1>0){
                   echo ' - '.$model->getAccType($model->typeacc1).'<br />';    
               }
              if($model->typeacc2>0){
                   echo ' - '.$model->getAccType($model->typeacc2).'<br />'; 
              }
              if($model->typeacc3>0){
                   echo ' - '.$model->getAccType($model->typeacc3).'<br />';   
              }
              if($model->typeacc4>0){
                   echo ' - '.$model->getAccType($model->typeacc4).'<br />';    
              }
              if($model->typeacc5>0){
                   echo ' - '.$model->getAccType($model->typeacc5).'<br />';    
              }
            ?>        
        </div>
</div>


<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Tipo de tour');?></h1>
     <div>   
             <?php
              if($model->typetour1>0){
                   echo ' - '.$model->getType($model->typetour1).'<br />';    
               }
              if($model->typetour2>0){
                   echo ' - '.$model->getType($model->typetour2).'<br />'; 
              }
              if($model->typetour3>0){
                   echo ' - '.$model->getType($model->typetour3).'<br />';   
              }
             
            ?>                                       
     </div> 
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Tus actividades favoritas');?></h1>
   <div>
           <?php
            if($model->gowith1>0){
               echo '-'.$model->getGoWith(1).' : '.$model->getGoWithLabel($model->gowith1).'<br />';    
            }
            if($model->gowith2>0){
               echo '-'.$model->getGoWith(2).' : '.$model->getGoWithLabel($model->gowith2).'<br />';  
            }
            if($model->gowith3>0){
               echo '-'.$model->getGoWith(3).' : '.$model->getGoWithLabel($model->gowith3).'<br />';  
            }
            if($model->gowith4>0){
               echo '-'.$model->getGoWith(4).' : '.$model->getGoWithLabel($model->gowith4).'<br />';  
            }
            if($model->gowith5>0){
               echo '-'.$model->getGoWith(5).' : '.$model->getGoWithLabel($model->gowith5).'<br />';  
            }
            if($model->gowith6>0){
               echo '-'.$model->getGoWith(6).' : '.$model->getGoWithLabel($model->gowith6).'<br />';  
            }
            if($model->gowith7>0){
              echo '-'.$model->getGoWith(7).' : '.$model->getGoWithLabel($model->gowith7).'<br />';  
            }
            if($model->gowith8>0){
               echo '-'.$model->getGoWith(8).' : '.$model->getGoWithLabel($model->gowith8).'<br />';  
            }
            if($model->gowith9>0){
               echo '-'.$model->getGoWith(9).' : '.$model->getGoWithLabel($model->gowith9).'<br />';  
            }       
            ?>          
   </div>
</div>  
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">       
            <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Comidas');?></h1>
            <div>      
               <?php
              if($model->meals1>0){
                   echo ' - '.$model->getMeals($model->meals1).'<br />';    
               }
              if($model->meals2>0){
                   echo ' - '.$model->getMeals($model->meals2).'<br />'; 
              }
              if($model->meals3>0){
                   echo ' - '.$model->getMeals($model->meals3).'<br />';   
              }             
            ?>   
        </div>
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Tu presupuesto');?></h1>
     <div> 
         <?php
          if($model->budgettxt!=''){
               echo Yii::t('app', 'Tu presupuesto: {budgettxt} $ por persona (Excluidos vuelos internacionales)', array('budgettxt' => $model->budgettxt));
          } 
        ?>                 
    </div>  
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
     <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Descripciones de viaje');?></h1>
    <div>
     <?php
       if($model->descriptiontxt !=''){
                echo $model->descriptiontxt;    
        } 
      ?>        
   </div>
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', '¿Cómo nos encontrabas?');?></h1>  
    <div> 
           <?php
            if($model->how_did_id>0){
               echo $model->getHowDidUs($model->how_did_id).'<br />';    
            }
            if($model->howdidtxt!=''){
               echo '-'.$model->howdidtxt.'<br />';    
             }
           ?>              
    </div>  
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
        <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Tus detalles');?></h1>
            <div>
            <table width="100%" border="0">
                 <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Género');?>:</td>
                     <td align="left"><?php echo $model->slcgender;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Nombre');?>:</td>
                     <td align="left"><?php echo $model->firstname;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Apellido ');?>:</td>
                     <td align="left"><?php echo $model->lastname;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Nacionalidad');?>:</td>
                     <td align="left"><?php echo $model->nationality;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Dirección');?>:</td>
                     <td align="left"><?php echo $model->address;?></td>
                 </tr>                
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Teléfono');?>:</td>
                     <td align="left"><?php echo $model->phone;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Email');?>:</td>
                     <td align="left"><?php echo $model->email;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Cuenta de Skype');?>:</td>
                     <td align="left"><?php echo $model->skype;?></td>
                 </tr>
                   <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Tu Whatsapp');?>:</td>
                     <td align="left"><?php echo $model->whatsapp;?></td>
                 </tr>
                   <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Tu Viber');?>:</td>
                     <td align="left"><?php echo $model->viber;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', '¿Qué manera de comunicación prefieres ?');?>:</td>
                     <td align="left">                     
                     <?php 
                       if($model->contact1>0){
                           echo  '<br />-'.$model->getContact($model->contact1);    
                        }
                        if($model->contact2>0){
                           echo '<br />-'.$model->getContact($model->contact2);    
                        }
                        if($model->contact3>0){
                           echo '<br />-'.$model->getContact($model->contact3);    
                        }
                        if($model->contact4>0){
                           echo '<br />-'.$model->getContact($model->contact4);    
                        }
                        if($model->contact5>0){
                           echo '<br />-'.$model->getContact($model->contact5);    
                        }
                      ?>
                     </td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'El mejor momento para teléfono o skype');?>:</td>
                     <td align="left"><?php echo $model->contacttxt;?></td>
                 </tr>
            </table>                               
            </div>   
</div>     
<div><?php echo Yii::t('app', 'Atentamente,<br />Equipo de Authentik Travel');?></div>