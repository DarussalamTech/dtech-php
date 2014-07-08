<?php
/* @var $this ZoneController */
/* @var $model Zone */

$this->breadcrumbs = array(
    'Zones' => array('index'),
    'Manage',
);

if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_menu");
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#zone-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php if (Yii::app()->user->hasFlash('rates_success')) {
    ?>

    <div class="flash-success" align="center">
        <?php echo Yii::app()->user->getFlash('rates_success'); ?>

    </div>

<?php } ?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Manage Zones</h1>
    </div>

</div>

<div class="clear"></div>
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
if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
    $template.= "{update} ";
}


$this->widget('DtGridView', array(
    'id' => 'zone-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        array(
            'class' => 'CButtonColumn',
            'template' => $template,
        )
    ),
));
?>
