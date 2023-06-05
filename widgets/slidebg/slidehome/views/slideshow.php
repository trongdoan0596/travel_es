<?php
use yii\helpers\Html;
?>
<div class="slidebg" data-uk-slideshow="{animation:'slice-down',autoplay:true,autoplayInterval:7000,duration:400}">    
    <ul class="uk-slideshow">
        <li >
         <img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/bgslide.png" />  
           <div class="uk-container uk-container-center"> 
                   <div class="uk-align-right travelplan">
                     <h3>Design your tailor-made holidays<br /><br />
                     with a local travel agent</h3>             
                      <?php echo Html::a('Design your travel plan',array('#'), array('class' => 'btn btntravelplan')) ?>
                   </div>
</div>
        </li>
        <li><img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/bgslide-1.png" />
       <div class="uk-container uk-container-center"> 
                   <div class="uk-align-right travelplan">
                     <h3>Design your tailor-made holidays<br /><br />
                     with a local travel agent</h3>             
                      <?php echo Html::a('Design your travel plan',array('#'), array('class' => 'btn btntravelplan')) ?>
                   </div>
</div>
        </li>
        <li><img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/bgslide-new.png" />
         <!--<div class="uk-overlay-panel uk-overlay-background "></div>-->
         <div class="uk-container uk-container-center"> 
                   <div class="uk-align-right travelplan">
                     <h3>Design your tailor-made holidays<br /><br />
                     with a local travel agent</h3>             
                      <?php echo Html::a('Design your travel plan',array('#'), array('class' => 'btn btntravelplan')) ?>
                   </div>
</div>
        </li>
    </ul>    
           
</div>
