 <?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$id    = $row->id;
$tmp   = array();
$tmp   = explode('<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>',$row->fulltxt);
$fulltxt = $tmp[0];
if(count($tmp)==2){    
    $fulltxt = $fulltxt.'<span class="remorereview" id="readmore_'.$id.'"  onclick="ShowFull('.$id.')"> ... '.Yii::t('app', 'Read more').'</span>';
}
?>
<div class="uk-accordion-title <?php echo $clss;?>"><span class="active"><i class="uk-icon-circle-fix"></i><?php echo Html::encode($row->title);?></span></div>
<div class="uk-accordion-content">
<?php echo $fulltxt;?>
<?php
if(count($tmp)==2){
    ?>
    <span class="fulltxthide" id="fulltxthide_<?php echo $id;?>">
    <?php echo $tmp[1];?>    
    </span>
<?php  
}
?>
<span style="text-align: right;float: right;cursor: pointer;" onclick="HideAccordion(<?php echo $cate->id;?>);"><?php echo Yii::t('app', 'Read less');?></span>
</div>