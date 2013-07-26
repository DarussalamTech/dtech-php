
<?php
$this->webPcmWidget['filter'] = array('name' => 'DtechSecondSidebar',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 1,
        ));
?>
<?php
$this->webPcmWidget['best'] = array('name' => 'DtechBestSelling',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        'is_cat_filter' => 0,
        ));
?>
<div id="login_content">
    <h6>
    <?php echo Yii::t('header_footer', 'Change Password', array(), NULL, $this->currentLang); ?>
    </h6>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'password-change-form',
        'enableClientValidation' => TRUE,
    ));
    ?>
    <div id='error' style="color: red">
        <?php echo $form->errorSummary($model); ?>
    </div>
    <?php
    if (Yii::app()->user->hasFlash('changPass')) {
        ?>
        <div class="flash-done">
            <?php echo Yii::app()->user->getFlash('changPass'); ?>
        </div>

    <?php } ?>
    <div class="chang_pass_content">
        <p><?php echo $form->labelEx($model, 'old_password'); ?></p>
        <?php echo $form->passwordField($model, 'old_password', array("class" => "text")); ?>

        <p><?php echo $form->labelEx($model, 'user_password'); ?></p>
        <?php echo $form->passwordField($model, 'user_password', array('class' => 'text')); ?>

        <p><?php echo $form->labelEx($model, 'user_conf_password'); ?></p>
        <?php echo $form->passwordField($model, 'user_conf_password', array('class' => 'text')); ?>

        <article style="text-align: right;margin-top: 4px"> <?php echo CHtml::link(Yii::t('common', 'Forgot password?', array(), NULL, $this->currentLang), $this->createUrl('/web/user/forgot')); ?></article>
        <?php
        echo CHtml::submitButton(Yii::t('common', 'Submit', array(), NULL, $this->currentLang), array("class" => "chang_password_button"));
        ?>
    </div>
    <?php $this->endWidget(); ?>
    <div class="login_with_images">
        <h4><?php echo Yii::t('common', 'Login with', array(), NULL, $this->currentLang) ?></h4>

        <?php
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/facebook_login_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/bird_login_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/google_login_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "google")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/in_img_06.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "linkedin")), array("onclick" => "dtech.doSocial('login-form',this);return false;"));
        ?>
    </div>
</div>