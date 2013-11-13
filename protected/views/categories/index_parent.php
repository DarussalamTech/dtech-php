<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs = array(
    'Categories' => array('index'),
    'Manage',
);

if (!(Yii::app()->user->isGuest)) {
    $this->renderPartial("/common/_left_menu");
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#categories-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Add Product Categories</h1>


<?php
echo CHtml::openTag("div", array(
    "class" => "flash-success",
    "id" => 'flash-message',
    "style" => "display:none"
));

echo CHtml::closeTag("div");
?>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('ext.lyiightbox.LyiightBox2', array(
));

$template = "";
if (isset($this->OpPermission[ucfirst($this->id) . ".View"]) && $this->OpPermission[ucfirst($this->id) . ".View"]) {
    $template.= "{view}";
}
if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
    $template.= "{update}";
}
if (isset($this->OpPermission[ucfirst($this->id) . ".Delete"]) && $this->OpPermission[ucfirst($this->id) . ".Delete"]) {
    $template.= "{delete}";
}
$grid_array = array(
    'id' => 'categories-grid',
    'dataProvider' => $model->search(),
    'sortUrl' => $this->createUrl("/categories/updateOrder"),
    'rowCssClassExpression' => '"items[]_{$data->category_id}"',
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'category_name',
            'type' => 'Raw',
            'value' => '$data->category_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'added_date',
            'type' => 'Raw',
            'value' => '$data->added_date',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'is_main_featured',
            'type' => 'Raw',
            'value' => '$data->is_main_featured',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'category_image',
            "type" => "raw",
            'value' => 'CHtml::link($data->category_image,$data->cat_image_url,array("rel" => "lightbox[_default]"))',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
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
            'class' => 'CButtonColumn',
            'template' => $template,
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->controller->createUrl("/categories/updateParent",array("id"=>$data->category_id))',
                )
            ),
        ),
    ),
);

if ($model->parent_id == '0') {
    unset($grid_array['filter']);
}
$this->widget('DtGridView', $grid_array);
?>
