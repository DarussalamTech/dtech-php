

<div id="book_content">
    <div id="book_main_content">
        <?php $this->renderPartial("/product/_subheader"); ?>
    </div>
</div>
<div id="payment_method">
    <div id="main_payment_method">
        <div class="top_payment_method">
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/payment_method_img_03.png', 'payment_method') ?>
        </div>
        <div class="middle_payment_method">
            <div class="left_middle_payment_method">
                <h1>Secure Payments</h1>
                <h2>This is a secure 128 bit SSL encrypted payment</h2>
            </div>
            <div class="right_middle_payment_method">
                <a href="#">
                    <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/norton_secured_img_03.png', 'norton_secured') ?>
                </a>
            </div>
        </div>
        <?php
        if ($error['status']) {
            ?>
            <div class="middle_payment_method">
                <div class="left_middle_payment_method">
                    <?php echo $error['message']; ?>
                </div>
            </div>
        <? } ?>
        <div class="bottom_payment_method">
<!--                <form method="POST" action="<?php echo $this->createUrl('/web/Paypal/directpayment'); ?>">-->
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'card-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));

            $this->renderPartial("_shipping_detail", array("model" => $model,"regionList"=>$regionList,"form"=>$form));
            $this->renderPartial("_payment_methods", array("model" => $model,"form"=>$form));
            ?>

            <?php echo CHtml::submitButton('continue', array('class' => 'continue')); ?>
<!--            <a href="<?php echo $this->createUrl('/web/payment/confirmorder', array('type' => 'card')); ?>">Credit Card</a>-->
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <?php
    Yii::app()->clientScript->registerScript('trigger_country', '
           //jQuery(function(){
        
           //jQuery("#CreditCardForm_shipping_country").trigger("change");   
          
   // })


        ', CClientScript::POS_READY);
    ?>