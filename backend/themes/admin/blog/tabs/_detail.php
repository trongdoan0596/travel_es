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
       This length is :<span id="currchar" style="font-weight: bold;"><?php echo strlen ($model->metadesc);?></span>
    </div>
</div>
<script language="javascript">
$('#blog-metadesc').on('keyup',function(){ 
     $('#currchar').html($(this).val().length);  
});
</script>