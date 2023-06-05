<?php
use yii\helpers\Url;
if(!empty($rows)){
?>
<div class="boxwhyus boxhowtobook">    
      <h1 class="uk-h1 uk-text-center"><?php echo $infocate->title;?></h1>  
      <div class="uk-slidenav-position" data-uk-slideshow="height:auto">
            <ul class="uk-slideshow">
             <?php
                       $i=1;
                       $arr = array("Step 1.","Step 2.","Step 3.","Step 4.","Step 5.","Step 6.","Step 7.");
                       foreach($rows as $row){                          
                             $title = str_replace($arr,"",$row->title);     
                             $introtxt = $row->introtxt;
                             ?>
                             <li><center>
                                 <a href="#" class="boximg">
                                    <img class="uk-border-circle" src="<?php echo Yii::$app->homeUrl;?>themes/web/img/book<?php echo $i;?>.png" alt="" />
                                 </a>
                                 <dl>
                                        <dt class="uk-text-center"><a href="#"><b><?php echo $introtxt;?></b></a></dt>                      
                                        <dd class="uk-text-center"><?php echo $title;?></dd>
                                 </dl> 
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