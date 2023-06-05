<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\helper\StringHelper;
use common\models\Account;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\CommentForm;
$modelfrm = new CommentForm();
$request = Yii::$app->request;
if(!empty($rows)){
      ?>
      <div class="uk-grid boxlistcomment">
      <?php
      foreach($rows as $row){
            $id_ext  = $row->id;
            $ext_    = $ext_id.'_'.$id_ext;
            $title   = Html::encode($row->title);
            $message = HtmlPurifier::process($row->message);
            $date    = StringHelper::showDateMfr($row->create_date); 
            $img     = Account::getAvatar($row->account);     
            $name    = $row->account->first_name;   
            if($row->account->last_name!='No') $name .= ' '.$row->account->last_name;
            if($row->comment_id ==0){         
               $totalcomment = $row->GetTotalComment('blog',$row->id);
               $rs = $row->GetSubComment($row->type,$row->id,'id desc',$table.'.title,'.$table.'.message,'.$table.'.comment_id,'.$table.'.user_id,'.$table.'.create_date');
             
             ?>
              <div class="uk-width-1-5" style="padding-bottom: 30px;text-align: center;">
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
              <div class="uk-width-4-5" style="padding-bottom: 30px;">
                  <div class="title"><a href="#"><?php echo $name;?></a> - <span class="datetxt"><?php  echo $date;?></span> </div>                  
                  <div class="content"><?php  echo $message;?></div>
                 <div class="boxreply">
                     <span class="reply" onclick="GetfrmComment(<?php echo $ext_id;?>,<?php echo $id_ext;?>,'blog');"><?php echo Yii::t('app','Responder');?></span>
                     <span><?php echo Yii::t('app','Mostrar todos los comentarios({numbercomment})', array('numbercomment' =>$totalcomment));?></span>
                  </div>
                  <div class="boxreplysubmit" id="boxreplysubmit<?php echo $ext_;?>" style="display: none;">
                  <input type="hidden" value="0" id="hiddenchk<?php echo $ext_;?>" />
                  <div class="uk-grid">
                  <?php
                  $form = ActiveForm::begin(
                              array(
                                'id' => 'commentitemfrm'.$ext_,
                                'action' =>Url::toRoute(array('comment/savecm')),
                                'method'=>'post',                               
                                'enableClientValidation'=>true,
                                'validateOnSubmit' => true,                             
                                'options' =>array(
                                        'class' => 'uk-form'
                                 )
                               )
                         ); 
                         ?>     
                        <div id="errorcomment<?php echo $ext_;?>" class="uk-alert" style="display: none;"></div>                    
                        <div class="uk-width-1-1">
                                <div class="uk-form-row">
                                  <?php echo $form->field($modelfrm,'message')->textarea(array('style' =>'width: 100%;','rows' =>4,'placeholder'=>Yii::t('app','Escribir tu mensaje aquí').' ... '))->label(false);?>
                                </div>
                        </div>
                        <div class="uk-width-1-1" style="margin-top: 6px;">
                                    <div class="uk-form-row">
                                      <?php echo $form->field($modelfrm,'fullname')->textInput(array('class' =>'form-control','placeholder'=>Yii::t('app','Nombre completo')))->label(false);?>
                                    </div>
                            </div>
                            <div class="uk-width-1-1" style="margin-top:6px;">
                                    <div class="uk-form-row">
                                      <?php echo $form->field($modelfrm,'youremail')->textInput(array('class' =>'form-control','placeholder'=>Yii::t('app','Tu email')))->label(false);?>
                                    </div>
                            </div>
                            <div class="uk-width-1-1" style="margin-top:6px;">
                                     <div class="uk-form-row">
                                     <div style="width: 100%; text-align: left;overflow: auto;"><strong>Code anti-spam</strong> <?php echo Yii::t('app','Debes escribir los caracteres de la imagen en el cuadro de texto');?></div><br />
                                        <?php echo $form->field($modelfrm,'verifyCode')->widget(Captcha::className(),array('imageOptions'=>array('alt'=>'Captcha'),'template' =>'<div class="captchacode"><div class="col-code">{input}</div><div class="col-img">{image}</div></div>'))->label(false); ?>
                                     </div>
                            </div>
                            <div class="uk-width-1-1" style="text-align: left;" >
                            <?php 
                            echo Html::Button('<i class="uk-icon-edit"></i> '.Yii::t('app','Responder'),array('onclick' =>'ReplySubmit('.$ext_id.','.$id_ext.');','class' =>'btn btn-warning btnsubcomment','name' =>'sendcommentreply'.$ext_,'id' =>'sendcommentreply'.$ext_));
                            ?>                             
                            </div>
                              <?php
                              $modelfrm->ext_id = $ext_id;
                              $modelfrm->type   = 'blog';
                              $modelfrm->comment_id = $id_ext;
                              $modelfrm->url    = substr($request->url, 1);
                              echo $form->field($modelfrm,'type')->hiddenInput()->label(false);
                              echo $form->field($modelfrm,'ext_id')->hiddenInput()->label(false);
                              echo $form->field($modelfrm,'url')->hiddenInput()->label(false);
                              echo $form->field($modelfrm,'comment_id')->hiddenInput()->label(false);                      
                             ?>
                        <?php
                        ActiveForm::end(); 
                  ?>
                   </div>
                  </div>
                  <!--list reply-->
                  
                  <?php
                  if(!empty($rs)){
                   ?> 
                   <div class="uk-grid boxlistsubcomment">
                   <?php
                        foreach($rs as $r){
                            $id_  = $r->id;
                            echo $this->render('_itemsubmobi',array('row'=>$r));  
                        }
                        ?>
                         </div>
                   <?php
                  }
                  ?>
                  
              </div>
      <?php
            }
      }       
      ?>
     </div>
     <script >
function GetfrmComment(extid,commentid,type){    
   var extid  = extid+'_'+commentid;   
   var chk = $("#hiddenchk"+extid).val();   
   if(chk==0){
       $("#hiddenchk"+extid).val(1);
       $("#boxreplysubmit"+extid).show(); 
   }else{
       $("#hiddenchk"+extid).val(0);
       $("#boxreplysubmit"+extid).hide();
   }
}
function ReplySubmit(extid,commentid){
     var idext  = extid+'_'+commentid;  
     var form = $("#commentitemfrm"+idext);
        if(form.find('.has-error').length) {
             $("#hiddenchk"+idext).val(1);
             $("#boxreplysubmit"+idext).show(); 
              return false;
        }
       $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(data) {  
               if(data['error']==0){
                    //error                  
                     var rows = JSON.parse(JSON.stringify(data['data']));
                     var str ='';
                     for (var i in rows){                        
                       str +='<br />'+rows[i];
                     }                         
                     $("#errorcomment"+idext).addClass("uk-alert-danger");     
                     $("#errorcomment"+idext).html(str).show();                     
                 }else{
                     $("#commentform-message"+extid).val("");
                     $("#commentform-fullname"+extid).val("");
                     $("#commentform-youremail"+extid).val("");
                     $("#commentform-verifycode"+extid).val("");
                     $("#errorcomment"+idext).removeClass("uk-alert-danger");
                     $("#errorcomment"+idext).addClass("uk-alert-success");     
                     $("#errorcomment"+idext).html(data['msg']).show();
                 }
                 $("#boxreplysubmit"+idext).hide();
            }
    });
}
</script>
<?php
}
?>