<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/login_style.css');

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div class="form_container">
    <div class="row_left_form row_center_form">
        <div class="shipping_address_heading">
            <h2><?php echo Yii::t('common', 'Forgot password?', array(), NULL, $this->currentLang) ?></h2>
            <div class="clear"></div>
            <div id="errors" style="color: red">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>
        <div id="mydi" style="color:red">
            <?php
            if (Yii::app()->user->hasFlash('incorrect_email') || Yii::app()->user->hasFlash('password_reset') || Yii::app()->user->hasFlash('superAdmin')) {
                ?>
                <div class="flash-success" align="center">
                    <?php echo Yii::app()->user->getFlash('incorrect_email'); ?>
                    <?php echo Yii::app()->user->getFlash('password_reset'); ?>
                    <?php echo Yii::app()->user->getFlash('superAdmin'); ?>
                </div>
                <hr>

            <?php } ?>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo Yii::t('common', 'Your Email', array(), NULL, $this->currentLang) ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'user_email', array("class" => "text")); ?>
                <br> <br>
            </div>
        </div>
        <div class="row_input">

            <?php
            echo CHtml::submitButton(Yii::t('common', 'Send', array(), NULL, Yii::app()->controller->currentLang), array("class" => "row_button"));
            ?>
        </div>
        <div class="row_input">
            <div class="row_text">
                <article>
                    <h2><?php echo Yii::t('common', 'Login with', array(), NULL, $this->currentLang) ?></h2>
                </article>
            </div>
            <div class="row_input_type">
                <?php
                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/icons/fb_log.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/icons/twitter.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/icons/gplus.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "google")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
                echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/icons/linkedin.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "linkedin")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
                ?>
            </div>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>
