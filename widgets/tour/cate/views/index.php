<?php
use common\models\Tour;
if(!empty($rows)){
      $i = 0;
      ?>
      <h1>List Tour</h1>
      <div class="uk-grid uk-grid-match" data-uk-grid-match="{target:'.uk-panel'}">
          <?php
          foreach($rows as $row){
              if($row->title!=''){
                $img = Tour::getImage($row);
              }else{
                $img = '';
              }
             $title = $row->title;
             $url = Tour::createUrl($row);
            // echo '<div class="uk-width-1-2">'.$title.'</div>';
             ?>
               <div class="uk-width-medium-1-2">
                <div class="uk-panel" style="padding: 10px;">
                   <ul class="uk-grid uk-grid-width-1-2" >
                        <li style="width: 36%;"><img width="180" height="180" src="<?php echo $img;?>" /></li>
                        <li style="width:60%;">
                           <a href="<?php echo $url;?>"><?php echo $title;?></a>
                           <br />
                           <?php echo $row->shorttxt;?>
                        </li>
                    </ul>
                
               </div>
            </div>
            <?php
             $i++;
          }
          ?>
          
    </div>
    <center><a href="#">Remore</a></center>
      <?php
}
?>
