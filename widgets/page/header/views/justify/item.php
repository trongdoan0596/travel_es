<?php
use yii\helpers\Url;
use common\models\Menu;
$id  = $row->id;
$parent_id = $row->parent_id;
$clss_active= '';$str_sub = '';$clss_drop='';
if($i==0)  $clss_active= 'class="uk-active"'; 
if(count($rs)){
        foreach($rs as $r){
                $url_sub = '#';
                if($r->url !=''){
                     $url_sub = $r->url;
                }else{
                     $url_sub = Menu::createUrl($r);
                }
                if($id== $r->parent_id){
                    //co submenu                   
                    if($str_sub==''){
                        $str_sub ='<div  class="uk-dropdown menusubitem">
                                     <div class="uk-grid">                                        
                                        <div class="uk-width-1-1">
                                           <ul class="uk-nav uk-nav-navbar">
                                           <li>'.$row->introtxt.'</li>';
                    } 
                     $str_sub .='<li><a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a></li>';                                
                }                
             }//end foreach($rs as $r)
    
}      
 if($str_sub!=''){
     $str_sub .='</ul> 
             </div>                                                   
           </div>';
     $clss_active ='';
     $clss_drop = 'data-uk-dropdown="" class="uk-parent" aria-haspopup="true" aria-expanded="false"';
    
 }       
echo '<li id="menu'.$i.'"  '.$clss_drop.' '.$clss_active.' ><a href="'.$url.'" >'.$row->title.'</a>'.$str_sub.'</li>';     

?>