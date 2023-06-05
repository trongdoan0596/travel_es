<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
//use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\User;
use common\helper\StringHelper;
use app\widgets\blog\lastblog\Lastblog;
//use app\widgets\blog\catblog\Catblog;
use app\widgets\blog\listcatblog\Listcatblog;
use app\widgets\blog\ortherblog\Ortherblog;
use app\widgets\comment\postcomment\Postcomment;
use app\widgets\comment\listcomment\Listcomment;
use app\widgets\socialshare\Socialshare;
use app\widgets\tour\buttontour\Buttontour;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_blog'));?>
<div class="maincontent viewboxblog">   
<?php
 echo Breadcrumbs::widget(array(
                                'itemTemplate' => "<li>{link}</li>\n", // template for all links
                                'links' => array(
                                    array(
                                        'label' =>'blog',
                                        'url' => array('blog/index'),//, 'id' => 22
                                        'template' => "<li>{link}</li>\n", // template for this link only
                                    ),  
                                ),
                       )); 
?>  
   <div class="uk-container-center">   
          <?php             
            if(!empty($model)){                  
                $title   = Html::encode($model->title);
                $fulltxt = $model->fulltxt;//HtmlPurifier::process($model->fulltxt);
                $img     = $model->getImage($model);
                $last_update = $model->create_date;
                $date = date("d M, Y",strtotime($last_update)); 
                ?>
                <div class="uk-grid">
                    <div class="uk-width-1-1">    
                        <div class="blogcontent">
                            <ul class="uk-list">
                                <li><img class="blogimg uk-text-center" src="<?php echo $img;?>" title="<?php echo $title;?>" /></li>
                                <li><h1 class="titleblog"><strong><?php echo $title;?></strong></h1></li>
                                <li class="bypost uk-text-center"><?php echo Yii::t('app','on');?> <?php echo StringHelper::showMonthfr($date);?>   &nbsp&nbsp &nbsp&nbsp   <?php echo Yii::t('app','By');?>: <a href="#"><?php echo User::Getname($model->user_id);?></a></li>
                                <li class="content"><?php echo str_replace('<iframe', '<iframe class="uk-responsive-width" ',$fulltxt);?></li>
                            </ul> 
                            <?php echo Buttontour::widget(array('view'=>'index'));?> 
                        </div> 
                        <?php echo Socialshare::widget(array('view'=>'mobi','url'=>$urlshare));?>                     
                    </div>
                    
                </div>
                <br />
                <?php echo Listcomment::widget(array('view'=>'mobi','ext_id'=>$model->id,'type'=>'blog'));?>   
                <?php echo Postcomment::widget(array('view'=>'mobi','ext_id'=>$model->id,'type'=>'blog'));?> 
                <?php echo Ortherblog::widget(array('view'=>'mobi','catblog_id'=>$model->catblog_id,'blog_id'=>$model->id));?>
                <?php //echo Catblog::widget(array('view' =>'mobi'));?> 
                <?php echo Listcatblog::widget(array('view' =>'mobi','cat_id'=>5));?> 
           <?php
             }else{
                echo "Updating!";
             }
           ?>        
           
          </div>
</div>    