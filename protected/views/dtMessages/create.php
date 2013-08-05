<?php
/* @var $this DtMessagesController */
/* @var $model DtMessages */

$this->breadcrumbs=array(
	'Dt Messages'=>array('index'),
	'Create',
);

$this->renderPartial("/common/_left_menu");
?>

<h1>Create Translation Messages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>