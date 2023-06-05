<?php
use yii\helpers\Html;
use common\models\Destination;
$rows = Destination::getAllDestination();
?>
<div class="contryside">
            <h1 class="title-customizedes-tour"><?php echo Yii::t('app', 'Interesting places');?></h1>
            <div class="uk-grid mapcustomize">
                                    <div class="uk-width-1-2 map">
                                     <!-- begin map-->
                                      <ul class="uk-list">
                                           <li class="dongvan">
                                              <figure class="boxcontent" onclick="Addmapdes('Dong Van','vietnam');">  
                                                  Dong Van
                                              </figure>                          
                                           </li>
                                           <li class="hagiang" >
                                              <figure class="boxcontent" onclick="Addmapdes('Ha Giang','vietnam');">  
                                                  Ha Giang      
                                              </figure>                          
                                           </li>
                                           <li class="uk-grid bachacaobang" >
                                              <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Bac Ha','vietnam');">  
                                                  Bac Ha      
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Cao Bang','vietnam');">  
                                                  Cao Bang      
                                              </figure>                          
                                           </li>
                                           <li class="uk-grid sapababe">
                                               <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Sapa','vietnam');">  
                                                  Sapa      
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Ba Be','vietnam');">  
                                                  Ba Be      
                                              </figure>                        
                                           </li>
                                           <li class="dienbien">
                                              <figure class="uk-align-left boxcontent" onclick="Addmapdes('Dien Bien','vietnam');">  
                                                  Dien Bien      
                                              </figure>                          
                                           </li>
                                            <li class="mucangchai">
                                              <figure class="uk-align-left boxcontent" onclick="Addmapdes('Mu Cang Chai','vietnam');">  
                                                  Mu Cang Chai      
                                              </figure>                          
                                           </li>
                                           <li class="nghialo">
                                              <figure class="uk-align-left boxcontent" onclick="Addmapdes('Nghia Lo','vietnam');">  
                                                  Nghia Lo     
                                              </figure>                          
                                           </li>
                                            <li class="uk-grid hanoihalongsonla">
                                              <figure class="uk-grid-width-1-3 boxcontent" onclick="Addmapdes('Son La','vietnam');">  
                                                  Son La
                                              </figure> 
                                               <figure class="uk-grid-width-1-3 boxcontent1" onclick="Addmapdes('HA NOI','vietnam');">  
                                                  <strong>HA NOI</strong> 
                                              </figure> 
                                              <figure class="uk-grid-width-1-3 boxcontent2" onclick="Addmapdes('Ha Long','vietnam');">  
                                                  Ha Long
                                              </figure>                        
                                           </li>
                                           <li class="uk-grid maichaucatba">
                                               <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Mai Chau','vietnam');">  
                                                  <strong>Mai Chau</strong> 
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Cat Ba','vietnam');">  
                                                  Cat Ba
                                              </figure>                        
                                           </li>
                                            <li class="uk-grid puluongninhbinh">
                                              <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Puluong','vietnam');">  
                                                    Puluong 
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Ninh Binh','vietnam');">  
                                                     Ninh Binh   
                                              </figure>                      
                                           </li>
                                           <li class="luangprabang">
                                              <figure class="boxcontent" onclick="Addmapdes('Luang Prabang','laos');">  
                                                  Luang Prabang      
                                              </figure>                          
                                           </li>
                                           <li class="uk-grid laophonxavan">
                                              <figure class="uk-grid-width-1-2 boxcontent">  
                                                  LAOS
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Phonsavan','laos');">  
                                                  Phonsavan
                                              </figure>                                                                        
                                           </li>                                           
                                            <li class="uk-grid vangviengvinh">
                                               <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Vang Vieng','laos');">  
                                                  Vang Vieng
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Vinh','vietnam');">  
                                                  Vinh
                                              </figure>                        
                                           </li>
                                           
                                           <li class="vientaine">
                                              <figure class="boxcontent" onclick="Addmapdes('Vientaine','laos');">  
                                                 Vientaine
                                              </figure>                          
                                           </li>                                           
                                           <li class="hue">
                                              <figure class="boxcontent" onclick="Addmapdes('Hue','vietnam');">  
                                                  Hue     
                                              </figure>                          
                                           </li>
                                           <li class="hoian">
                                              <figure class="boxcontent" onclick="Addmapdes('Hoi An','vietnam');">  
                                                  Hoi An     
                                              </figure>                          
                                           </li>
                                           <li class="myson">
                                              <figure class="boxcontent" onclick="Addmapdes('My Son','vietnam');">  
                                                  My Son     
                                              </figure>                          
                                           </li>
                                           <li class="pakse">
                                              <figure class="boxcontent" onclick="Addmapdes('Pakse','laos');">  
                                                  Pakse     
                                              </figure>                          
                                           </li>
                                             <li class="uk-grid champassakkontum">
                                               <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Champassak','laos');">  
                                                  Champassak
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Kon Tum','vietnam');">  
                                                 Kon Tum
                                              </figure>                        
                                           </li>
                                           <li class="uk-grid siemreapbuonmathuot">
                                               <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Siem Reap','cambodia');">  
                                                  Siem Reap
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Buon Ma Thuot','vietnam');">  
                                                  Buon Ma Thuot
                                              </figure>                        
                                           </li>
                                          <li class="uk-grid battambangnhatrang">
                                               <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Battambang','cambodia');">  
                                                  Battambang
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Nha Trang','vietnam');">  
                                                  Nha Trang  
                                              </figure>                        
                                           </li>                                          
                                           <li class="uk-grid cambodiadalat">
                                               <figure class="uk-grid-width-1-2 boxcontent">  
                                                  CAMBODIA 
                                              </figure> 
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Da Lat','vietnam');">  
                                                  Da Lat
                                              </figure>                        
                                           </li>                                           
                                         <li class="uk-grid pnompenhmuine">
                                              <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('P.nompenh','cambodia');">  
                                                    P.nompenh 
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Mui ne','vietnam');">  
                                                     Mui ne   
                                              </figure>                      
                                           </li>
                                           <li class="uk-grid chaudochochiminh">
                                              <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Chau Doc','vietnam');">  
                                                   Chau Doc
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Ho Chi Minh','vietnam');">  
                                                    Ho Chi Minh
                                              </figure>                      
                                           </li>
                                           <li class="longxuyen">
                                              <figure class="boxcontent" onclick="Addmapdes('Long Xuyen','vietnam');">  
                                                  Long Xuyen     
                                              </figure>                          
                                           </li>
                                            <li class="uk-grid phuquocbentre">
                                              <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Phu Quoc','vietnam');">  
                                                   Phu Quoc
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Ben Tre','vietnam');">  
                                                   Ben Tre
                                              </figure>                      
                                           </li>
                                            <li class="uk-grid canthovinhlong">
                                              <figure class="uk-grid-width-1-2 boxcontent" onclick="Addmapdes('Can Tho','vietnam');">  
                                                   Can Tho
                                              </figure>     
                                              <figure class="uk-grid-width-1-2 boxcontent1" onclick="Addmapdes('Vinh Long','vietnam');">  
                                                    Vinh Long
                                              </figure>                      
                                           </li>
                                       </ul>
                                       <!-- End map-->
                                    </div>
                                    <div class="uk-width-1-2 content">
                                        <div class="boxcustomizedes">       
                                            <div style="text-align: left !important;padding-bottom: 10px; "><?php echo Yii::t('app','Choose the destinations on the map');?></div>                                     
                                             <h2>Vietnam</h2>
                                              <div class="item-northern">
                                               <ul id="vietnammap" style="min-height: 50px;"></ul>
                                               <input type="hidden" name="vietnamid" id="vietnamid" value="-1" />
                                               <input type="hidden" id="customizeform-vietnammap" name="CustomizeForm[vietnammap]" value="" />
                                              </div> 
                                               <h2>Laos</h2>
                                              <div class="item-northern" id="northern">
                                              <ul id="laosmap" style="min-height: 50px;"></ul>
                                               <input type="hidden" name="laosid" id="laosid" value="-1" />
                                               <input type="hidden" id="customizeform-laosmap" name="CustomizeForm[laosmap]" value="" />
                                             </div>
                                              <h2>Cambodia</h2>
                                              <div class="item-northern" id="southern">
                                               <ul id="cambodiamap" style="min-height: 50px;"></ul>
                                               <input type="hidden" name="cambodiaid" id="cambodiaid" value="-1" />
                                               <input type="hidden" id="customizeform-cambodiamap" name="CustomizeForm[cambodiamap]" value="" />
                                              </div>                                             
                                              <h2><?php echo Yii::t('app','Other Destinations');?></h2>
                                              <div class="item-northern">
                                               <ul id="otherdes"></ul>
                                               <input type="hidden" name="otherid" id="otherid" value="-1" />
                                               <input type="hidden" id="customizeform-mapother" name="CustomizeForm[mapother]" value="" />
                                              </div>                               
                                        </div>    
                                        <div class="customizedes">
                                                   <h3><?php echo Yii::t('app','Other Destinations');?></h3>
                                                   <span><?php echo Yii::t('app','Type the destinations you would like to visit');?></span>
                                                   <div class="uk-form-icon iconadd">                                                       
                                                        <input type="text" id="addtxtdes" name="addtxtdes" />
                                                        <div class="bgiconadd" onclick="javascrip:Addmapdes($('#addtxtdes').val(),'other');">                                                         
                                                         <?php echo Yii::t('app','Add');?>
                                                        </div>                                                  
                                                    </div>
                                         </div>                           
     </div>                         </div>             
</div>
<script language="javascript">
$("#addtxtdes").keypress(function(ev) {
    var keycode = (ev.keyCode ? ev.keyCode : ev.which);
    if (keycode == '13') {
          var txtdes = $('#addtxtdes').val(); 
          Addmapdes(txtdes,'other');
    }
});
</script>

