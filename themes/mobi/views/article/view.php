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
              <div class="uk-width-1-1 sharesocial">
                 <div class="addthis_inline_share_toolbox toolbox"></div>
                 <!-- Go to www.addthis.com/dashboard to customize your tools -->
                 <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-584fd24f2f4c8c63"></script>
              </div>  
           <?php
             }else{
                echo "Updating!";
             }
           ?>        
          </div>
     </div>
</div>       