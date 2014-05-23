<h2>
    Hi 

    <?php
    echo Yii::app()->session['billing_prefix'] . " " . Yii::app()->session['billing_first_name'] . " " . Yii::app()->session['billing_last_name'];
    ?>

</h2>
<?php
$model = Order::model()->findByPk($order_id);

$this->renderPartial("//payment/email", array("model" => $model));
?>
