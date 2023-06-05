<table width="100%">
   <tr>
      <td  width="50%" valign="top">
           <div class="control-group">
                <div class="controls">
                    <?php echo $form->field($model,'title')->textInput(array('class' =>'form-control'));?>
                </div>
            </div>
             <div class="control-group" id="cityid">
            		  <div class="controls">
                       <?php echo $form->field($model,'code')->textInput(array('class' =>'form-control'));?>
            		  </div>
                </div>
            <div class="control-group">
                <div class="controls" >
                    <?php echo $form->field($model,'type')->dropDownList($model->getAllType());?>
                </div>
            </div>
      </td>
      <td valign="top">
               <div class="control-group">
                    <div class="controls" >
                        <?php echo $form->field($model,'frontend_input')->dropDownList($model->getAllInput());?>
                    </div>
                </div>
                 <div class="control-group">
                    <div class="controls" >
                        <?php echo $form->field($model,'status')->dropDownList($model->getAllStatus());?>
                    </div>
                </div>
                 <div class="control-group">
                    <div class="controls">
                        <?php echo $form->field($model,'ordering')->textInput(array('class' =>'form-control'));?>
                    </div>
                </div>
               
      </td>
     </tr>  
</table>   