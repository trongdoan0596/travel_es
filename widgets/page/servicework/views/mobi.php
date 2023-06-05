<?php
use yii\helpers\Url;
if(!empty($rows)){
 ?>
<div class="servicework">
      <div class="box-service">
              <div class="title-service"><?php echo $infocate->title;?></div>
              <div class="uk-text-center txthome"><?php echo $infocate->fulltxt;?></div>
      </div>     
      <div class="uk-container-center boxstep">
              <div class="uk-slidenav-position" data-uk-slideshow="height:auto">
                <ul class="uk-slideshow">                    
                <?php
                      $i=0;
                      foreach($rows as $row){                          
                         $title = $row->title;
                         $introtxt = $row->introtxt;
                         $fulltxt  = $row->fulltxt;
                        
             ?>
             <li>
                <center>                 
                        <div class="title">
                           <?php echo $title;?>
                        </div>
                        <div class="fulltxt">
                           <?php echo $fulltxt;?>
                         </div>                       
                </center>             
             </li>
            <?php
             $i++;
          }
          ?>     
          </ul>
           <div style="padding-bottom: 30px;margin-top: 20px;">   
               <center>
                <div class="uk-position-relative uk-align-center slidenavbottom">           
                    <a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                    <a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>          
                </div>
                </center>  
            </div>                  
       </div>   
    </div>
</div>
<?php
}
?>