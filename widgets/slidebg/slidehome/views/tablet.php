<?php
//use yii\helpers\Html;
//use common\helper\StringHelper;
use yii\helpers\Url;
$urlpost = Url::toRoute(array('tour/customize'));
?>
<script>
 var slideHeight =254;
 if(viewportHeight<=680){
         slideHeight = 250;
}
</script>
<div id="slideshowbgzz" class="uk-slidenav-position uk-responsive-height slideshowbg" data-uk-slideshow="{kenburns:true,autoplay:true}">    
    <ul class="uk-slideshow">
    <?php
    $str='';
    for($i=0;$i<count($rows);$i++){
        $img = $rows[$i];
        echo $this->render('_item',array('urlpost'=>$urlpost,'img'=>$img));  
        $str = $str.'<li data-uk-slideshow-item="'.$i.'"><a href="#"></a></li>';
    }  
     ?> 
   </ul>
   <center>
      <ul class="uk-dotnav uk-dotnav-contrast uk-flex-center" style="width:180px;margin-top: -50px;position: relative;">
           <?php echo $str;?>
        </ul>    
    </center>
</div>