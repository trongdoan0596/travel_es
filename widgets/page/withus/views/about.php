<?php
use yii\helpers\Url;
 if(!empty($infocate)){    
?>
<div class="uk-container uk-container-center boxwhyus"> 
  <h1 class="uk-h1 uk-text-center"><?php echo $infocate->title;?></h1>  
  <div class="uk-text-center txthome"><?php echo $infocate->fulltxt;?></div>
 
  <div class="uk-grid">
      <?php
           $i=1;$arr_ = array();
           foreach($rows as $row){                          
                 $title = $row->title;
                 $introtxt = $row->introtxt;
                 $arr_[$i] = $row->introtxt;
                 ?>
                  <div class="uk-width-1-5">
                       <div class="uk-panel uk-align-center">
                          <div class="circleus-<?php echo $i;?>"><a href="#"></a></div> 
                           <p class="uk-text-center"><?php echo $title;?></p>
                       </div>
                    </div>
                 <?php
                 $i++;
           }
        ?>          
  </div>
   <div class="uk-grid" style="margin-top: 14px;">
      <div class="uk-width-1-5">
         <div class="contentabout">
            <div style="padding-top: 10px;">
             <?php if(!empty($arr_[1])) echo $arr_[1];?>
           </div>
         </div>
      </div>
      <div class="uk-width-1-5">
         <div class="contentabout">
             <div style="padding-top: 10px;">
           <?php if(!empty($arr_[2])) echo $arr_[2];?>
            </div>
         </div>
      </div>
      <div class="uk-width-1-5">
        <div class="contentabout">
           <div style="padding-top: 10px;">
        <?php if(!empty($arr_[3])) echo $arr_[3];?>
         </div>
         </div>
      </div>
      <div class="uk-width-1-5" >
         <div class="contentabout">
            <div style="padding-top: 10px;">
         <?php if(!empty($arr_[4])) echo $arr_[4];?>
          </div>
         </div>
      </div>
      <div class="uk-width-1-5">
         <div class="contentabout">
            <div style="padding-top: 10px;">
            <?php if(!empty($arr_[5])) echo $arr_[5];?>
             </div>
         </div>
      </div>
   </div>
</div>
 <?php }?>