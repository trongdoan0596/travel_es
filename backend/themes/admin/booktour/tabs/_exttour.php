<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Tourextentions;
if($model->id>0){
?>
<div id="msgext" style="color: red;"></div>
<div>
 <table width="100%" class="table table-bordered"  id="contentext">
    <thead>
      <tr>
          <td width="20%" style="white-space: nowrap;">Title</td>
          <td width="30%">Status</td>
          <td width="30%">Ordering</td>
          <td width="8%" style="white-space: nowrap;"></td>
       </tr>
     </thead>
       <tbody>
   <?php
      if(!empty($alltourext)){
        $i=0;
          foreach ($alltourext as $r) {
            $city = '';
            $id   = $r->id;
            $tour_id   = $r->tour_id;
            $ordering  = $r->ordering;
            $status    = Tourextentions::getStatus($r->status);
            if($i%2==0) $cls="odd";
              else $cls="even";
            $title     = $r->tour->title;
        ?>
          <tr class="<?php echo $cls;?>" id="exttour_<?php echo $id;?>" >
              <td style="white-space: nowrap;"><?php echo $title;?></td>
              <td><?php echo $status;?></td>
              <td> <?php echo $ordering;?></td>
              <td style="white-space: nowrap;">
                 <img src="../themes/admin/images/edit.png" height="18" width="18" style="cursor: pointer;" onclick="Editext(<?php echo $id;?>);" />
                 <img src="../themes/admin/images/delete.png" height="18" width="18" style="cursor: pointer;" onclick="Deleext(<?php echo $id;?>);" />
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
<center>
<b  style="text-align: center;">Add news Extentions Tour : </b>
<table cellpadding="3" cellspacing="5" >
<tr>
     <td width="40%" align="right" style="padding: 10px;" >               
         <div class="controls">
           <?php
             echo $form->field($model,'ext_tour_id')->dropDownList(ArrayHelper::map($alltour, 'id','title'),array('prompt'=>'-- Select Tour --'));
          ?>
        </div>
      </td>
     <td style="padding: 10px;">
     <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'ext_status')->dropDownList(array(0 => 'Hide',1 => 'Show'));?>
                </div>
     </div>   
     </td>
     <td style="padding: 10px;">
      <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'ext_ordering')->textInput(array('class' =>'form-control'));?>
                </div>
        </div>
      </td>
    <td style="padding: 10px;padding-top: 18px;">
    <input type="hidden" id="tour-ext_id" name="Tour[ext_id]" value="0" />
   <input type="button" class="btn btn-primary" onclick="Addext(<?php echo $model->id;?>);" name="addext" id="addext" value="Add" /></td>
</tr>
</table>
 </center>

 <script>
function Addext(tour_id)  {
      var Url         = "<?php echo Url::to(array('tour/addext'));?>";
      var ext_id      = $("#tour-ext_id").val();
      var ordering    = $("#tour-ext_ordering").val();
      var tourext_id  = $("#tour-ext_tour_id").val();
      var status      = $("#tour-ext_status").val();
      
      if(tourext_id==''){
          alert('You must select Tour extentions!');
          return false;
      }
      $.ajax({
			type: "POST",
			url: Url,
			data: ({"tourext_id":tourext_id,"ext_id":ext_id,"tour_id":tour_id,"ordering":ordering,"status":status}),
			dataType: "json"			
			}).done(function( data ) {
                //if(data['data'] !='' || data['msg'] !=''){
                    $("#tour-ext_id").val('');                    
                    $("#tour-ext_ordering").val('');
                    if(data['data'] !=''){
                        if(data['msg']=='Update successful!'){
                            $("#exttour_"+ext_id).html(data['data']);
                            $("#addext").val('Add');
                        }else{
                          $("#contentext").append(data['data']);
                        }                        
                    }
                    if(data['msg'] !=''){
                        $("#msgext").html(data['msg']);
                    }
               // }
				
	        });
};

function Deleext(ext_id){
     if(ext_id<=0){
          alert('You enter Tour ID or Extentions ID !');
          return false;          
      }
      var r = confirm("Do you really want to delete that record ?");
      if (r == true) {
               var Url = "<?php echo Url::to(array('tour/deleext'));?>";
               $.ajax({
            			type: "POST",
            			url: Url,
            			data: ({"ext_id":ext_id}),
            			dataType: "html"			
            			}).done(function( data ) {	
                            if(data!=''){
                                $("#exttour_"+ext_id).hide();                               
                            }
            				
            	        });
       } else {
            return false;
      }
}
function Editext(ext_id){
     if(ext_id<=0){
          alert('You enter Tour Extentions ID !');
          return false;          
      }
     $("#addext").val('Update');
     $("#msgext").html('');
     var Url     = "<?php echo Url::to(array('tour/editext'));?>";
     $.ajax({
			type: "POST",
			url: Url,
			data: ({"ext_id":ext_id}),
			dataType: "json"			
			}).done(function( data ) {	
                if(data!=''){
                    //$("#msg").html('');
                    $("#tour-ext_id").val(data["id"]);
                    $("#tour-ext_ordering").val(data["ordering"]);
                    $("#tour-ext_status").val(data["status"]);
                    $("#tour-ext_tour_id").val(data["ext_id"]);//record is update
                  
                }
        				
         });
       
}

</script>
 <?php
  }else{
    ?>
    <div style="font-size: 18px;color: red;font-weight: bold;">Bạn phải click nút Save trước khi thêm thông tin này!</div>
    <br />
    <?php
  }
?>