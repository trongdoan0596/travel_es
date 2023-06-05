<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
if(!empty($rows)){
?>
<div class="boxrecentblog" style="padding-top: 10px;">   
   <div class="uk-container-center"> 
            <h2 style="text-align: center;"><?php echo Yii::t('app','Otros artículos');?></h2>
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
    </div>
 </div> 
<br />
<?php 
}
?>