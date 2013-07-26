<?php
/* @var $this UserProfileController */
/* @var $model UserProfile */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


$this->menu=array(
	array('label'=>'View UserProfile', 'url'=>array('view', 'id'=>$model->id)),	
);
?>
<?php echo $this->renderPartial('//userProfile/_form', array('model'=>$model)); ?>