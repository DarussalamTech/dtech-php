<?php
/* @var $this LayoutController */
/* @var $model Layout */

$this->breadcrumbs = array(
    'Layouts' => array('index'),
    'Manage',
);

if(!(Yii::app()->user->isGuest)) {
        $this->renderPartial("/common/_left_menu");
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#layout-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Add Layouts</h1>

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
    'id' => 'layout-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'layout_name',
            'type' => 'Raw',
            'value' => '$data->layout_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'layout_description',
            'type' => 'Raw',
            'value' => '$data->layout_description',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'layout_color',
            'type' => 'Raw',
            'value' => '$data->layout_color',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'site_id',
            'type' => 'Raw',
            'value' => '!empty($data->site)?$data->site->site_name:""',
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
