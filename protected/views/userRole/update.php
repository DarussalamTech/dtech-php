<?php
/* @var $this UserRoleController */
/* @var $model UserRole */

$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	$model->role_id=>array('view','id'=>$model->role_id),
	'Update',
);

$this->renderPartial("/common/_left_menu");
?>

<h1>Update UserRole <?php echo $model->role_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>