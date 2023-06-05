<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\models\Country;
use common\helper\StringHelper;
if(!empty($row)){
    $title = Html::encode($row->title);
    $url   = $row->createUrl($row);
   //$img   = $row->getImageDefault($row);
    $id    = $row->id;
    $tmp   = array();
    $tmp   = explode('<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>',$row->fulltxt);
    $fulltxt = $tmp[0];
    if(count( $tmp)==2){
        //$str = strip_tags($fulltxt,'<br/>,<br>,<br />');
        $fulltxt =$fulltxt.'<span class="remorereview" id="readmore_'.$id.'"  onclick="ShowFullTxt('.$id.')"> ... '.Yii::t('app', 'Leer más').'</span>';
    }
    $lastupdate = StringHelper::showDateMEs( $row->last_update );
?>
<div class="item">
    <div class="uk-grid">
        <div class="uk-width-2-6">
            <figure class="uk-overlay">
            <?php
             if(!empty($infouser)){
                $img = $infouser->getAvatar($infouser);                
                ?>
              <a href="<?php echo $url;?>">
               <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $title;?>"/>
               </a>
               <?php } ?>                          
             </figure>
        </div>
        <div class="uk-width-4-6">
               <div class="title">
                 <a href="<?php echo $url;?>"><?php echo ucwords(strtolower($infouser->first_name));?></a>              
                 <?php
                 if($infouser->country_id>0){
                   ?>                
                        <?php echo ' - '.Country::getName($infouser->country_id);?>                
                   <?php 
                 }
                 ?>  
                  </div>   
                 <?php 
                    $rating = floor($row->vote);
                    for($i=1;$i<=5;$i++){
                        if($i<=$rating){
                            echo '<i class="uk-icon-star"></i>';
                        }else{
                            echo '<i class="uk-icon-star-half-empty"></i>';
                        }                
                    }
                ?>           
                 <div class="message">
                     <a href="#"><?php echo Yii::t('app','Mensaje');?></a>
                 </div>
        </div>
    </div>
   <div class="uk-width-1-1">
       <div class="boxcomment">
               <h2 class="title-comment">"<?php echo $title;?>"</h2>
               <div class="uk-comment-body"><?php echo str_replace('<iframe', '<iframe class="uk-responsive-width" ',$fulltxt);?>
               <div class="fulltxtreview" id="fulltxtreview_<?php echo $id;?>">
               <?php
               if(count( $tmp)==2){
                     //$str_full = strip_tags($tmp[1],'<br/>,<br>,<br />');
                     echo $tmp[1].'<span class="remorereview" onclick="HideFullTxt('.$id.')"> '.Yii::t('app', 'Leer menos').'</span>';
               }
               ?>
               <?php
               if(!empty($itemimg)){
                    ?>
                        <div class="uk-grid itemimg">
                        <?php
                        $i=0;
                           foreach($itemimg as $item){
                            $img = $item->getImage($item);
                            ?>
                            <div class="uk-width-1-5">
                                <img src="<?php echo $img;?>" />
                            </div>
                            <?php
                            $i++;
                            if($i>=5){
                                break;
                            }
                           }
                          ?>
                          </div>
                    <?php
                 }
               ?>
               </div>               
               </div>
               <div class="uk-comment-meta commentbottom">
                 <span class="lastupdate"><?php echo $lastupdate;?></span>
                 <span class="commentlike"><!--<i class="uk-icon-heart-o"></i> (14)--></span>
                 <span class="commentnum"><?php //echo Yii::t('app','Comment');?><!-- (235)--></span>                 
               </div>
             </div>
   </div> 
</div>   
<?php
}
?>