<?php
/* @var $this yii\web\View */
/* @var $user common\models\User */
?>
<style>
.boxitem{
    border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;
}
.boxitemh1{
    font-size: 16px;font-weight: bold;background: #e9ebee;
}

</style>
Hi Administrator,<br />
You have Booking :<br />
Fullname : <?php echo $model->firtname;?> <?php echo $model->lastname;?><br />
E-mail: <?php echo $model->email;?><br />
Booking_id : <?php echo $booktour->id;?><br />
IP : <?php echo Yii::$app->getRequest()->getUserIP();?><br /><br />
<div style="border:1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
        <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Customize tour');?></h1>
        <div>   
            <?php
             if($model->vietnammap!=''){    
                echo '<br /><strong style="font-size: 16px;padding-right: 8px;">'.Yii::t('app', 'Vietnam').':</strong> '.$model->vietnammap;
             }
             //lao
             if($model->laosmap!=''){    
                echo  '<br /><strong style="font-size: 16px;padding-right: 8px;">'.Yii::t('app', 'Laos').':</strong>'.$model->laosmap;
             }
             //cambodia
              if($model->cambodiamap!=''){    
                 echo '<br /><strong style="font-size: 16px;padding-right: 8px;">'.Yii::t('app', 'Cambodia').':</strong>'.$model->cambodiamap;
             }
             //other
             if($model->mapother!=''){    
                echo '<br /><strong style="font-size: 16px;padding-right: 8px;">'.Yii::t('app', 'Other').':</strong>'.$model->mapother;
             }           
            ?>
        </div> 
</div>
<div style="border:1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
        <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Your Profile');?></h1>
        <div>   
                <?php
                echo $model->getProfile($model->profile_id);
                ?>
        </div> 
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
   <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'The Participants');?></h1>
   <div>
   <?php
           if($model->number_adults !=''){
               echo Yii::t('app', 'Number of Adults ').' : '.intval($model->number_adults);
           }
           if($model->number_children !=''){
              echo '<br /> '.Yii::t('app', 'Number of Children(1-12 years)').' : '.intval($model->number_children);
           }  
            ?>               
   </div>
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
           <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Tour PurPoses');?></h1>
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
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Your Travel Dates');?></h1>
    <div>
     <?php
            if($model->traveldate_id==1){
                echo Yii::t('app', 'Arrival Date').' : '.$model->arrivaldatetxt.'<br />';
             }else if($model->traveldate_id==2){
                echo Yii::t('app', 'Otherwise,What month do you go?').' : '.$model->arrivaldate_other_m.'/'.$model->arrivaldate_other_y.'<br />';
            }            
             if($model->flight_id==1){
                echo Yii::t('app', 'Have you booked your international flight(We do not offer this service)').' : Yes<br />';
             }else if($model->flight_id==2){
                echo Yii::t('app', 'Have you booked your international flight(We do not offer this service)').' : No<br />';
             } 
              if($model->number_nights!=''){              
               echo Yii::t('app', 'Number of nights provided locally : {numbernights} Nights', array('numbernights' => $model->number_nights));   
             } 
         ?>          
   </div>
</div>   
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
        <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Your Accommodation types');?></h1>
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
            ?>        
        </div>
</div>


<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Tour Type');?></h1>
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
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Go With');?></h1>
   <div>
           <?php
              if($model->gowith1>0){
                   echo ' - '.$model->getGoWith($model->gowith1).'<br />';    
               }
              if($model->gowith2>0){
                   echo ' - '.$model->getGoWith($model->gowith2).'<br />'; 
              }
              if($model->gowith3>0){
                   echo ' - '.$model->getGoWith($model->gowith3).'<br />';   
              }             
            ?>          
   </div>
</div>  
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">       
            <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Meals');?></h1>
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
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Your budget');?></h1>
     <div> 
         <?php
          if($model->budgettxt!=''){
               echo Yii::t('app', 'Your budget: {budgettxt} $ per person (excluding international flights)', array('budgettxt' => $model->budgettxt));
          } 
        ?>                 
    </div>  
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
     <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Your description of the journey');?></h1>
    <div>
     <?php
       if($model->descriptiontxt !=''){
                echo $model->descriptiontxt;    
        } 
      ?>        
   </div>
</div>
<div style="border: 1px solid #dcdcdc;padding-bottom: 14px;margin-bottom: 20px;text-align: center;">
    <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'How did you find us');?></h1>  
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
        <h1 style="padding-top:8px;margin-top: 0px;height: 30px;font-size: 16px;font-weight: bold;background: #e9ebee;"><?php echo Yii::t('app', 'Your Details');?></h1>
            <div>
            <table width="100%" border="0">
                 <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Title');?>:</td>
                     <td align="left"><?php echo $model->slcgender;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Firt name');?>:</td>
                     <td align="left"><?php echo $model->firtname;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Last name');?>:</td>
                     <td align="left"><?php echo $model->lastname;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Nationality');?>:</td>
                     <td align="left"><?php echo $model->nationality;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Address');?>:</td>
                     <td align="left"><?php echo $model->address;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Postal code');?>:</td>
                     <td align="left"><?php echo $model->postalcode;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'City');?>:</td>
                     <td align="left"><?php echo $model->city;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'Phone');?>:</td>
                     <td align="left"><?php echo $model->phone;?></td>
                 </tr>
                  <tr>
                     <td width="50%" align="right"><?php echo Yii::t('app', 'E-mail');?>:</td>
                     <td align="left"><?php echo $model->email;?></td>
                 </tr>
            </table>                               
            </div>   
</div>     
