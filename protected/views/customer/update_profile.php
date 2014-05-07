<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->renderPartial("/common/_left_single_menu");
?>

<h1>Dear: <?php echo $model->user_email; ?>  Update your Profile</h1>

<?php echo $this->renderPartial('_form_profile', array('model'=>$model)); ?>