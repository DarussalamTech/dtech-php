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
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'order-detail-grid',
    'dataProvider' => $mName_provider,
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
<div class="grid-view">
    <table class="items" style="width: 58%">
        <tfoot>
            <tr class="even">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>

                <td  style="text-align: right"><span>Shipping : </span><?php echo $model->shipping_price; ?></td>
            </tr>
            <tr class="even">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>

                <td  style="text-align: right"><span>Tax : </span><?php echo $model->tax_amount; ?></td>
            </tr>
            <tr class="odd">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td  style="text-align: right"><span>Grand Total: </span><?php echo number_format((double) $model->total_price + (double) $model->shipping_price + (double) $model->tax_amount, 2); ?></td>
            </tr>
            <?php
            if ($currency_code != "" && $currency_code != Yii::app()->session['currency']) {
                ?>
                <tr class="even">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td  style="text-align:right;"><span>Total In <?php echo $currency_code . "</span> =  " . number_format(ceil($model->currency_amount), 2); ?></td>
                </tr>
                <?php
            }
            ?>
        </tfoot>

    </table>
</div>
