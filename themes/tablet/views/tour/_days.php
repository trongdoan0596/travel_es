<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$img   = $row->getImage($row,350,230);
$id    = $row->id;
$tmp   = array();
$tmp   = explode('<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>',$row->fulltxt);
$fulltxt = $tmp[0];
if(count( $tmp)==2){  
    $fulltxt =$fulltxt.'<span class="remorereview" id="readmore_'.$id.'"  onclick="ShowFullTxt('.$id.')"> ... '.Yii::t('app', 'Read more').'</span>';
}
?>
<h4 class="titleday-top">                            
     <div class="uk-grid">                           
         <div class="uk-width-1-3"></div>
         <div class="uk-width-2-3">
           
         </div>
     </div>                   
</h4>
<div class="uk-grid">                           
         <div class="uk-width-1-3">
             <?php
             if($row->img !=''){
                ?>
                   <img style="margin-top:8px;" src="<?php echo $img;?>" alt="<?php echo Html::encode($row->title);?>" />
                <?php
               }
             ?>
             
          </div>
          <div class="uk-width-2-3 contentday">
              <h4 class="titleday">
                 <?php echo $row->days->title;?> : 
                 <?php echo  Html::encode($row->title);?>
              </h4>
              <div class="fulltxt">
             <?php echo $fulltxt;?>             
              <?php
               if(count( $tmp)==2){     
                     echo '<div class="fulltxthide" id="fulltxtreview_'.$id.'">';
                     echo $tmp[1].'<span class="remorereview" onclick="HideFullTxt('.$id.')"> '.Yii::t('app', 'Read less').'</span>';
                     echo '</div> ';
               }
               ?>       
               </div>          
          </div>
</div> 