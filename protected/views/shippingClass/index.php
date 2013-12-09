<?php
/* @var $this ShippingClassController */
/* @var $model ShippingClass */

$this->breadcrumbs = array(
    'Shipping Classes' => array('index'),
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
	$('#shipping-class-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Manage Shipping Classes</h1>

    </div>

    <?php /* Convert to Monitoring Log Buttons */ ?>
    <div class = "right_float">

    </div>
</div>
<div class="clear"></div>

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
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'shipping-class-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'source_city',
            'value' => 'isset($data->source_city_rel) ? $data->source_city_rel->city_name : ""'
        ),
        array(
            'name' => 'destination_city',
            'value' => 'isset($data->dest_city_rel) ? $data->dest_city_rel->city_name : "Out Of Source"'
        ),
        'title',
        array(
            'name' => 'is_fix_shpping',
            'value' => '($data->is_fix_shpping == 1) ? "Enabled" : "Disabled"',
        ),
        array(
            'name' => 'is_pirce_range',
            'value' => '($data->is_pirce_range == 1) ? "Enabled" : "Disabled"',
        ),
        array(
            'name' => 'is_weight_based',
            'value' => '($data->is_weight_based == 1) ? "Enabled" : "Disabled"',
        ),
        array(
            'name' => 'class_status',
            'value' => '($data->class_status == 1) ? "Enabled" : "Disabled"',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{enableimg} {disableimg} {enable} {disable} &nbsp;&nbsp;&nbsp;{view}{update}{delete}',
            'buttons' => array(
                'enable' => array(
                    'label' => '[ Disable ]',
                    'url' => 'Yii::app()->controller->createUrl("/shippingClass/toggleEnabled",array("id"=>$data->id))',
                    'visible' => '$data->class_status==1',
                    'click' => "function(event){
                                event.preventDefault();
                                $.ajax({
                                    url: $(this).attr('href'),
                                    success:function(msg){
                                        $('#shipping-class-grid').yiiGridView.update('shipping-class-grid');
                                    }
                                });
                                
                              }",
                ),
                'disable' => array(
                    'label' => '[ Enable ]',
                    'url' => 'Yii::app()->controller->createUrl("/shippingClass/toggleEnabled",array("id"=>$data->id))',
                    'visible' => '$data->class_status==0',
                    'click' => "function(event){
                                event.preventDefault();
                                $.ajax({
                                    url: $(this).attr('href'),
                                    success:function(msg){
                                        $('#shipping-class-grid').yiiGridView.update('shipping-class-grid');
                                    }
                                });
                              }",
                ),
                'enableimg' => array(
                    'label' => 'Enabled',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/enable.png',
                    'visible' => '$data->class_status==1',
                ),
                'disableimg' => array(
                    'label' => 'Disabled',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/disable.png',
                    'visible' => '$data->class_status==0',
                ),
            ),
            'htmlOptions' => array('style' => 'width:144px;')
        ),
    ),
));
?>
