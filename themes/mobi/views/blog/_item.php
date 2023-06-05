 <?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\helper\StringHelper;
use common\models\User;
$title = Html::encode($row->title);
$url   = $row->createUrl($row);
$img   = $row->getImage($row);
$last_update = $row->last_update;
$y    = date("Y",strtotime($last_update));
$date = date("M d",strtotime($last_update)); 
$introtxt = $row->introtxt;//HtmlPurifier::process($row->introtxt);
?>
<div class="item">
        <div class="uk-container-center dateblog">
            <label><?php echo $y;?></label>
            <span><?php echo StringHelper::showMonthfr( $date);?></span>
        </div>
        <div class="boximg">
            <a href="<?php echo $url;?>">
                 <img  src="<?php echo $img;?>" alt="<?php echo $url;?>" />
            </a>
        </div>
        <div class="content">
            <p class="title"><a href="<?php echo $url;?>"><?php echo $title;?></a></p>
            <p class="bypost"><?php echo Yii::t('app','Por');?>: <a href="#"><?php echo User::Getname($row->user_id);?></a></p>
            <p class="introtxt"><?php echo  StringHelper::Subwords($introtxt,26);?></p>
        </div>
  
</div>