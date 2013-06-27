<?php
/* @var $this SelfSiteController */
/* @var $model SelfSite */

$this->breadcrumbs=array(
	'Self Sites'=>array('index'),
	$model->site_id=>array('view','id'=>$model->site_id),
	'Update',
);

$this->renderPartial("/common/_left_menu");
?>

<h1>Update SelfSite <?php echo $model->site_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>