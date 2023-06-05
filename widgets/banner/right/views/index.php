<?php
use common\models\Banner;
if(!empty($rows)){
      $i = 0;
      ?>
      <div class="banner-right">
          <?php
          $dotnav = '';$str='';
          foreach($rows as $row){
             $img = Banner::getImage($row);
             $url = "#"; 
             if($row->url!="") $url = $row->url; 
             $str .='<a href="'.$url.'" target="'.$row->target.'"><img  width="276" src="'.$img.'" /></a>';
            $i++;
          }
          echo $str;
          ?>
       
    </div>
      <?php
}
?>
