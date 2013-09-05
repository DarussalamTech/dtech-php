<h2>
    Hi 


</h2>
<?php
$model = Order::model()->findByPk(71);
$this->renderPartial("//payment/email",array("model"=>$model));
?>
