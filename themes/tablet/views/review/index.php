<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
//use common\models\Article;
use common\models\Account;
use common\models\Itemimg;
use app\widgets\socialshare\Socialshare;
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_review'));?>
<div id="main" class="main-content"> 
      <div class="boxheadreview">     
          <div class="uk-container uk-container-center">   
          <?php  
            if(!empty($rows)){                       
                   $fulltxt= "";$title="";$img_head="";
                   if(!empty($info)){
                      $fulltxt  = HtmlPurifier::process($info->fulltxt);
                      $title    = Html::encode($info->title);
                      $img_head = $info->getImage($info);
                   }                       
                    echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>$info->title,
                                    'url' => array('review/index'),//, 'id' => 10
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),  
                            ),
                   ));                 
                ?>                  
                 <div class="boxitem"> 
                         <h1><?php echo $title;?></h1>
                         <div class="introtxt">
                             <div class="txt">
                                  <div class="uk-grid">
                                  <?php
                                  if($img_head!=""){
                                    ?>
                                    <div class="uk-width-1-4">
                                    <img src="<?php echo $img_head;?>" width="277" height="208" /></div>
                                    <div class="uk-width-3-4"><?php echo $fulltxt;?>                                       
                                       <div class="starfb">
                                        <i class="uk-icon-star"></i><i class="uk-icon-star"></i><i class="uk-icon-star"></i><i class="uk-icon-star"></i><i class="uk-icon-star"></i> 4.9/5 <?php echo Yii::t('app','Calculated on the opinions of our customers on');?> <a target="_blank" href="https://www.facebook.com/authentikvietnamtravel/reviews">Facebook</a>
                                       </div>                                       
                                    </div>                                    
                                    <?php
                                  }else{
                                    ?>
                                    <div class="uk-width-1-1 uk-text-left">
                                        <?php echo $fulltxt;?>          
                                    </div>
                                    <?php
                                  }
                                  ?>
                                    
                                   
                                  </div>                                                           
                              </div>
                              
                         </div>
                        <div class="reviewcount">
                           <span><b class="numberreview"><?php echo $totalcount;?></b> <?php echo Yii::t('app', 'comentarios desde nuestra comunidad');?></span>
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
     <div class="uk-container uk-container-center">   
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
                            ?>
                             <div class="uk-container uk-container-center listpages" align="center">
                           <?php
                               echo LinkPager::widget(array(
                                        'pagination' =>$pages,
                                        'firstPageLabel' => '<i class="uk-icon-angle-double-left"></i>',
                                        'lastPageLabel' => '<i class="uk-icon-angle-double-right"></i>',
                                        'prevPageLabel' => '<i class="uk-icon-angle-left"></i>',
                                        'nextPageLabel' => '<i class="uk-icon-angle-right"></i>',
                                        //'maxButtonCount' => 3,
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
                     
               <div class="reviewsubmit" align="center">
                <?php echo Html::a('<i class="uk-icon-edit"></i> '.Yii::t('app','Escribir un comentario'),array('#'), array('class' => 'btn btn-warning btnwrite')) ?>
                <br />
                </div>
              <?php echo Socialshare::widget(array('view'=>'index','url'=>$urlshare,'clss'=>'uk-text-center'));?> 
           </div> 
     </div>       
</div> 