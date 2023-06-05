<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use app\widgets\traveller\travellerreview\Travellerreview;
use app\widgets\page\servicework\Servicework;
use common\models\Tourcate;
use app\widgets\tour\othertour\Othertour;
use app\widgets\socialshare\Socialshare;
use common\helper\StringHelper;
$class_ex ='';$url_price='#';
if(!empty($model)){
    $class_ex ='slidesubbg_cate'.$model->cat_id;
    $url_price = Url::toRoute(array('tour/requestprice','tid'=>$model->id)); 


?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>$class_ex));?>
<div id="main" class="main-content"> 
      <div class="boxcontryside">     
          <div class="uk-container uk-container-center">    
            <?php    
            if(!empty($model)){
                    $cat_id = $model->cat_id;
                    $infocate = Tourcate::getDetailTourCate($cat_id);
                    $url_cate = Url::base().'/'.StringHelper::formatUrlKey($infocate->alias);//Tourcate::createUrl($infocate);
                    echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>$infocate->title,
                                    'url' =>$url_cate,
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),
                                array('label' =>$model->title,
                                      //'url' =>array('post/edit', 'id' => 1)
                                  ),
                                
                            ),
                         ));
                     echo $this->render('_map',array('model'=>$model,'details'=>$details));   
                     ?>
                    <div class="discover">
                         <div class="uk-grid">
                               <!-- <div class="uk-width-2-10 icon"></div>-->
                                <div class="uk-width-1-1 content">                               
                                <h2><?php echo Yii::t('app', 'Estarás interesado en :');?></h2>
                                 <?php echo $model->introtxt;//HtmlPurifier::process($model->introtxt);?>     
                                </div>
                         </div>                                     
                    </div>
                     <?php        
                    }else{
                        echo 'Updating!';
                    }   
                ?>                      
          </div>
      </div>
<!--detail-->
<?php 
if(!empty($details)){
    ?>
    <div class="detailprogram">
        <div class="uk-container uk-container-center">    
             <h3><?php echo Yii::t('app','Programa en detalle');?></h3>
             <div class="boxdetail">
                      <?php
                        foreach($details as $row){ 
                          echo $this->render('_days',array('row'=>$row));
                        }                            
                      ?>                       
             </div>
        </div>
    </div>  
    <?php
}
?>    
<!--End detail-->
<!--begin Service-->
<div class="boxserviceinclude">     
      <div class="uk-container uk-container-center">    
      <?php
          if($model->pax1!='' || $model->pax2!='' || $model->pax3!='' || $model->pax4!='' || $model->pax5!='' || $model->pax_single!=''){
            ?>
            <div class="serviceinclude" style="background: white;">
                  <h5 style="background: white;border-bottom: 0px !important; height: 30px !important; "><?php echo Yii::t('app','Precio del tour en privado');?></h5>                 
                  <div class="content">
                   <p align="center"><?php echo Yii::t('app','Los precios están cotizados en USD y por persona (Habitación twin/doble compartida - Alojamiento de 3 estrellas) <br />Válido hasta el 31 de Diciembre 2018');?></p>
                   <table class="uk-table tablepax">                  
                        <tbody>
                            <tr>
                                <td class="titlepricepax" width="25%"><?php echo Yii::t('app','Tamaño del grupo');?></td>
                                <td class="titlepricepax uk-text-center" width="15%"><?php echo Yii::t('app','1 persona');?></td>
                                <td class="titlepricepax uk-text-center" width="15%"><?php echo Yii::t('app','2 persona');?></td>
                                <td class="titlepricepax uk-text-center" width="15%"><?php echo Yii::t('app','3 - 4  persona');?></td>
                                <td class="titlepricepax uk-text-center" width="15%"><?php echo Yii::t('app','5 - 7 persona');?></td>
                                <td class="titlepricepax uk-text-center" width="15%"><?php echo Yii::t('app','>8 persona');?></td>
                            </tr>
                            <tr>
                                <td class="titlepricepax"><?php echo Yii::t('app','Precio total/persona');?></td>
                                <td class="uk-text-center pricepax"><?php echo $model->pax1;?></td>
                                <td class="uk-text-center pricepax"><?php echo $model->pax2;?></td>
                                <td class="uk-text-center pricepax"><?php echo $model->pax3;?></td>
                                <td class="uk-text-center pricepax"><?php echo $model->pax4;?></td>
                                <td class="uk-text-center pricepax">
                                 <?php
                                    if( $model->pax5=='Contact us' || $model->pax5=='contact us' || $model->pax5=='Contact' || $model->pax5=='contact'){
                                        echo '<a href="'.Url::toRoute(array('site/contacta-con-nosotros')).'" class="pricepax">'.$model->pax5.'</a>';
                                    }else{
                                        echo $model->pax5;
                                   }                                
                                 ?>    
                               </td>
                            </tr>
                            <tr>
                                <td class="titlepricepax"><?php echo Yii::t('app','Suplemento individual');?></td>
                                <td colspan="5" class="uk-text-center pricepax">
                                     <?php echo $model->pax_single;?>                           
                                </td>
                            </tr>
                        </tbody>
                    </table>  
                   
                   </div>
              </div>
            <?php
          }
          ?> 
             
            <div class="uk-grid">
                 <div class="uk-width-1-2">
                     <div class="serviceinclude">
                          <h5><?php echo Yii::t('app','Servicios incluidos');?></h5>
                          <div class="content">
                           <?php echo $model->price_include;//HtmlPurifier::process($model->price_include);?>    
                           </div>
                     </div>
                </div>
                <div class="uk-width-1-2">
                    <div class="notserviceinclude">
                          <h5><?php echo Yii::t('app','Servicios excluidos');?></h5>
                          <div class="content">
                          <?php echo $model->price_not_include;//HtmlPurifier::process($model->price_not_include);?>
                         </div>
                    </div>
                 </div>
             </div>   
              <div class="requestprize">
                 <a class="btn btn-warning btnrequest" href="<?php echo $url_price;?>"><?php echo Yii::t('app', 'Solicitar precio');?></a>
               </div>  
              <?php echo Socialshare::widget(array('view'=>'mobi','url'=>$urlshare));?> 
      </div>
</div>    
 <!--End begin Service--> 
 <!--Recomment-->
 <div class="boxrecomment">     
      <div class="uk-container uk-container-center">   
            <?php
            if(!empty($model)){
                echo Othertour::widget(array('cat_id'=>$model->cat_id,'tour_id' =>$model->id));
             }
            ?>
           <div class="boxbottom">            
               <ul class="uk-list">
                   <li>  
                     <?php echo Yii::t('app','Crear tu propio viaje o ver otras ideas de viaje');?>
                   </li>
                    <li>  
                    <?php echo Html::a(Yii::t('app','Diseñar tu plan de viaje'),array('customize'), array('class' => 'btn btn-warning btnplan')) ?>
                     &nbsp;&nbsp; <?php echo Yii::t('app','o');?> &nbsp;&nbsp; 
                     <?php echo Html::a(Yii::t('app','Ver todos tours'),array('alltour'), array('class' => 'btn btn-warning btnalltour')) ?>
                   </li>
               </ul>
           </div>   
      </div>
</div>    
 <!--End Recomment-->
 <?php echo Servicework::widget(array('view' =>'tour'));?>
 <?php echo Travellerreview::widget(array('view' =>'detailtour'));?>
 </div>
<?php
}else{
    echo '404!';
}
?>