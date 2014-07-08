<?php
/* @var $this SelfSiteController */
/* @var $model SelfSite */

$this->breadcrumbs = array(
    'Self Sites' => array('index'),
    'Manage',
);

$this->renderPartial("/common/_left_menu");

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#self-site-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Add New Site</h1>

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
$this->widget('DtGridView', array(
    'id' => 'self-site-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'site_name',
            'type' => 'Raw',
            'value' => '$data->site_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'status',
            'type' => 'Raw',
            'value' => 'isset($data->_statuses[$data->status])?$data->_statuses[$data->status]:""',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'site_descriptoin',
            'type' => 'Raw',
            'value' => '$data->site_descriptoin',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
