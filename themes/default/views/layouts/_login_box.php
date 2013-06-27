<div class="example2" >
    <?php
    /* @var $this SiteController */
    /* @var $model LoginForm */
    /* @var $form CActiveForm  */

    $this->pageTitle = Yii::app()->name . ' - Login';
    $this->breadcrumbs = array(
        'Login',
    );
    ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'action' => Yii::app()->createUrl('/site/login'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>


    <h1>Sign In</h1>
    <p>
        <?php
        echo $login_model->getAttributeLabel('username');
        ?>
    </p>
    <?php echo $form->textField($login_model, 'username', $htmlOptions = array("class" => "second")); ?>
    <?php //echo $form->error($login_model,'username');  ?>
    <p>
        <?php
        echo $login_model->getAttributeLabel('password');
        ?>
    </p>
    <?php echo $form->passwordField($login_model, 'password', $htmlOptions = array("class" => "second")); ?>
    <?php echo $form->checkBox($login_model, 'rememberMe', $htmlOptions = array("class" => "check")); ?>
    <span><?php
        echo $login_model->getAttributeLabel('rememberMe');
        echo $form->hiddenField($login_model,'route',array("value"=>Yii::app()->request->getUrl()));
        ?>
    </span>
    <a href="<?php echo $this->createUrl('/web/user/forgot') ?>" class="forgot"> Forgot Password</a>
    <div class="sign_in_button">
        <?php echo CHtml::submitButton("Sign In", array("class" => "btn")); ?>
    </div>
    <h2 class="signinp">Sign in with</h2>
    <div class="sign_in">
        <a onclick="dtech.doSocial('login-form',this);return false;" href="<?php echo $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")); ?>">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/facebook_img_03.jpg');
            ?>
            <?php echo CHtml::button('Facebook', array("class" => "f_img")); ?>
        </a>

    </div>
    <div class="sign_in">
        <a onclick="dtech.doSocial('login-form',this);return false;"  href="<?php echo $this->createUrl('/web/hybrid/login/', array("provider" => "linkedin")); ?>">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/linkedin_img_03.jpg');
            ?>
            <?php echo CHtml::button('Linkedin', array("class" => "l_img")); ?>
        </a>

    </div>
    <div class="sign_in">
        <a onclick="dtech.doSocial('login-form',this);return false;"  href="<?php echo $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")); ?>">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/twitter_img_03.jpg');
            ?>
            <?php echo CHtml::button('Twitter', array("class" => "t_img")); ?>
        </a>

    </div>
    <div class="sign_in">
        <a onclick="dtech.doSocial('login-form',this);return false;"  href="<?php echo $this->createUrl('/web/hybrid/login/', array("provider" => "google")); ?>">
            <?php
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/google_img_03.jpg');
            ?>
            <?php echo CHtml::button('Google', array("class" => "g_img")); ?>
        </a>

    </div>
    <h3 class="dont">Don't have account?</h3>
    <div class="sign_up_button">
        <a href="<?php echo $this->createUrl('/web/user/register') ?>">
            <?php echo CHtml::button('Sign Up', array("class" => "btn")); ?>
        </a>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script>

    var mouse_is_inside = false;
    jQuery(document).ready(function()
    {
        jQuery('.example2').hover(function() {
            mouse_is_inside = true;
        }, function() {
            mouse_is_inside = false;
        });

        jQuery("body").mouseup(function() {
            if (!mouse_is_inside)
                jQuery('.example2').hide();
        });
    });

</script>