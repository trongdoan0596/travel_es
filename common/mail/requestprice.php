<?php
use yii\helpers\Html;
use common\models\RequestpriceForm;
use common\models\Tour;
$baseurl = 'https://authentiktravel.es';
$url = $baseurl.Tour::createUrl($modeltour);    
?>
<?php
if($admin==1){
    ?>
     Hi Administrator,<br />
    <?php echo Yii::t('app','Receive email from');?>: <?php echo $model->email;?><br /><br />
    <?php
}else{
     ?>
    <?php echo Yii::t('app','Hola');?> <?php echo $model->name;?>:<br /><br />
    <?php echo Yii::t('app','¡Muchas gracias por mandar tu petición a Authentik Travel!<br />Este es un email de respuesta automática y nuestro equipo te comunicará dentro de 24 horas.
<br />Nos gustaría reconfirmar tu información a continuación:<br />');?>
    <br />
    <?php
}
?>
<div style="width: 100%;">
        <b><?php echo Yii::t('app','Título del tour');?>: </b> <?php echo $model->title_tour;?> <br />       
        <b><?php echo Yii::t('app','Género');?>:</b>  <?php echo $model->title;?> <br />        
        <b><?php echo Yii::t('app','Nombre');?>:</b>  <?php echo $model->name;?> <br />
        <b><?php echo Yii::t('app','Nacionalidad');?>: </b> <?php echo $model->nationality;?> <br />
        <b><?php echo Yii::t('app','Teléfono');?>: </b> <?php echo $model->phone;?> <br />
        <?php
        if($admin!=1){
            ?>
            <b><?php echo Yii::t('app','Email');?>: </b> <?php echo $model->email;?> <br />
            <?php
         }
         ?>        
        <b><?php echo Yii::t('app','Dirección');?>:</b>  <?php echo $model->address;?> <br />
        <b><?php echo Yii::t('app','Skype');?>: </b> <?php echo $model->skype;?> <br />
        <b><?php echo Yii::t('app','Tu WhatsApp');?>: </b> <?php echo $model->whatsapp;?> <br />
        <b><?php echo Yii::t('app','Tu Viber');?>: </b> <?php echo $model->viber;?> <br />
        <b><?php echo Yii::t('app','¿Qué manera de comunicación prefieres?');?>:</b> 
        <?php 
        if($model->contact1 !=''){
            echo  $model->getContact($model->contact1).' ,';
        }
        if($model->contact2 !=''){
            echo  $model->getContact($model->contact2).' ,';
        }
        if($model->contact3 !=''){
            echo  $model->getContact($model->contact3).' ,';
        } 
        if($model->contact4 !=''){
            echo  $model->getContact($model->contact4).' ,';
        }  
        if($model->contact5 !=''){
            echo  $model->getContact($model->contact5).' ,';
        }        
        ?>   
        <br />
        <b><?php echo Yii::t('app','Tu disponibilidad para conversar con nosotros por Skype / teléfono');?>: </b> <?php echo $model->contacttxt;?> <br />
        <?php 
        if($model->depart !=''){
            ?>
             <b><?php echo Yii::t('app','Día de llegada');?>:</b> <?php echo $model->depart;?> <br />
         <?php
        }
        if($model->arrivaldate_other_m !='' && $model->arrivaldate_other_y !=''){
            ?>
            <b><?php echo Yii::t('app','Si no, ¿Qué mes prefieres?');?>:</b> <?php echo $model->arrivaldate_other_m;?> <?php echo $model->arrivaldate_other_y;?> <br />
            <?php
        }
        ?> 
        <b><?php echo  Yii::t('app','Edad');?>: </b>
        <?php 
        if($model->age1 !=''){
            echo  $model->getAge($model->age1).', ';
        }
        if($model->age2 !=''){
            echo  $model->getAge($model->age2).', ';
        }
        if($model->age3 !=''){
            echo  $model->getAge($model->age3).', ';
        }
        if($model->age4 !=''){
            echo  $model->getAge($model->age4).', ';
        }
        if($model->age5 !=''){
            echo  $model->getAge($model->age5).', ';
        }
        if($model->age6 !=''){
            echo  $model->getAge($model->age6);
        }
        ?>        
        <br />
        <b><?php echo Yii::t('app','Comidas');?>: </b>  
        <?php 
        if($model->meals1 >0){
            echo  $model->getMeals($model->meals1).', ';
        }
        if($model->meals2>0){
            echo  $model->getMeals($model->meals2).', ';
        }
        if($model->meals3>0){
            echo  $model->getMeals($model->meals3).', ';
        }              
        ?>         
        <br />
        <b><?php echo Yii::t('app','Hotel');?>:</b>
        <?php 
        if($model->hotel1 >0){
            echo  $model->getHotelType($model->hotel1).', ';
        }
        if($model->hotel2>0){
            echo  $model->getHotelType($model->hotel2).', ';
        }
        if($model->hotel3>0){
            echo  $model->getHotelType($model->hotel3).', ';
        }
        if($model->hotel4>0){
            echo  $model->getHotelType($model->hotel4).', ';
        } 
         if($model->hotel5>0){
            echo  $model->getHotelType($model->hotel5).', ';
        }        
        ?>   
        <br />
        <b><?php echo Yii::t('app','Adulto');?>: </b> <?php echo $model->adult;?> <br />
        <b><?php echo Yii::t('app','Niños');?>: </b> <?php echo $model->children;?> <br />       
        <b><?php echo Yii::t('app','Mensaje');?>: </b> <?php echo $model->mess;?> <br /> 
        <?php
        if($model->how_did_id>0){
            ?>
            <b><?php echo Yii::t('app','¿Cómo nos encontrabas?');?>: </b>
            <?php
              echo '<br />-'.$model->getHowDidUs($model->how_did_id);   
            if($model->howdidtxt!=''){
              echo '<br />-'.$model->howdidtxt;    
            }
        }
        ?>
        <br />
        <b><?php echo Yii::t('app','Enlace');?>: </b> <a href="<?php echo $url;?>"><?php echo $url;?></a><br />      
</div>
<div><br /><?php echo Yii::t('app', 'Atentamente,<br />Equipo de Authentik Travel');?></div>