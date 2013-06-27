<?php
/* @var $this LayoutController */
/* @var $data Layout */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('layout_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->layout_id), array('view', 'id'=>$data->layout_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('layout_name')); ?>:</b>
	<?php echo CHtml::encode($data->layout_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('layout_description')); ?>:</b>
	<?php echo CHtml::encode($data->layout_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('layout_color')); ?>:</b>
	<?php echo CHtml::encode($data->layout_color); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_id')); ?>:</b>
	<?php echo CHtml::encode($data->site_id); ?>
	<br />


</div>