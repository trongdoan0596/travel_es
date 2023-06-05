<?php
use yii\helpers\Url;
use common\models\Article;
if(!empty($rows)){ 
    $url_  = Url::toRoute(array('article/viewaboutus')); 
    $info_ac = Article::getDetailArticle(190,1);
    if(!empty($info_ac)){  
        //$imgac = Article::getImage($info_ac);
    ?>
      <div class="uk-container-center boxwhyus boxgioithieu" style="background:#e9ebee;padding-bottom: 10px;">       
                 <h1 class="uk-h1 uk-text-center"><a href="<?php echo $url_;?>"><?php echo $info_ac->title;?></a></h1>      
                 <a href="<?php echo $url_;?>" class="border-top-left-img-4"><img style="width: 100%;" src="<?php echo Url::base();?>/themes/mobi/img/article/agencia-de-viajes-vietnam.png" alt="Agencia de Viajes Vietnam" title="Agencia de Viajes Vietnam" /></a>           
                 <div class="uk-text-center" style="padding-top: 14px;padding-bottom:8px;padding-right: 8px;padding-left: 8px; background: white;">
                  <?php echo $info_ac->fulltxt;?>
                 </div>          
       </div>         
     <?php
     }
     ?>
   <div class="boxwhyus">    
      <h1 class="uk-h1 uk-text-center"><a href="<?php echo $url_;?>"><?php echo $infocate->title;?></a></h1>  
      <div class="uk-text-center txthome"><?php echo $infocate->fulltxt;?></div>    
        <div class="uk-slidenav-position" data-uk-slideshow="height:auto">
            <ul class="uk-slideshow">
             <?php
                       $i=1;
                       foreach($rows as $row){                          
                             $title = $row->title;
                             $introtxt = $row->introtxt;
                             ?>
                             <li><center>
                               <div class="boxitem">
                                <a href="<?php echo $url_;?>">
                                     <figure class="circleus-<?php echo $i;?>">&nbsp;</figure> 
                                </a>
                                <p class="uk-text-center title"><a href="<?php echo $url_;?>"><?php echo $title;?></a></p>
                               </div>
                               <p class="uk-text-center introtxt"><?php echo str_replace("-", "", $introtxt);?></p>
                               <p class="viewall" style="display: block; padding-top: 14px;padding-bottom: 14px;margin-top: 0px;"><a href="<?php echo $url_;?>"><?php echo  Yii::t('app','Ver más nuestro concepto');?></a></p>
                               </center>
                             </li>
                             <?php
                             $i++;
                       }
                    ?>          
           
            </ul>
            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous slidenavgray" data-uk-slideshow-item="previous"></a>
            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next slidenavgray" data-uk-slideshow-item="next"></a>
        </div>
         
  </div>
<?php
}
?>
