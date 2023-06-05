<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="boxtools">
<h3>Tools INDEX TABLE :</h3> 
 <div class="control-group">
    <div class="controls">
    <?php echo Html::a('Service',array('/tools/service'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Service Sub',array('/tools/servicesub'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Service Price',array('/tools/serviceprice'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Service Feedback',array('/tools/servicefeedback'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Service Filenote',array('/tools/servicefilenote'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Service Photo',array('/tools/servicephoto'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Service Promotion',array('/tools/servicepro'), array('class' => 'btn btn-warning')) ?>
    </div>
</div>
<div class="control-group">
    <div class="controls">
    <?php echo Html::a('FR Article',array('/tools/article'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('FR Booktour',array('/tools/booktour'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Booktour Comment',array('/tools/booktourcomment'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Booktour Detail',array('/tools/booktourdetail'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Booktour Email',array('/tools/booktouremail'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Booktour Group',array('/tools/booktourgroup'), array('class' => 'btn btn-warning')) ?>
    <?php echo Html::a('Booktour Price',array('/tools/booktourprice'), array('class' => 'btn btn-warning')) ?>
    </div>
</div>
<div class="control-group">
    <div class="controls">
    <?php echo Html::a('Review',array('/tools/review'), array('class' => 'btn btn-warning')) ?>    
    <?php echo Html::a('Blog',array('/tools/blog'), array('class' => 'btn btn-warning')) ?>    
    <?php echo Html::a('Blog Cate',array('/tools/blogcate'), array('class' => 'btn btn-warning')) ?>   
    <?php echo Html::a('Tour',array('/tools/tour'), array('class' => 'btn btn-warning')) ?> 
    <?php echo Html::a('Tour Cate',array('/tools/tourcate'), array('class' => 'btn btn-warning')) ?> 
    <?php echo Html::a('Tour Detail',array('/tools/tourdetail'), array('class' => 'btn btn-warning')) ?> 
    <?php echo Html::a('Tour Extentions',array('/tools/tourextentions'), array('class' => 'btn btn-warning')) ?> 
    </div>
</div>
<h3>Tools DELETE RECORD : <i class="uk-icon-question-circle" data-uk-tooltip="{pos:'bottom'}" title="- Xóa những record có trạng thái bằng -1"></i></h3> 
<div class="control-group">
    <div class="controls">
      <?php echo Html::a('Dele Service',array('/tools/delservice'), array('class' => 'btn btn-warning')) ?>
      <?php echo Html::a('Dele Service Sub',array('/tools/delservicesub'), array('class' => 'btn btn-warning')) ?>
      <?php echo Html::a('Dele Service Price',array('/tools/delserviceprice'), array('class' => 'btn btn-warning')) ?>
      <?php echo Html::a('Dele Service Feedback',array('/tools/delservicefeedback'), array('class' => 'btn btn-warning')) ?> 
      <?php echo Html::a('Dele Service Filenote',array('/tools/delservicefilenote'), array('class' => 'btn btn-warning')) ?> 
      <?php echo Html::a('Dele Service Photo',array('/tools/delservicephoto'), array('class' => 'btn btn-warning')) ?> 
      <?php echo Html::a('Dele Service Promotion',array('/tools/delservicepro'), array('class' => 'btn btn-warning')) ?> 
    </div>
</div>
</div>