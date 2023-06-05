<?php
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;
if($model->id>0){
?>
<div id="msg" style="color: red;"></div>
<div class="control-group">
        <div class="controls">
          <?php 
           echo $form->field($model,'introtxt')->widget(CKEditor::className(),array( 
                       'options' => array('rows' =>6),
                       'preset' => 'base', //advanced basic standard full
                       'clientOptions' => array(
                            'filebrowserUploadUrl' =>'../site/uploadimg'
                        )
                     ));
           ?> 
        </div>
</div>
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
             <img src="../themes/admin/images/edit.png" height="18" width="18" style="cursor: pointer;" onclick="Editday(<?php echo $tour_id;?>,<?php echo $day_id;?>);" />
             <img src="../themes/admin/images/delete.png" height="18" width="18" style="cursor: pointer;" onclick="Dele(<?php echo $tour_id;?>,<?php echo $day_id;?>,<?php echo $id;?>);" />
            
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
<table width="100%" >
        <tr>
        <td width="50%" valign="top">
        <div class="control-group">
            <div class="controls">
                <?php
                  echo $form->field($model,'day_id')->dropDownList(ArrayHelper::map($days, 'id','title'),array('prompt'=>'-- Select Day --'));
                ?>
            </div>
         </div> 
        </td>
       <td valign="top">
        <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'day_title')->textInput(array('class' =>'form-control'));?>
                </div>
        </div>
       </td>
    </tr>
</table>
 <div class="control-group">
        <div class="controls">   
          <?php  echo $form->field($model,'day_fulltxt')->widget(CKEditor::className(),array( 
                       'options' => array('rows' =>6),
                       'preset' => 'base', //advanced basic standard full
                       'clientOptions' => array(
                            'filebrowserUploadUrl' =>'../site/uploadimg'
                        )
                     ));
              ?>
        </div>
</div>   
   <div class="control-group" style="text-align: center;">
   <input type="hidden" id="tour-day_tourdetai_id" name="Tour[tourdetai_id]" value="0" />
   <input type="button" class="btn btn-primary" onclick="Addday(<?php echo $model->id;?>);" name="addday" id="addday" value="Add Day" />
 </div>    
 <script>
 //add day in tour
function Addday(tour_id){
     var Url     = "<?php echo Url::to(array('tour/addnewday'));?>";
      var day_id  = $("#tour-day_id").val();
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
      $.ajax({
			type: "POST",
			url: Url,
			data: ({"tourdetai_id":tourdetai_id,"tour_id":tour_id,"day_id":day_id,"titleday":title_day,"txtday":txt_day}),
			dataType: "json"			
			}).done(function( data ) {
                //if(data['data'] !='' || data['msg'] !=''){
                    $("#tour-day_id").val('');
                    $("#tour-day_title").val('');
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
                        $("#msg").html(data['msg']);//$("#msg").append(data['msg']);
                    }
               // }
				
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
                            CKEDITOR.instances['tour-day_fulltxt'].setData(data["fulltxt"]);
                        }
        				
         });
       
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