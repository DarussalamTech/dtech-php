<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$this->renderPartial("/common/_left_menu");
?>

<h1>Create Pages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>