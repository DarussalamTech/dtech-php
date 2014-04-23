<h1>
    <?php
  
    ?>
    Shipping information
    <?php
    if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
        ColorBox::generate("shipping_billing");
        echo CHtml::link("Edit", $this->createUrl("updateuseraddress", array("id" => $model->primaryKey,
                    "model" => "UserOrderShipping"
                )), array(
            'class' => "print_link_btn shipping_billing",
           
        ));
    }
    ?>
</h1>
<div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'shipping_prefix',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_address1',
        'shipping_address2',
         array(
             'name'=>'shipping_country',
             'value'=>isset($model->country->name)?$model->country->name:"",
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