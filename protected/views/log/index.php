<?php
/* @var $this ProductTemplateController */
/* @var $model ProductTemplate */

$this->breadcrumbs = array(
    'Product Templates' => array('index'),
    'Manage',
);

$this->renderPartial("/common/_left_single_menu");

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
        <h1>Manage Logs</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <?php
        echo CHtml::link("htaccess Rules", $this->createUrl("/log/htAccess"), array(
            'class' => "print_link_btn",
            
        ));
     
        echo CHtml::link("Robote Txt", $this->createUrl("/log/robote"), array(
            'class' => "print_link_btn",
            
        ));
        ?>
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
$button_template = "";


if ($this->checkViewAccess(ucfirst($this->id) . ".View")) {
    $button_template.= "{view}";
}



$this->widget('DtGridView', array(
    'id' => 'log-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'create_time',
        'ip',
        'line',
        'type',
        'browser',
        'url',
        'file',
        'message',
        array(
            'class' => 'CButtonColumn',
            'template' => $button_template,
        ),
    ),
));
?>
<style>
    ul.yiiPager .first, ul.yiiPager .last {
        display: inline-block;
    }
</style>        