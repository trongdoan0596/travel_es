<?php
use common\models\Banner;
if(!empty($rows)){
      $i = 0;
      ?>
      <div data-uk-slideshow="" class="uk-slidenav-position">
          <ul class="uk-slideshow" style="height: 411px;">
          <?php
          $dotnav = '';$str='';
          foreach($rows as $row){
             $url = "#"; 
             if($row->url!="") $url = $row->url; 
             $img = Banner::getImage($row);
             if($i==0){
                $str .='<li aria-hidden="false" class="uk-active"><a href="'.$url.'" target="'.$row->target.'"><img  src="'.$img.'" /></a></li>';
             }else{
                 $str .=' <li aria-hidden="true" ><a href="'.$url.'" target="'.$row->target.'"><img src="'.$img.'" /></a></li>';
             }
            $dotnav .= '<li data-uk-slideshow-item="'.$i.'"><a href=""></a></li>';
            $i++;
          }
          echo $str;
          ?>
       </ul>
            <a  href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
            <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
                <?php echo $dotnav;?>
            </ul>
    </div>
      <?php
}
?>
