<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
?>
<div id="login_content">


    <div class="secure_form">
        <?php if (Yii::app()->user->hasFlash('orderMail')) { ?>
            <div class="payment_method_big_img">
                <?php
                echo CHtml::image(Yii::app()->theme->baseUrl . "/images/place-order3.png", 'Payment_method', array('class' => "payment_method_big_img"));
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
                    <section><?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/tick_payment_img_03.png'); ?></section>
                    <span>Personal Information</span>
                    <h5>Billing Address</h5>
                    <h2>Shipping Address.</h2>
                </div>
            </div>
        <?php } ?>
        <div class="confirm_order">

            <?php if (Yii::app()->user->hasFlash('orderMail')) { ?>
                Your order has been placed successfully....
                <div class="flash-success" style="color:green">
                    <?php echo '<br/><tt>' . Yii::app()->user->getFlash('orderMail') . '</tt>'; ?>
                </div>
                <?php
            } else {
                echo "Nothing has been Ordered ";
                echo CHtml::link("Home Page", $this->createUrl("/site/storeHome"));
            }
            ?>
        </div>
    </div>

</div>

