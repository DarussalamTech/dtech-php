<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/login_style.css');

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'action' => Yii::app()->createUrl('/site/login'),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));

?>
<div class="form_container">
    <div class="row_left_form row_center_form">
        <div class="shipping_address_heading">
            <h3 style="color:#003366">Sign In</h3>
            <h2><?php echo Yii::t('common', 'Already a member?', array(), NULL, $this->currentLang) ?></h2>
            <div class="clear"></div>
            <div id="errors" style="color: red">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>
        <?php if (Yii::app()->user->hasFlash('registration') || Yii::app()->user->hasFlash('login')) { ?>

            <div id="flash" style="text-align: center; color: green" >
                <?php echo Yii::app()->user->getFlash('registration'); ?>
                <?php echo Yii::app()->user->getFlash('login'); ?>
            </div>

        <?php }
        ?>
        <?php if (Yii::app()->user->hasFlash('changPass')) { ?>

            <div id="flash" style="text-align: center; color: green" >
                <?php echo Yii::app()->user->getFlash('changPass'); ?>
            </div>

        <?php }
        ?>

        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo Yii::t('common', 'Email', array(), NULL, Yii::app()->controller->currentLang); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->textField($model, 'username', array("class" => "text")); ?>
            </div>
        </div>

        <div class="row_input">
            <div class="row_text">
                <article>
                    <?php echo Yii::t('common', 'Password', array(), NULL, Yii::app()->controller->currentLang); ?>
                </article>
            </div>
            <div class="row_input_type">
                <?php echo $form->passwordField($model, 'password', $htmlOptions = array("class" => "text")); ?>
            </div>
        </div>
        <div class="row_input">

            <?php
            echo CHtml::submitButton(Yii::t('common', 'Login', array(), NULL, Yii::app()->controller->currentLang), array("class" => "row_button"));
            ?>
        </div>

        <div class="row_input">
            <div class="row_text">

                <?php
                echo $form->hiddenField($model, 'route');
                ?>

            </div>
            <div class="forgot_pass">
                <?php echo CHtml::link(Yii::t('common', 'Forgot password?', array(), NULL, Yii::app()->controller->currentLang), $this->createUrl('/web/user/forgot')); ?>
            </div>
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