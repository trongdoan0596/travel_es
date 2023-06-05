<?php
//use common\models\Tour;
use yii\helpers\HtmlPurifier;
if(!empty($rows)){
      $i = 0;$title=Yii::t('app','Highlight tour selections');$fulltxt="";
      if(!empty($info)){
            $title   = $info->title;
            $fulltxt = $info->fulltxt;//HtmlPurifier::process(strip_tags($info->fulltxt));
      }
    //  $info
?>            
<div class="boxhightlight">
     <div class="uk-container-center boxhome">    
              <h1 class="uk-h1 uk-text-center"><?php echo $title;?></h1>  
              <div class="uk-text-center txthome"><?php echo $fulltxt;?></div>
              <div  class="uk-container-center ">
              <div class="uk-slidenav-position" data-uk-slideshow="height:auto">
                <ul class="uk-slideshow">                    
                <?php
                      $i=0;
                      foreach($rows as $row){                          
                         $title = $row->title;
                         $url   = $row->createUrl($row);
                         $num_day = $row->num_day;
                         if($row->num_day<=9){
                            $num_day = '0'.$row->num_day;
                         }     
                         $img = $row->getImage($row);                        
             ?>
             <li>
                <center>
                  <div class="boxitem"> 
                      <div class="boxday uk-border-circle">
                          <span class="numdays"><?php echo $num_day;?></span>
                          <span class="txtday"><?php echo Yii::t('app', 'D�as');?></span>
                      </div>        
                      <a class="border-top-left-img-4" href="<?php echo $url;?>"><img src="<?php echo $img;?>" alt="" /></a>
                      <h2 class="caption-title">
                           <span class="boxcaption">
                            <a href="<?php echo $url;?>" class="title-heightlight"><?php echo $title;?></a>   
                           </span>                                 
                        </h2>
                  </div>      
                </center>             
             </li>
            <?php
             $i++;
          }
          ?>     
          </ul>
           <div>   
               <center>
                <div class="uk-position-relative uk-align-center slidenavbottom">           
                    <a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                    <a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>          
                </div>
                </center>  
            </div>                  
       </div>   
    </div>
</div>
</div>
 <?php
}
?>