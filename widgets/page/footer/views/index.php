<?php
use yii\helpers\Url;
//use common\models\Menu;
?>
<div id="footer">
 <div class="uk-panel uk-clearfix"> 

    <div class="uk-container uk-container-center headfooter">
        <div class="uk-grid">
            <div class="uk-width-1-4">
               <a href="<?php echo Yii::$app->homeUrl;?>">
                   <img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/logofooter.png" alt="Authentik Travel" />
                </a>
            </div>
             <div class="uk-width-1-4">
                   <h3 class="uk-h3 titlefooter">
                    <?php echo Yii::t('app','Notas legales');?>
                    </h3>
            </div>
             <div class="uk-width-1-4">
                <h3 class="uk-h3 titlefooter">                    
                    <?php echo Yii::t('app','Contáctanos');?>
                </h3>
            </div>
             <div class="uk-width-1-4">
                <h3 class="uk-h3 titlefooter">                    
                    <?php echo Yii::t('app','Obtener actualización');?>
                </h3>
            </div>
        </div>
    </div> 
    <div class="uk-container uk-container-center contentfooter">
        <div class="uk-grid">
            <div class="uk-width-1-4">
            Somos una agencia local de viajes ubicada en Hanói, especializada en viajes a medida por Indochina y Myanmar para viajeros solo, parejas, familias o grupos de amigos.
           <br />  <center><a rel="nofollow" href="https://www.tripadvisor.es/Attraction_Review-g293924-d11641267-Reviews-Authentik_Vietnam_Travel-Hanoi.html" target="_blank">
                   <img style="margin-top:8px !important;" src="<?php echo Yii::$app->homeUrl;?>themes/web/img/Authentik-Certificate-Tripbt.png" alt="Authentik Travel Certificate Tripbt" />
                </a>
                </center> 
            </div>
             <div class="uk-width-1-4">
                AUTHENTIK VIETNAM CO. ,LTD<br /><br />
                Nuestra compañía se encuentra registrada bajo el número 010591826 en el Departamento de Planificación e Inversiones de Hanói.<br /><br />
                El número de Licencia internacional de operación de viaje: 01-611/2014/TCDL-GPLHQT.<br />
                Aprobado por la Administración nacional de Turismo de Vietnam.<br /><br />
            </div>
             <div class="uk-width-1-4">
               <ul class="uk-grid">
                  <li style="height:70px;" class="address-footer"><i class="uk-icon-home uk-icon-small"></i> <?php echo Yii::t('app','3 Phan Huy Ich, Nguyen Trung Truc, Distrito Ba Dinh, Ha Noi, Vietnam (4ª planta)');?>.</li>   
                  <li style="margin-bottom: 14px;"><i class="uk-icon-phone uk-icon-small"></i>+84 (0) 24 39 27 11 99 or <br /><font style="padding-left: 18px;padding-bottom: 10px;"> +84 (0) 24 62 90 55 99</font></li> 
                  <li style="height:50px;" ><i class="uk-icon-mobile-phone uk-icon-small"></i>+34653143254 (Whatsapp/viber)</li>                   
                  <li><a href="skype:sales@authentiktravel.com?call"><i class="uk-icon-skype uk-icon-small"></i>Skype: sales@authentiktravel.com</a></li>
                  <li><a href="mailto:es@authentiktravel.com"><i class="uk-icon-envelope-o"></i>es@authentiktravel.com</a></li>
                  <li><i class="internet"></i> &nbsp;&nbsp;<a href="<?php echo Yii::$app->homeUrl;?>" target="_blank">www.authentiktravel.es</a></li>
                  <li style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo Yii::$app->homeUrl;?>sitemap.html" target="_blank">Sitemap</a></li>
                </ul>
            </div> 
             <div class="uk-width-1-4 boxgetupdate">
                        <a href="https://www.facebook.com/authentiktravel" target="_blank"><i class="uk-icon-facebook uk-icon-small">  </i></a>
                        <a href="https://twitter.com/Authentikvn" target="_blank"><i class="uk-icon-twitter uk-icon-small">  </i></a>
                        <a href="https://plus.google.com/u/0/+AuthentikVietnamVoyages" target="_blank"><i class="uk-icon-google-plus uk-icon-small"> </i></a>
                        <a href="https://www.youtube.com/user/authentikvietnam" target="_blank"><i class="uk-icon-youtube-play uk-icon-small"></i></a>                        
                        <div class="boxsubscribe">
                        <?php echo Yii::t('app','¡Suscríbete a nuestros boletines para obtener una inspiración única para tus vacaciones y viajes!');?>                         
                        </div>                       
                        <form class="uk-form">                                  
                                <div class="uk-form-row">
                                    <input class="uk-form-width-medium" id="emailsubcribe" name="emailsubcribe" placeholder="<?php echo Yii::t('app','Tu correo electrónico');?>" type="text" />
                                </div>                        
                                 <button class="btn btn-warning subcribe" type="button" id="sendsubcribe"><?php echo Yii::t('app','Suscribir');?></button>
                         </form>
            </div>
        </div>
    </div>              
    <div id="copyright">
        <div class="uk-container uk-container-center">               
                <i class="uk-icon-copyright"></i> Copyright 2018 Authentik Travel  
                <span style="float: right;" id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=MlozFYrI0EhHnXWZ2pwxzRtpyOK9Y0DbdIS2nFbQwcfpgFnWiS4o63Wb07Zl"></script></span>
        </div>
    </div>
     </div>
</div> 
<script language="javascript">
$('#sendsubcribe').click(function(){    
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