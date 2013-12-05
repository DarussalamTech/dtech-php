<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
?>

    <div class="row_left_form  row_signup_form" style="min-height: 500px; height: 550px" >
       
        <div class="shipping_address_heading">
            <h2>Shipping Address</h2><article><span>*</span>Mandatory Fields</article>
        </div>

        <?php //echo CHtml::submitButton('Submit', array('class' => 'secure_button')); ?>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_prefix");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php
                echo $form->dropDownList($model, "shipping_prefix", array(
                    "Mr." => "Mr.",
                    "Mrs." => "Mrs.",
                    "Ms." => "Ms.",
                ));
                ?>
            </div>
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_first_name");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->textField($model, 'shipping_first_name', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_first_name'); ?>
            </div>
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_last_name");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->textField($model, 'shipping_last_name', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_last_name'); ?>
            </div>
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_address1");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->textField($model, 'shipping_address1', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_address1'); ?>
            </div>
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_address2");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->textField($model, 'shipping_address2', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_address2'); ?>
            </div>
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_country");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
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
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_state");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->dropDownList($model, 'shipping_state', $model->_states); ?>
                <?php echo $form->error($model, 'shipping_state'); ?>
            </div>
        </div>

        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_city");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->textField($model, 'shipping_city', array('class' => "payment_text")); ?>
                <?php echo $form->error($model, 'shipping_city'); ?>
            </div>
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_zip");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->textField($model, 'shipping_zip', array('class' => "payment_text")); ?>
                <?php echo $form->error($model, 'shipping_zip'); ?>
            </div>
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_phone");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->textField($model, 'shipping_phone', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_phone'); ?>
            </div>
        </div>
        <div class="secure_input">
            <div class="secure_text">
                <article>
                    <?php
                    echo $form->labelEx($model, "shipping_mobile");
                    ?>
                </article>
            </div>
            <div class="secure_input_type">
                <?php echo $form->textField($model, 'shipping_mobile', array('class' => 'payment_text')); ?>
                <?php echo $form->error($model, 'shipping_mobile'); ?>
            </div>
        </div>

    </div>
