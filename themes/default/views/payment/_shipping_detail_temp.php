<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="left_method full_method">
    <h4>Shipping Address</h4>
    <p class="mandatory"><span>*</span> = Mandatory fields</p>
    <div class="under_left_method">

        <?php
        echo $form->hiddenField($model, 'payment_method', array("value" => "3"));
        ?>


        <div class="country_option">
            <p><span>*</span> Prefix</p>
            <div class="country_option">
                <?php
                echo $form->dropDownList($model, "shipping_prefix", array(
                    "Mr." => "Mr.",
                    "Mrs." => "Mrs.",
                    "Ms." => "Ms.",
                ));
                ?>

            </div>
            <p><span>*</span> First Name</p>
            <div class="country_option">
                <?php echo $form->textField($model, 'shipping_first_name', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_first_name'); ?>
            </div>
            <p><span>*</span> Last Name</p>
            <div class="country_option">
                <?php echo $form->textField($model, 'shipping_last_name', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_last_name'); ?>
            </div>

            <p><span>*</span> Address Line 1</p>
            <div class="country_option">
                <?php echo $form->textField($model, 'shipping_address1', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_address1'); ?>
            </div>


            <p><span>*</span> Address Line 2</p>
            <div class="country_option">
                <?php echo $form->textField($model, 'shipping_address2', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_address2'); ?>

            </div>

            <p><span>*</span> <i>Country</i></p>
            <div class="country_option">
                <?php
                echo $form->dropDownList($model, 'shipping_country', $regionList, array(
                    'empty' => 'Please Select Country',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => $this->createUrl('/web/payment/statelist'),
                        'update' => '#ShippingInfoForm_shipping_state'
                    )
                ));
                ?>
                <?php echo $form->error($model, 'shipping_country'); ?>
            </div>

            <p><span>*</span> State / Province</p>
            <div class="country_option">
                <?php echo $form->dropDownList($model, 'shipping_state', $model->_states); ?>
                <?php echo $form->error($model, 'shipping_state'); ?>
            </div>

            <p><span>*</span> City</p>
            <div class="country_option">
                <?php echo $form->textField($model, 'shipping_city', array('class' => "payment_text")); ?>
                <?php echo $form->error($model, 'shipping_city'); ?>
            </div>
            <p><span>*</span> Zip / Postal Code</p>
            <div class="country_option">
                <?php echo $form->textField($model, 'shipping_zip', array('class' => "payment_text")); ?>
                <?php echo $form->error($model, 'shipping_zip'); ?>
            </div>
            <p><span>*</span> Telephone Number <i>(10 digits only, no dashes)</i></p>
            <div class="country_option">
                <?php echo $form->textField($model, 'shipping_phone', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_phone'); ?>
            </div>



        </div>
    </div>
