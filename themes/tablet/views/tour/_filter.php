<form id="frmcate" action="#" method="get">        
                                  <h2><?php //echo Yii::t('app', 'Tour Filter');?></h2>   
                                  <div class="uk-grid cathead1">     
                                         <div class="uk-width-1-10">                                           
                                         </div>                                
                                         <div class="uk-width-3-10">                               
                                         Tour Category 
                                              <select name="slccate" id="slccate" class="slcfillter">
                                               <option value="0">---<?php //echo Yii::t('app', 'Category');?>---</option>
                                                <?php
                                                  if(!empty($cattour)){
                                                      foreach($cattour as $row){ 
                                                         $opt = Tourcate::createUrl($row);
                                                         if($catid==$row->id){
                                                            echo '<option selected="selected" value="'.$opt.'">'.$row->title.'</option>';
                                                        }else{
                                                            echo '<option value="'.$opt.'">'.$row->title.'</option>'; 
                                                        }
                                                        
                                                      }
                                                  } 
                                                  ?>                                     
                                          </select>
                                         </div>
                                         <div class="uk-width-3-10">                               
                                           Start From
                                              <select name="slcstartfrom" id="slcstartfrom" class="slcfillter">
                                                  <option value="0">---<?php //echo Yii::t('app', 'Start From');?>---</option>
                                                  <?php
                                                  if(!empty($filter)){
                                                      $tmps = array("City","city");
                                                      foreach($filter as $row){                                                         
                                                         $namecity = str_replace($tmps, "",$row->title);
                                                         if($row->id==3) $namecity = $namecity.' Ville';
                                                         if($startfrom==$row->id){
                                                               echo '<option selected="selected" value="'.$row->id.'">'.$namecity.'</option>'; 
                                                            }else{
                                                                echo '<option value="'.$row->id.'">'.$namecity.'</option>'; 
                                                          }
                                                       
                                                      }
                                                  } 
                                                  ?>                                         
                                             </select>
                                         </div>
                                         <div class="uk-width-2-10"> 
                                             <input onclick="FilterCate();" class="btn btnfilter" value="<?php //echo Yii::t('app', 'Filter');?>" />
                                         </div>                                   
                                  </div> 
</form> <br />
