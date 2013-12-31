<link href="<?php echo Yii::app()->theme->baseUrl . '/css/printpreview.css' ?>" rel="stylesheet" />
<div class="pading-bottom-5">
    <div class="left_float">
        <h1>Order #<?php echo $model->order_id; ?></h1>
    </div>


</div>
<div class="clear"></div>

<div style="width:50%;float:left">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            array(
                'name' => 'user_id',
                'value' => !empty($model->user->user_email) ? $model->user->user_email : "",
            ),
            'transaction_id',
            array('status', 'value' => $model->order_status->title),
            'order_date',
            'update_time',
            'total_price',
            'shipping_price',
            'tax_amount',
            'grand_price',
            array('name' => 'currency', 'value' => Yii::app()->session["currency"]),
            array(
                'name' => 'payment_method_id',
                'value' => !empty($model->paymentMethod->name) ? $model->paymentMethod->name : "",
            ),
        ),
    ));
    ?>
</div>
<div style="width:50%;float:left">
    <?php
    /**
     * if allow update 
     */
    echo $this->renderPartial("print/_order_status_grid", array("model" => $model), true, false);
    ?>
</div>

<div class="clear"></div>
<h1>User information</h1>
<div class="clear"></div>
<div style="float: left;width:49%">
    <?php
    /**
     * user information
     */ $this->renderPartial('print/_user_billing_information', array(
        'user_id' => $model->user->user_id,
        'user_name' => $model->user->user_email,
    ));
    ?>
</div>

<div style="float: left;width:49%">
    <?php
    /**
     * user information
     */ $this->renderPartial('print/_user_shipping_information', array(
        'user_id' => $model->user->user_id,
        'user_name' => $model->user->user_email,
            ), false, false)
    ?>
</div>
<div class="clear"></div>
<?php
$footer_str = '<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    <td style="text-align: left;font-weight:bold">
        Shipping Total : ' . $model->shipping_price . ' '.Yii::app()->session['currency']. '
    </td>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

    <td style="text-align: left;font-weight:bold">
        Shipping Total : ' . $model->tax_amount . ' '.Yii::app()->session['currency']. '
    </td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>

  
    <td style="text-align: left;font-weight:bold">
          Grand Total : ' . $model->grand_price . ' '.Yii::app()->session['currency']. '
    </td>
</tr>';
?>
<div>
    <?php
    /**
     * product stock
     */ $this->renderPartial('print/_order_detail', array(
        'model' => $model,
        'footer_str' => $footer_str,
        'user_name' => $model->user->user_email,
            ), false, false);
    ?>
</div>

<div  class='clear'></div>


