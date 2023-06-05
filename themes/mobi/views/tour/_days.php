<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$img   = $row->getImage($row);//,350,230
$id    = $row->id;
//$tmp   = array();
//$tmp   = explode('<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>',$row->fulltxt);
$fulltxt =str_replace('<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>', '', $row->fulltxt);// $tmp[0];
//if(count( $tmp)==2){  
 //   $fulltxt =$fulltxt.'<span class="remorereview" id="readmore_'.$id.'"  onclick="ShowFullTxt('.$id.')"> ... '.Yii::t('app', 'Read more').'</span>';
//}
?>
<div class="dayitem">
    <div class="uk-container-center boxnumberday">
         <span class="numberday"><?php 
         $tmp = explode(" ",$row->days->title);
         if(count($tmp)){
            echo $tmp[0].'<br /><font class="num">'.$tmp[1].'</font>';
         }
        // echo $row->days->title;
         ?></span>
    </div>
   
        <?php
         if($row->img !=''){
            ?> <div class="uk-text-center boximg">
               <img  src="<?php echo $img;?>" alt="<?php echo Html::encode($row->title);?>" />
                </div>
            <?php
           }else{
            ?>
            <div class="uk-text-center boxnoimg">
              
             </div>
            <?php
           }
         ?>
   
    <div class="uk-text-center title">
             <?php echo  Html::encode($row->title);?>       
    </div>
    <div class="content">
             <?php echo $fulltxt;?>
             <?php
              // if(count( $tmp)==2){     
                     //echo '<div class="fulltxthide" id="fulltxtreview_'.$id.'">';
                     //echo $tmp[1].'<span class="remorereview" onclick="HideFullTxt('.$id.')"> '.Yii::t('app', 'Read less').'</span>';
                     //echo '</div> ';
              // }
               ?>       
                         
      </div>
    
</div>