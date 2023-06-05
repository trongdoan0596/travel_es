 <?php
use yii\helpers\Url;
use common\models\Menu;
$id  = $row->id;
$parent_id = $row->parent_id;
$clss_active= '';
$str_sub = '';
$clss_drop='';
//if($i==0)  $clss_active= 'class="uk-active"'; 
if(count($rs)){
        $rwstmp = $rs;
        foreach($rs as $r){
                $idsub = $r->id;
                $url_sub = '#';
                if($r->url !=''){
                     $url_sub = $r->url;
                }else{
                     $url_sub = Menu::createUrl($r);
                }
                if($id== $r->parent_id){
                    //co submenu                   
                    if($str_sub==''){
                         preg_match_all('/<img[^>]+>/i',$row->introtxt, $result); 
                         $imghtml='';$content = $row->introtxt;
                         if(!empty($result)){
                            $imghtml =$result[0][0];
                            $content = str_replace($imghtml, "",$row->introtxt);
                            $content = str_replace("<p></p>", "",$content);
                         }
                        
                        $str_sub ='<div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom menusub" aria-hidden="true" style="top: 40px; left: 0px;">';
                        $str_sub .='<div class="uk-grid">
                                     <div class="uk-width-1-3"><div class="uk-panel menuimg">'.$imghtml.'</div></div>';
                         if($imghtml!=''){
                            $str_sub .='<div class="uk-width-1-3"><div class="uk-panel menucontent">'.$content.'</div></div>';
                         }           
                                    
                       $str_sub .='<div class="uk-width-1-3"><div class="uk-grid">';
                      
                                 
                    } 
                    // $str_sub .='<li><a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a></li>';  
                     $str_sub  .='<div class="uk-width-1-1">
                                            <div class="uk-panel">
                                              <a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a>
                                              <br />';
                    /*  foreach($rwstmp as $rtmp){
                         if($idsub == $rtmp->parent_id){
                            $url_sub_1 = '#';
                            if($rtmp->url !=''){
                                 $url_sub_1 = $rtmp->url;
                            }else{
                                 $url_sub_1 = Menu::createUrl($rtmp);
                            }
                            $str_sub .='<label ><a href="'.$url_sub_1.'" >'.$rtmp->title.'</a></label> <br />';
                         }
                      }*/
                      //$str_sub1 .='<a href="#">Escapade du Vietnam</a> <br /><a href="#">Escapade du Vietnam</a> <br />';
                      $str_sub .='</div></div>'; 
                }                
             }//end foreach($rs as $r)
    
}      
 if($str_sub!=''){
     $str_sub .='</div></div></div></div>'; 
        
     $clss_drop = 'data-uk-dropdown="{justify:\'#menutop\'}" aria-haspopup="true" aria-expanded="false"';
    
 }       
//echo '<li id="menu'.$i.'"  '.$clss_drop.' '.$clss_active.' ><a href="'.$url.'" >'.$row->title.'</a>'.$str_sub.'</li>';     

?>
 <li <?php echo $clss_drop;?> >
    <a href="<?php echo $url;?>"><?php echo $row->title;?></a>
    <?php echo $str_sub;?>
</li>