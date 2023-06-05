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
?>
<?php //echo Slidesub::widget(array('view' =>'index'));?>
<div class="boxtour">                 
      <?php
        if(!empty($info)){
            ?>         
            <div class="infocate">                                             
                <div class="content"> 
                    <?php  echo HtmlPurifier::process($info->fulltxt);?>
                 </div>                             
             </div>   
      <?php                         
        }
      ?>  
  <div class="boxfilter">
      <form action="<?php echo $url_all;?>" method="get">        
         <h2><?php echo Yii::t('app', 'Filtro de tours');?></h2>                                     
                    <div class="item"> 
                      <?php //echo Yii::t('app', 'Destinations');?>
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
                     <div class="item">                               
                      <?php //echo Yii::t('app', 'Catégorie de voyage ');?>
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
                     <div class="item" style="display: none;">                               
                          <?php //echo Yii::t('app', 'Start From');?>
                          <select name="start_id" id="start_id" class="slcfillter" >
                              <option value="0">---<?php //echo Yii::t('app', 'Start From');?>---</option>
                              <?php
                              $tmp_start = array();
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
                              } 
                              ?>                                         
                          </select>
                     </div>
                     <div class="item" style="margin-top:20px !important;">
                         <input type="submit" class="btnfilter" value="<?php echo Yii::t('app', 'Filtrar');?>" />
                     </div>
        </form>
  </div>    
  
<div class="listitem"> 
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