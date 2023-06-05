<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\helper\StringHelper;
use common\models\Blog;
use common\models\Account;
if(!empty($rows)){
    ?>
    <div class="lastblogright">   
        <h2><?php echo Yii::t('app','Últimos comentarios');?></h2>  
        <div class="item-lastblog">
        <ul class="uk-comment-list uk-list uk-list-line">
        <?php
         foreach($rows as $row){      
            $accinfo  = Account::getAccount($row->user_id);   
            $avatar   = Account::getAvatar($accinfo);        
            $infoblog = Blog::getDetailBlog($row->ext_id);
            $url ='#';
            if(!empty($infoblog)){
                $url = $infoblog->createUrl($infoblog);
            }
            $title   = Html::encode(ucwords($row->title));
            $tmp     = StringHelper::Subwords($row->message, 22);
            $message = $tmp;//HtmlPurifier::process($tmp);
            $create_date = StringHelper::showDateMfr($row->create_date,1);           
         ?>
          <li>
              <article class="uk-comment">
                    <a href="<?php echo $url;?>"><img class="uk-border-circle uk-comment-avatar" style="padding-bottom:0px;width:76px;height:76px; " src="<?php echo $avatar;?>" alt="<?php echo $title;?>"/></a>  
                    <h4 class="uk-comment-title" style="padding-top: 14px;"><a href="<?php echo $url;?>"><b><?php echo $title;?></b></a></h4>
                    <span style="color: #4a4a4a;"><?php echo Yii::t('app','on');?> <?php echo $create_date;?></span>
            </article><br />  
            <div class="uk-comment-body" style="padding-left: 10px;"><a href="<?php echo $url;?>"><?php echo ucfirst($message);?></a></div>
          </li>          
      <?php } ?>
        </ul>
     </div>
   </div>   
 <?php     
}
?>