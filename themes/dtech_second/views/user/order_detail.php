<div class="heading_cart">
    <h2>Your Order [#<?php echo $model->order_id; ?>]</h2>
    <?php
    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/under_heading_07.png");
    ?>
</div>
<div class="clear"></div>
<div style="">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'cssFile' => Yii::app()->theme->baseUrl . '/css/detailview.css',
        'attributes' => array(
            "order_id",
            array(
                'name' => 'user_id',
                'value' => !empty($model->user->user_email) ? $model->user->user_email : "",
            ),
            array(
                'name' => 'transaction_id',
                'value' => $model->transaction_id,
                'visible' => !empty($model->transaction_id) ? true : false,
            ),
            array('name' => 'status', 'value' => $model->order_status->title),
            'order_date',
            'update_time',
            'total_price',
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
<div class="children_detail">
    <div style="" class="left_billing_detail">
        <?php
        /**
         * user information
         */ $this->renderPartial('//user/_order/_user_billing_information', array(
            'user_id' => $model->user->user_id,
            'user_name' => $model->user->user_email,
        ));
        ?>
    </div>

    <div style="" class="left_shipping_detail">
        <?php
        /**
         * user information
         */ $this->renderPartial('//user/_order/_user_shipping_information', array(
            'user_id' => $model->user->user_id,
            'user_name' => $model->user->user_email,
        ));
        ?>
    </div>
    <div class="clear"></div>
    <div>
        <?php
        /**
         * product stock
         */ $this->renderPartial('//user/_order_detail', array(
            'model' => $model_d,
            'user_name' => $model->user->user_email,
        ));
        ?>
    </div>

</div>

