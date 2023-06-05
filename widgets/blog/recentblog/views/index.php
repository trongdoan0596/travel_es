<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use common\helper\StringHelper;
if(!empty($rows)){
    $title_ext = Yii::t('app','Travel blog');
    $fulltxt   = "";
    if(!empty($info)){ 
         $title_ext = Html::encode($info->title);
         $fulltxt   = $info->fulltxt;//HtmlPurifier::process($info->fulltxt);
    }
    $urlall = Url::toRoute(array('blog/index'));
?>
<div class="lastblog">   
   <div class="uk-container uk-container-center"> 
            <h3 class="uk-h1 uk-text-center"><a href="<?php echo $urlall;?>"><?php echo $title_ext;?></a></h3>               
             <?php
                  if(!empty($info)){
                    ?>
                    <div class="uk-text-center uk-width-* txthome">
                        <?php echo $fulltxt;?> 
                    </div>
                   <?php 
                  }
             ?>
          
            <div class="maincontentblog" data-uk-slideset="{default: 4,pauseOnHover:true,animation:'slide-horizontal',duration:200,autoplay:false}">
                    <div class="uk-slidenav-position">
                        <ul class="uk-grid uk-slideset">
                        <?php
                          foreach($rows as $row){
                                $id    = $row->id;
                                $title = Html::encode($row->title);
                                $url   = $row->createUrl($row);
                                $img   = $row->getImage($row,450,230);
                               ?>
                               <li>
                                    <a class="hover-effect"  href="<?php echo $url;?>">
                                     <img  src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                                    </a>                              
                                    <p>
                                       <a href="<?php echo $url;?>"><?php echo $title;?></a>
                                    </p>
                                     <p style="text-align: right;">                                     
                                        <span style="text-align: right;width: 100%;"><?php echo Yii::t('app','Última actualización');?> <?php echo StringHelper::showDateMfr($row->last_update,1);?></span>
                                    </p>
                                </li>
                            <?php
                          }
                          ?> 
                        </ul>                       
                    </div><br /><br />
                    <div class="viewall"><a href="<?php echo $urlall;?>"><?php echo  Yii::t('app','Ver más');?></a></div>
                    <center>
                          <ul class="uk-slideset-nav uk-dotnav uk-flex-center" style="width:100px;margin-top:0px;position: relative;"></ul>
                    </center>
                    
             </div>          
    </div>   
    <div class="uk-container uk-container-center uk-clearfix"></div><br /><br /><br />
</div>
<?php
}
?>