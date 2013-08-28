<h1>User Address information [<?php echo $user_name ?>]</h1>
<div>
    <?php
    
    $criteria = new CDbCriteria;
    $criteria->addCondition("user_id = ".$user_id);
    $criteria->order = "id DESC";
    
    $model = UserOrderShipping::model()->find($criteria);
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
           
            'shipping_prefix',
            'shipping_first_name',
            'shipping_last_name',
            'shipping_address1',
            'shipping_address2',
            'shipping_country',
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