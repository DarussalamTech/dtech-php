<div class="right_user_login">
    <h2>Already have an account?</h2>
    <table>
        <tr>
            <td>
                <table>
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
                    <div id="errors" style="color: red">
                        <?php echo $form->errorSummary($model); ?>
                    </div>
                    <tr>
                        <td class="left_login">Email</td>
                        <td class="right_login">
                            <?php echo $form->textField($model, 'username', array("class" => "login_text")); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="left_login">Password</td>
                        <td class="right_login">
                            <?php echo $form->passwordField($model, 'password', $htmlOptions = array("class" => "login_text")); ?>
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
                            <?php
                            echo $form->hiddenField($model, 'route');
                            echo CHtml::submitButton("Sign In", array("class" => "already_account"));
                            ?>
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
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/facebook_img_03.jpg"), $this->createUrl('/web/hybrid/login/', array("provider" => "facebook")));
            ?>
            <span>Facebook</span>
        </div>
        <div class="login_img">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/linkedin_img_03.jpg"), $this->createUrl('/web/hybrid/login/', array("provider" => "linkedin")));
            ?>
            <span>Linkedin</span>
        </div>
        <div class="login_img">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/twitter_img_03.jpg"), $this->createUrl('/web/hybrid/login/', array("provider" => "twitter")));
            ?>
            <span>Twitter</span>
        </div>
        <div class="login_img">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/google_img_03.jpg"), $this->createUrl('/web/hybrid/login/', array("provider" => "google")));
            ?>
            <span>Google</span>
        </div>
    </div>
</div>