<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="left_method">
    <h4>Shipping Address</h4>
    <p class="mandatory"><span>*</span> = Mandatory fields</p>
    <div class="under_left_method">

        <p><span>*</span>Payment Method</p>
        <?php
        $criteria = new CDbCriteria();
        $criteria->select = "id,name";
        $paymentMethods = ConfPaymentMethods::model()->findAll();
        ?>
        <?php
        echo $form->dropDownList($model, 'payment_method', array("" => "Select") +
                CHtml::listData($paymentMethods, "id", "name"), array("onchange" => "dtech.showPaymentMethods(this)")
        );
        ?>
        <?php echo $form->error($model, 'payment_method'); ?>

        <table width="100%">
            <tr>
                <td class="left_prefix"><span>*</span> Prefix</td>
                <td class="right_prefix"><span>*</span> First Name</td>
            </tr>
            <tr>
                <td class="left_prefix">
                    <?php
                    echo $form->dropDownList($model, "shipping_prefix", array(
                        "Mr." => "Mr.",
                        "Mrs." => "Mrs.",
                        "Ms." => "Ms.",
                    ));
                    ?>
                </td>
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

        <p><span>*</span> State / Province</i></p>
        <div class="country_option">
            <?php echo $form->dropDownList($model, 'shipping_state', $model->_states); ?>
            <?php echo $form->error($model, 'shipping_state'); ?>
        </div>
        <table width="100%" class="state_table">
            <tr>
                <td class="left_state"><span>*</span> City</td>
                <td class="right_state"><span>*</span> Zip / Postal Code</td>
            </tr>
            <tr>
                <td class="left_state">
                    <?php echo $form->textField($model, 'shipping_city', array('class' => 'zip_text')); ?>
                    <?php echo $form->error($model, 'shipping_city'); ?>
                </td>
                <td class="right_state">
                    <?php echo $form->textField($model, 'shipping_zip', array('class' => 'zip_text')); ?>
                    <?php echo $form->error($model, 'shipping_zip'); ?>
            </tr>
        </table>
        <p><span>*</span> Phone No <i>(10 digits only, no dashes)</i></p>
        <?php echo $form->textField($model, 'shipping_phone', array('class' => 'payment_text')); ?>
        <?php echo $form->error($model, 'shipping_phone'); ?>
    </div>
</div>
