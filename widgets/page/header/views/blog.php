<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\Menu;
use common\models\AccountForm;
use common\models\AccountFormLogin;
?>
<header id="header">
<div  class="bgleft">
  <div  class="bgright">
  <div class="uk-container uk-container-center">
   <div class="uk-display-inline-block headicon">
            <div class="uk-grid">
                <div class="uk-width-3-5">
                     <ul class="uk-grid">
                      <li><b>Hotline:</b> <?php echo Yii::t('app','Hotline');?> (<?php echo Yii::t('app','Whatsapp/viber');?>)</li>
                    </ul>  
                </div>
                <div class="uk-width-2-5">
                    <ul class="uk-grid uk-float-right">
                        <li style="float: right;"><a target="_blank" href="https://authentiktravel.com"><img src="<?php echo Url::base();?>/themes/web/img/flag/en.png" alt="English" /> English</a></li>
                        <li style="float: right;padding-left:12px;"><a target="_blank" href="https://authentikvietnam.com"><img src="<?php echo Url::base();?>/themes/web/img/flag/fr.png" alt="Français" /> Français</a></li>             
                    </ul>
                </div>
        </div> 
      </div>  
  </div>
  <div class="uk-container uk-container-center">
          <div class="uk-float-left logo">
                 <a href="<?php echo Yii::$app->homeUrl;?>">
                    <img src="<?php echo Yii::$app->homeUrl;?>themes/web/img/authentiktravel.png" alt="Authentik Travel" />
                </a>
          </div>                
          <div class="boxmenu">          
               <nav class="uk-navbar" id="menutop">
                    <ul class="uk-navbar-nav">  
                        <?php
                           if(!empty($rows)){
                               $rs = $rows;
                               $i=0;
                               foreach($rows as $row){                                   
                                    $parent_id = $row->parent_id;
                                    $tmp       = $row->tmp;
                                    $url = '#';
                                    if($row->url !=''){
                                         $url = $row->url;
                                    }else{
                                         $url = Menu::createUrl($row);
                                    } 
                                    if($parent_id==1){                                                                      
                                         switch ($tmp) {
                                               case "info": 
                                                     echo $this->render('justify/info',array('row'=>$row,'rs'=>$rs,'i'=>$i,'url'=>$url));                                                           
                                                    break;   
                                               case "info4colum":                                               
                                                     echo $this->render('justify/info4-colum',array('row'=>$row,'rs'=>$rs,'i'=>$i,'url'=>$url));                                                           
                                                    break;        
                                               default:
                                                     echo $this->render('justify/item',array('row'=>$row,'rs'=>$rs,'i'=>$i,'url'=>$url));  
                                                   break;          
                                          }
                                       
                                       $i++;
                                    }//end if($parent_id==1)
                               }
                            }
                          ?> 
                    </ul>
           </nav>
       </div>
      </div>
    </div>
  </div>
</header>