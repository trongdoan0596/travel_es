<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_aboutus'));?>
<div id="main" class="main-content"> 
      <div class="detailourteam">     
          <div class="uk-container uk-container-center">   
          <?php             
            if(!empty($model)){    
                 $url_home = 'ourteam/index';
                 $lbl = 'Authentik teams';
                 if($model->country_id !=232 ){
                    $url_home = 'ourteam/indexfr';
                    $lbl = 'Authentik teams';
                 } 
                 echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>$lbl,
                                    'url' => array($url_home),//, 'id' => 10
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),
                                array('label' =>$model->title,
                                      //'url' =>array('post/edit', 'id' => 1)
                                      ),
                                
                            ),
                   ));                 
                ?>
                <div class="uk-grid">
                    <div class="uk-width-1-3">
                         <div class="boximg">
                          <?php
                           $img   = $model->getImage($model);
                           ?>
                           <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo Html::encode($model->title);?>" />
                         </div>                
                    </div>
                    <div class="uk-width-2-3">
                        <div class="title">
                           <h1><?php echo $model->title;//Html::encode($model->title);?> <span> - <?php echo Html::encode($model->profession);?></span></h1> 
                        </div>    
                        <div class="introtxt"><?php 
                        if($model->introtxt!=""){
                            echo '"'.$model->introtxt.'"';//HtmlPurifier::process($model->introtxt)
                        }
                        ?></div>                 
                        <div class="fulltxt">
                           <?php                           
                           echo $model->fulltxt;//HtmlPurifier::process($model->fulltxt);?>
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
   <!--<div class="backbuttom">
   <?php //echo Html::a('<i class="uk-icon-arrow-left"></i> '.Yii::t('app', 'Back'),array($url_home), array('class' => 'btn btn-warning clsback')) ?>
   </div>  -->
    <?php
             if(!empty($rows)){ 
                ?>
             <div class="listourteam">     
          <div class="uk-container uk-container-center">      
             <div class="boxitem"> 
                 <div class="listitem">
                            <div class="uk-grid">
                         <?php
                              foreach($rows as $row){                          
                                     $title = $row->title;
                                     $url   = $row->createUrl($row);
                                     $img   = $row->getImage($row);
                                     $profession = $row->profession;
                                     $introtxt = $row->introtxt;
                                     if($row->id != $model->id){
                                     ?>
                                      <div class="uk-width-1-4">
                                         <div class="boxitemteam">
                                             <ul class="uk-list">
                                               <li>
                                                  <dl class="boximg">
                                                    <a class="hover-effect-circle" href="<?php echo $url;?>">
                                                        <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                                                     </a>
                                                  </dl>  
                                                        <dl>
                                                            <dt class="uk-text-center"><a href="<?php echo $url;?>"><?php echo $title;?></a></dt>
                                                            <dd class="uk-text-center titlejob"><?php echo $profession;?></dd>
                                                            <dd class="uk-text-center introtxt"><?php 
                                                            if($introtxt !=""){
                                                                 echo $introtxt;
                                                            }                                                            
                                                           ?></dd>
                                                        </dl>                  
                                                 </li>
                                             </ul>
                                         </div>                
                                      </div>  
                                  <?php
                                  }
                                }
                              ?>           
                             </div>
                         </div>
                 </div> 
               </div>
                 </div>    
                <?php
             }
                ?>
</div>       