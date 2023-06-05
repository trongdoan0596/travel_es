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
                        $str_sub ='<div  class="uk-dropdown" style="top: 40px; left: 0px;">
                                     <div class="uk-grid">
                                       <div class="uk-width-1-4">
                                            <div class="uk-panel">
                                               '.$row->introtxt.'
                                            </div>
                                       </div>
                                       <div class="uk-width-1-4">
                                            <div class="uk-panel">
                                              <a href="#" class="titlemenu">HÀ NỘI</a>
                                              <br />
                                            Lorem ipsum dolor sit amet, Consectetur adipisicing elit
        Eiusmod tempor incididunt ut <br /><br />
        <a href="#" class="titlemenu">HẠ LONG</a>
                                              <br />
                                            Lorem ipsum dolor sit amet, Consectetur adipisicing elit
        Eiusmod tempor incididunt ut <br /><br />
        <a href="#" class="titlemenu">ĐÀ NẴNG</a>
                                              <br />
                                            Lorem ipsum dolor sit amet, Consectetur adipisicing elit
        Eiusmod tempor incididunt ut
                                            </div>
                                       </div>
                                       <div class="uk-width-1-4">
                                            <div class="uk-panel">
                                               <a href="#" class="titlemenu">TÂY NGUYÊN</a>
                                              <br />
                                            Lorem ipsum dolor sit amet, Consectetur adipisicing elit
        Eiusmod tempor incididunt ut <br /><br />
        <a href="#" class="titlemenu">ĐÀ LẠT</a>
                                              <br />
                                            Lorem ipsum dolor sit amet, Consectetur adipisicing elit
        Eiusmod tempor incididunt ut <br /><br />
        <a href="#" class="titlemenu">NINH BÌNH</a>
                                              <br />
                                            Lorem ipsum dolor sit amet, Consectetur adipisicing elit
        Eiusmod tempor incididunt ut
                                            </div>
                                       </div>
                                        <div class="uk-width-1-4">
                                           <ul class="uk-nav uk-nav-navbar">';
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
echo '<li '.$clss_drop.' '.$clss_active.' ><a href="'.$url.'" >'.$row->title.'</a>'.$str_sub.'</li>';     

?>