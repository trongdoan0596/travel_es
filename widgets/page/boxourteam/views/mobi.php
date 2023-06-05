<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use common\models\Ourteam;
use common\models\Article;
if(!empty($rows)){
       $info = Article::getDetailArticle(181);
       $introtxt= "";$title= "";
       if(!empty($info)){
          $introtxt = $info->introtxt;// HtmlPurifier::process($info->introtxt);
          $title    = Html::encode($info->title);
       }
       $urlall = Url::toRoute(array('ourteam/index')); 
    ?>
    
<div class="boxourteam">
     <div class="uk-container-center boxhome">    
              <h1 class="uk-h1 uk-text-center"><?php echo $title;?></h1>  
              <div class="uk-text-center txthome"> <?php echo $introtxt;?> </div>
              <div  class="uk-container-center ">
              <div class="uk-slidenav-position" data-uk-slideshow="height:auto">
                <ul class="uk-slideshow">                    
                <?php
                      $i=0;
                      foreach($rows as $row){                          
                         $title = $row->title;
                         $url   = $row->createUrl($row);
                         $img   = $row->getImage($row,245,245);
                         $profession = $row->profession;
                         $introtxt = $row->introtxt;
                        
             ?>
             <li>
                <center>                 
                        <dl class="boximgavatar">
                            <a class="hover-effect-circle boximg" href="<?php echo $url;?>">
                                <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                            </a>
                        </dl>
                        <dl class="contenttxt">
                            <dt class="uk-text-center"><a href="<?php echo $url;?>"><?php echo $title;?></a></dt>
                            <dd class="uk-text-center titlejob"><?php echo $profession;?></dd>
                            <dd class="uk-text-center contenthome"><?php echo $introtxt;?></dd>
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
                <div class="viewall" style="padding-top: 36px;"><a href="<?php echo $urlall;?>"><?php echo  Yii::t('app','Conocer a nuestro equipo');?></a></div>
                </center>  
            </div>                  
       </div>   
    </div>
</div>
</div>
    <?php
}
?>
