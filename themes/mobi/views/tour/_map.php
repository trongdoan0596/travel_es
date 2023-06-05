<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Destination;
 $num_day = $model->num_day;
 if($model->num_day<=9){
    $num_day = '0'.$model->num_day;
 }
 $clssbgmap = '';
 if($model->imgmap!=''){
    $clssbgmap = 'boxmapimg';
 }
 
$destination_ids = $model->destination_ids;
$arr_des   = explode(",",$model->destination_ids);
$rows      = Destination::getAllDestination();
$arrclass  = array();
if(!empty($rows)){                 
      foreach($rows as $row){ 
            $id_ = $row->id;
            if (in_array ($id_, $arr_des)) {
                $arrclass[$row->possitionsname]['class'] ='';
                $arrclass[$row->possitionsname]['title']   = $row->title;
            }else{
                $arrclass[$row->possitionsname]['class'] ='hidebg';
                $arrclass[$row->possitionsname]['title']   = '';
            }

       }
}   
?>
<div class="contryside">
            <h1><?php echo $model->title;?> - <?php echo $num_day.' '.Yii::t('app', 'Jour');?>s</h1>
            <div class="uk-grid boxmap">               
                   <div class="uk-width-1-2 map  <?php echo $clssbgmap;?>">
                                    <h2><?php echo Yii::t('app', 'You will discover');?></h2>
                                     <!-- begin map-->
                                      <ul class="uk-list">
                                      <?php
                                      if($model->imgmap !=''){
                                        $imgmap = $model->getImageMap($model);
                                        ?>
                                        <li>                                        
                                            <img src="<?php echo $imgmap;?>" />
                                        </li>
                                        <?php
                                      }else{
                                      ?>
                                           <li class="dongvan">
                                              <figure class="boxcontent <?php echo $arrclass['dongvan']['class'];?>">  
                                                  <?php echo $arrclass['dongvan']['title'];?> &nbsp;
                                              </figure>                          
                                           </li>
                                           <li class="hagiang">
                                              <figure class="boxcontent <?php echo $arrclass['hagiang']['class'];?>">  
                                                  <?php echo $arrclass['hagiang']['title'];?> &nbsp;
                                              </figure>                          
                                           </li>
                                           <li class="uk-grid bachacaobang">
                                              <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['bacha']['class'];?>">  
                                                  <?php echo $arrclass['bacha']['title'];?> &nbsp;      
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['caobang']['class'];?>">  
                                                  <?php echo $arrclass['caobang']['title'];?> &nbsp;
                                              </figure>                          
                                           </li>
                                           <li class="uk-grid sapababe">
                                               <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['sapa']['class'];?>">  
                                                  <?php echo $arrclass['sapa']['title'];?> &nbsp;      
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['babe']['class'];?>">  
                                                  <?php echo $arrclass['babe']['title'];?> &nbsp;     
                                              </figure>                        
                                           </li>
                                           <li class="dienbien">
                                              <figure class="uk-align-left boxcontent <?php echo $arrclass['dienbien']['class'];?>">  
                                                  <?php echo $arrclass['dienbien']['title'];?> &nbsp;      
                                              </figure>                          
                                           </li>
                                            <li class="mucangchai">
                                              <figure class="uk-align-left boxcontent <?php echo $arrclass['mucangchai']['class'];?>">  
                                                  <?php echo $arrclass['mucangchai']['title'];?> &nbsp;    
                                              </figure>                          
                                           </li>
                                           <li class="nghialo">
                                              <figure class="uk-align-left boxcontent <?php echo $arrclass['nghialo']['class'];?>">  
                                                  <?php echo $arrclass['nghialo']['title'];?> &nbsp;   
                                              </figure>                          
                                           </li>
                                            <li class="uk-grid hanoihalongsonla">
                                              <figure class="uk-grid-width-1-3 boxcontent <?php echo $arrclass['sonla']['class'];?>">  
                                                  <?php echo $arrclass['sonla']['title'];?> &nbsp; 
                                              </figure> 
                                               <figure class="uk-grid-width-1-3 boxcontent1 <?php echo $arrclass['hanoi']['class'];?>">  
                                                  <strong><?php echo $arrclass['hanoi']['title'];?> &nbsp;</strong> 
                                              </figure> 
                                              <figure class="uk-grid-width-1-3 boxcontent2 <?php echo $arrclass['halong']['class'];?>">  
                                                  <?php echo $arrclass['halong']['title'];?> &nbsp;
                                              </figure>                        
                                           </li>
                                           <li class="uk-grid maichaucatba">
                                               <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['maichau']['class'];?>">  
                                                  <?php echo $arrclass['maichau']['title'];?>&nbsp;
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['catba']['class'];?>">  
                                                  <?php echo $arrclass['catba']['title'];?>&nbsp;
                                              </figure>                        
                                           </li>
                                            <li class="uk-grid puluongninhbinh">
                                              <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['puluong']['class'];?>">  
                                                    <?php echo $arrclass['puluong']['title'];?>&nbsp; 
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['ninhbinh']['class'];?>">  
                                                     <?php echo $arrclass['ninhbinh']['title'];?>&nbsp;   
                                              </figure>                      
                                           </li>
                                           <li class="luangprabang">
                                              <figure class="boxcontent <?php echo $arrclass['luangprabang']['class'];?>">  
                                                  <?php echo $arrclass['luangprabang']['title'];?>&nbsp; 
                                              </figure>                          
                                           </li>
                                           <li class="uk-grid laophonxavan">
                                              <figure class="uk-grid-width-1-2 boxcontent">  
                                                  LAOS
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['phonsavan']['class'];?>" >  
                                                  <?php echo $arrclass['phonsavan']['title'];?>&nbsp;
                                              </figure>                                                                        
                                           </li>                                           
                                            <li class="uk-grid vangviengvinh">
                                               <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['vangvieng']['class'];?>">  
                                                  <?php echo $arrclass['vangvieng']['title'];?>&nbsp;
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['vinh']['class'];?>">  
                                                  <?php echo $arrclass['vinh']['title'];?>&nbsp;
                                              </figure>                        
                                           </li>
                                           
                                           <li class="vientaine">
                                              <figure class="boxcontent <?php echo $arrclass['vientaine']['class'];?>">  
                                                 <?php echo $arrclass['vientaine']['title'];?> &nbsp;
                                              </figure>                          
                                           </li>                                           
                                           <li class="hue">
                                              <figure class="boxcontent <?php echo $arrclass['hue']['class'];?>">  
                                                  <?php echo $arrclass['hue']['title'];?> &nbsp;     
                                              </figure>                          
                                           </li>
                                           <li class="hoian">
                                              <figure class="boxcontent <?php echo $arrclass['hoian']['class'];?>">  
                                                  <?php echo $arrclass['hoian']['title'];?> &nbsp;    
                                              </figure>                          
                                           </li>
                                           <li class="myson">
                                              <figure class="boxcontent <?php echo $arrclass['myson']['class'];?>">  
                                                 <?php echo $arrclass['myson']['title'];?> &nbsp;  
                                              </figure>                          
                                           </li>
                                           <li class="pakse ">
                                              <figure class="boxcontent <?php echo $arrclass['pakse']['class'];?>">  
                                                  <?php echo $arrclass['pakse']['title'];?> &nbsp;      
                                              </figure>                          
                                           </li>
                                             <li class="uk-grid champassakkontum">
                                               <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['champassak']['class'];?>">  
                                                  <?php echo $arrclass['champassak']['title'];?> &nbsp; 
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['kontum']['class'];?>">  
                                                 <?php echo $arrclass['kontum']['title'];?> &nbsp; 
                                              </figure>                        
                                           </li>
                                           <li class="uk-grid siemreapbuonmathuot">
                                               <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['siemreap']['class'];?>">  
                                                  <?php echo $arrclass['siemreap']['title'];?>&nbsp; 
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['buonmathuot']['class'];?>">  
                                                  <?php echo $arrclass['buonmathuot']['title'];?>&nbsp; 
                                              </figure>                        
                                           </li>
                                          <li class="uk-grid battambangnhatrang">
                                               <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['battambang']['class'];?>">  
                                                  <?php echo $arrclass['battambang']['title'];?>&nbsp; 
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['nhatrang']['class'];?>">  
                                                  <?php echo $arrclass['nhatrang']['title'];?>&nbsp;   
                                              </figure>                        
                                           </li>                                          
                                           <li class="uk-grid cambodiadalat">
                                               <figure class="uk-grid-width-1-2 boxcontent ">  
                                                  CAMBODIA 
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['dalat']['class'];?>">  
                                                  <?php echo $arrclass['dalat']['title'];?>&nbsp;
                                              </figure>                        
                                           </li>                                           
                                         <li class="uk-grid pnompenhmuine">
                                              <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['pnompenh']['class'];?>">  
                                                    <?php echo $arrclass['pnompenh']['title'];?>&nbsp;
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['muine']['class'];?>">  
                                                    <?php echo $arrclass['muine']['title'];?>&nbsp;  
                                              </figure>                      
                                           </li>
                                           <li class="uk-grid chaudochochiminh">
                                              <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['chaudoc']['class'];?>">  
                                                  <?php echo $arrclass['chaudoc']['title'];?>&nbsp;
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['hochiminh']['class'];?>">  
                                                  <?php echo $arrclass['hochiminh']['title'];?>&nbsp;
                                              </figure>                      
                                           </li>
                                           <li class="longxuyen">
                                              <figure class="boxcontent <?php echo $arrclass['longxuyen']['class'];?>">  
                                                  <?php echo $arrclass['longxuyen']['title'];?>&nbsp;    
                                              </figure>                          
                                           </li>
                                            <li class="uk-grid phuquocbentre">
                                              <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['phuquoc']['class'];?>">  
                                                  <?php echo $arrclass['phuquoc']['title'];?>&nbsp; 
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['bentre']['class'];?>">  
                                                  <?php echo $arrclass['bentre']['title'];?>&nbsp;
                                              </figure>                      
                                           </li>
                                            <li class="uk-grid canthovinhlong">
                                              <figure class="uk-grid-width-1-2 boxcontent <?php echo $arrclass['cantho']['class'];?>">  
                                                   <?php echo $arrclass['cantho']['title'];?>&nbsp;
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1 <?php echo $arrclass['vinhlong']['class'];?>">  
                                                   <?php echo $arrclass['vinhlong']['title'];?>&nbsp;
                                              </figure>                      
                                           </li>
                                          <?php } ?> 
                                       </ul>
                                       <!-- End map-->
                                    </div>
                                                             
     </div>                                      
</div>