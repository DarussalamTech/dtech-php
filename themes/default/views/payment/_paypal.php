<div class="paypal pay_list">
    <h3>PayPal</h3>
    <a href="<?php echo $this->createUrl('/web/Paypal/buy'); ?>" style="display:none"  >
        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/paypal_img_03.png', 'paypal img', array("class" => "paypal_img")) ?>
    </a>
</div>
<div class="under_left_method pay_list" >
    <?php echo CHtml::checkBox('checkbox'); ?>
    <span class="payment_check"> Save your payment method for any future transactions</span>
</div>