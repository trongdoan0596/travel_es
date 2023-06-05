 <?php
use yii\helpers\Url;
use common\models\Menu;
use common\models\Blogcate;
$id  = $row->id;
$parent_id = $row->parent_id;
$clss_active= '';
$str_sub = '';
$clss_drop='';
//if($i==0)  $clss_active= 'class="uk-active"'; 
if(count($rs)){
        $rwstmp = $rs;
        $str_sub ='<div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom menusub" aria-hidden="true" style="top: 40px; left: 0px;">';
        $str_sub .='<div class="uk-grid">';
        
        $strlao_cam='';
        $strsub_auvietnam='';
                          
        foreach($rs as $r){
                $idsub = $r->id;
                $ordering = $r->ordering;
                $url_sub = '#';
                if($r->url !=''){
                     $url_sub = $r->url;
                }else{
                     $url_sub = Menu::createUrl($r);
                }                    
                if($id== $r->parent_id){
                    //co submenu    
                    // $str_sub .='<li><a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a></li>'; 
                    if($idsub==93){//Nord du Vietnam 93
                         //parent category = 12
                         $blogcat_id = 12;
                         $str_sub  .='<div class="uk-width-1-4">
                            <div class="uk-panel">
                              <a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a>
                              <br />';
                              $blrs = Blogcate::getAllBlogcate($blogcat_id,'ordering asc');         
                              foreach($blrs as $blr){                        
                                    $urlcate   = $blr->createUrl($blr);                                 
                                    $str_sub .='<label ><a href="'.$urlcate.'" >'.$blr->title.'</a></label> <br />';
                              }                                                  
                          $str_sub .='</div></div>';            
                    }elseif($idsub==94){//Centre du Vietnam 94
                           $str_sub  .='<div class="uk-width-1-4">
                            <div class="uk-panel">
                              <a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a>
                              <br />';
                              $blogcat_id = 13;
                              $blrs = Blogcate::getAllBlogcate($blogcat_id,'ordering asc');         
                              foreach($blrs as $blr){                        
                                    $urlcate   = $blr->createUrl($blr);                                 
                                    $str_sub .='<label ><a href="'.$urlcate.'" >'.$blr->title.'</a></label> <br />';
                              }      
                       
                          $str_sub .='</div></div>';  
                    }elseif($idsub==95 || $idsub==96){//Sud du Vietnam 90,Séjour balnéaire au Vietnam 91
                          $strsub_auvietnam .='<div class="uk-panel">
                              <a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a>
                              <br />';
                          $blogcat_id = 14;
                          if($idsub==96){
                             $blogcat_id = 15;
                          } 
                          $blrs = Blogcate::getAllBlogcate($blogcat_id,'ordering asc');         
                          foreach($blrs as $blr){                        
                                $urlcate   = $blr->createUrl($blr);                                 
                                $strsub_auvietnam .='<label ><a href="'.$urlcate.'" >'.$blr->title.'</a></label> <br />';
                          }     
                          $strsub_auvietnam .='</div>';      
                    }else{
                         $strlao_cam .='<a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a>';
                    }
                    
                     /* foreach($rwstmp as $rtmp){
                         if($idsub == $rtmp->parent_id){
                            $url_sub_1 = '#';
                            if($rtmp->url !=''){
                                 $url_sub_1 = $rtmp->url;
                            }else{
                                 $url_sub_1 = Menu::createUrl($rtmp);
                            }
                            $str_sub .='<label ><a href="'.$url_sub_1.'" >'.$rtmp->title.'</a></label> <br />';
                         }
                      }
                      */
                      //$str_sub1 .='<a href="#">Escapade du Vietnam</a> <br /><a href="#">Escapade du Vietnam</a> <br />';
                    
                }                
             }//end foreach($rs as $r)
             
     $str_sub  .='<div class="uk-width-1-4">'.$strsub_auvietnam.'</div>'; 
     $str_sub  .='<div class="uk-width-1-4"><div class="uk-panel">'.$strlao_cam.'</div></div>';               
    
}      
 if($str_sub!=''){
     $str_sub .='</div></div>';
     $clss_drop = 'data-uk-dropdown="{justify:\'#menutop\'}" aria-haspopup="true" aria-expanded="false"';
    
 }       
//echo '<li id="menu'.$i.'"  '.$clss_drop.' '.$clss_active.' ><a href="'.$url.'" >'.$row->title.'</a>'.$str_sub.'</li>';     

?>
 <li <?php echo $clss_drop;?> >
    <a href="<?php echo $url;?>"><?php echo $row->title;?></a>
    <?php echo $str_sub;?>
</li>