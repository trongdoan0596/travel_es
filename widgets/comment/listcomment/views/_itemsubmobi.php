<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\helper\StringHelper;
use common\models\Account;
    $title   = Html::encode($row->title);
    $message = $row->message;//HtmlPurifier::process($row->message);
    $date    = StringHelper::showDateMfr($row->create_date); 
    $img     = Account::getAvatar($row->account);     
    $name    = $row->account->first_name;   
    if($row->account->last_name!='No') $name .= ' '.$row->account->last_name;
    ?>
 <div class="uk-width-1-5" style="padding-bottom:20px;text-align: center;">
       <div class="circleusavatar">                               
            <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                <figure class="uk-overlay">
                  <a href="#">
                     <img class="uk-border-circle" src="<?php echo $img;?>" alt="<?php echo $name;?>"/>  
                   </a>                        
                </figure>
            </div>
         </div>
          
  </div>
  <div class="uk-width-4-5" style="padding-bottom:20px;">
      <div class="title"><a href="#"><?php echo $name;?></a> - <span class="datetxt"><?php  echo $date;?></span></div>  
      <div class="content"><?php  echo $message;?></div>
   </div>