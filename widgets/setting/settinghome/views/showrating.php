<?php
if(!empty($row)){
   if($row->status==1){    
    ?>
    <div class="showrating">
       <span><?php echo number_format($row->rating_value,1,',','');?></span>
        <?php
            $rating = floor($row->rating_value);
            for($i=1;$i<=5;$i++){
                if($i<=$rating){
                    echo '<i class="uk-icon-star"></i>';
                }else{
                    echo '<i class="uk-icon-star-half-empty"></i>';
                }                
            }
        ?>  
        / <font class="totalrecord" style="padding-left:6px !important;"> <?php echo $total;?></font> <?php echo  Yii::t('app','comentarios');?>
    </div>    
    <?php
   }
}   
?>