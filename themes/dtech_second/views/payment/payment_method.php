<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
?>
<div id="login_content">


    <div class="secure_form">
        <div class="payment_method_big_img">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . "/images/payment_method_big_img_03.png", 'Payment_method', array('class' => "payment_method_big_img"));
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
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'card-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => false,
            ),
        ));

        /**
         * fetching information from system that city has open paypall and other information method
         * 
         */
        echo '<div class="form_container">';
        $criteria = new CDbCriteria();
        $criteria->select = "name,status";
        $criteria->addInCondition("name", array("Cash On Delievery", "Pay Pal", "Credit Card"));
        $criteria->addCondition("status ='Enable'");

        if ($paymentMehtods = ConfPaymentMethods::model()->findAll($criteria)) {
            $this->renderPartial("//payment/_shipping_detail", array("model" => $model, "regionList" => $regionList, "form" => $form));
        } else {
            $this->renderPartial("//payment/_shipping_detail_temp", array("model" => $model, "regionList" => $regionList, "form" => $form));
        }

        $this->renderPartial("//payment/_payment_methods", array("model" => $model, "form" => $form, "creditCardModel" => $creditCardModel, "paymentMehtods" => $paymentMehtods));


        echo '</div>';

        $this->endWidget();
        ?>

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
