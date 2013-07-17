<a href="#" id="login_btn">
    <span>
        <?php echo Yii::t('header_footer', 'Login', array(), NULL, $this->currentLang); ?>
    </span>
</a>
<div style="clear:both"></div>
<div id="login_bx">  
    <?php
    $login_model = new LoginForm;
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login_frm',
        'action' => Yii::app()->createUrl('/site/login'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?> 
    <fieldset id="body">
        <fieldset>
            <div id="login_pointer">
            </div>
            <label for="email"><?php echo Yii::t('common', 'Email', array(), NULL, Yii::app()->controller->currentLang); ?></label>
            <?php
            echo $form->textField($login_model, 'username', array("id" => "email"));
            echo $form->hiddenField($login_model, 'route', array("value" => Yii::app()->request->getUrl()));
            ?>
        </fieldset>
        <fieldset>
            <label for="password"><?php echo Yii::t('common', 'Password', array(), NULL, Yii::app()->controller->currentLang); ?></label>
            <?php
            echo $form->passwordField($login_model, 'password', array("id" => "password"));
            ?>
        </fieldset>
    </fieldset>
    <?php echo CHtml::submitButton(Yii::t('header_footer', 'User Login', array(), NULL, $this->currentLang), array("class" => "user_login_btn")); ?>
    <?php $this->endWidget(); ?>
</div>