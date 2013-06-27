<div class="left_user_login">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableClientValidation' => TRUE,
    ));
    ?>
    <div id='error' style="color: red">
        <?php echo $form->errorSummary($model); ?>
    </div>
    <h1>Create Your Account</h1>
    <table>
        <tr>
            <td>
                <table>

                    <tr>
                        <td class="left_login"><?php echo $form->labelEx($model, 'user_name'); ?></td>
                        <td class="right_login">
                            <?php echo $form->textField($model, 'user_name', array('class' => 'login_text')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="left_login"><?php echo $form->labelEx($model, 'user_email'); ?></td>
                        <td class="right_login">
                            <?php echo $form->textField($model, 'user_email', array('class' => 'login_text')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="left_login"><?php echo $form->labelEx($model, 'user_password'); ?></td>
                        <td class="right_login">
                            <?php echo $form->passwordField($model, 'user_password', array('class' => 'login_text')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="left_login"><?php echo $form->labelEx($model, 'user_password2'); ?></td>
                        <td class="right_login">
                            <?php echo $form->passwordField($model, 'user_password2', array('class' => 'login_text')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="middle_login">
                            <?php echo $form->checkBox($model, 'special_offer'); ?>
                            <span>Yes, email me updates and special offers form Darrussalam</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="under_middle_login">
                            <?php echo $form->checkBox($model, 'agreement_status'); ?>
                            <span>I agree to Darussalam's Website Terms</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Sign Up' : 'Save', array('class' => 'create_account')); ?>
    <?php $this->endWidget(); ?>
</div>
