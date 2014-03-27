<?php
/* @var $this UserController */
/* @var $model User */

$user_id = Yii::app()->user->id;
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
            'currencySymbol' => Yii::app()->session['currency'],
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
<div class="grid-view">
    <table class="items">
        <tfoot>
            <tr class="even">
                <td style="text-align: right"><span>Shipping : </span><?php echo $model->order->shipping_price." ".Yii::app()->session['currency']; ?></td>
            </tr>
            <tr class="even">
                <td style="text-align: right"><span>Tax : </span><?php echo $model->order->tax_amount." ".Yii::app()->session['currency']; ?></td>
            </tr>
            <tr class="odd">
                <td style="text-align: right"><span>Grand Total: </span><?php echo number_format((double) $model->order->total_price + (double) $model->order->shipping_price + (double) $model->order->tax_amount, 2)." ".Yii::app()->session['currency']; ?></td>
            </tr>
            <?php
            if ($currency_code != "" && $currency_code != Yii::app()->session['currency']) {
                $final_total = (double) $model->order->total_price + (double) $model->order->shipping_price + (double) $model->order->tax_amount;
              
               
                ?>
                <tr class="even">
                    <td  style="text-align:right;"><span>Total In <?php echo $currency_code . "</span> =  " . number_format(ceil($model->order->currency_amount), 2); ?></td>
                </tr>
                <?php
            }
            ?>
        </tfoot>

    </table>
</div>
