<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Spaceless;
use app\widgets\page\header\Header;
use app\widgets\page\footer\Footer;
use app\widgets\setting\settinghome\Settinghome;
//use app\widgets\setting\settingdefault\Settingdefault;
use app\assets\AppAsset;
AppAsset::register($this);
?> <?php Spaceless::begin(); ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-control" content="max-age=7200,public" />   
    <meta name="robots" content="index,follow,noarchive" />
    <meta name="google" content="notranslate" />
    <meta http-equiv="content-language" content="<?= Yii::$app->language ?>" />
    <meta name="google" content="nositelinkssearchbox" />
    <meta name="google-site-verification" content="-p3-_86I8T_O3PkAcvwR-XmriKptEYPtPLhOF1KJl_M" />
    <meta name="author" content="Authentik Travel" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta property="fb:app_id" content="826906504136544" /> 
    <link href="<?php echo Url::base();?>/themes/web/ico/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <base href="<?php echo Url::base();?>" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title> 
    <?php $this->head()?> 
     <script language="javascript">      
        var urlbase ='<?php echo Url::base();?>';        
    </script> 
    <?php  echo Settinghome::widget(array('view' =>'index'));?>    
      <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NG7XGVK');</script>
    <!-- End Google Tag Manager -->
    <script>
    !function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:r})},n.r=function(e){Object.defineProperty(e,"__esModule",{value:!0})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=1)}([function(e,t,n){"use strict";e.exports={isDefined:function(e){return"function"==typeof e.zE},setupGlobalApiQueue:function(){var e=[],t=function(){e.push(arguments)};return t._=e,t.t=Date.now(),t},loadAssetComposerScript:function(e,t){var n=e.createElement("script");n.type="text/javascript",n.src=t,n.setAttribute("charset","utf-8"),n.async=!0,e.getElementsByTagName("head")[0].appendChild(n)}}},function(e,t,n){"use strict";var r=n(0);!function(e,t){if(!r.isDefined(e)){var n=r.setupGlobalApiQueue();e.zE=n,e.zEmbed=n}r.loadAssetComposerScript(t,"https://static.zdassets.com/ekr/asset_composer.65d6996a8775923299b3.js")}(window,document)}]);
    </script>
 <!-- Start of  Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=95439ab4-d4f7-4f70-9dd1-d5a1d2f98aa6"> </script>
<!-- End of  Zendesk Widget script -->

</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NG7XGVK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div id="wrapper" class="wrapper"> 
        <?php $this->beginBody() ?>
        <?php
           echo Header::widget(array('view' =>'index'));
           echo $content;
           echo Footer::widget(array('view' =>'index'));
           ?>
            <section id="rightfly" class="widget widget-fly">
                      <div class="widget-heading">
                           <h4 class="spb-heading"><span><?php echo Yii::t('app', 'Propuesta &nbsp; gratis');?></span></h4>
                      </div>
                      <div class="sidebar-fly">
                         <ul>
                           <li>
                               <a href="https://authentiktravel.es/proponer-tu-plan-de-viaje">
                                   <span class="advisory-free"><?php echo Yii::t('app', 'Propuesta gratis');?></span>
                                   <span class="advisory-small" style="white-space: nowrap;"><?php echo Yii::t('app', 'Responder dentro de 24 hrs');?></span>
                               </a>
                           </li>
                           <li>
                               <a href="https://authentiktravel.es/contacta-con-nosotros">
                                   <span class="call-free"> <?php echo Yii::t('app', 'Dejar tu');?>  </span>
                                   <span class="call-two"><?php echo Yii::t('app', 'número');?></span><span class="call-small"> <?php echo Yii::t('app', 'Te llamaremos');?>  </span>
                               </a>
                           </li>
                           </ul>
                      </div>
             </section> 
        <?php $this->endBody() ?> 
    </div> 
  <div id="fb-root"></div>      
  <script language="javascript">  
         (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.10&appId=826906504136544";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
  </script>     
  <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>   
  <a id="scrollfooter" href="#wrapper" class="uk-button uk-float-right" style="display: none;"  data-uk-smooth-scroll><i class="uk-icon-angle-double-up uk-icon-medium"></i><span style="display: block !important;margin-top: -5px !important;">Arriba</span></a>
  <script>
    $(window).scroll(function(){
        if($(this).scrollTop()<=20){           
            $('#scrollfooter').hide();         
        }else{         
         $('#scrollfooter').show();
        }
      });
  </script>  
  <a id="whatsapp" target="_blank" class="uk-float-right" href="https://web.whatsapp.com/send?phone=+84912121091">
   <img src="<?php echo Url::base();?>/themes/web/img/whatsapp-logo.png" alt="WhatsApp" />
</a>
</body>
</html>
<?php
//echo 'Browser:<br />'.Yii::$app->request->userAgent;
//echo Yii::$app->getRequest()->getResponse();
//$headers = Yii::$app->request->headers;
//print_r($headers);
?>
<?php $this->endPage() ?>
 <?php Spaceless::end(); ?>