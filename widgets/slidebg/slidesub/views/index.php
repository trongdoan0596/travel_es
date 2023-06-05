<?php
use yii\helpers\Html;
use common\helper\StringHelper;
use yii\helpers\Url;
?>
<div class="slidesubbg <?php echo $class_ex;?>">   
    <div class="subbghead"></div>
    <div class="subbgcontent">
           <div class="uk-container uk-container-center">           
                        <div class="uk-grid">
                            <div class="uk-width-1-2 subbg1">                                                                
                                  <h2><?php echo Yii::t('app','Crear tus viajes a medida con nosotros');?></h2>
                                  <h3><?php echo Yii::t('app','Viajero solo, parejas, familias y grupo de amigos');?></h3>                                  
                            </div>
                            <div class="uk-width-1-2 subbg2">
                                 <h4><?php echo Yii::t('app','Tu viaje');?></h4>  
                                 <form id="frmcustomize" method="get" action="<?php echo Url::toRoute(['tour/customize']);?>">
                                 <div class="boxslc" id="boxslc">
                                     <select name="slccouple">                                           
                                           <option value="1"><?php echo Yii::t('app','Solo');?></option>
                                           <option value="2"><?php echo Yii::t('app','Pareja');?></option>
                                           <option value="3" selected="selected"><?php echo Yii::t('app','Con Amigos');?></option>
                                           <option value="4"><?php echo Yii::t('app','Familia');?></option>
                                           <option value="5"><?php echo Yii::t('app','Asociación /Club');?></option>                                                                                </select>
                                     <span></span> 
                                     <select name="slcyear" id="slcyear">
                                     <option value=""><?php echo Yii::t('app','---Fecha de salida:---');?></option>
                                      <?php                                     
                                      $m = date('m');
                                      $n = 12- $m +12;
                                      for ($i = 0; $i <= $n; $i++) {
                                            $month = mktime (0,0,0,date("m")+$i,date("d"),date("Y"));
                                            $v = date("F Y",$month);
                                            echo '<option value="'.$v.'">'.StringHelper::ConvertMonth( $v ).'</option>';
                                        }

                                      ?>
                                     </select>
                                 </div>  
                                 <a class="btn btntravelplan" href="#" onclick="javascript:$('#frmcustomize').submit();"><?php echo Yii::t('app','Proponer tu plan de viaje');?></a>
                                 </form> 
                             </div>
                        </div>
                  
            </div>
      </div>  
</div>