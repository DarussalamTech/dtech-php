<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
?>

<div class="row_left_form  row_signup_form" style="min-height: 500px; width: 89%" >

    <div class="billing_address_heading">
        <h2>Billing Address</h2><article><span>*</span>Mandatory Fields</article>
    </div>

    <?php
    echo CHtml::submitButton("Next", array(
        "class" => "secure_button",
        ));

    ?>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_prefix");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php
            echo $form->dropDownList($model, "billing_prefix", array(
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
                echo $form->labelEx($model, "billing_first_name");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->textField($model, 'billing_first_name', array('class' => 'payment_text')); ?>
            <?php echo $form->error($model, 'billing_first_name'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_last_name");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->textField($model, 'billing_last_name', array('class' => 'payment_text')); ?>
            <?php echo $form->error($model, 'billing_last_name'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_address1");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->textField($model, 'billing_address1', array('class' => 'payment_text')); ?>
            <?php echo $form->error($model, 'billing_address1'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_address2");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->textField($model, 'billing_address2', array('class' => 'payment_text')); ?>
            <?php echo $form->error($model, 'billing_address2'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_country");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php
            echo $form->dropDownList($model, 'billing_country', $regionList, array(
                'empty' => 'Please Select Country',
                'ajax' => array(
                    'type' => 'POST',
                    'url' => $this->createUrl('/web/payment/bstatelist'),
                    'update' => '#UserOrderBilling_billing_state'
                )
            ));
            ?>
            <?php echo $form->error($model, 'billing_country'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_state");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->dropDownList($model, 'billing_state', $model->_states); ?>
            <?php echo $form->error($model, 'billing_state'); ?>
        </div>
    </div>

    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_city");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->textField($model, 'billing_city', array('class' => "payment_text")); ?>
            <?php echo $form->error($model, 'billing_city'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_zip");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->textField($model, 'billing_zip', array('class' => "payment_text")); ?>
            <?php echo $form->error($model, 'billing_zip'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_phone");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->textField($model, 'billing_phone', array('class' => 'payment_text')); ?>
            <?php echo $form->error($model, 'billing_phone'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "billing_mobile");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->textField($model, 'billing_mobile', array('class' => 'payment_text')); ?>
            <?php echo $form->error($model, 'billing_mobile'); ?>
        </div>
    </div>
    <div class="secure_input">
        <div class="secure_text">
            <article>
                <?php
                echo $form->labelEx($model, "isSameShipping");
                ?>
            </article>
        </div>
        <div class="secure_input_type">
            <?php echo $form->checkbox($model, 'isSameShipping'); ?>
            <?php echo $form->error($model, 'isSameShipping'); ?>
        </div>
    </div>

</div>
<?php

     if(!$model->hasErrors()){
        Yii::app()->clientScript->registerScript('change_billing_country', "
            jQuery('#UserOrderBilling_billing_country').trigger('change');
       ",  CClientScript::POS_READY);
     }         
?>
