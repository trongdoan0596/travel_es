<?php
use yii\helpers\Url;
?>
<div id="header">
  <div class="uk-container-center">
            <nav class="uk-navbar navbar-top">  
            	<a href="#offcanvas" class="uk-navbar-toggle" data-uk-offcanvas="{mode:'reveal'}" style="float: right;" ></a>
            	<div class="uk-navbar-flip">
            		<ul class="uk-navbar-nav">        
                   <?php
                   // if(Yii::$app->user->getIsGuest()){
                       ?>
                        <!--<li class="login"><a href="<?php //echo Url::toRoute(array('account/login'));?>">Login</a></li>-->
                       <?php    
                       // }else{
                            //$account = Yii::$app->user->identity;
                            ?>
                            <!--  <li class="login">Hi <?php //echo $account->username; ?> | <a href="<?php //echo Url::toRoute(array('account/logout'));?>">Logout</a></li>-->
                        <?php   
                    // }
                    ?>
            		</ul>
            	</div>
            	<div class="uk-navbar-center">
                    <a href="<?php echo Yii::$app->homeUrl;?>" class="logo-link">
                        <img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/authentiktravel.png" alt="Authentik Travel" />
                    </a>
                </div>
                 <div class="uk-navbar-left" style="width: 100% !important;padding-left:10px !important;margin-top:-40px !important;">
                    <a target="_blank" href="https://authentiktravel.com/"><img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/flag/en.png" alt="English" /></a>
                    <a target="_blank" href="https://authentikvietnam.com" style="margin-left:10px;"><img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/flag/fr.png" alt="Français" /></a>
                </div>
            </nav>
</div>
</div>
