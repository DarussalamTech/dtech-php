<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/contact.css');
?>

<div class="contact_us">
    <div class="left_contact_part">
        <h1>
            <?php echo Yii::t('header_footer', 'Contact Us', array(), NULL, $this->currentLang) ?>
        </h1>
        <div class="contact_field">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'contact-form',
                'enableClientValidation' => FALSE,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>

            <h2><span>*</span><?php echo Yii::t('common', 'Mandatory Fields', array(), NULL, $this->currentLang) ?></h2>
            <?php if (Yii::app()->user->hasFlash('contact'))  ?>
            <div class="flash-success" style="color:green">
                <?php echo '<br/><tt>' . Yii::app()->user->getFlash('contact') . '</tt>'; ?>
            </div>
            <span style="text-align: center; font-size: 11px">
                <?php echo $form->errorSummary($model); ?>
            </span>
            <div class="contact_form">
                <p><?php echo $form->labelEx($model, 'email'); ?></p>
                <?php echo $form->textField($model, 'email', array('class' => 'form_name')); ?>
            </div>
            <div class="contact_form">
                <p><?php echo $form->labelEx($model, 'name'); ?></p>
                <?php echo $form->textField($model, 'name', array('class' => 'form_name')); ?>
            </div>
            <div class="contact_form">
                <p> <?php echo $form->labelEx($model, 'subject'); ?></p>
                <?php echo $form->textField($model, 'subject', array('class' => 'form_name')); ?>
            </div>
            <div class="contact_form">
                <p> <?php echo $form->labelEx($model, 'message_type'); ?></p>
                <?php echo $form->dropDownList($model, 'message_type', array('Suggession'=>'Suggestion','Enquiry'=>'Enquiry', 'Complaint'=>'Complaint'), array('options' => array('Suggestion' => array('selected' => true)))); ?>
            </div>
            <div class="contact_form">
                <p><?php echo $form->labelEx($model, 'body'); ?></p>
                <?php echo $form->textArea($model, 'body', array('rows' => 5, 'cols' => 31, 'style' => 'resize:none')); ?>

            </div>
            <div class="contact_form">
                <?php if (CCaptcha::checkRequirements()): ?>

                    <p><?php echo $form->labelEx($model, 'verifyCode'); ?></p>
                    <?php $this->widget('CCaptcha', array('buttonLabel' => 'Refresh Code', 'buttonType' => 'link')); ?>

                <?php endif; ?>
            </div>
            <div class="contact_form">
                <p style="font-size: 9px">Please enter the letters  shown in the above image</p>
                <?php echo $form->textField($model, 'verifyCode', array('class' => 'form_name')); ?>
            </div>
            <div class="contact_form">
                <p><?php echo $form->labelEx($model, 'customer_copy_check'); ?></p>
                <?php echo $form->checkBox($model, 'customer_copy_check'); ?>
                <?php echo CHtml::submitButton(Yii::t('common', 'Submit', array(), NULL, $this->currentLang), array('class' => 'submit_btn')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="contact_info">
            <div class="business_contact">
                <article>General Information</article>
                <section>
                    <span><?php echo CHtml::mailto("info@darussalampublishers.com", "info@darussalampublishers.com");?></span>
                    <span><?php echo CHtml::mailto("webmaster@darussalampk.com", "webmaster@darussalampk.com");?></span> 
                </section>
            </div>
            <div class="business_contact">
                <article>Careers</article>
                <section>
                    <?php
                    echo CHtml::mailto("jobs@darussalampk.com", "jobs@darussalampk.com");
                    ?>
                </section>
            </div>
            <div class="business_contact">
                <article>Support</article>
                <section>
                    <?php
                    echo CHtml::mailto("support@darussalampk.com", "support@darussalampk.com");
                    ?>
                </section>
            </div>
        </div>
    </div>
    <div class="right_contact_part">
        <div class="countries_contact">
            <h3>Pakistan</h3>
            <h3>Head Office</h3>
            <p>Darussalam, 36 Lower Mall, Secretariat Stop, Lahore, Pakistan</p>
            <p>Tel: +92-042-37240024, 37232400, 37111023, 37110081</p>
            <p>Fax: +92-042- 37354072</p>
        </div>
        <div class="countries_contact">
            <h3>Kingdom Of Saudi Arabia</h3>
            <h3>Riyadh</h3>
            <p>Olaya Branch:</p>
            <p>Tel: 00966-1-4614483</p>
            <p>Fax: 00966-1-4644945</p>
        </div>
        <div class="countries_contact">
            <h3>U.A.E</h3>
            <p>Darussalam, Sharjah U.A.E</p>
            <p>Tel: 00971-6-5632623</p>
            <p>Fax: 00971-6-5632624</p>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        /*
         * snippet to clear the 
         * captcha value when 
         * validation failed..ubd
         */
        jQuery("#ContactForm_verifyCode").val("");
    })
    window.onload = function() {
        /*
         * code to change the captcha value on each page refresh after page load
         */
        jQuery('#yw0_button').trigger('click');
    }
</script>