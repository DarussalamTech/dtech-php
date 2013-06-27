<?php
/* @var $this LayoutController */
/* @var $model Layout */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'layout_id'); ?>
		<?php echo $form->textField($model,'layout_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'layout_name'); ?>
		<?php echo $form->textField($model,'layout_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'layout_description'); ?>
		<?php echo $form->textField($model,'layout_description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'layout_color'); ?>
		<?php echo $form->textField($model,'layout_color',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site_id'); ?>
		<?php echo $form->textField($model,'site_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array("class" => "btn")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->