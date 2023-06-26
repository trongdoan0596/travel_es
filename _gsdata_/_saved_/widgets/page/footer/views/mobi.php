<?php
use yii\helpers\Url;
?>
 <div id="footer">
    <div class="uk-container uk-container-center headfooter">
        <div class="uk-width-*">
             <div class="footerlogo">
                <a href="<?php echo Yii::$app->homeUrl;?>">
                   <img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/logofooter.png" alt="Authentik Travel" />
                </a>
             </div>
              <div class="footercontact" style="padding-top: 30px;">
              Somos una agencia local de viajes ubicada en Hanói, especializada en viajes a medida por Indochina y Myanmar para viajeros solo, parejas, familias o grupos de amigos.
              </div>
             <div class="footercontact">
                  <h6><?php echo Yii::t('app','Notas legales');?></h6>
                 AUTHENTIK VIETNAM CO. ,LTD<br />
                 Nuestra compañía se encuentra registrada bajo el número 010591826 en el Departamento de Planificación e Inversiones de Hanói.<br />
                 El número de Licencia internacional de operación de viaje: 01-611/2014/TCDL-GPLHQT.<br />
                 Aprobado por la Administración nacional de Turismo de Vietnam.<br />
             </div>
              <div class="footercontact">
                  <h6><?php echo Yii::t('app','Contáctanos');?></h6>
                  <font class="footertitle">Dir:</font> <?php echo Yii::t('app','3 Phan Huy Ich, Nguyen Trung Truc, Distrito Ba Dinh, Ha Noi, Vietnam (4ª planta)');?>.<br />
                    <font class="footertitle">Tel:</font> +84 (0) 24 39 27 11 99<br />+84 (0) 24 62 90 55 99<br />
                    <font class="footertitle">Cell:</font> +84912121091 (Whatsapp/viber)<br />
                    <font class="footertitle">Skype:</font> sales@authentiktravel.com<br />
                    <font class="footertitle">W:</font><a href="<?php echo Yii::$app->homeUrl;?>" target="_blank"> www.authentiktravel.es.</a><br />
                    <font class="footertitle">E:</font><a href="mailto:es@authentiktravel.com"> es@authentiktravel.com</a>
             </div>
              <div class="footercontact">
                  <h6><?php echo Yii::t('app','Obtener actualización');?></h6>
                      <a href="https://www.facebook.com/authentiktravel" target="_blank"><i class="uk-icon-facebook uk-icon-small"> </i></a>
                      <a href="https://twitter.com/Authentikvn" target="_blank"><i class="uk-icon-twitter uk-icon-small">  </i></a>
                      <a href="https://plus.google.com/u/0/+AuthentikVietnamVoyages" target="_blank"><i class="uk-icon-google-plus uk-icon-small"> </i></a>
                      <a href="https://www.youtube.com/user/authentikvietnam" target="_blank"><i class="uk-icon-youtube-play uk-icon-small"></i></a>  
                  <br /><br />    
                 <?php echo Yii::t('app','¡Suscríbete a nuestros boletines para obtener una inspiración única para tus vacaciones y viajes! ');?>
                  <br />   <br />  
                   <form class="uk-form">                                  
                                <div class="uk-form-row">
                                    <input class="uk-form-width-medium" id="emailsubcribe" name="emailsubcribe" placeholder="<?php echo Yii::t('app','Tu correo electrónico');?>" type="text" />
                                </div>                        
                                 <button class="btn btn-warning subcribe" type="button" id="sendsubcribe"><?php echo Yii::t('app','Suscribir');?></button>
                   </form>
                 <br />
                <!-- <a href="#header" class="uk-button" style="float: right;background: #2a2a2a;" data-uk-smooth-scroll><i class="uk-icon-angle-double-up uk-icon-medium" style="color:#009933;"></i></a>-->
              </div>
        </div>
        <div style="display: none;"><a href="<?php echo Yii::$app->homeUrl;?>sitemap.html" target="_blank">Sitemap</a></div>
        <div>  <i class="uk-icon-copyright"></i> Copyright 2018 Authentik Travel  </div>
         <br /> 
         <br />
         <br />
         <br />     
    </div>    
 </div>
<div id="menufooter" >
        <div class="uk-container-center">               
              <div class="uk-grid">
                    <div class="uk-width-1-4"><a href="<?php echo Url::toRoute(array('tour/alltour'));?>" class="linktxt"><i class="uk-icon-search uk-icon-medium"></i> <br />Buscar</a></div>
                    <div class="uk-width-1-4"><a href="<?php echo Url::toRoute(array('tour/customize'));?>" class="linktxt"><i class="uk-icon-pencil-square-o uk-icon-medium"></i><br />Viaje a medida</a></div>
                    <div class="uk-width-1-4"><a href="<?php echo Url::toRoute(array('site/contactus'));?>" class="linktxt"><i class="uk-icon-phone uk-icon-medium"></i><br />Contáctanos </a></div>
                    <div class="uk-width-1-4"> 
                     	<a href="#offcanvas" class="uk-navbar-toggle" data-uk-offcanvas="{mode:'reveal'}" style="float: right; padding-right:50px !important;" ></a>
                    </div>            	
               </div>
        </div>
</div>
<script language="javascript">
$('#sendsubcribe').click(function() {
      var expression = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
      var url    = urlbase+"/newsletters/addnewsletter";
      var e_mail =  $("#emailsubcribe").val();       
      if (expression.test(e_mail)) {
           $.ajax({
        			type: "POST",
        			url: url,
        			data: ({"e_mail":e_mail}),
        			dataType: "json"			
        			}).done(function(data){
        			    alert(data['msg']);
            			if(data['error'] == 1){
            			   $("#emailsubcribe").val('');  
            		    }
                        
        	    });
        }else {
           alert('<?php echo Yii::t('app','Error validate email!');?>'); 
           return false;
        } 
});
</script>