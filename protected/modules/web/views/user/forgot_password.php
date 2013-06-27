<?php
$this->webPcmWidget['filter'] = array('name' => 'DtechSecondSidebar',
    'attributes' => array(
        'cObj' => $this,
        'cssFile' => Yii::app()->theme->baseUrl . "/css/side_bar.css",
        ));
?>
<div id="login_content">
    <?php
    echo CHtml::image(Yii::app()->theme->baseUrl . "/images/shopping_cart_img_03.png");
    ?>
    <h6>Forgot Password?</h6>

    <?php
    $login_model = new LoginForm;
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        //'action' => Yii::app()->createUrl('/web/user/forgot'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="login_part">
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
        <p>Your Email</p><br>
        <?php echo $form->textField($model, 'user_email', array("class" => "text")); ?>
        <br> <br>
        <?php echo CHtml::submitButton("Send", array("class" => "user_login_button", 'style' => 'width:150px;margin:1px 100px 0px')); ?> 
    </div>
    <?php $this->endWidget(); ?>
    <div class="login_with_images">
        <h4>Login with</h4>

        <?php
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/facebook_login_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")));
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/bird_login_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")));
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/google_login_03.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "google")));
        echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/in_img_06.png"), $this->createUrl('/web/hybrid/login/', array("provider" => "linkden")));
        ?>
    </div>
</div>
