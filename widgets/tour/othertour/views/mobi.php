<?php
use yii\helpers\Html;
if(!empty($rows)){
      $i = 0;
      ?>
      <h6><?php echo Yii::t('app','Otros tours');?> </h6>
      <div class="othertour">   
            <?php
              foreach($rows as $row){                          
                 $title = $row->title;                
                 $url   = $row->createUrl($row);
                 $num_day = $row->num_day;
                 if($row->num_day<=9){
                    $num_day = '0'.$row->num_day;
                 }
                 $cls='bordertop';
                 ?>
                 <div class="item">
                     <?php
                     if($row->img !=''){
                         $img = $row->getImage($row);
                          $cls='';
                        ?>
                         <a class="border-top-left-img-4 hover-effect" href="<?php echo $url;?>"><img src="<?php echo $img;?>" alt="<?php echo $title;?>" /></a>
                        <?php
                     }
                     ?>                      
                       <div class="boxinfo <?php echo $cls;?>">
                            <p class="title"><a href="<?php echo $url;?>"><?php echo $title;?></a></p>
                             <p class="shorttxt">
                                <?php echo $row->shorttxt;?>
                             </p>
                            <p class="days"><?php echo $num_day;?> <?php echo Yii::t('app','Día');?></p>
                             <?php
                               if($row->price_from!=''){
                                ?>
                                    <p class="days"><?php echo Yii::t('app','From');?> <font class="pricefrom"><?php echo $row->price_from;?></font></p> 
                               <?php
                               }
                               ?>   
                            <p class="readmore">                            
                               <a class="btnreadmore" href="<?php echo $url;?>"><?php echo Yii::t('app','Leer más');?> <i class="uk-icon-caret-right"></i></a>                            
                           
                            </p>
                       </div>
                  </div>
                 <?php
              }
             ?> 
        </div>  
    <?php
      $i++;
    }
 ?> 