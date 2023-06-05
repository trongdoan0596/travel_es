<?php
//use yii\helpers\Html;
//use common\helper\StringHelper;
//use yii\helpers\Url;
?>
<li>       
     <img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/silde/<?php echo $img;?>" alt="<?php echo Yii::t('app','Tours a medida en privado');?>" />     
     <center>     
        <div class="uk-overlay-panel uk-vertical-align boxitem"> 
                 <div class="uk-vertical-align-middle">
                     <div class="uk-container-center travelplan">                           
                            <h3><?php echo Yii::t('app','Agencia Local de viajes en privado en Vietnam');?><br /></h3>  
                            <p><?php echo Yii::t('app','Diseñamos viajes a medida según tus necesidades y tu presupuesto');?></p>            
                            <div class="boxbuttom"><br /><br /><br />
                              <a class="btn btn-warning btntravelplan" href="<?php echo $urlpost;?>"><?php echo Yii::t('app','Proponer tu plan de viaje');?></a>
                            </div>                            
                       </div>   
                </div>              
        </div>
    </center>   
</li>