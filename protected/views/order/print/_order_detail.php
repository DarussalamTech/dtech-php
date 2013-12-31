<?php
/* @var $this UserController */
/* @var $model User */

$user_id = Yii::app()->user->id;
$config = array(
    'criteria' => array(
        'condition' => 'order_id=' . $model->order_id,
        'order' => 'quantity DESC'
    ),
    'pagination' => array(
        'pageSize' => 200,
    ),
);

$mName_provider = new CActiveDataProvider('OrderDetail', $config);
?>

<h1>Orders Detail  </h1>



<?php
$this->widget('DtGridView', array(
    'id' => 'order-detail-grid',
    'dataProvider' => $mName_provider,
    'footerHtml' => $footer_str,
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
            'name' => 'quantity',
            'type' => 'Raw',
            'value' => '$data->quantity',
            'sortable' => false,
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'stock',
            'type' => 'Raw',
            'value' => '$data->stock',
            'sortable' => false,
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'unit_price',
            'type' => 'Raw',
            'value' => '$data->product_price',
            'sortable' => false,
            'headerHtmlOptions' => array(
                'style' => "text-align:left"
            )
        ),
        array(
            'name' => 'total_price',
            'type' => 'Raw',
            'sortable' => false,
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
    ),
));
?>