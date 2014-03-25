<h3>
    <?php
    
    ?>
    Shipping information

</h3>
<div>
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'cssFile' => '',
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