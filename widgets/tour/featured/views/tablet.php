<?php
//use common\models\Tour;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
if(!empty($rows)){
      $i = 0;$title="Hightlights Tours";$fulltxt="";
      if(!empty($info)){
            $title   = $info->title;
            $fulltxt = $info->fulltxt;// HtmlPurifier::process($info->fulltxt);
      }
$urlall = Url::toRoute(array('tour/alltour'));
?>            
<div class="boxhightlight">
     <div class="uk-container uk-container-center boxhome">    
              <h6 class="uk-h1 uk-text-center"><a href="<?php echo $urlall;?>"><?php echo $title;?></a></h6>  
              <div class="uk-text-center txthome"><?php echo $fulltxt;?></div>              
              <div class="boximagehome1 uk-grid">                 
                <?php
                      $i=0;
                      foreach($rows as $row){                          
                         $title = $row->title;
                         $url   = $row->createUrl($row);
                         $num_day = $row->num_day;
                         if($row->num_day<=9){
                            $num_day = '0'.$row->num_day;
                         }
                         
                         $img = '';
                         switch ($i) {
                                case 0:                                   
                                case 1:                                    
                                case 2:
                                   $img = $row->getImage($row,340,270,'img1');
                                    break;
                                case 3:
                                   $img = $row->getImage($row,430,270,'img2');
                                    break;
                                case 4:
                                   $img = $row->getImage($row,610,270,'img3');
                                    break;         
                            }
                         $divfade =  $i%3;
                         $fadetype= "uk-animation-fade";
                         $delay   = 100;
                        /* switch ($divfade) {
                            case 0:
                                $fadetype = "uk-animation-slide-left";
                                $delay   =250;
                                break;
                            case 1:
                                $fadetype = "uk-animation-scale-up";
                                $delay   =280;
                                break;
                            case 2:
                                $fadetype = "uk-animation-slide-right";
                                $delay   =320;
                                break;
                        }
                        */        
                        if($i<=2){
                                      
                                 ?>
                                  <div class="uk-width-1-3 boxitemhome1 itemhome-<?php echo $i;?>-fix" data-uk-scrollspy="{cls:'<?php echo $fadetype;?>',delay:<?php echo $delay;?>, repeat: false}">
                                     <div class="infohightlights">
                                           <a class="border-top-left-img-4 hover-effect" href="<?php echo $url;?>"><img src="<?php echo $img;?>" alt="<?php echo $title;?>"  /></a>
                                            <div id="boxday">
                                                  <span class="numdays"><?php echo $num_day;?></span>
                                                  <span class="txtday">Días</span>
                                             </div>
                                           <h2 class="caption-title">
                                                  <span class="boxcaption">
                                                     <a href="<?php echo $url;?>" class="title-heightlight"><?php echo $title;?></a>   
                                                  </span>                                 
                                            </h2>
                                     </div>
                                  </div> 
                                <?php
            
                        }  
                        if($i==3){
                            ?>
                             <div class="uk-width-4-10 itemhome-<?php echo $i;?>-fix" data-uk-scrollspy="{cls:'<?php echo $fadetype;?>',delay:<?php echo $delay;?>, repeat: false}">
                                     <div class="infohightlights">
                                           <a class="border-top-left-img-4 hover-effect" href="<?php echo $url;?>"><img src="<?php echo $img;?>" alt="<?php echo $title;?>"  /></a>
                                            <div id="boxday">
                                                  <span class="numdays"><?php echo $num_day;?></span>
                                                  <span class="txtday">Días</span>
                                             </div>
                                           <h2 class="caption-title">
                                                  <span class="boxcaption">
                                                     <a href="<?php echo $url;?>" class="title-heightlight"><?php echo $title;?></a>   
                                                  </span>                                 
                                            </h2>
                                     </div>
                                  </div> 
                            <?php
                        }                          
                         if($i==4){
                            ?>
                             <div class="uk-width-6-10 itemhome-<?php echo $i;?>-fix" data-uk-scrollspy="{cls:'<?php echo $fadetype;?>',delay:<?php echo $delay;?>, repeat: false}">
                                     <div class="infohightlights">
                                           <a class="border-top-left-img-4 hover-effect" href="<?php echo $url;?>"><img src="<?php echo $img;?>" alt="<?php echo $title;?>"  /></a>
                                            <div id="boxday">
                                                  <span class="numdays"><?php echo $num_day;?></span>
                                                  <span class="txtday"><?php echo  Yii::t('app','Días');?></span>
                                             </div>
                                           <h2 class="caption-title">
                                                  <span class="boxcaption">
                                                     <a href="<?php echo $url;?>" class="title-heightlight"><?php echo $title;?></a>   
                                                  </span>                                 
                                            </h2>
                                     </div>
                                  </div> 
                            <?php
                        }   
                $i++;
          }
          ?>        
    </div>
    <br />
    <div class="viewall"><a href="<?php echo $urlall;?>"><?php echo  Yii::t('app','Ver más nuestros recorridos');?></a></div>
</div>
</div>
 <?php
}
?>