<?php
/* @var $this SelfSiteController */
/* @var $data SelfSite */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->site_id), array('view', 'id'=>$data->site_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_name')); ?>:</b>
	<?php echo CHtml::encode($data->site_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_descriptoin')); ?>:</b>
	<?php echo CHtml::encode($data->site_descriptoin); ?>
	<br />


</div>