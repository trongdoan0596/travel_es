<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use common\helper\StringHelper;
use common\models\Ourteam;
use common\models\Article;
if(!empty($rows)){
       $info = Article::getDetailArticle(109);
       $introtxt= Yii::t('app','Our collection of videos made by our field team on authentic activities during reconnaissance missions.');
       $title= Yii::t('app','Last Video');
       if(!empty($info)){
          $introtxt = $info->introtxt;// HtmlPurifier::process($info->introtxt);
          $title    = Html::encode($info->title);
       }
    ?>
<div class="boxourteam boxvideo">
     <div class="uk-container-center boxhome">    
              <h1 class="uk-h1 uk-text-center"><?php echo $title;?></h1>  
              <div class="uk-text-center txthome"> <?php echo $introtxt;?> </div>
              <div  class="uk-container-center ">
              <div class="uk-slidenav-position" data-uk-slideshow="height:auto">
                <ul class="uk-slideshow">                    
                <?php
                      $i=0;
                      foreach($rows as $row){                          
                              $url = $row->url;
                              $title  = $row->title;//Html::encode($row->title);
                        
             ?>
             <li>
                <center>                 
                        <dl class="boximgavatar">
                            <iframe class="uk-responsive-width" width="560" height="350" src="<?php echo $url;?>" frameborder="0" allowfullscreen></iframe>
                        </dl>
                        <dl class="contenttxt">
                            <dt class="uk-text-center"><a href="<?php echo $url;?>" style="font-size: 16px !important;font-weight: normal !important;"><?php echo $title;?></a></dt>
                        </dl>     
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
                <div class="viewall" style="padding-top: 36px;"><a target="_blank" href="https://www.youtube.com/user/authentikvietnam"><?php echo  Yii::t('app','Ver todos vídeos');?></a></div>
                </center>  
            </div>                  
       </div>   
    </div>
</div>
</div>
    <?php
}
?>