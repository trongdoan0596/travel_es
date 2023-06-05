 <div class="control-group">
        <div class="controls">
            <?php echo $form->field($model,'metatitle')->textInput(array('class' =>'form-control'));?>
        </div>
</div>
<div class="control-group">
    <div class="controls">
       <?php 
       echo $form->field($model,'metakey')->textarea();
       ?>
    </div>
</div>
<div class="control-group">
    <div class="controls">
       <?php 
       echo $form->field($model,'metadesc')->textarea();
       ?>
    </div>
</div>