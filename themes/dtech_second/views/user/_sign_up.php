<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/media/css/password_strength.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/media/js/password_strength_plugin.js');
?>
<script>
    jQuery(function() {
        jQuery(".password_test").passStrength({
            userid: "#User_user_name"
        });
    })

</script>    
<div class="form_container">
    <div class="row_left_form row_center_form row_signup_form" style="min-height: 430px;" >
        <?php
        if (Yii::app()->user->hasFlash('hybrid')) {
            ?>
            <div class="flash-done">
                <?php echo Yii::app()->user->getFlash('hybrid'); ?>
            </div>

        <?php } ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableClientValidation' => false,
        ));
        ?>
        <div class="shipping_address_heading">
            <h2>
                <?php echo Yii::t('common', 'Create Your Account', array(), NULL, $this->currentLang) ?>
            </h2>
            <div class="clear"></div>
            <article><span>*</span>
                <?php echo Yii::t('common', 'Mandatory Fields', array(), NULL, $this->currentLang) ?>
            </article>
        </div>
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Sign Up' : 'Save', array('class' => 'row_button')); ?>

        <div class="row_input">
            <div class="row_text">
                <article></article>
            </div>
            <div class="row_input_type">
                <div class="errorSummary-custom">
                    <?php echo $form->errorSummary($model); ?>
                </div>
            </div>

        </div>

        <div class="row_input">
            <div class="row_text">
                <article><?php echo $form->labelEx($model, 'user_name'); ?></article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'user_name', array('class' => 'row_text_type')); ?>
            </div>
            <div class="row_text">
                <article><?php // echo $form->error($model, 'user_name');           ?></article>
            </div>
        </div>

        <div class="row_input">
            <div class="row_text">
                <article><?php echo $form->labelEx($model, 'user_email'); ?></article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'user_email', array('class' => 'row_text_type')); ?>
            </div>
            <div class="row_text">
                <article><?php //echo $form->error($model, 'user_email');           ?></article>
            </div>
        </div>

        <div class="row_input">
            <div class="row_text">
                <article><?php echo $form->labelEx($model, 'user_password'); ?></article>
            </div>
            <div class="row_input_type">
                <?php echo $form->passwordField($model, 'user_password', array('class' => 'row_text_type password_test')); ?>
                <?php //echo $form->passwordField($model, 'user_password', array('class' => 'row_text_type', 'onKeyUp' => 'javascript:validata_password(this.value)')); ?>
            </div>
            <div class="row_text">
                <article><?php //echo $form->error($model, 'user_password');           ?></article>
            </div>
        </div>

        <div class="row_input">
            <div class="row_text">
                <article><?php echo $form->labelEx($model, 'user_password2'); ?></article>
            </div>
            <div class="row_input_type">
                <?php echo $form->passwordField($model, 'user_password2', array('class' => 'row_text_type')); ?>
            </div>
            <div class="row_text">
                <article><?php //echo $form->error($model, 'user_password2');           ?></article>
            </div>
        </div>

        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo Yii::t('common', 'Special Offers', array(), NULL, Yii::app()->controller->currentLang); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php
                echo $form->checkBox($model, 'special_offer');
                ?>
                <span style="color:#3b3b3b; font-size:12px;">
                    <?php echo Yii::t('common', 'Email me for new and special offers from Darussalam', array(), NULL, $this->currentLang); ?>

                </span>
            </div>
            <div class="row_text">
                <article><?php // echo $form->error($model, 'special_offer');           ?></article>
            </div>
        </div>

        <div class="row_input">
            <div class="row_text">
                <article><?php echo $form->labelEx($model, 'agreement_status'); ?>*</article>
            </div>
            <div class="row_input_type">
                <?php echo $form->checkBox($model, 'agreement_status'); ?>
                <span style="color:#3b3b3b; font-size:12px;">
                    <?php echo Yii::t('common', "I agree with Darussalam's Website Terms and conditions", array(), NULL, Yii::app()->controller->currentLang); ?>

                </span>
            </div>
            <div class="row_text">
                <article><?php // echo $form->error($model, 'agreement_status');           ?></article>
            </div>
        </div>
        <div class="row_input">
            <div class="row_input_type">
                <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('header_footer', 'Sign Up', array(), NULL, $this->currentLang) : 'Save', array('class' => 'row_button')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script>
    function validata_password()
    {
        dtech.custom_alert('Quantity should be Numeric....!');
    }
</script>