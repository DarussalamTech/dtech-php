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
$total_price = 0;
?>
<br/><br/>
<h1 style="font-size: 14px">Orders Detail  </h1>
<table>
    <tr>
        <th style="text-align:left;font-size:12px"><?php echo OrderDetail::model()->getAttributeLabel('order_date'); ?></th>
        <th style="text-align:left;font-size:12px"><?php echo OrderDetail::model()->getAttributeLabel('product_name'); ?></th>
        <th style="text-align:left;font-size:12px"><?php echo OrderDetail::model()->getAttributeLabel('quantity'); ?></th>
        <th style="text-align:left;font-size:12px"><?php echo OrderDetail::model()->getAttributeLabel('stock'); ?></th>
        <th style="text-align:left;font-size:12px"><?php echo OrderDetail::model()->getAttributeLabel('book_language'); ?></th>
        <th style="text-align:left;font-size:12px"><?php echo OrderDetail::model()->getAttributeLabel('unit_price'); ?></th>
        <th style="text-align:left;font-size:12px"><?php echo OrderDetail::model()->getAttributeLabel('total_price'); ?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($mName_provider->getData() as $data):
        $total_price+= $data->total_price;
        ?>
        <tr style="background:<?php echo $i%2==0?"white":"#EBEBEB" ?>">
            <td style="text-align:left;font-size:12px"><?php echo $data->order->order_date; ?></td>
            <td style="text-align:left;font-size:12px"><?php echo $data->product_profile->product->product_name; ?></td>
            <td style="text-align:left;font-size:12px"><?php echo $data->quantity; ?></td>
            <td style="text-align:left;font-size:12px"><?php echo $data->stock; ?></td>
            <td style="text-align:left;font-size:12px"><?php echo $data->product_profile->productLanguage->language_name; ?></td>
            <td style="text-align:left;font-size:12px"><?php echo $data->product_price; ?></td>
            <td style="text-align:left;font-size:12px"><?php echo Yii::app()->session['currency'] . " " . number_format($data->total_price, 2); ?></td>
        </tr>
        <?php
        $i++;
    endforeach;
    $final_total = (double) Yii::app()->session['shipping_price'] + (double) $total_price + Yii::app()->session['tax_amount'];
    ?>
    <tfoot style="font-weight:bold">
        <tr style="background:white;">
            <td colspan="7" style="text-align:right;font-size:12px">Shipping = <?php echo Yii::app()->session['currency'] . " " . number_format(Yii::app()->session['shipping_price'], 2); ?></td>
        </tr> 
        <tr  style="background:#EBEBEB;">
            <td colspan="7" style="text-align:right;font-size:12px">Tax = <?php echo Yii::app()->session['currency'] . " " . number_format(Yii::app()->session['tax_amount'], 2); ?></td>
        </tr> 
        <tr style="background:white;">
            <td colspan="7" style="text-align:right;font-size:12px">Total = <?php echo Yii::app()->session['currency'] . " " . number_format($final_total, 2); ?></td>
        </tr> 
        <?php
        if ($currency_code != "" && $currency_code != Yii::app()->session['currency']) {
            $converted_total = ConfPaymentMethods::model()->convertCurrency($final_total, Yii::app()->session['currency'], $currency_code);
            ?>
            <tr style="background:#EBEBEB;">
                <td colspan="7" style="text-align:right;font-size:12px">Total In <?php echo $currency_code." =  " . number_format($converted_total, 2); ?></td>
            </tr>
            <?php
        }
        ?>

    </tfoot>

</table>

