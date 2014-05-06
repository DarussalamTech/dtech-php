<h1 style="font-size: 14px">
    <?php
    $criteria = new CDbCriteria;
    $criteria->addCondition("user_id = " . $user_id);
    $criteria->order = "id DESC";

    $model = UserOrderShipping::model()->find($criteria);
    ?>
    Shipping information

</h1>
<div>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'itemTemplate'=>'<tr class=\"{class}\"><th style="text-align:left;border:1px solid">{label}</th><td style="text-align:left;border:1px solid">{value}</td></tr>',
        'attributes' => array(
            'shipping_prefix',
            'shipping_first_name',
            'shipping_last_name',
            'shipping_address1',
            'shipping_address2',
            array(
                'name' => 'shipping_country',
                'value' => isset($model->country->name) ? $model->country->name : "",
            ),
            'shipping_state',
            'shipping_city',
            'shipping_zip',
            'shipping_phone',
            'shipping_mobile',
        ),
    ));
    ?>
</div>
<div class="clear"></div>