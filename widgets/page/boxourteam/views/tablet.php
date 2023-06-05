<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use common\models\Ourteam;
use common\models\Article;
if(!empty($rows)){
       $info = Article::getDetailArticle(16);
       $introtxt= "";$title= "";
       if(!empty($info)){
          $introtxt = $info->introtxt;// HtmlPurifier::process($info->introtxt);
          $title    = Html::encode($info->title);
       }
      $urlall = Url::toRoute(array('ourteam/index')); 
    ?>
    
<div class="boxourteam">
<div class="uk-container uk-container-center">    
  <h4 class="uk-h1 uk-text-center"><a href="<?php echo $urlall;?>"><?php echo $title;?></a></h4>  
  <div class="uk-text-center txthome">
     <?php echo $introtxt;?>   
    </div>
    <div data-uk-slideset="{height:450,default: 4,animation: 'fade', pauseOnHover:true,duration:350,autoplay:false}">
    <div class="uk-slidenav-position">
        <ul class="uk-grid uk-slideset">
          <?php
          foreach($rows as $row){                          
                 $title = $row->title;
                 $url   = $row->createUrl($row);
                 $img   = $row->getImage($row);//$row->getImage($row,245,245);
                 $profession = $row->profession;
                 $introtxt = $row->introtxt;
                 ?>
                 <li>
                        <dl >
                            <a class="hover-effect-circle boximg" href="<?php echo $url;?>">
                                <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                             </a>
                        <dl>
                        <dl>
                            <dt class="uk-text-center"><a href="<?php echo $url;?>"><?php echo $title;?></a></dt>
                            <dd class="uk-text-center titlejob"><?php echo $profession;?></dd>
                            <dd class="uk-text-center contenthome"><?php echo $introtxt;?></dd>
                        </dl>                  
                 </li>
              <?php
            }
          ?>
        </ul>      
    </div>   
    
    <center> 
           <ul class="uk-dotnav uk-slideset-nav uk-flex-center bottomslideset" style="width:150px;margin-top:0px;position: relative;"></ul>
    </center>
</div>
<div class="viewall"><a href="<?php echo $urlall;?>"><?php echo  Yii::t('app','Conocer a nuestro equipo');?></a></div>
</div>
</div>
    <?php
}
?>
