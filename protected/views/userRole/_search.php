<?php
/* @var $this UserRoleController */
/* @var $model UserRole */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'role_id'); ?>
		<?php echo $form->textField($model,'role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'role_title'); ?>
		<?php echo $form->textField($model,'role_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array("class" => "btn")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->