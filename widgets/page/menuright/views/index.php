<?php
use yii\helpers\Url;
use common\models\Menu;
$countryid = Yii::$app->request->cookies->getValue('countryid');
 if(!empty($rows)){
                         $rs = $rows;
                         $i=0;
                         ?>
                           <div class="uk-width-medium">
                                <div class="uk-panel">
                                <?php
                         $countryid =  Yii::$app->request->cookies->getValue('countryid');
                         if(empty($countryid)) $countryid = 232;
                          foreach($rows as $row){
                                    $id        = $row->id;
                                    $parent_id = $row->parent_id;
                                    $title     = $row->title;
                                    $url = '#';
                                    if($row->url !=''){
                                         $url = $row->url;
                                    }else{
                                         $url = Menu::createUrl($row);
                                    }                            
                                    $country_ids = explode(",", $row->country_ids);
                                    if($parent_id==1 && in_array ($countryid,$country_ids)){
                                        ?>
                                           <h3 class="uk-panel-title"><?php echo $title;?></h3>
                                                <ul class="uk-list">
                                                <?php
                                                 foreach($rs as $r){
                                                        $url_sub = '#';
                                                        if($r->url !=''){
                                                             $url_sub = $r->url;
                                                        }else{
                                                             $url_sub = Menu::createUrl($r);
                                                        }
                                                       
                                                        $country_ids = explode(",", $r->country_ids);
                                                        if($id== $r->parent_id && in_array ($countryid,$country_ids) ){
                                                          ?>
                                                            <li><a href="<?php echo $url_sub;?>"><?php echo $r->title;?></a></li>
                                                        <?php
                                                        }
                                                        
                                                     }//end foreach($rs as $r)
                                                     ?>
                                                </ul>
                                          
                                        <?php
                                    }
                          }//end foreach($rows as $row)
         
                    ?>
                      </div>
                                        </div>
                    <?php
                    }
                    ?>
