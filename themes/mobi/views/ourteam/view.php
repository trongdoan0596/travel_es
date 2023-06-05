<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_aboutus'));?>
<div id="main" class="main-content"> 
      <div class="detailourteam">     
        
          <?php             
            if(!empty($model)){    
                 $url_home = 'ourteam/index';
                 $lbl = Yii::t('app','Authentik teams');
                 if($model->country_id !=232 ){
                    $url_home = 'ourteam/indexfr';
                    $lbl = Yii::t('app','Authentik teams');
                 } 
                 echo Breadcrumbs::widget(array(
                            'itemTemplate' => "<li>{link}</li>\n", // template for all links
                            'links' => array(
                                array(
                                    'label' =>$lbl,
                                    'url' => array($url_home),//, 'id' => 10
                                    'template' => "<li>{link}</li>\n", // template for this link only
                                ),
                               
                            ),
                   ));               
                ?>
                <div class="boximg uk-text-center">
                      <?php
                       $img   = $model->getImage($model);
                       ?>
                       <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo Html::encode($model->title);?>" />
                </div>
                <div class="boxcontent">
                        <div class="title uk-text-center">
                           <h1><?php echo Html::encode($model->title);?></h1>
                           <span><?php echo Html::encode($model->profession);?></span>
                        </div>    
                        <div class="introtxt">
                        <?php 
                        if($model->introtxt!=""){
                            echo $model->introtxt;//HtmlPurifier::process($model->introtxt);
                        }
                        ?>
                        </div>                 
                        <div class="fulltxt">
                           <?php echo $model->fulltxt;//HtmlPurifier::process($model->fulltxt);?>
                        </div>  
                </div>
            
           <?php
             }else{
                echo "Updating!";
             }
           ?>        
         
     </div>
     <br />
  <!-- <div class="clsback">
   <?php //echo Html::a('<i class="uk-icon-arrow-left"></i> '.Yii::t('app', 'Back'),array($url_home), array('class' => 'btn btn-warning clsback')) ?>
   </div>  
   -->
   <?php if(!empty($rows)){ ?>
     <div class="listourteam">  
        <div class="boxitem"> 
             <div class="listitem">     
              <h2 class="uk-text-center"><?php echo Yii::t('app', 'Our team');?></h2>
     <?php
          foreach($rows as $row){                          
                 $title = $row->title;
                 $url   = $row->createUrl($row);
                 $img   = $row->getImage($row);
                 $profession = $row->profession;
                 $introtxt = $row->introtxt;
                 if($row->id != $model->id){
                 ?>
                  <div class="boxitemteam">                                           
                       <dl class="uk-text-center boximg">
                            <a class="hover-effect-circle" href="<?php echo $url;?>">
                                <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $title;?>" />
                             </a>
                        </dl>  
                        <dl class="content">
                                <dt class="uk-text-center"><a href="<?php echo $url;?>"><?php echo $title;?></a></dt>
                                <dd class="uk-text-center titlejob"><?php echo $profession;?></dd>
                                <dd class="uk-text-center introtxt"><?php 
                                if($introtxt !=""){
                                     echo $introtxt;
                                }                                                            
                               ?></dd>
                         </dl>
                 </div>   
                 <?php
                 }
        }
        ?>
              </div>
           </div>
        </div>
    <?php
     }
    ?>
</div>       