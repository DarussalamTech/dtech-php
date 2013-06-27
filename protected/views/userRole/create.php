<?php
/* @var $this UserRoleController */
/* @var $model UserRole */

$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	'Create',
);

$this->renderPartial("/common/_left_menu");
?>

<h1>Create UserRole</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>