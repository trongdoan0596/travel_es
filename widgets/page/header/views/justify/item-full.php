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
                        $str_sub ='<div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom menusubitem" aria-hidden="true" style="top: 40px; left: 0px;">';
                        $str_sub .='<div class="uk-container-center uk-align-center uk-display-inline "><center>';
                    } 
                    //$str_sub .='<li><a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a></li>'; 
                    $img = Menu::getImage($r);
                    $str_sub .='<div class="itemmenu">     
                                   <dl class="uk-display-inline-block">               
                                      <dd> <a href="'.$url_sub.'" ><img class="uk-border-circle" src="'.$img.'" /></a></dd>
                                      <dd> <a href="'.$url_sub.'" class="titlemenu">'.$r->title.'</a></dd>
                                  </dl>
                              </div>';                                   
                }                 
             }//end foreach($rs as $r)
    
}      
 if($str_sub!=''){
     $str_sub .='</center></div></div>';    
     $clss_drop = 'data-uk-dropdown="{justify:\'#menutop\'}" aria-haspopup="true" aria-expanded="false"';    
 }       
//echo '<li id="menu'.$i.'"  '.$clss_drop.' '.$clss_active.' ><a href="'.$url.'" >'.$row->title.'</a>'.$str_sub.'</li>';
?>
 <li <?php echo $clss_drop;?> >
    <a href="<?php echo $url;?>"><?php echo $row->title;?></a>
    <?php echo $str_sub;?>
</li>