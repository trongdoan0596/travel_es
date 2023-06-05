<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\helper\StringHelper;
use yii\helpers\Url;
use common\models\Article;
$urlindex ='#';
if(!empty($rows)){
       $info = Article::getDetailArticle(199);
       $introtxt= Yii::t('app','Nuestra colección de videos realizados por nuestro equipo de campo sobre actividades auténticas durante las misiones de reconocimiento.');
       $title= Yii::t('app','Útimo vídeo');
       if(!empty($info)){
          $introtxt = $info->introtxt;// HtmlPurifier::process($info->introtxt);
          $title    = Html::encode($info->title);
       }
?>
<div class="boxtraveller boxvideo">   
   <div class="uk-container uk-container-center"> 
            <h5 class="uk-h1 uk-text-center"><a target="_blank" href="https://www.youtube.com/user/authentikvietnam"><?php echo  $title;?></a></h5>  
            <div class="uk-text-center txthome" style="padding-left:110px;padding-right: 110px;">
           <?php echo  $introtxt;?>            
            </div>
            <?php                   
                  $img1='';$item='';$i=0;  
                  foreach($rows as $row){ 
                      $url = $row->url;
                      $id  = $row->id;
                      $title     = $row->title;//StringHelper::Subwords(Html::encode($row->title),9);
                      //$img       = $row->getImage($row,340,214);
                      if($i==0){
                        $img  = $row->getImage($row);
                        $img1 = '<i class="playfixnew" onclick="OpenVideo(\''.$url.'\');"></i><img style="height: 420px;width: 750px;cursor: pointer;" onclick="OpenVideo(\''.$url.'\');" src="'.$img.'" alt="'.Html::encode($title).'" />';
                      }else{
                        $margintop='0px';
                        if($i>1) $margintop ='20px';
                        $img  = $row->getImage($row,340,214);
                        $item .= '<div class="uk-grid" style="margin-top:'.$margintop.' !important;"><div class="uk-width-1-2" style="padding-left: 20px !important;"><i class="playfixright" onclick="OpenVideo(\''.$url.'\');"></i><img style="height:90px;width:160px;cursor: pointer;" onclick="OpenVideo(\''.$url.'\');" src="'.$img.'" alt="'.Html::encode($title).'" /></div>';
                        $item .= '<div class="uk-width-1-2" style="padding-left:18px !important;">'.Html::encode($title).'</div></div>';
                      }
                      
                       $i++;
                  }
                 ?>  
             <div class="uk-grid" >
                <div class="uk-width-4-6"><?php echo $img1;?></div>
                <div class="uk-width-2-6">                  
                    <?php echo $item;?> 
                </div>
            </div>     
            <div class="uk-grid" >
                <div class="uk-width-4-6">&nbsp</div>
                <div class="uk-width-2-6 viewall" style="text-align:left !important;"><a target="_blank" href="https://www.youtube.com/user/authentikvietnam"><?php echo  Yii::t('app','Ver todos vídeos');?></a></div>
           </div>                    
    </div>   
</div>
 <!-- This is the modal -->
<div id="playvideoid" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-large" style="width:790px;">
        <div class="uk-overflow-container">
            <iframe width="750" height="500" id="urlvideo" src="" frameborder="0" allowfullscreen></iframe>
       </div>
    </div>
</div>   
<script>
function OpenVideo(str){
    var urlplay = str+'?autoplay=1';
    $("#urlvideo").attr("src",urlplay);
    $.UIkit.modal('#playvideoid').show(); 
}
</script>  
<?php    
}
?>