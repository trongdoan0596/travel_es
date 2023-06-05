<?php
use yii\helpers\Html;
use common\helper\StringHelper;
use common\models\Blogcate;
if(!empty($rows)){
?>
<div class="blogright" style="padding-top:0px;">   
        <h2 style="text-align: center;"><?php echo Yii::t('app','Categories');?></h2>  
        <div class="uk-accordion" data-uk-accordion>
                <?php
                  foreach($rows as $row){
                        $id    = $row->id;
                        $title = Html::encode($row->title);                       
                        $rs = Blogcate::getAllBlogcateMobi($id,'ordering asc'); 
                        $urlparent   = $row->createUrl($row);      
                       ?>
                       
                        <?php
                        if(!empty($rs)){
                            ?>
                             <div class="uk-accordion-title"><?php echo $title;?></div>
                             <div class="uk-accordion-content">
                             <ul class="uk-list">
                            <?php
                            foreach($rs as $r){
                               $url   = $r->createUrl($r);
                               ?>
                                <li><a href="<?php echo $url;?>">- <?php  echo $r->title;?></a></li>
                               <?php
                            }
                            ?>
                            </ul>
                             </div>   
                            <?php
                        }else{
                            ?>
                             <div class="uk-accordion-titlefix"><a href="<?php echo $urlparent;?>"><?php  echo $title;?></a></div>
                           
                            <?php
                        }
                        ?>                        
                                           
                    <?php
                  }
                  ?>             
          </div>
</div>      
<?php
}
?>