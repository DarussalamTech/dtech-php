<h2 style="font-size: 14px">
    Hi 

    <?php
    echo $customerInfo['shipping_prefix'] . " " . $customerInfo['shipping_first_name'].". ";
    ?>
    Your order has been successfully placed at Darussalam. The details are as in the following:
</h2>
<?php
$model = Order::model()->findByPk($order_id);
$this->renderPartial("//payment/email",array("model"=>$model));
?>
