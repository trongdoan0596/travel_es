<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
use app\widgets\traveller\travellerreview\Travellerreview;
use app\widgets\page\servicework\Servicework;
use common\models\Region;
use common\models\Tourcate;
use common\models\Country;
$country = Country::getCountry();
$filter  = Region::getAllFilter();
$cattour = Tourcate::getCateTourparent(1);
$class_ex ='';
if(!empty($tourcate)){
    $class_ex ='slidesubbg_cate'.$tourcate->id;
}
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>$class_ex));?>
<div class="boxtour">               
      <?php
        if(!empty($tourcate)){
            ?> 
          <div class="infocate">                                               
                <h2><?php  echo $tourcate->introtxt;//HtmlPurifier::process($tourcate->introtxt);?></h2>   
                <div class="content">                     
                    <?php  echo $tourcate->fulltxt;//HtmlPurifier::process($tourcate->fulltxt);?>
                </div> 
          </div>      
      <?php                         
        }
      ?>       
<div class="listitem"> 
      <?php                
        if(!empty($rows)){                 
          foreach($rows as $row){ 
                 echo $this->render('_item',array('row'=>$row));  
           }
        }   
      ?> 
 </div>  
<?php
 if(!empty($pages)){
?>
<center>
    <div class="uk-container uk-container-center listpages" align="center" style="display: inline-block;">
           <?php
               echo LinkPager::widget(array(
                        'pagination' =>$pages,
                        'firstPageLabel' => '<i class="uk-icon-angle-double-left"></i>',
                        'lastPageLabel' => '<i class="uk-icon-angle-double-right"></i>',
                        'prevPageLabel' => '<i class="uk-icon-angle-left"></i>',
                        'nextPageLabel' => '<i class="uk-icon-angle-right"></i>',
                        'maxButtonCount' => 5,
                        'options' =>array(
                                            'class' => 'pagination listpages',
                                            'id' => 'pager-container',
                                        ),
                         'linkOptions' =>array('class' => 'mylink'),
                        
                    ));
             ?>
         </div>
  </center>       
  <br />
<?php
   }
?> 
<?php //echo Servicework::widget(array('view' =>'tour'));?>
<?php //echo Travellerreview::widget(array('view' =>'detailtour'));?>      
</div>  