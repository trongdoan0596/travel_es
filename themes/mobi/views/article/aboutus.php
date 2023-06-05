<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\widgets\page\withus\Withus;
use app\widgets\page\boxourteam\Boxourteam;
use app\widgets\page\servicework\Servicework;
use app\widgets\slidebg\slidesub\Slidesub;
?>
<?php //echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_aboutus'));?>
<div id="main" class="boxaboutus"> 
    <div class="aboutus">
          <?php             
            if(!empty($model)){                
                ?>
                <h1 class="title"><?php echo Html::encode($model->title);?></h1>
                  <?php
                  if($model->introtxt!=""){
                    ?>
                       <div class="introtxt">
                        <?php
                            echo HtmlPurifier::process($model->introtxt);
                        ?>
                       </div>  
                  <?php
                  }
                 ?>               
                <div class="content">
                  <?php echo HtmlPurifier::process($model->fulltxt);?>
                </div>   
           <?php
             }else{
                echo "Updating!";
             }
           ?>   
     </div>  
     <?php echo Withus::widget(array('view' =>'aboutmobi'));?>
     <?php echo Servicework::widget(array('view' =>'mobi'));?>
     <?php echo Boxourteam::widget(array('view' =>'mobi'));?>
</div>       