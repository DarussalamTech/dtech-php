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
<br/>
<div>
    <h4>Your Order Details</h4>
</div>




<?php
$this->widget('DtGridView', array(
    'id' => 'order-grid',
    'cssFile' => Yii::app()->theme->baseUrl . '/css/cart_gridview.css',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        array(
            'name' => 'product_name',
            'type' => 'Raw',
            //'value' => 'if($data->status_id="1")?Active:"Inactive"',
            'value' => '$data->product_profile->product->product_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'book_language',
            'type' => 'Raw',
            //'value' => 'if($data->status_id="1")?Active:"Inactive"',
            'value' => '$data->product_profile->productLanguage->language_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'book_author',
            'type' => 'Raw',
            //'value' => 'if($data->status_id="1")?Active:"Inactive"',
            'value' => '$data->product_profile->product->author->author_name',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'header' => CHtml::activeLabel($model, 'quantity'),
            'columnName' => 'quantity',
            'class' => 'DtGridCountColumn',
            'decimal' => false,
            "htmlOptions" => array("class" => 'cart-ourprice'),
            //'currencySymbol' => Yii::app()->session['currency'],
            'footer' => ''
        ),
        array(
            'name' => 'unit_price',
            'type' => 'Raw',
            //'value' => 'if($data->status_id="1")?Active:"Inactive"',
            'value' => '$data->product_price." ".Yii::app()->session[currency]',
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'header' => CHtml::activeLabel($model, 'total_price'),
            'columnName' => 'total_price',
            'class' => 'DtGridCountColumn',
            'decimal' => true,
            "htmlOptions" => array("class" => 'cart-ourprice'),
            'currencySymbol' => Yii::app()->session['currency'],
            'footer' => ''
        ),

    ),
));
?>