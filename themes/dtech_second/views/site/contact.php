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
            <span style="text-align: center; font-size: 12px">
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
                <p><?php echo $form->labelEx($model, 'body'); ?></p>
                <?php echo $form->textArea($model, 'body', array('rows' => 5, 'cols' => 31, 'style' => 'resize:none')); ?>

            </div>
            <?php if (CCaptcha::checkRequirements()): ?>
                <div class="contact_form">
                    <p><?php echo $form->labelEx($model, 'verifyCode'); ?></p>
                    <?php $this->widget('CCaptcha', array('buttonLabel' => 'Refresh Code', 'buttonType' => 'link')); ?>
                    <?php echo $form->textField($model, 'verifyCode', array('class' => 'form_name')); ?>

                    <p>
                        Please enter the letters  shown in the image above.
                    </p>
                    <?php echo CHtml::submitButton(Yii::t('common', 'Submit', array(), NULL, $this->currentLang), array('class' => 'submit_btn')); ?>
                </div>
            <?php endif; ?>

            <?php $this->endWidget(); ?>
        </div>
        <div class="contact_info">
            <div class="business_contact">
                <article>Business Development</article>
                <section>
                    <?php
                    echo CHtml::mailto("bizdev@darussalam.com", "bizdev@darussalam.com")
                    ?>
                </section>
            </div>
            <div class="business_contact">
                <article>Careers</article>
                <section>
                    <?php
                    echo CHtml::mailto("jobs@darussalam.com", "jobs@darussalam.com")
                    ?>
                </section>
            </div>
            <div class="business_contact">
                <article>Public Relations</article>
                <section>
                    <?php
                    echo CHtml::mailto("public@darussalam.com", "public@darussalam.com")
                    ?>
                </section>
            </div>
            <div class="business_contact">
                <article>Sales, Billing and Support</article>
                <section>
                    <?php
                    echo CHtml::mailto("support@darussalam.com", "support@darussalam.com")
                    ?>
                </section>
            </div>
        </div>
    </div>
    <div class="right_contact_part">
        <div class="countries_contact">
            <h3>Pakistan</h3>
            <h3>Head Office</h3>
            <p>P.O. Box: 22743, Riyadh 11416 K.S.A.</p>
            <p>Tel: 00966-1-4033962/4043432</p>
            <p>Fax: 4021659</p>
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
    window.onload = function() {
        /*
         * code to change the captcha value on each page refresh after page load
         */
        jQuery('#yw0_button').trigger('click');
    }
</script>