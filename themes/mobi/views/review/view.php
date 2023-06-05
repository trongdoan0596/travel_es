<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\Article;
use common\models\Account;
use common\models\Itemimg;
use common\models\Country;
use common\helper\StringHelper;
use app\widgets\socialshare\Socialshare;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_review'));?>
<div id="main" class="main-content"> 
      <div class="boxheadreview">     
          <div class="uk-container-center">   
          <?php  
            if(!empty($model)){    
                   $info = Article::getDetailArticle(17);
                   $fulltxt= "";$title="";$img_head="";
                   if(!empty($info)){
                      $fulltxt  = HtmlPurifier::process($info->fulltxt);
                      $title    = Html::encode($info->title);
                      $img_head = $info->getImage($info);
                   }  
                ?>                  
                 <div class="boxitem"> 
                             <h1 class="uk-text-center"><?php echo $title;?></h1>
                             <div class="introtxt">
                              <?php echo $fulltxt;?>                                   
                             </div>                              
                   </div>                        
           </div>
           <?php
             }else{
                echo "Updating!";
             }
           ?>        
          </div>
 </div>     
 <div class="listreview">
             <div class="listitem">                     
              <?php
                 if(!empty($model)){
                            $infouser = array();
                            $id    = $model->id;
                            if($model->user_id>0){
                               $infouser = Account::getAccount($model->user_id);
                            }
                            $itemimg = Itemimg::getAllImagetypeExt('review',$id);                                 
                            $title = Html::encode($model->title);
                            $url   = $model->createUrl($model);                            
                            $tmp   = array();                            
                            $fulltxt = $model->fulltxt;                            
                            $lastupdate = StringHelper::showDateMfr($model->last_update);
                        ?>
                        <div class="item">
                            <div class="uk-grid">
                                <div class="uk-width-2-6">
                                    <figure class="uk-overlay">
                                    <?php
                                     if(!empty($infouser)){
                                        $img = $infouser->getAvatar($infouser);                
                                        ?>
                                       <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $title;?>"/>
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
                                            $rating = floor($model->vote);
                                            for($i=1;$i<=5;$i++){
                                                if($i<=$rating){
                                                    echo '<i class="uk-icon-star"></i>';
                                                }else{
                                                    echo '<i class="uk-icon-star-half-empty"></i>';
                                                }                
                                            }
                                        ?>         
                                         <div class="message">
                                             <a href="#"><?php echo Yii::t('app','Message');?></a>
                                         </div>
                                </div>
                            </div>
                           <div class="uk-width-1-1">
                               <div class="boxcomment">
                                       <h2 class="title-comment">"<?php echo $title;?>"</h2>
                                       <div class="uk-comment-body"><?php echo str_replace('<iframe', '<iframe class="uk-responsive-width" ',$fulltxt);?>
                                       <div class="fulltxtreview" id="fulltxtreview_<?php echo $id;?>">                                      
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
               </div>       
        <?php echo Socialshare::widget(array('view'=>'index','url'=>$urlshare,'clss'=>'uk-text-center'));?>        
     </div> 
</div> 