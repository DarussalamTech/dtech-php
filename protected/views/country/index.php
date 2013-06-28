<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs = array(
    'Countries' => array('index'),
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
	$('#country-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Countries</h1>

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
$template = "";
if (isset($this->OpPermission[ucfirst($this->id) . ".View"]) && $this->OpPermission[ucfirst($this->id) . ".View"]) {
    $template.= "{view}";
}
if (isset($this->OpPermission[ucfirst($this->id) . "Update"]) && $this->OpPermission[ucfirst($this->id) . "Update"]) {
    $template.= "{update}";
}
if (isset($this->OpPermission[ucfirst($this->id) . "Delete"]) && $this->OpPermission[ucfirst($this->id) . "Delete"]) {
    $template.= "{delete}";
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'country-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'country_name',
            'type' => 'Raw',
            'value' => '$data->country_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'short_name',
            'type' => 'Raw',
            'value' => '$data->short_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'site_id',
            'type' => 'Raw',
            'value' => '!empty($data->site)?$data->site->site_name:""',
            //'value' => '$data->site_id',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => $template,
        ),
    ),
));
?>
