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
$url_all = Url::toRoute(array('tour/alltour'));
$tmp_start = array();
?>
<?php echo Slidesub::widget(array('view' =>'index'));?>
<div id="main" class="main-content">               
      <?php
        if(!empty($info)){
            ?>
        <div class="boxtour">     
           <div class="uk-container uk-container-center">     
            <div class="infocate">
                     <div class="uk-grid">                                
                        <div class="uk-width-1-1" style="text-align: center;"> 
                            <?php  echo HtmlPurifier::process($info->fulltxt);?>
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
                             <form action="<?php echo $url_all;?>" method="get">   
                                  <h1 style="display: none;">Viaje a Vietnam</h1>        
                                  <h2><?php echo Yii::t('app', 'Filtro de tours');?></h2>   
                                  <div class="uk-grid">     
                                        <div class="uk-width-3-10"> 
                                          <?php echo Yii::t('app', 'Destinos');?>
                                          <select name="country_id" id="country_id" class="slcfillter" onchange="SlcCountry(this.value);">
                                                <option value="0">---<?php echo Yii::t('app', 'Destinos');?>---</option>
                                                 <?php
                                                  if(!empty($country)){
                                                      foreach($country as $row){       
                                                           if($country_id==$row->id){
                                                               echo '<option selected="selected" value="'.$row->id.'" >'.$row->name.'</option>'; 
                                                            }else{
                                                               echo '<option value="'.$row->id.'">'.$row->name.'</option>'; 
                                                            }                                                          
                                                      }
                                                  }
                                                  ?>                                               
                                          </select>
                                         </div>
                                         <div class="uk-width-3-10" style="white-space: nowrap;">                               
                                          <?php echo Yii::t('app', 'Categoría de tour');?>
                                              <select name="cat_id" id="cat_id" class="slcfillter">
                                               <option value="0">---<?php echo Yii::t('app', 'Categoría');?>---</option>
                                                <?php
                                                  if(!empty($cattour)){             
                                                      foreach($cattour as $row){ 
                                                        if($cat_id==$row->id){
                                                            echo '<option selected="selected" value="'.$row->id.'">'.$row->title.'</option>';
                                                        }else{
                                                            echo '<option value="'.$row->id.'">'.$row->title.'</option>';
                                                        }
                                                          
                                                      }
                                                  }
                                                  ?>                                     
                                              </select>
                                         </div>
                                         <div class="uk-width-2-10" style="padding-left:50px;white-space: nowrap;"> 
                                             <?php echo Yii::t('app', 'Número de días');?>
                                             <input type="text" id="numberday" name="numberday" style="text-align: center;border: 1px solid #ccc;border-radius: 4px;width:50px;height:40px;" />
                                         </div>
                                         <!--<div class="uk-width-3-10">                               
                                              <?php //echo Yii::t('app', 'Start From');?>
                                              <select name="start_id" id="start_id" class="slcfillter">
                                                  <option value="0">---<?php //echo Yii::t('app', 'Start From');?>---</option>
                                                  <?php
                                                 /* 
                                                  if(!empty($filter)){
                                                      $tmps = array("City","city");
                                                      foreach($filter as $row){                                                         
                                                         $namecity = str_replace($tmps, "",$row->title);
                                                         if($row->id==3) $namecity = $namecity.' Ville';
                                                         $tmp_start[$row->country_id][$row->id] = $namecity;
                                                         if($country_id>0){
                                                            if($start_id==$row->id){
                                                               echo '<option selected="selected" value="'.$row->id.'">'.$namecity.'</option>'; 
                                                            }else if($country_id==$row->country_id){                                                                
                                                               echo '<option value="'.$row->id.'">'.$namecity.'</option>'; 
                                                            }
                                                         }else{
                                                            if($start_id==$row->id){
                                                               echo '<option selected="selected" value="'.$row->id.'">'.$namecity.'</option>'; 
                                                            }else{
                                                               echo '<option value="'.$row->id.'">'.$namecity.'</option>'; 
                                                            }
                                                         }
                                                         
                                                            
                                                         
                                                      }
                                                  }*/
                                                  ?>                                         
                                             <!--  </select>
                                         </div>-->
                                         <div class="uk-width-1-10" style="padding-left:40px !important;"> 
                                             <input type="submit" class="btn btnfilter" value="<?php echo Yii::t('app', 'Filtrar');?>" />
                                         </div>
                                  </div> 
                             </form> <br /><br />
                             <div class="uk-grid">     
                              <?php                
                                if(!empty($rows)){                 
                                  foreach($rows as $row){ 
                                         echo $this->render('_item',array('row'=>$row));  
                                   }
                                }else{
                                    echo '<div class="nodata">No data!</div>';
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
<script type="text/javascript">
var list='<?php echo addslashes(json_encode($tmp_start));?>';
list=eval('('+list+')');
function SlcCountry(value){   
    if(value>0){
            var str = '<option value="0" selected="selected">---Start From---</option>';
            for(var i in list[value]){	
               str = str + '<option value="'+i+'">'+list[value][i]+'</option>';             
            }           
            $("#start_id").html(str);
     }
}

</script>  