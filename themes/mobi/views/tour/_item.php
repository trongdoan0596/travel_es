 <?php
use yii\helpers\Html;
//use yii\helpers\HtmlPurifier;
 $title = Html::encode($row->title);
 $url = $row->createUrl($row);
 $img = $row->getImage($row);
 $num_day = $row->num_day;
 if($row->num_day<=9){
    $num_day = '0'.$row->num_day;
 }
?>
<div class="item">
        <center>
               <div class="boxday uk-border-circle">
                      <span class="numdays"><?php echo $num_day;?></span>
                      <span class="txtday"><?php echo Yii::t('app', 'Días');?></span>
               </div> 
       </center>
       <div class="contentbox">
              <p>
                <a href="<?php echo $url;?>">
                  <img src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                </a>    
               </p>   
               <p class="readmore uk-container-center"><a class="btnreadmore" href="<?php echo $url;?>"><?php echo Yii::t('app', 'Leer más');?> <i class="uk-icon-caret-right"></i></a></p>
               <div class="boxinfo">
                   <p class="title">
                       <a href="<?php echo $url;?>"><?php echo $title;?> </a> 
                    </p>
                     <p class="shorttxt">
                        <?php echo $row->shorttxt;?>
                     </p>
                      <?php
                       if($row->price_from!=''){
                        ?>                  
                            <p class="shorttxt"><?php echo Yii::t('app','From');?> <font class="pricefrom"><?php echo $row->price_from;?></font></p> 
                         <?php
                       }
                     ?>         
               </div>
       </div>
</div>
