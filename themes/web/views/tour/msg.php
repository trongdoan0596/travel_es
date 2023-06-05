<?php
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
$url_all = Url::toRoute(array('tour/alltour'));
?>
<div id="main" class="main-content"> 
      <div class="main-customize">     
          <div class="boxcustomize">
              <div class="uk-container uk-container-center" style="padding-top:0px;">   
               <?php
                echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>Yii::t('app','Nuestras inspiraciones'),
                                    'url' =>$url_all,
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),  
                            ),
                         ));
              ?>             
               <div class="contryside">
                     <h1><?php echo Yii::t('app', '¡MUCHAS GRACIAS!');?></h1>
                     <div class="uk-container-center thanksmsg" style="text-align: center !important">
                         <br /><?php echo $msg;?><br />
                         <br />
                     </div>
                </div>
              </div>
          </div>
      </div> 
</div>