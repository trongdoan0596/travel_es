 <?php
use yii\helpers\Html;
//use yii\helpers\HtmlPurifier;
 $title = Html::encode($row->title);
 $url = $row->createUrl($row);
 $img = $row->getImage($row,370,221);//$row->getImage($row,340,270);
 $num_day = $row->num_day;
 if($row->num_day<=9){
    $num_day = '0'.$row->num_day;
 }
?>
<div class="uk-width-1-3">       
  <div class="boxitemtour">
       <a class="border-top-left-img-4 hover-effect" href="<?php echo $url;?>">
          <img src="<?php echo $img;?>" alt="<?php echo $title;?>" />
       </a>      
       <span class="readmore"><a class="btn btnreadmore" href="<?php echo $url;?>"><?php echo Yii::t('app', 'Leer más');?> <i class="uk-icon-caret-right"></i></a></span>
       <div class="boxinfo">
           <p class="title">
               <a href="<?php echo $url;?>"><?php echo $title;?></a> 
            </p>
             <p class="shorttxt">
                <?php echo $row->shorttxt;?>
             </p>
            <div class="uk-grid">
               <div class="uk-width-1-2">    
                  <p class="days"><?php echo $num_day;?> <?php echo Yii::t('app', 'Días');?></p> 
               </div>
               <?php
               if($row->price_from!=''){
                ?>
                <div class="uk-width-1-2" style="padding-left: 0px !important;">    
                    <p class="days"><?php echo Yii::t('app','From');?> <font class="pricefrom"><?php echo $row->price_from;?></font></p> 
                </div>
                <?php
               }
               ?>               
             </div>  
                   
        </div>
  </div>
</div>