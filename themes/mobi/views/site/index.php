<?php
use app\widgets\page\withus\Withus;
use app\widgets\page\boxourteam\Boxourteam;
use app\widgets\slidebg\slidehome\Slidehome;
use app\widgets\tour\featured\Featured;
use app\widgets\blog\recentblog\Recentblog;
use app\widgets\traveller\travellerreview\Travellerreview;
use app\widgets\video\lastvideo\Lastvideo;
?>
<?php echo Slidehome::widget(array('view' =>'mobi'));?>
<?php echo Withus::widget(array('view' =>'mobi'));?>
<?php echo Travellerreview::widget(array('view' =>'mobi'));?>
<?php echo Featured::widget(array('view' =>'mobi'));?>
<?php echo Boxourteam::widget(array('view' =>'mobi'));?>
<?php echo Lastvideo::widget(array('view' =>'mobi'));?>
<?php echo Recentblog::widget(array('view' =>'mobi','limit'=>4));?>