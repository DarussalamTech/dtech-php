<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs = array(
    'Product Templates' => array('index'),
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
//rendering filters
$this->PcmWidget['filter'] = array('name' => 'ItstLeftFilter',
    'attributes' => array(
        'model' => $model,
        'filters' => $this->filters,
        'keyUrl' => true,
        'action' => Yii::app()->createUrl($this->route),
        'grid_id' => 'product-grid',
        ));
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
<?php
if (Yii::app()->user->hasFlash('success')) {
    echo CHtml::openTag("div", array("class" => "flash-success"));
    echo Yii::app()->user->getFlash("success");
    echo CHtml::closeTag("div");
}
echo '<div class="clear"></div>';
if (Yii::app()->user->hasFlash('errorIntegrity')) {
    echo CHtml::openTag("div", array("class" => "flash-error"));
    echo Yii::app()->user->getFlash("errorIntegrity");
    echo CHtml::closeTag("div");
}
echo '<div class="clear"></div>';

?>
<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$button_template = "";


if ($this->checkViewAccess(ucfirst($this->id) . ".View")) {
    $button_template.= "{view}";
}
if ($this->checkViewAccess(ucfirst($this->id) . ".Update")) {
    $button_template.= "{update} ";
}

if ($this->checkViewAccess(ucfirst($this->id) . ".Delete")) {
    $button_template.= "{delete}";
}


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'product-template-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'product_name',
        'universal_name',
        'slag',
        array(
            'name' => 'parent_cateogry_id',
            'value' => '!empty($data->parent_category)?$data->parent_category->category_name:""',
        ),
        array(
            'name' => 'is_featured',
            'type' => 'Raw',
            'value' => '($data->is_featured==1)?"Yes":"No"',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'status',
            'type' => 'Raw',
            'value' => '($data->status==1)?"Active":"Disabled"',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'header' => 'Available Cities',
            'type' => 'Raw',
            'value' => 'City::model()->getAvailableCities($data->universal_name)',
            'headerHtmlOptions' => array(
                'style' => "text-align:left;width:100px;"
                
            )
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => $button_template,
            'deleteConfirmation' => 'Are You Sure? You Want to delete this Product,its images and profile',
            'afterDelete' => 'window.location.reload()',
        ),
    ),
));
?>