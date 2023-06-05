<?php
use yii\helpers\Url;
if(!empty($rows)){
?>
<div class="boxhowtobook">
 <div class="uk-container uk-container-center">    
  <h2 class="uk-h1 uk-text-center"><?php echo $infocate->title;?></h2>
    <div data-uk-slideset="{default:5,animation: 'scale', duration:200,autoplay:false}">
    <div class="uk-slidenav-position">
        <ul class="uk-grid uk-slideset">
          <?php
           $i=1;
           $arr = array("Step 1.","Step 2.","Step 3.","Step 4.","Step 5.","Step 6.","Step 7.");
           foreach($rows as $row){                          
                 $title = str_replace($arr,"",$row->title);     
                 $introtxt = $row->introtxt;             
                 ?>
                  <li>
                        <a href="#" class="boximg">
                            <img class="uk-border-circle" src="<?php echo Yii::$app->homeUrl;?>themes/web/img/book<?php echo $i;?>.png" alt="" />
                         </a>
                            <dl>
                                <dt class="uk-text-center"><a href="#"><?php echo $introtxt;?></a></dt>                      
                                <dd class="uk-text-center"><?php echo $title;?></dd>
                            </dl>                  
                    </li>
                 <?php
                 $i++;
           }
        ?>
        </ul>      
    </div><br />
    <ul class="uk-slideset-nav uk-dotnav uk-flex-center bottomhowtobook"></ul>
</div>
</div>
</div>
<?php
 }
?>