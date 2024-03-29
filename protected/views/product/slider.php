<?php
/* @var $this ProductController */
/* @var $model Product */
ColorBox::registerScripts();
$this->breadcrumbs = array(
    'Products' => array('index'),
    'Manage',
);

$this->renderPartial("/common/_left_menu");

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->PcmWidget['filter'] = array('name' => 'ItstLeftFilter',
    'attributes' => array(
        'model' => $model,
        'filters' => $this->filters,
        'keyUrl' => true,
        'action' => Yii::app()->createUrl($this->route),
        'view'=>'slider',
        'grid_id' => 'product-grid',
        ));
?>

<h1>Make Slider</h1>

<!-- search-form -->


<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('DtGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'pager' => array(
        'cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css',
    ),
    'columns' => array(
        array(
            'name' => 'product_name',
            'type' => 'Raw',
            'value' => '$data->product_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'product_overview',
            'type' => 'Raw',
            'value' => '$data->product_overview',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'parent_cateogry_id',
            'value' => '!empty($data->parent_category)?$data->parent_category->category_name:""',
        ),
        array(
            'name' => 'city_id',
            'type' => 'Raw',
            'value' => '!empty($data->city)?$data->city->city_name:""',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'header' => 'Make Slider',
            'type' => 'Raw',
            'value' => '$data->slider_link',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'header' => 'Remove Slider',
            'type' => 'Raw',
            'value' => '!empty($data->slider_remove_link)?$data->slider_remove_link:""',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
    ),
));
?>
