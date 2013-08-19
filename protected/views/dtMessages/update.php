<?php
/* @var $this DtMessagesController */
/* @var $model DtMessages */

$this->breadcrumbs=array(
	'Dt Messages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->renderPartial("/common/_left_menu");
?>

<h1>Update Messages <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>