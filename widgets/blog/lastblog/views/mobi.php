<?php
use yii\helpers\Html;
if(!empty($rows)){
?>
<div class="boxrecentblog">   
   <div class="uk-container-center"> 
            <h1 class="uk-h1 uk-text-center"><?php echo Yii::t('app','Últimas noticias');?></h1>  
            <div class="uk-text-center uk-width-* txthome">
             <?php
                  if(!empty($info)){ echo $info->fulltxt;}
             ?>
            </div>  
            <div class="uk-grid boxcontent">
             <?php
                          foreach($rows as $row){
                                $id    = $row->id;
                                $title = Html::encode($row->title);
                                $url   = $row->createUrl($row);
                                $img   = $row->getImage($row,340,220);
                               ?>
                              <div class="uk-width-1-2">
                                       <a class="hover-effect"  href="<?php echo $url;?>">
                                                 <img  src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                                            </a> 
                                        <br />
                                       <p>
                                         <a href="<?php echo $url;?>"><?php echo $title;?></a>
                                        </p>                                             
                                      
                               </div>
                            <?php
                          }
                          ?> 
                            
            </div>        
    </div>
 </div>    
 <?php
  }
 ?>       