<div class="uk-grid">
    <div class="uk-width-1-3">
        <div class="control-group">
                 <div class="controls">
                   <?php 
                      echo $form->field($model,'username')->textInput(array('class' =>'form-control'));
                   ?>
                 </div>
            </div>
           <div class="control-group">
                 <div class="controls">
                   <?php 
                      echo $form->field($model,'password_hash')->passwordInput(array('class' =>'form-control'));
                   ?>
                 </div>
            </div>
           <div class="control-group">
                 <div class="controls">
                   <?php 
                      echo $form->field($model,'fullname')->textInput(array('class' =>'form-control'));
                   ?>
                 </div>
            </div>
    </div>
    <div class="uk-width-1-3">
     
            <div class="control-group">
                 <div class="controls">
                   <?php 
                      echo $form->field($model,'phone')->textInput(array('class' =>'form-control'));
                   ?>
                 </div>
            </div>
             <div class="control-group">
                 <div class="controls">
                   <?php 
                      echo $form->field($model,'skype')->textInput(array('class' =>'form-control'));
                   ?>
                 </div>
            </div>
            <div class="control-group">
                 <div class="controls">
                   <?php 
                      echo $form->field($model,'email')->textInput(array('class' =>'form-control'));
                   ?>
                 </div>
            </div>
    </div>
    <div class="uk-width-1-3">
                <div class="control-group">
                        <div class="controls" >
                            <?php echo $form->field($model,'role')->dropDownList($model->getAllRole());?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls" >
                            <?php echo $form->field($model,'status')->dropDownList($model->getAllStatus());?>
                        </div>
                    </div>
                      <div class="control-group">
                             <div class="controls">
                             <?php echo $form->field($model,'img')->fileInput(); ?>
                              <?php if ($model->img) { ?>
                                <img width="90" height="90" src="<?php echo $model->getImg($model); ?>"  />
                            <?php } ?>
                          </div>
                 </div>  
    </div>
</div>    