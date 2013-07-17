<div id="user_login">
    <div id="main_user_login">
        <?php
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
       
        ?>
     
        <div class="form_container">
            <div class="row_left_form row_center_form row_signup_form" style="min-height: 200px;" >
                <?php
                if (Yii::app()->user->hasFlash('send')) {
                    ?>
                    <div class="flash-done">
                        <?php echo Yii::app()->user->getFlash('send'); ?>
                    </div>

                <?php } ?>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-form',
                    'enableClientValidation' => false,
                ));
                ?>
                <div class="shipping_address_heading">
                    <h2>Please enter your email address. You will be notified when this item is available.</h2>
                    <div class="clear"></div>
                </div>

                <div class="row_input">
                    <div class="row_text">
                        <article><?php echo $form->labelEx($model, 'email'); ?></article>
                    </div>
                    <div class="row_input_type">
                        <?php echo $form->textField($model, 'email', array('class' => 'row_text_type')); ?>
                    </div>
                    <div class="row_text">
                        <article><?php echo $form->error($model, 'email'); ?></article>
                    </div>
                </div>

                <div class="row_input">
                    <div class="row_input_type">
                        <?php echo CHtml::submitButton(Yii::t('common', 'Send', array(), NULL, Yii::app()->controller->currentLang), array('class' => 'row_button')); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>

    </div>
</div>