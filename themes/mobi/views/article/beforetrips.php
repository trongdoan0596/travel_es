<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\Article;
use app\widgets\question\Question;
use app\widgets\socialshare\Socialshare;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_guidevoyage'));?>
<div id="main" class="main-content"> 
      <div class="boxguidevoyage">     
          <div class="uk-container-center">   
          <?php  
            if(!empty($rows)){                      
                   if(!empty($info)){
                      //$fulltxt  = HtmlPurifier::process($info->fulltxt);
                      $title    = Html::encode($info->title);
                      //$img_head = $info->getImage($info);
                   }                       
                    echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' => $title,
                                    'url' => array('article/beforetrips'),//, 'id' => 10
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),  
                            ),
                   ));   
                    $i=0;
                    foreach($rows as $row){  
                         $showfirst="false";
                        // if($i==0) $showfirst="false";
                         echo $this->render('_itemcate',array('row'=>$row,'showfirst'=>$showfirst));  
                         $i++;                
                   }     
                 ?>
                    <div class="uk-grid boxbottom" style="padding-bottom:10px;">
                        <div class="uk-width-1-1" style=" text-align: center;">
                          <?php echo Html::a(Yii::t('app','Ver consejos de viaje'),array('article/travelinformation'), array('class' => 'btn btn-warning btnalltourfix')) ?>
                        </div>                        
                    </div>  
                    <?php echo Socialshare::widget(array('view'=>'mobi','url'=>$urlshare));?>  
                    <?php                             
                 if(!empty($info)){
                     echo Question::widget(array('view' =>'mobi','cat_id'=>$info->id));
                   } 
             }else{
                echo "Updating!";
             }
           ?> 
          </div>
     </div>      
</div>    