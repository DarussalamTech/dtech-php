<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs=array(
	'Product Templates'=>array('index'),
	'Manage',
);

$this->renderPartial("/common/_left_menu");

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-template-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Manage Product Templates</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$button_template = "{view} {update} {delete}";
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-template-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'product_id',
		'product_name',
		'universal_name',
		'parent_id',
		'slag',
		'parent_cateogry_id',
	
		array(
			'class'=>'CButtonColumn',
                    'template' => $button_template,
		),
	),
)); ?>
