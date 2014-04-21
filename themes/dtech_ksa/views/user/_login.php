<div class="right_user_login">
    <h2>Already have an account?</h2>
    <table>
        <tr>
            <td>
                <table>
                    <?php
                    $login_model = new LoginForm;
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'login-form',
                        'action' => Yii::app()->createUrl('/site/login'),
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    ));
                    ?>
                    <tr>
                        <td class="left_login">Email</td>
                        <td class="right_login">
                            <?php echo $form->textField($login_model, 'username', array("class" => "login_text")); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="left_login">Password</td>
                        <td class="right_login">
                            <?php echo $form->passwordField($login_model, 'password', $htmlOptions = array("class" => "login_text")); ?>
                            <?php
                            echo $form->hiddenField($model, 'route');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="left_login"></td>
                        <td class="right_login"><input type="checkbox">
                            <span>Stay signed in 
                                <?php echo CHtml::link('Forgot password?', $this->createUrl('/web/user/forgot')); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="left_login"></td>
                        <td class="right_login">
                            <?php echo CHtml::submitButton("Sign In", array("class" => "already_account")); ?>
                        </td>
                    </tr>
                    <?php $this->endWidget(); ?>
                </table>
            </td>
        </tr>
    </table>
    <h2>Sign in with</h2>
    <div id="login_images">
        <div class="login_img">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/facebook_img_03.jpg"), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook", "onclick" => "dtech.doSocial('login-form',this);return false;")));
            ?>
            <span>Facebook</span>
        </div>
        <div class="login_img">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/linkedin_img_03.jpg"), $this->createUrl('/web/hybrid/login/', array("provider" => "linkedin", "onclick" => "dtech.doSocial('login-form',this);return false;")));
            ?>
            <span>Linkedin</span>
        </div>
        <div class="login_img">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/twitter_img_03.jpg"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter", "onclick" => "dtech.doSocial('login-form',this);return false;")));
            ?>
            <span>Twitter</span>
        </div>
        <div class="login_img">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/google_img_03.jpg"), $this->createUrl('/web/hybrid/login/', array("provider" => "google", "onclick" => "dtech.doSocial('login-form',this);return false;")));
            ?>
            <span>Google</span>
        </div>
    </div>
</div>