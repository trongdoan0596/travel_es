<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\models\Article;
use common\models\Account;
use common\helper\StringHelper;
use yii\helpers\Url;
use app\widgets\setting\settinghome\Settinghome;
$urlindex = Url::toRoute(array('review/index'));
if(!empty($rows)){
       $info = Article::getDetailArticle(17);
       $introtxt= "";$title= "";
       if(!empty($info)){
          $introtxt = $info->introtxt;// HtmlPurifier::process($info->introtxt);
          $title    = Html::encode($info->title);
       }
?>
<div class="boxtraveller">   
   <div class="uk-container uk-container-center"> 
            <h5 class="uk-h1 uk-text-center"><a href="<?php echo $urlindex;?>"><?php echo $title;?></a></h5>  
            <?php  echo Settinghome::widget(array('view' =>'showrating','total'=>$total));?>
            <div class="uk-text-center txthome" ><?php echo $introtxt;?></div>
            <div class="maincontenttraveller" data-uk-slideset="{default: 3,animation: 'scale',autoplayInterval:7000,duration:300,autoplay:false}">
                    <div class="uk-slidenav-position">
                        <ul class="uk-grid uk-slideset">
                          <?php
                          $i=0;
                          //imgdefault
                          foreach($rows as $row){ 
                              $img_default = Url::base().'/media/no_img.png';// $row->getImageDefault($row);
                              $infouser = array();$img = "";
                              if(!empty($row->account)){
                                 //$infouser = Account::getAccount($row->user_id);
                                 $img = $row->account->getAvatar($row->account);
                              }
                              $lastupdate = StringHelper::showDateMfr($row->last_update); 
                              $title_default = $row->title;                             
                              if(isset($imgdefault[$i])!=''){
                                 $img_default = Url::base().'/media/itemimgs/350_230/'.$imgdefault[$i]["img"];
                                 $title_default = $imgdefault[$i]["title"];
                              }                              
                              $i++;
                             ?>
                             <li>
                                <div class="uk-flex">
                                    <div class="imghover">  
                                         <center>
                                              <a class="border-top-left-img-4 hover-effect" href="<?php echo $urlindex;?>" title="<?php echo Html::encode($title_default);?>">
                                                 <img src="<?php echo $img_default;?>" alt="<?php echo Html::encode($title_default);?>" />
                                              </a> 
                                          </center>
                                          <div class="infoitemtraveller">                        
                                                <p class="title">
                                                   <a href="<?php echo $urlindex;?>" class="titlereviewhome"><?php echo StringHelper::Subwords(Html::encode($row->title),9);?></a>
                                                </p>
                                               <!-- <p class="uk-text-muted">14 days in viet nam</p>-->
                                                <p class="shorttxt">                                                   
                                                    <?php echo $row->introtxt;//HtmlPurifier::process($row->introtxt);?>                                                   
                                                </p>
                                           </div> 
                                           <div class="uk-grid infouser">
                                                <div class="uk-width-medium-1-4">                                                
                                                    <div class="uk-panel">
                                                     <a href="<?php echo $urlindex;?>"><img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php if(!empty($infouser)){ echo $infouser->first_name;}?> " /></a>
                                                    </div>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                <?php
                                                if(!empty($row->account)){                  
                                                   //$lastname = strtoupper(StringHelper::stripUnicode($row->account->last_name));
                                                    ?>
                                                     <div class="uk-panel">
                                                         <a href="<?php echo $urlindex;?>">
                                                            <?php echo $row->account->first_name;?>                                                    
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
                    </div>       
                    <br />                      
                    <center>
                            <ul class="uk-slideset-nav uk-dotnav uk-flex-center bottomslideset" style="width:100px;margin-top:0px;position: relative;"></ul>
                    </center>                  
             </div>   
              <div class="viewall"><a href="<?php echo $urlindex;?>"><?php echo  Yii::t('app','Ver más testimonios');?></a></div>       
    </div>   
</div>
<?php    
}
?>