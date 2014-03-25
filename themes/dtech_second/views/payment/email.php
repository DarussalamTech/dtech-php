<link href="<?php echo Yii::app()->theme->baseUrl . '/css/printpreview.css' ?>" rel="stylesheet" />
<div class="pading-bottom-5">
    <div class="left_float">
        <h1 style="font-size: 14px;background: white;">Order #<?php echo $model->order_id; ?></h1>
    </div>


</div>
<br/><br/>

<div style="width:100%;">
    <?php
    $this->widget('EmailDetailView', array(
        'data' => $model,
        'htmlOptions' => array("style" => "width:100%"),
        'itemTemplate' => '<tr class=\"{class}\"><th style="text-align:left;border:1px solid ">{label}</th><td style="text-align:left;border:1px solid ">{value}</td></tr>',
        'attributes' => array(
            array(
                'name' => 'user_id',
                'value' => !empty($model->user->user_email) ? $model->user->user_email : "",
            ),
            array(
                'name' => 'transaction_id',
                'value' => $model->transaction_id,
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
            array(
                'name' => 'Order link',
                'type' => 'raw',
                'value' => CHtml::link('Click here', Yii::app()->request->hostInfo . $this->createUrl("/web/user/customerDetail", array("id" => $model->order_id))),
            ),
        ),
    ));
    ?>
</div>

<br/><br/>
<h1 style="font-size: 14px;background: white;">User information</h1>
<div class="clear"></div>
<div style="float: left;width:49%">
    <?php
    /**
     * user information
     */ $this->renderPartial('//payment/_email/_user_billing_information', array(
        'user_id' => $model->user->user_id,
        'order_id' =>$model->order_id,
        'user_name' => $model->user->user_email,
    ));
    ?>
</div>

<div style="float: left;width:49%">
    <?php
    $criteria = new CDbCriteria;
    $criteria->addCondition("user_id = " . $model->user->user_id.' AND order_id ='.$model->order_id);
    $criteria->order = "id DESC";

    $userSHipping = UserOrderShipping::model()->find($criteria);

    /**
     * user information
     */ $this->renderPartial('//payment/_email/_user_shipping_information', array(
        'user_id' => $model->user->user_id,
        'user_name' => $model->user->user_email,
        "model" => $userSHipping,
            ), false, false)
    ?>
</div>
<br/><br/>
<div>
    <?php
    /**
     * product stock
     */ $this->renderPartial('//payment/_email/_order_detail', array(
    'model' => $model,
    'user_name' => $model->user->user_email,
    'currency_code' => isset($userSHipping->country->currency_code) ? $userSHipping->country->currency_code:"",
    ), false, false);
    ?>
</div>

