<div class="right_user_login">
    <h2>Please Enter your Associated email Your Social Login has return any Email</h2>
    <table>
        <tr>
            <td>
                <table>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'email-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    ));
                    ?>
                    <tr>
                        <td class="left_login"><?php echo $form->labelEx($model, "email") ?></td>
                        <td class="right_login">
                            <?php echo $form->textField($model, 'email', array("class" => "login_text")); ?>
                            <div class="clear"></div>
                            <?php echo $form->error($model,'email') ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="left_login"></td>
                        <td class="right_login">
                            <?php echo CHtml::submitButton("Submit", array("class" => "already_account")); ?>
                        </td>
                    </tr>
                    <?php $this->endWidget(); ?>
                </table>
            </td>
        </tr>
    </table>

</div>