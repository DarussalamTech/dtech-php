<h1>
    <?php
    $criteria = new CDbCriteria;
    $criteria->addCondition("user_id = " . $user_id);
    $criteria->order = "id DESC";

    $model = UserOrderBilling::model()->find($criteria);
    ?>
    Billing Address 
    <?php
    if (isset($this->OpPermission[ucfirst($this->id) . ".Update"]) && $this->OpPermission[ucfirst($this->id) . ".Update"]) {
        
        echo CHtml::link("Edit", $this->createUrl("updateuseraddress", array(
                    "id" => $model->primaryKey,
                    "model" => "UserOrderBilling",
                )), array('class' => "print_link_btn shipping_billing","id" => $model->primaryKey."-billing"));
    }
    ?>
</h1>
<div>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'billing_prefix',
        'billing_first_name',
        'billing_last_name',
        'billing_address1',
        'billing_address2',
         array(
             'name'=>'billing_country',
             'value'=>isset($model->country->name)?$model->country->name:"",
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