<?php
$this->webPcmWidget['filter'] = array('name' => 'DtechSecondSidebar',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 1,
        ));
?>
<?php
$this->webPcmWidget['best'] = array('name' => 'DtechBestSelling',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 0,
        ));
?>


<div id="login_content">
    <div class="payment_method_big_img">
        <?php
        echo CHtml::image(Yii::app()->theme->baseUrl . "/images/payment_method_big_img_03.png", 'norton_secured', array('class' => "payment_method_big_img"));
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
    <div class="secure_form">
        <?php
        
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'card-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => false,
            ),
        ));

        $this->renderPartial("//payment/_shipping_detail_temp", array("model" => $model, "regionList" => $regionList, "form" => $form));
        $this->renderPartial("//payment/_payment_methods", array("model" => $model, "form" => $form, "creditCardModel" => $creditCardModel));
     
        $this->endWidget();
        ?>

    </div>
</div>
