<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/login_style.css');

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'password-change-form',
    'enableClientValidation' => TRUE,
        ));
?>
<div class="form_container">
    <div class="row_left_form row_center_form">
        <div class="shipping_address_heading">
            <h2><?php echo Yii::t('header_footer', 'Change Password', array(), NULL, $this->currentLang); ?></h2>
            <div class="clear"></div>
            <div id='error' style="color: red">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>
        <?php
        if (Yii::app()->user->hasFlash('changPass')) {
            ?>
            <div class="flash-done">
                <?php echo Yii::app()->user->getFlash('changPass'); ?>
            </div>

        <?php } ?>

        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'user_password'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->passwordField($model, 'user_password', array('class' => 'text')); ?>
            </div>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo $form->labelEx($model, 'user_conf_password'); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->passwordField($model, 'user_conf_password', array('class' => 'text')); ?>
            </div>
        </div>
        <div class="row_input">

            <?php
            echo CHtml::submitButton(Yii::t('common', 'Submit', array(), NULL, Yii::app()->controller->currentLang), array("class" => "row_button"));
            ?>
        </div>

        <div class="row_input">
            <div class="row_text">

                <?php
               // echo $form->hiddenField($model, 'route');
                ?>

            </div>
            <div class="forgot_pass">
                <?php //echo CHtml::link(Yii::t('common', 'Forgot password?', array(), NULL, Yii::app()->controller->currentLang), $this->createUrl('/web/user/forgot')); ?>
            </div>
        </div>
        <div class="row_input">

            <div class="row_text">
                <article>
                    <h2><?php //echo Yii::t('common', 'Login with', array(), NULL, $this->currentLang) ?></h2>
                </article>
            </div>
            <div class="row_input_type">
                <?php
//                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/icons/fb_log.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
//                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/icons/twitter.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
//                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/icons/gplus.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "google")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
//                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/icons/linkedin.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "linkedin")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
                ?>
            </div>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>