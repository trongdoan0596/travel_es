<?php
use yii\helpers\Url;
if(!empty($rows)){ 
    ?>
   <div class="boxwhyus aboutmobi">    
      <h1 class="uk-text-center title"><?php echo $infocate->title;?></h1>  
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
                               <a href="#">
                               <figure class="circleus-<?php echo $i;?>">  
                                         &nbsp;
                                </figure> </a>
                                <p class="uk-text-center title"><a href="#"><?php echo $title;?></a></p>
                                <p class="uk-text-center introtxt"><?php echo str_replace("-", "", $introtxt);?></p>
                                </div>
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
