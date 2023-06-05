<?php
use yii\helpers\Url;
use common\models\Article;
if(!empty($rows)){ 
    $urlall = Url::toRoute(array('article/viewaboutus'));
    $info_ac = Article::getDetailArticle(190,1);
    if(!empty($info_ac)){  
        //$imgac = Article::getImage($info_ac);
    ?>
     <div class="uk-container uk-container-center homeabout">   
      <h1 class="uk-h1 uk-text-center" style="padding-bottom: 14px;"><a href="<?php echo $urlall;?>"><?php echo $info_ac->title;?></a></h1>
          <div class="uk-grid">           
              <div class="uk-width-1-2">
                 <i class="uk-icon-quote-left uk-icon-medium uk-align-left"></i>
                 <?php echo $info_ac->fulltxt;?>
             </div>
              <div class="uk-width-1-2">
               <a href="<?php echo $urlall;?>"><img class="border-img-4" src="<?php echo Url::base();?>/themes/tablet/img/article/agencia-de-viajes-vietnam.png" alt="Agencia de Viajes Vietnam" title="Agencia de Viajes Vietnam" /></a>
             </div>
          </div> 
     </div>
     <?php
     }
     ?> 
    <div class="uk-container uk-container-center boxwhyus">    
      <h4 class="uk-h1 uk-text-center"><a href="<?php echo $urlall;?>"><?php echo $infocate->title;?></a></h4>  
      <div class="uk-text-center txthome"><?php echo $infocate->fulltxt;?></div>    
      <div class="uk-grid">
              <?php
              $i=1;
               foreach($rows as $row){                          
                     $title = $row->title;
                     $class_='';
                     if($i==5) $class_='box5';
                     ?>
                       <div class="uk-width-1-5 <?php echo $class_;?>">
                           <div class="uk-panel uk-align-center">
                              <div class="circleus-<?php echo $i;?>"><a href="#"></a></div>                             
                              <p class="uk-text-center"><?php echo $title;?></p>
                           </div>
                        </div>
                     <?php
                     $i++;
               }
            ?>
      </div>      
      <br /> <br />    
      <div class="viewall"><a href="<?php echo $urlall;?>"><?php echo  Yii::t('app','Ver más nuestro concepto');?></a></div>
     
</div>
    <?php
}
?>
