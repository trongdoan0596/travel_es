<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>
	<div class="control-group">
		<label class="control-label" for="name">Title</label>
		<div class="controls">
			<?php echo $form->textField($model,'title',array('class'=>'input-xlarge')); ?>
		</div>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->