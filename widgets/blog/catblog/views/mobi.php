<?php
use yii\helpers\Html;
use common\helper\StringHelper;
if(!empty($rows)){
?>
<div class="blogright" style="padding-top:0px;">   
        <h2 style="text-align: center;"><?php echo Yii::t('app','Categoría');?></h2>  
        <div class="item">
              <ul class="uk-list">
                <?php
                  foreach($rows as $row){
                        $id    = $row->id;
                        $title = Html::encode($row->title);
                        $url   = $row->createUrl($row);
                       ?>
                        <li>
                           -&nbsp;<a href="<?php echo $url;?>"><?php echo $title;?></a>
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