<?php
/* @var $this UserProfileController */
/* @var $model UserProfile */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->id,
);

$this->menu=array(

	array('label'=>'Update UserProfile', 'url'=>array('update', 'id'=>$model->id)),

);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	
		'first_name',
		'last_name',
		'address',
		'contact_number',
		'city',
		'gender',
		'avatar',
	),
)); ?>
