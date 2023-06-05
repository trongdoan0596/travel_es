<?php
use yii\helpers\Html;
use common\helper\StringHelper;
if(!empty($rows)){
?>
<div class="lastblogright lastnewsblog">   
        <h2><?php echo Yii::t('app','Últimas noticias');?></h2>  
        <div class="item-lastblog">
                <?php
                  foreach($rows as $row){
                        $id    = $row->id;
                        $title = Html::encode($row->title);
                        $url   = $row->createUrl($row);
                        $img   = $row->getImage($row,150,77);
                        $last_update = $row->create_date;
                        $date = date("d M, Y",strtotime($last_update)); 
                       ?>
                       <div class="uk-grid">
                            <div class="uk-width-1-4">
                                <a class="hover-effect-circle boximg"  href="<?php echo $url;?>">
                                 <img class="uk-border-circle"  src="<?php echo $img;?>" alt="<?php echo $url;?>" />
                                </a>
                            </div>
                            <div class="uk-width-3-4">
                             <a href="<?php echo $url;?>"><?php echo $title;?></a>
                             <p><?php echo Yii::t('app','en');?> <?php echo StringHelper::showMonthfr($date);?>   &nbsp&nbsp &nbsp&nbsp</p>
                            </div>
                        </div>
                    <?php
                  }
                  ?> 
         </div> 
</div>      
<?php
}
?>