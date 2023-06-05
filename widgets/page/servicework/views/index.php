<?php
use yii\helpers\Url;
if(!empty($rows)){
 ?>
 <style>
 .boxservicecontent{
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border: 1px solid #d4d4d4;  
    padding: 10px;
    height: 205px;    
    margin-bottom: 20px !important;
 }
  .boxservicecontent h4{
    font-size: 18px !important;
    padding-top: 14px;
  }
 </style>
<div class="servicework">
      <div class="box-service">
           <div class="uk-container uk-container-center"> 
              <div class="title-service" ><?php echo $infocate->title;?></div>
              <div class="uk-text-center txthome"><?php echo $infocate->fulltxt;?></div>
            </div>
      </div>   
      <div class="contenthead">
            <div class="uk-container uk-container-center"> 
                <div class="uk-grid boxservice">  
      <?php
           $i=1;$str_top = '';$str_bottom = '';$step='';$str= '';
           foreach($rows as $row){                          
                 $title = str_replace("Paso ".$i.".", "",$row->title);
                 $introtxt = $row->introtxt;
                 $fulltxt  = $row->fulltxt;
                 ?>
                 <div class="uk-width-1-1" style="padding-bottom:10px;height: 120px !important;margin-bottom: 10px !important;">
                      <div class="boxcontentstep" style="text-align: left !important;">                        
                         <h4 class="titlestep<?php echo $i;?>"><?php echo $title;?></h4>
                         <div class="contentstep" style="text-align: left !important;padding-left:60px;padding-top: 0px !important;"><?php echo $fulltxt;?></div>
                         <div class="boxstep<?php echo $i;?>"><b>Paso</b> <br /><font class="numberstep">0<?php echo $i;?></font></div>
                      </div>
                  </div>
                 <?php              
                 $i++;
           }
        ?>                       
               </div>            
          </div>
      </div>          
</div>
<br />
<?php
}
?>