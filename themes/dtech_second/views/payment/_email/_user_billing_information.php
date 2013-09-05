<h1 style="font-size: 14px">
    <?php
    $criteria = new CDbCriteria;
    $criteria->addCondition("user_id = " . $user_id);
    $criteria->order = "id DESC";

    $model = UserOrderBilling::model()->find($criteria);
    ?>
    Billing Address 

</h1>
<div>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'itemTemplate'=>'<tr class=\"{class}\"><th style="text-align:left;border:1px solid">{label}</th><td style="text-align:left;border:1px solid">{value}</td></tr>',
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

    ?>
</div>
<div class="clear"></div>