<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use common\models\Article;
use app\widgets\socialshare\Socialshare;
use app\widgets\page\boxourteam\Boxourteam;
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_aboutus'));?>
<div id="main" class="main-content"> 
      <div class="boxheadreview">     
          <div class="uk-container uk-container-center">   
          <?php  
            if(!empty($rows)){                      
                   if(!empty($info)){
                      $fulltxt  = HtmlPurifier::process($info->fulltxt);
                      $title    = Html::encode($info->title);
                      $img_head = $info->getImage($info);
                   }                       
                    echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' => $title,
                                    'url' => array('article/recrutement'),//, 'id' => 10
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
                                    <div class="uk-width-1-4" style="padding-left:34px !important;">
                                    <img src="<?php echo $img_head;?>" /></div>
                                    <div class="uk-width-3-4" style="padding-left:30px !important;"> <?php echo $fulltxt;?></div>                                    
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
                        
                </div>
           <?php
             }else{
                echo "Updating!";
             }
           ?>        
          </div>
     </div>
 <div class="listrecrutement">
     <div class="uk-container uk-container-center">   
             <div class="border-top-left listitem"> 
                    <h3><?php echo Yii::t('app', 'Current Vacancies at Authentik Vietnam');?></h3>         
                    <div class="uk-accordion" data-uk-accordion="" > 
                     <?php
                          $n = count($rows);$i=1;
                          foreach($rows as $row){  
                                 $clss="";
                                 if($i==$n) $clss="lastitem";
                                 echo $this->render('_item_re',array('row'=>$row,'clss'=>$clss));  
                                 $i++;
                                 ?>                            
                              <?php
                            }
                     ?> 
                     </div>
               </div>
               <br />             
             <?php echo Socialshare::widget(array('view'=>'index','url'=>$urlshare,'clss'=>'uk-text-center'));?> 
             <?php echo Boxourteam::widget(array('view' =>'index'));?>
           </div> 
     </div>       
</div>    