<?php
use app\widgets\page\withus\Withus;
use app\widgets\page\boxourteam\Boxourteam;
use app\widgets\slidebg\slidehome\Slidehome;
use app\widgets\tour\featured\Featured;
use app\widgets\blog\recentblog\Recentblog;
use app\widgets\traveller\travellerreview\Travellerreview;
use app\widgets\video\lastvideo\Lastvideo;
?>
<?php echo Slidehome::widget(array('view' =>'index'));?>
<?php echo Withus::widget(array('view' =>'index'));?>
<?php echo Travellerreview::widget(array('view' =>'index'));?>
<?php echo Featured::widget(array('view' =>'index'));?>
<?php echo Boxourteam::widget(array('view' =>'index'));?>
<?php echo Lastvideo::widget(array('view' =>'index'));?>
<?php echo Recentblog::widget(array('view' =>'index','article_id'=>193));?>