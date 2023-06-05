<?php
use common\models\Tourextentions;
use common\models\Tour;
use app\widgets\tour\extention\Extention;
if(!empty($rows)){
      $i = 0;
      ?>
      <h1>Extentions Tour</h1>
      <div class="uk-grid uk-grid-match" data-uk-grid-match="{target:'.uk-panel'}">
          <?php
          foreach($rows as $row){
              if($row->tour->title!=''){
                $img = Tour::getImage($row->tour);
              }else{
                $img = '';
              }
             $title = $row->tour->title;
             $url = Tour::createUrl($row->tour);
            // echo '<div class="uk-width-1-2">'.$title.'</div>';
             ?>
               <div class="uk-width-medium-1-2">
                <div class="uk-panel" style="padding: 10px;">
                   <ul class="uk-grid uk-thumbnav uk-grid-width-1-2" >
                        <li style="width: 36%;">
                             <a href="<?php echo $url;?>"><img width="180" height="180" src="<?php echo $img;?>" /></a></li>
                        <li style="width:60%;">
                           <a href="<?php echo $url;?>"><?php echo $title;?></a>
                           <br />
                           <?php echo $row->tour->shorttxt;?>
                        </li>
                    </ul>
                
               </div>
            </div>
            <?php
             $i++;
          }
          ?>
          
    </div>
    
  <?php
}
?>
