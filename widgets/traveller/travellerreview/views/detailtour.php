<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\models\Article;
use common\models\Account;
use common\helper\StringHelper;
use yii\helpers\Url;
$lang = Yii::$app->language;
$urlindex = Url::toRoute(array('review/index'));
if(!empty($rows)){
       $info = Article::getDetailArticle(192);
       //$introtxt= "";
       $title= "";
       if(!empty($info)){
         // $introtxt =  HtmlPurifier::process($info->introtxt);
          $title    = Html::encode($info->title);
       }
?>
<div class="boxtraveller detailtour">   
   <div class="uk-container uk-container-center"> 
            <h2 class="uk-h1 uk-text-center"><?php echo $title;?></h2>             
            <div class="maincontenttraveller" data-uk-slideset="{default: 3,animation: 'scale', duration:200,autoplay:false}">
                    <div class="uk-slidenav-position">
                        <ul class="uk-grid uk-slideset">                           
                          <?php
                          $i=0;
                          //imgdefaul
                          foreach($rows as $row){ 
                              $img_default = Url::base().'/media/no_img.png';// $row->getImageDefault($row);
                              $infouser = array();$img = "";
                              if($row->user_id>0){
                                 $infouser = Account::getAccount($row->user_id);
                                 $img = $infouser->getAvatar($infouser);
                              }
                              $lastupdate = StringHelper::showDateMfr($row->last_update); 
                              $title = $row->title;
                              $i++;
                             ?>
                              <li>
                                <div class="uk-flex">
                                    <div> 
                                          <div class="infoitemtraveller">                        
                                                <p class="title">
                                                   <a href="<?php echo $urlindex;?>" class="titlereviewhome"><?php echo Html::encode($title);?></a>
                                                </p>
                                               <!-- <p class="uk-text-muted">14 days in viet nam</p>-->
                                                <p class="shorttxt">
                                                <i class="icon-quote-fix"></i>
                                                <?php echo $row->introtxt;//HtmlPurifier::process($row->introtxt);?>
                                                </p>
                                           </div> 
                                           <div class="uk-grid infouser">
                                                <div class="uk-width-medium-1-4">
                                                    <div class="uk-panel">
                                                     <a href="<?php echo $urlindex;?>"><img class="uk-border-circle" src="<?php echo $img;?>" alt="" /></a>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-3-4">                                                   
                                                <?php
                                                        if(!empty($infouser)){       
                                                            //$lastname = strtoupper(StringHelper::stripUnicode($infouser->last_name));
                                                            ?>
                                                             <div class="uk-panel">
                                                             <a href="<?php echo $urlindex;?>">
                                                                <?php echo $infouser->first_name;?>                                                    
                                                             </a>
                                                             </div>                                                           
                                                            <span><?php echo $lastupdate;?></span><br />
                                                            <?php 
                                                                    $rating = floor($row->vote);
                                                                    for($j=1;$j<=5;$j++){
                                                                        if($j<=$rating){
                                                                            echo '<i class="uk-icon-star"></i>';
                                                                        }else{
                                                                            echo '<i class="uk-icon-star-half-empty"></i>';
                                                                        }                
                                                                    }
                                                                ?>
                                                            <?php
                                                        }
                                                ?>                                                
                                                </div>
                                            </div>
                                      </div>
                                </div>                  
                            </li> 
                             <?php
                          }
                         ?>          
                        </ul>               
                    </div> <br />
                     <div class="viewall"><a href="<?php echo $urlindex;?>"><?php echo  Yii::t('app','Ver más');?></a></div>
                    <ul class="uk-slideset-nav uk-dotnav uk-flex-center bottomslideset"></ul>
                    <br />  <br />
             </div>          
    </div>   
</div>
<?php
}
?>