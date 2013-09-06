<h2>
    Hi 

    <?php
    echo $customerInfo['shipping_prefix'] . " " . $customerInfo['shipping_first_name'];
    ?>

</h2>
<?php
$model = Order::model()->findByPk($order_id);
$this->renderPartial("//payment/email", array("model" => $model));
?>
