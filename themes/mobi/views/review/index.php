<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\Article;
use common\models\Account;
use common\models\Itemimg;
use app\widgets\socialshare\Socialshare;
use common\models\Settings;
$settings = Settings::getDetail(1);
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_review'));?>
<div id="main" class="main-content"> 
      <div class="boxheadreview">     
          <div class="uk-container-center">   
          <?php  
            if(!empty($rows)){    
                  // $info = Article::getDetailArticle(17);
                   $fulltxt= "";$title="";$img_head="";
                   if(!empty($info)){
                      $fulltxt  = HtmlPurifier::process($info->fulltxt);
                      $title    = Html::encode($info->title);
                      $img_head = $info->getImage($info);
                   }                       
                  /*  echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' => $title,
                                    'url' => array('review/index'),//, 'id' => 10
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),  
                            ),
                   ));  */               
                ?>                  
                 <div class="boxitem"> 
                             <h1 class="uk-text-center"><?php echo $title;?></h1>
                             <div class="introtxt">
                              <?php echo $fulltxt;?> 
                             <div class="uk-text-center reviewcount">
                                     <span><?php echo Yii::t('app', 'Comentarios desde nuestra comunidad');?></span>
                                    <br />
                                     <?php
                                 if(!empty($settings)){
                                    ?>
                                     <span><?php echo number_format($settings->rating_value,1,',','');?></span>
                                     <?php
                                        $rating = floor($settings->rating_value);
                                        for($i=1;$i<=5;$i++){
                                            if($i<=$rating){
                                                echo '<i class="uk-icon-star"></i>';
                                            }else{
                                                echo '<i class="uk-icon-star-half-empty"></i>';
                                            }                
                                        }                                   
                                       ?>
                                       / <font class="totalrecord" style="padding-left:6px !important;font-size: 18px;"> <?php echo $totalcount;?></font> <?php echo  Yii::t('app','comentarios desde nuestra comunidad');?>
                                     <br />
                                     <?php
                                 }
                               ?>
                                  <span> 
                                     <?php echo Html::a('<i class="uk-icon-edit"></i> '.Yii::t('app','Escribir un comentario'),array('#'), array('class' => 'btn btn-warning btnwrite')) ?>
                                    </span>
                              </div> 
                                   <?php echo Socialshare::widget(array('view'=>'index','url'=>$urlshare,'clss'=>'uk-text-center'));?>         
                             </div>
                   </div>
           </div>
           <?php
             }else{
                echo "Updating!";
             }
           ?>        
      </div>
 </div>     
 <div class="listreview">
             <div class="listitem">                     
                     <?php
                          foreach($rows as $row){   
                                 $infouser = array();
                                 if($row->user_id>0){
                                    $infouser = Account::getAccount($row->user_id);
                                 }
                                 $itemimg = Itemimg::getAllImagetypeExt('review',$row->id);
                                 echo $this->render('_item',array('row'=>$row,'itemimg'=>$itemimg,'infouser'=>$infouser));  
                                 ?>                                      
                              <?php
                            }
                     ?>   
               </div>                
                <?php
                  if(!empty($pages)){
                            ?><br />
                             <div class="uk-container uk-container-center listpages" style="display: inline-block;" align="center">
                           <?php
                               echo LinkPager::widget(array(
                                        'pagination' =>$pages,
                                        'firstPageLabel' => '<i class="uk-icon-angle-double-left"></i>',
                                        'lastPageLabel' => '<i class="uk-icon-angle-double-right"></i>',
                                        'prevPageLabel' => '<i class="uk-icon-angle-left"></i>',
                                        'nextPageLabel' => '<i class="uk-icon-angle-right"></i>',
                                        'maxButtonCount' => 5,
                                        'options' =>array(
                                                            //'tag' => 'div',
                                                            'class' => 'pagination listpages',
                                                            'id' => 'pager-container',
                                                        ),
                                         'linkOptions' =>array('class' => 'mylink'),
                                         //'activePageCssClass' => 'myactive',
                                        //'disabledPageCssClass' => 'mydisable',
                                        // Customzing CSS class for navigating link
                                        //'prevPageCssClass' => 'mypre',
                                        //'nextPageCssClass' => 'mynext',
                                        //'firstPageCssClass' => 'myfirst',
                                        //'lastPageCssClass' => 'mylast',
                                    ));
                                    ?>
                                     </div>
                                     <?php
                           }
                        ?>  
        
     </div>       
</div> 