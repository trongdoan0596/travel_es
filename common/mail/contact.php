<?php
if($admin==1){
    ?>
      Hi Administrator,<br />
     <?php echo Yii::t('app','You received email from clients as below:');?><br /><br />
    <?php
}else{
    ?>
     <?php echo Yii::t('app','Hola');?> <?php echo $model->title;?>:<br /><br />
     <?php echo Yii::t('app','¡Muchas gracias por mandar tu petición a Authentik Travel!');?><br />
     <?php echo Yii::t('app','Este es un email de respuesta automática y nuestro equipo te comunicará dentro de 24 horas.');?><br />
     <?php echo Yii::t('app','Nos gustaría reconfirmar tu información a continuación:');?><br /><br />
    <?php
}
?>
<?php echo Yii::t('app','Género');?> : <?php echo $model->slcgender;?><br />
<?php echo Yii::t('app','Nombre completo');?> : <?php echo $model->title;?><br />
<?php echo Yii::t('app','Tu nacionalidad');?>: <?php echo $model->nationality;?><br />
<?php echo Yii::t('app','Tu número de teléfono');?>: <?php echo $model->phone;?><br />
<?php echo Yii::t('app','Email');?>: <?php echo $model->email;?><br />
<?php echo Yii::t('app','Cuenta de Skype');?>: <?php echo $model->skype;?><br />
<?php echo Yii::t('app','Tu Whatsapp');?>: <?php echo $model->whatsapp;?><br />
<?php echo Yii::t('app','Tu viber');?>: <?php echo $model->viber;?><br />
<?php echo Yii::t('app','¿Qué manera de comunicación prefieres ?');?>: <?php 
 if($model->contact1 !=''){
    echo $model->getContact($model->contact1).', ';
 }
 if($model->contact2 !=''){
    echo $model->getContact($model->contact2).', ';
 }
 if($model->contact3 !=''){
   echo $model->getContact($model->contact3).', ';
 }
 if($model->contact4 !=''){
   echo $model->getContact($model->contact4).', ';
 }  
 if($model->contact5 !=''){
   echo $model->getContact($model->contact5).', ';
 }      
?><br />
<?php echo Yii::t('app','Tu disponibilidad para conversar con nosostros via Skype/teléfono');?>: <?php echo $model->contacttxt;?><br />
<?php echo Yii::t('app','Sujeto');?>: <?php echo $model->subject;?><br />
<?php echo Yii::t('app','Tu mensaje');?>: <?php echo $model->mess;?><br />
<?php
if($admin==1){
    ?>
      IP : <?php echo Yii::$app->getRequest()->getUserIP();?><br />
    <?php
}else{
    ?><br />
    <?php echo Yii::t('app','¡Muchas gracias por tu interés en nuestros servicios!');?><br />
    <?php echo Yii::t('app','Equipo de Authentik Travel');?>
  <?php  
}
?>
<br /><br />