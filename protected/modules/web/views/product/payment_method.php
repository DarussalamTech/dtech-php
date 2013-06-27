<div id="book_content">
    <div id="book_main_content">
        <?php $this->renderPartial("_subheader"); ?>
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
            ?>

            <div class="left_method">
                <h4>Shipping Address</h4>
                <p class="mandatory"><span>*</span> = Mandatory fields</p>
                <div class="under_left_method">
                    <table width="100%">
                       	<tr>
                            <td class="left_prefix"><span>*</span> Prefix</td>
                            <td class="right_prefix"><span>*</span> First Name</td>
                        </tr>
                        <tr>
                            <td class="left_prefix"><select name="shipping_prefix"><option>Mr. </option><option>Mrs. </option></select></td>
                            <td class="right_prefix">
                                <?php echo $form->textField($model, 'shipping_first_name', array('class' => 'small_right_text')); ?>
                                <?php echo $form->error($model, 'shipping_first_name'); ?>
                            </td>
                       	</tr>
                    </table>
                    <p><span>*</span> Last Name</p>
                    <?php echo $form->textField($model, 'shipping_last_name', array('class' => 'payment_text')); ?>
                    <?php echo $form->error($model, 'shipping_last_name'); ?>
                    <p><span>*</span> Address Line 1</p>
                    <?php echo $form->textField($model, 'shipping_address1', array('class' => 'payment_text')); ?>
                    <?php echo $form->error($model, 'shipping_address1'); ?>
                    <p><span>*</span> Address Line 2</p>
                    <?php echo $form->textField($model, 'shipping_address2', array('class' => 'payment_text')); ?>
                    <?php echo $form->error($model, 'shipping_address2'); ?>
                    <p><span>*</span> Country</i></p>
                    <div class="country_option">
                        <?php echo $form->dropDownList($model, 'shipping_country', $regionList,
                                array(
                                    'empty'=>'Please Select Country',
                                    'ajax'=>array(
                                                        'type'=>'POST',
                                                        'url'=>$this->createUrl('/web/product/statelist'),
                                                        'update'=>'#UserProfile_shipping_state'
                                                        )       
                                                )); ?>
                        <?php echo $form->error($model, 'shipping_country'); ?>
                    </div>
                    
                    <p><span>*</span> State / Province</i></p>
                    <div class="country_option">
                        <?php echo $form->dropDownList($model, 'shipping_state', array()); ?>
                        <?php echo $form->error($model, 'shipping_state'); ?>
                    </div>
                    <table width="100%" class="state_table">
                        <tr>
                            <td class="left_state"><span>*</span> City</td>
                            <td class="right_state"><span>*</span> Zip / Postal Code</td>
                        </tr>
                        <tr>
                            <td class="left_state">
                                <?php 
                                echo $form->textField($model, 'shipping_city', array('class' => 'zip_text')); ?>
                                <?php echo $form->error($model, 'shipping_city'); ?>
                            </td>
                            <td class="right_state">
                                <?php echo $form->textField($model, 'shipping_zip', array('class' => 'zip_text')); ?>
                                <?php echo $form->error($model, 'shipping_zip'); ?>
                        </tr>
                    </table>
                    <p><span>*</span> Telephone Number <i>(10 gigits only, no dashes)</i></p>
                    <?php echo $form->textField($model, 'shipping_phone', array('class' => 'payment_text')); ?>
                    <?php echo $form->error($model, 'shipping_phone'); ?>
                </div>
            </div>
            <div class="left_method">
                <h3>Credit Card</h3>
                <div class="under_left_method">
                    <p>We accept Master Card, Visa, Discover and American Express.</p>
                    <p><span>*</span> First Name</p>

                    <?php echo $form->textField($model, 'first_name', array('class' => 'payment_text', 'value' => 'zahid')); ?>
                    <?php echo $form->error($model, 'first_name'); ?>


                    <p><span>*</span> Last Name</p>
                    <?php echo $form->textField($model, 'last_name', array('class' => 'payment_text')); ?>
                    <?php echo $form->error($model, 'last_name'); ?>

                    <p><span>*</span>  Card Number <i>(the 16 digits on the front of the card)</i></p>
                    <?php echo $form->textField($model, 'card_number1', array('class' => 'small_text', 'max-length' => '4', 'error' => "Box one can't be blank")); ?>
                    <?php echo $form->textField($model, 'card_number2', array('class' => 'small_text')); ?>
                    <?php echo $form->textField($model, 'card_number3', array('class' => 'small_text')); ?>
                    <?php echo $form->textField($model, 'card_number4', array('class' => 'small_text')); ?>

                    <?php echo $form->error($model, 'card_number1'); ?>
                    <?php echo $form->error($model, 'card_number2'); ?>
                    <?php echo $form->error($model, 'card_number3'); ?>
                    <?php echo $form->error($model, 'card_number4'); ?>

                    <div class="payment_small_img">
                        <a href="#">
                            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/visa_big_img_03.png', 'Visa', '', array("class" => "visa_img")) ?>
                        </a>
                        <a href="#">
                            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/master_card_big_img_03.png', '', array("class" => "visa_img")) ?>
                        </a>
                        <a href="#">
                            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/discover_big_img_03.png', '', array("class" => "visa_img")) ?>
                        </a>
                        <a href="#">
                            <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/americanexpress_big_img_03.png', 'American Express') ?>
                        </a>
                    </div>

                    <p><span>*</span> CVS or CVS <i>(Last 3 digits on back of card, Amex: 4 gigit code on front)</i></p>

                    <?php echo $form->textField($model, 'cvc', array('class' => 'small2_text')); ?>
                    <?php echo $form->error($model, 'cvc'); ?>
                    <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/card_img_03.png', 'scratch card', array("class" => "card_img")) ?>
                    <p><span>*</span> Expiration Date</p>
                    <div class="payment_option">
                        <p class="monthnyear"> Month </p>
                        <?php
                        $exp_months = array(
                            '01' => '01',
                            '02' => '02',
                            '03' => '03',
                            '04' => '04',
                            '05' => '05',
                            '06' => '06',
                            '07' => '07',
                            '08' => '08',
                            '09' => '09',
                            '10' => '10',
                            '11' => '11',
                            '12' => '12',
                        );
                        echo $form->dropDownList($model, 'exp_month', $exp_months);
                        ?>
                        <span> Year </span>

                        <?php
                        $exp_years = array(
                            '13' => '2013',
                            '14' => '2014',
                            '15' => '2015',
                            '16' => '2016',
                            '17' => '2017',
                            '18' => '2018',
                            '19' => '2019',
                            '20' => '2020',
                        );
                        echo $form->dropDownList($model, 'exp_year', $exp_years);
                        ?>
                    </div>
                </div>
                <div class="paypal">
                    <span>PayPal</span>
                    <a href="<?php echo $this->createUrl('/web/Paypal/buy'); ?>">
                        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/paypal_img_03.png', 'paypal img', array("class" => "paypal_img")) ?>
                    </a>
                </div>
                <div class="under_left_method">
                    <?php echo CHtml::checkBox('checkbox'); ?>
                    <span class="payment_check"> Save your payment method for any future transactions</span>
                </div>
            </div>
            
            <?php echo CHtml::submitButton('continue', array('class' => 'continue')); ?>
<!--            <a href="<?php echo $this->createUrl('/web/product/confirmorder', array('type' => 'card')); ?>">Credit Card</a>-->
            <?php $this->endWidget(); ?>
        </div>
    </div>
