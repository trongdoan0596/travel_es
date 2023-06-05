<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;
if($model->id>0){
?>
<div id="msg" style="color: red;"></div>
<div>
 <table width="100%" class="table table-bordered" id="contenthtml">
    <thead>
      <tr>
          <td width="20%" style="white-space: nowrap;">Day</td>
          <td>Title</td>
          <td width="8%" style="white-space: nowrap;"></td>
       </tr>
     </thead>
       <tbody>
    <?php
      if(!empty($tourdetail)){
        $i=0;
          foreach ($tourdetail as $detail) {
             $tour_id = $detail->tour_id;
             $day_id  = $detail->day_id;
            // print_r($detail);die();
             $id  = $detail->id;
             if($i%2==0) $cls="odd";
              else $cls="even";
             //$status   = $detail->getStatus($detail->status);
        ?>
         <tr class="<?php echo $cls;?>" id="day_<?php echo $id;?>">
          <td style="white-space: nowrap;"><?php echo $detail->days->title;?></td>
          <td><?php echo $detail->title;?></td>
          <td style="white-space: nowrap;">          
               <span class="glyphicon glyphicon-pencil" onclick="Editday(<?php echo $tour_id;?>,<?php echo $day_id;?>);" style="cursor: pointer;"></span> &nbsp;&nbsp;
               <span class="glyphicon glyphicon-trash" onclick="Dele(<?php echo $tour_id;?>,<?php echo $day_id;?>,<?php echo $id;?>);" style="cursor: pointer;"></span>
               
            </td>
       </tr>
         
        <?php
        $i++;
         }//end foreach ($tourdetail as $detail) 
      }
    ?>
     </tbody>
  </table>
</div>
<hr />
<b>Add news Day : </b>
<div class="uk-grid">
    <div class="uk-width-1-3">
         <div class="control-group">
            <div class="controls">
                <?php
                  echo $form->field($model,'day_id')->dropDownList(ArrayHelper::map($days, 'id','title'),array('prompt'=>'-- Select Day --'));
                ?>
            </div>
         </div>
    </div>
     <div class="uk-width-1-3">
        <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'day_title')->textInput(array('class' =>'form-control'));?>
                </div>
        </div>
    </div>
     <div class="uk-width-1-3">
        <div class="control-group">
                <div class="controls">
                   <div class="uk-grid">                            
                            <div class="uk-width-1-3">
                              <img src="" style="display: none;" id="imgold" height="120" width="120" />
                              <br />  
                               <input type="hidden" id="imgroom" name="imgroom" value="" />
                               <span id="delimgold" style="display: none;padding-top: 10px; padding-left:50px;"  class="glyphicon glyphicon-trash" onclick="DelImg(<?php echo $model->id;?>);" style="cursor: pointer;"></span>
                            </div>
                            <div class="uk-width-2-3">
                                 <input type="button" id="openitemimg"  class="btn btn-primary buttongreen" value="Add image" /> 
                            </div>
                    </div>                                      
                </div>
        </div>
    </div>
</div>    
 <div class="control-group">
        <div class="controls">   
          <?php  echo $form->field($model,'day_fulltxt')->widget(CKEditor::className(),array( 
                       'options' => array('rows' =>6),
                       'preset' => 'base', //advanced basic standard full
                       'clientOptions' => array(
                            'filebrowserUploadUrl' =>'../site/uploadimg',
                            'extraPlugins' => 'justify,iframe,flash'
                        )
                     ));
              ?>
        </div>
</div>   
   <div class="control-group" style="text-align: center;">
   <input type="hidden" id="tour-day_tourdetai_id" name="Tour[tourdetai_id]" value="0" />
   <input type="button" class="btn btn-primary" onclick="Addday(<?php echo $model->id;?>);" name="addday" id="addday" value="Add Day" />
 </div>    
 <!--Modal -->
<div class="uk-modal" id="modalimg" aria-hidden="true" style="display: none; overflow-y: scroll;">
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <button class="uk-modal-close uk-close" type="button"></button>
            <div class="uk-modal-header">
                <h2>Select images</h2>
                Title : <input type="text" value="" id="titleitemimg" name="titleitemimg" />                
            </div>
            <div class="uk-grid uk-overflow-container itemimg" id="itemthumb"></div>
        </div>
</div>
 <script>
 var path_itemimgs= 'https://authentiktravel.es/media/itemimgs/';
// var path_itemimgs= 'http://localhost/authentiktravel.com/media/itemimgs/';
 //var path_itemimgs= '../../';
 //add day in tour
