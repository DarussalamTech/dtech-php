<?php
/* @var $this SelfSiteController */
/* @var $model SelfSite */

$this->breadcrumbs=array(
	'Self Sites'=>array('index'),
	'Create',
);

$this->renderPartial("/common/_left_menu");
?>

<h1>Create SelfSite</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>