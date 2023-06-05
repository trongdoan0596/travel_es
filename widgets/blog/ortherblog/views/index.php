<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
if(!empty($rows)){
?>
<div class="ortherblog">
<h2><?php echo Yii::t('app','Otros artículos');?></h2>
<div class="uk-grid boxitem">
 <?php
  foreach($rows as $row){
        $id    = $row->id;
        $title = Html::encode($row->title);
        $url   = $row->createUrl($row);
        $img   = $row->getImage($row,450,230);
        //if($blog_id!=$id){  
               ?>
                <div class="uk-width-1-3">
                      <div>
                          <a class="hover-effect"  href="<?php echo $url;?>">
                                 <img  src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                           </a>  
                      </div>
                      <div class="shorttxt">
                           <a href="<?php echo $url;?>">
                           <?php echo $title;?>
                            </a>  
                       </div>
                           
                </div>
           <?php
           //}
       }
  ?>  

</div>
</div>
  <br />
<?php 
}
?>