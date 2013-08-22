<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
?>
<div id="login_content">


    <div class="secure_form">
        <div class="payment_method_big_img">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/place_order_img_03.png", 'Payment_method', array('class' => "payment_method_big_img"));
            ?>
        </div>
        <div class="secure_payment">
            <div class="secure_heading">
                <h1>Secure Payment</h1>
                <p>This is a secure 128 bit SSL encrypter payment</p>
            </div>
            <div class="payment_bg">
                <article><?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/tick_payment_img_03.png'); ?></article>
                <section><?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/tick_payment_img_03.png'); ?></section>
                <h3>3</h3>
                <span>Personal Information</span>
                <h5>Billing Address</h5>
                <h2>Shipping Address.</h2>
            </div>
        </div>

        <div class="confirm_order">
            
            <?php if (Yii::app()->user->hasFlash('orderMail')) { ?>
                Your Order has  successfully completed....
                <div class="flash-success" style="color:green">
                    <?php echo '<br/><tt>' . Yii::app()->user->getFlash('orderMail') . '</tt>'; ?>
                </div>
            <?php }
                else {
                    echo  "Nothing has been Ordered ";
                    echo CHtml::link("Home Page",$this->createUrl("/site/storeHome"));
                }
            ?>
        </div>
    </div>

</div>
<style>
    .credit_card_fields,.pay_list,.manual_list{
        display: none;
    }
    <?php
    if ($model->payment_method == "Credit Card") {
        echo ".credit_card_fields{display:block;}";
    }
    ?>
</style>
