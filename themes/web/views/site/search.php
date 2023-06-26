<?php
use app\widgets\slidebg\slidesub\Slidesub;
?>
<?php echo Slidesub::widget(array('view' =>'index','class_ex'=>'slidesubbg_contact'));?>
<div id="main" class="main-content"> 
      <div class="boxcontactus">     
          <div class="uk-container uk-container-center">              
          <h1><?php echo Yii::t('app','Search');?></h1>          
          <div class="uk-grid">
                <div class="uk-width-2-3">  
                  <div class="infomation">
                     <script>
                      (function() {
                        var cx = '001546397097651177307:z4sxc0rwodi';
                        var gcse = document.createElement('script');
                        gcse.type = 'text/javascript';
                        gcse.async = true;
                        gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(gcse, s);
                      })();
                    </script>
                    <gcse:search></gcse:search>             
                   </div>                
                 
                </div>
                <div class="uk-width-1-3" style="padding-left: 15px;">                     
                    <div class="mapcontact">
                         <div class="uk-width-1-1" style="padding: 15px;">
                            <h2>Authentik Vietnam Co.,Ltd</h2>
                             <ul class="uk-grid contactbox">
                                  <li class="address-footer"><label><i class="uk-icon-home uk-icon-small"></i></label><font style="padding-left:0px;margin-top: -30px;">62 Yen Phu road, Nguyen Trung Truc ward, Ba Dinh district, Ha Noi, Vietnam.</font></li>   
                                  <li><label><i class="uk-icon-phone uk-icon-small"></i></label>+84 (0) 24 39 27 11 99 / <font style="padding-bottom: 10px;">+84 (0) 24 62 90 55 99</font></li> 
                                  <li><label><i class="uk-icon-mobile-phone uk-icon-small"></i></label>+84 (0) 96 9 72 99 83 (Whatsapp/viber) </li>                   
                                  <li><label><a href="skype:sales@authentiktravel.com?call"><i class="uk-icon-skype uk-icon-small"></i></label>sales@authentiktravel.com</a></li>
                                  <li><label><a href="mailto:sales@authentiktravel.com"><i class="uk-icon-envelope-o"></i></label>sales@authentiktravel.com</a></li>
                                  <li><label style="float: left;"><a href="https://authentiktravel.com"><i class="internet"></i></label>www.authentiktravel.com</a></li>                            
                            </ul>                      
                         </div>
                          <div class="uk-width-1-1" style="padding: 15px;">
                          <h2><?php echo Yii::t('app','Office Hours');?>:</h2>
                           <font class="title titleoffice"><?php echo Yii::t('app','Monday to Friday');?>:</font> 8h30 AM to 6 PM <br />
                           <font class="title titleoffice"><?php echo Yii::t('app','Saturday');?>: </font> 8h30 AM to 12 AM
                         </div> 
                         <div class="mapright">
                             <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="348"  height="344" src="https://maps.google.com/maps?hl=vi&q=62 Yen Phu road, Nguyen Trung Truc ward, Ba Dinh district, Ha Noi, Vietnam&ie=UTF8&t=roadmap&z=15&iwloc=B&output=embed"></iframe>
                          </div>
                       </div>
                </div>
            </div>
          </div>
      </div>
</div>