function Addday(tour_id){
     var Url        = "<?php echo Url::to(array('tour/addnewday'));?>";
      var day_id    = $("#tour-day_id").val();
      var title_day = $("#tour-day_title").val();     
      var txt_day = CKEDITOR.instances['tour-day_fulltxt'].getData();
      var tourdetai_id  = $("#tour-day_tourdetai_id").val();
      if(day_id==''){
          alert('You must select Day!');
          return false;
      }
      if(title_day==''){
          alert('You must enter title !');
          return false;
      }      
      var formData = new FormData();
      var imgroom  = $("#imgroom").val();// document.getElementById('imgroom').files[0];       
          formData.append("tourdetai_id",tourdetai_id);
          formData.append("tour_id",tour_id);
          formData.append("day_id",day_id);
          formData.append("titleday",title_day);
          formData.append("txtday",txt_day);
          formData.append("imgroom",imgroom);        
      $.ajax({
			type: "POST",
			url: Url,
            processData: false,
            contentType: false,
            data:formData,		
			dataType: "json"			
			}).done(function( data ) {               
                    $("#tour-day_id").val('');
                    $("#tour-day_title").val('');
                    $("#imgroom").val('');
                    $("#imgold").hide();    
                    CKEDITOR.instances["tour-day_fulltxt"].setData("");
                    if(data['data'] !=''){
                        if(data['msg']=='Update successful!'){
                            $("#day_"+tourdetai_id).html(data['data']);
                            $("#addday").val('Add Day');
                        }else{
                          $("#contenthtml").append(data['data']);
                        }
                        
                    }
                    if(data['msg'] !=''){
                        $("#msg").html(data['msg']);
                    }              
				
	        });
    
}
function Dele(tour_id,day_id,id){
     if(tour_id<=0 || day_id<=0){
          alert('You enter Tour ID or Day ID !');
          return false;          
      }
      var r = confirm("Do you really want to delete that record ?");
      if (r == true) {              
               var Url = "<?php echo Url::to(array('tour/delenewday'));?>";
               $.ajax({
            			type: "POST",
            			url: Url,
            			data: ({"tour_id":tour_id,"day_id":day_id}),
            			dataType: "html"			
            			}).done(function( data ) {	
                            if(data!=''){
                                $("#day_"+id).hide();                               
                            }
            				
            	        });
       } else {
            return false;
      }
}
function Editday(tour_id,day_id){
     if(tour_id<=0 || day_id<=0){
          alert('You enter Tour ID or Day ID !');
          return false;          
      }    
     $("#addday").val('Update Day');
     $("#msg").html('');
     var Url     = "<?php echo Url::to(array('tour/editday'));?>";
     $.ajax({
        			type: "POST",
        			url: Url,
        			data: ({"tour_id":tour_id,"day_id":day_id}),
        			dataType: "json"			
        			}).done(function( data ) {	
                        if(data!=''){
                            $("#msg").val('');
                            $("#tour-day_tourdetai_id").val(data["id"]);//record is update
                            $("#tour-day_id").val(data["day_id"]);
                            $("#tour-day_title").val(data["title"]);
                            $("#imgroom").val(data["img"]);
                            CKEDITOR.instances['tour-day_fulltxt'].setData(data["fulltxt"]);
                            if(data["img"]!=""){
                                var imgpath = path_itemimgs+'250_160/'+data["img"];
                                $("#imgold").attr("src",imgpath).show();  
                                $("#delimgold").show();                                 
                            }else{
                                $("#imgold").attr("src","").hide();     
                                $('#delimgold').hide();
                            }
                                                     
                        }
        				
         });
       
}
function DelImg(tour_id){
     var day_id    = $("#tour-day_id").val();
     var pathimg   = $("#imgold").attr("src");
     var r = confirm("Do you really want to delete that image ?");
      if (r == true && pathimg!='') {              
               var Url = "<?php echo Url::to(array('tour/deleimg'));?>";
               $.ajax({
            			type: "POST",
            			url: Url,
            			data: ({"tour_id":tour_id,"day_id":day_id}),
            			dataType: "html"			
            			}).done(function( data ) {	
                            if(data!=''){
                               $("#imgold").hide();  
                               $("#delimgold").hide(); 
                               $("#imgroom").val('');                                  
                            }
            				
            	        });
       } else {
            return false;
      }
}
$('#openitemimg').click(function(){
        var url   = "<?php echo Url::to(array('tour/itemimg'));?>";
		$.ajax({
				type: "POST",
				url:url,
				data: ({}),
				dataType: "json"			
				}).done(function( data ) {
				    $.UIkit.modal('#modalimg').show(); 
				    if(data["error"]==1){
				          var rows = JSON.parse(JSON.stringify(data['data'])); 
                          for (var i in rows){
                            var imgpath = path_itemimgs+'250_160/'+rows[i].img;
                            $('#itemthumb').append('<div class="uk-width-1-5"><img src="'+imgpath+'" class="img-thumbnail" onclick="SlcImage(\''+rows[i].img+'\');" alt="'+rows[i].img+'" title="'+rows[i].img+'" />'+rows[i].img+'</div>');
                          }
                    }else{
                         $('#itemthumb').html('No image');
                    }
				   
                    				
				});
     
});
$("#titleitemimg").keyup(function(){    
     var termtxt = this.value;
	 if(termtxt !=''){	
	    var url   = "<?php echo Url::to(array('tour/searchimgitem'));?>";   
		$.ajax({
				type: "POST",
				url:url,
				data: ({"term":termtxt}),
				dataType: "json"			
				}).done(function( data ) {              
				      $('#itemthumb').html('');
                      var rows = JSON.parse(JSON.stringify(data['data']));                     
                      for (var i in rows){
                         var imgpath = path_itemimgs+'250_160/'+rows[i].img;
                         $('#itemthumb').append('<div class="uk-width-1-5"><img src="'+imgpath+'" class="img-thumbnail" onclick="SlcImage(\''+rows[i].img+'\');" alt="'+rows[i].img+'" title="'+rows[i].img+'" />'+rows[i].img+'</div>');
                      }
      	
				}
        );
	 }	
});
                   
function SlcImage(nameimg){   
    var imgpath = path_itemimgs+'250_160/'+nameimg;
    $("#imgold").attr("src",imgpath).show();     
    $('#delimgold').show();
    $("#imgroom").val(nameimg);                           
    $.UIkit.modal('#modalimg').hide(); 
}
</script>
 <br />
 <?php
  }else{
    ?>
    <div style="font-size: 18px;color: red;font-weight: bold;">Bạn phải click nút Save trước khi thêm thông tin này!</div>
    <br />
    <?php
  }
?>