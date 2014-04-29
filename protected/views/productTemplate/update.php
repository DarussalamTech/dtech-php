<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs=array(
	'Product Templates'=>array('index'),
	$model->product_id=>array('view','id'=>$model->product_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductTemplate', 'url'=>array('index')),
	array('label'=>'Create ProductTemplate', 'url'=>array('create')),
	array('label'=>'View ProductTemplate', 'url'=>array('view', 'id'=>$model->product_id)),
	array('label'=>'Manage ProductTemplate', 'url'=>array('admin')),
);
?>

<h1>Update Product Template <?php echo $model->product_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'authorList' => $authorList)); ?>