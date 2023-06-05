<?php
//use yii\helpers\Html;
//use common\helper\StringHelper;
use yii\helpers\Url;
$urlpost = Url::toRoute(array('tour/customize'));
?>
<div id="slideshowbg" class="uk-slidenav-position uk-responsive-height slideshowbg " data-uk-slideshow="{height:'320',animation:'random-fx',autoplay:true,autoplayInterval:9000,duration:500}">    
    <ul class="uk-slideshow">
     <?php
        $str='';
        for($i=0;$i<count($rows);$i++){
            $img = $rows[$i];
            echo $this->render('_item_mobi',array('urlpost'=>$urlpost,'img'=>$img));  
           // $str = $str.'<li data-uk-slideshow-item="'.$i.'"><a href="#"></a></li>';
        }     
     ?> 
    </ul>
  <!--  <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
    <li data-uk-slideshow-item="0"><a href="#"></a></li>
        <li data-uk-slideshow-item="1"><a href="#"></a></li>
        <li data-uk-slideshow-item="2"><a href="#"></a></li>
    </ul>-->
</div>