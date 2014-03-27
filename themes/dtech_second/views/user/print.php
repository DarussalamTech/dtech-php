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
            array(
                'name' => 'transaction_id',
                'value' => '$data->transaction_id',
                'visible' => !empty($model->transaction_id) ? true : false
            ),
            array('name' => 'status', 'value' => $model->order_status->title),
            'order_date',
            'update_time',
            'total_price',
            'shipping_price',
            array('name' => 'currency', 'value' => Yii::app()->session["currency"]),
            array(
                'name' => 'payment_method_id',
                'value' => !empty($model->paymentMethod->name) ? $model->paymentMethod->name : "",
            ),
        ),
    ));
    ?>
</div>


<div class="clear"></div>
<h1>User information</h1>
<div class="clear"></div>
<div style="float: left;width:49%">
    <?php
    /**
     * user information
     */
    $this->renderPartial('//user/_print/_user_billing_information', array(
        'user_id' => $model->user->user_id,
        'user_name' => $model->user->user_email,
        "order_id" => $model->order_id
    ));
    ?>
</div>

<div style="float: left;width:49%">
    <?php
    /**
     * user information
     */
    $criteria = new CDbCriteria;
    $criteria->addCondition("user_id = " . $model->user->user_id . " AND order_id = " . $model->order_id);
    $criteria->order = "id DESC";

    $shipping = UserOrderShipping::model()->find($criteria);


    $this->renderPartial('//user/_print/_user_shipping_information', array(
        'user_id' => $model->user->user_id,
        'user_name' => $model->user->user_email,
        "order_id" => $model->order_id,
        "model" => $shipping,
            ), false, false);
    ?>
</div>
<div class="clear"></div>
<div>
    <?php
    /**
     * product stock
     */
    $this->renderPartial('//user/_print/_order_detail', array(
        'model' => $model,
        'user_name' => $model->user->user_email,
         'currency_code' => isset($shipping->country->currency_code) ? $shipping->country->currency_code:"",
            ), false, false);
    ?>
</div>

