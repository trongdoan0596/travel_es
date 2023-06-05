<?php
use yii\helpers\Html;
use common\helper\StringHelper;
if(!empty($rows)){
?>
<div class="blogright">   
        <h2><?php echo Yii::t('app','Categoría');?></h2>  
        <div class="item">
              <ul class="uk-list">
                <?php
                  foreach($rows as $row){
                        $id    = $row->id;
                        $title = Html::encode($row->title);
                        $url   = $row->createUrl($row);
                        //$img   = $row->getImage($row,150,77);
                       // $last_update = $row->create_date;
                        //$date = date("d M, Y",strtotime($last_update)); 
                       ?>
                        <li>
                           <i class="uk-icon-angle-right"></i>&nbsp;<a href="<?php echo $url;?>"><?php echo $title;?></a>
                        </li>
                    <?php
                  }
                  ?> 
             </ul>
         </div>
</div>      
<?php
}
?>