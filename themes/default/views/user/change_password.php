<div id="book_content">
    <div id="book_main_content">
        <div class="left_book_main_content">
            <?php
            echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/darussalam-inner-logo.png"), $this->createUrl('/site/storehome', array('country' => Yii::app()->session['country_short_name'], 'city' => Yii::app()->session['city_short_name'], 'city_id' => Yii::app()->session['city_id'])));
            ?>
        </div>
        <div class="search_box">
            <input type="text" placeholder="Search keywords or image ids..." value="" class="search_text" />
            <input type="button" name="" value="" class="search_btn" />
            <?php echo CHtml::image(Yii::app()->theme->baseUrl . "/images/searching_img_03.jpg", '', array('class' => 'searching_img')) ?>
        </div>
        <nav>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Help</a></li>
            </ul>
        </nav>
    </div>
</div>
<div id="user_login">
    <div id="main_user_login">
        <div class="left_user_login">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'password-change-form',
                'enableClientValidation' => TRUE,
            ));
            ?>
            <div id='error' style="color: red">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <h1>Change Your Password</h1>
            <table>
                <tr>
                <tr>
                    <td class="right_login" style="color: green" >
                        <?php
                        if (Yii::app()->user->hasFlash('changPass')) {
                            ?>
                            <div class="flash-success" align="center">
                                <?php echo Yii::app()->user->getFlash('changPass'); ?>
                            </div>

                        <?php } ?>
                    </td>
                </tr>
                <td>
                    <table>
                        <tr>
                            <td class="left_login"><?php echo $form->labelEx($model, 'old_password'); ?></td>
                            <td class="right_login">
                                <?php echo $form->passwordField($model, 'old_password', array('class' => 'login_text')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="left_login"><?php echo $form->labelEx($model, 'user_password'); ?></td>
                            <td class="right_login">
                                <?php echo $form->passwordField($model, 'user_password', array('class' => 'login_text')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="left_login"><?php echo $form->labelEx($model, 'user_conf_password'); ?></td>
                            <td class="right_login">
                                <?php echo $form->passwordField($model, 'user_conf_password', array('class' => 'login_text')); ?>
                            </td>
                        </tr>
                    </table>
                </td>
                </tr>
            </table>
            <?php echo CHtml::submitButton("Sign In", array("class" => "create_account")); ?> 
            <?php $this->endWidget(); ?>
        </div>

    </div>
</div>