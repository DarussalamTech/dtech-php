<?php
/* @var $this TranslatorCompilerController */
/* @var $data TranslatorCompiler */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('activity_log')); ?>:</b>
	<?php echo CHtml::encode($data->activity_log); ?>
	<br />

	*/ ?>

</div>