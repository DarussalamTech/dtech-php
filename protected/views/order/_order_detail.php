<?php
/* @var $this UserController */
/* @var $model User */

$user_id = Yii::app()->user->id;
//$this->layout='column2';
if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_menu");
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Orders Detail  </h1>

<?php
echo CHtml::openTag("div", array("class" => "flash-success", "id" => "flash-message-order", "style" => "display:none"));

echo CHtml::closeTag("div");
echo CHtml::openTag("div", array("class" => "flash-error", "id" => "flash-error-order", "style" => "display:none"));

echo CHtml::closeTag("div");
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'order-detail-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        array(
            'name' => 'order_date',
            'type' => 'Raw',
            'value' => '$data->order->order_date',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'product_name',
            'type' => 'Raw',
            'value' => '$data->product_profile->product->product_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'book_language',
            'type' => 'Raw',
            'value' => '$data->product_profile->productLanguage->language_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'product_quantity',
            'type' => 'Raw',
            'value' => '$data->user_quantity',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'stock',
            'type' => 'Raw',
            'value' => '$data->stock',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'unit_price',
            'type' => 'Raw',
            'value' => '"&dollar;".$data->product_price',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'total_price',
            'type' => 'Raw',
            'value' => '"&dollar;".$data->product_price*$data->quantity',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
    ),
));
?>