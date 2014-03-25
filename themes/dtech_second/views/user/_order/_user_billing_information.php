<h3>
    <?php
    $criteria = new CDbCriteria;
    $criteria->addCondition("user_id = " . $user_id . " AND order_id =" . $order_id);
    $criteria->order = "id DESC";
    ?>
    Billing Address 

</h3>
<div>
<?php
if ($model = UserOrderBilling::model()->find($criteria)) {

    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'cssFile' => '',
        'attributes' => array(
            'billing_prefix',
            'billing_first_name',
            'billing_last_name',
            'billing_address1',
            'billing_address2',
            array(
                'name' => 'billing_country',
                'value' => isset($model->country->name) ? $model->country->name : "",
            ),
            'billing_state',
            'billing_city',
            'billing_zip',
            'billing_phone',
            'billing_mobile',
        ),
    ));
}
?>
</div>
<div class="clear"></div>