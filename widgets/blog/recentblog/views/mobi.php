<?php
use yii\helpers\Html;
use yii\helpers\Url;
if(!empty($rows)){
    $title_ext = Yii::t('app','Travel blog');
    //$fulltxt   = "";
    if(!empty($info)){ 
         $title_ext = Html::encode($info->title);
         //$fulltxt   = HtmlPurifier::process($info->fulltxt);
    }
    $urlall = Url::toRoute(array('blog/index'));
?>
<div class="boxrecentblog">   
   <div class="uk-container-center"> 
            <h1 class="uk-h1 uk-text-center"><?php echo $title_ext;?></h1>  
            <div class="uk-text-center uk-width-* txthome">
             <?php
                  if(!empty($info)){ echo strip_tags($info->fulltxt);}
             ?>
            </div>  
            <div class="uk-grid boxcontent">
             <?php
                          foreach($rows as $row){
                                $id    = $row->id;
                                $title = Html::encode($row->title);
                                $url   = $row->createUrl($row);
                                $img   = $row->getImage($row);
                               ?>
                              <div class="uk-width-1-2">
                                       <a href="<?php echo $url;?>">
                                                 <img  src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                                       </a> 
                                        <br />
                                       <p style="padding-bottom: 20px;" class="title">
                                         <a href="<?php echo $url;?>"><?php echo $title;?></a>
                                        </p>                                             
                                      
                               </div>
                            <?php
                          }
                          ?> 
                            
            </div>   
            <div class="viewall"><a href="<?php echo $urlall;?>"><?php echo  Yii::t('app','Ver más');?></a></div>
           <br />     
    </div>
 </div>    
 <?php
  }
 ?> 