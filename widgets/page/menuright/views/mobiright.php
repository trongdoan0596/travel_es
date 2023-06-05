<?php
use yii\helpers\Url;
use common\models\Menu;
?>
<div id="offcanvas" class="uk-offcanvas" aria-hidden="true">
		<div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
			<ul class="uk-nav uk-nav-parent-icon" data-uk-nav="">
            <!--<li class="">
					<a href="#offcanvas" data-uk-offcanvas><i class="uk-icon-chevron-left"></i></a>
				</li>
             -->
            <?php
             if(!empty($rows)){
                    $rs = $rows;
                    foreach($rows as $row){
                            $id        = $row->id;
                            $parent_id = $row->parent_id;
                           // $tmp       = $row->tmp;
                            $url = '#';
                            if($row->url !=''){
                                 $url = $row->url;
                            }else{
                                 $url = $row->createUrl($row);
                            } 
                            if($parent_id==1){    
                                ?>
                                  
                                        <?php
                                         $str_sub = '';
                                         foreach($rs as $r){
                                                    $url_sub = '#';
                                                    if($r->url !=''){
                                                         $url_sub = $r->url;
                                                    }else{
                                                         $url_sub = Menu::createUrl($r);
                                                    }
                                                    if($id== $r->parent_id){
                                                         $str_sub .='<li><a href="'.$url_sub.'" class="titlemenu"> - '.$r->title.'</a></li>';                                
                                                    }                
                                          }//end foreach($rs as $r)
                                         ?>
                                         <?php
                                         if($str_sub!=''){
                                            ?>
                                            <li class="uk-parent">
                    					      <a href="#" class="itemparent"><?php echo $row->title;?></a> 
                                             <ul class="uk-nav-sub"><?php echo $str_sub;?></ul>
                                            <?php
                                         }else{
                                            ?>
                                          <li>
                    					    <a href="<?php echo $url;?>" class="itemparent"><?php echo $row->title;?></a> 
                                        <?php
                                         }
                                         ?>
                                         
                    				</li>
                                <?php
                            }                      
                    }               
              }
             ?>    
			</ul>
            <div style="text-align: center;"><br />
               <a href="https://authentiktravel.com"><img src="<?php echo Url::base();?>/themes/web/img/flag/en.png" alt="English" /></a>
               &nbsp;&nbsp;
               <a href="https://authentikvietnam.com" target="_blank"><img src="<?php echo Url::base();?>/themes/web/img/flag/fr.png" alt="Français" /></a>
            </div>
            <div class="boxsocial" style="text-align: left;">
                  <a href="https://www.facebook.com/authentikvietnamtravel" target="_blank"><i class="uk-icon-facebook uk-icon-small"> </i></a>
                  <a href="#" target="_blank" ><i class="uk-icon-twitter uk-icon-small">  </i></a>
                  <a href="#" target="_blank"><i class="uk-icon-google-plus uk-icon-small"> </i></a>
                  <a href="https://www.youtube.com/channel/UCDNFFgvVjrqkiCk7LcUrHGQ" target="_blank"><i class="uk-icon-youtube-play uk-icon-small"></i></a>  
            </div>
            <div style="text-align: left;padding: 10px;">
            <b style="text-transform: uppercase;">Hotline: </b><?php echo Yii::t('app','Hotline-Mobi');?>
            </div>
            <div style="text-align:center;padding:10px;">
                <a href="#offcanvas" data-uk-offcanvas ><i class="uk-icon-close uk-icon-small"></i></a>
            </div>
	 </div>
</div>