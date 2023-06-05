 <div class="control-group">
    <div class="controls" >
      <table cellspacing="0" cellpadding="0" style="width:100%" class="grid-option table table-bordered">
        	<tbody>
                <tr id="attribute-options-table">
    				<th width="30%">Title</th>
    				<th width="15%">Ordering</th>
    				<th width="25%" style="text-align: center;">Default</th>
                    <th width="15%" style="text-align: center;">Extend</th>
    				<th><input type="button" onclick="AddOption()" id="addoption" class="btn btn-primary" value="Add" /></th>					
    			</tr>	
                 <?php
                 $opt_id = 0;
                 if(!empty($attoption_ids)){
                      foreach($attoption_ids as $row){                         
                         $opt_id    = $row->id;
                         $value     = $row->value;
                         $extend    = $row->extend;
                         $ordering  = $row->ordering;
                         ?>
                         <tr id="attribute_options<?php echo $opt_id;?>">
                          <th width="30%">
                               <input type="text" name="Attribute[value][option_<?php echo $opt_id;?>]" value="<?php echo $value;?>" class="form-control" />
                           </th>
                           <th width="15%">
                               <input type="text" size="8" name="Attribute[order][option_<?php echo $opt_id;?>]" value="<?php echo $ordering;?>" style="width:100px" class="form-control" />
                           </th>
                           <th width="25%" style="text-align: center;">
                               <input type="radio" class="input-radio" name="Attribute[default]" <?php if($model->default_value == $opt_id) echo 'checked="checked"';?> value="option_<?php echo $opt_id;?>" />
                           </th>
                           <th width="15%" style="text-align: center;">
                               <input type="text" maxlength="7" name="Attribute[extend][option_<?php echo $opt_id;?>]" value="<?php echo $extend;?>" size="7" class="form-control" />
                           </th>
                           <th>
                               <input type="button" value="Delete" class="btn btn-warning" onclick="AddDel(<?php echo $opt_id;?>)" />
                           </th>
                          </tr>
                         <?php
                      } 
                 } 
                 ?>		
        	</tbody>
        </table>
   </div>
</div>
<input type="hidden" id="count_op" value="<?php echo $opt_id;?>" />
<script>
function AddOption(){
        var count_op = parseInt($("#count_op").val()) + 1;	
        $("#count_op").val(count_op);
        var htm = '';
		htm += '<tr id="attribute_options'+count_op+'">';
    	htm +='<th width="30%"><input type="text" class="form-control" value=""name="Attribute[value][option_'+count_op+']" /></th>';
        htm +='<th width="15%"><input type="text" class="form-control" style="width:100px" value="0" name="Attribute[order][option_'+count_op+']" size="8" /></th>';
        htm +='<th width="25%" style="text-align: center;"><input type="radio" value="option_'+count_op+'" name="Attribute[default]" class="input-radio" /></th>';
        htm +='<th width="15%" style="text-align: center;"><input class="form-control" type="text" size="7" name="Attribute[extend][option_'+count_op+']" maxlength="7" ></th>';
        htm +='<th><input type="button" onclick="AddDel('+count_op+')" class="btn btn-warning" value="Delete" /></th>';				
        htm +='</tr>';	
     	$(".grid-option tr").first().after(htm);
}
function AddDel(count_op){
   
    	$("#attribute_options"+count_op).remove();
}
</script>