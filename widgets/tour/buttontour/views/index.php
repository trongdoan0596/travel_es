<?php
use yii\helpers\Html;
?>
<div class="buttontour" align="center">            
   <ul class="uk-list">      
        <li>         
         <?php echo Html::a(Yii::t('app','Ver todos'),array('tour/alltour'), array('class' => 'btn btn-warning btnalltour')) ?>
       </li>
   </ul>
</div>