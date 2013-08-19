<?php
/* @var $this DtMessagesController */
/* @var $model DtMessages */

$this->breadcrumbs = array(
    'Dt Messages' => array('index'),
    'Manage',
);

$this->renderPartial("/common/_left_menu");

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#dt-messages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Manage  Messages</h1>
    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">
        <span class="creatdate">
            <?php
            echo CHtml::link("Generate Cache", $this->createUrl("/dtMessages/generate", array("category" => $_GET['category'])), array(
                'class' => "print_link_btn",
            ));
            ?>
        </span>
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
    $template = "{view}";

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'dt-messages-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'category',
            'message',
            array(
                'class' => 'CButtonColumn',
                'template' => $template
            ),
        ),
    ));
    ?>
