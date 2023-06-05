<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
//use common\models\Article;
use common\models\Account;
use common\models\Itemimg;
use common\models\Country;
use common\helper\StringHelper;
use app\widgets\socialshare\Socialshare;
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_review'));?>
<div id="main" class="main-content"> 
      <div class="boxheadreview">     
          <div class="uk-container uk-container-center">   
          <?php  
            if(!empty($model)){                       
                   $fulltxt= "";$title="";$img_head="";
                   if(!empty($info)){
                      $fulltxt  = HtmlPurifier::process($info->fulltxt);
                      $title    = Html::encode($info->title);
                      $img_head = $info->getImage($info);
                   }                       
                    echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' => $title,
                                    'url' => array('review/index'),//, 'id' => 10
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),  
                            ),
                   ));                 
                ?>                  
                 <div class="boxitem"> 
                         <h1><?php echo $title;?></h1>
                         <div class="introtxt">
                             <div class="txt">
                                  <div class="uk-grid">
                                  <?php
                                  if($img_head!=""){
                                    ?>
                                    <div class="uk-width-1-4">
                                    <img src="<?php echo $img_head;?>" width="277" height="208" /></div>
                                    <div class="uk-width-3-4"><?php echo $fulltxt;?>                                       
                                       <div class="starfb">
                                        <i class="uk-icon-star"></i><i class="uk-icon-star"></i><i class="uk-icon-star"></i><i class="uk-icon-star"></i><i class="uk-icon-star"></i> 4.9/5 <?php echo Yii::t('app','Calculated on the opinions of our customers on');?> <a href="https://www.facebook.com/authentikvietnamtravel/reviews">Facebook</a>
                                       </div>                                       
                                    </div>                                    
                                    <?php
                                  }else{
                                    ?>
                                    <div class="uk-width-1-1 uk-text-left">
                                        <?php echo $fulltxt;?>          
                                    </div>
                                    <?php
                                  }
                                  ?>
                                    
                                   
                                  </div>                                                           
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
     <div class="uk-container uk-container-center">   
            <?php
            if(!empty($model)){
             ?>
              <div class="listitem">                     
                     <?php                    
                         $infouser = array();
                         if($model->user_id>0){
                            $infouser = Account::getAccount($model->user_id);
                         }                        
                         
                        $title = $model->title;//Html::encode($row->title);
                        $url   = $model->createUrl($model);   
                        $id    = $model->id;
                        $tmp   = array();                       
                        $fulltxt =$model->fulltxt;                        
                        $lastupdate = StringHelper::showDateMfr( $model->last_update );
                    ?>
                        <div class="uk-grid">
                            <div class="uk-width-2-10">
                               <div class="boxuser">
                                <?php
                                 if(!empty($infouser)){
                                    $img = $infouser->getAvatar($infouser);                
                                        ?>
                                 <div class="circleusavatar">
                                    <!--<img class="circle" src="<?php echo $img;?>" />-->                    
                                    <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                                        <figure class="uk-overlay">
                                          <a href="<?php echo $url;?>">
                                             <img class="uk-border-circle" src="<?php echo $img;?>" alt=""/>  
                                           </a>                        
                                        </figure>
                                    </div>
                                 </div>
                             <div class="title"><a href="<?php echo $url;?>"><?php echo ucwords(strtolower($infouser->first_name));?></a></div> 
                             <?php
                             if($infouser->country_id>0){
                               ?>
                                 <div class="address"><?php echo Country::getName($infouser->country_id);?></div>
                               <?php 
                             }
                             ?> 
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
                             <div class="message"><a href="#"><?php echo Yii::t('app','Message');?></a></div>           
                    <?php
                 }
                 ?>        
               
               </div>     
            </div>
            <div class="uk-width-8-10">
                 <div class="boxcomment">
                   <h2 class="title-comment">"<?php echo $title;?>"</h2>
                   <div class="uk-comment-body"><?php echo $fulltxt;?>
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
                     <span class="commentnum"><!--<?php //echo Yii::t('app','Comment');?> (125)--></span>                     
                   </div>
                 </div>
            </div>
        </div>
                      
               </div>
              <?php echo Socialshare::widget(array('view'=>'index','url'=>$urlshare,'clss'=>'uk-text-center'));?>  
              <?php } ?>                           
           </div> 
     </div>       
</div> 