<?php
/* @var $this UserController */
/* @var $model User */

$user_id = Yii::app()->user->id;
//$this->layout='column2';
if (Yii::app()->user->isAdmin || Yii::app()->user->isSuperAdmin) {
    $this->renderPartial("/common/_left_menu");
}
/**
 * 
 */
ColorBox::generate("cancel_revert");

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

$this->widget('DtGridView', array(
    'id' => 'order-detail-grid',
    'dataProvider' => $model->search(),
    'rowCssClassExpression'=>'($data->reverted_to_stock)?"reveted":""',
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
            'value' => 'CHtml::link($data->product_profile->product->product_name,
                    Yii::app()->controller->createUrl("/product/view",array("id"=>$data->product_profile->product->product_id)),array("target"=>"_blank"))',
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
            'name' => 'quantity',
            'type' => 'Raw',
            'value' => $this->OpPermission['Order.Update'] == true?'$data->user_quantity':'$data->quantity',
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
            'value' => '$data->product_price',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'total_price',
            'type' => 'Raw',
            'value' => '$data->product_price*$data->quantity',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'header' => CHtml::activeLabel(OrderDetail::model(), 'total_price'),
            'columnName' => 'total_price',
            'class' => 'DtGridCountColumn',
            'decimal' => true,
            "htmlOptions" => array("class" => 'cart-ourprice'),
            'currencySymbol' => Yii::app()->session['currency'],
            'footer' => ''
        ),
        array(
            'header' => 'Back to stock',
            'type' => 'Raw',
            'value' => '$data->revert_cancel',
          
            'visible' => $this->OpPermission['Order.Update'] == true?true:false,
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            ),
           
        ),
    ),
));
?>