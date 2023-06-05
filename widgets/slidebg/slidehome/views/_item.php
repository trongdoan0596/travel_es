<?php
//use yii\helpers\Html;
use common\helper\StringHelper;
//use yii\helpers\Url;
?>
<li>       
         <img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/silde/<?php echo $img;?>" alt="<?php echo Yii::t('app','Tours a medida en privado');?>" />   
         <center> 
            <div class="uk-overlay-panel uk-vertical-top"> 
                     <div class="uk-vertical-align-middle">                                          
                          <div class="slidetitle"> 
                             <h2><?php echo Yii::t('app','Agencia Local de viajes en privado en Vietnam');?></h2>
                             <h3><?php echo Yii::t('app','Diseñamos viajes a medida según tus necesidades y tu presupuesto');?></h3>
                          </div>
                    </div>   
                   <div class="uk-position-bottom" style="padding-bottom: 60px;">
                        <div class="uk-container uk-container-center boxtravelplanhead">  
                            <div class="title-bottom">
                                <font class="title-bottom"><?php echo Yii::t('app','Crea tu viaje a medida con nosotros');?> | </font>  <?php echo Yii::t('app','Viajero Solo, Parejas, Familias o Grupos de Amigos');?>
                            </div> 
                        </div>
                        <div class="uk-container uk-container-center travelplan"> 
                             <form id="frmcustomize" method="get" action="<?php echo $urlpost;?>">
                                 <div class="boxslc" id="boxslc">
                                     <select name="slccouple">
                                           <option value="0"><?php echo Yii::t('app','---Tu viaje---');?></option>
                                           <option value="1"><?php echo Yii::t('app','Solo');?></option>
                                           <option value="2"><?php echo Yii::t('app','Pareja');?></option>
                                           <option value="3"><?php echo Yii::t('app','Con Amigos');?></option>
                                           <option value="4"><?php echo Yii::t('app','Familia');?></option>
                                           <option value="5"><?php echo Yii::t('app','Asociación /Club');?></option>
                                     </select>
                                     <span>en</span> 
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
                                    <a class="btn btntravelplan" href="#" onclick="javascript:$('#frmcustomize').submit();"><?php echo Yii::t('app','Proponer tu plan de viaje');?></a>
                                  </div>  
                             </form>                             
                        </div> 
                     </div>                              
            </div>                    
        </center>   
</li> 