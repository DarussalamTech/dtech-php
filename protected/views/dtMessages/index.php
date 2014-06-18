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
    <div class="clear"></div>
    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "">
        <span class="creatdate no-clear">
            <?php
            echo CHtml::link("Generate Common Cache", $this->createUrl("/dtMessages/generate", array("category" => "common")), array(
                'class' => "print_link_btn",
            ));
            ?>
            <?php
            echo CHtml::link("Generate Header Cache", $this->createUrl("/dtMessages/generate", array("category" => "header_footer")), array(
                'class' => "print_link_btn",
            ));
            ?>
            <?php
            echo CHtml::link("Generate Labels Cache", $this->createUrl("/dtMessages/generate", array("category" => "model_labels")), array(
                'class' => "print_link_btn",
            ));
            ?>
            <?php
            echo CHtml::link("Generate Product Detail Cache", $this->createUrl("/dtMessages/generate", array("category" => "product_detail")), array(
                'class' => "print_link_btn",
            ));
            ?>
       
        </span>
    </div>
    <?php
        if(Yii::app()->user->hasFlash('message')):
            echo "<span class='flash-message'>";
                echo Yii::app()->user->getFlash('message');
            echo "</span>";
        endif;
    ?>
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
