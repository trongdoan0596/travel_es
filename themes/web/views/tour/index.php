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
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>$class_ex));?>
<div id="main" class="main-content">               
      <?php
        if(!empty($tourcate)){
            ?>
        <div class="boxtour">     
           <div class="uk-container uk-container-center">     
            <div class="infocate">
                     <div class="uk-grid">                                
                        <div class="uk-width-1-1"> 
                            <h1 style="display: none;"><?php 
                            if($tourcate->metatitle!=''){
                                echo $tourcate->metatitle;
                            }else{
                                echo $tourcate->title;
                            }
                            ?></h1>
                            <h2><?php  echo $tourcate->introtxt;//HtmlPurifier::process($tourcate->introtxt);?></h2>                              
                            <?php  echo $tourcate->fulltxt;//HtmlPurifier::process($tourcate->fulltxt);?>
                      </div>
                    </div>                                     
             </div>    
         </div>
      </div>                     
      <?php                         
        }
      ?>  
         <div class="maintour">     
               <div class="uk-container uk-container-center">     
                    <div class="listitem">  
                            <br />
                             <div class="uk-grid">     
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
                                <div class="uk-container uk-container-center listpages" align="center">
                                       <?php
                                           echo LinkPager::widget(array(
                                                    'pagination' =>$pages,                                                   
                                                    'options' =>array(                                                                      
                                                                        'class' => 'pagination listpages',
                                                                        'id' => 'pager-container',
                                                                    )
                                                    
                                                ));
                                         ?>
                                     </div>
                                     <?php
                                    }
                               ?>       
                    </div>
               </div>
        </div>    
<?php echo Servicework::widget(array('view' =>'tour'));?>
<?php echo Travellerreview::widget(array('view' =>'detailtour'));?>      
</div>  