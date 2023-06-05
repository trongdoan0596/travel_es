<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
//use yii\helpers\Url;
//use yii\widgets\Breadcrumbs;
use app\widgets\slidebg\slidesub\Slidesub;
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_aboutus'));?>
<div id="main" class="main-content"> 
      <div class="boxarticle">     
          <div class="uk-container uk-container-center">   
          <?php             
            if(!empty($model)){                
                ?>
                <h1><?php echo Html::encode($model->title);?></h1>     
                <div class="content">
                  <?php echo HtmlPurifier::process($model->fulltxt);?>
                </div>
           <?php
             }else{
                echo "Updating!";
             }
           ?>        
          </div>
     </div>
</div>       