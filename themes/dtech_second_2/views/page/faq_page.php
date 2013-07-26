<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/accordion.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.accordion.2.0.js');

$this->webPcmWidget['filter'] = array('name' => 'DtechSecondSidebar',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 1,
        ));

$this->webPcmWidget['best'] = array('name' => 'DtechBestSelling',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 0,
        ));
?>
<div id="faq">
    <div id="faq_end">
        <div id="right_faq">
            <h5>FAQ's</h5>
            <article>Welcome! How can we help you?</article>
            <div id="accordion" style=" float:left; width:100%; padding: 0; margin: 20px 0;">
                <div id="faq_page">
                    <ul id="example4" class="accordion">
                        <li style=" padding: 0; margin: 5px 0;">
                            <h3>
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quetions_mark_03.jpg", '', array('style' => 'padding: 0 5px 0 5px; margin: 0 0 -8px 0; position:relative;')); ?>
                                How to Order?
                            </h3>
                            <div class="panel loading">
                                <p style="padding: 0 20px 20px 55px; margin: 0; color:#4A4A4A; font-size:14px; text-align:justify;">
                                    Placing an order with Darussalam Islamic Bookstore is quick and easy. There's no need to create an account first. You automatically create an account when you place your first order online.
                                </p>
                            </div>
                        </li>
                        <li style=" padding: 0; margin: 5px 0;">
                            <h3>
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quetions_mark_03.jpg", '', array('style' => 'padding: 0 5px 0 5px; margin: 0 0 -8px 0; position:relative;')); ?>
                                How to Pay (Payment Methods) ?
                            </h3>
                            <div class="panel loading">
                                <p style="padding: 0 20px 20px 55px; margin: 0; color:#4A4A4A; font-size:14px; text-align:justify;">
                                    1- Cash on Delivery (COD)
                                    2- Bank Transfer/Bank Draft
                                    3- Paypal Accounts
                                    4- Credit Cards
                                    5- Money Order/Cheques/Demand Drafts
                                </p>
                            </div>
                        </li>
                        <li style=" padding: 0; margin: 5px 0;">
                            <h3>
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quetions_mark_03.jpg", '', array('style' => 'padding: 0 5px 0 5px; margin: 0 0 -8px 0; position:relative;')); ?>
                                Shipment ?
                            </h3>
                            <div class="panel loading">
                                <p style="padding: 0 20px 20px 55px; margin: 0; color:#4A4A4A; font-size:14px; text-align:justify;">
                                    1- DHL DHL offers integrated services and tailored, customer-focused solutions for managing and transporting letters, goods and information. DHL's international network links more than 220 countries and territories worldwide.
                                    2- UPS UPS, or United Parcel Service Inc., is a global company with one of the most recognized and admired brands in the world. As the largest express carrier and package Delivery Company in the world.
                                </p>
                            </div>
                        </li>
                        <li style=" padding: 0; margin: 5px 0;">
                            <h3>
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quetions_mark_03.jpg", '', array('style' => 'padding: 0 5px 0 5px; margin: 0 0 -8px 0; position:relative;')); ?>
                                Privacy Policy
                            </h3>
                            <div class="panel loading">
                                <p style="padding: 0 20px 20px 55px; margin: 0; color:#4A4A4A; font-size:14px; text-align:justify;">
                                    This privacy policy sets out how Darussalam KSA uses and protects any information that you give Darussalam KSA when you use this website. Darussalam KSA is committed to ensuring that your privacy is protected. Should we ask you to provide certain information by which you can be identified when using this website, then you can be assured that it will only be used in accordance with this privacy statement. Darussalam KSA may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you are happy with any changes.
                                </p>
                            </div>
                        </li>
                        <li style=" padding: 0; margin: 5px 0;">
                            <h3>
                                <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/quetions_mark_03.jpg", '', array('style' => 'padding: 0 5px 0 5px; margin: 0 0 -8px 0; position:relative;')); ?>
                                Help Desk
                            </h3>
                            <div class="panel loading">
                                <p style="padding: 0 20px 20px 55px; margin: 0; color:#4A4A4A; font-size:14px; text-align:justify;">
                                    Darussalam would be more than happy to assist you with any questions that you might have. Kindly fill the form below and send it to us with the reason. Someone from Darussalam will get back to you as soon as possible.
                                </p>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#example1, #example3').accordion();
    $('#example2').accordion({
        canToggle: true
    });
    $('#example4').accordion({
        canToggle: true,
        canOpenMultiple: true
    });
    $(".loading").removeClass("loading");
</script>