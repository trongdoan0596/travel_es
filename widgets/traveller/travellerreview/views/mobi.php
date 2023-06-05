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
       $info = Article::getDetailArticle(192);
       $introtxt= "";$title= "";
       if(!empty($info)){
          $introtxt = $info->introtxt;// HtmlPurifier::process(strip_tags($info->introtxt));
          $title    = Html::encode($info->title);
       }
    ?>
   <div class="boxtraveller">    
      <h1 class="uk-h1 uk-text-center"><a href="<?php echo $urlindex;?>"><?php echo $title;?></a></h1>  
      <?php  echo Settinghome::widget(array('view' =>'showrating','total'=>$total));?> 
      <div class="uk-text-center txthome"><?php echo $introtxt;?></div>    
        <div class="uk-slidenav-position" data-uk-slideshow="height:auto">
            <ul class="uk-slideshow">
             <?php
                       $i=1;
                       foreach($rows as $row){                          
                             $title = $row->title;
                             $img_default = Url::base().'/media/no_img.png';// $row->getImageDefault($row);
                              $infouser = array();$img = "";
                              if($row->user_id>0){
                                 $infouser = Account::getAccount($row->user_id);
                                 $img = $infouser->getAvatar($infouser);
                              }
                              $lastupdate = StringHelper::showDateMfr($row->last_update); 
                              $title_default = $row->title;                             
                              if(isset($imgdefaul[$i])!=''){
                                 $img_default = Url::base().'/media/itemimgs/'.$imgdefaul[$i]["img"];
                                 $title_default = $imgdefaul[$i]["title"];
                              }                           
                             ?>
                             <li>
                                <center>
                                     <dl class="boxavatar"> 
                                            <dt class="avatar"><a href="<?php echo $urlindex;?>"><img class="uk-border-circle" src="<?php echo $img;?>" alt="" /></a></dt>
                                            <dt class="infouser">
                                            <?php
                                             if(!empty($infouser)){                  
                                                   //$lastname = strtoupper(StringHelper::stripUnicode($infouser->last_name));
                                                   ?>
                                                    <a href="<?php echo $urlindex;?>">
                                                         <?php echo $infouser->first_name;?>                                                    
                                                    </a><br />
                                                     <span><?php echo $lastupdate;?></span>
                                                     <br />
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
                                              <?php }?>
                                             </dt>
                                      </dl>
                                   <div class="boxitem">                                        
                                       <figure class="boxreviewitem">                                        
                                           <p class="uk-text-center title">&nbsp;<?php echo $title;?></p>
                                           <p class="shorttxt">                                                   
                                                    <?php echo $row->introtxt;//HtmlPurifier::process($row->introtxt);?>                                                   
                                            </p>
                                        </figure>                                
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
                 <div class="viewall" style="margin-top:10px;"><a href="<?php echo $urlindex;?>"><?php echo  Yii::t('app','Ver más');?></a></div>
                </center>  
            </div>   
        </div>
        
  </div>
<?php
}
?>
