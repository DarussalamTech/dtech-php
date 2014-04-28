<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs=array(
	'Product Templates'=>array('index'),
	$model->product_id,
);

$this->menu=array(
	array('label'=>'List ProductTemplate', 'url'=>array('index')),
	array('label'=>'Create ProductTemplate', 'url'=>array('create')),
	array('label'=>'Update ProductTemplate', 'url'=>array('update', 'id'=>$model->product_id)),
	array('label'=>'Delete ProductTemplate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductTemplate', 'url'=>array('admin')),
);
?>

<h1>View ProductTemplate #<?php echo $model->product_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'product_id',
		'product_name',
		'universal_name',
		'parent_id',
		'slag',
		'parent_cateogry_id',
		'product_description',
		'product_overview',
		'status',
		'city_id',
		'is_featured',
		'product_rating',
		'authors',
		'shippable_countries',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
